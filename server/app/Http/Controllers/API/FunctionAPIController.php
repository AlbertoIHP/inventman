<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFunctionAPIRequest;
use App\Http\Requests\API\UpdateFunctionAPIRequest;
use App\Models\Function;
use App\Repositories\FunctionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FunctionController
 * @package App\Http\Controllers\API
 */

class FunctionAPIController extends AppBaseController
{
    /** @var  FunctionRepository */
    private $functionRepository;

    public function __construct(FunctionRepository $functionRepo)
    {
        $this->functionRepository = $functionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/functions",
     *      summary="Get a listing of the Functions.",
     *      tags={"Function"},
     *      description="Get all Functions",
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
     *                  @SWG\Items(ref="#/definitions/Function")
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
        $this->functionRepository->pushCriteria(new RequestCriteria($request));
        $this->functionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $functions = $this->functionRepository->all();

        return $this->sendResponse($functions->toArray(), 'Functions retrieved successfully');
    }

    /**
     * @param CreateFunctionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/functions",
     *      summary="Store a newly created Function in storage",
     *      tags={"Function"},
     *      description="Store Function",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Function that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Function")
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
     *                  ref="#/definitions/Function"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFunctionAPIRequest $request)
    {
        $input = $request->all();

        $functions = $this->functionRepository->create($input);

        return $this->sendResponse($functions->toArray(), 'Function saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/functions/{id}",
     *      summary="Display the specified Function",
     *      tags={"Function"},
     *      description="Get Function",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Function",
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
     *                  ref="#/definitions/Function"
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
        /** @var Function $function */
        $function = $this->functionRepository->findWithoutFail($id);

        if (empty($function)) {
            return $this->sendError('Function not found');
        }

        return $this->sendResponse($function->toArray(), 'Function retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFunctionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/functions/{id}",
     *      summary="Update the specified Function in storage",
     *      tags={"Function"},
     *      description="Update Function",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Function",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Function that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Function")
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
     *                  ref="#/definitions/Function"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFunctionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Function $function */
        $function = $this->functionRepository->findWithoutFail($id);

        if (empty($function)) {
            return $this->sendError('Function not found');
        }

        $function = $this->functionRepository->update($input, $id);

        return $this->sendResponse($function->toArray(), 'Function updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/functions/{id}",
     *      summary="Remove the specified Function from storage",
     *      tags={"Function"},
     *      description="Delete Function",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Function",
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
        /** @var Function $function */
        $function = $this->functionRepository->findWithoutFail($id);

        if (empty($function)) {
            return $this->sendError('Function not found');
        }

        $function->delete();

        return $this->sendResponse($id, 'Function deleted successfully');
    }
}
