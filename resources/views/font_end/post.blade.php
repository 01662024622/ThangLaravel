@extends('layout.font_end')
@section('css')
<style type="text/css" media="screen">
.comments>ul>li{
    margin: 0px;
    margin-top: 30px;
    background: #e2d6d6;
    padding: 5px;
}
</style>
@endsection
@section('content')
	
     
    <!-- Blog Content
    ================================================== --> 
    <div class="row"><!--Container row-->

        <!-- Blog Full Post
        ================================================== --> 
        <div class="span8 blog">

            <!-- Blog Post 1 -->
            <article>
                <h3 class="title-bg"><a href="#">{{$post->title}}</a></h3>
                <div class="post-content">
                    <a href="#"><img src="{{$post->image}}" alt="Post Thumb"></a>

                    <div class="post-body">
                        <p class="well"><a href="#" rel="tooltip" title="An important message">{{$post->description}}</p>
                       <blockquote>
                            {{$post->content}}
                       </blockquote>
                    </div>

                    <div class="post-summary-footer">
                        <ul class="post-data">
                            <li><i class="icon-calendar"></i>{{$post->created_at}}</li>
                            <li><i class="icon-user"></i> <a href="#">{{$post->user_id}}</a></li>
                            <li><i class="icon-comment"></i> <a href="#">5 Comments</a></li>
                            <li><i class="icon-tags"></i> <a href="#">photoshop</a>, <a href="#">tutorials</a>, <a href="#">illustration</a></li>
                        </ul>
                    </div>
                </div>
            </article>

            

        <!-- Post Comments
        ================================================== --> 
            <section class="comments">
                <h4 class="title-bg" id="flag"><a name="comments"></a>5s Comments so far</h4>
               <ul> 
                <input type="hidden"  id="flagComment">
                    @foreach ($comments as $comment)
                        @if ($comment->parent_id=="0")
                            {{-- expr --}}
                            <li id="comment_{{$comment->id}}">
                                <img src="{{$comment->avata}}" class="img img-responsive" width="30px" alt="Image" />
                                <span class="comment-name">{{$comment->user_id}}</span>
                                <div class="comment-content">{{$comment->content}}</div>
                                <div style="text-align:  right">
                                <span class="comment-date">{{$comment->updated_at}}</span>
                                <br><a href="#">Reply</a>
                                </div>
                            </li>
                                    @foreach ($subcomments as $element)
                                    @if ($element->parent_id==$comment->id)
                                <li style="margin: 0 0 0 10%;background: #f8f8f8" >
                                        <img src="{{$element->avata}}" class="img img-responsive" width="30px" alt="Image" />
                                        <span class="comment-name">{{$element->user_id}}</span><br>
                                        <div class="comment-content">{{$element->content}}</div><br>
                                        <div style="text-align:  right">
                                        <span class="comment-date">{{$element->updated_at}}</span>
                                        <br>
                                        </div>
                             </li>
                                    @endif
                                    @endforeach 
                        @endif
                    @endforeach
               </ul>
            
                <!-- Comment Form -->
                @if (!isset($userComment))
                    {{-- expr --}}
                <div class="comment-form-container">
                    <h6>Leave a Comment</h6>
                    {{-- <form action="#" id="comment-form"> --}}
                        <textarea class="span6" id="comment"></textarea>
                        <div class="row">
                            <div class="span2">
                                <a type="submit" id="storeCommentss" class="btn btn-inverse" >Post My Comment
                                </a>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
                @endif
                @if (isset($userComment))
                <br><br><br>
                <a href="{{ asset('admin/login') }}" class="btn btn-inverse">Login For Comment</a>
                @endif
        </section><!-- Close comments section-->

       {{--  </div><!--Close container row-->

        <!-- Blog Sidebar
        ================================================== --> 
        <div class="span4 sidebar">

            <!--Search-->
            <section>
                <div class="input-append">
                    <form action="#">
                        <input id="appendedInputButton" size="16" type="text" placeholder="Search"><button class="btn" type="button"><i class="icon-search"></i></button>
                    </form>
                </div>
            </section>

            <!--Categories-->
            {{-- <h5 class="title-bg">Categories</h5>
            <ul class="post-category-list">
                <li><a href="#"><i class="icon-plus-sign"></i>Design</a></li>
                <li><a href="#"><i class="icon-plus-sign"></i>Illustration</a></li>
                <li><a href="#"><i class="icon-plus-sign"></i>Tutorials</a></li>
                <li><a href="#"><i class="icon-plus-sign"></i>News</a></li>
            </ul> --}}

            <!--Popular Posts-->
            <h5 class="title-bg">Popular Posts</h5>
            <ul class="popular-posts">
            	@foreach ($newPosts as $value)
            		 <li>
	                    <a href="{{asset('poster/'.$value->slug) }}"><img src="{{$value->image}}" class="img img-responsive" width="30px" alt="Popular Post"></a>
	                    <h6><a href="{{asset('poster/'.$value->slug) }}">{{$value->title}}</a></h6>
	                    <em>Posted on {{$value->created_at}}</em>
               		</li>            	
                @endforeach
               
            </ul>

            <!--Tabbed Content-->
            <h5 class="title-bg">More Info</h5>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#comments" data-toggle="tab">Comments</a></li>
                <li><a href="#tweets" data-toggle="tab">Tweets</a></li>
                <li><a href="#about" data-toggle="tab">About</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="comments">
                     <ul>
                        <li><i class="icon-comment"></i>admin on <a href="#">Lorem ipsum dolor sit amet</a></li>
                        <li><i class="icon-comment"></i>admin on <a href="#">Consectetur adipiscing elit</a></li>
                        <li><i class="icon-comment"></i>admin on <a href="#">Ipsum dolor sit amet consectetur</a></li>
                        <li><i class="icon-comment"></i>admin on <a href="#">Aadipiscing elit varius elementum</a></li>
                        <li><i class="icon-comment"></i>admin on <a href="#">ulla iaculis mattis lorem</a></li>
                    </ul>
                </div>
                <div class="tab-pane" id="tweets">
                    <ul>
                        <li><a href="#"><i class="icon-share-alt"></i>@room122</a> Vivamus tincidunt sem eu magna varius elementum. Maecenas felis tellus, fermentum vitae laoreet vitae, volutpat et urna.</li>
                        <li><a href="#"> <i class="icon-share-alt"></i>@room122</a> Nulla faucibus ligula eget ante varius ac euismod odio placerat.</li>
                        <li><a href="#"> <i class="icon-share-alt"></i>@room122</a> Pellentesque iaculis lacinia leo. Donec suscipit, lectus et hendrerit posuere, dui nisi porta risus, eget adipiscing</li>
                        <li><a href="#"> <i class="icon-share-alt"></i>@room122</a> Vivamus augue nulla, vestibulum ac ultrices posuere, vehicula ac arcu.</li>
                        <li><a href="#"> <i class="icon-share-alt"></i>@room122</a> Sed ac neque nec leo condimentum rhoncus. Nunc dapibus odio et lacus.</li>
                    </ul>
                </div>
                <div class="tab-pane" id="about">
                    <p>Enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.</p>

                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                </div>
            </div>

            <!--Video Widget-->
            <h5 class="title-bg">Video Widget</h5>
            <iframe src="http://player.vimeo.com/video/24496773" width="370" height="208"></iframe>
        </div>

    </div>
    
    </div> <!-- End Container -->
    @section('js')

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> --}}
    <script type="text/javascript" charset="utf-8">
      $(function () {
        $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $('#storeCommentss').on('click',function(e){
          e.preventDefault();
          console.log($('#comment').val());
          $.ajax({
            type:'post',
            url:"{{asset('upComment')}}",
            data:{
              content:$('#comment').val(),
              parent_id:'0',
              post_id:'1'},
            success:function(response){
                 console.log(response);
                //  setTimeout(function () {
                //  toastr.success('has been added');
                //   // window.location.href="{{route('posts.index')}}";
                //   // 
                // },1000);
                // var data = JSON.parse(response).data;
                var html=
                '<li id="comment_'+response.id+'">'+
                  '<img src="'+response.id+'" class="img img-responsive" width="30px" alt="Image" />'+
                  '<span class="comment-name">'+response.user_id+'</span>'+
                  '<div class="comment-content">'+response.content+'</div>'+
                    '<div style="text-align:  right">'+
                    '<span class="comment-date">'+response.updated_at+'</span>'+
                    '<br><a href="#">Reply</a>'+
                  '</div>'+
                '</li>';
                console.log(html);
                $(html).insertAfter('#flagComment');
          }, error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            // toastr.error(xhr.responseJSON.message);

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
          url: "{{ asset('admin/posts/update') }}",

          data:updatePost,
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
          // window.location.href="{{route('posts.index')}}";
        },1000);
        
        $('#editPost').modal('hide');
        var html=
        '<td>'+response.id+'</td>'+
                '<td><img src="'+response.image+'" class="img img-responsive" width="200px" alt="">'+'</td>'+
                '<td>'+response.title+'</td>'+
                '<td>'+response.description+'</td>'+
                '<td>'+response.content+'</td>'+
                '<td>'+
                '<a href="#" class="btn btn-info">Đang duyệt</a>'+'<br>'+'<br>'+
                '<a href="javascript:;"  onclick="editPost('+response.id+') " class="btn btn-success" data-toggle="modal" data-target="#editPost"  ><i class="fa fa-edit"></i> Sửa </a>'+'<br>'+'<br>'+
                '<a  class="btn btn-danger fa fa-trash-o" onclick="alDelete('+response.id+')" type="submit">Delete</a>'

                +
                '</td>';

        console.log(html);
        $('#user_'+response.id).html(html);
      }, error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
        toastr.error(xhr.responseJSON.message);
        toastr.error(xhr.responseJSON.message);

      },

    })
      });
      })



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
            $('#editfile').val(response.avata),
            $("#imgFile").attr("src",response.image);
            $('#eid').val(response.id)         
          },
          error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(thrownError);
          }
        });

      }
      // Update function
      

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
          toastr.error("Thao tác xóa đã bị huỷ bỏ!");
        }
      });
      };

    </script>
    @endsection
  

@endsection --}}