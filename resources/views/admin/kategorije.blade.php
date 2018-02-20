@extends('layouts.app')

@section('content')

<form method="GET" action="/storeKategoriju" class="col-lg-8">
  {!! csrf_field() !!}

  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
  <div class="form-group">
    <label for="inputIme">Ime kategorije:</label>
    <input type="text" class="form-control" id="imeKategorije" name="imeKategorije" placeholder="BMW, Ford, Skoda">
  </div>
  <button type="submit" name="btnCreateAuto" class="btn btn-primary">Potvrdi</button>
</form><br>
<div class="col-lg-12 my-4">
	<div id="ispisKategorija"></div>
	<div class="row">
	@foreach($kategorije as $kat)
		<div class="col-xs-3">
			<button type="button" class="btn btn-primary">
			  {{ $kat->ime }} <span class="badge badge-light obrisiKategoriju" data-kategorija_id='{{ $kat->id }}'>X</span>
			  <span class="sr-only"></span>
			</button>
		</div>
	@endforeach

</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
    
$(".obrisiKategoriju").click(function(e) {
    e.preventDefault();
    var kategorija_id = $(this).data('kategorija_id');
      url = '{{route("destroyKategoriju")}}';
      $.ajax({
         type: 'GET',
         url:url,
         data:{kategorija_id:kategorija_id},
         success:function(ispis){
           $('#ispisKategorija').html('<div class="alert alert-success" role="alert">Uspesno ste izbrisali kategoriju, osvezite kategorije klikom na <a class="nav-link" href="{{url("/createKategoriju")}}">OSVEZI</a>!</div>');
         },
         error:function(){
           $('#ispisKategorija').html('Desila se neka greska!');
         }
        });
    })
});
</script>


@endsection