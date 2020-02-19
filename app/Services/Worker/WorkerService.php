<?php

namespace App\Services\Worker;

use App\Models\Worker;
use App\Repositories\Worker\WorkerRepository;
use Illuminate\Support\Facades\Storage;

class WorkerService
{
    /**
     * @var Worker
     */
    private $workerModel;
    /**
     * @var WorkerRepository
     */
    public $workerRepository;

    /**
     * ProductService constructor.
     * @param Worker $workerModel
     * @param WorkerRepository $workerRepository
     */
    public function __construct(Worker $workerModel, WorkerRepository $workerRepository)
    {
        $this->workerModel = $workerModel;
        $this->workerRepository = $workerRepository;
    }

    /**
     * Add new worker
     *
     * @param array $attributes
     * @return bool
     */
    public function add(array $attributes): bool
    {
        $imageName = md5($attributes['name'].$attributes['family'].$attributes['patronymic']) . '.png';

        $createdWorker = $this->workerModel;

        $createdWorker->name = $attributes['name'];
        $createdWorker->family = $attributes['family'];
        $createdWorker->patronymic = $attributes['patronymic'];
        $createdWorker->image = $imageName;
        $createdWorker->email = $attributes['email'];
        $createdWorker->department_id = $attributes['department_id'];

        $createdWorker->save();

        if(isset($attributes['image'])) {
            $this->addImage($attributes['image'], $imageName);
        }

        return true;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        /** @var Worker $updatedWorker */
        $createdWorker = $this->workerModel->find($id);

        if(isset($attributes['image'])) {
            $this->deleteImage($createdWorker->image);
            $this->addImage($attributes['image'], $createdWorker->image);
        }

        $createdWorker->name = $attributes['name'];
        $createdWorker->family = $attributes['family'];
        $createdWorker->patronymic = $attributes['patronymic'];
        $createdWorker->email = $attributes['email'];
        $createdWorker->department_id = $attributes['department_id'];

        $createdWorker->save();

        return true;
    }

    /**
     * @param $image
     * @param $imageName
     */
    private function addImage($image, $imageName)
    {
        $path  = "images/workers";
        $this->saveToStorage($path, $image, $imageName);
    }

    /**
     * @param string $path
     * @param $image
     * @param $imageName
     */
    private function saveToStorage(string $path, $image, $imageName)
    {
        Storage::disk('public')->putFileAs($path, $image, $imageName);
    }

    /**
     * @param $imageName
     */
    private function deleteImage($imageName)
    {
        $path  = "images/workers";
        Storage::disk('public')->delete($path.'/'.$imageName);
    }


    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $workerToDelete = $this->workerModel->findOrFail($id);
        $workerToDelete->delete();

        return true;
    }
}