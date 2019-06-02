<?php
namespace Tests\Filter;

use Tests\app\Search\UserCustomSearch;
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
     * test_custom_filter
     */
    public function test_custom_filter()
    {
        $user = User::search(new UserCustomSearch());
        $this->assertEquals(self::USER_NUM, $user->count());

        $user = User::search(new UserCustomSearch(), ['name'=> $this->faker[0]->name]);
        $this->assertTrue($user->exists());
    }
}
