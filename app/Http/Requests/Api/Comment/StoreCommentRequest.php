<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Requests\Api\Comment;

use App\Enums\CommentType;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

final class StoreCommentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'text' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', new Enum(CommentType::class)],
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getText(): string
    {
        return $this->input('text');
    }

    public function getType(): CommentType
    {
        return CommentType::from($this->input('type'));
    }
}
