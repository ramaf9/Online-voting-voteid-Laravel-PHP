@extends('welcome')

@section('content')

<form id="login" class="" role="form" method="POST" action="">
          <blockquote class="z-depth-1">Silahkan Login Menggunakan User dan Pass yang Telah Diberikan</blockquote>
          <div class="row">
          <div class="input-field col l12 m12 s12">
              <input name="user_admins" id="user_admins" type="text" autocomplete="off">
              <label for="user_admins">Username</label>
          </div>
          </div>
          <div class="row">
          <div class="input-field col l12 m12 s12">
              <input name="password" id="password" type="password" autocomplete="off">
              <label for="password">Password</label>
          </div>
          </div>

              <button class="btn waves-effect waves-light btn-large col l12 m12 s12" type="submit" name="submit" style="font-size: 20px"> &nbsp LOGIN &nbsp</button>
        <div class="row"></div> <!--spacing-->
        </form>


@endsection
