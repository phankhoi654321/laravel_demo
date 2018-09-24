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

use App\Post;
use App\User;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/read', function () {
//    $post = DB::select('select * from posts where id = ?', [1]);
//    $post = DB::table('posts')->where('id','1')->get();
    $post = DB::table('posts')->get();
//    $post = DB::table('posts')->pluck('content');
    return $post;
});

Route::get('/delete', function () {
    $delete = DB::delete('delete from posts where id = ?', [4]);
    return $delete;
});

Route::get('/readAll', function () {
    $posts = \App\Post::all();
//   foreach ($posts as $post) {
//      echo $post;
//   }
    return $posts;
});

Route::get('/find/{id}', function ($id) {
    $find = \App\Post::findOrFail($id);
//    $find = DB::table('posts')->find($id);
    return $find;
});

Route::get('/tasks/{id}', function ($id) {
    $task = DB::table('posts')->find($id);
//   dd($task);
    return $task->title;
});

Route::get('/find', function () {
    $find = \App\Post::find([1, 5, 6]);
    return $find;
});

Route::get('findWhere', function () {
    $find = \App\Post::where('title', 'PHP with Laravel 1')->first();
    return $find;
});

Route::get('findMore', function () {
    $post = \App\Post::findOrFail(5);
    return $post;
});

Route::get('insertDemo', function () {
    $post = new Post;
    $post->title = "Demo Javascript";
    $post->content = "Javascript is also good";

    echo $post->save();
});

Route::get('updateDemo', function () {
    $post = Post::find(2);
    $post->title = "Demo Javascript 2";
    $post->content = "Javascript is also good 2";

    echo $post->save();
});

Route::get('create', function () {
    $post = Post::create(['title' => 'ASPDotNet language 2', 'content' => 'ASPDotNet is also good 2']);
    echo $post;
});

Route::get('massUpdate', function () {
    $post = Post::where('is_admin', 0)->where('title', 'AspDotNet')->update(['title' => 'AspDotNet', 'content' => 'AspDotNet is program language develop by MS']);
    return $post;
});

Route::get('deletePost', function () {
    $post = Post::find(8);
    echo $post->delete();

});

Route::get('destroy', function () {
    $post = Post::destroy(10);
    return $post;
});

Route::get('softDelete', function () {
    $post = Post::find(12);
    echo $post->delete();
});

Route::get('forceDelete', function () {
    $post = Post::withTrashed()->where('id', 12)->forceDelete();
    return $post;
});

Route::get('withTrash', function () {
    $post = Post::withTrashed()->get();
//   $post = Post::get();
//    $post = Post::onlyTrashed()->get();
//   $post = Post::where('is_admin',0)->get();
    return $post;
});

Route::get('restore', function () {
    $post = Post::withTrashed()->restore();
    return $post;
});

//One to One relationship
Route::get('/user/{id}/post', function ($id) {
    return User::find($id)->post->content;
});

Route::get('/post/{id}/user', function ($id) {
    return Post::find($id)->user->name;
});

Route::get('/posts', function () {
    $user = User::find(1);
    foreach ($user->posts as $post) {
        echo $post->title . '</br>';
    }
});

Route::get('/user/{id}/roles', function ($id) {
//   $user = User::find($id);
//   foreach ($user->roles as $role) {
//       echo $role->name . "</br>";
//   }

   $roles = User::find($id)->roles()->orderBy('name','desc')->get();

   foreach ($roles as $role) {
       echo $role->name . '</br>';
   }
});

Route::get('role/{id}/user', function ($id){
    $role = \App\Role::find($id);
    foreach ($role->users as $user) {
        echo $role->name . ' ' . $user->name . '</br>';
    }
});

Route::get('user/pivot', function () {
   $user = User::find(1);
   foreach ($user->roles as $role) {
       echo $role->pivot;
   }
});
//Has Many Through
Route::get('user/country', function () {
   $country = \App\Country::find(2);
   foreach ($country->posts as $post) {
       echo $post->title . '</br>';
   }
});

//Polymorphic Relations
Route::get('user/photos', function () {
    $user = User::find(3);
//    echo $user;
    foreach ($user->photos as $photo) {
        echo $photo->path;
    }
});
//Polymorphic Relations
Route::get('post/photos', function () {
    $post = Post::find(2);
//    echo $user;
    foreach ($post->photos as $photo) {
        echo $photo->path;
    }
});

//Route::get('/post/{id}/{name}', function ($id, $name) {
//    return "This is the post number: " . $id . " : " . $name;
//});
//
//Route::get('admin/posts/example', array('as' => 'admin.home', function () {
//    $url = route('admin.home');
//    return "this url is: " . $url;
//}));


//Route::get('post/{id}/{name}/{password}', 'PostsController@showPost');
//
//Route::resource('posts', 'PostsController');
//
//Route::get('contact', 'PostsController@contact');
//
//Route::get('/insert', function () {
////    DB::insert('insert into posts(title, content) values(?, ?)',['PHP with Laravel 1', 'Laravel is the best thing that has happened to PHP 1']);
//    DB::table('posts')->insert(['title'=>'PHP with Laravel', 'content'=>'Laravel is the best thing that has happened to PHP']);
//});