<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\WebConfig;

class WebConfigApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_web_config()
    {
        $webConfig = WebConfig::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/web_configs', $webConfig
        );

        $this->assertApiResponse($webConfig);
    }

    /**
     * @test
     */
    public function test_read_web_config()
    {
        $webConfig = WebConfig::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/web_configs/'.$webConfig->id
        );

        $this->assertApiResponse($webConfig->toArray());
    }

    /**
     * @test
     */
    public function test_update_web_config()
    {
        $webConfig = WebConfig::factory()->create();
        $editedWebConfig = WebConfig::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/web_configs/'.$webConfig->id,
            $editedWebConfig
        );

        $this->assertApiResponse($editedWebConfig);
    }

    /**
     * @test
     */
    public function test_delete_web_config()
    {
        $webConfig = WebConfig::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/web_configs/'.$webConfig->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/web_configs/'.$webConfig->id
        );

        $this->response->assertStatus(404);
    }
}
