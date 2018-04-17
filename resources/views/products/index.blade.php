<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<button data-toggle="modal" data-target="#add">ADD NEW</button>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Price</th>
				<th>Content</th>
				<th>Discount</th>
				<th>Image</th>
				<th>Active</th>
			</tr>
		</thead>
		<tbody>
			<input type="hidden" name="flag" id="flag">
			@foreach ($products as $product)
			<tr id="product{{$product['id']}}">
				<td>{{$product['id']}}</td>
				<td>{{$product['name']}}</td>
				<td>{{$product['price']}}</td>
				<td>{{$product['content']}}</td>
				<td>{{$product['discount']}}</td>
				<td>{{$product->created_at->diffForHumans()}}</td>
				<td>
					<a href="javascript:;" class="btn btn-success" onclick="showData({{$product->id}})" data-toggle="modal" data-target="#show" >Show </a>
					<a href="javascript:;" class="btn btn-info" onclick="showData({{$product->id}})" data-toggle="modal" data-target="#editProduct">Sửa</a>	
					<button onclick="alDelete({{$product->id}})" class="btn btn-danger">Xóa</button>
				</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
	<!-- modal show -->

	<div class="modal fade" id="show">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">SHOW DATA</h4>
				</div>
				<div class="modal-body">
						{{csrf_field()}}
						{{method_field('put')}}
					<div class="form-group">
  						<label for="">ID</label>
  						<input type="text" class="form-control" name="id" id="sid" placeholder="Input Name" readonly>
  					</div>
  					<div class="form-group">
  						<label for="">Name</label>
  						<input type="text" class="form-control" name="name" id="sname" placeholder="Input Name">
  					</div>
  					<div class="form-group">
  						<label for="">Price</label>
  						<input type="text" class="form-control" name="price" id="sprice" placeholder="Input Price" >
  					</div>
  					<div class="form-group">
  						<label for="">Content</label>
  						<input type="text" class="form-control" name="content" id="scontent" placeholder="Input Content">
  					</div>
  					<div class="form-group">
  						<label for="">Discount</label>
  						<input type="text" class="form-control" name="discount" id="sdiscount" placeholder="Input Discount">
  					</div>
					
						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>



  <!-- modal add new product -->

  <div class="modal fade" id="add">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  				<h4 class="modal-title">ADD NEW PRODUCT</h4>
  			</div>
  			<div class="modal-body">
  					<form>
  					{{csrf_field()}}
  					<div class="form-group">
  						<label for="">Name</label>
  						<input type="text" class="form-control" name="name" id="name" placeholder="Input Name">
  					</div>
  					<div class="form-group">
  						<label for="">Price</label>
  						<input type="text" class="form-control" name="price" id="price" placeholder="Input Price">
  					</div>
  					<div class="form-group">
  						<label for="">Content</label>
  						<input type="text" class="form-control" name="content" id="content" placeholder="Input Content">
  					</div>
  					<div class="form-group">
  						<label for="">Discount</label>
  						<input type="text" class="form-control" name="discount" id="discount" placeholder="Input Discount">
  					</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  				<button type="submit" class="btn btn-primary" id="addNew">Save changes</button>
  				</form>
  			</div>
  		</div>
  	</div>
  </div>
  <!-- modal edit product -->
 
  	<div class="modal fade" id="editProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">UPDATE PRODUCT</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="{{ asset('product/update') }}">
							{{csrf_field()}}
							{{-- {{method_field('put')}} --}}
							
						<div class="form-group">
	  						<label for="">ID</label>
	  						<input type="hidden" class="form-control" name="id" id="eid" placeholder="Input Name" readonly>
	  					</div>
						<div class="form-group">
	  						<label for="">Name</label>
	  						<input type="text" class="form-control" name="name" id="ename" placeholder="Input Name">
	  					</div>
	  					<div class="form-group">
	  						<label for="">Price</label>
	  						<input type="text" class="form-control" name="price" id="eprice" placeholder="Input Price" >
	  					</div>
	  					<div class="form-group">
	  						<label for="">Content</label>
	  						<input type="text" class="form-control" name="content" id="econtent" placeholder="Input Content">
	  					</div>
	  					<div class="form-group">
	  						<label for="">Discount</label>
	  						<input type="text" class="form-control" name="discount" id="ediscount" placeholder="Input Discount">
	  					</div>
	  					
					</form>
						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit"  class="btn btn-primary edit">Save changes</button>
					
				</div>
			</div>
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   

  <script src="{{ asset('js/sweetalert2.all.js') }}"></script>
  <script src="https://unpkg.com/promise-polyfill@7.1.0/dist/promise.min.js"></script>

