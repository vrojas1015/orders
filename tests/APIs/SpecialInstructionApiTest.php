<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SpecialInstruction;

class SpecialInstructionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/special_instructions', $specialInstruction
        );

        $this->assertApiResponse($specialInstruction);
    }

    /**
     * @test
     */
    public function test_read_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/special_instructions/'.$specialInstruction->id
        );

        $this->assertApiResponse($specialInstruction->toArray());
    }

    /**
     * @test
     */
    public function test_update_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->create();
        $editedSpecialInstruction = SpecialInstruction::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/special_instructions/'.$specialInstruction->id,
            $editedSpecialInstruction
        );

        $this->assertApiResponse($editedSpecialInstruction);
    }

    /**
     * @test
     */
    public function test_delete_special_instruction()
    {
        $specialInstruction = SpecialInstruction::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/special_instructions/'.$specialInstruction->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/special_instructions/'.$specialInstruction->id
        );

        $this->response->assertStatus(404);
    }
}
