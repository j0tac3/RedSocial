<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicacion;

use App\Amigo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class HomeController extends Controller
{
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
       return redirect()->action('HomeController@inicio');
    }

    public function inicio()
    {
        $publicaciones = Publicacion::all();
        
        return view('inicio',['publicaciones'=>$publicaciones]);
    }
}
