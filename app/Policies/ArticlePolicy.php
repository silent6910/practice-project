<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\Model\User $user
     * @param Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\Model\User $user
     * @param Article $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }
}
