<?php

namespace App\Http\Controllers;

use App\DataTables\PermiseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePermiseRequest;
use App\Http\Requests\UpdatePermiseRequest;
use App\Repositories\PermiseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PermiseController extends AppBaseController
{
    /** @var  PermiseRepository */
    private $permiseRepository;

    public function __construct(PermiseRepository $permiseRepo)
    {
        $this->permiseRepository = $permiseRepo;
    }

    /**
     * Display a listing of the Permise.
     *
     * @param PermiseDataTable $permiseDataTable
     * @return Response
     */
    public function index(PermiseDataTable $permiseDataTable)
    {
        return $permiseDataTable->render('permises.index');
    }

    /**
     * Show the form for creating a new Permise.
     *
     * @return Response
     */
    public function create()
    {
        return view('permises.create');
    }

    /**
     * Store a newly created Permise in storage.
     *
     * @param CreatePermiseRequest $request
     *
     * @return Response
     */
    public function store(CreatePermiseRequest $request)
    {
        $input = $request->all();

        $permise = $this->permiseRepository->create($input);

        Flash::success('Permise saved successfully.');

        return redirect(route('permises.index'));
    }

    /**
     * Display the specified Permise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permise = $this->permiseRepository->findWithoutFail($id);

        if (empty($permise)) {
            Flash::error('Permise not found');

            return redirect(route('permises.index'));
        }

        return view('permises.show')->with('permise', $permise);
    }

    /**
     * Show the form for editing the specified Permise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permise = $this->permiseRepository->findWithoutFail($id);

        if (empty($permise)) {
            Flash::error('Permise not found');

            return redirect(route('permises.index'));
        }

        return view('permises.edit')->with('permise', $permise);
    }

    /**
     * Update the specified Permise in storage.
     *
     * @param  int              $id
     * @param UpdatePermiseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermiseRequest $request)
    {
        $permise = $this->permiseRepository->findWithoutFail($id);

        if (empty($permise)) {
            Flash::error('Permise not found');

            return redirect(route('permises.index'));
        }

        $permise = $this->permiseRepository->update($request->all(), $id);

        Flash::success('Permise updated successfully.');

        return redirect(route('permises.index'));
    }

    /**
     * Remove the specified Permise from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permise = $this->permiseRepository->findWithoutFail($id);

        if (empty($permise)) {
            Flash::error('Permise not found');

            return redirect(route('permises.index'));
        }

        $this->permiseRepository->delete($id);

        Flash::success('Permise deleted successfully.');

        return redirect(route('permises.index'));
    }
}
