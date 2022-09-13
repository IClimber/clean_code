<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Actions\Comment;

use App\Models\Article;
use App\Models\Comment;

final class DeleteAllArticleCommentAction
{
    public function execute(Article $article): void
    {
        Comment::whereArticleId($article->getKey())->delete();
    }
}
