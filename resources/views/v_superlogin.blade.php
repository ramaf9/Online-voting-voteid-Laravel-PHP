@extends('welcome')

@section('content')

<form id="sulogin" class="" role="form" method="POST" action="/superlogin">
          <blockquote class="z-depth-1">SUPERLOGIN</blockquote>
          <div class="row">
          <div class="input-field col l12 m12 s12">
              <input name="password1" id="password1" type="password" autocomplete="off">
              <label for="password1">Password</label>
          </div>
          </div>
          <div class="row">
          <div class="input-field col l12 m12 s12">
              <input name="password2" id="password2" type="password" autocomplete="off">
              <label for="password2">Password</label>
          </div>
          </div>

              <button class="btn waves-effect waves-light btn-large col l12 m12 s12" type="submit" name="submit" style="font-size: 20px"> &nbsp LOGIN &nbsp</button>
        <div class="row"></div> <!--spacing-->
        </form>


@endsection
