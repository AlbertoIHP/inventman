<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventaryTypeAPIRequest;
use App\Http\Requests\API\UpdateInventaryTypeAPIRequest;
use App\Models\InventaryType;
use App\Repositories\InventaryTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InventaryTypeController
 * @package App\Http\Controllers\API
 */

class InventaryTypeAPIController extends AppBaseController
{
    /** @var  InventaryTypeRepository */
    private $inventaryTypeRepository;

    public function __construct(InventaryTypeRepository $inventaryTypeRepo)
    {
        $this->inventaryTypeRepository = $inventaryTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/inventaryTypes",
     *      summary="Get a listing of the InventaryTypes.",
     *      tags={"InventaryType"},
     *      description="Get all InventaryTypes",
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
     *                  @SWG\Items(ref="#/definitions/InventaryType")
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
        $this->inventaryTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->inventaryTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $inventaryTypes = $this->inventaryTypeRepository->all();

        return $this->sendResponse($inventaryTypes->toArray(), 'Inventary Types retrieved successfully');
    }

    /**
     * @param CreateInventaryTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/inventaryTypes",
     *      summary="Store a newly created InventaryType in storage",
     *      tags={"InventaryType"},
     *      description="Store InventaryType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="InventaryType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/InventaryType")
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
     *                  ref="#/definitions/InventaryType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInventaryTypeAPIRequest $request)
    {
        $input = $request->all();

        $inventaryTypes = $this->inventaryTypeRepository->create($input);

        return $this->sendResponse($inventaryTypes->toArray(), 'Inventary Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/inventaryTypes/{id}",
     *      summary="Display the specified InventaryType",
     *      tags={"InventaryType"},
     *      description="Get InventaryType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InventaryType",
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
     *                  ref="#/definitions/InventaryType"
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
        /** @var InventaryType $inventaryType */
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            return $this->sendError('Inventary Type not found');
        }

        return $this->sendResponse($inventaryType->toArray(), 'Inventary Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInventaryTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/inventaryTypes/{id}",
     *      summary="Update the specified InventaryType in storage",
     *      tags={"InventaryType"},
     *      description="Update InventaryType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InventaryType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="InventaryType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/InventaryType")
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
     *                  ref="#/definitions/InventaryType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInventaryTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var InventaryType $inventaryType */
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            return $this->sendError('Inventary Type not found');
        }

        $inventaryType = $this->inventaryTypeRepository->update($input, $id);

        return $this->sendResponse($inventaryType->toArray(), 'InventaryType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/inventaryTypes/{id}",
     *      summary="Remove the specified InventaryType from storage",
     *      tags={"InventaryType"},
     *      description="Delete InventaryType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InventaryType",
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
        /** @var InventaryType $inventaryType */
        $inventaryType = $this->inventaryTypeRepository->findWithoutFail($id);

        if (empty($inventaryType)) {
            return $this->sendError('Inventary Type not found');
        }

        $inventaryType->delete();

        return $this->sendResponse($id, 'Inventary Type deleted successfully');
    }
}
