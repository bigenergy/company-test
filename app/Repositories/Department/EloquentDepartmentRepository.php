<?php

namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\AbstractRepository;

class EloquentDepartmentRepository extends AbstractRepository implements DepartmentRepository
{
    /**
     * @var Department
     */
    private $model;

    /**
     * EloquentProductRepository constructor.
     * @param Department $department
     */
    public function __construct(Department $department)
    {
        $this->model = $department;
        parent::__construct($department);
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = [])
    {
        return $this->model->with($relations)->get();
    }
}