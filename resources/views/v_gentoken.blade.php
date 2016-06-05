
<form id="gen" method="POST">
            <label>Pilih angkatan</label>
            <select id="angkatan" name="angkatan" onchange="change()">
                <option value='0' disabled="disabled" selected="selected"> </option>
                <option value='15'>2015</option>
                <option value='14'>2014</option>
                <option value='13'>2013</option>
                <option value='12'>2012</option>
                <option value='S0'>S0</option>
            </select>
            <br><br>
            <!--onclick="this.form.submit()"-->
            <button id="gen_token" class="waves-effect waves-light btn-large">
            Generate Token
            </button>  
         <br><br><br>
              <div class="row">

                <div class="input-field col s12">
                  <input id="i_token" type="text" class="validate">
                  <label for="i_token">TOKEN </label>
                </div>
              </div>
            </form>

<script type="text/javascript">
      $(document).ready(function() {
      $('select').material_select();
      });
function change(){
  var e = document.getElementById('angkatan');
  var strUser = e.options[e.selectedIndex].value;
  return strUser.toString();
}
/*$( '#gen' ).submit(function( event ){
   <?php
      if(isset($_POST['angkatan'])) {
        $temp =  $_POST['angkatan'];
        ?>
          document.getElementById("i_token").value = "2015";
        <?php
      }
      else{

      }
    ?>

    event.preventDefault(); 
       
      
  });*/

 $('#gen').on('submit', function(e) {
  var x = change();
  
  if(x != 0){
      $.ajax({
                type: "POST",
                url : "/gen_token",
                data : { 'angkatan':x

                        },
                success : function(data){
                    
                    document.getElementById("i_token").value = data;
                    $('#token label').addClass('active');
                    $('#i_token').prop("readonly", true);
                  },
                
                },
            "html")
        .fail(function(data){
        alert("Generate gagal ! ");
        
       
      })
      }
    else {
      alert("Pilih Angkatan !");
    }
        e.preventDefault();
    });
/*          
    alert("HAHA");
    var x = change();
     alert(x); 
      if(x != 0) {
          
          document.getElementById("i_token").value ="" ;
          $('#token label').addClass('active');

        
        }
      else {  
        alert("HAHA");
      
      }
      



  });*/

      
    </script>