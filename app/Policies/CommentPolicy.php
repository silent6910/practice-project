<?php

namespace App\Policies;

use App\Model\Article;
use App\Model\Comment;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\Model\User $user
     * @param Comment $comment
     * @return bool
     */
    public function update(User $user,Article $article, Comment $comment)
    {
        return ($article->id === $comment->article_id) && ($user->id === $comment->user_id);
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\Model\User $user
     * @param Comment $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
