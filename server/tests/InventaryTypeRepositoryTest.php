<?php

use App\Models\InventaryType;
use App\Repositories\InventaryTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventaryTypeRepositoryTest extends TestCase
{
    use MakeInventaryTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InventaryTypeRepository
     */
    protected $inventaryTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inventaryTypeRepo = App::make(InventaryTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInventaryType()
    {
        $inventaryType = $this->fakeInventaryTypeData();
        $createdInventaryType = $this->inventaryTypeRepo->create($inventaryType);
        $createdInventaryType = $createdInventaryType->toArray();
        $this->assertArrayHasKey('id', $createdInventaryType);
        $this->assertNotNull($createdInventaryType['id'], 'Created InventaryType must have id specified');
        $this->assertNotNull(InventaryType::find($createdInventaryType['id']), 'InventaryType with given id must be in DB');
        $this->assertModelData($inventaryType, $createdInventaryType);
    }

    /**
     * @test read
     */
    public function testReadInventaryType()
    {
        $inventaryType = $this->makeInventaryType();
        $dbInventaryType = $this->inventaryTypeRepo->find($inventaryType->id);
        $dbInventaryType = $dbInventaryType->toArray();
        $this->assertModelData($inventaryType->toArray(), $dbInventaryType);
    }

    /**
     * @test update
     */
    public function testUpdateInventaryType()
    {
        $inventaryType = $this->makeInventaryType();
        $fakeInventaryType = $this->fakeInventaryTypeData();
        $updatedInventaryType = $this->inventaryTypeRepo->update($fakeInventaryType, $inventaryType->id);
        $this->assertModelData($fakeInventaryType, $updatedInventaryType->toArray());
        $dbInventaryType = $this->inventaryTypeRepo->find($inventaryType->id);
        $this->assertModelData($fakeInventaryType, $dbInventaryType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInventaryType()
    {
        $inventaryType = $this->makeInventaryType();
        $resp = $this->inventaryTypeRepo->delete($inventaryType->id);
        $this->assertTrue($resp);
        $this->assertNull(InventaryType::find($inventaryType->id), 'InventaryType should not exist in DB');
    }
}
