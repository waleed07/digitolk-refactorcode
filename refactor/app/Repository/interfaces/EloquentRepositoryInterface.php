<?php

namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /** Get all data
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $conditons = [],array $columns= ['*'],array $relations = []) : Collection;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes) : ?Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function first(array $conditons = [],array $columns= ['*'],array $relations = []) : ?Model;

    /** find model by id
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
        int $modelId,
        array $columns= ['*'],
        array $relations = [],
        array $appends = []
    ) : ?Model;

    /** UPDATE MODEL
     * @param int $modelId
     * @param array $attributes
     * @return bool
     */
    public function update(int $modelId , array $attributes,array $conditions = []) : bool;

    /** UPDATE or create MODEL
     * @param int $modelId
     * @param array $attributes
     * @return bool
     */
    public function updateOrCreate(array $matchKey , array $attributes) : ?Model;

    /**
     * @param int $modelId
     * @return bool
     */
    public function delete(int $modelId) : bool;

    /** show model by id
     * @param int $modelId
     * @return bool
     */
    public function show(int $modelId) : ?Model;

    /** find model by key
     * @param int $key
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findByKey(
        array $conditons = [],
        array $columns= ['*'],
        array $relations = []
    ) : ?Model;

    public function with(array $array) : ?Model;

    public function findOrFail(int $id) : ?Model;

    public function findBySlug(string $slug) : ?Model;
    
}
