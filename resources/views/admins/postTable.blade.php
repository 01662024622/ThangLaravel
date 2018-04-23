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
  <h2>Posts</h2>
  <br />

  <a href="#"  class="btn btn-info" data-toggle="modal" data-target="#create">+ Create A New Post </a>
  <br><br>
  <table id="myTable" class="table table-striped">
    <thead class="flg">
      <tr>
        <th>ID</th>
        <th>Avata</th>
        <th>Title</th>
        <th>Updated_at</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php $count=1 @endphp
      @foreach($posts as $post)
      <tr id="user_{{$post['id']}}">

        <td>{{$count++}}</td>
        <td><img src="{{$post['image']}}" class="img img-responsive" width="200px" alt=""></td>
        <td>{{$post['title']}}</td>
        <td>{!! $post['updated_at']->diffForHumans() !!}</td>
        <td>
          <a href="#" class="btn btn-primary" href="javascript:;" onclick="getStatus({{$post['id']}})" data-toggle="modal" data-target="#changeStatus">Change Status</a>

         <br><br>
          @if($post['status']==0)
         <a href="#" class="btn btn-info"> Browsing</a>
         @endif
         @if($post['status']==1)
         <a href="#" class="btn btn-success"> Posted</a>
         @endif
         @if($post['status']==2)
         <a href="#" class="btn btn-danger"> Cancelled</a><br><br>
         <a href="javascript:;" onclick="getReason({{$post['id']}})" data-toggle="modal" data-target="#reason" class="btn btn-warning fa fa-exclamation-circle"> Reason</a>
         @endif</td>
        <td>
          <a class="btn btn-primary fa fa-eye" onclick="showPost({{$post['id']}})" data-toggle="modal" href='#showPost'> Show</a>
          <br><br>
          <a href="javascript:;" onclick="editPost({{$post['id']}})" class="btn btn-success" data-toggle="modal" data-target="#editPost" ><i class="fa fa-wrench"></i> Repair </a>
         <br>
         <br>
         <a  class="btn btn-danger fa fa-trash-o" onclick="alDelete({{$post['id']}})" type="submit"> Delete</a>
       </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPost">UPDATE POST</h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form" style=" width:100%">

          <div class="form-group">
            <label for="">Title:</label>
            <input type="text" class="form-control" id="etitle" placeholder="Please Enter A Title ...." name="name">
            @if ($errors->has('title'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">Description:</label>
            <input type="text" class="form-control" id="edescription" placeholder="Please Enter A Price...." name="mobile">
          </div>
          <div class="form-group" id="econtentdiv">
           <div>  
             <label class="control-label" for="econtent">Content:</label>        
             <textarea name="econtent" id="econtent" row="10" col="20"></textarea>
           </div>
         </div>  
         <div class="form-group">
            <label class="control-label col-sm-2" for="description">Avata:</label>
            <img id="imgFile" class="img img-responsive" width="80%" alt="">
            <input type="file" name="image" id="editfile" onchange="loadFile(event)">
          </div>
        <div class="form-group">
          <label class="control-label col-sm-2 " for="description">Category:</label>
          <select name="ecategory_id" id="ecategory" style="width: 100%" class="form-control">
            @foreach($categories as $category)
            <option value="{{$category['id']}}">{{$category['name']}}</option>}
            option
            @endforeach
          </select>
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
        <h5 class="modal-title" id="editPost">CREATE NEW A POSTS</h5>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form" style=" width:100%" enctype="multipart/form-data">

         <div class="form-group">
          <label class="control-label col-sm-2" for="title">Title:</label>
          <div>
            <input type="text" class="form-control" id="title" placeholder="Please Enter A Title" name="title">
          </div>
          @if ($errors->has('title'))
          <span class="errors">{{$errors->first('title')}}</span>
          @endif
        </div>
        <div class="form-group">
         <label class="control-label col-sm-2" for="description">Description:</label>
         <div>          
          <input type="text" class="form-control" id="description" placeholder="Please Enter A Description" name="description">
        </div>
        @if ($errors->has('description'))
        <span class="errors">{{$errors->first('description')}}</span>
        @endif
      </div> 
      <div class="form-group" id="contentdiv">


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
      <img id="imgCreate" class="img img-responsive" width="80%" alt="">
      <input type="file" name="image" id="file" onchange="loadFileC(event)">
    </div>
    <br>
    <br>
    <br>
    <div class="portlet-title">
     <div class="form-group" id="tag">        
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
<!-- modal reason -->
<div class="modal fade" id="reason">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Reason</h4>
      </div>
      <div class="modal-body">
        <p id="reason">
          
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="changeStatus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
          <input type="hidden" name="idStatus" id="idStatus" value="">
          <div class="form-group" id="changForm">
            <label for="">Status</label>
            <select name="changeStatus" id="changeStatus" class="form-control">
              <option value="0">Browsing</option>
              <option value="1">Posted</option>
              <option value="2" id="Ocancelled">Cancelled</option>
            </select>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="changeBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Show Post -->

<div class="modal fade" id="showPost">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> --}}
    <script src="{{asset('js/inputTags.jquery.min.js')}}"></script>
    <script >$('#tags').inputTags();$('#etags').inputTags();</script>
    <script ></script>
    <script type="text/javascript" charset="utf-8">
      $(function () {
        $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $('#StoreBtn').on('click',function(e){
          e.preventDefault();
          var content = CKEDITOR.instances.content.getData();
          var file = $('#file').get(0).files[0];
          var newPost = new FormData();
          newPost.append('title',$('#title').val());
          newPost.append('description',$('#description').val());
          newPost.append('content',content);
          newPost.append('category_id',$('#category').val());
          newPost.append('tags',$('#tags').val());
          newPost.append('image',file);
          $.ajax({
            type:'post',
            url:"posts/store",
            data:newPost,
            dataType:'json',
            async:false,
            processData: false,
            contentType: false,
            success:function(response){
                 
                 setTimeout(function () {
                 toastr.success('has been added');
                  // window.location.href="{{route('posts.index')}}";
                  // 
                },1000);
                // var data = JSON.parse(response).data;
                var html=
                '<tr id="user_'+response.id+'">'+
                '<td>'+response.id+'</td>'+
                '<td><img src="'+response.image+'" class="img img-responsive" width="200px" alt="">'+'</td>'+
                '<td>'+response.title+'</td>'+
                '<td>'+response.updated_at+'</td>'+
                '<td>'+
                '<a href="#" class="btn btn-primary" href="javascript:;" onclick="getStatus('+response.id+')" data-toggle="modal" data-target="#changeStatus">Change Status</a>'+'<br>'+'<br>'+
                '<a href="#" class="btn btn-info">Browsing</a>'+'</td>'+
                '<td>'+
                '<a href="javascript:;"  onclick="editPost('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#editPost"  ><i class="fa fa-edit"></i> Repair </a>'+'<br>'+'<br>'+
                '<a  class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</a>'

                +
                '</td>';
                
                $('tbody').prepend(html);
                $('#create').modal('hide');
          },  error: function (xhr, ajaxOptions, thrownError) {
            
            if (!checkNull(xhr.responseJSON.errors)) {
              $('p#sperrors').remove();
            if(!checkNull(xhr.responseJSON.errors.title))
            {
              for (var i = 0; i < xhr.responseJSON.errors.title.length; i++) {
              var html='<p id="sperrors" style="color:red">'+xhr.responseJSON.errors.title[i]+'</p>';
              
              $(html).insertAfter('#title');

              }
            };
            if(!checkNull(xhr.responseJSON.errors.content))
            {
              for (var i = 0; i < xhr.responseJSON.errors.content.length; i++) {
              var html='<p id="sperrors" style="color:red">'+xhr.responseJSON.errors.content[i]+'</p>';
              
              $(html).insertAfter('#contentdiv');

              }
            };
            if(!checkNull(xhr.responseJSON.errors.description))
             {
              for (var i = 0; i < xhr.responseJSON.errors.description.length; i++) {
              var html='<p id="sperrors" style="color:red">'+xhr.responseJSON.errors.description[i]+'</p>';
              
              $(html).insertAfter('#description');

              }
            };
            if(!checkNull(xhr.responseJSON.errors.tags))
             {
              for (var i = 0; i < xhr.responseJSON.errors.tags.length; i++) {
              var html='<p id="sperrors" style="color:red">'+xhr.responseJSON.errors.tags[i]+'</p>';
              
              $(html).insertAfter('#tag');

              }
            }
            if (!checkNull(xhr.responseJSON.message)) {

            toastr.error(xhr.responseJSON.message);
            }
          };

          },

        })
        });

$('#UpdateBtn').on('click',function(e){
        e.preventDefault();
        var econtent = CKEDITOR.instances.econtent.getData();
          var efile = $('#editfile').get(0).files[0];
          var updatePost = new FormData();
          updatePost.append('title',$('#etitle').val());
          updatePost.append('description',$('#edescription').val());
          updatePost.append('content',econtent);
          updatePost.append('category_id',$('#ecategory').val());
          updatePost.append('tags',$('#etags').val());
          updatePost.append('editImage',efile);
          updatePost.append('id',$('#eid').val());
        $.ajax({
          type:'post',
          url: "posts/update",

          data:updatePost,
          dataType:'json',
            async:false,
            type:'post',
            processData: false,
            contentType: false,
          success: function(response){
            
        // var result = JSON.parse(response);
        setTimeout(function () {
          toastr.success(response.name+'has been added');
          // window.location.href="{{route('posts.index')}}";
        },1000);
        
        $('#editPost').modal('hide');
        var html=
        '<td>'+response.id+'</td>'+
                '<td><img src="'+response.image+'" class="img img-responsive" width="200px" alt="">'+'</td>'+
                '<td>'+response.title+'</td>'+
                '<td>'+response.updated_at+'</td>'+
                '<td>'+
                '<a href="#" class="btn btn-primary" href="javascript:;" onclick="getStatus('+response.id+')" data-toggle="modal" data-target="#changeStatus">Change Status</a>'+'<br>'+'<br>'+
                '<a href="#" class="btn btn-info">Browsing</a>'+'</td>'+
                '<td>'+
                '<a href="javascript:;"  onclick="editPost('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#editPost"  ><i class="fa fa-edit"></i> Repair </a>'+'<br>'+'<br>'+
                '<a  class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</a>'

                +
                '</td>';

        
        $('#user_'+response.id).html(html);
      },error: function (xhr, ajaxOptions, thrownError) {
            $("p.sperrors").remove();
            if(!checkNull(xhr.responseJSON.errors.title))
            { 
              for (var i = 0; i < xhr.responseJSON.errors.title.length; i++) {
              var html='<p class="sperrors" style="color:red">'+xhr.responseJSON.errors.title[i]+'</p>';
              
              $(html).insertAfter('#etitle');

              }
            };
            if(!checkNull(xhr.responseJSON.errors.content))
            {
              for (var i = 0; i < xhr.responseJSON.errors.content.length; i++) {
              var html='<p class="sperrors" style="color:red">'+xhr.responseJSON.errors.content[i]+'</p>';
              
              $(html).insertAfter('#econtentdiv');

              }
            };
            if(!checkNull(xhr.responseJSON.errors.description))
             {
              for (var i = 0; i < xhr.responseJSON.errors.description.length; i++) {
              var html='<p  class="sperrors" style="color:red">'+xhr.responseJSON.errors.description[i]+'</p>';
              
              $(html).insertAfter('#edescription');

              }
            };
            toastr.error(xhr.responseJSON.message);

          },

    })
      });
      })



  // get data for form update
  function editPost(id) {
    
        // $('#editPost').modal('show');

        $.ajax({
          type: "GET",
          url: "posts/edit/" + id,

          success: function(response)
          {
            CKEDITOR.instances.econtent.setData(response.content);
            $('#etitle').val(response.title),
            $('#edescription').val(response.description),
            $('#editfile').val(response.avata),
            $("#imgFile").attr("src",response.image);
            $('#eid').val(response.id)         
          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        });

      }
    function showPost(id) {
    
        // $('#editPost').modal('show');

        $.ajax({
          type: "GET",
          url: "posts/edit/" + id,

          success: function(response)
          {
            console.log(response);
            

          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        });

      }
      // Update function
      

      // Delete function
      function alDelete(id){
        
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
            url: "{{ asset('admin/posts') }}"+'/'+id,
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
      function checkNull(value){
          return (value == null || value === '');
      }
      
      function getReason(id){
        $.ajax({
            type: "post",
            url: "posts/getReason/"+id,
            success: function(response){
            
              if (response.notice==null) {
                $("p#reason").append("Bạn Đã Không Để Lại Lý Do");
              }else{
                $("p#reason").append(response.notice);
              }
            },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
      })
    }
    
    function getStatus(id){
      $.ajax({
            type: "post",
            url: "posts/getReason/"+id,
            success: function(response)
            { 
              $('#idStatus').val(response.id);
              var status=response.status;
              switch(status) {
                case 0:
                $('select#changeStatus').val('0').change();
                $('#ereasondiv').remove();
                  break;
                case 1 :
                  $("#ereasondiv").remove();
                  $('select#changeStatus').val('1').change();
                  break; 
                case 2 :
                  $('div#ereasondiv').remove();
                  $('select#changeStatus').val('2').change();
                  break;
      }
            },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
            }
      })     
    }
    $('select#changeStatus').on('change', function() {
       switch(this.value) {
        case '0':
        $('#ereasondiv').remove();
          break;
        case '1':
          $('#ereasondiv').remove();
          break; 
        case '2':   
        $("div#ereasondiv").remove();
          var html='<div class="form-group" id="ereasondiv">'+
            '<label class="control-label" for="ereason">Reason:</label>'+        
            '<div>'+ 
              '<textarea name="ereason" id="ereason" row="10" col="20"></textarea>'+
            '</div>'+
         '</div>';
         $(html).insertAfter('#changForm');
         CKEDITOR.replace( 'ereason' );
          break;
      }
    })
    $('#changeBtn').on('click',function(e){
       e.preventDefault();
       if (CKEDITOR.instances.ereason) {

       var notice = CKEDITOR.instances.ereason.getData();
       }else{
        notice="";
       }
       $.ajax({
            type: "post",
            url: "posts/changeStatus",
            data:{
              status:$('select#changeStatus').val(),
              notice:notice,
              id:$('#idStatus').val(),
            },
            success: function(response)
            {
              switch(response.status) {
                case 0:
                var plushtml='<a href="#" class="btn btn-info"> Browsing</a>';         
                  break;
                case 1:
                  var plushtml='<a href="#" class="btn btn-success"> Posted</a>';
                  break; 
                case 2: 
                  var plushtml='<a href="#" class="btn btn-danger"> Cancelled</a><br><br>'+
                  '<a href="javascript:;" onclick="getReason('+response.id+')" data-toggle="modal" data-target="#reason" class="btn btn-warning fa fa-exclamation-circle"> Reason</a>';
                  break;
                }
             var html=
                '<td>'+response.id+'</td>'+
                '<td><img src="'+response.image+'" class="img img-responsive" width="200px" alt="">'+'</td>'+
                '<td>'+response.title+'</td>'+
                '<td>'+response.updated_at+'</td>'+
                '<td>'+
                '<a href="#" class="btn btn-primary" href="javascript:;" onclick="getStatus('+response.id+')" data-toggle="modal" data-target="#changeStatus">Change Status</a>'+'<br>'+'<br>'+plushtml+
                '<td>'+
                '<a href="javascript:;"  onclick="editPost('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#editPost"  ><i class="fa fa-edit"></i> Repair </a>'+'<br>'+'<br>'+
                '<a  class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</a>'+
                '</td>';
              $('#user_'+response.id).html(html);
                    $('#changeStatus').modal('hide');
                  
            },
              error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
      })
    });
    </script>
    @endsection
  