<?php

use App\Models\Invetary;
use App\Repositories\InvetaryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvetaryRepositoryTest extends TestCase
{
    use MakeInvetaryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InvetaryRepository
     */
    protected $invetaryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->invetaryRepo = App::make(InvetaryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInvetary()
    {
        $invetary = $this->fakeInvetaryData();
        $createdInvetary = $this->invetaryRepo->create($invetary);
        $createdInvetary = $createdInvetary->toArray();
        $this->assertArrayHasKey('id', $createdInvetary);
        $this->assertNotNull($createdInvetary['id'], 'Created Invetary must have id specified');
        $this->assertNotNull(Invetary::find($createdInvetary['id']), 'Invetary with given id must be in DB');
        $this->assertModelData($invetary, $createdInvetary);
    }

    /**
     * @test read
     */
    public function testReadInvetary()
    {
        $invetary = $this->makeInvetary();
        $dbInvetary = $this->invetaryRepo->find($invetary->id);
        $dbInvetary = $dbInvetary->toArray();
        $this->assertModelData($invetary->toArray(), $dbInvetary);
    }

    /**
     * @test update
     */
    public function testUpdateInvetary()
    {
        $invetary = $this->makeInvetary();
        $fakeInvetary = $this->fakeInvetaryData();
        $updatedInvetary = $this->invetaryRepo->update($fakeInvetary, $invetary->id);
        $this->assertModelData($fakeInvetary, $updatedInvetary->toArray());
        $dbInvetary = $this->invetaryRepo->find($invetary->id);
        $this->assertModelData($fakeInvetary, $dbInvetary->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInvetary()
    {
        $invetary = $this->makeInvetary();
        $resp = $this->invetaryRepo->delete($invetary->id);
        $this->assertTrue($resp);
        $this->assertNull(Invetary::find($invetary->id), 'Invetary should not exist in DB');
    }
}
