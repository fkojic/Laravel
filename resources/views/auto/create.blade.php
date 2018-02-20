@extends('layouts.app')


@section('content')

<form method="POST" action="/createA" enctype="multipart/form-data" class="col-lg-8">
  {!! csrf_field() !!}

  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
  <div class="form-group">
    <label for="inputIme">Ime</label>
    <input type="text" class="form-control" id="inputIme" name="ime" placeholder="BMW 118, Ford fiesta...">
  </div>
  <div class="form-group">
    <label for="inputCena">Cena(€)</label>
    <input type="number" class="form-control" id="inputCena" name="cena" placeholder="1000, 2000...">
  </div>
  <div class="form-group">
    <label for="inputGodiste">Godiste</label>
    <input type="number" class="form-control" id="inputGodiste" name="godiste" placeholder="1990, 2004...">
  </div>
  <div class="form-group">
    <label for="inputKategorija">Kategorija</label>
    <div id="alertKategorija"></div>
    <select id="inputKategorija" name="kategorija_id" class="form-control ddKategorija_id">

      <option selected>Izaberi...</option>
      @foreach($autoKategorija as $kat)
      <option value="{{ $kat->id }}">{{ $kat->ime }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="inputKilometraza" >Kilometraza</label>
    <input type="number" class="form-control" id="inputKilometraza" name="km" placeholder="150000, 200000...">
  </div>
  <div class="form-group">
    <label for="inputSlika" >Slika</label>
    <input type="file" class="form-control" id="inputSlika" name="slika" >
  </div>
  <button type="submit" name="btnCreateAuto" id="btnCreateAuto" class="btn btn-dark">Kreiraj oglas</button>
</form><br>

<script type="text/javascript">
$(document).ready(function() {
$(".ddKategorija_id").on("change", function(e) {
    e.preventDefault();
    var kategorija_id= $('option:selected',this).val();
      if(kategorija_id == 1)
      {
        $('#alertKategorija').html('<div class="alert alert-danger" role="alert">Dodavanje u kategoriji Audi nije dozvoljeno!</div>');
        $("#btnCreateAuto").attr("disabled", true);
      }
      else{
        $('#alertKategorija').html('');
        $("#btnCreateAuto").attr("disabled", false);
      }

    });
    
});
</script>

@endsection