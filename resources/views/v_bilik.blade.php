

<div id="bilik" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h5>Pemilihan CAKAHIMA <br>Sistem Informasi 2016/2017</h5> <br>
		    <ul class="collapsible" data-collapsible="accordion">
		    <li>

		      <div class="collapsible-header">Pilih CAKAHIMA</div>
		      <div class="collapsible-body">
		  		<form>
		  			<div class="row">
			  			<div class="col s4">
			  			<br>
			  			<img src="{{url()}}/assets/bem1.png" class="circle responsive-img">
			  			</div>
			  			<div class="col s6">
			  				<p>Nama	: M. Ammar Fauzan</p>
			  				<p>NRP	: 5214100147</p>
			  			</div>
			  			<div class="col s2">
			  			<p><input name="pilbem" type="radio" id="bem1" value="1" />
	    				<label for="bem1">vote</label>
	  					</p>
  						</div>
		  			</div>
		  			<div class="row">
			  			<div class="col s4">
			  			<br>
			  			<img src="{{url()}}/assets/bem2.png" class="circle responsive-img">
			  			</div>
			  			<div class="col s6">
			  				<p>Nama	: Calvin Rostanto</p>
			  				<p>NRP	: 5214100158</p>
			  			</div>
			  			<div class="col s2">
			  			<p><input name="pilbem" type="radio" id="bem2" value="2" />
	    				<label for="bem2">vote</label>
	  					</p>
	  					</div>
		  			</div>
		  			<div class="row">
			  			<div class="col s4">
			  			<br>
			  			<img src="{{url()}}/assets/bem3.png" class="circle responsive-img">
			  			</div>
			  			<div class="col s6">
			  				<p>Nama	: Dwi Devitasari W.</p>
			  				<p>NRP	: 5214100006</p>
			  			</div>
			  			<div class="col s2">
			  			<p><input name="pilbem" type="radio" id="bem3" value="3" />
	    				<label for="bem3">vote</label>
	  					</p>
	  					</div>
		  			</div>

		  		</form>
		  	 </div>

		    </li>

		    <?php
		  		if($countblm==0){
		 		echo '<input name="pilblm" type="radio" id="blm0" value="0" style="display:none" />';
		 		echo '<script>radiobtn = document.getElementById("blm0");
					radiobtn.checked = true;</script>';

		  		}
		  		else{
		  		echo 	'<li>';
		  		echo	'<div class="collapsible-header"><i class="material-icons">supervisor_account</i>Pilih Anggota BLM</div>';
		        echo    '<div class="collapsible-body">';
		  		echo    '<form>';
			  		for($i=0;$i < $countblm; $i++){


			  		echo '<div class="row">';
				  	echo	'<div class="col s4"><br>';?>
				  			 <img src="{{url()}}<?php echo $blm[$i]->photopath_calon ?>" class="circle responsive-img">
			<?php 	echo	'</div>';
				  	echo	'<div class="col s6">';
				  	echo		'<p>('.$blm[$i]->urut_calon.')'.$blm[$i]->nama_calon.'</p>';
				  	echo	'</div>';
				  	echo	'<div class="col s2">';
				  	echo	'<p><input name="pilblm" type="radio" id="blm'.$blm[$i]->urut_calon.'" value="'.$blm[$i]->id_calon.'" />';
		    		echo	'<label for="blm'.$blm[$i]->urut_calon.'">vote</label>';
		  			echo	'</p>';
	  				echo	'</div>';
			  		echo  '</div>';

			  		}
			  	echo '</form></div></li>';
			  	}
		  		?>


		   </ul>
		    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
  </div>
  <script type="text/javascript">
  $('.collapsible').collapsible({
    accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
  });
  </script>
