<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductSaleAPIRequest;
use App\Http\Requests\API\UpdateProductSaleAPIRequest;
use App\Models\ProductSale;
use App\Repositories\ProductSaleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProductSaleController
 * @package App\Http\Controllers\API
 */

class ProductSaleAPIController extends AppBaseController
{
    /** @var  ProductSaleRepository */
    private $productSaleRepository;

    public function __construct(ProductSaleRepository $productSaleRepo)
    {
        $this->productSaleRepository = $productSaleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productSales",
     *      summary="Get a listing of the ProductSales.",
     *      tags={"ProductSale"},
     *      description="Get all ProductSales",
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
     *                  @SWG\Items(ref="#/definitions/ProductSale")
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
        $this->productSaleRepository->pushCriteria(new RequestCriteria($request));
        $this->productSaleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $productSales = $this->productSaleRepository->all();

        return $this->sendResponse($productSales->toArray(), 'Product Sales retrieved successfully');
    }

    /**
     * @param CreateProductSaleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productSales",
     *      summary="Store a newly created ProductSale in storage",
     *      tags={"ProductSale"},
     *      description="Store ProductSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProductSale that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductSale")
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
     *                  ref="#/definitions/ProductSale"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductSaleAPIRequest $request)
    {
        $input = $request->all();

        $productSales = $this->productSaleRepository->create($input);

        return $this->sendResponse($productSales->toArray(), 'Product Sale saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productSales/{id}",
     *      summary="Display the specified ProductSale",
     *      tags={"ProductSale"},
     *      description="Get ProductSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductSale",
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
     *                  ref="#/definitions/ProductSale"
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
        /** @var ProductSale $productSale */
        $productSale = $this->productSaleRepository->findWithoutFail($id);

        if (empty($productSale)) {
            return $this->sendError('Product Sale not found');
        }

        return $this->sendResponse($productSale->toArray(), 'Product Sale retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProductSaleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productSales/{id}",
     *      summary="Update the specified ProductSale in storage",
     *      tags={"ProductSale"},
     *      description="Update ProductSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductSale",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProductSale that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductSale")
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
     *                  ref="#/definitions/ProductSale"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductSaleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductSale $productSale */
        $productSale = $this->productSaleRepository->findWithoutFail($id);

        if (empty($productSale)) {
            return $this->sendError('Product Sale not found');
        }

        $productSale = $this->productSaleRepository->update($input, $id);

        return $this->sendResponse($productSale->toArray(), 'ProductSale updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productSales/{id}",
     *      summary="Remove the specified ProductSale from storage",
     *      tags={"ProductSale"},
     *      description="Delete ProductSale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductSale",
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
        /** @var ProductSale $productSale */
        $productSale = $this->productSaleRepository->findWithoutFail($id);

        if (empty($productSale)) {
            return $this->sendError('Product Sale not found');
        }

        $productSale->delete();

        return $this->sendResponse($id, 'Product Sale deleted successfully');
    }
}
