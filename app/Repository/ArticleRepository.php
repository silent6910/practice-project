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
        //todo 正規的laravel作法應該如下註解部分
        // return $this->model
//            ->select('id', 'type', 'title', 'created_at', 'updated_at', 'user_id')
//            ->with('user')
//            ->get();
        $articleCol = ['id', 'type', 'title', 'created_at', 'updated_at', 'user_id'];
        $col = array_map(function ($item) {
            return $this->model->getTable() . '.' . $item;
        }, $articleCol);
        $col[] = 'users.name as author';
        return $this->model->join('users', 'users.id', '=', 'article.user_id')
            ->select(...$col)
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDetail($id)
    {
        return $this->model->select($this->model::COLUMN)->with('user')->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(int $userId, array $data)
    {
        return $this->model->create(array_merge(['user_id' => $userId], $data));
    }

    public function getEditData(int $userId, $id)
    {
        $selectCol = ['id', 'type', 'title', 'content', 'created_at', 'updated_at'];

        return $this->model->select($selectCol)->where('user_id', $userId)->find($id);
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