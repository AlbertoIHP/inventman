<?php

use App\Models\Inventary;
use App\Repositories\InventaryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventaryRepositoryTest extends TestCase
{
    use MakeInventaryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InventaryRepository
     */
    protected $inventaryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inventaryRepo = App::make(InventaryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInventary()
    {
        $inventary = $this->fakeInventaryData();
        $createdInventary = $this->inventaryRepo->create($inventary);
        $createdInventary = $createdInventary->toArray();
        $this->assertArrayHasKey('id', $createdInventary);
        $this->assertNotNull($createdInventary['id'], 'Created Inventary must have id specified');
        $this->assertNotNull(Inventary::find($createdInventary['id']), 'Inventary with given id must be in DB');
        $this->assertModelData($inventary, $createdInventary);
    }

    /**
     * @test read
     */
    public function testReadInventary()
    {
        $inventary = $this->makeInventary();
        $dbInventary = $this->inventaryRepo->find($inventary->id);
        $dbInventary = $dbInventary->toArray();
        $this->assertModelData($inventary->toArray(), $dbInventary);
    }

    /**
     * @test update
     */
    public function testUpdateInventary()
    {
        $inventary = $this->makeInventary();
        $fakeInventary = $this->fakeInventaryData();
        $updatedInventary = $this->inventaryRepo->update($fakeInventary, $inventary->id);
        $this->assertModelData($fakeInventary, $updatedInventary->toArray());
        $dbInventary = $this->inventaryRepo->find($inventary->id);
        $this->assertModelData($fakeInventary, $dbInventary->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInventary()
    {
        $inventary = $this->makeInventary();
        $resp = $this->inventaryRepo->delete($inventary->id);
        $this->assertTrue($resp);
        $this->assertNull(Inventary::find($inventary->id), 'Inventary should not exist in DB');
    }
}
