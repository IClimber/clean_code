<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Actions\Article;

use App\Models\Article;
use Illuminate\Support\Carbon;

final class CreateArticleAction
{
    public function execute(string $author, string $title, string $body, Carbon $publishedAt): Article
    {
        $article = new Article();
        $article->author = $author;
        $article->title = $title;
        $article->body = $body;
        $article->published_at = $publishedAt;

        $article->save();

        return $article;
    }
}
