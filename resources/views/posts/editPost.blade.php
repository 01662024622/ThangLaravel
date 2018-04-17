@yield('title')

 @extends('layout.adminheader')
 @section('css')
    
    <link rel="shortcut icon" type="img/png" href="{{asset('image/favicon.png')}}"/>
    <!-- STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/slippry.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Sarina' rel='stylesheet' type='text/css'>

@endsection
@section('content')


    <section class="tada-container content-posts page post-right-sidebar">


       <!-- CONTENT -->
       <div class="content col-xs-8">

        <h2>Horizontal form</h2>
        <form class="form-horizontal" action="{{asset('post/store')}}" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Title:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
                </div>
                @if ($errors->has('title'))
                <span class="errors">{{$errors->first('title')}}</span>
                @endif
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="description">Description:</label>
               <div class="col-sm-10">          
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
           <label class="control-label col-sm-2" for="description">Content:</label>

           <div class="col-sm-10">          
            <textarea name="editor1"></textarea>
            <script>
                CKEDITOR.replace( 'editor1' );
            </script>
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>




</div>


<!-- SIDEBAR -->        
<div class="sidebar col-xs-4">
    <select name="category_id" style="width: 100%" class="form-control">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <br>
    <br>
    <br>
    <br>
    <input type="file" name="thumbnail" value="" placeholder="">
    <br>
    <br>
    <br>
        <div class="portlet-title">
            <div class="form-group">        
        
    <input type="text" name="tags" id='tags' data-role="tagsinput" value="" placeholder="">       
     </div>
    </div>
    
</div> <!-- #SIDEBAR -->
<h2  onclick="test()">ádasd</h2>
<div class="clearfix"></div>
</form>


</section>
@endsection

@section('js')

<script > 
    function test(){
        $tag=$('#tags').val();
        alert($tag);
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{asset('js/slippry.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
@endsection
