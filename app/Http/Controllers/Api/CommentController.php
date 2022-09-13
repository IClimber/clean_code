<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Controllers\Api;

use App\Actions\Comment\CreateCommentAction;
use App\Actions\Comment\DeleteCommentAction;
use App\Http\Requests\Api\Comment\IndexCommentRequest;
use App\Http\Requests\Api\Comment\StoreCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class CommentController extends ApiBaseController
{
    public function index(IndexCommentRequest $request, Article $article): AnonymousResourceCollection
    {
        $comments = $article->comments()
            ->orderBy($request->getOrderField(), $request->getOrderDirection())
            ->paginate($request->getPerPage(), ['*'], 'page', $request->getPage());

        return CommentResource::collection($comments);
    }

    public function store(
        StoreCommentRequest $request,
        Article $article,
        CreateCommentAction $createCommentAction
    ): CommentResource
    {
        $comment = $createCommentAction->execute(
            $article,
            $request->getEmail(),
            $request->getText(),
            $request->getType(),
        );

        return CommentResource::make($comment);
    }

    public function destroy(Article $article, Comment $comment, DeleteCommentAction $deleteCommentAction): JsonResponse
    {
        if (!$comment->article->is($article)) {
            return $this->forbidden('No no no');
        }

        $deleteCommentAction->execute($comment);

        return $this->noContent();
    }
}
