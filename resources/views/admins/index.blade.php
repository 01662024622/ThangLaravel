@extends('layout.adminheader')
@section('css')
<link rel="stylesheet" href="{{asset('css/inputTags.css')}}">
<style>
a, form {
 display: inline-block;
}
</style>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@endsection
@section('content')

<div class="container" style="width:100%">
  <h2>Posts</h2>
  <br />

  <a href="#"  class="btn btn-info" data-toggle="modal" data-target="#create">+ Thêm mới </a>
  <table class="table table-striped">
    <thead class="flg">
      <tr>
        <th>ID</th>
        <th>Avata</th>
        <th>Title</th>
        <th>Description</th>
        <th>Slug</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      <input type="hidden" name="flag" class="flag">
      @php $count=1 @endphp
      @foreach($posts as $post)
      <tr id="user_{{$post['id']}}">

        <td>{{$count++}}</td>
        <td><img src="{{$post['thumbnail']}}" class="img-responsive" alt=""></td>
        <td>{{$post['title']}}</td>
        <td>{{$post['description']}}</td>
        <td>{{$post['slug']}}</td>

        <td>
          <form action="{{asset('admin/posts/show')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="slug" value="{{$post['slug']}}">
          <input type="submit" class="btn btn-info" name="submit" value="Show">
            
          </form>
        
         <br>
         <br>
         @if($post['status']==0)
         <a  class="btn btn-success" onclick="accept({{$post['id']}})" type="submit">Đăng Bài</a>
         <br>
         <br>
         <a href="javascript:;" onclick="alDelt({{$post['id']}})" class="btn btn-danger" data-toggle="modal" data-target="#editPost" ><i class="fa fa-trash-o"></i> Hủy Bài </a>
         @endif
          @if($post['status']==1)
          <a  class="btn btn-success" onclick="accept({{$post['id']}})" type="submit">Đã Đăng Bài</a>
         <br>
         <br>
         <a href="javascript:;" onclick="alDelt({{$post['id']}})" class="btn btn-danger" data-toggle="modal" data-target="#editPost" ><i class="fa fa-trash-o"></i> Hủy Bài </a>
         @endif
           @if($post['status']==2)
           <a  class="btn btn-success" onclick="accept({{$post['id']}})" type="submit">Đăng Bài</a>
         <br>
         <br>
         <a href="javascript:;" onclick="alDelt({{$post['id']}})" class="btn btn-danger" data-toggle="modal" data-target="#editPost" ><i class="fa fa-trash-o"></i> Đã Hủy Bài </a>
         @endif
       </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPost">Thêm Sản Phẩm</h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form" style=" width:100%">

         <div class="form-group">
          <label class="control-label col-sm-2" for="title">Title:</label>
          <div>
            <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
          </div>
          @if ($errors->has('title'))
          <span class="errors">{{$errors->first('title')}}</span>
          @endif
        </div>
        <div class="form-group">
         <label class="control-label col-sm-2" for="description">Description:</label>
         <div>          
          <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
        </div>
        @if ($errors->has('description'))
        <span class="errors">{{$errors->first('description')}}</span>
        @endif
      </div> 
      <div class="form-group">


       @if ($errors->has('content'))
       <span class="errors">{{$errors->first('content')}}</span>
       @endif
       <div>  
         <label class="control-label" for="content">Content:</label>        
         <textarea name="content" id="content" row="10" col="20"></textarea>
       </div>
     </div>  
     <br>
     <div class="form-group">
      <label class="control-label col-sm-2 " for="description">Category:</label>
      <select name="category_id" id="category" style="width: 100%" class="form-control">
        @foreach($categories as $category)
        <option value="{{$category['id']}}">{{$category['name']}}</option>}
        option
        @endforeach
      </select>
    </div>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Avata:</label>
      <input type="file" name="thumbnail" id="thumbnail" value="" placeholder="">
    </div>
    <br>
    <br>
    <br>
    <div class="portlet-title">
     <div class="form-group">        
      <label class="control-label col-sm-2" for="description">Tag:</label>
      <input type="text" name="tags" id='tags' data-role="tagsinput" value="" placeholder="">       
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
<script>
  CKEDITOR.replace( 'content' );
  CKEDITOR.replace( 'econtent' );
  CKEDITOR.editorConfig = function( config ) {
        // Define changes to default configuration here. For example:
        // config.language = 'fr';
        // config.uiColor = '#AADC6E';
        config.width = '400px';

      };
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{asset('js/inputTags.jquery.js')}}"></script>
    <script >$('#tags').inputTags();</script>
    <script >$('#etags').inputTags();</script>
    <script type="text/javascript" charset="utf-8">
      $(function () {
        $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $('#StoreBtn').on('click',function(e){
          var content = CKEDITOR.instances.content.getData();
          console.log($('#thumbnail').val());
          e.preventDefault();
          $.ajax({
            type:'post',
            url:"{{asset('posts/create')}}",
            data:{
              title:$('#title').val(),
              description:$('#description').val(),
              content:content,
              thumbnail:$('#thumbnail').val(),
              category_id:$('#category').val(),
              tags:$('#tags').val(),
            },
            success:function(response){

             console.log(response);
             setTimeout(function () {
              toastr.success('has been added');
              // window.location.href="{{route('posts.index')}}";
              // 
            },1000);
            // var data = JSON.parse(response).data;
            var html=
            '<tr id="user_'+response.id+'">'+
            '<td>'+0+'</td>'+
            '<td>'+response.title+'</td>'+
            '<td>'+response.description+'</td>'+
            '<td>'+response.slug+'</td>'+
            '<td>'+
            '<a href="#" class="btn btn-info">Đang duyệt</a>'+
            '<a href="javascript:;"  onclick="editPost('+response.id+') " class="btn btn-success" data-toggle="modal" dât-target="#editPost"  ><i class="fa fa-trash-o"></i> Sửa </a>' + 
            ' <a class="btn btn-danger" data-id="'+response.id+'" type="submit">Delete</button>'+
            '</td>'+
            '</tr>';
            console.log(html);
            $(html).insertAfter('.flag');
            $('#create').hide();
            
          }, error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            toastr.error(xhr.responseJSON.message);

          },

        })
        });


      })


  // delete post

  $(document).on('click','.btn-danger',function(){
    var id=$(this).data('id');
    var btn=$(this);
    $.ajax({
      type:'delete',
      url:'posts/'+id,
      success:function(response){
        btn.parent().parent().remove();
        toastr.success(response.message);
      }
    });
  });

  // get data for form update
  function editPost(id) {
    console.log(id);
        // $('#editPost').modal('show');

        $.ajax({
          type: "GET",
          url: "posts/edit/" + id,

          success: function(response)
          {console.log(response);
            CKEDITOR.instances.econtent.setData(response.content);
            $('#etitle').val(response.title),
            $('#edescription').val(response.description),
            $('#ethumbnail').val(response.thumbnail),
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
        var content = CKEDITOR.instances.econtent.getData();
        $.ajax({
          type:'post',
          url: "posts/update/" + id,

          data:{
            title:$('#etitle').val(),
            description:$('#edescription').val(),
            content:content,
            thumbnail:$('#ethumbnail').val(),
            category_id:$('#ecategory').val(),
            id:$('#eid').val(),
          },
          success: function(response){
            console.log(response);
        // var result = JSON.parse(response);
        setTimeout(function () {
          toastr.success(response.name+'has been added');
          // window.location.href="{{route('posts.index')}}";
        },1000);
        
        $('#editPost').modal('hide');
        var html=
        '<td>'+response.id+'</td>'+
        '<td>'+response.title+'</td>'+
        '<td>'+response.description+'</td>'+
        '<td>'+response.content+'</td>'+
        '<td>'+response.thumbnail+'</td>'+
        '<td>'+response.post_id+'</td>'+
        '<td>'+response.slug+'</td>'+
        '<td>'+
        '<a href="javascript:;"  onclick="editPost('+response.id+') " class="btn btn-success" data-toggle="modal" dât-target="#editPost"  ><i class="fa fa-trash-o"></i> Sửa </a>' + 
        ' <a class="btn btn-danger" onclick="alDelete('+response.id+')" type="submit">Delete</button>'+
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

      // Delete function
      function alDelete(id){
        console.log(id);
        var path = "posts/" + id;
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
    @endsection
