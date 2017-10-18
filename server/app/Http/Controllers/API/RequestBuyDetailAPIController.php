<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequestBuyDetailAPIRequest;
use App\Http\Requests\API\UpdateRequestBuyDetailAPIRequest;
use App\Models\RequestBuyDetail;
use App\Repositories\RequestBuyDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RequestBuyDetailController
 * @package App\Http\Controllers\API
 */

class RequestBuyDetailAPIController extends AppBaseController
{
    /** @var  RequestBuyDetailRepository */
    private $requestBuyDetailRepository;

    public function __construct(RequestBuyDetailRepository $requestBuyDetailRepo)
    {
        $this->requestBuyDetailRepository = $requestBuyDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestBuyDetails",
     *      summary="Get a listing of the RequestBuyDetails.",
     *      tags={"RequestBuyDetail"},
     *      description="Get all RequestBuyDetails",
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
     *                  @SWG\Items(ref="#/definitions/RequestBuyDetail")
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
        $this->requestBuyDetailRepository->pushCriteria(new RequestCriteria($request));
        $this->requestBuyDetailRepository->pushCriteria(new LimitOffsetCriteria($request));
        $requestBuyDetails = $this->requestBuyDetailRepository->all();

        return $this->sendResponse($requestBuyDetails->toArray(), 'Request Buy Details retrieved successfully');
    }

    /**
     * @param CreateRequestBuyDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/requestBuyDetails",
     *      summary="Store a newly created RequestBuyDetail in storage",
     *      tags={"RequestBuyDetail"},
     *      description="Store RequestBuyDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestBuyDetail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestBuyDetail")
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
     *                  ref="#/definitions/RequestBuyDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRequestBuyDetailAPIRequest $request)
    {
        $input = $request->all();

        $requestBuyDetails = $this->requestBuyDetailRepository->create($input);

        return $this->sendResponse($requestBuyDetails->toArray(), 'Request Buy Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestBuyDetails/{id}",
     *      summary="Display the specified RequestBuyDetail",
     *      tags={"RequestBuyDetail"},
     *      description="Get RequestBuyDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestBuyDetail",
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
     *                  ref="#/definitions/RequestBuyDetail"
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
        /** @var RequestBuyDetail $requestBuyDetail */
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            return $this->sendError('Request Buy Detail not found');
        }

        return $this->sendResponse($requestBuyDetail->toArray(), 'Request Buy Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRequestBuyDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/requestBuyDetails/{id}",
     *      summary="Update the specified RequestBuyDetail in storage",
     *      tags={"RequestBuyDetail"},
     *      description="Update RequestBuyDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestBuyDetail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestBuyDetail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestBuyDetail")
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
     *                  ref="#/definitions/RequestBuyDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRequestBuyDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var RequestBuyDetail $requestBuyDetail */
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            return $this->sendError('Request Buy Detail not found');
        }

        $requestBuyDetail = $this->requestBuyDetailRepository->update($input, $id);

        return $this->sendResponse($requestBuyDetail->toArray(), 'RequestBuyDetail updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/requestBuyDetails/{id}",
     *      summary="Remove the specified RequestBuyDetail from storage",
     *      tags={"RequestBuyDetail"},
     *      description="Delete RequestBuyDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestBuyDetail",
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
        /** @var RequestBuyDetail $requestBuyDetail */
        $requestBuyDetail = $this->requestBuyDetailRepository->findWithoutFail($id);

        if (empty($requestBuyDetail)) {
            return $this->sendError('Request Buy Detail not found');
        }

        $requestBuyDetail->delete();

        return $this->sendResponse($id, 'Request Buy Detail deleted successfully');
    }
}
