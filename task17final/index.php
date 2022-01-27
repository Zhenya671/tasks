<?php


use App\Authentication;
use App\AuthenticationException;
use App\Cookie;
use App\Database;
use App\File;
use App\FileUploadException;
use App\Logger;
use App\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

const UPLOAD = '/upload';
const LOGIN = '/login';
const BLOCK_USER = '/blockUser';


$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);

$app = AppFactory::create();
$app->addBodyParsingMiddleware(); // $_POST


$session = new Session();
$sessionMiddleware = function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($session) {
    $session->start();
    $response = $handler->handle($request);
    $session->save();

    return $response;
};

$fileHandler = new File();

$app->add($sessionMiddleware);

$config = include_once 'config/database.php';
$dsn = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

$database = new Database($dsn, $username, $password);
$authentication = new Authentication($database, $session);

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) use ($twig) {

    if (!empty(Cookie::getData('block-user'))) {
        return $response->withHeader('Location', BLOCK_USER)
            ->withStatus(302);
    }

    $body = $twig->render('index.twig', [
        'cookie' => Cookie::getData('email')
    ]);
    $response->getBody()->write($body);
    return $response;

});

$app->get(LOGIN, function (ServerRequestInterface $request, ResponseInterface $response) use ($twig, $session) {

    if (!empty(Cookie::getData('block-user'))) {
        return $response->withHeader('Location', BLOCK_USER)
            ->withStatus(302);
    }

    $body = $twig->render('login.twig', [
        'message' => $session->flush('message'),
        'form' => $session->flush('form'),
        'cookie' => Cookie::getData('email'),
        'cookieBlockUser' => Cookie::getData('email')

    ]);

    $response->getBody()->write($body);
    return $response;

});

$app->get('/blockUser', function (ServerRequestInterface $request, ResponseInterface $response) use ($twig) {

    $body = $twig->render('blockUser.twig', [
        'cookieBlockUser' => Cookie::getData('block-user'),
    ]);

    Cookie::destroy();
    $response->getBody()->write($body);
    return $response;

});

$app->post('/login-post', function (ServerRequestInterface $request, ResponseInterface $response) use ($authentication, $session) {

    $params = (array)$request->getParsedBody();
    $count = $session->getData('loginAttempt');

    try {
        $authentication->login($params['email'], $params['password']);
        Cookie::create($params);

    } catch (AuthenticationException $exception) {

        $session->setData('message', $exception->getMessage());
        Logger::attempt($session->getData('message'), 'Login');
        if (!empty($params['email']) && $count === null) {
            $session->setData('loginAttempt', 1);
        } elseif (!empty($params['email']) && $count === 1) {
            $session->setData('loginAttempt', $count + 1);
        } elseif (!empty($params['email']) && $count === 2) {
            $session->setData('loginAttempt', $count + 1);
        }

        if (!empty($params['email']) && $session->getData('loginAttempt') === 3) {
            Logger::failedAttempt(3, $params['email']);
            $session->flush('loginAttempt');
            Cookie::createForBlocUser($params);

            return $response->withHeader('Location', BLOCK_USER)
                ->withStatus(302);
        }

        $session->setData('form', $params);
        return $response->withHeader('Location', LOGIN)
            ->withStatus(302);
    }

    return $response->withHeader('Location', '/')
        ->withStatus(302);

});

$app->get('/register', function (ServerRequestInterface $request, ResponseInterface $response) use ($twig, $session) {

    if (!empty(Cookie::getData('block-user'))) {
        return $response->withHeader('Location', BLOCK_USER)
            ->withStatus(302);
    }

    $body = $twig->render('register.twig', [
        'message' => $session->flush('message'),
        'form' => $session->flush('form'),
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->post('/register-post', function (ServerRequestInterface $request, ResponseInterface $response) use ($authentication, $session) {

    $params = (array)$request->getParsedBody();

    try {
        $authentication->register($params);
        Cookie::create($params);

    } catch (AuthenticationException $exception) {
        $session->setData('message', $exception->getMessage());
        Logger::attempt($session->getData('message'), 'Register');
        $session->setData('form', $params);
        return $response->withHeader('Location', '/register')
            ->withStatus(302);
    }
    return $response->withHeader('Location', LOGIN)
        ->withStatus(302);

});

$app->get('/logout', function (ServerRequestInterface $request, ResponseInterface $response) use ($session) {

    Cookie::destroy();
    $session->setData('user', null);
    return $response->withHeader('Location', '/')
        ->withStatus(302);

});

$app->get(UPLOAD, function (ServerRequestInterface $request, ResponseInterface $response) use ($twig, $session) {

    if (!empty(Cookie::getData('block-user'))) {
        return $response->withHeader('Location', BLOCK_USER)
            ->withStatus(302);
    }

    $body = $twig->render('upload.twig', [
        'uploadMessage' => $session->flush('uploadMessage'),
        'cookie' => Cookie::getData('email'),
    ]);
    $response->getBody()->write($body);
    return $response;

});

$app->post('/upload-post', function (ServerRequestInterface $request, ResponseInterface $response) use ($session, $fileHandler) {

    $uploadedFiles = $request->getUploadedFiles();
    $uploadedFile = $uploadedFiles['upload'];

    $fileProperties = [
        'filename' => $uploadedFile->getClientFilename(),
        'typeFile' => $uploadedFile->getClientMediaType(),
        'filesize' => $uploadedFile->getSize(),
        'tmp_name' => $uploadedFile->getFilePath()
    ];

    try {
        $fileHandler
            ->set($fileProperties)
            ->maxSize(100)
            ->notEmpty()
            ->type()
            ->executableType()
            ->diskFreeCheck($fileProperties)
            ->name('newFile')
            ->directory("uploads")
            ->upload();


    } catch (FileUploadException $exception) {
        $session->setData('uploadMessage', $exception->getMessage());
        Logger::file($session->getData('uploadMessage'), $fileProperties, 'Upload');
        return $response->withHeader('Location', UPLOAD)
            ->withStatus(302);
    }
    var_dump($fileProperties);
    Logger::file($session->getData('uploadMessage'), $fileProperties, 'Upload');

    return $response->withHeader('Location', UPLOAD)
        ->withStatus(302);

});

$app->run();
