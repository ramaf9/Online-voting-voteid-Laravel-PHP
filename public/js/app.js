var main = function(){

$(window).load(function() {
setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','#222222');
    }, 2000);    });

  $( '#login' ).submit(function( event ) {
  event.preventDefault();
  	$("#spinner").show();

	$( "#login" ).fadeOut( "slow", function() {
    setTimeout(function(){ $.post('/auth/login',$("#login").serialize())
      .done(function(data){
      $('#token').load('/gen_token');

      })
      .fail(function(data){
        alert("Username atau Password salah !");

        $('#login').fadeIn("fast");

      })
     //$('#token').load('/auth/login');
      $("#spinner").hide();$('#token').fadeIn("slow"); }, 1000);

  });
});
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


    /*$( '#i_token').submit(function(event){
 	event.preventDefault();
 	$("#spinner").show();
	$( "#i_token" ).fadeOut( "slow", function() {
    setTimeout(function(){ $.post('/v_pilih',$("#i_token").serialize())
      .done(function(data){
        if(data==true){
         $('#token').load('/v_pilih');$('.mod').load('/v_bilik');$("#spinner").hide();$('#token').fadeIn("slow");
        }
        else{
          alert("Token anda salah");
        }

//
      })
      .fail(function(data){
          alert("Token anda salah");
      })
}, 1000);

  });
  });*/
  $( '#i_token').submit(function(event){
  event.preventDefault();
  var x = $('#ang-token').val();
  $("#spinner").show();
  $( "#i_token" ).fadeOut( "slow", function() {
    setTimeout(function(){ $.ajax({
                type: "POST",
                url : "/v_pilih",
                data : { 'ang-token':x

                        },
                success : function(data){
                    console.log(data['result']);
                    if(data['result']==0){
                      $('.mod').load('/v_bilik',function(){
                        $("#spinner").hide();$('#token').fadeIn("fast");$('#v_bilik').fadeIn("slow");
                      });
                      }
                    else{
                        alert("Token anda salah atau sudah digunakan");
                        $("#spinner").hide();
                        $("#i_token").fadeIn("fast");
                      }
                    },

                },
            "html")
      .fail(function(data){
          alert("Token anda salah");
          $("#spinner").hide();
          $("#i_token").fadeIn("fast");
      })
}, 1000);

  });
  });


};

$(document).ready(main);
