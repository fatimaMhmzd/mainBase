<?php

namespace App\Http\Repository;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use function app;
use function request;

abstract class BaseRepository
{
    /** @var Model $model */
    protected Model $model;
    // public $query; todo should make query
    protected int $default_per_page = 15;
    protected bool $default_paginate = true;

    public function setDefaultPerPage($per_page = null)
    {
        if ($per_page && is_int($per_page) && $per_page < 10000) {
            $this->default_paginate = $per_page;
        }
    }

    public function setDefaultPaginate($paginate = null)
    {
        if (isset($paginate) && is_bool($paginate)) {
            $this->default_paginate = $paginate;
        }
    }

    abstract public function model(): string;

    abstract public function relations(): array;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    #[Pure] public function getFillable(): array
    {
        return $this->model->getFillable() ?? [];
    }

    /*public function queryByInputs(Builder $query, $inputs = []): Builder
    {
        if (!empty($inputs)) {
            foreach ($inputs as $keyInput => $valueInput) {
                if ((in_array($keyInput, $this->getFillable()) || $keyInput == 'id') && (is_string($valueInput) || is_int($valueInput))) {
                    $query = $this->by($query, $keyInput, $valueInput);
                }
            }
        }
        return $query;
    }*/

    public function queryByInputs(Builder $query, $inputs = []): Builder
    {
        if (!empty($inputs)) {
            foreach ($inputs as $keyInput => $valueInput) {
                if ((in_array($keyInput, $this->getFillable()) || $keyInput == $this->model->getKeyName()) && (is_string($valueInput) || is_int($valueInput) || is_array($valueInput) || is_object($valueInput))) {
                    if (method_exists($this->model, 'getCasts') && !empty($this->model->getCasts()) && $casts = $this->model->getCasts()) {
                        if (is_object($valueInput)) {
                            if (isset($valueInput->operator)) {
                                if (is_array($valueInput->value)) {
                                    if ($valueInput->operator == "Not" || $valueInput->operator == "not") {
                                        $query = $this->byArray($query, $keyInput, $valueInput->value, "Not");
                                    } elseif ($valueInput->operator == "Between" || $valueInput->operator == "between") {
                                        $query = $this->byBetween($query, $keyInput, $valueInput->value);
                                    } else {
                                        $query = $this->byArray($query, $keyInput, $valueInput->value);
                                    }
                                } else {
                                    $query = $this->byOperator($query, $keyInput, $valueInput->value, $valueInput->operator);
                                }
                            } else {
                                if (is_array($valueInput->value)) {
                                    $query = $this->byArray($query, $keyInput, $valueInput->value);
                                } else {
                                    $query = $this->by($query, $keyInput, $valueInput);
                                }
                            }

                        } else if (is_array($valueInput)) {
                            $query = $this->byArray($query, $keyInput, $valueInput);
                        } else {
                            $valueCast = $casts[$keyInput] ?? null;
                            if ($valueCast == 'string') {
                                $query = $this->byLike($query, $keyInput, $valueInput);
                                # todo $query = $this->by($query, $keyInput, $valueInput);
                            } elseif ($valueCast == 'date') {
                                $query = $this->byDate($query, $keyInput, $valueInput);
                            } else {
                                $query = $this->by($query, $keyInput, $valueInput);
                            }
                        }
                    } else {
                        $query = $this->by($query, $keyInput, $valueInput);
                    }
                }
            }
        }
        return $query;
    }

    public function queryByRelations(/*Builder*/ $query = null, array|bool $relations = []): Builder
    {
        // if (!empty($relations)  /*&& in_array($relations, $this->relations()) */) {
        //     $query = $query->with($relations);
        // }
        if (isset($relations) && is_array($relations)) {
            return $this->withRelations(query: $query, relations: $relations);
        }elseif(isset($relations) && is_bool($relations) && $relations){
            return $this->withRelations(query:$query,relations:$this->relations());
        }
        return $query;
    }

    public function querySelects(Builder $query, $selects = []): Builder
    {
        if (!empty($selects)) {
            $query = $query->select($selects);
        }

        return $query;
    }

    public function queryFull($inputs = [], $relations = [], $selects = [], $orderByColumn = 'id', $directionOrderBy = 'desc',$query =null): Builder
    {
        /** @var Builder $query */
        $query = $query ?? $this->model->query();
        $query = $this->queryByInputs($query, $inputs);
        $query = $this->queryByRelations($query, $relations);
        $query = $this->querySelects($query, $selects);
        return $this->orderBy($query, $orderByColumn, $directionOrderBy);
    }

    public function all($inputs = [], $relations = [], $selects = [], $orderByColumn = 'id', $directionOrderBy = 'desc'): Collection
    {
        return $this->queryFull($inputs, $relations, $selects, $orderByColumn, $directionOrderBy)->get();
    }


    public function orderBy(Builder $query, $orderByColumn = 'id', $directionOrderBy = 'desc'): Builder
    {
        return $query->orderBy($orderByColumn, $directionOrderBy);
    }

    public function paginate($perPage = null, $inputs = [], $relations = [], $selects = [], $orderByColumn = 'id', $directionOrderBy = 'desc'): LengthAwarePaginator
    {
        $perPage = $perPage ?? request('per_page') ?? request('perPage') ?? $this->default_per_page;
        return $this->queryFull(inputs: $inputs, relations: $relations, selects: $selects, orderByColumn: $orderByColumn, directionOrderBy: $directionOrderBy)->paginate($perPage);
    }

