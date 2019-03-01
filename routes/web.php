<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/holaMundo', function (){
    return "hola Mundo";
});

$router->post('/crearUsuarios', ["uses"=>"UserController@createUser1"]);

$router->post('/login', ["uses"=>"UserController@login"]);

$router->post('/nickname', ["uses"=>"UserController@nickname"]);

$router->post('/post', ["uses"=>"PostController@createPost"]);

$router->post('/getPosts', ["uses"=>"PostController@getPosts"]);

$router->post('/post/{id}', ["uses"=>"PostController@getPostsbyID"]);

$router->post('/posts/{id}', ["uses"=>"PostController@getPostsbyUserID"]);

$router->put('/post/{id}', ["uses"=>"PostController@updatePost"]);

$router->delete('/post/{id}', ["uses"=>"PostController@deletePost"]);

$router->post('/file', ["uses"=>"PostController@uploadFile"]);

$router->get('/key', function(){
	return str_random(32);
});

$router->group(["middleware" => ['auth']], function() use($router){
    $router->get('/users', ["uses"=>"UserController@index"]);
    
    $router->get('/user/{id}', ["uses"=>"UserController@getUser"]);
    
    $router->delete('/user/{id}', ["uses"=>"UserController@deleteUser"]);
    
    $router->put('/user/{id}', ["uses"=>"UserController@updateUser"]);

    $router->get('/index', ["uses"=>"PostController@index"]);
});

//Rutas comentarios
$router->post('/createCommentary', ["uses"=>"CommentaryController@createCommentary"]);

//
$router->post('/getComments', ["uses"=>"CommentaryController@getComments"]);

$router->post('/commentary/{id}', ["uses"=>"CommentaryController@getCommentsbyID"]);

$router->post('/CommentsUsers/{id}', ["uses"=>"CommentaryController@getCommentsbyUserID"]);

$router->post('/CommentsPosts/{id}', ["uses"=>"CommentaryController@getCommentsbyPostID"]);
//

$router->put('/commentary/{id}', ["uses"=>"CommentaryController@updateCommentary"]);

$router->delete('/commentary/{id}', ["uses"=>"CommentaryController@deleteCommentary"]);

$router->post('/file', ["uses"=>"CommentaryController@uploadFile"]);

//Rutas likes
$router->post('/createLikePost', ["uses"=>"LikeController@createLikePost"]);

$router->post('/createLikeCommentary', ["uses"=>"LikeController@createLikeCommentary"]);

//
$router->post('/getLikes', ["uses"=>"LikeController@getLikes"]);

$router->post('/like/{id}', ["uses"=>"LikeController@getLikesbyID"]);

$router->post('/likesUsers/{id}', ["uses"=>"LikeController@getLikesbyUserID"]);

$router->post('/likesPosts/{id}', ["uses"=>"LikeController@getLikesbyPostID"]);

$router->post('/likesComments/{id}', ["uses"=>"LikeController@getLikesbyCommentaryID"]);
//

$router->put('/likePost/{id}', ["uses"=>"LikeController@updateLikePost"]);

$router->put('/likeCommentary/{id}', ["uses"=>"LikeController@updateLikeCommentary"]);

$router->delete('/like/{id}', ["uses"=>"LikeController@deleteLike"]);