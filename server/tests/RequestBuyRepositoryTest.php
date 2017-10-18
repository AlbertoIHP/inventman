<?php

use App\Models\RequestBuy;
use App\Repositories\RequestBuyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RequestBuyRepositoryTest extends TestCase
{
    use MakeRequestBuyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequestBuyRepository
     */
    protected $requestBuyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->requestBuyRepo = App::make(RequestBuyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateRequestBuy()
    {
        $requestBuy = $this->fakeRequestBuyData();
        $createdRequestBuy = $this->requestBuyRepo->create($requestBuy);
        $createdRequestBuy = $createdRequestBuy->toArray();
        $this->assertArrayHasKey('id', $createdRequestBuy);
        $this->assertNotNull($createdRequestBuy['id'], 'Created RequestBuy must have id specified');
        $this->assertNotNull(RequestBuy::find($createdRequestBuy['id']), 'RequestBuy with given id must be in DB');
        $this->assertModelData($requestBuy, $createdRequestBuy);
    }

    /**
     * @test read
     */
    public function testReadRequestBuy()
    {
        $requestBuy = $this->makeRequestBuy();
        $dbRequestBuy = $this->requestBuyRepo->find($requestBuy->id);
        $dbRequestBuy = $dbRequestBuy->toArray();
        $this->assertModelData($requestBuy->toArray(), $dbRequestBuy);
    }

    /**
     * @test update
     */
    public function testUpdateRequestBuy()
    {
        $requestBuy = $this->makeRequestBuy();
        $fakeRequestBuy = $this->fakeRequestBuyData();
        $updatedRequestBuy = $this->requestBuyRepo->update($fakeRequestBuy, $requestBuy->id);
        $this->assertModelData($fakeRequestBuy, $updatedRequestBuy->toArray());
        $dbRequestBuy = $this->requestBuyRepo->find($requestBuy->id);
        $this->assertModelData($fakeRequestBuy, $dbRequestBuy->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteRequestBuy()
    {
        $requestBuy = $this->makeRequestBuy();
        $resp = $this->requestBuyRepo->delete($requestBuy->id);
        $this->assertTrue($resp);
        $this->assertNull(RequestBuy::find($requestBuy->id), 'RequestBuy should not exist in DB');
    }
}
