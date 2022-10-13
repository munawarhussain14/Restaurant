<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Labour;

class DashboardController extends Controller
{

    private $params = [
        "singular_title"=>"Dashboard",
        "plural_title"=>"Dashboard",
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $labours = Labour::all();
        $params = $this->params;
        return view('admin.dashboard',compact("params","labours"));
    }
}
