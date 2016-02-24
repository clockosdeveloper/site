<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FirstTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/auth/register')
             ->type('yellove','name')
             ->type('password','password')
             ->type('john@exmaple.com','email')
             ->press('Register');

        $this->see('ÇëµÇÂ½ÓÊÏä¼¤»îÄãµÄÕËºÅ');
    }
}
