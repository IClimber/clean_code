<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Actions\Comment;

use App\Enums\CommentType;
use App\Models\Article;
use App\Models\Comment;

final class CreateCommentAction
{
    public function execute(Article $article, string $email, string $text, CommentType $type): Comment
    {
        $comment = new Comment();
        $comment->setArticle($article);
        $comment->email = $email;
        $comment->text = $text;
        $comment->type = $type;

        $comment->save();

        return $comment;
    }
}
