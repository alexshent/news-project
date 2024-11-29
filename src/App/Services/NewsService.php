<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class NewsService
{
    public function __construct(private Database $db)
    {
    }

    public function create(array $formData): void
    {
        $this->db->query(
            "INSERT INTO news(title, short_description, content) VALUES (:title, :short_description, :content)",
            [
                'title' => $formData['title'],
                'short_description' => $formData['short_description'],
                'content' => $formData['content'],
            ]
        );
    }

    public function read(int $id): array
    {
        return $this->db->query("SELECT * FROM news WHERE id = :id", [
            'id' => $id,
        ])->find();
    }

    public function update(int $id, array $formData): void
    {
        $this->db->query(
            "UPDATE news SET title = :title, short_description = :short_description, content = :content WHERE id = :id",
            [
                'title' => $formData['title'],
                'short_description' => $formData['short_description'],
                'content' => $formData['content'],
                'id' => $id,
            ]
        );
    }

    public function remove(int $id): void
    {
        $this->db->query(
            "DELETE FROM news WHERE id = :id",
            [
                'id' => $id
            ]
        );
    }

    public function page(int $page, int $itemsPerPage, array $filters = []): array
    {
        $offset = ($page - 1) * $itemsPerPage;
        $where = '';

        if (count($filters) > 0) {
            $where =  'WHERE TRUE';

            if (!empty($filters['search'])) {
                $needle = $filters['search'];
                $where .= " AND (title LIKE '%$needle%' OR short_description LIKE '%$needle%' OR content LIKE '%$needle%')";
            }

            if (!empty($filters['datetime'])) {
                $datetime = $filters['datetime'];
                $formattedDatetime = date("Y-m-d H:i:s", strtotime($datetime));
                $where .= " AND created_at >= '$formattedDatetime'";
            }
        }

        $items = $this->db->query("SELECT * FROM news $where ORDER BY created_at DESC LIMIT $itemsPerPage OFFSET $offset", [])->findAll();
        $count = (int) $this->db->query("SELECT COUNT(*) FROM news", [])->count();

        return [
            'items' => $items,
            'count' => $count,
        ];
    }
}
