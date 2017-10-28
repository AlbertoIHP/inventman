<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FunctionApiTest extends TestCase
{
    use MakeFunctionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFunction()
    {
        $function = $this->fakeFunctionData();
        $this->json('POST', '/api/v1/functions', $function);

        $this->assertApiResponse($function);
    }

    /**
     * @test
     */
    public function testReadFunction()
    {
        $function = $this->makeFunction();
        $this->json('GET', '/api/v1/functions/'.$function->id);

        $this->assertApiResponse($function->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFunction()
    {
        $function = $this->makeFunction();
        $editedFunction = $this->fakeFunctionData();

        $this->json('PUT', '/api/v1/functions/'.$function->id, $editedFunction);

        $this->assertApiResponse($editedFunction);
    }

    /**
     * @test
     */
    public function testDeleteFunction()
    {
        $function = $this->makeFunction();
        $this->json('DELETE', '/api/v1/functions/'.$function->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/functions/'.$function->id);

        $this->assertResponseStatus(404);
    }
}
