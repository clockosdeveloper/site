<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Gate;
use Intervention\Image\Facades\Image;
use App\Services\UpyunUpload;
use App\Services\UpyunOther;

class AvatarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:jpg,jpeg,png,bmp,gif'
        ]);

        $file = $request->file('file');

        $name = time().$file->getClientOriginalName();

        $path = 'img/avatar/'.\Auth::id().'/'.$name;

        $file->move('img/avatar/'.\Auth::id().'/',$name);

        Image::make($path)
            ->resize(640, null, function ($constraint) {    //��֤���� ��ȵ�Ϊ640
                $constraint->aspectRatio();
            })
            ->save();

        session()->put('avatar','/'.$path);//��Ҫ�ü���ͼƬ��ʱ���ڻỰ��

        return redirect('/profiles/avatar/crop'); //IE10���µ��������ϴ�ͼƬ����ת
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('user.avatar_old',compact('user'));//'user.avatar_old' IE10���µĲü�����
    }

    public function editAvatar()
    {
        $user = \Auth::user();
        session()->put('avatar',$user->avatar);
        return view('user.avatar',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,UpyunUpload $upyun,UpyunOther $delete,User $user)
    {
        $this->validate($request,[
            'x' => 'required|digits_between:0,9999',
            'y' => 'required|digits_between:0,9999',
            'w' => 'required|digits_between:1,9999',
            'h' => 'required|digits_between:1,9999',
        ]);

        $photo = $request->all();

        $photo['path'] = session('avatar');

        $photo['file'] = ltrim(session('avatar'),'/');

        $folder = '/img/avatar/'.\Auth::id();

        $delete->deleteDir($folder);

        $upyun->uploadImage($photo);            //上传到云存储中

        \File::deleteDirectory(public_path(ltrim($folder,'/')));        //删除本地存储头像的临时文件夹

        $link = env('STR_URL').$photo['path'];

        $user->where('id',\Auth::id())->update(['avatar' => $link]);

        flash()->success(trans('profile.update_avatar'));

        return redirect('/profiles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:jpg,jpeg,png,bmp,gif'
        ]);

        $file = $request->file('file');


        $ext = $file->getClientOriginalExtension();

        $name = time().str_random(6).'.'.$ext;

        $path = 'img/avatar/'.\Auth::id().'/'.$name;

        $file->move('img/avatar/'.\Auth::id().'/',$name);

        Image::make($path)
            ->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save();

        session()->put('avatar','/'.$path);//��Ҫ�ü���ͼƬ��ʱ���ڻỰ��

        return redirect('/profiles/avatar/crop'); //IE10���µ��������ϴ�ͼƬ����ת

    }


    public function getAvatarLink()
    {
        return session('avatar');
    }
}