    public function resolve_paginate($perPage = null, $inputs = [], $relations = [], $selects = [], $orderByColumn = 'id', $directionOrderBy = 'desc', $paginate = null, Builder $query = null): LengthAwarePaginator|Collection
    {
        $paginate = isset($paginate) && !is_bool($paginate) ? $paginate : request(key:'paginate',default: $this->default_paginate);
        $perPage = $perPage ?? request('per_page') ?? request(key:'perPage',default: $this->default_per_page);
        if (!isset($query)) {
            $query = $this->queryFull(inputs: $inputs, relations: $relations, selects: $selects, orderByColumn: $orderByColumn, directionOrderBy: $directionOrderBy);
        }
        return
            $paginate
                ?
                $query->paginate(perPage: $perPage)
                :
                $query->get();
    }

    public function getBy($col, $value, $limit = 15)
    {
        return $this->model->where($col, $value)->limit($limit)->get();
    }

    public function byArray(Builder $query, $col, array $values, $operator = null): Builder
    {
        if ($operator == "Not") {
            return $query->whereNotIn($col, $values);
        }
        return $query->whereIn($col, $values);
    }

    public function by(Builder $query, $col, $value): Builder
    {
        return $query->where($col, $value);
    }

    public function byOperator(Builder $query, $col, $value, $operator): Builder
    {
        return $query->where($col, $operator, $value);
    }

    public function byDate(Builder $query, $col, $value): Builder
    {
        return $query->whereDate($col, $value);
    }

    public function byBetween(Builder $query, $col, $values): Builder
    {
        return $query->whereBetween($col, $values);
    }

    public function byLike(Builder $query, $col, $value): Builder
    {
        return $query->where($col, 'like', '%' . $value . '%');
    }

    public function byFirstLike(Builder $query, $col, $value): Builder
    {
        return $query->whereLike($col, 'like', $value . '%');
    }

    public function byEndLike(Builder $query, $col, $value): Builder
    {
        return $query->whereLike($col, 'like', '%' . $value);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $attributes = [], array $values = [])
    {
        return $this->model->firstOrCreate($attributes, $values);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findWithRelations($id, $relations = []): mixed
    {
        if (empty($relations)) {
            $relations = $this->relations();
        }

        return $this->model->with($relations)->find($id);
    }

    public function withRelations($query = null, string|array $relations = null): mixed
    {
        if (is_null($query)) {
            $query = $this->model->query();
        }
        if (isset($relations) && !empty($relations)) {
            if (is_string($relations)) {
                $relations = [$relations];
            }
            $relations_available = $this->relations() ?? [];
            $relations = array_intersect($relations_available, $relations);
            return $query->with($relations);
        }
        return $query;
    }

    public function findBy($col, $value, $relations = []): mixed
    {
        if (!empty($relations)) {
            return $this->model->with($relations)->where($col, $value)->first();
        }

        return $this->model->where($col, $value)->first();
    }

    public function findWithInputs($inputs, $relations = []): null|object
    {
        /** @var Builder $query */
        $query = $this->model->query();
        foreach ($inputs as $keyInput => $valueInput) {
            if ((in_array($keyInput, $this->getFillable()) || $keyInput == $this->model->getKeyName())) {
                $query = $query->where($keyInput, $valueInput);
            }
        }
        if (!empty($relations)) {
            $query = $query->with($relations);
        }
        return $query->first();
    }

    public function findFull($inputs, $relations = [], $selects = []): null|object
    {
        /** @var Builder $query */
        $query = $this->model->query();
        foreach ($inputs as $keyInput => $valueInput) {
            if ((in_array($keyInput, $this->getFillable()) || $keyInput == $this->model->getKeyName())) {
                $query = $query->where($keyInput, $valueInput);
            }
        }
        $query = $this->queryByRelations($query, $relations);
        $query = $this->querySelects($query, $selects);
        return $query->first();
    }

    public function update($model, array $data)
    {
        /** @var Model $model */
        return $model->update($data);
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function forceDelete($model)
    {
        return $model->forceDelete();
    }

    public function exists($id)
    {
        return $this->model->where($this->model->getKeyName(), $id)->exists();
    }

    public function getByInput($filters = [], $perPage = 300, $pageNumber = 1, $relations = [],$orderByColumn = 'id', $directionOrderBy = 'desc')
    {
        $query = $this->model;
        foreach ($filters as $filter) {
            if ($filter->like) {
                $query = $query->where($filter->col, 'like', '%' . $filter->value . '%');
            } else {
                $query = $query->where($filter->col, $filter->value);
            }
        }
        if (count($relations) > 0) {
            $query = $this->queryByRelations($query, $relations);
        }
        $query->orderBy($orderByColumn, $directionOrderBy);
        return $query->paginate($perPage, ['*'], 'page', $pageNumber)->getCollection();
    }

    public function createQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model->query();
    }

    public function limit($limit = 15 , $orderByColumn = 'id', $directionOrderBy = 'desc')
    {
        return $this->model->orderBy($orderByColumn, $directionOrderBy)->limit($limit)->get();
    }

    public function getNull($col, $limit = 15, $operator = null, $orderByColumn = 'id', $directionOrderBy = 'desc')
    {
        if ($operator == "Not") {
            return $this->model->whereNotNull($col)->limit($limit)->get();

        }
        return $this->model->whereNull($col)->limit($limit)->get();
    }
}
