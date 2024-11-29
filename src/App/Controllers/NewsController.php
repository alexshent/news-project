<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\NewsService;
use Framework\TemplateEngine;

class NewsController
{
    const ITEMS_PER_PAGE = 3;

    public function __construct(
        private TemplateEngine $view,
        private NewsService $newsService
    ) {
    }

    public function page(array $params): void
    {
        $page = $params['page'] ?? 1;
        $page = (int) $page;

        $filters = [];
        if (!empty($_POST['search']) ) {
            $filters['search'] = $_POST['search'];
        }
        if (!empty($_POST['datetime'])) {
            $filters['datetime'] = $_POST['datetime'];
        }

        $_SESSION['filters'] = $filters;

        $result = $this->newsService->page($page, self::ITEMS_PER_PAGE, $filters);

        echo $this->view->render("news/list.php", [
            'title' => 'news list',
            'page' => $page,
            'items' => $result['items'],
            'totalPages' => (int) ceil($result['count'] / self::ITEMS_PER_PAGE),
        ]);
    }

    public function details(array $params): void
    {
        $id = (int) $params['id'] ?? 0;
        if (0 === $id) {
            throw new \RuntimeException('News id is empty');
        }

        $item = $this->newsService->read($id);
        echo $this->view->render("news/details.php", [
            'item' => $item,
        ]);
    }
}
