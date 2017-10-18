<?php

namespace App\Http\Controllers;

use App\DataTables\LocalDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLocalRequest;
use App\Http\Requests\UpdateLocalRequest;
use App\Repositories\LocalRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LocalController extends AppBaseController
{
    /** @var  LocalRepository */
    private $localRepository;

    public function __construct(LocalRepository $localRepo)
    {
        $this->localRepository = $localRepo;
    }

    /**
     * Display a listing of the Local.
     *
     * @param LocalDataTable $localDataTable
     * @return Response
     */
    public function index(LocalDataTable $localDataTable)
    {
        return $localDataTable->render('locals.index');
    }

    /**
     * Show the form for creating a new Local.
     *
     * @return Response
     */
    public function create()
    {
        return view('locals.create');
    }

    /**
     * Store a newly created Local in storage.
     *
     * @param CreateLocalRequest $request
     *
     * @return Response
     */
    public function store(CreateLocalRequest $request)
    {
        $input = $request->all();

        $local = $this->localRepository->create($input);

        Flash::success('Local saved successfully.');

        return redirect(route('locals.index'));
    }

    /**
     * Display the specified Local.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            Flash::error('Local not found');

            return redirect(route('locals.index'));
        }

        return view('locals.show')->with('local', $local);
    }

    /**
     * Show the form for editing the specified Local.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            Flash::error('Local not found');

            return redirect(route('locals.index'));
        }

        return view('locals.edit')->with('local', $local);
    }

    /**
     * Update the specified Local in storage.
     *
     * @param  int              $id
     * @param UpdateLocalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLocalRequest $request)
    {
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            Flash::error('Local not found');

            return redirect(route('locals.index'));
        }

        $local = $this->localRepository->update($request->all(), $id);

        Flash::success('Local updated successfully.');

        return redirect(route('locals.index'));
    }

    /**
     * Remove the specified Local from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            Flash::error('Local not found');

            return redirect(route('locals.index'));
        }

        $this->localRepository->delete($id);

        Flash::success('Local deleted successfully.');

        return redirect(route('locals.index'));
    }
}
