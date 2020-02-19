<?php

namespace App\Services\Department;


use App\Models\Department;
use App\Models\Worker;
use App\Repositories\Department\DepartmentRepository;

class DepartmentService
{
    /**
     * @var Department
     */
    private $departmentModel;
    /**
     * @var DepartmentRepository
     */
    public $departmentRepository;
    /**
     * @var Worker
     */
    private $workerModel;

    /**
     * ProductService constructor.
     * @param Department $departmentModel
     * @param DepartmentRepository $departmentRepository
     * @param Worker $workerModel
     */
    public function __construct(
        Department $departmentModel,
        DepartmentRepository $departmentRepository,
        Worker $workerModel
    ) {
        $this->departmentModel = $departmentModel;
        $this->departmentRepository = $departmentRepository;
        $this->workerModel = $workerModel;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function add(array $attributes): bool
    {
        $createdDepartment = $this->departmentModel->fill($attributes);
        $createdDepartment->save();

        return true;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        /** @var Department $updatedDepartment */
        $updatedDepartment = $this->departmentModel->find($id);
        $updatedDepartment->fill($attributes);
        $updatedDepartment->save();

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $departmentToDelete = $this->departmentModel->findOrFail($id);
        $departmentToDelete->delete();

        $workers = $this->workerModel;
        $workers->department()->dissociate();

        return true;
    }
}