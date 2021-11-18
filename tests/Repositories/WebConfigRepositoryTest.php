<?php namespace Tests\Repositories;

use App\Models\WebConfig;
use App\Repositories\WebConfigRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WebConfigRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WebConfigRepository
     */
    protected $webConfigRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->webConfigRepo = \App::make(WebConfigRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_web_config()
    {
        $webConfig = WebConfig::factory()->make()->toArray();

        $createdWebConfig = $this->webConfigRepo->create($webConfig);

        $createdWebConfig = $createdWebConfig->toArray();
        $this->assertArrayHasKey('id', $createdWebConfig);
        $this->assertNotNull($createdWebConfig['id'], 'Created WebConfig must have id specified');
        $this->assertNotNull(WebConfig::find($createdWebConfig['id']), 'WebConfig with given id must be in DB');
        $this->assertModelData($webConfig, $createdWebConfig);
    }

    /**
     * @test read
     */
    public function test_read_web_config()
    {
        $webConfig = WebConfig::factory()->create();

        $dbWebConfig = $this->webConfigRepo->find($webConfig->id);

        $dbWebConfig = $dbWebConfig->toArray();
        $this->assertModelData($webConfig->toArray(), $dbWebConfig);
    }

    /**
     * @test update
     */
    public function test_update_web_config()
    {
        $webConfig = WebConfig::factory()->create();
        $fakeWebConfig = WebConfig::factory()->make()->toArray();

        $updatedWebConfig = $this->webConfigRepo->update($fakeWebConfig, $webConfig->id);

        $this->assertModelData($fakeWebConfig, $updatedWebConfig->toArray());
        $dbWebConfig = $this->webConfigRepo->find($webConfig->id);
        $this->assertModelData($fakeWebConfig, $dbWebConfig->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_web_config()
    {
        $webConfig = WebConfig::factory()->create();

        $resp = $this->webConfigRepo->delete($webConfig->id);

        $this->assertTrue($resp);
        $this->assertNull(WebConfig::find($webConfig->id), 'WebConfig should not exist in DB');
    }
}
