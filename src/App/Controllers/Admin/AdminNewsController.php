<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Services\NewsService;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class AdminNewsController
{
    const ITEMS_PER_PAGE = 3;

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private NewsService $newsService
    ) {
    }

    public function page(array $params): void
    {
        $page = $params['page'] ?? 1;
        $page = (int) $page;
        $result = $this->newsService->page($page, self::ITEMS_PER_PAGE);

        echo $this->view->render("admin/news/list.php", [
            'title' => 'news list admin',
            'page' => $page,
            'items' => $result['items'],
            'totalPages' => (int) ceil($result['count'] / self::ITEMS_PER_PAGE),
        ]);
    }

    public function createView(): void
    {
        echo $this->view->render("admin/news/create.php");
    }

    public function create(): void
    {
        $this->validatorService->validateNews($_POST);
        $this->newsService->create($_POST);

        redirectTo('/');
    }

    public function editView(array $params): void
    {
        $news = $this->newsService->read(
            (int) $params['id']
        );

        if (!$news) {
            redirectTo('/');
        }

        echo $this->view->render('admin/news/edit.php', [
            'news' => $news
        ]);
    }

    public function edit(array $params): void
    {
        $news = $this->newsService->read(
            (int) $params['id']
        );

        if (!$news) {
            redirectTo('/');
        }

        $this->validatorService->validateNews($_POST);
        $this->newsService->update($news['id'], $_POST);
        redirectTo('/admin/news/page/1');
    }

    public function remove(array $params): void
    {
        $this->newsService->remove((int) $params['id']);
        redirectTo('/admin/news/page/1');
    }
}
