<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GestaoGestor;
use App\Models\Usuario;
//use App\Models\Log; //adicionar recurso de log de sistema no futuro


class LoginController extends Controller{
    public function index(){
        return view('Login');
    }
    
    
    public function login(Request $req ){       
        $this->validate($req, [
            'email'=>'required',
            'password'=>'required'
        ]);     
        
        
        $data = $req->all();       
       
        if ( Auth::attempt( [ 'email' => $data['email'] , 'password' => $data['password' ]] ) ) {

            $gestor_logado = Auth::user(); 
            session(['gestor' => $gestor_logado]); 
            return redirect()->route('index');               

         } else {
                session()->forget('gestor_logado');
                Auth::logout();
                return redirect('login')->with('msg_erro', 'Usuário inativo.');
            }
            //return redirect()->route('/');
        }

    public function logout () {
        //logger
        session()->forget('gestor');
       Auth::logout();
        return redirect()->route('login');

    }

}
