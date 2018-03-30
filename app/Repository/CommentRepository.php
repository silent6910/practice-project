<?php


namespace App\Repository;

use App\Model\Comment;

class CommentRepository
{
    private $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * @param int $articleId
     * @param int $userId
     * @param array $data
     * @return mixed
     */
    public function store(int $articleId,int $userId, array $data)
    {
        $data = array_merge(['article_id' => $articleId, 'user_id' => $userId], $data);
        return $this->model->create($data);
    }

}