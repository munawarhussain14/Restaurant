<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Waiter;
use App\Models\Permission;
use DB;
use App\Helper\DatatableHelper;
use PDF;
use Illuminate\Support\Facades\Storage;

class WaiterController extends AdminController
{
    private $params = [
        "basic"=>"admin/waiters",
        "dir"=>"admin.waiters",
        "route"=>"admin.waiters",
        "model"=>"waiter",
        "singular_title"=>"Waiter",
        "plural_title"=>"Waiters",
        "module_name"=>"waiters",
        "upload_dir"=>"waiter",
        "create_rules"=>[
            "name"=>"required",
            "qrcode"=>"required|mimes:png,jpg,jpeg|max:2048",
            "restaurant"=>"required",
        ],
        "edit_rules"=>[
            "name"=>"required",
            "qrcode"=>"mimes:png,jpg,jpeg|max:2048",
            "restaurant"=>"required",
        ],
        "columns"=> [
            ["data" => 'id', "name" => 'ID'],
            ["data" => 'name', "name" => 'Name'],
            ["data" => 'qrcode', "name" => 'QR Code'],
            ["data" => 'restaurant', "name" => 'Restaurant'],
            ["data"=> 'action', "name"=> 'Action', "orderable"=> "false", "searchable"=> "false"],
        ]
    ];

    public function __construct()
    {
        parent::__construct($this->params["module_name"]);
    }

    function find($id = 0){
        if($id){
            return Waiter::find($id);
        }else{
            return new Waiter;
        }
    }

    function all($columns="*"){
        return Waiter::select($columns);
    }

    function getDate($date){
        $temp = explode("/",$date);
        return date_create("$temp[1]/$temp[0]/$temp[2]");
    }

    function onHandleOperation($request,$id = 0){

        // dd($request->all());
        $table = $this->find($id);

        $table->name = $request->name;
                        
        $table->restaurant_id = $request->restaurant;
        
        $table->save();

        $attachment = "";
        if($request->file("qrcode")) {
            if($id&&Storage::disk('public')->exists($table->qrcode)){
                Storage::disk('public')->delete($table->qrcode);
            }
            $file = $request->file('qrcode');
            $fileName = "qrcode_".$table->id;
            $attachment = $this->uploadFile(
                $file,
                $this->params['upload_dir']."/qrcode",
                $fileName
            );
        }

        if($attachment!=""){
            $table->qrcode = $attachment;
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
            $data = $this->all()->select(
                "waiters.id as id",
                "waiters.restaurant_id as restaurant_id",
                "waiters.name as name",
                "waiters.qrcode as qrcode",
                "restaurants.name as restaurant"
                )->join("restaurants","restaurant_id","=","restaurants.id")
                ->get();
            
            $table = new DatatableHelper($data,$this->params);

            return $table->custom_response(['qrcode','action'])
            ->addColumn('qrcode',function($row){
                return "<img width='50' src='".Storage::url($row['qrcode'])."'/>";
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
    public function create(Request $request,$restaurant_id = null)
    {
        $params = $this->params;
        $title = "New ".$params["singular_title"];
        $restaurants = Restaurant::all();
        return view($this->params['dir'].".create",compact("title","params","restaurants","restaurant_id"));
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

        return redirect(route($this->params['route'].".show",[$this->params["model"]=>$id]));
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
        $restaurants = Restaurant::all();
        return view($this->params['dir'].".edit",compact("row","title","params","parm","restaurants"));
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

        return redirect(route($this->params['route'].".show",[$this->params["model"]=>$id]));
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

        if(Storage::disk('public')->exists($row->qrcode))
        {
            Storage::disk('public')->delete($row->qrcode);
        }

        $row->delete();
        if ($request->ajax()) {

            return Response()->json(["status"=>"ok","message"=>"Delete Successfully"]);
        }

        return redirect(route($this->params['dir'].".index"));
    }

    public function pdf($id)
    {
        $row = $this->find($id);
        $parm[$this->params['model']] = $id;
        $title = "PDF ".$this->params['singular_title'];
        $params = $this->params;
        $pdf = PDF::setPaper('A5')->loadView($this->params['dir'].".pdf", compact("row","title","params","parm"));
        // download PDF file with download method
        return $pdf->stream('waiter_card.pdf',compact("row"));
    }
}