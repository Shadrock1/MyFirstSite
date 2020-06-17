<?php
use Slim\Factory\AppFactory;
use DI\Container;
use App\ValidatorPost;
use App\ValidatorUser;
use App\PostRepository;
use function Stringy\create as s;
use App\UserRepository;
use Slim\Middleware\MethodOverrideMiddleware;


require_once 'templates/connection.php';


require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$container->set('renderer', function () {  
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});
$container->set('flash', function () {
    return new Slim\Flash\Messages();
});


AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->add(MethodOverrideMiddleware::class);






$app->get('/', function ($request, $response) use ($link){

    $query = "SELECT * FROM Posts ORDER BY id DESC LIMIT 2";
    $result = mysqli_query($link ,$query);
    while ($post = mysqli_fetch_array($result)){
        $posts[] = $post;
    }
    $params = ['posts' => $posts];
    return $this->get('renderer')->render($response, 'index.phtml', $params);
});


$app->get('/posts', function ($request, $response) use ($link) {
    $flash = $this->get('flash')->getMessages();
    $query = "SELECT * FROM Posts";
    $result = mysqli_query($link ,$query);
    while ($post = mysqli_fetch_array($result)){
        $posts[] = $post;
    }
    $params =['posts' => $posts,
            'flash' => $flash
        ];
    return $this->get('renderer')->render($response, 'Posts/posts.php', $params);
})->setName('postsall');


$app->get('/search', function ($request, $response) use ($link) {
    $term = $request->getQueryParam('term');
    $term = trim($term);
    $query = "SELECT * FROM Posts";
    $result = mysqli_query($link, $query);
    while ($post = mysqli_fetch_array($result)){
        $posts[] = $post;
    }
    $searchpost = collect($posts)->filter(function ($post) use ($term){
        if(!empty($term)){
            return s($post['name'])->startsWith(s($term), false);
        }
      });
        $params = ['searchpost' => $searchpost, 'term' => $term];
        return $this->get('renderer')->render($response, 'Posts/search.php', $params);
})->setName('search');


$app->get('/posts/new', function ($request, $response) {
    $params =[
        'post' => ['id' => '', 'name' => '', 'post' => ''],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, 'Posts/newpost.phtml', $params);
})->setName('newpost');


$app->get('/posts/{id}', function ($request, $response, $args) use ($link){
    $id = $args['id'];
    $query = "SELECT * FROM Posts WHERE id = $id";
    $result = mysqli_query($link, $query);
    while ($post = mysqli_fetch_array($result)){
        $posts[] = $post;
    }

    if(!$posts) {
        return $response->write('Page not found')
            ->withStatus(404);
    }
    $params = [
        'posts' => $posts
    ];
    return $this->get('renderer')->render($response, 'Posts/post.phtml', $params);
});


$app->post('/posts', function ($request, $response) use ($link){
    $postnew = $request->getParsedBodyParam('post');;
    $validator = new ValidatorPost();
    $errors = $validator->validate($postnew);
    if(count($errors) === 0){
        $name = htmlentities(mysqli_real_escape_string($link, $postnew['name']));
        $post = htmlentities(mysqli_real_escape_string($link, $postnew['post']));
        $query = "INSERT INTO Posts VALUES(NULL, '$name', '$post')";
        $result = mysqli_query($link, $query);

        if($result === true){
        $this->get('flash')->addMessage('success', 'Post has been created');
        return $response->withRedirect('/posts');
        }
    }
    $params = [
        'post' => $postnew,
        'errors' => $errors
    ];
     $response = $response->withStatus(422);
     return $this->get('renderer')->render($response, 'Posts/newpost.phtml', $params);
});


$app->delete('/posts/{id}', function ($request, $response, $args) use ($link){
    $id = $args['id'];
    $query = "DELETE  FROM Posts WHERE id = {$id}";
    $result = mysqli_query($link, $query);
    return $response->withRedirect('/posts');
});

session_start();

$app->get('/user/new', function ($request, $response) {
    $params = [
        'user'=>['login' => ' ', 'password' => ' '],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, 'User/newuser.phtml', $params);
});

$app->post('/user', function ($request, $response) use ($link){
    $validator = new ValidatorUser();
    $user = $request->getParsedBodyParam('user');
    $errors = $validator->validate($user);
    if(count($errors) === 0){
        $query = "SELECT id FROM Users WHERE login='".mysqli_real_escape_string($link, $user['Login'])."'";
        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0)
        {

            return $response->withRedirect('/user/new');

        }else{
            $hash = rand(1, 10);
            $login = $user['Login'];
            $password = password_hash(trim($user['Password']), PASSWORD_DEFAULT);
            mysqli_query($link,"INSERT INTO Users VALUES(NULL, `$login`, `$password`, `$hash`)");
            return $response->withRedirect('/');
        }


    }
    $params = [
        'user' => $user,
        'errors' => $errors
    ];
    $response = $response->withStatus(422);
    return $this->get('renderer')->render($response, 'User/newuser.phtml', $params);
});


$app->get('/login', function ($request, $response) {
    $flash = $this->get('flash')->getMessages();
    $params = [
        'flash' => $flash,
        'user' =>  $_SESSION['user'] ?? null,
        ];
    return $this->get('renderer')->render($response, 'Posts/login.phtml', $params);
});

$app->post('/session', function ($request, $response) {

    $user2 =  $request->getParsedBodyParam('user');
    $user1 = collect($loginuser)->first(function ($user) use ($user2) {
        return $user['login'] === $user2['login'] && $user['passwordDigest'] === $user2['password'];
    });
    if ($user1) {
        $_SESSION['user'] = $user1;
        return $response->withRedirect('User/room.phtml');
    }else {
        $this->get('flash')->addMessage('error', 'Wrong password or login');
        return $response->withRedirect('/login');
    }

});
$app->run();
mysqli_close($link);