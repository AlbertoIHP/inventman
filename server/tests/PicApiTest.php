<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PicApiTest extends TestCase
{
    use MakePicTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePic()
    {
        $pic = $this->fakePicData();
        $this->json('POST', '/api/v1/pics', $pic);

        $this->assertApiResponse($pic);
    }

    /**
     * @test
     */
    public function testReadPic()
    {
        $pic = $this->makePic();
        $this->json('GET', '/api/v1/pics/'.$pic->id);

        $this->assertApiResponse($pic->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePic()
    {
        $pic = $this->makePic();
        $editedPic = $this->fakePicData();

        $this->json('PUT', '/api/v1/pics/'.$pic->id, $editedPic);

        $this->assertApiResponse($editedPic);
    }

    /**
     * @test
     */
    public function testDeletePic()
    {
        $pic = $this->makePic();
        $this->json('DELETE', '/api/v1/pics/'.$pic->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pics/'.$pic->id);

        $this->assertResponseStatus(404);
    }
}
