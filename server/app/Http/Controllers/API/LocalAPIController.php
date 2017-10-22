<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLocalAPIRequest;
use App\Http\Requests\API\UpdateLocalAPIRequest;
use App\Models\Local;
use App\Repositories\LocalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LocalController
 * @package App\Http\Controllers\API
 */

class LocalAPIController extends AppBaseController
{
    /** @var  LocalRepository */
    private $localRepository;

    public function __construct(LocalRepository $localRepo)
    {
        $this->localRepository = $localRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/locals",
     *      summary="Get a listing of the Locals.",
     *      tags={"Local"},
     *      description="Get all Locals",
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
     *                  @SWG\Items(ref="#/definitions/Local")
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
        $this->localRepository->pushCriteria(new RequestCriteria($request));
        $this->localRepository->pushCriteria(new LimitOffsetCriteria($request));
        $locals = $this->localRepository->all();

        return $this->sendResponse($locals->toArray(), 'Locals retrieved successfully');
    }

    /**
     * @param CreateLocalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/locals",
     *      summary="Store a newly created Local in storage",
     *      tags={"Local"},
     *      description="Store Local",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Local that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Local")
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
     *                  ref="#/definitions/Local"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLocalAPIRequest $request)
    {
        $input = $request->all();

        $locals = $this->localRepository->create($input);

        return $this->sendResponse($locals->toArray(), 'Local saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/locals/{id}",
     *      summary="Display the specified Local",
     *      tags={"Local"},
     *      description="Get Local",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Local",
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
     *                  ref="#/definitions/Local"
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
        /** @var Local $local */
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            return $this->sendError('Local not found');
        }

        return $this->sendResponse($local->toArray(), 'Local retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLocalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/locals/{id}",
     *      summary="Update the specified Local in storage",
     *      tags={"Local"},
     *      description="Update Local",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Local",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Local that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Local")
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
     *                  ref="#/definitions/Local"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLocalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Local $local */
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            return $this->sendError('Local not found');
        }

        $local = $this->localRepository->update($input, $id);

        return $this->sendResponse($local->toArray(), 'Local updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/locals/{id}",
     *      summary="Remove the specified Local from storage",
     *      tags={"Local"},
     *      description="Delete Local",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Local",
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
        /** @var Local $local */
        $local = $this->localRepository->findWithoutFail($id);

        if (empty($local)) {
            return $this->sendError('Local not found');
        }

        $local->delete();

        return $this->sendResponse($id, 'Local deleted successfully');
    }
}
