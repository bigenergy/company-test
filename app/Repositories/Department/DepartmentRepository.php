<?php

namespace App\Repositories\Department;

interface DepartmentRepository
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);
}