<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Minutes;
use DataTables;

class MinutesController extends Controller
{
    private $params = [
        "singular_title"=>"MTC Mineral",
        "plural_title"=>"MTC Minerals"
    ];

    public function __construct()
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Minutes::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('meeting_date', function($row){
                            return date('d-m-Y', strtotime($row["meeting_date"]));
                    })->orderColumn('meeting_date', function ($query, $order) {
                         $query->orderBy('meeting_date', $order);
                    })
                    ->addColumn('action', function($row){
       
                            $btn = '<a target="_blank" href="'.url($row["attachment"]).'" style="font-size:25px;"><i class="fas fa-file-pdf"></i></a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $params = $this->params;
        return view("web.minutes.index",compact("params"));
    }
}
