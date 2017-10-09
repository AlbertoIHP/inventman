<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInvetaryAPIRequest;
use App\Http\Requests\API\UpdateInvetaryAPIRequest;
use App\Models\Invetary;
use App\Repositories\InvetaryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InvetaryController
 * @package App\Http\Controllers\API
 */

class InvetaryAPIController extends AppBaseController
{
    /** @var  InvetaryRepository */
    private $invetaryRepository;

    public function __construct(InvetaryRepository $invetaryRepo)
    {
        $this->invetaryRepository = $invetaryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/invetaries",
     *      summary="Get a listing of the Invetaries.",
     *      tags={"Invetary"},
     *      description="Get all Invetaries",
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
     *                  @SWG\Items(ref="#/definitions/Invetary")
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
        $this->invetaryRepository->pushCriteria(new RequestCriteria($request));
        $this->invetaryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $invetaries = $this->invetaryRepository->all();

        return $this->sendResponse($invetaries->toArray(), 'Invetaries retrieved successfully');
    }

    /**
     * @param CreateInvetaryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/invetaries",
     *      summary="Store a newly created Invetary in storage",
     *      tags={"Invetary"},
     *      description="Store Invetary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Invetary that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Invetary")
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
     *                  ref="#/definitions/Invetary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInvetaryAPIRequest $request)
    {
        $input = $request->all();

        $invetaries = $this->invetaryRepository->create($input);

        return $this->sendResponse($invetaries->toArray(), 'Invetary saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/invetaries/{id}",
     *      summary="Display the specified Invetary",
     *      tags={"Invetary"},
     *      description="Get Invetary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Invetary",
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
     *                  ref="#/definitions/Invetary"
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
        /** @var Invetary $invetary */
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            return $this->sendError('Invetary not found');
        }

        return $this->sendResponse($invetary->toArray(), 'Invetary retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInvetaryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/invetaries/{id}",
     *      summary="Update the specified Invetary in storage",
     *      tags={"Invetary"},
     *      description="Update Invetary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Invetary",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Invetary that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Invetary")
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
     *                  ref="#/definitions/Invetary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInvetaryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Invetary $invetary */
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            return $this->sendError('Invetary not found');
        }

        $invetary = $this->invetaryRepository->update($input, $id);

        return $this->sendResponse($invetary->toArray(), 'Invetary updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/invetaries/{id}",
     *      summary="Remove the specified Invetary from storage",
     *      tags={"Invetary"},
     *      description="Delete Invetary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Invetary",
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
        /** @var Invetary $invetary */
        $invetary = $this->invetaryRepository->findWithoutFail($id);

        if (empty($invetary)) {
            return $this->sendError('Invetary not found');
        }

        $invetary->delete();

        return $this->sendResponse($id, 'Invetary deleted successfully');
    }
}
