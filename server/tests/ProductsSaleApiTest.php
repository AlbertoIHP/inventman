<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsSaleApiTest extends TestCase
{
    use MakeProductsSaleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProductsSale()
    {
        $productsSale = $this->fakeProductsSaleData();
        $this->json('POST', '/api/v1/productsSales', $productsSale);

        $this->assertApiResponse($productsSale);
    }

    /**
     * @test
     */
    public function testReadProductsSale()
    {
        $productsSale = $this->makeProductsSale();
        $this->json('GET', '/api/v1/productsSales/'.$productsSale->id);

        $this->assertApiResponse($productsSale->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProductsSale()
    {
        $productsSale = $this->makeProductsSale();
        $editedProductsSale = $this->fakeProductsSaleData();

        $this->json('PUT', '/api/v1/productsSales/'.$productsSale->id, $editedProductsSale);

        $this->assertApiResponse($editedProductsSale);
    }

    /**
     * @test
     */
    public function testDeleteProductsSale()
    {
        $productsSale = $this->makeProductsSale();
        $this->json('DELETE', '/api/v1/productsSales/'.$productsSale->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/productsSales/'.$productsSale->id);

        $this->assertResponseStatus(404);
    }
}
