<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductSaleApiTest extends TestCase
{
    use MakeProductSaleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProductSale()
    {
        $productSale = $this->fakeProductSaleData();
        $this->json('POST', '/api/v1/productSales', $productSale);

        $this->assertApiResponse($productSale);
    }

    /**
     * @test
     */
    public function testReadProductSale()
    {
        $productSale = $this->makeProductSale();
        $this->json('GET', '/api/v1/productSales/'.$productSale->id);

        $this->assertApiResponse($productSale->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProductSale()
    {
        $productSale = $this->makeProductSale();
        $editedProductSale = $this->fakeProductSaleData();

        $this->json('PUT', '/api/v1/productSales/'.$productSale->id, $editedProductSale);

        $this->assertApiResponse($editedProductSale);
    }

    /**
     * @test
     */
    public function testDeleteProductSale()
    {
        $productSale = $this->makeProductSale();
        $this->json('DELETE', '/api/v1/productSales/'.$productSale->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/productSales/'.$productSale->id);

        $this->assertResponseStatus(404);
    }
}
