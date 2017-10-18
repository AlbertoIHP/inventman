<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSaleAPIRequest;
use App\Http\Requests\API\UpdateSaleAPIRequest;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SaleController
 * @package App\Http\Controllers\API
 */

class SaleAPIController extends AppBaseController
{
    /** @var  SaleRepository */
    private $saleRepository;

    public function __construct(SaleRepository $saleRepo)
    {
        $this->saleRepository = $saleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sales",
     *      summary="Get a listing of the Sales.",
     *      tags={"Sale"},
     *      description="Get all Sales",
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
     *                  @SWG\Items(ref="#/definitions/Sale")
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
        $this->saleRepository->pushCriteria(new RequestCriteria($request));
        $this->saleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sales = $this->saleRepository->all();

        return $this->sendResponse($sales->toArray(), 'Sales retrieved successfully');
    }

    /**
     * @param CreateSaleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sales",
     *      summary="Store a newly created Sale in storage",
     *      tags={"Sale"},
     *      description="Store Sale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Sale that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Sale")
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
     *                  ref="#/definitions/Sale"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSaleAPIRequest $request)
    {
        $input = $request->all();

        $sales = $this->saleRepository->create($input);

        return $this->sendResponse($sales->toArray(), 'Sale saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sales/{id}",
     *      summary="Display the specified Sale",
     *      tags={"Sale"},
     *      description="Get Sale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sale",
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
     *                  ref="#/definitions/Sale"
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
        /** @var Sale $sale */
        $sale = $this->saleRepository->findWithoutFail($id);

        if (empty($sale)) {
            return $this->sendError('Sale not found');
        }

        return $this->sendResponse($sale->toArray(), 'Sale retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSaleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sales/{id}",
     *      summary="Update the specified Sale in storage",
     *      tags={"Sale"},
     *      description="Update Sale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sale",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Sale that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Sale")
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
     *                  ref="#/definitions/Sale"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSaleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sale $sale */
        $sale = $this->saleRepository->findWithoutFail($id);

        if (empty($sale)) {
            return $this->sendError('Sale not found');
        }

        $sale = $this->saleRepository->update($input, $id);

        return $this->sendResponse($sale->toArray(), 'Sale updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sales/{id}",
     *      summary="Remove the specified Sale from storage",
     *      tags={"Sale"},
     *      description="Delete Sale",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sale",
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
        /** @var Sale $sale */
        $sale = $this->saleRepository->findWithoutFail($id);

        if (empty($sale)) {
            return $this->sendError('Sale not found');
        }

        $sale->delete();

        return $this->sendResponse($id, 'Sale deleted successfully');
    }
}
