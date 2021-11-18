<?php namespace Tests\Repositories;

use App\Models\SpecialInstruction;
use App\Repositories\SpecialInstructionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialInstructionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialInstructionRepository
     */
    protected $specialInstructionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialInstructionRepo = \App::make(SpecialInstructionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->make()->toArray();

        $createdSpecialInstruction = $this->specialInstructionRepo->create($specialInstruction);

        $createdSpecialInstruction = $createdSpecialInstruction->toArray();
        $this->assertArrayHasKey('id', $createdSpecialInstruction);
        $this->assertNotNull($createdSpecialInstruction['id'], 'Created SpecialInstruction must have id specified');
        $this->assertNotNull(SpecialInstruction::find($createdSpecialInstruction['id']), 'SpecialInstruction with given id must be in DB');
        $this->assertModelData($specialInstruction, $createdSpecialInstruction);
    }

    /**
     * @test read
     */
    public function test_read_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->create();

        $dbSpecialInstruction = $this->specialInstructionRepo->find($specialInstruction->id);

        $dbSpecialInstruction = $dbSpecialInstruction->toArray();
        $this->assertModelData($specialInstruction->toArray(), $dbSpecialInstruction);
    }

    /**
     * @test update
     */
    public function test_update_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->create();
        $fakeSpecialInstruction = SpecialInstruction::factory()->make()->toArray();

        $updatedSpecialInstruction = $this->specialInstructionRepo->update($fakeSpecialInstruction, $specialInstruction->id);

        $this->assertModelData($fakeSpecialInstruction, $updatedSpecialInstruction->toArray());
        $dbSpecialInstruction = $this->specialInstructionRepo->find($specialInstruction->id);
        $this->assertModelData($fakeSpecialInstruction, $dbSpecialInstruction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->create();

        $resp = $this->specialInstructionRepo->delete($specialInstruction->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialInstruction::find($specialInstruction->id), 'SpecialInstruction should not exist in DB');
    }
}
