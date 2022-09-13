<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Requests\Api\Comment;

use App\Http\Requests\BaseRequest;

final class IndexCommentRequest extends BaseRequest
{
    /**
     * Default field for sorting.
     */
    protected string $defaultOrderField = 'created_at';

    /**
     * Default direction for sorting.
     */
    protected string $defaultOrderDirection = 'desc';

    /**
     * List of available fields for sorting.
     *
     * @var string[]
     */
    protected array $availableOrderFields = ['created_at'];
}
