<?php

namespace DTApi\Repository;

use Validator;
use Illuminate\Database\Eloquent\Model;
use DTApi\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repository\Interfaces\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $validationRules = [];

    /**
     * @param Model $model
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function validatorAttributeNames()
    {
        return [];
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all(array $conditons = [],array $columns = ['*'], array $relations = []): Collection
    {
        // TODO: Implement all() method.
        return $this->model->with($relations)->where($conditons)->get($columns);
    }


    /**
     * @param integer $id
     * @return Model|null
     */
    public function find(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        // TODO: Implement findById() method.
        return $this->model->select($columns)->with($relations)->findorFail($modelId)->append($appends);
    }

    public function with(array $array): ?Model
    {
        return $this->model->with($array);
    }

    /**
     * @param integer $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param string $slug
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findBySlug(string $slug): ?Model
    {

        return $this->model->where('slug', $slug)->first();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->query();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function instance(array $attributes = [])
    {
        $model = $this->model;
        return new $model($attributes);
    }

    /**
     * @param int|null $perPage
     * @return mixed
     */
    public function paginate($perPage = null)
    {
        return $this->model->paginate($perPage);
    }

    public function where($key, $where)
    {
        return $this->model->where($key, $where);
    }

    /**
     * @param array $data
     * @param null $rules
     * @param array $messages
     * @param array $customAttributes
     * @return \Illuminate\Validation\Validator
     */
    public function validator(array $data = [], $rules = null, array $messages = [], array $customAttributes = [])
    {
        if (is_null($rules)) {
            $rules = $this->validationRules;
        }

        return Validator::make($data, $rules, $messages, $customAttributes);
    }

    /**
     * @param array $data
     * @param null $rules
     * @param array $messages
     * @param array $customAttributes
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data = [], $rules = null, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->validator($data, $rules, $messages, $customAttributes);
        return $this->_validate($validator);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data = []) :?Model
    {
        return $this->model->create($data);
    }

    /** UPDATE MODEL
     * @param int $modelId
     * @param array $attributes
     * @return bool
     */
    public function update(int $modelId, array $attributes, array $conditions = []): bool
    {
        // TODO: Implement update() method.
        $model = $this->findById($modelId);
        return $model->where($conditions)->update($attributes);
    }

    /**
     * @param integer $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id) : bool
    {
        $model = $this->findOrFail($id);
        $model->delete();
        return $model;
    }

    /**
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     * @throws ValidationException
     */
    protected function _validate(\Illuminate\Validation\Validator $validator)
    {
        if (!empty($attributeNames = $this->validatorAttributeNames())) {
            $validator->setAttributeNames($attributeNames);
        }

        if ($validator->fails()) {
            return false;
            throw (new ValidationException)->setValidator($validator);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function show(int $modelId): ?Model
    {
        // TODO: Implement show() method.
        $model = $this->findById($modelId);
        return $model;
    }

    public function findByKey(array $conditons = [], array $columns = ['*'], array $relations = []): ?Model
    {
        // TODO: Implement findByKey() method.
        $model = $this->model->select($columns)->with($relations)->where($conditons)->first();
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        // TODO: Implement findById() method.
        return $this->model->select($columns)->with($relations)->findorFail($modelId)->append($appends);
    }

}