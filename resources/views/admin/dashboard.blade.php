@extends('layouts.app')

@section('content')
<script type="text/javascript">
$(document).ready(function() {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});


$(document).on('click', '.ajax', function(e) {
    e.preventDefault();
    var automobil_id = $(this).data('auto_id');
    var odobren = 1;
      url = '{{route("create")}}';
      $.ajax({
         type: 'GET',
         url:url,
         data:{odobren:odobren, automobil_id:automobil_id},
         success:function(ispis){
           $('#ispisOdobrenja').html(ispis);
         },
         error:function(){
           $('#ispisOdobrenja').html('Desila se neka greska!');
         }
        });
    });
    
$(document).on('click', '.ajaxIzbaci',function(e) {
    e.preventDefault();
    var automobil_id = $(this).data('update_id');
      url = '{{route("update")}}'
      $.ajax({
         type: 'GET',
         url:url,
         data:{automobil_id:automobil_id},
         success:function(ispis){
           $('#ispisOdobrenja').html(ispis);
         },
         error:function(){
           $('#ispisOdobrenja').html('Desila se neka greska!');
         }
        });
    })
});
</script>

<h1>Admin panel</h1>
<div class="col-lg-12">
	<div id="ispisOdobrenja">
		@include('admin.odobravenje')
	</div>
</div>

@endsection