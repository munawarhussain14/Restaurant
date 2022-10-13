<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Labour;
use App\Models\District;
use App\Models\Minerals;
use App\Models\WorkType;
use DB;
use App\Helper\DatatableHelper;
use App\Http\Requests\LabourRequest;
use Auth;

class LabourController extends AdminController
{
    private $params = [
        "basic"=>"admin/labours",
        "dir"=>"admin.labours",
        "route"=>"admin.labours",
        "model"=>"labour",
        "singular_title"=>"Mine Labour",
        "plural_title"=>"Mine Labours",
        "module_name"=>"labours",
        "upload_dir"=>"labours",
        "columns"=> [
            ["data" => 'l_id', "name" => 'l_id',"title"=>"ID"],
            ["data" => 'name', "name" => 'name',"title"=>"Name"],
            ["data" => 'father_name', "name" => 'father_name',"title"=>"Father Name"],
            ["data" => 'cnic', "name" => 'cnic',"title"=>"CNIC"],
            ["data"=> 'labour_status', "name"=> 'labour_status', "orderable"=> "false", "searchable"=> "false","title"=>"Status"],
            ["data"=> 'action', "name"=> 'action', "orderable"=> "false", "searchable"=> "false","title"=>"Action"],
        ]
    ];

    public function __construct()
    {
        parent::__construct($this->params["module_name"]);
    }

    function find($id = 0){
        if($id){
            return Labour::find($id);
        }else{
            return new Labour;
        }
    }

    function all($columns="*"){
        return Labour::select($columns);
    }

    function getDate($date){
        $temp = explode("/",$date);
        return date_create("$temp[1]/$temp[0]/$temp[2]");
    }

    function onHandleOperation($request,$id = 0){

        $user_id = Auth::getUser()->id;
        $table = $this->find($id);

        $table->name = $request->name;
        $table->cnic = $request->cnic;
        $table->father_name = $request->fathername;

        $table->dob = "$request->dob_year-$request->dob_month-$request->dob_day";

        $table->cell_no_primary = $request->cell_no_primary;
        $table->cell_no_secondary = $request->cell_no_secondary;
        $table->gender = $request->gender;
        $table->domicile_district = $request->domicile_district;
        $table->married = $request->married;
        
        $table->eobi = $request->eobi;
        if($request->has("eobi")&&$request->eobi=="yes"){
            $table->eobi_no = $request->eobi_no;
        }
        
        /*$table->account_no = $request->account_no;
        
        $table->bank_name = $request->bank_name;
        if($request->bank_name=="other"){
            $table->other_bank_name = $request->cnic;
        }*/
        
        $table->work_from = "$request->work_from_year-$request->work_from_month-$request->work_from_day";
        
        $table->work_id = $request->work_type;
        if($request->work_type=="other"){
            $work_type = WorkType::where("title",$table->other_work_type)->first();
            if(!$work_type){
                $work_type = new WorkType();
                $work_type->title = $request->other_work_type;
                $work_type->add_by = $user_id;
                $work_type->save();
            }
            $table->work_id = $work_type->wt_id;
        }
        
        $table->perm_address = $request->perm_address;
        $table->perm_district_id = $request->perm_district;
        $table->postal_address = $request->postal_address;
        $table->postal_district_id = $request->postal_district;
        $table->lease_owner_name = $request->lease_owner_name;
        $table->lease_no = $request->lease_no;
        $table->lease_district_id = $request->lease_district;
        
        $table->mineral_id = $request->mineral;
        if($request->mineral=="other"){
            $row = Minerals::where("name",$table->mineral)->first();
            if(!$row){
                $row = new Minerals();
                $row->name = $request->other_mineral;
                $row->add_by = $user_id;
                $row->save();
            }
            $table->mineral_id = $row->m_id;
        }
        
        $table->purpose = $request->purpose;

        if($request->purpose=="deceased labour"){
            $table->doa = "$request->doa_year-$request->doa_month-$request->doa_day";
            $table->death_date = "$request->death_year-$request->death_month-$request->death_day";
        }

        if($request->purpose=="permanent disabled"||$request->purpose=="occupational desease"){
            $table->doa = "$request->doa_year-$request->doa_month-$request->doa_day";
        }

        $table->lease_address = $request->lease_address;

        $table->save();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->all(["l_id","name","father_name","cnic","labour_status"])->where("labour_status","approved");
            $table = new DatatableHelper($data,$this->params,"l_id");
            return $table->custom_response(["action","labour_status"])
            ->addColumn('labour_status',function(Labour $model){
                $status = "";
                if($model->labour_status=="pending")
                {
                    $status = "<i class='fa fa-pause-circle'></i>";
                }
                else if($model->labour_status=="in process")
                {
                    $status = "<i class='fa fa-clock></i>";
                }
                else if($model->labour_status=="approved")
                {
                    $status = "<i class='fa fa-check'></i>";
                }
                else if($model->labour_status=="rejected")
                {
                    $status = "<i class='fa fa-times'></i>";
                }
                else if($model->labour_status=="document verified")
                {
                    $status = "Doc verify";
                }

                return $status;
            })->make(true);
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
        $districts = District::all();
        $minerals = Minerals::all();
        $worktypes = WorkType::all();
        $title = "New ".$params["singular_title"];
        return view($this->params['dir'].".create",compact("title","params","districts","minerals","worktypes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabourRequest $request)
    {     
        $data = [];
        $this->onHandleOperation($request);

        return redirect(route($this->params['route'].".index"));
    }

    function uploadFile($file,$destinationPath){
        //Display File Name
        $fileName = time().'_'.$file->getClientOriginalName();
    
        //Display File Extension
        $ext = $file->getClientOriginalExtension();
        
        //Display File Real Path
        $realPath = $file->getRealPath();
    
        //Display File Size
        $size = $file->getSize();
        
        //Display File Mime Type
        $mimeType = $file->getMimeType();

        //Move Uploaded File
//        $destinationPath = 'uploads/Auction/attachment';

        $path = $file->move($destinationPath,$fileName);

        return $destinationPath."/".$fileName;
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
        $districts = District::all();
        $minerals = Minerals::all();
        $worktypes = WorkType::all();
        return view($this->params['dir'].".create",compact("row","title","params","parm","districts","minerals","worktypes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LabourRequest $request, $id)
    {
        $data = [];
        
        $this->onHandleOperation($request,$id);

        return redirect(route($this->params['route'].".index"));
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
        
        $row->delete();
        if ($request->ajax()) {

            return Response()->json(["status"=>"ok","message"=>"Delete Successfully"]);
        }

        return redirect(route($this->params['dir'].".index"));
    }
}