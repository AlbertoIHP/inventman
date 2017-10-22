<?php

namespace App\Http\Controllers;

use App\DataTables\InventaryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateInventaryRequest;
use App\Http\Requests\UpdateInventaryRequest;
use App\Repositories\InventaryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class InventaryController extends AppBaseController
{
    /** @var  InventaryRepository */
    private $inventaryRepository;

    public function __construct(InventaryRepository $inventaryRepo)
    {
        $this->inventaryRepository = $inventaryRepo;
    }

    /**
     * Display a listing of the Inventary.
     *
     * @param InventaryDataTable $inventaryDataTable
     * @return Response
     */
    public function index(InventaryDataTable $inventaryDataTable)
    {
        return $inventaryDataTable->render('inventaries.index');
    }

    /**
     * Show the form for creating a new Inventary.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventaries.create');
    }

    /**
     * Store a newly created Inventary in storage.
     *
     * @param CreateInventaryRequest $request
     *
     * @return Response
     */
    public function store(CreateInventaryRequest $request)
    {
        $input = $request->all();

        $inventary = $this->inventaryRepository->create($input);

        Flash::success('Inventary saved successfully.');

        return redirect(route('inventaries.index'));
    }

    /**
     * Display the specified Inventary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            Flash::error('Inventary not found');

            return redirect(route('inventaries.index'));
        }

        return view('inventaries.show')->with('inventary', $inventary);
    }

    /**
     * Show the form for editing the specified Inventary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            Flash::error('Inventary not found');

            return redirect(route('inventaries.index'));
        }

        return view('inventaries.edit')->with('inventary', $inventary);
    }

    /**
     * Update the specified Inventary in storage.
     *
     * @param  int              $id
     * @param UpdateInventaryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventaryRequest $request)
    {
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            Flash::error('Inventary not found');

            return redirect(route('inventaries.index'));
        }

        $inventary = $this->inventaryRepository->update($request->all(), $id);

        Flash::success('Inventary updated successfully.');

        return redirect(route('inventaries.index'));
    }

    /**
     * Remove the specified Inventary from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            Flash::error('Inventary not found');

            return redirect(route('inventaries.index'));
        }

        $this->inventaryRepository->delete($id);

        Flash::success('Inventary deleted successfully.');

        return redirect(route('inventaries.index'));
    }
}
