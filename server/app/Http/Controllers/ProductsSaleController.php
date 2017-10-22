<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsSaleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductsSaleRequest;
use App\Http\Requests\UpdateProductsSaleRequest;
use App\Repositories\ProductsSaleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProductsSaleController extends AppBaseController
{
    /** @var  ProductsSaleRepository */
    private $productsSaleRepository;

    public function __construct(ProductsSaleRepository $productsSaleRepo)
    {
        $this->productsSaleRepository = $productsSaleRepo;
    }

    /**
     * Display a listing of the ProductsSale.
     *
     * @param ProductsSaleDataTable $productsSaleDataTable
     * @return Response
     */
    public function index(ProductsSaleDataTable $productsSaleDataTable)
    {
        return $productsSaleDataTable->render('products_sales.index');
    }

    /**
     * Show the form for creating a new ProductsSale.
     *
     * @return Response
     */
    public function create()
    {
        return view('products_sales.create');
    }

    /**
     * Store a newly created ProductsSale in storage.
     *
     * @param CreateProductsSaleRequest $request
     *
     * @return Response
     */
    public function store(CreateProductsSaleRequest $request)
    {
        $input = $request->all();

        $productsSale = $this->productsSaleRepository->create($input);

        Flash::success('Products Sale saved successfully.');

        return redirect(route('productsSales.index'));
    }

    /**
     * Display the specified ProductsSale.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            Flash::error('Products Sale not found');

            return redirect(route('productsSales.index'));
        }

        return view('products_sales.show')->with('productsSale', $productsSale);
    }

    /**
     * Show the form for editing the specified ProductsSale.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            Flash::error('Products Sale not found');

            return redirect(route('productsSales.index'));
        }

        return view('products_sales.edit')->with('productsSale', $productsSale);
    }

    /**
     * Update the specified ProductsSale in storage.
     *
     * @param  int              $id
     * @param UpdateProductsSaleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductsSaleRequest $request)
    {
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            Flash::error('Products Sale not found');

            return redirect(route('productsSales.index'));
        }

        $productsSale = $this->productsSaleRepository->update($request->all(), $id);

        Flash::success('Products Sale updated successfully.');

        return redirect(route('productsSales.index'));
    }

    /**
     * Remove the specified ProductsSale from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productsSale = $this->productsSaleRepository->findWithoutFail($id);

        if (empty($productsSale)) {
            Flash::error('Products Sale not found');

            return redirect(route('productsSales.index'));
        }

        $this->productsSaleRepository->delete($id);

        Flash::success('Products Sale deleted successfully.');

        return redirect(route('productsSales.index'));
    }
}
