<?php
namespace Tests\Filter;

use Tests\app\Search\UserSearch;
use Tests\app\User;
use Tests\TestCase;

class InTest extends TestCase
{
    private $faker = [];
    const USER_NUM = 20;

    protected function setUp() :void
    {
        parent::setUp();

        $this->faker = factory(User::class, self::USER_NUM)->create();
    }

    /**
     * test_in_filter
     */
    public function test_in_filter()
    {
        $user = User::search(new UserSearch());
        $this->assertEquals(self::USER_NUM, $user->count());

        $user = User::search(new UserSearch(), ['email'=> [$this->faker[0]->email, $this->faker[1]->email]]);
        $this->assertEquals(2, $user->count());

        $user = User::search(new UserSearch(), ['email'=> $this->faker[0]->email]);
        $this->assertTrue($user->exists());

        $id = $this->faker[1]->id;
        $user = User::search(new UserSearch(), ['id' => $id]);
        $this->assertTrue($user->exists());
        $this->assertEquals(
            $this->faker->where('id', $id)->count(),
            User::whereIn('id', [$id])->count()
        );
    }
}
