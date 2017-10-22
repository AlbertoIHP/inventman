<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductsSaleAPIRequest;
use App\Http\Requests\API\UpdateProductsSaleAPIRequest;
use App\Models\ProductsSale;
use App\Repositories\ProductsSaleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProductsSaleController
 * @package App\Http\Controllers\API
 */

class ProductsSaleAPIController extends AppBaseController
{
    /** @var  ProductsSaleRepository */
    private $productsSaleRepository;

    public function __construct(ProductsSaleRepository $productsSaleRepo)
    {
        $this->productsSaleRepository = $productsSaleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productsSales",
     *      summary="Get a listing of the ProductsSales.",
     *      tags={"ProductsSale"},
     *      description="Get all ProductsSales",
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
     *                  @SWG\Items(ref="#/definitions/ProductsSale")
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
        $this->productsSaleRepository->pushCriteria(new RequestCriteria($request));
        $this->productsSaleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $productsSales = $this->productsSaleRepository->all();

        return $this->sendResponse($productsSales->toArray(), 'Products Sales retrieved successfully');
    }

    /**
     * @param CreateProductsSaleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productsSales",
     *      summary="Store a newly created ProductsSale in storage",
     *      tags={"ProductsSale"},
     *      description="Store ProductsSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProductsSale that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductsSale")
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
     *                  ref="#/definitions/ProductsSale"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductsSaleAPIRequest $request)
    {
        $input = $request->all();

        $productsSales = $this->productsSaleRepository->create($input);

        return $this->sendResponse($productsSales->toArray(), 'Products Sale saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productsSales/{id}",
     *      summary="Display the specified ProductsSale",
     *      tags={"ProductsSale"},
     *      description="Get ProductsSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductsSale",
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
     *                  ref="#/definitions/ProductsSale"
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
        /** @var ProductsSale $productsSale */
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            return $this->sendError('Products Sale not found');
        }

        return $this->sendResponse($productsSale->toArray(), 'Products Sale retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProductsSaleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productsSales/{id}",
     *      summary="Update the specified ProductsSale in storage",
     *      tags={"ProductsSale"},
     *      description="Update ProductsSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductsSale",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProductsSale that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductsSale")
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
     *                  ref="#/definitions/ProductsSale"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductsSaleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductsSale $productsSale */
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            return $this->sendError('Products Sale not found');
        }

        $productsSale = $this->productsSaleRepository->update($input, $id);

        return $this->sendResponse($productsSale->toArray(), 'ProductsSale updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productsSales/{id}",
     *      summary="Remove the specified ProductsSale from storage",
     *      tags={"ProductsSale"},
     *      description="Delete ProductsSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductsSale",
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
        /** @var ProductsSale $productsSale */
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            return $this->sendError('Products Sale not found');
        }

        $productsSale->delete();

        return $this->sendResponse($id, 'Products Sale deleted successfully');
    }
}
