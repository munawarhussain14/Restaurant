<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Permission;
use DB;
use App\Helper\DatatableHelper;
use PDF;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends AdminController
{
    private $params = [
        "basic"=>"admin/restaurants",
        "dir"=>"admin.restaurants",
        "route"=>"admin.restaurants",
        "model"=>"restaurant",
        "singular_title"=>"Restaurant",
        "plural_title"=>"Restaurants",
        "module_name"=>"restaurants",
        "upload_dir"=>"restaurant",
        "create_rules"=>[
            "name"=>"required",
            "phone"=>"required",
            "logo"=>"required|mimes:png,jpg,jpeg|max:2048",
            "pdf_menu"=>"required|mimes:pdf",
            "address"=>"required",
            "primary_color"=>"required",
            "secondary_color"=>"required"
        ],
        "edit_rules"=>[
            "name"=>"required",
            "phone"=>"required",
            "logo"=>"mimes:png,jpg,jpeg|max:2048",
            "pdf_menu"=>"mimes:pdf",
            "address"=>"required",
            "primary_color"=>"required",
            "secondary_color"=>"required"
        ],
        "columns"=> [
            ["data" => 'id', "name" => 'ID'],
            ["data" => 'name', "name" => 'Name'],
            ["data" => 'logo', "name" => 'Logo'],
            ["data" => 'phone', "name" => 'Phone No'],
            ["data" => 'primary_color', "name" => 'Color', "orderable"=> "false", "searchable"=> "false"],
            ["data"=> 'action', "name"=> 'Action', "orderable"=> "false", "searchable"=> "false"],
        ]
    ];

    public function __construct()
    {
        parent::__construct($this->params["module_name"]);
    }

    function find($id = 0){
        if($id){
            return Restaurant::find($id);
        }else{
            return new Restaurant;
        }
    }

    function all($columns="*"){
        return Restaurant::select($columns);
    }

    function getDate($date){
        $temp = explode("/",$date);
        return date_create("$temp[1]/$temp[0]/$temp[2]");
    }

    function onHandleOperation($request,$id = 0){

        // dd($request->all());
        $table = $this->find($id);

        $table->name = $request->name;

        $table->phone = $request->phone;
                
        $table->address = $request->address;
        
        $table->primary_color = $request->primary_color;

        $table->secondary_color = $request->secondary_color;       
        
        $table->save();

        $attachment = "";
        if($request->file("logo")) {
            if($id&&file_exists($table->logo)){
                unlink($table->logo);
            }
            $file = $request->file('logo');
            $fileName = "logo_".$table->id;
            $attachment = $this->uploadFile(
                $file,
                $this->params['upload_dir']."/logos",
                $fileName
            );
        }

        if($attachment!=""){
            $table->logo = $attachment;
        }

        $attachment = "";
        
        if($request->file("pdf_menu")) {
            if($id&&file_exists($table->pdf_menu)){
                unlink($table->pdf_menu);
                unlink($table->qrcode);
            }
            $file = $request->file('pdf_menu');
            $fileName = "menu_".$table->id;
            $attachment = $this->uploadFile(
                $file,
                $this->params['upload_dir']."/menus",
                $fileName
            );
        }

        if($attachment!=""){
            $table->pdf_menu = $attachment;
            $table->qrcode = null;
        }

        $table->save();

        return $table->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->all();
            
            $table = new DatatableHelper($data,$this->params);
            
            $table->appendActionButton(url("admin/restaurants/pdf/{id}"),"PDF","fas fa-file-pdf");

            return $table->custom_response(['primary_color','logo','action'])
            ->addColumn('logo',function($row){
                return "<a href='".Storage::url($row['logo'])."' target='_blank'><img width='50' src='".Storage::url($row['logo'])."'/></a>";
            })->addColumn('primary_color',function($row){
                $colors = "
                <table class='column-table'>
                <tr>
                    <td>Primary Color</td>
                    <td>
                        <div class='color-box' style='background:".$row["primary_color"]."'></div>
                    </td>
                </tr>
                <tr>
                    <td>Secondary Color</td>
                    <td>
                        <div class='color-box' style='background:".$row["secondary_color"]."'></div>
                    </td>
                </tr>
                </table>
                ";
                return $colors;
            })
            ->make(true);
        }

        $params = $this->params;
        return view($this->params['dir'].".index",compact("params"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $this->params;
        $title = "New ".$params["singular_title"];
        return view($this->params['dir'].".create",compact("title","params"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $data = [];
        $request->validate($this->params['create_rules']);
        $id = $this->onHandleOperation($request);

        return redirect(route($this->params['route'].".show",["restaurant"=>$id]));
    }

    function uploadFile($file,$destinationPath,$fileName=null){
        //Display File Name
        if(!$fileName)
        {
            $fileName = time().'_'.$file->getClientOriginalName();
        }else{
            //Display File Extension
            $ext = $file->getClientOriginalExtension();
            $fileName .= ".$ext";
        }
    
        //Display File Real Path
        $realPath = $file->getRealPath();
    
        //Display File Size
        $size = $file->getSize();
        
        //Display File Mime Type
        $mimeType = $file->getMimeType();

        //Move Uploaded File
//        $destinationPath = 'uploads/Auction/attachment';
        $base = Storage::disk('public');
        
        $path = "$destinationPath/$fileName";

        $base->put($path,file_get_contents($realPath));
        //$file->store($path,'public');
        //$path = $file->move($destinationPath,$fileName);

        return $path;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = $this->find($id);
        $parm[$this->params['model']] = $id;
        $params = $this->params;
        return view($this->params['dir'].".show",compact("row","parm","params"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->find($id);
        $parm[$this->params['model']] = $id;
        $title = "Edit ".$this->params['singular_title'];
        $params = $this->params;
        return view($this->params['dir'].".edit",compact("row","title","params","parm"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
        $validated = $request->validate($this->params['edit_rules']);
        
        $this->onHandleOperation($request,$id);

        return redirect(route($this->params['route'].".show",["restaurant"=>$id]));
        //return redirect(route($this->params['route'].".index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $row = $this->find($id);
        
        if(file_exists($row->logo))
        {
            unlink($row->logo);
        }

        if(file_exists($row->pdf_menu))
        {
            unlink($row->pdf_menu);
        }

        $row->delete();
        if ($request->ajax()) {

            return Response()->json(["status"=>"ok","message"=>"Delete Successfully"]);
        }

        return redirect(route($this->params['dir'].".index"));
    }

    public function uploadQrcode(Request $request, $restaurant_id){
        
        $restaurant = Restaurant::find($restaurant_id);

        $data = $request->qrcode;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $path = $this->params['upload_dir']."/qrcodes/$restaurant_id.png";
        $base = Storage::disk('public');
        $base->put($path,$data);
        //file_put_contents($path, $data);

        if(Storage::disk('public')->exists($path))
        {
            $restaurant->qrcode = $path;
            $restaurant->save();
            return response()->json(["qrcode"=>$base->url($path)],200);
        }else{
            return response()->json(["message"=>"QrCode not Generated!"],404);
        }
        
    }

    public function pdf($restauratn_id)
    {
        $row = $this->find($restauratn_id);
        $parm[$this->params['model']] = $restauratn_id;
        $title = "PDF ".$this->params['singular_title'];
        $params = $this->params;
        $pdf = PDF::setPaper('A4')->loadView($this->params['dir'].".pdf", compact("row","title","params","parm"));
        // download PDF file with download method
        return $pdf->stream('hotel_menu.pdf',compact("row"));
    }
}