<?php
namespace Tests\Filter;

use Tests\app\Search\UserSearch;
use Tests\app\User;
use Tests\TestCase;

class ValueTest extends TestCase
{
    private $faker = [];
    const USER_NUM = 20;

    protected function setUp() :void
    {
        parent::setUp();

        $this->faker = factory(User::class, self::USER_NUM)->create();
    }

    /**
     * test_value_filter
     */
    public function test_value_filter()
    {
        $user = User::search(new UserSearch());
        $this->assertEquals(self::USER_NUM, $user->count());

        $user = User::search(new UserSearch(), ['name'=> $this->faker[0]->name]);
        $this->assertTrue($user->exists());

        $user = User::search(new UserSearch(), ['name'=> 'dummy']);
        $this->assertFalse($user->exists());
    }
}
