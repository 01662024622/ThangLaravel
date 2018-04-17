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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- Bootstrap JavaScript -->
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
    <h2>Categories</h2>
    <br />
    <a href="javascript:;"  class="btn btn-info" data-toggle="modal" data-target="#create">+ Thêm mới </a>
    <table class="table table-striped">
      <thead class="flg">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Parent_ID</th>
          <th>Slug</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <input type="hidden" name="flag" class="flag">
        @foreach($categories as $category)
        <tr id="user_{{$category['id']}}">
          <td>{{$category['id']}}</td>
          <td>{{$category['name']}}</td>
          <td>{{$category['parent_id']}}</td>
          <td>{{$category['slug']}}</td>
          <td>

            <a href="javascript:;" onclick="editCategory({{$category['id']}})" class="btn btn-success" data-toggle="modal" data-target="#editCategory" ><i class="fa fa-trash-o"></i> Sửa </a>
            
            <a  class="btn btn-danger" onclick="alDelete({{$category['id']}})" type="submit">Delete</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCategory">Cập Nhật Thông Tin Sản Phẩm</h5>
        </div>
        <div class="modal-body">
          <form action="" method="post" role="form" style=" width:100%">

            <div class="form-group">
              <label for="">Name:</label>
              <input type="text" class="form-control" id="ename" placeholder="Nhập Tên Sản Phẩm...." name="name">
            </div> 
            <div class="form-group">
              <label for="">Parent_ID:</label>
              <input type="text" class="form-control" id="eparent_id" placeholder="Nhập Tên Sản Phẩm...." name="name">
            </div>
            <div class="form-group">
              <label for="">Slug:</label>
              <input type="text" class="form-control" id="eslug" placeholder="Nhập Số Lượng" name="email">
            </div>

            <input type="hidden" id="eid" name="eid" value="">
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
          <h5 class="modal-title" id="create">Thêm Sản Phẩm</h5>
        </div>
        <div class="modal-body">
          <form action="" method="post" role="form" style=" width:100%">

            <div class="form-group">
              <label for="">Name:</label>
              <input type="text" class="form-control" id="name" placeholder="Nhập Tên Sản Phẩm...." name="name">
            </div>
            <div class="form-group">
              <label for="">Parent_ID:</label>
              <input type="text" class="form-control" id="parent_id" placeholder="Nhập Tên Sản Phẩm...." name="name">
            </div>
            <div class="form-group">
              <label for="">Slug:</label>
              <input type="text" class="form-control" id="slug" placeholder="Nhập Số Lượng" name="email">
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
          url:'{{route("categories.store")}}',

          data:{
            name:$('#name').val(),
            parent_id:$('#parent_id').val(),
            slug:$('#slug').val(),
            
          },

          success: function(response){

            setTimeout(function () {
              toastr.success(response.name+'has been added');
              // window.location.href="{{route('categories.index')}}";
              // 
            },1000);
            
            $('#create').modal('hide');
            var html=
            '<tr id="user_'+response.id+'">'+
            '<td>'+response.id+'</td>'+
            '<td>'+response.name+'</td>'+
            '<td>'+response.parent_id+'</td>'+
            '<td>'+response.slug+'</td>'+
            '<td>'+
            '<a href="javascript:;"  onclick="editCategory('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#editCategory"  ><i class="fa fa-trash-o"></i> Sửa </a>' + 
            ' <a class="btn btn-danger" onclick="alDelete('+response.id+')" type="submit">Delete</button>'+
            '</td>'+
            '</tr>'
            console.log(html);
            $(html).insertAfter('.flag');
            setTimeout(function () {

            });
          }, error: function (xhr, ajaxOptions, thrownError) {
          }, error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            dd($data);
            toastr.error(xhr.responseJSON.message);

          },

        })
      });


    })


  // delete Category

  // $(document).on('click','.btn-danger',function(){
  //   var id=$(this).data('id');
  //   var btn=$(this);
  //   $.ajax({
  //     type:'delete',
  //     url:'Categorys/'+id,
  //     success:function(response){
  //       btn.parent().parent().remove();
  //       toastr.success(response.message);
  //     }
  //   });
  // });

  // get data for form update
  function editCategory(id) {
    console.log(id);
        // $('#editCategory').modal('show');

        $.ajax({
          type: "GET",
          url: "categories/edit/" + id,

          success: function(response)
          {
            
            $('#ename').val(response.name),
            $('#eparent_id').val(response.parent_id),
            $('#eslug').val(response.slug),
            $('#eid').val(response.id)         
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
          url: "categories/update/" + id,

          data:{
            id:$('#eid').val(),
            name:$('#ename').val(),
            parent_id:$('#eparent_id').val(),
            slug:$('#eslug').val(),
            
          },
          success: function(response){
            console.log(response);
        // var result = JSON.parse(response);
        setTimeout(function () {
          toastr.success(response.name+'has been added');
       },1000);
        
        $('#editCategory').modal('hide');
        var html=
        '<td>'+response.id+'</td>'+
        '<td>'+response.name+'</td>'+
        '<td>'+response.parent_id+'</td>'+
        '<td>'+response.slug+'</td>'+
        '<td>'+
        '<a href="javascript:;"  onclick="editCategory('+response.id+'" class="btn btn-success" data-toggle="modal" data-target="#editCategory"  ><i class="fa fa-trash-o"></i> Sửa </a>'+
        '<a class="btn btn-danger" onclick="alDelete('+response.id+')" type="submit">Delete</button>'+
        '</td>'
        console.log(html);
        $('#user_'+response.id).html(html);
      }, error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr);
          toastr.error(xhr.responseJSON.message);
          // toastr.error(xhr.responseJSON.errors.quality[0]);
          
        },

      })
      });

      // Delete function
      function alDelete(id){
        console.log(id);
        var path = "categories/" + id;
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
