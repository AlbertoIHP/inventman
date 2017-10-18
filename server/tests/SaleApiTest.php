<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SaleApiTest extends TestCase
{
    use MakeSaleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSale()
    {
        $sale = $this->fakeSaleData();
        $this->json('POST', '/api/v1/sales', $sale);

        $this->assertApiResponse($sale);
    }

    /**
     * @test
     */
    public function testReadSale()
    {
        $sale = $this->makeSale();
        $this->json('GET', '/api/v1/sales/'.$sale->id);

        $this->assertApiResponse($sale->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSale()
    {
        $sale = $this->makeSale();
        $editedSale = $this->fakeSaleData();

        $this->json('PUT', '/api/v1/sales/'.$sale->id, $editedSale);

        $this->assertApiResponse($editedSale);
    }

    /**
     * @test
     */
    public function testDeleteSale()
    {
        $sale = $this->makeSale();
        $this->json('DELETE', '/api/v1/sales/'.$sale->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sales/'.$sale->id);

        $this->assertResponseStatus(404);
    }
}
