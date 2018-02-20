
	<ul class="nav nav-pills mb-3 bg-dark navbar navbar-expand-lg" id="pills-tab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link btn btn-danger active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Za odobravanje</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link btn btn-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Odobreni</a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">

	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  	@if(!$automobili)
	  		<div class="alert alert-danger" role="alert">Nema oglasa za oobravanje!</div>
	  	@else
	  	@foreach($automobili as $a)    
		  <div class="row">
		      <div class="col-lg-2"><img class="img-thumbnail" src="{{ $a->slika }}">
		      </div> 
		      <div class="col-lg-3">
		        <h4 class="product-name"><strong>{{ $a->ime }}</strong></h4><h4><small>{{ $a->godiste }}. | {{ $a->km }} km</small></h4>
		      </div>
		      <div class="col-lg-3">
		        <div class="col-xs-2 text-right">
		        	
		          <h6><strong>{{ $a->cena }} <span class="text-muted">€</span></strong></h6>
		        </div>
		        
		      </div>
		      <div class="col-lg-1">
		      	<div class="col-xs-2 text-right ajax" data-auto_id='{{ $a->autoId }}'>
		      		<img class="img-thumbnail" src="uploads/thumbs-up.png">
		      	</div>
		  	  </div>
		    </div>
		    <hr>
    @endforeach
    @endif
	  </div>
	  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
	@foreach($odobreni as $a)    
		  <div class="row">
		      <div class="col-lg-2"><img class="img-thumbnail" src="{{ $a->slika }}">
		      </div> 
		      <div class="col-lg-3">
		        <h4 class="product-name"><strong>{{ $a->ime }}</strong></h4><h4><small>{{ $a->godiste }}, {{ $a->km }}</small></h4>
		      </div>
		      <div class="col-lg-3">
		        <div class="col-xs-2 text-right">
		        	
		          <h6><strong>{{ $a->cena }} <span class="text-muted">€</span></strong></h6>
		        </div>
		        
		      </div>
		      <div class="col-lg-1">
		      	<div class="col-xs-2 text-right ajaxIzbaci" data-update_id='{{ $a->odobreniId }}'>
		      		<img class="img-thumbnail" src="uploads/thumbs-down.png">
		      	</div>
		  	  </div>
		    </div>
		    <hr>
    @endforeach
		</div>
	  </div>
