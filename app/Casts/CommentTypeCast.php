<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Casts;

use App\Enums\CommentType;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

final class CommentTypeCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): CommentType
    {
        return CommentType::from($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (!$value instanceof CommentType) {
            throw new InvalidArgumentException('The given value is not a CommentType instance.');
        }

        return $value->value;
    }
}
