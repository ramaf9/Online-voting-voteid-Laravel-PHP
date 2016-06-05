<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class Login extends Controller
{

    private $angkatan = "";
    public function index()
    {
        if (Auth::check())
        {
            //return Redirect::action('Auth\AuthController@getLogout');
            return redirect('/auth/logout');
        }
        else{
            return view('v_login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postToken()
    {

        if(Request::ajax()){
            $ang = Input::get('angkatan');
            $this->angkatan = $ang;

    }
    }
    public function getToken()
    {
        if (Auth::check()){
         function createToken(){
         //$data['angkatan']= $request->input('angkatan');
         $result = $this->angkatan;
         //$data['tps'] = $request->input('tps');
         //$result = DB::statement('CALL sp_get_task_assignment('.$user_id.')');
         //$result =  DB::select(CALL `token_generator`('.$data['tps'].', '.$data['angkatan'].'));
         //return $result[0]->TOKEN;
        return $result; 
        }
        return view('v_gentoken',compact('result'));
        }

    }
}
    