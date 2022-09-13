<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Actions\Article;

use App\Actions\Comment\DeleteAllArticleCommentAction;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Throwable;

final class DeleteArticleAction
{
    public function __construct(private readonly DeleteAllArticleCommentAction $deleteAllArticleCommentAction)
    {
    }

    /**
     * @param Article $article
     * @return void
     * @throws Throwable
     */
    public function execute(Article $article): void
    {
        DB::beginTransaction();
        try {
            $article->delete();

            $this->deleteAllArticleCommentAction->execute($article);

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
