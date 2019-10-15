<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\post;
use Illuminate\Database\Eloquent\Model;


class changeStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idPost;
    protected $idUser;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$userID)
    {
        $this->idPost=$id;
        $this->idUser=$userID;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $id=$this->idPost;
        $post=post::find($id);
        if($post->status==2){
            $post->userRents()->updateExistingPivot($this->idUser,['status'=>3]);
            $post->status=1;
            $post->save();
            return;
        }
    }
}
