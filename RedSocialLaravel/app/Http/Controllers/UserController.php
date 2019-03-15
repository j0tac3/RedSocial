<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Http\UploadFile;

class UserController extends Controller
{
    public function getUserByName(Request $request, $idUsuario)
    {
        $nombre=$request->input('buscar');
        $usuarios=User::where('name','like','%'.$nombre.'%')->get();
        //Esto es provisional hasta que pueda integrar bien Ajax
        $amigos=DB::table('amigos')->join('users','users.id_Usuario','=','amigos.id_usuario_destinatario')
                ->where('id_usuario_remitente','=',Auth::user()->id_Usuario)
                ->where('estado','=',1)->get();
        return view('listaUsuarios',['amigos'=>$amigos,
                                     'listaUsuarios'=>$usuarios]);
    }

    public function updateUser(Request $request)
    {
        $name="";
        $usuario=User::findOrfail(Auth::user()->id_Usuario);
        $usuario->name=$request->input('nombre');
        $usuario->email=$request->input('userEmail');
        $usuario->password=bcrypt($request->input('userPwd'));
        $usuario->fecha_Nac=$request->input('birthDate');
        $usuario->avatar=Auth::user()->avatar;
        Auth::user()->name=$usuario->name;
        Auth::user()->email=$usuario->email;
        Auth::user()->password=$usuario->password;
        Auth::user()->fecha_Nac=$usuario->fecha_Nac;
      //  if ($request->file('avatar')->isValid()) {
            $archivo=$request->file('avatar');
            $usuario->avatar=$archivo->getClientOriginalName();
           // $usuario->avatar = $request->file('avatar')->getClientOriginalName();
            $destino=base_path() . '/public/img/';
            $archivo->move($destino,$usuario->avatar);
        //}
       /*    $usuario->avatar = $request->file('image')->getClientOriginalName();
           $name = $request->file('image')->getClientOriginalName();       
           Storage::disk('public')->putFileAs('foto', new File($request->file('image')),$name,'public');*/
        
        $usuario->save();
         //Esto es provisional hasta que pueda integrar bien Ajax
        $amigos=DB::table('amigos')->join('users','users.id_Usuario','=','amigos.id_usuario_destinatario')
                ->where('id_usuario_remitente','=',Auth::user()->id_Usuario)
                ->where('estado','=',1)->get();
        
       return view ('usuarios',['amigos'=>$amigos]);
    }

    public function deleteUser($idUsuario)
    {
    	Auth::logout();
    	User::destroy($idUsuario);

    	//$usuario->delete();
    	return redirect()->route('login');
    }
}
