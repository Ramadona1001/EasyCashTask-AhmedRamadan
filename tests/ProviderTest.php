<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Pipeline\Pipeline;
use App\FilterResult\Provider;

class ProviderTest extends TestCase
{
    protected $provider = 'DataProviderX';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_base_endpoint_returns_a_successful_response()
    {
        $this->get('/api/v1/transactaions');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function test_should_return_provider(){
        $this->get("/api/v1/transactaions?provider=".$this->provider, []);
        $this->seeStatusCode(200);
        $data_json = readJsonFile($this->provider);
        if($data_json)
            print_r($data_json);
        $this->seeJsonStructure(null,$data_json);
        
    }

}
