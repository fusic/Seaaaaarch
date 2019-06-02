<?php
namespace Tests\Filter;

use Tests\app\Search\UserLikeSearch;
use Tests\app\User;
use Tests\TestCase;

class LikeTest extends TestCase
{
    private $faker = [];
    const USER_NUM = 20;

    protected function setUp() :void
    {
        parent::setUp();

        $this->faker = factory(User::class, self::USER_NUM)->create();
    }

    /**
     * test_like_filter
     */
    public function test_like_filter()
    {
        $user = User::search(new UserLikeSearch());
        $this->assertEquals(self::USER_NUM, $user->count());

        $user = User::search(new UserLikeSearch(), ['name'=> $this->trim($this->faker[0]->name)]);
        $this->assertTrue($user->exists());

        $user = User::search(new UserLikeSearch(), ['example'=> $this->trim($this->faker[0]->name)]);
        $this->assertTrue($user->exists());

        $user = User::search(new UserLikeSearch(), ['email'=> $this->trim($this->faker[0]->name)]);
        $this->assertTrue($user->exists());
    }

    /**
     * @param string $str
     * @return string
     */
    private function trim($str) :string
    {
        $str = mb_substr($str, 0, -1);
        $str = mb_substr($str, 1);
        return $str;
    }
}
