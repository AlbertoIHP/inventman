<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestBuyApiTest extends TestCase
{
    use MakeRequestBuyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRequestBuy()
    {
        $requestBuy = $this->fakeRequestBuyData();
        $this->json('POST', '/api/v1/requestBuys', $requestBuy);

        $this->assertApiResponse($requestBuy);
    }

    /**
     * @test
     */
    public function testReadRequestBuy()
    {
        $requestBuy = $this->makeRequestBuy();
        $this->json('GET', '/api/v1/requestBuys/'.$requestBuy->id);

        $this->assertApiResponse($requestBuy->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRequestBuy()
    {
        $requestBuy = $this->makeRequestBuy();
        $editedRequestBuy = $this->fakeRequestBuyData();

        $this->json('PUT', '/api/v1/requestBuys/'.$requestBuy->id, $editedRequestBuy);

        $this->assertApiResponse($editedRequestBuy);
    }

    /**
     * @test
     */
    public function testDeleteRequestBuy()
    {
        $requestBuy = $this->makeRequestBuy();
        $this->json('DELETE', '/api/v1/requestBuys/'.$requestBuy->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/requestBuys/'.$requestBuy->id);

        $this->assertResponseStatus(404);
    }
}
