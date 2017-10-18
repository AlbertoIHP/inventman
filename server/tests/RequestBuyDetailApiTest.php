<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestBuyDetailApiTest extends TestCase
{
    use MakeRequestBuyDetailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRequestBuyDetail()
    {
        $requestBuyDetail = $this->fakeRequestBuyDetailData();
        $this->json('POST', '/api/v1/requestBuyDetails', $requestBuyDetail);

        $this->assertApiResponse($requestBuyDetail);
    }

    /**
     * @test
     */
    public function testReadRequestBuyDetail()
    {
        $requestBuyDetail = $this->makeRequestBuyDetail();
        $this->json('GET', '/api/v1/requestBuyDetails/'.$requestBuyDetail->id);

        $this->assertApiResponse($requestBuyDetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRequestBuyDetail()
    {
        $requestBuyDetail = $this->makeRequestBuyDetail();
        $editedRequestBuyDetail = $this->fakeRequestBuyDetailData();

        $this->json('PUT', '/api/v1/requestBuyDetails/'.$requestBuyDetail->id, $editedRequestBuyDetail);

        $this->assertApiResponse($editedRequestBuyDetail);
    }

    /**
     * @test
     */
    public function testDeleteRequestBuyDetail()
    {
        $requestBuyDetail = $this->makeRequestBuyDetail();
        $this->json('DELETE', '/api/v1/requestBuyDetails/'.$requestBuyDetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/requestBuyDetails/'.$requestBuyDetail->id);

        $this->assertResponseStatus(404);
    }
}
