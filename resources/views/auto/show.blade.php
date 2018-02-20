@extends('layouts.app')


@section('content')
<div class="col-lg-12">
	<div class="wrapper row">
		<div class="preview col-md-6">
			
			<div class="preview-pic tab-content">
			  <div class="tab-pane active" id="pic-1"><img class="img-thumbnail" src="{{ $auto->slika }}"></div>
			</div>						
		</div>
		<div class="details col-md-6">
			<h3 class="product-title">{{ $auto->autoIme }}</h3>
			<p class="product-description">Kilometraza:{{ $auto->km }} km</br>
				Godiste:{{ $auto->godiste }}.</br></p>
			<h4>Cena: <span>{{ $auto->cena }}</span></h4></br>
			<h5 class="sizes">Vlasnik:
				<span>{{ $auto->name }}</span>
			</h5>
			<h5 class="colors">Kontakt:
				<span>{{ $auto->email }}</span>
			</h5>
		</div>
	</div>
</div>
@endsection