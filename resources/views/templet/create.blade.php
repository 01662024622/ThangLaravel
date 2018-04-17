<!-- create.blade.php -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Zent Group</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
<body>
  <div class="container">
    <h2>Create A Product</h2><br  />
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div><br />
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success">
      <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <form method="post" action="">
      {{csrf_field()}}
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id='name' name="name" value="{{old('name')}}">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="price">Price:</label>
          <input type="text" class="form-control" id='price' name="price" value="{{old('price')}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="name">Quality:</label>
          <input type="text" class="form-control" id='quality' name="quality" value="{{old('quality')}}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <button type="submit" id="add-product" class="btn btn-success" style="margin-left:38px">Add Product</button>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" charset="utf-8">
  $(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#add-product').on('click',function(e){
      e.preventDefault();
      $.ajax({
        type:'post',
        url:'{{route("products.store")}}',

        data:{
          name:$('#name').val(),
          price:$('#price').val(),
          quality:$('#quality').val(),
        },
        success: function(response){

          setTimeout(function () {
            toastr.success(response.name+'has been added');
            window.location.href="{{route('products.index')}}";
          },1000);
        }, error: function (xhr, ajaxOptions, thrownError) {
          // console.log(xhr.responseJSON.message);
          toastr.error(xhr.responseJSON.message);
          
        },

      })
    });
  })
    // function editUser(id) {
    //   console.log(id);
    //     // $('#editUser').modal('show');

    //     $.ajax({
    //           type: "GET",
    //           url: "products/edit/" + id,

    //           success: function(res)
    //           {
    //             console.log(res);
    //             var result = JSON.parse(res);
    //             console.log(result);
    //             var status = result.status;
    //             if(status){
    //               var data = result.data;
    //               $('#ename').val(data.name);
    //               $('#eprice').val(data.price);
    //               $('#equality').val(data.quality);
    //               $('#user_id').val(id);
    //             }
    //           },
    //           error: function (xhr, ajaxOptions, thrownError) {
    //             toastr.error(thrownError);
    //           }
    //     });

    // }

  </script>
</body>
</html>