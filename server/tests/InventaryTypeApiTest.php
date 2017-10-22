<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventaryTypeApiTest extends TestCase
{
    use MakeInventaryTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInventaryType()
    {
        $inventaryType = $this->fakeInventaryTypeData();
        $this->json('POST', '/api/v1/inventaryTypes', $inventaryType);

        $this->assertApiResponse($inventaryType);
    }

    /**
     * @test
     */
    public function testReadInventaryType()
    {
        $inventaryType = $this->makeInventaryType();
        $this->json('GET', '/api/v1/inventaryTypes/'.$inventaryType->id);

        $this->assertApiResponse($inventaryType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInventaryType()
    {
        $inventaryType = $this->makeInventaryType();
        $editedInventaryType = $this->fakeInventaryTypeData();

        $this->json('PUT', '/api/v1/inventaryTypes/'.$inventaryType->id, $editedInventaryType);

        $this->assertApiResponse($editedInventaryType);
    }

    /**
     * @test
     */
    public function testDeleteInventaryType()
    {
        $inventaryType = $this->makeInventaryType();
        $this->json('DELETE', '/api/v1/inventaryTypes/'.$inventaryType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inventaryTypes/'.$inventaryType->id);

        $this->assertResponseStatus(404);
    }
}
