<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{Admin\AdminNewsController,
    AboutController,
    AuthController,
    NewsController,
    ErrorController};
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app): void
{
  $app->get('/', [NewsController::class, 'page']);
  $app->post('/', [NewsController::class, 'page']);
  $app->get('/news/page/{page}', [NewsController::class, 'page']);
  $app->post('/news/page/{page}', [NewsController::class, 'page']);
  $app->get('/news/{id}', [NewsController::class, 'details']);

  $app->get('/about', [AboutController::class, 'about']);

  $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
  $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
  $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
  $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
  $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);

  $app->get('/admin/news/page/{page}', [AdminNewsController::class, 'page'])->add(AuthRequiredMiddleware::class);
  $app->get('/admin/news/create', [AdminNewsController::class, 'createView'])->add(AuthRequiredMiddleware::class);
  $app->post('/admin/news/create', [AdminNewsController::class, 'create'])->add(AuthRequiredMiddleware::class);
  $app->get('/admin/news/{id}', [AdminNewsController::class, 'editView'])->add(AuthRequiredMiddleware::class);
  $app->post('/admin/news/{id}', [AdminNewsController::class, 'edit'])->add(AuthRequiredMiddleware::class);
  $app->get('/admin/news/remove/{id}', [AdminNewsController::class, 'remove'])->add(AuthRequiredMiddleware::class);

  $app->setErrorHandler([ErrorController::class, 'notFound']);
}
