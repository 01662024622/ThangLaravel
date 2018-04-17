<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- CSS
================================================== -->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{asset('font_end/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('font_end/css/bootstrap-responsive.css')}}">
<link rel="stylesheet" href="{{asset('font_end/css/prettyPhoto.css')}}" />
<link rel="stylesheet" href="{{asset('font_end/css/flexslider.css')}}" />
<link rel="stylesheet" href="{{asset('font_end/css/custom-styles.css')}}">
@yield('css')
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/style-ie.css"/>
<![endif]--> 

<!-- Favicons
================================================== -->
<style type="text/css" media="screen">
    .logo {
    text-align: right;
}
.navigation .navbar {
    float: left;
    margin: 0px;
    }
.nav{
    margin: 0px !important;
}
</style>
<link rel="shortcut icon" href="{{ asset('font_end/img/favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('font_end/img/apple-touch-icon.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('font_end/img/apple-touch-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('font_end/img/apple-touch-icon-114x114.png')}}">

<!-- JS
================================================== -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="{{ asset('font_end/js/bootstrap.js')}}"></script>
<script src="{{ asset('font_end/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{ asset('font_end/js/jquery.flexslider.js')}}"></script>
<script src="{{ asset('font_end/js/jquery.custom.js')}}"></script>
@yield('js')
<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

</script>

</head>

<body class="home">
    <!-- Color Bars (above header)-->
	<div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    
    <div class="container">
    
      <div class="row header"><!-- Begin Header -->
      
        <!-- Logo
        ================================================== -->
       
        
        <!-- Main Navigation
        ================================================== -->
        <div class="span7 navigation">
            <div class="navbar hidden-phone">
            <ul class="nav">
            @foreach ($categories as $key=>$category)
            @php
            @endphp
              @if ($category->parent_id=='0')
                <li class="dropdown active">
                <a class="dropdown-toggle" href="{{ asset('category/'.$category->name)}}">{{$category->name}}</a>
                    <ul class="dropdown-menu">
                @foreach ($subCategories as $value)
                  @if ($value->parent_id==$category->id)
                        <li><a href="{{ asset('category/'.$value->name)}}">{{$value->name}}</a></li>   
                  @endif
                @endforeach
                    </ul>
                 
                </li>
              @endif
            @endforeach
            </ul>
           
            </div>

            <!-- Mobile Nav
            ================================================== -->
            <form action="#" id="mobile-nav" class="visible-phone">
                <div class="mobile-nav-select">
                <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
                    <option value="">Navigate...</option>
                    <option value="index.htm">Home</option>
                        <option value="index.htm">- Full Page</option>
                        <option value="index-gallery.htm">- Gallery Only</option>
                        <option value="index-slider.htm">- Slider Only</option>
                    <option value="features.htm">Features</option>
                    <option value="page-full-width.htm">Pages</option>
                        <option value="page-full-width.htm">- Full Width</option>
                        <option value="page-right-sidebar.htm">- Right Sidebar</option>
                        <option value="page-left-sidebar.htm">- Left Sidebar</option>
                        <option value="page-double-sidebar.htm">- Double Sidebar</option>
                    <option value="gallery-4col.htm">Gallery</option>
                        <option value="gallery-3col.htm">- 3 Column</option>
                        <option value="gallery-4col.htm">- 4 Column</option>
                        <option value="gallery-6col.htm">- 6 Column</option>
                        <option value="gallery-4col-circle.htm">- Gallery 4 Col Round</option>
                        <option value="gallery-single.htm">- Gallery Single</option>
                    <option value="blog-style1.htm">Blog</option>
                        <option value="blog-style1.htm">- Blog Style 1</option>
                        <option value="blog-style2.htm">- Blog Style 2</option>
                        <option value="blog-style3.htm">- Blog Style 3</option>
                        <option value="blog-style4.htm">- Blog Style 4</option>
                        <option value="blog-single.htm">- Blog Single</option>
                    <option value="page-contact.htm">Contact</option>
                </select>
                </div>
                </form>

        </div>
         <div class="span5 logo">
            <a href="{{ asset('/') }}"><h1>Rolless</h1></a>
            <h5 >Big Things... Small Packages</h5>
        </div>
        
      </div><!-- End Header -->
     
     @yield('content')
    

    <!-- Footer Area
        ================================================== -->

	<div class="footer-container"><!-- Begin Footer -->
    	<div class="container">
        	<div class="row footer-row">
                <div class="span3 footer-col">
                    <h5>About Us</h5>
                   <a href="{{ asset('/') }}"><h1>Rolless</h1></a><br /><br />
                    <address>
                        <strong>Design:</strong><br />
                        Vũ Minh Thắng<br />
                       Thường Tín,Hà Nội<br />
                    </address>
                    <ul class="social-icons">
                        <li><a href="#" class="social-icon facebook"></a></li>
                        <li><a href="#" class="social-icon twitter"></a></li>
                        <li><a href="#" class="social-icon dribble"></a></li>
                        <li><a href="#" class="social-icon rss"></a></li>
                        <li><a href="#" class="social-icon forrst"></a></li>
                    </ul>
                </div>
                <div class="span3 footer-col">
                    <h5>Latest Tweets</h5>
                    <ul>
                        <li><a href="#">@room122</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li><a href="#">@room122</a> In interdum felis fermentum ipsum molestie sed porttitor ligula rutrum. Morbi blandit ultricies ultrices.</li>
                        <li><a href="#">@room122</a> Vivamus nec lectus sed orci molestie molestie. Etiam mattis neque eu orci rutrum aliquam.</li>
                    </ul>
                </div>
                <div class="span3 footer-col">
                    <h5>Latest Posts</h5>
                     <ul class="post-list">
                        @foreach ($newPosts as $element)    
                            <li><a href="{{ asset('poster/'.$post->slug) }}">{{$element->title}}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="span3 footer-col">
                    <h5>Flickr Photos</h5>
                    <ul class="img-feed">
                        @foreach($users as $user)
                        <li style="max-width: 30%"><a href="#"><img src="{{asset($user->avata)}}" alt="Image Feed"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row"><!-- Begin Sub Footer -->
                <div class="span12 footer-col footer-sub">
                    <div class="row no-margin">
                        <div class="span6"><span class="left">If you find handsome boy.That is Mr Thang(Rolless)</span></div>
                        <div class="span6">
                            <span class="right">
                             @foreach ($categories as $key=>$category)
                              @if ($category->parent_id=='0')
                                <a href="{{ asset('category/'.$category->name)}}">{{$category->name}}</a>&nbsp;&nbsp;&nbsp;
                                
                              @endif
                            @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- End Sub Footer -->

        </div>
    </div><!-- End Footer --> 
    
    <!-- Scroll to Top -->  
    <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>
    
</body>
</html>
