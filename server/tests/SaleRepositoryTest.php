<?php

use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SaleRepositoryTest extends TestCase
{
    use MakeSaleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SaleRepository
     */
    protected $saleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->saleRepo = App::make(SaleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSale()
    {
        $sale = $this->fakeSaleData();
        $createdSale = $this->saleRepo->create($sale);
        $createdSale = $createdSale->toArray();
        $this->assertArrayHasKey('id', $createdSale);
        $this->assertNotNull($createdSale['id'], 'Created Sale must have id specified');
        $this->assertNotNull(Sale::find($createdSale['id']), 'Sale with given id must be in DB');
        $this->assertModelData($sale, $createdSale);
    }

    /**
     * @test read
     */
    public function testReadSale()
    {
        $sale = $this->makeSale();
        $dbSale = $this->saleRepo->find($sale->id);
        $dbSale = $dbSale->toArray();
        $this->assertModelData($sale->toArray(), $dbSale);
    }

    /**
     * @test update
     */
    public function testUpdateSale()
    {
        $sale = $this->makeSale();
        $fakeSale = $this->fakeSaleData();
        $updatedSale = $this->saleRepo->update($fakeSale, $sale->id);
        $this->assertModelData($fakeSale, $updatedSale->toArray());
        $dbSale = $this->saleRepo->find($sale->id);
        $this->assertModelData($fakeSale, $dbSale->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSale()
    {
        $sale = $this->makeSale();
        $resp = $this->saleRepo->delete($sale->id);
        $this->assertTrue($resp);
        $this->assertNull(Sale::find($sale->id), 'Sale should not exist in DB');
    }
}
