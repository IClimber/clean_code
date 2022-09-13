<?php

namespace App\Models;

use App\Casts\CommentTypeCast;
use App\Enums\CommentType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Comment
 *
 * @property-read int $id
 * @property int $article_id
 * @property string $email
 * @property string $text
 * @property CommentType $type
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 * @property-read Article $article
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereArticleId($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereEmail($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereText($value)
 * @method static Builder|Comment whereType($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_id',
        'email',
        'text',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'article_id' => 'int',
        'email' => 'string',
        'text' => 'string',
        'type' => CommentTypeCast::class,
    ];

    /* ************************ RELATIONS ************************ */

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /* ************************ METHODS ************************ */

    public function setArticle(Article $article): void
    {
        $this->article()->associate($article);
    }
}
