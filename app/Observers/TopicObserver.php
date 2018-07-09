<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }


    //make_excerpt() 是我们自定义的辅助方法
    public function saving(Topic $topic){
        $topic->excerpt = make_excerpt($topic->body);
    }
}