<?php

namespace App\Http\Controllers;

use App\DataTables\InvetaryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateInvetaryRequest;
use App\Http\Requests\UpdateInvetaryRequest;
use App\Repositories\InvetaryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class InvetaryController extends AppBaseController
{
    /** @var  InvetaryRepository */
    private $invetaryRepository;

    public function __construct(InvetaryRepository $invetaryRepo)
    {
        $this->invetaryRepository = $invetaryRepo;
    }

    /**
     * Display a listing of the Invetary.
     *
     * @param InvetaryDataTable $invetaryDataTable
     * @return Response
     */
    public function index(InvetaryDataTable $invetaryDataTable)
    {
        return $invetaryDataTable->render('invetaries.index');
    }

    /**
     * Show the form for creating a new Invetary.
     *
     * @return Response
     */
    public function create()
    {
        return view('invetaries.create');
    }

    /**
     * Store a newly created Invetary in storage.
     *
     * @param CreateInvetaryRequest $request
     *
     * @return Response
     */
    public function store(CreateInvetaryRequest $request)
    {
        $input = $request->all();

        $invetary = $this->invetaryRepository->create($input);

        Flash::success('Invetary saved successfully.');

        return redirect(route('invetaries.index'));
    }

    /**
     * Display the specified Invetary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            Flash::error('Invetary not found');

            return redirect(route('invetaries.index'));
        }

        return view('invetaries.show')->with('invetary', $invetary);
    }

    /**
     * Show the form for editing the specified Invetary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            Flash::error('Invetary not found');

            return redirect(route('invetaries.index'));
        }

        return view('invetaries.edit')->with('invetary', $invetary);
    }

    /**
     * Update the specified Invetary in storage.
     *
     * @param  int              $id
     * @param UpdateInvetaryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvetaryRequest $request)
    {
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            Flash::error('Invetary not found');

            return redirect(route('invetaries.index'));
        }

        $invetary = $this->invetaryRepository->update($request->all(), $id);

        Flash::success('Invetary updated successfully.');

        return redirect(route('invetaries.index'));
    }

    /**
     * Remove the specified Invetary from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            Flash::error('Invetary not found');

            return redirect(route('invetaries.index'));
        }

        $this->invetaryRepository->delete($id);

        Flash::success('Invetary deleted successfully.');

        return redirect(route('invetaries.index'));
    }
}
