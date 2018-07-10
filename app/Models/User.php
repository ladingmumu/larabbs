<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable{
        notify as protected laravelNotify;
    }

    public function notify($instance){

        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //与话题模型关联,一个用户拥有多条帖子
    public function topics(){
        return $this->hasMany(Topic::class);
    }

    //与回复模型关联,一个用户拥有多条回复
    public function replies(){
        return $this->hasMany(Reply::class);
    }

    //代码重构
    public function isAuthorOf($model){
        return $this->id == $model->user_id;
    }

    //当用户访问通知列表时，将所有通知状态设定为已读，并清空未读消息数。
    public function markAsRead(){
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
