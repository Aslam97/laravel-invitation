<?php

namespace Tests\Unit;

use App\Admin;
use App\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_admin_can_be_instantiated()
    {
        $admin = factory(Admin::class, 1)->make();
        $this->assertTrue(!$admin->isEmpty());
    }

    public function test_user_can_be_instantiated()
    {
        $user = factory(User::class, 1)->make();
        $this->assertTrue(!$user->isEmpty());
    }
}
