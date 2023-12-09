<?php

declare(strict_types=1);

use App\Application\Actions\Notification\AddNotificationAction;
use App\Application\Actions\Notification\ListNotificationsAction;


use App\Application\Actions\User\AddUserAction;
use App\Application\Actions\User\FindUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;

use App\Application\Actions\Posts\ListPostsAction;
use App\Application\Actions\Posts\FindPostAction;
use App\Application\Actions\Posts\AddPostAction;
use App\Application\Actions\Posts\DeletePostAction;
use App\Application\Actions\Posts\UpdatePostAction;
use App\Application\Actions\Posts\ListPostTypesAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\Twig;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->post('/user/add', AddUserAction::class);


    $app->get('/addUser', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'addUser.html', [
            'name' => 'REYSEY' /*$args['name']*/
        ]);
    })->setName('Add User');

    $app->group('/notifications', function (Group $group) {
        $group->get('', ListNotificationsAction::class);
        $group->get('/{id}', ListNotificationsAction::class);
        $group->post('/add', AddNotificationAction::class);
    });

    $app->group('/posts'        , function (Group $group) {
        $group->get(''          , ListPostsAction::class);
        $group->get('/types'    , ListPostTypesAction::class);
        $group->get('/{id}'     , FindPostAction::class);
        $group->post('/add'     , AddPostAction::class);
        $group->post('/update'  , UpdatePostAction::class);
        $group->post('/delete'  , deletePostAction::class);
    });

    $app->get('/AddNotification', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'AddNotification.twig', [
            'name' => 'REYSEY' /*$args['name']*/
        ]);
    })->setName('Add User');

    // $app->post('/notification/add', AddNotificationAction::class);
};
