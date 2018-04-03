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
            ->select('id', 'user_id', 'content', 'created_at', 'updated_at')
            ->where('article_id', $articleId)
            ->with('user:id,name')
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

    /**
     * @param Comment $comment
     * @param array $data
     * @return bool
     */
    public function update(Comment $comment, array $data)
    {
        $updateCol = array_only($data, $comment->getFillableUpdate());
        return $comment->update($updateCol);
    }

    /**
     * @param Comment $comment
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }

}