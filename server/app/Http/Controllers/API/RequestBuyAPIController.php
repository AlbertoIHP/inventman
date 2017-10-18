<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequestBuyAPIRequest;
use App\Http\Requests\API\UpdateRequestBuyAPIRequest;
use App\Models\RequestBuy;
use App\Repositories\RequestBuyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RequestBuyController
 * @package App\Http\Controllers\API
 */

class RequestBuyAPIController extends AppBaseController
{
    /** @var  RequestBuyRepository */
    private $requestBuyRepository;

    public function __construct(RequestBuyRepository $requestBuyRepo)
    {
        $this->requestBuyRepository = $requestBuyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestBuys",
     *      summary="Get a listing of the RequestBuys.",
     *      tags={"RequestBuy"},
     *      description="Get all RequestBuys",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/RequestBuy")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->requestBuyRepository->pushCriteria(new RequestCriteria($request));
        $this->requestBuyRepository->pushCriteria(new LimitOffsetCriteria($request));
        $requestBuys = $this->requestBuyRepository->all();

        return $this->sendResponse($requestBuys->toArray(), 'Request Buys retrieved successfully');
    }

    /**
     * @param CreateRequestBuyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/requestBuys",
     *      summary="Store a newly created RequestBuy in storage",
     *      tags={"RequestBuy"},
     *      description="Store RequestBuy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestBuy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestBuy")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/RequestBuy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRequestBuyAPIRequest $request)
    {
        $input = $request->all();

        $requestBuys = $this->requestBuyRepository->create($input);

        return $this->sendResponse($requestBuys->toArray(), 'Request Buy saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestBuys/{id}",
     *      summary="Display the specified RequestBuy",
     *      tags={"RequestBuy"},
     *      description="Get RequestBuy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestBuy",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/RequestBuy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var RequestBuy $requestBuy */
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            return $this->sendError('Request Buy not found');
        }

        return $this->sendResponse($requestBuy->toArray(), 'Request Buy retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRequestBuyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/requestBuys/{id}",
     *      summary="Update the specified RequestBuy in storage",
     *      tags={"RequestBuy"},
     *      description="Update RequestBuy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestBuy",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestBuy that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestBuy")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/RequestBuy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRequestBuyAPIRequest $request)
    {
        $input = $request->all();

        /** @var RequestBuy $requestBuy */
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            return $this->sendError('Request Buy not found');
        }

        $requestBuy = $this->requestBuyRepository->update($input, $id);

        return $this->sendResponse($requestBuy->toArray(), 'RequestBuy updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/requestBuys/{id}",
     *      summary="Remove the specified RequestBuy from storage",
     *      tags={"RequestBuy"},
     *      description="Delete RequestBuy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestBuy",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var RequestBuy $requestBuy */
        $requestBuy = $this->requestBuyRepository->findWithoutFail($id);

        if (empty($requestBuy)) {
            return $this->sendError('Request Buy not found');
        }

        $requestBuy->delete();

        return $this->sendResponse($id, 'Request Buy deleted successfully');
    }
}
