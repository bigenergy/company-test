<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerFilterRequest;
use App\Http\Requests\WorkerStoreRequest;
use App\Repositories\Department\DepartmentRepository;
use App\Services\Worker\WorkerService;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * @var DepartmentRepository
     */
    public $departmentRepository;
    /**
     * @var WorkerService
     */
    private $workerService;

    /**
     * WorkerController constructor.
     * @param DepartmentRepository $departmentRepository
     * @param WorkerService $workerService
     */
    public function __construct(
        DepartmentRepository $departmentRepository,
        WorkerService $workerService
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->workerService = $workerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workerList = $this->workerService->workerRepository->getAll('department');
        $departments = $this->departmentRepository->getAll();

        return view('worker.index', compact('workerList', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = $this->departmentRepository->getAll();

        return view('worker.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerStoreRequest $request)
    {
        $attributes = $request->all();
        $this->workerService->add($attributes);

        return redirect()->route('worker.create')->with('status', 'Сотрудник добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workerForEdit = $this->workerService->workerRepository->getByIdRelation($id, 'department');
        $departments = $this->departmentRepository->getAll();

        return view('worker.edit', compact('workerForEdit', 'departments'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->all();
        $this->workerService->update($id, $attributes);

        return redirect()->route('worker.update', $id)->with('status', 'Сотрудник отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->workerService->destroy($id);

        return redirect()->route('worker.index', $id)->with('status', 'Сотрудник удалён!');
    }

    /**
     * @param WorkerFilterRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(WorkerFilterRequest $request)
    {
        $workerList = $this->workerService->workerRepository->getAllDepartmentWorkers($request->get('department_id'), 'department');
        $departments = $this->departmentRepository->getAll();

        return view('worker.index', compact('workerList', 'departments'));

    }
}
