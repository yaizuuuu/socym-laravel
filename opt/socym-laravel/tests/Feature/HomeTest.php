<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Chapter1_1
 *
 * Class HomeTest
 * @package Tests\Feature
 */
class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePageStatusCode200()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function testHomePageBodySeeText()
    {
        $response = $this->get('/home');

        $response->assertSeeText('こんにちは！');
    }

    public function testHasDoneMigrationToTestDB() {
        $this->assertTrue(Schema::hasTable('users'));
        $this->assertTrue(Schema::hasTable('password_resets'));
    }
}
