<!DOCTYPE html>
<html>
<head>
    <title>Pemilihan Umum Ketua HMSI</title>
    <meta charset="utf-8">
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="js/angular.js"></script>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.js"></script> -->
    <link rel="stylesheet" type="text/css" href="css/materialize.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="css/load.css">
    <link rel="stylesheet" type="text/css" href="css/font.css">
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>

    <link rel="icon" href="assets/favico-icon.png" type="image/png" sizes="16x9">

</head>
<body>

@yield('modasil')
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
        <div class="content">
        <!-- welcome -->
        </div>
        </div>
        <div class="col s3 offset-s9" style="float:right;">

        </div>


        <div class="container">
          <header>
            <div class="row">
            <div class="col s12 m4 l2"><img width="80" height="25" src="assets/logo.png"></div>
            <div class="col s12 m4 l8">
                    <p><bold>HMSI</bold> Unlimited Vision Unlimited Creativity<p>
            </div>
            <div class="col s12 m4 l2"><p>Pemilihan Ketua <bold>HMSI 2016/2017<bold></p></div>
            </div>
            <div class="divider z-depth-1"></div>

          </header>
    <main>
    <div class="double-bounce1 double-bounce2" id="spinner"></div>
        @yield('content')

<div id="token" style="display:none">
    <form id="v_bilik" method="POST" action="ty" style="display:none">

    	<blockquote class="z-depth-1">Klik <bold>gambar</bold> untuk mulai memilih</blockquote>
    	<a class="modal-trigger" href="#bilik"><div id="fotobilik"></div></a>
    	<br><br>
    	<input name="pilbem" id="bems" type="hidden" value="" />
    	<input name="pilblm" id="blms" type="hidden" value="" />

    	<script type="text/javascript">
        $(document).ready(function(){
        var blm = null;
        var bem = null;

    	 $('#v_bilik').on('submit', function(e) {

    		bem = $('input[name="pilbem"]:checked').val();
    		blm = $('input[name="pilblm"]:checked').val();
    		document.getElementById('bems').value = bem;
    		document.getElementById('blms').value = blm;

    		if(blm==null || bem==null){
    	    	e.preventDefault();
    	    	alert("Mohon maaf anda harus memilih :)");

        		}

    	 	});
    	 		});
    	</script>
    	<button class="btn waves-effect waves-light btn-large col l12 m12 s12" type="submit" style="font-size: 20px"> &nbsp SUBMIT &nbsp</button>
    </form>


</div>

    </main>
    <footer>
    <div class="divider z-depth-1"></div>
        <p>Copyright <bold>2015</bold></p>
        <div class="row>">
        <div class="col s3">
            <!-- <img width="25" height="25" src="assets/blm.gif">
            <img width="25" height="25" src="assets/unair.gif">
            <img width="25" height="25" src="assets/kprf.png"> -->
        </div>
        </div>
    </footer>


</div>
</body>
 <div class="mod"></div>
 <script type="text/javascript">
 	$(document).ready(function(){
     // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
     $('.modal-trigger').leanModal();

     $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
     });



 	 });

 </script>

</html>
