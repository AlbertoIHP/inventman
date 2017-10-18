<?php

use App\Models\Pic;
use App\Repositories\PicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PicRepositoryTest extends TestCase
{
    use MakePicTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PicRepository
     */
    protected $picRepo;

    public function setUp()
    {
        parent::setUp();
        $this->picRepo = App::make(PicRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePic()
    {
        $pic = $this->fakePicData();
        $createdPic = $this->picRepo->create($pic);
        $createdPic = $createdPic->toArray();
        $this->assertArrayHasKey('id', $createdPic);
        $this->assertNotNull($createdPic['id'], 'Created Pic must have id specified');
        $this->assertNotNull(Pic::find($createdPic['id']), 'Pic with given id must be in DB');
        $this->assertModelData($pic, $createdPic);
    }

    /**
     * @test read
     */
    public function testReadPic()
    {
        $pic = $this->makePic();
        $dbPic = $this->picRepo->find($pic->id);
        $dbPic = $dbPic->toArray();
        $this->assertModelData($pic->toArray(), $dbPic);
    }

    /**
     * @test update
     */
    public function testUpdatePic()
    {
        $pic = $this->makePic();
        $fakePic = $this->fakePicData();
        $updatedPic = $this->picRepo->update($fakePic, $pic->id);
        $this->assertModelData($fakePic, $updatedPic->toArray());
        $dbPic = $this->picRepo->find($pic->id);
        $this->assertModelData($fakePic, $dbPic->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePic()
    {
        $pic = $this->makePic();
        $resp = $this->picRepo->delete($pic->id);
        $this->assertTrue($resp);
        $this->assertNull(Pic::find($pic->id), 'Pic should not exist in DB');
    }
}
