<?php
namespace Tests\Filter;

use Tests\app\Search\UserCallbackSearch;
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
     * test_callback_filter
     */
    public function test_callback_filter()
    {
        $user = User::search(new UserCallbackSearch());
        $this->assertEquals(self::USER_NUM, $user->count());

        $user = User::search(new UserCallbackSearch(), ['example1'=> $this->faker[0]->name]);
        $this->assertTrue($user->exists());

        $user = User::search(new UserCallbackSearch(), ['example2'=> $this->faker[0]->name]);
        $this->assertTrue($user->exists());
    }
}
