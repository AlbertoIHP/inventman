<?php

use App\Models\RequestBuyDetail;
use App\Repositories\RequestBuyDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestBuyDetailRepositoryTest extends TestCase
{
    use MakeRequestBuyDetailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequestBuyDetailRepository
     */
    protected $requestBuyDetailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->requestBuyDetailRepo = App::make(RequestBuyDetailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRequestBuyDetail()
    {
        $requestBuyDetail = $this->fakeRequestBuyDetailData();
        $createdRequestBuyDetail = $this->requestBuyDetailRepo->create($requestBuyDetail);
        $createdRequestBuyDetail = $createdRequestBuyDetail->toArray();
        $this->assertArrayHasKey('id', $createdRequestBuyDetail);
        $this->assertNotNull($createdRequestBuyDetail['id'], 'Created RequestBuyDetail must have id specified');
        $this->assertNotNull(RequestBuyDetail::find($createdRequestBuyDetail['id']), 'RequestBuyDetail with given id must be in DB');
        $this->assertModelData($requestBuyDetail, $createdRequestBuyDetail);
    }

    /**
     * @test read
     */
    public function testReadRequestBuyDetail()
    {
        $requestBuyDetail = $this->makeRequestBuyDetail();
        $dbRequestBuyDetail = $this->requestBuyDetailRepo->find($requestBuyDetail->id);
        $dbRequestBuyDetail = $dbRequestBuyDetail->toArray();
        $this->assertModelData($requestBuyDetail->toArray(), $dbRequestBuyDetail);
    }

    /**
     * @test update
     */
    public function testUpdateRequestBuyDetail()
    {
        $requestBuyDetail = $this->makeRequestBuyDetail();
        $fakeRequestBuyDetail = $this->fakeRequestBuyDetailData();
        $updatedRequestBuyDetail = $this->requestBuyDetailRepo->update($fakeRequestBuyDetail, $requestBuyDetail->id);
        $this->assertModelData($fakeRequestBuyDetail, $updatedRequestBuyDetail->toArray());
        $dbRequestBuyDetail = $this->requestBuyDetailRepo->find($requestBuyDetail->id);
        $this->assertModelData($fakeRequestBuyDetail, $dbRequestBuyDetail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRequestBuyDetail()
    {
        $requestBuyDetail = $this->makeRequestBuyDetail();
        $resp = $this->requestBuyDetailRepo->delete($requestBuyDetail->id);
        $this->assertTrue($resp);
        $this->assertNull(RequestBuyDetail::find($requestBuyDetail->id), 'RequestBuyDetail should not exist in DB');
    }
}
