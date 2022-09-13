<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Resources\Comment;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Comment $comment */
        $comment = $this->resource;

        return [
            'id' => $comment->id,
            'email' => $comment->email,
            'text' => $comment->text,
            'type' => $comment->type,
        ];
    }
}
