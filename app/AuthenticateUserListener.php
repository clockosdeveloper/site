<?php
/**
 * Created by PhpStorm.
 * User: YELLOVE
 * Date: 11/26/2015
 * Time: 5:30 PM
 */
namespace App;

interface AuthenticateUserListener
{
    public function userHasLoggedIn($user);
}