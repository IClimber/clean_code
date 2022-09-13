<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Requests\Api\Article;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;

final class StoreArticleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            'author' => ['required', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:65000'],
            'published_at' => ['required', 'date_format:Y-m-d H:i'],
        ];
    }

    public function getAuthor(): string
    {
        return $this->input('author');
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getBody(): string
    {
        return $this->input('body');
    }

    public function getPublishedAt(): Carbon
    {
        return Carbon::parse($this->input('published_at'));
    }
}
