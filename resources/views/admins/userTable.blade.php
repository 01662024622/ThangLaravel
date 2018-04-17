@extends('layout.adminheader')
@section('content')

<div class="container" style="width:100%">
  <h2>users</h2>
  <br />

  <a href="#"  class="btn btn-info" data-toggle="modal" data-target="#create">+ Thêm mới </a>
  <br><br>
  <table id="myTable" class="table table-striped">
    <thead class="flg">
      <tr>
        <th>ID</th>
        <th>Avata</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php $count=1 @endphp
      @foreach($users as $user)
      <tr id="user_{{$user['id']}}">

        <td>{{$count++}}</td>
        <td><img src="{{ $user['avata']}}" class="img img-responsive" width="100px" alt=""></td>
        <td>{{$user['name']}}</td>
        <td>{!! $user['email'] !!}</td>
        <td>{!! $user['phone'] !!}</td>
        <td>{!! $user['address'] !!}</td>
        

        <td>
         <a href="javascript:;" onclick="edituser({{$user['id']}})" class="btn btn-success" data-toggle="modal" data-target="#edituser" ><i class="fa fa-edit"></i> Sửa </a>
         <br>
         <br>
         <a  class="btn btn-danger fa fa-trash-o" onclick="alDelete({{$user['id']}})">Delete</a>
       </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edituser">Cập Nhật Thông Tin User</h5>
      </div>
      <div class="modal-body">
        <form action="" method="user" role="form" id="editUser" style=" width:100%" enctype="multipart/form-data">
      <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <input type="text" class="form-control" id="ename" placeholder="Enter name" name="ename">
        @if ($errors->has('name'))
        <span class="errors">{{$errors->first('name')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>       
        <input type="text" class="form-control" id="eemail" placeholder="Enter email" name="eemail">
        @if ($errors->has('email'))
        <span class="errors">{{$errors->first('email')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="description">Avata:</label>
        <img id="imgFile" class="img img-responsive" width="80%" alt="">
        <input type="file" name="image" id="editfile" onchange="loadFile(event)">
      </div>
      <div class="form-group">
        @if ($errors->has('phone'))
        <span class="errors">{{$errors->first('phone')}}</span>
        @endif
        <label class="control-label" for="phone">Phone:</label>        
        <input type="tel" name="ephone"  class="form-control" id="ephone" value="" placeholder="">
      </div>
      <div class="form-group">
       <label class="control-label col-sm-2" for="name">Address:</label>
       <input type="text" class="form-control" id="eaddress" placeholder="Enter address" name="eaddress">
       @if ($errors->has('name'))
       <span class="errors">{{$errors->first('name')}}</span>
       @endif
     </div>
     <input type="hidden" name="eid" id="eid">
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" id="UpdateBtn" class="btn btn-primary">Save changes</button>
    </div> 
  </form>
</div>

</div>
</div>
</div>
<!-- Modal add -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edituser">Thêm User</h5>
      </div>
      <div class="modal-body">
      <form action="" method="post" id="addUser" style=" width:100%" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        @if ($errors->has('name'))
        <span class="errors">{{$errors->first('name')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>       
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
        @if ($errors->has('email'))
        <span class="errors">{{$errors->first('email')}}</span>
        @endif
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="description">Avata:</label>
        <img id="imgCreate" class="img img-responsive" width="80%" alt="">
        <input type="file" name="image" id="file" onchange="loadFileC(event)">
      </div>
      <div class="form-group">
        @if ($errors->has('phone'))
        <span class="errors">{{$errors->first('phone')}}</span>
        @endif
        <label class="control-label" for="phone">Phone:</label>        
        <input type="tel" name="phone"  class="form-control" id="phone" value="" placeholder="">
      </div>
      <div class="form-group">
       <label class="control-label col-sm-2" for="name">Address:</label>
       <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
       @if ($errors->has('name'))
       <span class="errors">{{$errors->first('name')}}</span>
       @endif
     </div>
    <div class="portlet-title">
      <div class="form-group">        
        <label class="control-label col-sm-2" for="description">Password:</label>
        <input type="password"  class="form-control" name="password" id='password' placeholder=""> 
      </div>
    </div> 
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" id="StoreBtn" class="btn btn-primary">Save changes</button>
    </div> 
  </form>
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript" charset="utf-8">
  $(function () {
    $.ajaxSetup({

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    })
  $('#phone').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
})
  $('#ephone').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
})
    $('#StoreBtn').click(function(e){
      e.preventDefault();
      var file = $('#file').get(0).files[0];
      var newUser = new FormData();
      newUser.append('name', $('#name').val());
      newUser.append('phone', $('#phone').val());
      newUser.append('email', $('#email').val());
      newUser.append('address', $('#address').val());
      newUser.append('password', $('#password').val());
      newUser.append('image', file);
    // console.log($('password').val());
      $.ajax({
        
        url:'{{asset('admin/users/store')}}',
        data:newUser,
        dataType:'json',
        async:false,
        type:'post',
        processData: false,
        contentType: false,
        success:function(response){
         console.log(response);
         setTimeout(function () {
           toastr.success('has been added');
                  // window.location.href="{{route('users.index')}}";
                  // 
                },1000);
                // var data = JSON.parse(response).data;
                var html=
                '<tr id="user_'+response.id+'">'+

                '<td>'+'#'+'</td>'+
                '<td><img src="'+response.avata+'" class="img img-responsive" width="100px" alt="">'+'</td>'+
                '<td>'+response.name+'</td>'+
                '<td>'+response.email+'</td>'+
                '<td>'+response.phone+'</td>'+
                '<td>'+response.address+'</td>'+
                '<td>'+
                '<a href="javascript:;" onclick="edituser('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#edituser"><i class="fa fa-edit"></i> Sửa </a>'+'<br>'+'<br>'+
                '<a  class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" >Delete</a>'+
                '</td>'+
                '</tr>';
                console.log(html);
                $('tbody').prepend(html);
                $('#create').modal('hide');

              }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.message);

              },

            })
    });




  // delete user


  // get data for form update
  
      // Update function
      $('#UpdateBtn').on('click',function(e){
       e.preventDefault();
      var file = $('#editfile').get(0).files[0];
      var editUser = new FormData();
      editUser.append('name', $('#ename').val());
      editUser.append('phone', $('#ephone').val());
      editUser.append('email', $('#email').val());
      editUser.append('address', $('#eaddress').val());
      editUser.append('id', $('#eid').val());
      editUser.append('image', file);
    // console.log($('password').val());
      $.ajax({
        
        url:'{{asset('admin/users/update')}}',
        data:editUser,
        dataType:'json',
        async:false,
        type:'post',
        processData: false,
        contentType: false,
          success: function(response){
            console.log(response);
        // var result = JSON.parse(response);
        setTimeout(function () {
          toastr.success(response.name+'has been added');
          // window.location.href="{{route('users.index')}}";
        },1000);
        
        $('#edituser').modal('hide');
        var html=
        '<td>'+'#'+'</td>'+
                '<td><img src="'+response.avata+'" class="img img-responsive" width="100px" alt="">'+'</td>'+
                '<td>'+response.name+'</td>'+
                '<td>'+response.email+'</td>'+
                '<td>'+response.phone+'</td>'+
                '<td>'+response.address+'</td>'+
        '<td>'+
        '<a href="javascript:;" onclick="edituser('+response.id+')" class="btn btn-success" data-toggle="modal" data-target="#edituser" ><i class="fa fa-edit"></i> Sửa </a>' + '<br>'+'<br>'+
        ' <a class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</button>'+
        '</td>'

        console.log(html);
        $('#user_'+response.id).html(html);
      }, error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
        toastr.error(xhr.responseJSON.message);
        toastr.error(xhr.responseJSON.message);

      },

    })
      });

function edituser(id) {
    console.log(id);
        // $('#edituser').modal('show');

        $.ajax({
          type: "GET",
          url: "users/edit/" + id,

          success: function(response)
          {console.log(response);
            $('#ename').val(response.name);
            $('#eemail').val(response.email);
            $('#ephone').val(response.phone);
            $('#eaddress').val(response.address);        
            $('#eid').val(response.id);
            $("#imgFile").attr("src",response.avata);         
          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        });

      }
      // Delete function
      function alDelete(id){
        console.log(id);
        
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
        var path = "users/" + id;
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
          toastr.error("Thao tác xóa đã bị huỷ bỏ!");
        }
      });
      }
  

    </script>
    @endsection
