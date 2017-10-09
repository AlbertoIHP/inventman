<?php

use App\Models\RequestDetail;
use App\Repositories\RequestDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestDetailRepositoryTest extends TestCase
{
    use MakeRequestDetailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequestDetailRepository
     */
    protected $requestDetailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->requestDetailRepo = App::make(RequestDetailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRequestDetail()
    {
        $requestDetail = $this->fakeRequestDetailData();
        $createdRequestDetail = $this->requestDetailRepo->create($requestDetail);
        $createdRequestDetail = $createdRequestDetail->toArray();
        $this->assertArrayHasKey('id', $createdRequestDetail);
        $this->assertNotNull($createdRequestDetail['id'], 'Created RequestDetail must have id specified');
        $this->assertNotNull(RequestDetail::find($createdRequestDetail['id']), 'RequestDetail with given id must be in DB');
        $this->assertModelData($requestDetail, $createdRequestDetail);
    }

    /**
     * @test read
     */
    public function testReadRequestDetail()
    {
        $requestDetail = $this->makeRequestDetail();
        $dbRequestDetail = $this->requestDetailRepo->find($requestDetail->id);
        $dbRequestDetail = $dbRequestDetail->toArray();
        $this->assertModelData($requestDetail->toArray(), $dbRequestDetail);
    }

    /**
     * @test update
     */
    public function testUpdateRequestDetail()
    {
        $requestDetail = $this->makeRequestDetail();
        $fakeRequestDetail = $this->fakeRequestDetailData();
        $updatedRequestDetail = $this->requestDetailRepo->update($fakeRequestDetail, $requestDetail->id);
        $this->assertModelData($fakeRequestDetail, $updatedRequestDetail->toArray());
        $dbRequestDetail = $this->requestDetailRepo->find($requestDetail->id);
        $this->assertModelData($fakeRequestDetail, $dbRequestDetail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRequestDetail()
    {
        $requestDetail = $this->makeRequestDetail();
        $resp = $this->requestDetailRepo->delete($requestDetail->id);
        $this->assertTrue($resp);
        $this->assertNull(RequestDetail::find($requestDetail->id), 'RequestDetail should not exist in DB');
    }
}
