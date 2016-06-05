@extends('welcome')

@section('content')
<script type="text/javascript">
$(document).ready(function(){


});
        </script>

<form id="i_token" class="" role="form" method="post" >

          <blockquote class="z-depth-1">Silahkan masukan TOKEN telah diberikan</blockquote>

          <div class="row">
          <div class="input-field col l12 m12 s12">
              <input name="ang-token"id="ang-token" type="text" autocomplete="off">
              <label for="ang-token">TOKEN</label>
          </div>
          </div>
          <br><br><br><br>
              <button class="btn waves-effect waves-light btn-large col l12 m12 s12" type="submit" name="submit" style="font-size: 20px"> &nbsp SUBMIT &nbsp</button>
        <div class="row"></div> <!--spacing-->
</form>

@endsection
