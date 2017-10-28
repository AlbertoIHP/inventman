<?php

use App\Models\Function;
use App\Repositories\FunctionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FunctionRepositoryTest extends TestCase
{
    use MakeFunctionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FunctionRepository
     */
    protected $functionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->functionRepo = App::make(FunctionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFunction()
    {
        $function = $this->fakeFunctionData();
        $createdFunction = $this->functionRepo->create($function);
        $createdFunction = $createdFunction->toArray();
        $this->assertArrayHasKey('id', $createdFunction);
        $this->assertNotNull($createdFunction['id'], 'Created Function must have id specified');
        $this->assertNotNull(Function::find($createdFunction['id']), 'Function with given id must be in DB');
        $this->assertModelData($function, $createdFunction);
    }

    /**
     * @test read
     */
    public function testReadFunction()
    {
        $function = $this->makeFunction();
        $dbFunction = $this->functionRepo->find($function->id);
        $dbFunction = $dbFunction->toArray();
        $this->assertModelData($function->toArray(), $dbFunction);
    }

    /**
     * @test update
     */
    public function testUpdateFunction()
    {
        $function = $this->makeFunction();
        $fakeFunction = $this->fakeFunctionData();
        $updatedFunction = $this->functionRepo->update($fakeFunction, $function->id);
        $this->assertModelData($fakeFunction, $updatedFunction->toArray());
        $dbFunction = $this->functionRepo->find($function->id);
        $this->assertModelData($fakeFunction, $dbFunction->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFunction()
    {
        $function = $this->makeFunction();
        $resp = $this->functionRepo->delete($function->id);
        $this->assertTrue($resp);
        $this->assertNull(Function::find($function->id), 'Function should not exist in DB');
    }
}
