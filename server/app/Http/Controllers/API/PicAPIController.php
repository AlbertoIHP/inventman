<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePicAPIRequest;
use App\Http\Requests\API\UpdatePicAPIRequest;
use App\Models\Pic;
use App\Repositories\PicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PicController
 * @package App\Http\Controllers\API
 */

class PicAPIController extends AppBaseController
{
    /** @var  PicRepository */
    private $picRepository;

    public function __construct(PicRepository $picRepo)
    {
        $this->picRepository = $picRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pics",
     *      summary="Get a listing of the Pics.",
     *      tags={"Pic"},
     *      description="Get all Pics",
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
     *                  @SWG\Items(ref="#/definitions/Pic")
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
        $this->picRepository->pushCriteria(new RequestCriteria($request));
        $this->picRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pics = $this->picRepository->all();

        return $this->sendResponse($pics->toArray(), 'Pics retrieved successfully');
    }

    /**
     * @param CreatePicAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pics",
     *      summary="Store a newly created Pic in storage",
     *      tags={"Pic"},
     *      description="Store Pic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pic that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pic")
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
     *                  ref="#/definitions/Pic"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePicAPIRequest $request)
    {
        $input = $request->all();

        $pics = $this->picRepository->create($input);

        return $this->sendResponse($pics->toArray(), 'Pic saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pics/{id}",
     *      summary="Display the specified Pic",
     *      tags={"Pic"},
     *      description="Get Pic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pic",
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
     *                  ref="#/definitions/Pic"
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
        /** @var Pic $pic */
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            return $this->sendError('Pic not found');
        }

        return $this->sendResponse($pic->toArray(), 'Pic retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePicAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pics/{id}",
     *      summary="Update the specified Pic in storage",
     *      tags={"Pic"},
     *      description="Update Pic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pic",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pic that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pic")
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
     *                  ref="#/definitions/Pic"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePicAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pic $pic */
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            return $this->sendError('Pic not found');
        }

        $pic = $this->picRepository->update($input, $id);

        return $this->sendResponse($pic->toArray(), 'Pic updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pics/{id}",
     *      summary="Remove the specified Pic from storage",
     *      tags={"Pic"},
     *      description="Delete Pic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pic",
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
        /** @var Pic $pic */
        $pic = $this->picRepository->findWithoutFail($id);

        if (empty($pic)) {
            return $this->sendError('Pic not found');
        }

        $pic->delete();

        return $this->sendResponse($id, 'Pic deleted successfully');
    }
}
