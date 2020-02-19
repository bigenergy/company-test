<?php

namespace App\Repositories\Worker;

use App\Models\Worker;
use App\Repositories\AbstractRepository;

class EloquentWorkerRepository extends AbstractRepository implements WorkerRepository
{
    /**
     * @var Worker
     */
    private $model;

    /**
     * EloquentProductRepository constructor.
     * @param Worker $worker
     */
    public function __construct(Worker $worker)
    {
        $this->model = $worker;
        parent::__construct($worker);
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->model->with($relations)->get();
    }

    /**
     * @param int $id
     * @param array $relations
     * @return Worker|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function getByIdRelation($id, $relations = [])
    {
        return $this->model->with($relations)->where('id', $id)->firstOrFail();
    }

    /**
     * @param $id
     * @param array $relations
     * @return Worker[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllDepartmentWorkers($id, $relations = [])
    {
        return $this->model->with($relations)->where('department_id', $id)->get();
    }

}