<?php

namespace App\Helper;

use DataTables;
use Auth;

class DatatableHelper{

    private $data,$params;

    function __construct($data,$params) {
        $this->data = $data;
        $this->params = $params;
    }

    public function table_response(){
        return Datatables::of($this->data)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $this->action($row);
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
    public function custom_response($rawColumns = ['action']){
        return Datatables::of($this->data)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $this->action($row);
        })
        ->rawColumns($rawColumns);
    }

    function action($row){
                $specifier = $this->params["model"];
                $parm[$specifier] = $row['id'];
                $btn = "";
                if(Auth::user()->can("read-".$this->params["module_name"]))
                {
                    $btn .= "<a href='".route($this->params['route'].".show",$parm)."' class='action-btn btn btn-info btn-sm'><i class='fas fa-search'></i> View</a>&nbsp;";
                }
                
                if(Auth::user()->can("update-".$this->params["module_name"]))
                {
                    $btn .= "<a href='".route($this->params['route'].".edit",$parm)."' class='action-btn btn btn-primary btn-sm'><i class='fas fa-pencil-alt'></i> Edit</a>&nbsp;";
                }

                if(Auth::user()->can("delete-".$this->params["module_name"]))
                {
                    $btn .= "<a href='javascript:void(0)' onClick='onRemove(".$row['id'].")' class='action-btn delete btn btn-danger btn-sm'><i class='fa fa-trash'></i> Delete</a>";
                }
                return $btn;
        }
}