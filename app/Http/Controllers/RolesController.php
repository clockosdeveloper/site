<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware('profile',['only'=>'index']);
        
        $this->middleware('add_permission',['only'=>'index']);
    }

    public function index()
    {

        $skills =\Auth::user()->skills()->get();

        $roles = \Auth::user()->roles()->first();

        return view('user.role',compact('skills','roles'));
    }

    public function assign()
    {

        //Role::create(['name' => 'rookie','logo' => '/img/role/color/rookie.png']);

        //\Auth::user()->assignRole('ceo');

        $permission = 'manage_skill';

        Permission::create(['name' => $permission ,'path' => '/manage/department/']);

        $role  = Role::where(['name' => 'ceo'])->first();

        $role->givePermissionTo($permission);

    }
}
