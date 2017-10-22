<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestDetailApiTest extends TestCase
{
    use MakeRequestDetailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateRequestDetail()
    {
        $requestDetail = $this->fakeRequestDetailData();
        $this->json('POST', '/api/v1/requestDetails', $requestDetail);

        $this->assertApiResponse($requestDetail);
    }

    /**
     * @test
     */
    public function testReadRequestDetail()
    {
        $requestDetail = $this->makeRequestDetail();
        $this->json('GET', '/api/v1/requestDetails/'.$requestDetail->id);

        $this->assertApiResponse($requestDetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateRequestDetail()
    {
        $requestDetail = $this->makeRequestDetail();
        $editedRequestDetail = $this->fakeRequestDetailData();

        $this->json('PUT', '/api/v1/requestDetails/'.$requestDetail->id, $editedRequestDetail);

        $this->assertApiResponse($editedRequestDetail);
    }

    /**
     * @test
     */
    public function testDeleteRequestDetail()
    {
        $requestDetail = $this->makeRequestDetail();
        $this->json('DELETE', '/api/v1/requestDetails/'.$requestDetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/requestDetails/'.$requestDetail->id);

        $this->assertResponseStatus(404);
    }
}
