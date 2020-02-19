<?php

namespace App\Repositories\Worker;

interface WorkerRepository
{
    /**
     * @param array $relations
     * @return mixed
     */
    public function getAll($relations = []);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param int $id
     * @param array $relations
     * @return mixed
     */
    public function getByIdRelation(int $id, $relations = []);

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function getAllDepartmentWorkers($id, $relations = []);
}