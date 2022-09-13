<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

abstract class BaseRequest extends FormRequest
{
    /**
     * Number of items displayed at once if not specified.
     * There is no per_page if it is 0.
     */
    protected int $defaultPerPage = 15;

    /**
     * Maximum per_page that can be set via $_GET['per_page'].
     */
    protected int $maximumPerPage = 100;

    /**
     * Default field for sorting.
     */
    protected string $defaultOrderField = 'id';

    /**
     * Default direction for sorting.
     */
    protected string $defaultOrderDirection = 'asc';

    /**
     * List of available fields for sorting.
     *
     * @var string[]
     */
    protected array $availableOrderFields = [];

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    public function getPerPage(): int
    {
        $perPage = (int)$this->input('limit', $this->defaultPerPage);
        $perPage = ($this->maximumPerPage && $this->maximumPerPage < $perPage) ? $this->maximumPerPage : $perPage;

        return $perPage > 0 ? $perPage : $this->defaultPerPage;
    }

    public function getPage(): int
    {
        $page = (int)$this->input('page', 1);

        return $page > 0 ? $page : 1;
    }

    public function getOrderField(): string
    {
        if ($this->isEmptyString('orderBy')) {
            return $this->defaultOrderField;
        }

        $orderBy = Str::of((string)$this->input('orderBy'));

        $field = $orderBy->endsWith('_desc')
            ? (string)$orderBy->replaceLast('_desc', '')
            : (string)$orderBy;

        return in_array($field, $this->availableOrderFields)
            ? $field
            : $this->defaultOrderField;
    }

    public function getOrderDirection(): string
    {
        if ($this->isEmptyString('orderBy')) {
            return $this->defaultOrderDirection;
        }

        return Str::of((string)$this->input('orderBy'))->endsWith('_desc')
            ? 'desc'
            : 'asc';
    }
}
