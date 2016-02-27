<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function findByUsernameOrCreate($userData)
    {
        $user = User::where([
            'email'    => $userData->email,
        ])->first();

        if(!$user){
            $user = User::create([
                'email'    => $userData->email,
                'username' => $userData->nickname,
                'avatar'   => $userData->avatar,
                'github'   => $userData->user['html_url'],
                'blog'     => $userData->user['blog'],
                'company'  => $userData->user['company'],
                'location' => $userData->user['location'],
                'sponsor_code' =>$user['sponsor_code'] = md5($userData->email.time())
            ]);

            $user->assignRole('rookie');

        }

        return $user;

    }
}