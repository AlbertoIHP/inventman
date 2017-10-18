<?php

use App\Models\ProductsSale;
use App\Repositories\ProductsSaleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsSaleRepositoryTest extends TestCase
{
    use MakeProductsSaleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductsSaleRepository
     */
    protected $productsSaleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->productsSaleRepo = App::make(ProductsSaleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProductsSale()
    {
        $productsSale = $this->fakeProductsSaleData();
        $createdProductsSale = $this->productsSaleRepo->create($productsSale);
        $createdProductsSale = $createdProductsSale->toArray();
        $this->assertArrayHasKey('id', $createdProductsSale);
        $this->assertNotNull($createdProductsSale['id'], 'Created ProductsSale must have id specified');
        $this->assertNotNull(ProductsSale::find($createdProductsSale['id']), 'ProductsSale with given id must be in DB');
        $this->assertModelData($productsSale, $createdProductsSale);
    }

    /**
     * @test read
     */
    public function testReadProductsSale()
    {
        $productsSale = $this->makeProductsSale();
        $dbProductsSale = $this->productsSaleRepo->find($productsSale->id);
        $dbProductsSale = $dbProductsSale->toArray();
        $this->assertModelData($productsSale->toArray(), $dbProductsSale);
    }

    /**
     * @test update
     */
    public function testUpdateProductsSale()
    {
        $productsSale = $this->makeProductsSale();
        $fakeProductsSale = $this->fakeProductsSaleData();
        $updatedProductsSale = $this->productsSaleRepo->update($fakeProductsSale, $productsSale->id);
        $this->assertModelData($fakeProductsSale, $updatedProductsSale->toArray());
        $dbProductsSale = $this->productsSaleRepo->find($productsSale->id);
        $this->assertModelData($fakeProductsSale, $dbProductsSale->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProductsSale()
    {
        $productsSale = $this->makeProductsSale();
        $resp = $this->productsSaleRepo->delete($productsSale->id);
        $this->assertTrue($resp);
        $this->assertNull(ProductsSale::find($productsSale->id), 'ProductsSale should not exist in DB');
    }
}
