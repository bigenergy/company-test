<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\ReportPDFRequest;
use App\Models\Worker;
use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;
use PDF;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentService
     */
    private $departmentService;


    /**
     * DepartmentController constructor.
     * @param DepartmentService $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departmentsList = $this->departmentService->departmentRepository->getAll();

        return view('department.index', compact('departmentsList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        $attributes = $request->all();
        $this->departmentService->add($attributes);

        return redirect()->route('department.create')->with('status', 'Отдел добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departmentForEdit = $this->departmentService->departmentRepository->getById($id);

        return view('department.edit', compact('departmentForEdit'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentStoreRequest $request, $id)
    {
        $attributes = $request->all();
        $this->departmentService->update($id, $attributes);

        return redirect()->route('department.update', $id)->with('status', 'Отдел отредактирован!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->departmentService->destroy($id);

        return redirect()->route('department.index')->with('status', 'Отдел и сотрудники этого отдела успешно удалены!');
    }

    /**
     * @param ReportPDFRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function report(ReportPDFRequest $request)
    {
        $workers = Worker::with('department')
            ->where('department_id', $request->get('department_id'))
            ->get();

        if($request->view_type === 'download') {
            $pdf = PDF::loadView('report', ['workers' => $workers]);

            return $pdf->download('users.pdf');
        } else {
            $view = View('report', ['workers' => $workers]);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());

            return $pdf->stream();
        }

    }
}
