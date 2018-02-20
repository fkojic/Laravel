@extends('layouts.app')


@section('content')

<form method="GET" action="/pushKategoriju" enctype="multipart/form-data" class="col-lg-8">
  {!! csrf_field() !!}
  <button type="submit" name="btnCreateAuto" class="btn btn-primary">POVUCI SA POLOVNIHAUTOMOBILA.COM</button>
</form>
<div class="col-lg-12">
  <div id="ispisAd">
  @foreach($odobreni as $a)    <div class="row">
      <div class="col-lg-2"><img class="img-thumbnail" src="{{ $a->slika }}">
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
      {{ $odobreni->links() }}
  </div>
</div>

@endsection

