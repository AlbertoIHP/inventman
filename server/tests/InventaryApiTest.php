<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventaryApiTest extends TestCase
{
    use MakeInventaryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInventary()
    {
        $inventary = $this->fakeInventaryData();
        $this->json('POST', '/api/v1/inventaries', $inventary);

        $this->assertApiResponse($inventary);
    }

    /**
     * @test
     */
    public function testReadInventary()
    {
        $inventary = $this->makeInventary();
        $this->json('GET', '/api/v1/inventaries/'.$inventary->id);

        $this->assertApiResponse($inventary->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInventary()
    {
        $inventary = $this->makeInventary();
        $editedInventary = $this->fakeInventaryData();

        $this->json('PUT', '/api/v1/inventaries/'.$inventary->id, $editedInventary);

        $this->assertApiResponse($editedInventary);
    }

    /**
     * @test
     */
    public function testDeleteInventary()
    {
        $inventary = $this->makeInventary();
        $this->json('DELETE', '/api/v1/inventaries/'.$inventary->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inventaries/'.$inventary->id);

        $this->assertResponseStatus(404);
    }
}
