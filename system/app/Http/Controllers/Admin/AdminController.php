<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    private $module;
    function __construct($module){
        $this->module = $module;
        $this->middleware('auth');
        $this->middleware(function ($request, $next)
        {
            $name = Route::currentRouteName();
            if(str_contains($name,"index")){
                if(!auth()->user()->can("read-".$this->module)){
                    abort(404); 
                }
            }
            
            return $next($request);
        });
    }
}
