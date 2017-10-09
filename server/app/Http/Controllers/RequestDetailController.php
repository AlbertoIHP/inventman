<?php

namespace App\Http\Controllers;

use App\DataTables\RequestDetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRequestDetailRequest;
use App\Http\Requests\UpdateRequestDetailRequest;
use App\Repositories\RequestDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RequestDetailController extends AppBaseController
{
    /** @var  RequestDetailRepository */
    private $requestDetailRepository;

    public function __construct(RequestDetailRepository $requestDetailRepo)
    {
        $this->requestDetailRepository = $requestDetailRepo;
    }

    /**
     * Display a listing of the RequestDetail.
     *
     * @param RequestDetailDataTable $requestDetailDataTable
     * @return Response
     */
    public function index(RequestDetailDataTable $requestDetailDataTable)
    {
        return $requestDetailDataTable->render('request_details.index');
    }

    /**
     * Show the form for creating a new RequestDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('request_details.create');
    }

    /**
     * Store a newly created RequestDetail in storage.
     *
     * @param CreateRequestDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateRequestDetailRequest $request)
    {
        $input = $request->all();

        $requestDetail = $this->requestDetailRepository->create($input);

        Flash::success('Request Detail saved successfully.');

        return redirect(route('requestDetails.index'));
    }

    /**
     * Display the specified RequestDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            Flash::error('Request Detail not found');

            return redirect(route('requestDetails.index'));
        }

        return view('request_details.show')->with('requestDetail', $requestDetail);
    }

    /**
     * Show the form for editing the specified RequestDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            Flash::error('Request Detail not found');

            return redirect(route('requestDetails.index'));
        }

        return view('request_details.edit')->with('requestDetail', $requestDetail);
    }

    /**
     * Update the specified RequestDetail in storage.
     *
     * @param  int              $id
     * @param UpdateRequestDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRequestDetailRequest $request)
    {
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            Flash::error('Request Detail not found');

            return redirect(route('requestDetails.index'));
        }

        $requestDetail = $this->requestDetailRepository->update($request->all(), $id);

        Flash::success('Request Detail updated successfully.');

        return redirect(route('requestDetails.index'));
    }

    /**
     * Remove the specified RequestDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            Flash::error('Request Detail not found');

            return redirect(route('requestDetails.index'));
        }

        $this->requestDetailRepository->delete($id);

        Flash::success('Request Detail deleted successfully.');

        return redirect(route('requestDetails.index'));
    }
}
