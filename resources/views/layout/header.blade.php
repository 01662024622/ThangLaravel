<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')

    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="shortcut icon" type="img/png" href="{{asset('image/favicon.png')}}"/>
    <!-- STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/slippry.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <!-- GOOGLE FONTS -->
     <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Sarina' rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script> -->
</head>

<body>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId            : '1706027669642758',
          autoLogAppEvents : true,
          xfbml            : true,
          version          : 'v2.11'
        });
      };
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="fb-customerchat" page_id="841929485928565"></div>

    <!-- *****************************************************************
    ** Preloader *********************************************************
    ****************************************************************** -->

	<div id="preloader-container">
    	<div id="preloader-wrap">
    		<div id="preloader"></div>
    	</div>
    </div>
    
    
    <!-- *****************************************************************
    ** Header ************************************************************ 
    ****************************************************************** --> 
        
    <header class="tada-container no-slider">
    
    
    	<!-- LOGO -->
    	<div class="logo-container">
        	<a href="{{asset('/')}}"><img src="{{asset('img/logo.png')}}" alt="logo" ></a>
            <div class="tada-social">
            	<a href="#"><i class="icon-facebook5"></i></a>
                <a href="#"><i class="icon-twitter4"></i></a>
                <a href="#"><i class="icon-google-plus"></i></a>
                <a href="#"><i class="icon-vimeo4"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
            </div>
        </div>
    
    
    	<!-- MENU DESKTOP -->
    	<nav class="menu-desktop menu-sticky">
    
            <ul class="tada-menu">
                     <li><a href="#">HOME <i class="icon-arrow-down8"></i></a>
                        <ul class="submenu">
                        	<li><a href="{{asset('home-1-collumn')}}">Home 1 Column</a></li>
                            <li><a href="{{asset('home-1-collumns-with-sidebar')}}">Home 1 Column + Sidebar</a></li>                            
                            <li><a href="{{asset('home-2-collumns-with-sidebar')}}">Home 2 Columns + Sidebar</a></li>
                            <li><a href="{{asset('home-2-collumns')}}">Home 2 Columns</a></li>
                            <li><a href="{{asset('home-3-collumns')}}">Home 3 Columns</a></li>                                                                      
                        </ul>
                    </li>
                    <li><a href="#" class="active">FEATURES <i class="icon-arrow-down8"></i></a>
                        <ul class="submenu">
                            <li><a href="{{asset('page')}}">Page</a></li>
                            <li><a href="{{asset('page-with-right-sidebar')}}">Page + Right Sidebar</a></li>
                            <li><a href="{{asset('page-with-left-sidebar')}}" class="active">Page + Left Sidebar</a></li>                            
                            <li><a href="{{asset('post')}}">Post Full Width</a></li>
                            <li><a href="{{asset('post-with-right-sidebar')}}">Post + Right Sidebar</a></li>
                            <li><a href="{{asset('post-with-left-sidebar')}}">Post + Left Sidebar</a></li>
                            <li><a href="{{asset('no-sticky')}}">No Sticky Menu</a></li>
                            <li><a href="{{asset('no-slide')}}">No Slider</a></li> 
                            <li><a href="#">Submenu <i class="icon-arrow-right8"></i></a>
                                <ul class="submenu">
                                    <li><a href="#">Item 1</a></li>
                                    <li><a href="#">Item 2</a></li>
                                    <li><a href="#">Item 3</a></li>
                                    <li><a href="#">Item 4</a></li>
                                </ul>
                            </li>                                                                                            
                        </ul>                
                    </li>                                     
                    <li><a href="#">BLOG <i class="icon-arrow-down8"></i></a>
                        <ul class="submenu">
                        	<li><a href="{{asset('blog-1-collumn')}}">Blog 1 Column</a></li>
                            <li><a href="{{asset('blog-1-collumn-with-sidebar')}}">Blog + Sidebar</a></li>                            
                            <li><a href="{{asset('blog-2-collumns-with-sidebar')}}">Blog 2 Columns + Sidebar</a></li>
                            <li><a href="{{asset('blog-2-collumns')}}">Blog 2 Columns</a></li>
                            <li><a href="{{asset('blog-3-collumns')}}">Blog 3 Columns</a></li>                                                                      
                        </ul>                
                    </li> 
                    <li><a href="{{asset('about')}}">ABOUT US</a></li>
                    <li><a href="{{asset('contact')}}">CONTACT</a></li>
                    <li><a href="{{asset('login')}}">LOGIN</a></li>
            </ul>
        
        </nav>
        
        
        <!-- MENU MOBILE -->
        <div class="menu-responsive-container"> 
            <div class="open-menu-responsive">|||</div> 
            <div class="close-menu-responsive">|</div>              
            <div class="menu-responsive">   
                <ul class="tada-menu">
                     <li><a href="#">HOME <i class="icon-arrow-down8"></i></a>
                        <ul class="submenu">
                        	<li><a href="{{asset('home-1-collumn')}}">Home 1 Column</a></li>
                            <li><a href="{{asset('index')}}">Home 1 Column + Sidebar</a></li>                            
                            <li><a href="{{asset('home-2-collumns-with-sidebar')}}">Home 2 Columns + Sidebar</a></li>
                            <li><a href="{{asset('home-2-collumns')}}">Home 2 Columns</a></li>
                            <li><a href="{{asset('home-3-collumns')}}">Home 3 Columns</a></li>                                                                      
                        </ul>
                    </li>
                    <li><a href="#" class="active">FEATURES <i class="icon-arrow-down8"></i></a>
                        <ul class="submenu">
                            <li><a href="{{asset('page')}}">Page</a></li>
                            <li><a href="{{asset('page-with-right-sidebar')}}">Page + Right Sidebar</a></li>
                            <li><a href="{{asset('page-with-left-sidebar')}}" class="active">Page + Left Sidebar</a></li>                            
                            <li><a href="{{asset('post')}}">Post Full Width</a></li>
                            <li><a href="{{asset('post-with-right-sidebar')}}">Post + Right Sidebar</a></li>
                            <li><a href="{{asset('post-with-left-sidebar')}}">Post + Left Sidebar</a></li>
                            <li><a href="{{asset('no-sticky')}}">No Sticky Menu</a></li>
                            <li><a href="{{asset('no-slider')}}">No Slider</a></li> 
                            <li><a href="#">Submenu <i class="icon-arrow-right8"></i></a>
                                <ul class="submenu">
                                    <li><a href="#">Item 1</a></li>
                                    <li><a href="#">Item 2</a></li>
                                    <li><a href="#">Item 3</a></li>
                                    <li><a href="#">Item 4</a></li>
                                </ul>
                            </li>                                                                                            
                        </ul>                
                    </li>                                     
                    <li><a href="#">BLOG <i class="icon-arrow-down8"></i></a>
                        <ul class="submenu">
                        	<li><a href="{{asset('blog-1-collumn')}}">Blog 1 Column</a></li>
                            <li><a href="{{asset('blog-1-collumn-with-sidebar')}}">Blog + Sidebar</a></li>                            
                            <li><a href="{{asset('blog-2-collumns-with-sidebar')}}">Blog 2 Columns + Sidebar</a></li>
                            <li><a href="{{asset('blog-2-collumns')}}">Blog 2 Columns</a></li>
                            <li><a href="{{asset('blog-3-collumns')}}">Blog 3 Columns</a></li>                                                                      
                        </ul>                
                    </li> 
                    <li><a href="{{asset('about')}}">ABOUT US</a></li>
                    <li><a href="{{asset('contact')}}">CONTACT</a></li>
                    <li><a href="{{asset('login')}}">LOGIN</a></li>
                </ul>                        
            </div>
        </div> <!-- # menu responsive container -->
        
        
        <!-- SEARCH -->
        <div class="tada-search">
			<form>
            	<div class="form-group-search">
              		<input type="search" class="search-field" placeholder="Search and hit enter...">
              		<button type="submit" class="search-btn"><i class="icon-search4"></i></button>
            	</div>
          	</form>
        </div>        
        
        
    </header><!-- #HEADER -->

    
    <!-- *****************************************************************
    ** Section ***********************************************************
    ****************************************************************** -->
  
    @yield('content')
    
    <!-- *****************************************************************
    ** Footer ************************************************************
    ****************************************************************** -->
        
    <footer class="tada-container">   
    
    
    	<!-- INSTAGRAM -->
    	<div class="widget widget-gallery">
    		<h3 class="widget-title">INSTAGRAM</h3>
    		<div class="image">
            	<a href="#"><img src="{{asset('img/img-gallery-1.jpg')}}" alt="image gallery 1"></a>
                <a href="#"><img src="{{asset('img/img-gallery-2.jpg')}}" alt="image gallery 2"></a>
                <a href="#"><img src="{{asset('img/img-gallery-3.jpg')}}" alt="image gallery 3"></a>
                <a href="#"><img src="{{asset('img/img-gallery-4.jpg')}}" alt="image gallery 4"></a>
                <a href="#"><img src="{{asset('img/img-gallery-5.jpg')}}" alt="image gallery 5"></a>
                <a href="#"><img src="{{asset('img/img-gallery-6.jpg')}}" alt="image gallery 6"></a>
            </div>
            <div class="clearfix"></div>
    	</div>
        
        
        <!-- FOOTER BOTTOM -->
        <div class="footer-bottom">
        	<span class="copyright">Theme Created by <a href="#">AD-Theme</a> Copyright © 2016. All Rights Reserved</span>
        	<span class="backtotop">TOP <i class="icon-arrow-up7"></i></span>
            <div class="clearfix"></div>
        </div>
        
        
    </footer>
    
    
    <!-- *****************************************************************
    ** Script ************************************************************
    ****************************************************************** -->
    	
</body>
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('js/slippry.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>
