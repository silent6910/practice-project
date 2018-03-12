<?php


namespace App\Repository;

use App\Model\Article;

class ArticleRepository
{
    /**
     * @var Article
     */
    private $model;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->model->select('id', 'title', 'created_at', 'updated_at')->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDetail(int $id)
    {
        return $this->model->select($this->model::COLUMN)->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param Article $article
     * @param array $data
     * @return bool
     */
    public function update(Article $article, array $data)
    {
        return $article->update($data);
    }

    /**
     * @param Article $article
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        return $article->delete();
    }

}