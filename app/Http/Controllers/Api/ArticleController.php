<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Controllers\Api;

use App\Actions\Article\CreateArticleAction;
use App\Http\Requests\Api\Article\IndexArticleRequest;
use App\Http\Requests\Api\Article\StoreArticleRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends ApiBaseController
{
    public function index(IndexArticleRequest $request): AnonymousResourceCollection
    {
        $articles = Article::orderBy($request->getOrderField(), $request->getOrderDirection())
            ->paginate($request->getPerPage(), ['*'], 'page', $request->getPage());

        return ArticleResource::collection($articles);
    }

    public function store(StoreArticleRequest $request, CreateArticleAction $createArticleAction): ArticleResource
    {
        $article = $createArticleAction->execute(
            $request->getAuthor(),
            $request->getTitle(),
            $request->getBody(),
            $request->getPublishedAt(),
        );

        return ArticleResource::make($article);
    }
}
