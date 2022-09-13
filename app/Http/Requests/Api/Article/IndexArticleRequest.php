<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Requests\Api\Article;

use App\Http\Requests\BaseRequest;

final class IndexArticleRequest extends BaseRequest
{
    /**
     * Default field for sorting.
     */
    protected string $defaultOrderField = 'published_at';

    /**
     * Default direction for sorting.
     */
    protected string $defaultOrderDirection = 'desc';

    /**
     * List of available fields for sorting.
     *
     * @var string[]
     */
    protected array $availableOrderFields = ['id', 'author', 'published_at'];
}
