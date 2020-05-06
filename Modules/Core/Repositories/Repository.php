<?php

declare(strict_types = 1);

namespace Modules\Core\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Modules\Core\Contracts\RepositoryContract;
use RuntimeException;

/**
 * Class Repository
 * @package Modules\Core\Repositories
 */
abstract class Repository implements RepositoryContract
{
    /**
     *
     */
    const DEFAULT_PER_PAGE = 15;

    /**
     *
     */
    const DEFAULT_ATTRIBUTE_FIELD = 'id';

    /**
     * @return string
     */
    abstract public function model(): string;

    /**
     * @param array|string[] $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->makeQuery()->get($columns);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->makeQuery()->find($id);
    }
    public function findOrFail(int $id): Model{
        return $this->makeQuery()->findOrFail($id);
    }
    /**
     * @param string $column
     * @param string|null $key
     * @return Collection
     */
    public function pluck(string $column, ?string $key = null): Collection
    {
        return $this->makeQuery()->pluck($column, $key);
    }

    /**
     * @param array $with
     * @return Builder
     */
    public function with(array $with = []): Builder
    {
        return $this->makeQuery()->with($with);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->makeQuery()->create($data);
    }

    /**
     * @param int $perPage
     * @param array|string[] $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = self::DEFAULT_PER_PAGE, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->makeQuery()->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @param $attributeValue
     * @param string $attributeField
     * @return int
     */
    public function update(array $data, $attributeValue, string $attributeField = self::DEFAULT_ATTRIBUTE_FIELD): int
    {
        $data = Arr::only($data, $this->makeModel()->getFillable());

        return $this->makeQuery()->where($attributeField, '=', $attributeValue)
            ->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->makeQuery()->where('id', '=', $id)
            ->delete();
    }

    /**
     * @return Model
     */
    final protected function makeModel(): Model
    {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new RuntimeException('Class ' . $this->model() . ' must be an instance of Illuminate\\Database\\Eloquent\\Model');
        }

        return $model;
    }

    /**
     * @return Builder
     */
    final public function makeQuery(): Builder
    {
        return $this->makeModel()->newQuery();
    }

} 