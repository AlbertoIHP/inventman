<?php

namespace App\Http\Controllers;

use App\DataTables\InventaryTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateInventaryTypeRequest;
use App\Http\Requests\UpdateInventaryTypeRequest;
use App\Repositories\InventaryTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class InventaryTypeController extends AppBaseController
{
    /** @var  InventaryTypeRepository */
    private $inventaryTypeRepository;

    public function __construct(InventaryTypeRepository $inventaryTypeRepo)
    {
        $this->inventaryTypeRepository = $inventaryTypeRepo;
    }

    /**
     * Display a listing of the InventaryType.
     *
     * @param InventaryTypeDataTable $inventaryTypeDataTable
     * @return Response
     */
    public function index(InventaryTypeDataTable $inventaryTypeDataTable)
    {
        return $inventaryTypeDataTable->render('inventary_types.index');
    }

    /**
     * Show the form for creating a new InventaryType.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventary_types.create');
    }

    /**
     * Store a newly created InventaryType in storage.
     *
     * @param CreateInventaryTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateInventaryTypeRequest $request)
    {
        $input = $request->all();

        $inventaryType = $this->inventaryTypeRepository->create($input);

        Flash::success('Inventary Type saved successfully.');

        return redirect(route('inventaryTypes.index'));
    }

    /**
     * Display the specified InventaryType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            Flash::error('Inventary Type not found');

            return redirect(route('inventaryTypes.index'));
        }

        return view('inventary_types.show')->with('inventaryType', $inventaryType);
    }

    /**
     * Show the form for editing the specified InventaryType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            Flash::error('Inventary Type not found');

            return redirect(route('inventaryTypes.index'));
        }

        return view('inventary_types.edit')->with('inventaryType', $inventaryType);
    }

    /**
     * Update the specified InventaryType in storage.
     *
     * @param  int              $id
     * @param UpdateInventaryTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventaryTypeRequest $request)
    {
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            Flash::error('Inventary Type not found');

            return redirect(route('inventaryTypes.index'));
        }

        $inventaryType = $this->inventaryTypeRepository->update($request->all(), $id);

        Flash::success('Inventary Type updated successfully.');

        return redirect(route('inventaryTypes.index'));
    }

    /**
     * Remove the specified InventaryType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            Flash::error('Inventary Type not found');

            return redirect(route('inventaryTypes.index'));
        }

        $this->inventaryTypeRepository->delete($id);

        Flash::success('Inventary Type deleted successfully.');

        return redirect(route('inventaryTypes.index'));
    }
}
