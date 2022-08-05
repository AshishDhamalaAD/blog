<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Article $article)
    {
        if ($user->id == $article->user_id) {
            return true;
        }
    }

    public function delete(User $user, Article $article)
    {
        if ($user->id == $article->user_id) {
            return true;
        }
    }
}
