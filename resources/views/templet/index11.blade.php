<!-- index.blade.php -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Thang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

  <script src="//code.jquery.com/jquery.js"></script>

  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
  <style>
  a, form {
   display: inline-block;
 }
</style>
</head>
<body>
  <div class="container">
    <h2>Products</h2>
    <br />
    <a href="javascript:;"  class="btn btn-info" data-toggle="modal" data-target="#create">+ Thêm mới </a>
    <table class="table table-striped">
      <thead class="flg">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quality</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <input type="hidden" name="flag" class="flag">
        @foreach($products as $product)
        <tr id="user_{{$product['id']}}">
          <td>{{$product['id']}}</td>
          <td>{{$product['name']}}</td>
          <td>{{$product['price']}}</td>
          <td>{{$product['quality']}}</td>
          <td>

            <a href="javascript:;"  onclick="editUser({{$product['id']}})" class="btn btn-success" data-toggle="modal" data-target="#editUser"  ><i class="fa fa-trash-o"></i> Sửa </a>
            
            <a  class="btn btn-danger" onclick="alDelete({{$product['id']}})" type="submit">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUser">Cập Nhật Thông Tin Sản Phẩm</h5>
        </div>
        <div class="modal-body">
          <form action="" method="POST" role="form" style=" width:100%">

            <div class="form-group">
              <label for="">Tên Sản Phẩm:</label>
              <input type="text" class="form-control" id="ename" placeholder="Nhập Tên Sản Phẩm...." name="name">
            </div>
            <div class="form-group">
              <label for="">Giá Sản Phẩm:</label>
              <input type="text" class="form-control" id="eprice" placeholder="Nhập Giá Sản Phẩm...." name="mobile">
            </div>
            <div class="form-group">
              <label for="">Số Lượng:</label>
              <input type="text" class="form-control" id="equality" placeholder="Nhập Số Lượng" name="email">
            </div>

            <input type="hidden" class="form-control" id="eid">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="UpdateBtn" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal add -->
  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUser">Thêm Sản Phẩm</h5>
        </div>
        <div class="modal-body">
          <form action="" method="POST" role="form" style=" width:100%">

            <div class="form-group">
              <label for="">Tên Sản Phẩm:</label>
              <input type="text" class="form-control" id="name" placeholder="Nhập Tên Sản Phẩm...." name="name">
            </div>
            <div class="form-group">
              <label for="">Giá Sản Phẩm:</label>
              <input type="text" class="form-control" id="price" placeholder="Nhập Giá Sản Phẩm...." name="mobile">
            </div>
            <div class="form-group">
              <label for="">Số Lượng:</label>
              <input type="text" class="form-control" id="quality" placeholder="Nhập Số Lượng" name="email">
            </div>


          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="StoreBtn" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" charset="utf-8">
    $(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#StoreBtn').on('click',function(e){
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
              // window.location.href="{{route('products.index')}}";
              // 
            },1000);
            var data = JSON.parse(response).data;
            $('#create').modal('hide');
            var html=
            '<tr id="user_'+data.id+'">'+
            '<td>'+data.id+'</td>'+
            '<td>'+data.name+'</td>'+
            '<td>'+data.price+'</td>'+
            '<td>'+data.quality+'</td>'+
            '<td>'+
            '<a href="javascript:;"  onclick="editUser('+data.id+') " class="btn btn-success" data-toggle="modal" data-target="#editUser"  ><i class="fa fa-trash-o"></i> Sửa </a>' + 
            ' <a class="btn btn-danger" data-id="'+data.id+'" type="submit">Delete</button>'+
            '</td>'+
            '</tr>'
            console.log(html);
            $(html).insertAfter('.flag');
            setTimeout(function () {

            });
          }, error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            toastr.error(xhr.responseJSON.message);

          },

        })
      });


    })


  // delete product

  $(document).on('click','.btn-danger',function(){
    var id=$(this).data('id');
    var btn=$(this);
    $.ajax({
      type:'delete',
      url:'products/'+id,
      success:function(response){
        btn.parent().parent().remove();
        toastr.success(response.message);
      }
    })
  })

  // get data for form update
  function editUser(id) {
    console.log(id);
        // $('#editUser').modal('show');

        $.ajax({
          type: "GET",
          url: "products/edit/" + id,

          success: function(res)
          {
            console.log(res);
            
           
            
              
              $('#ename').val(res.name);
              $('#eprice').val(res.price);
              $('#equality').val(res.quality);
              $('#eid').val(id);
            
          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        });

      }
      // Update function
      $('#UpdateBtn').on('click',function(e){
        e.preventDefault();
        var id=$('#eid').val();

        $.ajax({
          type:'post',
          url: "products/update/" + id,

          data:{
            id:$('#eid').val(),
            name:$('#ename').val(),
            price:$('#eprice').val(),
            quality:$('#equality').val(),
          },
          success: function(response){
            console.log(response);
        // var result = JSON.parse(response);
        setTimeout(function () {
          toastr.success(response.name+'has been added');
          // window.location.href="{{route('products.index')}}";
        },1000);
        var data = JSON.parse(response).data;
        $('#editUser').modal('hide');
        var html=
        '<td>'+data.id+'</td>'+
        '<td>'+data.name+'</td>'+
        '<td>'+data.price+'</td>'+
        '<td>'+data.quality+'</td>'+
        '<td>'+
        '<a href="javascript:;"  onclick="editUser('+data.id+'" class="btn btn-success" data-toggle="modal" data-target="#editUser"  ><i class="fa fa-trash-o"></i> Sửa </a>'+
        '<a class="btn btn-danger" data-id="'+data.id+'" type="submit">Delete</button>'+
        '</td>'
        console.log(html);
        $('#user_'+data.id).html(html);
      }, error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr);
          toastr.error(xhr.responseJSON.errors.price[0]);
          toastr.error(xhr.responseJSON.errors.quality[0]);
          
        },

      })
      });

      // Delete function
      function alDelete(id){
        console.log(id);
        var path = "products/" + id;
        swal({
          title: "Bạn có chắc muốn xóa?",
        // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Không",
        confirmButtonText: "Có",
        // closeOnConfirm: false,
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "delete",
            url: path,
            success: function(res)
            {
              
              if(!res.error) {
                toastr.success('Xóa thành công!');
                $('#user_'+id).remove();
                  //setTimeout(function () {
                    //location.reload();
                  //}, 1000)
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
            });
        } else {
          toastr.info("Thao tác xóa đã bị huỷ bỏ!");
        }
      });
      };
    </script>
  </body>
  </html>
