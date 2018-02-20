@extends('layouts.app')


@section('content')

<div class="col-lg-3">
  <select id="inputKategorija" name="ddKat[]" class="form-control ddKat">
      <option value="">Izaberi...</option>
      @foreach($autoKategorija as $kat)
        <option value="{{ $kat->id }}">{{ $kat->ime }}</option>
      @endforeach
  </select>
</div>

<div class="col-lg-9">
  <div id="ispis">
  @foreach($automobili as $a)    <div class="row">
      <div class="col-lg-4"><img class="img-thumbnail" src="{{ $a->slika }}">
      </div> 
      <div class="col-lg-3">
        <h4 class="product-name"><strong>{{ $a->ime }}</strong></h4><h4><small>{{ $a->godiste }}. | {{ $a->km }} km</small></h4>
      </div>
      <div class="col-lg-5">
        <div class="col-xs-2 text-right">
          <h6><strong>{{ $a->cena }} <span class="text-muted">€</span></strong></h6>
          <h4><small><a class="ml-3" href="{{url('/automobili',  ['/' => $a->autoId])}}">Pogledaj vise...</a></small></h4>
        </div>
      </div>
    </div>
    <hr>
    @endforeach
    
    {{ $automobili->links() }}
   </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
$(".ddKat").on("change", function(e) {
    e.preventDefault();
    var kategorija_id= $('option:selected',this).val();
      url = '{{route("kategorije")}}';
      $.ajax({
         type: 'GET',
         url:url,
         data:{kategorija_id:kategorija_id},
         success:function(ispis){
           $('#ispis').html(ispis);
         },
         error:function(){
           $('#ispis').html('Desila se neka greska!');
         }
        });
    });
    
});
</script>
@endsection

