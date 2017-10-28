<?php

use App\Models\ProductSale;
use App\Repositories\ProductSaleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductSaleRepositoryTest extends TestCase
{
    use MakeProductSaleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductSaleRepository
     */
    protected $productSaleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->productSaleRepo = App::make(ProductSaleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProductSale()
    {
        $productSale = $this->fakeProductSaleData();
        $createdProductSale = $this->productSaleRepo->create($productSale);
        $createdProductSale = $createdProductSale->toArray();
        $this->assertArrayHasKey('id', $createdProductSale);
        $this->assertNotNull($createdProductSale['id'], 'Created ProductSale must have id specified');
        $this->assertNotNull(ProductSale::find($createdProductSale['id']), 'ProductSale with given id must be in DB');
        $this->assertModelData($productSale, $createdProductSale);
    }

    /**
     * @test read
     */
    public function testReadProductSale()
    {
        $productSale = $this->makeProductSale();
        $dbProductSale = $this->productSaleRepo->find($productSale->id);
        $dbProductSale = $dbProductSale->toArray();
        $this->assertModelData($productSale->toArray(), $dbProductSale);
    }

    /**
     * @test update
     */
    public function testUpdateProductSale()
    {
        $productSale = $this->makeProductSale();
        $fakeProductSale = $this->fakeProductSaleData();
        $updatedProductSale = $this->productSaleRepo->update($fakeProductSale, $productSale->id);
        $this->assertModelData($fakeProductSale, $updatedProductSale->toArray());
        $dbProductSale = $this->productSaleRepo->find($productSale->id);
        $this->assertModelData($fakeProductSale, $dbProductSale->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProductSale()
    {
        $productSale = $this->makeProductSale();
        $resp = $this->productSaleRepo->delete($productSale->id);
        $this->assertTrue($resp);
        $this->assertNull(ProductSale::find($productSale->id), 'ProductSale should not exist in DB');
    }
}
