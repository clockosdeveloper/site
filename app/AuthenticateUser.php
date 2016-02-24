<?php
/**
 * Created by PhpStorm.
 * User: YELLOVE
 * Date: 11/26/2015
 * Time: 1:28 PM
 */

namespace App;

use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateUser
{
    private $socialite;

    private $auth;

    private $users;

    public function __construct(UserRepository $users,Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    public function execute($hasCode,AuthenticateUserListener $listener)
    {
        if(!$hasCode) return $this->getAuthorizationFirst();

        $user = $this->users->findByUsernameOrCreate($this->getGithubUser());

        $this->auth->login($user,true);

        return $listener->userHasLoggedIn($user);


    }

    private function getAuthorizationFirst()
    {
        return $this->socialite->driver('github')->redirect();
    }

    private function getGithubUser()
    {
        return $this->socialite->driver('github')->user();
    }

}