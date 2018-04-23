<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('xxx', function(){
	return view('xxx');
});

Route::get('crawler', function() {
    $crawler = Goutte::request('GET', 'http://dantri.com.vn/su-kien.htm');
    $crawler->filter('a.fon6')->each(function ($node) {
      echo $node->text(). "<br>";
    });
});
Auth::routes();
Route::middleware('auth')->group(function(){

Route::get('posts', 'UserController\PostUserController@index');
Route::get('postedPosts', 'UserController\PostUserController@postedPosts');
Route::get('browsingPosts', 'UserController\PostUserController@browsingPosts');
Route::get('cancelledPosts', 'UserController\PostUserController@cancelledPosts');
Route::post('posts/store', 'UserController\PostUserController@store');
Route::get('posts/edit/{id}', 'UserController\PostUserController@getData');
Route::delete('posts/{id}', 'UserController\PostUserController@delete');
Route::post('posts/update', 'UserController\PostUserController@updatePost');
Route::post('getReason/{id}', 'UserController\PostUserController@getReason');
});
Route::group(['prefix'=>'admin'], function() {
		/*
		*
		* manage login admin
		*@param  
		*@param  
		*@return 
		*/
	
		Route::get('login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'AdminAuth\AdminLoginController@login');
        Route::post('logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');

        // Registration Routes...
        Route::get('register', 'AdminAuth\AdminRegisterController@showRegistrationForm')->name('admin.register');
        Route::post('register', 'AdminAuth\AdminRegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('password/reset', 'AdminAuth\ResetPasswordController@reset');



        /*
        *
        *Page manager
        *@param  
        *@param  
        *@return 
        */
	    Route::middleware('auth:admin')->group(function(){
	    	Route::get('/','PostController@index')->name('posts.index');
			
			Route::group(['prefix'=>'product'],function(){

				Route::get('/','ProductController@index');

				Route::delete('product/{id}','ProductController@delete');

				Route::post('product/store','ProductController@store');

				Route::post('product/getProduct/{id}','ProductController@getProduct');

				Route::post('product/update','ProductController@updateProduct');
			});
			Route::group(['prefix'=>'tags'],function(){

				Route::get('/','TagController@index')->name('product.index');

				Route::delete('{id}','TagController@delete');

				Route::post('store','TagController@store');

				Route::get('getData/{id}','TagController@getData');

				Route::post('update','TagController@updateTag');
			});	
			Route::prefix('posts')->group(function(){
				

				Route::get('/','PostController@index')->name('posts.index');
				Route::get('browsingPosts','PostController@browsingPosts')->name('posts.index');
				Route::get('postedPosts','PostController@postedPosts')->name('posts.index');
				Route::get('cancelledPosts','PostController@cancelledPosts');

				Route::delete('/{id}','PostController@delete')->name('post.delete');

				Route::post('store','PostController@store')->name('post.store');

				Route::post('changeStatus','PostController@changeStatus');

				Route::get('edit/{id}','PostController@getData')->name('post.show');

				Route::post('update','PostController@updatePost')->name('post.update');

				Route::post('getReason/{id}','PostController@getReason');
				
			});
			Route::group(['prefix'=>'categories'],function(){

				Route::get('/','CategoryController@index')->name('posts.index');

				Route::delete('/{id}','CategoryController@delete')->name('post.delete');

				Route::post('store','CategoryController@store')->name('post.store');

				Route::get('edit/{id}','CategoryController@getData')->name('post.show');

				Route::post('update','CategoryController@updateProduct')->name('post.update');
			});
			Route::group(['prefix'=>'users'],function(){

				Route::get('/','UserController@index')->name('users.index');

				Route::delete('/{id}','UserController@delete')->name('post.delete');

				Route::post('store','UserController@store')->name('post.store');

				Route::get('edit/{id}','UserController@getData')->name('post.show');

				Route::post('update','UserController@updateUser')->name('post.update');
			});
		});
});
/*Route:group(['domain'=>'127.0.0.1:8800'],'prefix'=>'product',function(){});*/
/*Route::resource('product','ProductController')->only(['index','store']);*/
// except
Route::get('/','FontController@index');
Route::get('test','FontController@test');
Route::get('poster/{slug}','FontController@post');
Route::get('category/{slug}','FontController@category');
Route::post('upComment','CommentController@createComment');





// Route::get('home-1-collumn',function(){
// 	return view('templet/home-1-collumn');
// });
// Route::get('home-1-collumns-with-sidebar',function(){
// 	return view('templet/index');
// });
// Route::get('home-2-collumns-with-sidebar',function(){
// 	return view('templet/index');
// });
// Route::get('home-2-collumns',function(){
// 	return view('templet/home-2-collumn');
// });
// Route::get('home-3-collumns',function(){
// 	return view('templet/index');
// });
// Route::get('page',function(){
// 	return view('templet/page');
// });
// Route::get('page-with-right-sidebar',function(){
// 	return view('templet/page-with-right-sidebar');
// });
// Route::get('page-with-left-sidebar',function(){
// 	return view('templet/page-with-left-sidebar');
// });
// Route::get('post',function(){
// 	return view('templet/post');
// });
// Route::get('post-with-right-sidebar',function(){
// 	return view('templet/post-with-right-sidebar');
// });
// Route::get('post-with-left-sidebar',function(){
// 	return view('templet/post-with-left-sidebar');
// });
// Route::get('home-2-collumns-with-sidebar',function(){
// 	return view('templet/index');
// });
// Route::get('no-sticky',function(){
// 	return view('templet/no-sticky');
// });
// Route::get('no-slide',function(){
// 	return view('templet/no-slide');
// });
// Route::get('blog-1-collumn',function(){
// 	return view('templet/blog-collumn-1');
// });
// Route::get('blog-1-collumn-with-sidebar',function(){
// 	return view('templet/blog-collumn-1-with-sidebar');
// });
// Route::get('blog-2-collumns-with-sidebar',function(){
// 	return view('templet/blog-collumn-2-with-sidebar');
// });
// Route::get('blog-2-collumns',function(){
// 	return view('templet/blog-collumn-2');
// });
// Route::get('blog-3-collumns',function(){
// 	return view('templet/blog-collumn-3');
// });
// Route::get('about',function(){
// 	return view('templet/about');
// });
// Route::get('contact',function(){
// 	return view('templet/contact');
// });
// Route::get('login',function(){
// 	return view('templet/login');
// });
// Route::get('test',function(){
// 	return view('products/test');
// });

/*
*
*Router login gmail
*@param  
*@param  
*@return 
*/

Route::get('login/google', 'HomeController@redirectToProvider');
Route::get('login/google/callback', 'HomeController@handleProviderCallback');