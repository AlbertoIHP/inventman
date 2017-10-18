<?php

namespace App\Http\Controllers;

use App\DataTables\RequestBuyDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRequestBuyRequest;
use App\Http\Requests\UpdateRequestBuyRequest;
use App\Repositories\RequestBuyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RequestBuyController extends AppBaseController
{
    /** @var  RequestBuyRepository */
    private $requestBuyRepository;

    public function __construct(RequestBuyRepository $requestBuyRepo)
    {
        $this->requestBuyRepository = $requestBuyRepo;
    }

    /**
     * Display a listing of the RequestBuy.
     *
     * @param RequestBuyDataTable $requestBuyDataTable
     * @return Response
     */
    public function index(RequestBuyDataTable $requestBuyDataTable)
    {
        return $requestBuyDataTable->render('request_buys.index');
    }

    /**
     * Show the form for creating a new RequestBuy.
     *
     * @return Response
     */
    public function create()
    {
        return view('request_buys.create');
    }

    /**
     * Store a newly created RequestBuy in storage.
     *
     * @param CreateRequestBuyRequest $request
     *
     * @return Response
     */
    public function store(CreateRequestBuyRequest $request)
    {
        $input = $request->all();

        $requestBuy = $this->requestBuyRepository->create($input);

        Flash::success('Request Buy saved successfully.');

        return redirect(route('requestBuys.index'));
    }

    /**
     * Display the specified RequestBuy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            Flash::error('Request Buy not found');

            return redirect(route('requestBuys.index'));
        }

        return view('request_buys.show')->with('requestBuy', $requestBuy);
    }

    /**
     * Show the form for editing the specified RequestBuy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            Flash::error('Request Buy not found');

            return redirect(route('requestBuys.index'));
        }

        return view('request_buys.edit')->with('requestBuy', $requestBuy);
    }

    /**
     * Update the specified RequestBuy in storage.
     *
     * @param  int              $id
     * @param UpdateRequestBuyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRequestBuyRequest $request)
    {
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            Flash::error('Request Buy not found');

            return redirect(route('requestBuys.index'));
        }

        $requestBuy = $this->requestBuyRepository->update($request->all(), $id);

        Flash::success('Request Buy updated successfully.');

        return redirect(route('requestBuys.index'));
    }

    /**
     * Remove the specified RequestBuy from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            Flash::error('Request Buy not found');

            return redirect(route('requestBuys.index'));
        }

        $this->requestBuyRepository->delete($id);

        Flash::success('Request Buy deleted successfully.');

        return redirect(route('requestBuys.index'));
    }
}