<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
{{-- <script src="https://unpkg.com/promise-polyfill@7.1.0/dist/promise.min.js"></script> --}}
<script type="text/javascript">
	$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
	$(function(){
		$('.edit').click(function(){
			updateProduct();
		})
		function updateProduct(){
			console.log($('#eid').val());
			$.ajax({
				type:'post',
				url:"{{asset('product/update') }}",
				data:{
					id:$('#eid').val(),
					name:$('#ename').val(),
					price:$('#eprice').val(),
					content:$('#econtent').val(),
					discount:$('#ediscount').val(),
				},
				success:function (response) {
					console.log(response);
					$('#add').modal('hide');
					var html=
					'<td>'+response.id+'</td>'+
					'<td>'+response.name+'</td>'+
					'<td>'+response.price+'</td>'+
					'<td>'+response.content+'</td>'+
					'<td>'+response.discount+'</td>'+
					'<td>'+response.created_at+'</td>'+
					'<td>'+ 
						'<a href="javascript:;" class="btn btn-success" onclick="showData('+response.id+')" data-toggle="modal" data-target="#show" >Show </a> '+
						' <a href="javascript:;" class="btn btn-info" onclick="showData('+response.id+')" data-toggle="modal" data-target="#editProduct">Sửa</a> '+	
						' <button onclick="alDelete('+response.id+')" class="btn btn-danger">Xóa</button> '+
					'</td>';
				$('#product'+response.id).html(html);
				},error:function(){

				}
			})
		}
	})
	

	$('#addNew').on('click',function(e){
		e.preventDefault();
		$.ajax({
			type:'post',
			url:'product/store',
			data:{
				name:$('#name').val(),
				price:$('#price').val(),
				content:$('#content').val(),
				discount:$('#discount').val(),
			},
			success:function (response) {
				console.log(response);
				$('#add').modal('hide');
				var html='<tr>'+
				'<td>'+response.id+'</td>'+
				'<td>'+response.name+'</td>'+
				'<td>'+response.price+'</td>'+
				'<td>'+response.content+'</td>'+
				'<td>'+response.discount+'</td>'+
				'<td>'+response.created_at+'</td>'+
				'<td>'+ 
					'<a href="javascript:;" class="btn btn-success" onclick="showData('+response.id+')" data-toggle="modal" data-target="#show" >Show </a> '+
					' <a href="javascript:;" class="btn btn-info" onclick="showData('+response.id+')" data-toggle="modal" data-target="#editProduct">Sửa</a> '+	
					' <button onclick="alDelete('+response.id+')" class="btn btn-danger">Xóa</button> '+
				'</td>'+
			'</tr>';
			$(html).insertAfter('#flag');
			},error:function(){

			}
		})
	})	
;
function showData(id){
	path='product/getProduct/'+id;
	$.ajax({
		type:'post',
		url:path,
		success:function(response){
			console.log(response);
			$('#eid').val(response.id);
			$('#ename').val(response.name);
			$('#eprice').val(response.price);
			$('#ediscount').val(response.discount);
			$('#econtent').val(response.content);
			$('#sid').val(response.id);
			$('#sname').val(response.name);
			$('#sprice').val(response.price);
			$('#sdiscount').val(response.discount);
			$('#scontent').val(response.content);
		},
		error:function(){

		}
	})
	
}

function alDelete(id){
	path='product/'+id;
	swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
 	$.ajax({
 		type:'delete',
 		url:path,
 		success:function(response){
 			if (!$.trim(response)) {}
 			$('#product'+id).remove();
	 	swal(
	      'Deleted!',
	      'Your file has been deleted.',
	      'success'
	    )
 		},error:function(){

 		}
 	})
  }
})
}
</script>
<!-- Latest compiled and minified JavaScript -->
</html>