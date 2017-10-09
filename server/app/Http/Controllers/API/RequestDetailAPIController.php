<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequestDetailAPIRequest;
use App\Http\Requests\API\UpdateRequestDetailAPIRequest;
use App\Models\RequestDetail;
use App\Repositories\RequestDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RequestDetailController
 * @package App\Http\Controllers\API
 */

class RequestDetailAPIController extends AppBaseController
{
    /** @var  RequestDetailRepository */
    private $requestDetailRepository;

    public function __construct(RequestDetailRepository $requestDetailRepo)
    {
        $this->requestDetailRepository = $requestDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestDetails",
     *      summary="Get a listing of the RequestDetails.",
     *      tags={"RequestDetail"},
     *      description="Get all RequestDetails",
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
     *                  @SWG\Items(ref="#/definitions/RequestDetail")
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
        $this->requestDetailRepository->pushCriteria(new RequestCriteria($request));
        $this->requestDetailRepository->pushCriteria(new LimitOffsetCriteria($request));
        $requestDetails = $this->requestDetailRepository->all();

        return $this->sendResponse($requestDetails->toArray(), 'Request Details retrieved successfully');
    }

    /**
     * @param CreateRequestDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/requestDetails",
     *      summary="Store a newly created RequestDetail in storage",
     *      tags={"RequestDetail"},
     *      description="Store RequestDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestDetail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestDetail")
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
     *                  ref="#/definitions/RequestDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRequestDetailAPIRequest $request)
    {
        $input = $request->all();

        $requestDetails = $this->requestDetailRepository->create($input);

        return $this->sendResponse($requestDetails->toArray(), 'Request Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestDetails/{id}",
     *      summary="Display the specified RequestDetail",
     *      tags={"RequestDetail"},
     *      description="Get RequestDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestDetail",
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
     *                  ref="#/definitions/RequestDetail"
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
        /** @var RequestDetail $requestDetail */
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            return $this->sendError('Request Detail not found');
        }

        return $this->sendResponse($requestDetail->toArray(), 'Request Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRequestDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/requestDetails/{id}",
     *      summary="Update the specified RequestDetail in storage",
     *      tags={"RequestDetail"},
     *      description="Update RequestDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestDetail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestDetail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestDetail")
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
     *                  ref="#/definitions/RequestDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRequestDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var RequestDetail $requestDetail */
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            return $this->sendError('Request Detail not found');
        }

        $requestDetail = $this->requestDetailRepository->update($input, $id);

        return $this->sendResponse($requestDetail->toArray(), 'RequestDetail updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/requestDetails/{id}",
     *      summary="Remove the specified RequestDetail from storage",
     *      tags={"RequestDetail"},
     *      description="Delete RequestDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestDetail",
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
        /** @var RequestDetail $requestDetail */
        $requestDetail = $this->requestDetailRepository->findWithoutFail($id);

        if (empty($requestDetail)) {
            return $this->sendError('Request Detail not found');
        }

        $requestDetail->delete();

        return $this->sendResponse($id, 'Request Detail deleted successfully');
    }
}
