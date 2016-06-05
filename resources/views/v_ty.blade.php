@extends('welcome')

@section('content')

<form>
	<h1>Terimakasih sudah berpartisipasi</h1>


</form>
<p>You will be redirected in <span id="counter">10</span> second(s).</p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = '/';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },700);
</script>
@endsection