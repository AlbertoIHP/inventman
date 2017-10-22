<?php

namespace App\Http\Controllers;

use App\DataTables\RequestBuyDetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRequestBuyDetailRequest;
use App\Http\Requests\UpdateRequestBuyDetailRequest;
use App\Repositories\RequestBuyDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RequestBuyDetailController extends AppBaseController
{
    /** @var  RequestBuyDetailRepository */
    private $requestBuyDetailRepository;

    public function __construct(RequestBuyDetailRepository $requestBuyDetailRepo)
    {
        $this->requestBuyDetailRepository = $requestBuyDetailRepo;
    }

    /**
     * Display a listing of the RequestBuyDetail.
     *
     * @param RequestBuyDetailDataTable $requestBuyDetailDataTable
     * @return Response
     */
    public function index(RequestBuyDetailDataTable $requestBuyDetailDataTable)
    {
        return $requestBuyDetailDataTable->render('request_buy_details.index');
    }

    /**
     * Show the form for creating a new RequestBuyDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('request_buy_details.create');
    }

    /**
     * Store a newly created RequestBuyDetail in storage.
     *
     * @param CreateRequestBuyDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateRequestBuyDetailRequest $request)
    {
        $input = $request->all();

        $requestBuyDetail = $this->requestBuyDetailRepository->create($input);

        Flash::success('Request Buy Detail saved successfully.');

        return redirect(route('requestBuyDetails.index'));
    }

    /**
     * Display the specified RequestBuyDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            Flash::error('Request Buy Detail not found');

            return redirect(route('requestBuyDetails.index'));
        }

        return view('request_buy_details.show')->with('requestBuyDetail', $requestBuyDetail);
    }

    /**
     * Show the form for editing the specified RequestBuyDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            Flash::error('Request Buy Detail not found');

            return redirect(route('requestBuyDetails.index'));
        }

        return view('request_buy_details.edit')->with('requestBuyDetail', $requestBuyDetail);
    }

    /**
     * Update the specified RequestBuyDetail in storage.
     *
     * @param  int              $id
     * @param UpdateRequestBuyDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRequestBuyDetailRequest $request)
    {
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            Flash::error('Request Buy Detail not found');

            return redirect(route('requestBuyDetails.index'));
        }

        $requestBuyDetail = $this->requestBuyDetailRepository->update($request->all(), $id);

        Flash::success('Request Buy Detail updated successfully.');

        return redirect(route('requestBuyDetails.index'));
    }

    /**
     * Remove the specified RequestBuyDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            Flash::error('Request Buy Detail not found');

            return redirect(route('requestBuyDetails.index'));
        }

        $this->requestBuyDetailRepository->delete($id);

        Flash::success('Request Buy Detail deleted successfully.');

        return redirect(route('requestBuyDetails.index'));
    }
}
