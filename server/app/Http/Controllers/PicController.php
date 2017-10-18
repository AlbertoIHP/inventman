<?php

namespace App\Http\Controllers;

use App\DataTables\PicDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePicRequest;
use App\Http\Requests\UpdatePicRequest;
use App\Repositories\PicRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PicController extends AppBaseController
{
    /** @var  PicRepository */
    private $picRepository;

    public function __construct(PicRepository $picRepo)
    {
        $this->picRepository = $picRepo;
    }

    /**
     * Display a listing of the Pic.
     *
     * @param PicDataTable $picDataTable
     * @return Response
     */
    public function index(PicDataTable $picDataTable)
    {
        return $picDataTable->render('pics.index');
    }

    /**
     * Show the form for creating a new Pic.
     *
     * @return Response
     */
    public function create()
    {
        return view('pics.create');
    }

    /**
     * Store a newly created Pic in storage.
     *
     * @param CreatePicRequest $request
     *
     * @return Response
     */
    public function store(CreatePicRequest $request)
    {
        $input = $request->all();

        $pic = $this->picRepository->create($input);

        Flash::success('Pic saved successfully.');

        return redirect(route('pics.index'));
    }

    /**
     * Display the specified Pic.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            Flash::error('Pic not found');

            return redirect(route('pics.index'));
        }

        return view('pics.show')->with('pic', $pic);
    }

    /**
     * Show the form for editing the specified Pic.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            Flash::error('Pic not found');

            return redirect(route('pics.index'));
        }

        return view('pics.edit')->with('pic', $pic);
    }

    /**
     * Update the specified Pic in storage.
     *
     * @param  int              $id
     * @param UpdatePicRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePicRequest $request)
    {
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            Flash::error('Pic not found');

            return redirect(route('pics.index'));
        }

        $pic = $this->picRepository->update($request->all(), $id);

        Flash::success('Pic updated successfully.');

        return redirect(route('pics.index'));
    }

    /**
     * Remove the specified Pic from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            Flash::error('Pic not found');

            return redirect(route('pics.index'));
        }

        $this->picRepository->delete($id);

        Flash::success('Pic deleted successfully.');

        return redirect(route('pics.index'));
    }
}
