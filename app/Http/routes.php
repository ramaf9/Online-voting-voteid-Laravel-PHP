<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
define('ang',' ');



Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/sat2015','Login@index');
Route::get('/superlogin',function(){
	if(Auth::check()){

	return view('v_superlogin');

	}
});
//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('/',function(){

	return view('v_itoken');
});
Route::post('/v_pilih',function(){
	if(Request::ajax()){
		function ms_escape_string($data) {
		if ( !isset($data) or empty($data) ) return '';
		if ( is_numeric($data) ) return $data;

		$non_displayables = array(
			'/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
			'/%1[0-9a-f]/',             // url encoded 16-31
			'/[\x00-\x08]/',            // 00-08
			'/\x0b/',                   // 11
			'/\x0c/',                   // 12
			'/[\x0e-\x1f]/'             // 14-31
		);
		foreach ( $non_displayables as $regex )
		$data = preg_replace( $regex, '', $data );
		$data = str_replace("'", "''", $data );
		return $data;
	}


			$data['ang-token'] = Input::get('ang-token');
			$data['ang-token'] = ms_escape_string($data['ang-token']);
			session(['token' => $data['ang-token'],
					 'tokenlogin' => 'yes'
					]);
			$data['tps'] = '12';
			$result = DB::select('CALL login_pemilih("'.$data['ang-token'].'","'.$data['tps'].'")');

			//$result =  DB::select('CALL token_generator("'.$tps.'","'.$data['ang'].'")');
			$result = $result[0]->RESULT;

			//return Response::json(['message' => 'Hi. Your request was ajax!', 'verified' => $result[0]->RESULT,'blm' => $data['blm']]);
			//return view()->share('blm',$blm);

			return compact('result');

	}


});

Route::group(['middleware' => 'token'], function () {

	Route::get('/v_bilik',function(){
		Session::forget('tokenlogin');
		$value = session('token');
		$blm = DB::select('CALL pilih_blm("'.$value.'")');
		$countblm = count($blm);
		//$blm = $blm[0]->id_calon;

		return view('v_bilik',compact('countblm','blm'));
	});
	Route::post('/ty',function(){
		if (Request::isMethod('post')) {
			$value = session('token');
			$blm = DB::select('CALL pilih_blm("'.$value.'")');
			$countblm = count($blm);
			$bem = Input::get('pilbem');
			if($countblm==0){
				$blm="0";
			}
			else{
				$blm = Input::get('pilblm');
			}

			$result =  DB::statement('CALL memilih("'.$value.'","'.$bem.'","'.$blm.'")');

			return view('v_ty',compact('bem','blm','value'));

		}

	});
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::post('/superlogin',function(){
	if (Request::isMethod('post') && Auth::check()) {
		$pw1 = Input::get('password1');
		$pw2 = Input::get('password2');
		//$sulogin =  DB::statement('CALL memilih("'.$value.'","'.$bem.'","'.$blm.'")');
	//		if($sulogin[0]->result==true){
				$result =  DB::select('CALL hitung_all()');
				Auth::logout();
				return view('v_suhasil',compact('result'));

	//		}

	}

	});
	Route::get('/gen_token', function(){

		return view('v_gentoken');
	});

	//Route::post('/gen_token','Login@postToken');
	Route::post('/gen_token',function(){

		if(Request::ajax()){
			function ms_escape_string($data) {
		    if ( !isset($data) or empty($data) ) return '';
		    if ( is_numeric($data) ) return $data;

		    $non_displayables = array(
		        '/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
		        '/%1[0-9a-f]/',             // url encoded 16-31
		        '/[\x00-\x08]/',            // 00-08
		        '/\x0b/',                   // 11
		        '/\x0c/',                   // 12
		        '/[\x0e-\x1f]/'             // 14-31
		    );
		    foreach ( $non_displayables as $regex )
		    $data = preg_replace( $regex, '', $data );
		    $data = str_replace("'", "''", $data );
		    return $data;
	    }


	            $data['ang'] = Input::get('angkatan');
	            $data['ang'] = ms_escape_string($data['ang']);
	            $tps = '12';
	            //$data['angkatan']= $request->input('angkatan');
		         //$data['tps'] = $request->input('tps');
		         //$result = DB::statement('CALL sp_get_task_assignment('.$user_id.')');
		         $result =  DB::select('CALL token_generator("'.$tps.'","'.$data['ang'].'")');
		         //return $data['ang'];
	            return $result[0]->token;
	    }
});
// Route::get('/v_pilih',function(){
// 	return view('v_surat');
// });

});
