<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvetaryApiTest extends TestCase
{
    use MakeInvetaryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInvetary()
    {
        $invetary = $this->fakeInvetaryData();
        $this->json('POST', '/api/v1/invetaries', $invetary);

        $this->assertApiResponse($invetary);
    }

    /**
     * @test
     */
    public function testReadInvetary()
    {
        $invetary = $this->makeInvetary();
        $this->json('GET', '/api/v1/invetaries/'.$invetary->id);

        $this->assertApiResponse($invetary->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInvetary()
    {
        $invetary = $this->makeInvetary();
        $editedInvetary = $this->fakeInvetaryData();

        $this->json('PUT', '/api/v1/invetaries/'.$invetary->id, $editedInvetary);

        $this->assertApiResponse($editedInvetary);
    }

    /**
     * @test
     */
    public function testDeleteInvetary()
    {
        $invetary = $this->makeInvetary();
        $this->json('DELETE', '/api/v1/invetaries/'.$invetary->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/invetaries/'.$invetary->id);

        $this->assertResponseStatus(404);
    }
}
