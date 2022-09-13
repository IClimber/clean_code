<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Actions\Comment;

use App\Models\Comment;

final class DeleteCommentAction
{
    public function execute(Comment $comment): void
    {
        $comment->delete();
    }
}
