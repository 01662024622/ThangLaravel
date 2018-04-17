@extends('layout.adminheader')
@section('css')
<link rel="stylesheet" href="{{asset('css/inputTags.min.css')}}">
<style type="text/css" media="screen">
    .paginate_button{
          color: #fff;
          background-color: #e68f35;
          border-color: #d43f3a;
          padding: 6px;
          border-radius: 5px;
          margin: 2px;
    }
</style>

<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@endsection
@section('content')

<div class="container" style="width:100%">
  <h2>Tags</h2>
  <br />
  <div style="width: 50%;display:inline-block">

   <input type="text" name="tags" id='tagsName' data-role="tagsinput" value="" width="100%" style="display: inline-block;margin: 0 10px;">   
 </div>&nbsp;&nbsp;&nbsp;
 <a href="#" id="StoreBtn" class="btn btn-info" style="display:inline-block">+ Thêm mới </a>
 <br><br>
 <table id="myTable" class="table table-striped">
  <thead class="flg">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @php $count=1 @endphp
    @foreach($tags as $tag)
    <tr id="user_{{$tag['id']}}">

      <td>{{$tag['id']}}</td>
      <td>{{$tag['name']}}</td>
      <td>{{$tag['slug']}}</td>


      <td>

       <a href="javascript:;" onclick="editTag({{$tag['id']}})" class="btn btn-success" data-toggle="modal" data-target="#editTag"><i class="fa fa-edit"></i> Sửa </a>
       <br>
       <br>
       <a  class="btn btn-danger fa fa-trash-o" onclick="alDelete({{$tag['id']}})" type="submit">Delete</a>
     </td>
   </tr>
   @endforeach
 </tbody>
</table>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPost">Cập Nhật Thông Tag</h5>
      </div>
        <form action="" method="POST" role="form" style=" width:100%">
         <div class="form-group">
          <label for="">Name:</label>
          <input type="text" class="form-control" id="ename" placeholder="Nhập Số Name..." name="ename">
        </div>
        <input type="hidden" id="eid" name="eid" value="">
      </form>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" id="UpdateBtn" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>

@endsection
@section('js')
<script src="{{asset('js/inputTags.jquery.min.js')}}"></script>
<script >
  $('#tagsName').inputTags();
$('#etags').inputTags();</script>
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
        url:"{{asset('admin/tags/store')}}",
        data:{
          name:$('#tagsName').val(),
        },
        success:function(response){
         console.log(response);
         for (var i = 0; i < response.length; i++) {
           console.log(response[i].id);
                    if (!response[i].id=="") {
                      console.log(response[i].name);
              setTimeout(function () {
                 toastr.success('Tag "'+response[i].name+'"  has been added');
                    // 
                  },1000);
                  // var data = JSON.parse(response).data;
                  var html=
                  '<tr id="user_'+response[i].id+'">'+

                  '<td>'+response[i].id+'</td>'+
                  '<td>'+response[i].name+'</td>'+
                  '<td>'+response[i].slug+'</td>'+
                  '<td>'+
                  '<a href="javascript:;"  onclick="editPost('+response[i].id+') " class="btn btn-success" data-toggle="modal" data-target="#editPost"  ><i class="fa fa-edit"></i> Sửa </a>'+'<br>'+'<br>'+
                  '<a  class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</a>'
                  +
                  '</td>'+
                  '</tr>';
                  console.log(html);
                  $('tbody').prepend(html);
                  $('.inputTags-item').remove();
                  $("#tagsName").removeAttr( "value" );}else{
                       setTimeout(function () {
                  toastr.error('Tag "'+response[i].name+'" has been exist');
                    // 
                  },1000);
                  }
                  }

                }, error: function (xhr, ajaxOptions, thrownError) {
              
                   setTimeout(function () {
                toastr.error('Tag'+response[i].name+'has been exist');
                  // 
                },1000);

                },

              })
    });


  })


  // get data for form update
  function editTag(id) {
    console.log(id);
        $.ajax({
          type: "GET",
          url: "tags/getData/" + id,

          success: function(response)
          {console.log(response);
            $('#eid').val(response.id);
            $('#ename').val(response.name);         
          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        });

      }
      // Update function
      $('#UpdateBtn').on('click',function(e){
        e.preventDefault();
        console.log($('#ename').val());
        console.log($('#eid').val());
        $.ajax({
          type:'post',
          url: "{{ asset('admin/tags/update') }}",
          data:{
            name:$('#ename').val(),
            id:$('#eid').val(),
          },
          success: function(response){
            console.log(response);
        // var result = JSON.parse(response);
          if (!response.id=="") {
            setTimeout(function () {
              toastr.success(response.name+'has been added');
              // window.location.href="{{route('posts.index')}}";
            },1000);
            
            $('#editTag').modal('hide');
            var html=
            '<td>'+response.id+'</td>'+
            '<td>'+response.name+'</td>'+
            '<td>'+response.slug+'</td>'+
            '<td>'+
            '<a href="javascript:;"  onclick="editTag('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#editTag"  ><i class="fa fa-edit"></i> Sửa </a>' + '<br>'+ '<br>'+
            ' <a class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</button>'+
            '</td>'

            console.log(html);
            $('#user_'+response.id).html(html);
          }else{
            setTimeout(function () {
              toastr.error(response.name+'has been exist');
            },1000);
          }
      }, error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
        toastr.error(xhr.responseJSON.message);
        toastr.error(xhr.responseJSON.message);

      },

    })
      });

      // Delete function
      function alDelete(id){
        console.log(id);
        var path = "tags/" + id;
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
          toastr.error("Thao tác xóa đã bị huỷ bỏ!");
        }
      });
      };

    </script>
    @endsection
  