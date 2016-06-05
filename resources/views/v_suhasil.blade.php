@extends('welcome')

@section('content')

<form class="" >
          	<blockquote class="z-depth-1">Klik <bold>gambar</bold> untuk melihat hasil</blockquote>
		<a class="modal-trigger" href="#hasil"><div id="fotobilik"></div></a>
		<div class="row"></div> <!--spacing-->
        
        </form>


@endsection
@section('modasil')
<div id="hasil" class="modal modal-fixed-footer" style="text-align:center;max-width:940px;">
    <div class="modal-content" >
      <h5>Hasil Pemilihan Ketua <br>HMSI 2016/2017</h5> <br>
		    <ul class="collapsible" data-collapsible="accordion">
		    <li>
		    
		      <div class="collapsible-header"><i class="material-icons">perm_identity</i>Perolehan Suara Ketua HMSI</div>
		      <div class="collapsible-body">
		  		<form>	
		  			<div class="row">
			  			 <div class="col s12">
					        <div class="card-panel grey lighten-5 z-depth-1">
					          <div class="row valign-wrapper">
					            <div class="col s3">
					             <h1>1</h1>
					            </div>
					            <div class="col s6">
					              <span class="black-text">
					                Kandidat nomor (<?php echo $result[0]->urut_calon; ?>)<br><?php echo $result[0]->nama_calon;?>
					              </span>
					            </div>
					            <div class="col s3">
					              <span class="black-text">
					              	<?php echo $result[0]->Jumlah; ?> Suara
					              </span>
					            </div>
					          </div>
					        </div>
		  				</div>
		  			</div>
		  			<div class="row">
			  			 <div class="col s12">
					        <div class="card-panel grey lighten-5 z-depth-1">
					          <div class="row valign-wrapper">
					            <div class="col s3">
					              <h1> 2 </h1>
					            </div>
					            <div class="col s6">
					              <span class="black-text">
					                Kandidat nomor (<?php echo $result[1]->urut_calon; ?>)<br><?php echo $result[1]->nama_calon;?>
					              </span>
					            </div>
					            <div class="col s3">
					              <span class="black-text">
					              	<?php echo $result[1]->Jumlah; ?> Suara
					              </span>
					            </div>
					          </div>
					        </div>
		  				</div>
		  			</div>

		  		</form>
		  	 </div> 
		  	 	
		    </li>
		    <li>
		    
		      <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Perolehan Suara BLM 2013	</div>
		      <div class="collapsible-body">
		  		<form>
		  		<?php
		  		for($i=2;$i < 8; $i++){ 
		  		echo	'<div class="row">';
			  	echo		 '<div class="col s12">';
				echo	        '<div class="card-panel grey lighten-5 z-depth-1">';
				echo	          '<div class="row valign-wrapper">';
				echo	            '<div class="col s3">';
				echo	            '<h1>'.$result[$i]->urut_calon.'</h1>';
				echo	            '</div>';
				echo	            '<div class="col s6">';
				echo	              '<span class="black-text">';
				echo	                'Kandidat nomor ('.$result[$i]->urut_calon.')<br>'.$result[$i]->nama_calon.'';
				echo	              '</span>';
				echo	            '</div>';
				echo	            '<div class="col s3">';
				echo	              '<span class="black-text">';
				echo	              	''.$result[$i]->Jumlah.' Suara';
				echo	              '</span>';
				echo	            '</div>';
				echo	          '</div>';
				echo	        '</div>';
		  		echo		'</div>';
		  		echo	'</div>';
				}
		  		?>
		  			
		  		</form>
		  	 </div> 
		  	 	
		    </li>
			<li>
		    
		      <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Perolehan Suara BLM 2014	</div>
		      <div class="collapsible-body">
		  		<form>	
		  		<?php
		  		for($i=8;$i < 19; $i++){ 
		  		echo	'<div class="row">';
			  	echo		 '<div class="col s12">';
				echo	        '<div class="card-panel grey lighten-5 z-depth-1">';
				echo	          '<div class="row valign-wrapper">';
				echo	            '<div class="col s3">';
				echo	            '<h1>'.$result[$i]->urut_calon.'</h1>';
				echo	            '</div>';
				echo	            '<div class="col s6">';
				echo	              '<span class="black-text">';
				echo	                'Kandidat nomor ('.$result[$i]->urut_calon.')<br>'.$result[$i]->nama_calon.'';
				echo	              '</span>';
				echo	            '</div>';
				echo	            '<div class="col s3">';
				echo	              '<span class="black-text">';
				echo	              	''.$result[$i]->Jumlah.' Suara';
				echo	              '</span>';
				echo	            '</div>';
				echo	          '</div>';
				echo	        '</div>';
		  		echo		'</div>';
		  		echo	'</div>';
				}
		  		?>
		  		
		  		</form>
		  	 </div> 
		  	 	
		    </li>
		  	<li>
		    
		      <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Perolehan Suara BLM 2015	</div>
		      <div class="collapsible-body">
		  		<form>	
		  		<?php
		  		for($i=19;$i < 28; $i++){ 
		  		echo	'<div class="row">';
			  	echo		 '<div class="col s12">';
				echo	        '<div class="card-panel grey lighten-5 z-depth-1">';
				echo	          '<div class="row valign-wrapper">';
				echo	            '<div class="col s3">';
				echo	            '<h1>'.$result[$i]->urut_calon.'</h1>';
				echo	            '</div>';
				echo	            '<div class="col s6">';
				echo	              '<span class="black-text">';
				echo	                'Kandidat nomor ('.$result[$i]->urut_calon.')<br>'.$result[$i]->nama_calon.'';
				echo	              '</span>';
				echo	            '</div>';
				echo	            '<div class="col s3">';
				echo	              '<span class="black-text">';
				echo	              	''.$result[$i]->Jumlah.' Suara';
				echo	              '</span>';
				echo	            '</div>';
				echo	          '</div>';
				echo	        '</div>';
		  		echo		'</div>';
		  		echo	'</div>';
				}
		  		?>
		  		
		  		</form>
		  	 </div> 
		  	 	
		    </li>
		  	
		  		
		   </ul>
		    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
  </div>
<script type="text/javascript">
	$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });



	 });

</script>
@endsection