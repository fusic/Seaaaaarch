<?php

namespace Tests\Filter;

use Tests\app\Search\UserDefaultValueSearch;
use Tests\app\User;
use Tests\TestCase;

class DefaultValueTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * test_default_value.
     */
    public function testDefaultValueFilter()
    {
        $this->faker[] = factory(User::class)->create(['name' => 'UserDefaultValue']);

        $user = User::search(new UserDefaultValueSearch());
        $this->assertTrue($user->exists());

        $user = User::search(new UserDefaultValueSearch(), ['name'=> 'dummy']);
        $this->assertFalse($user->exists());
    }
}
