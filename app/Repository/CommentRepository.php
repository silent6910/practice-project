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
     * @param $articleId
     * @return mixed
     */
    public function getArticleComment($articleId)
    {
        return $this->model
            ->select('id', 'content', 'created_at', 'updated_at')
            ->where('article_id', $articleId)
            ->paginate(15);
    }

    /**
     * @param int $articleId
     * @param int $userId
     * @param array $requestData
     * @return mixed
     */
    public function store(int $articleId, int $userId, array $requestData)
    {
        $requestData = array_merge(['article_id' => $articleId, 'user_id' => $userId], $requestData);
        return $this->model->create($requestData);
    }

}