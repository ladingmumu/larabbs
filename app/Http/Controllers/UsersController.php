<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    //显示个人页面
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    //显示编辑资料页面
    public function edit(User $user){
        return view('users.edit',compact('user'));
    }

    //更新个人资料
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user){

        $data = $request->all();

        if ($request->avatar){
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }

}
