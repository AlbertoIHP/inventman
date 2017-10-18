<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventaryAPIRequest;
use App\Http\Requests\API\UpdateInventaryAPIRequest;
use App\Models\Inventary;
use App\Repositories\InventaryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InventaryController
 * @package App\Http\Controllers\API
 */

class InventaryAPIController extends AppBaseController
{
    /** @var  InventaryRepository */
    private $inventaryRepository;

    public function __construct(InventaryRepository $inventaryRepo)
    {
        $this->inventaryRepository = $inventaryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/inventaries",
     *      summary="Get a listing of the Inventaries.",
     *      tags={"Inventary"},
     *      description="Get all Inventaries",
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
     *                  @SWG\Items(ref="#/definitions/Inventary")
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
        $this->inventaryRepository->pushCriteria(new RequestCriteria($request));
        $this->inventaryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $inventaries = $this->inventaryRepository->all();

        return $this->sendResponse($inventaries->toArray(), 'Inventaries retrieved successfully');
    }

    /**
     * @param CreateInventaryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/inventaries",
     *      summary="Store a newly created Inventary in storage",
     *      tags={"Inventary"},
     *      description="Store Inventary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inventary that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inventary")
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
     *                  ref="#/definitions/Inventary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInventaryAPIRequest $request)
    {
        $input = $request->all();

        $inventaries = $this->inventaryRepository->create($input);

        return $this->sendResponse($inventaries->toArray(), 'Inventary saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/inventaries/{id}",
     *      summary="Display the specified Inventary",
     *      tags={"Inventary"},
     *      description="Get Inventary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inventary",
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
     *                  ref="#/definitions/Inventary"
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
        /** @var Inventary $inventary */
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            return $this->sendError('Inventary not found');
        }

        return $this->sendResponse($inventary->toArray(), 'Inventary retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInventaryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/inventaries/{id}",
     *      summary="Update the specified Inventary in storage",
     *      tags={"Inventary"},
     *      description="Update Inventary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inventary",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inventary that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inventary")
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
     *                  ref="#/definitions/Inventary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInventaryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Inventary $inventary */
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            return $this->sendError('Inventary not found');
        }

        $inventary = $this->inventaryRepository->update($input, $id);

        return $this->sendResponse($inventary->toArray(), 'Inventary updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/inventaries/{id}",
     *      summary="Remove the specified Inventary from storage",
     *      tags={"Inventary"},
     *      description="Delete Inventary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inventary",
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
        /** @var Inventary $inventary */
        $inventary = $this->inventaryRepository->findWithoutFail($id);

        if (empty($inventary)) {
            return $this->sendError('Inventary not found');
        }

        $inventary->delete();

        return $this->sendResponse($id, 'Inventary deleted successfully');
    }
}
