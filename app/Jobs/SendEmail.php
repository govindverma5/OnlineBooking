<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $book;
    private $review;
    private $rating ;
    private $user = [] ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($book,$review,$rating,$user)
    {
        $this->book = $book;
        $this->review = $review;
        $this->rating = $rating;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $book = $this->book ;
        $review = $this->review ;
        $rating = $this->rating ;
        $user = $this->user ;

        foreach($book->author as $author){
            \Mail::send('emails.email', ['review' => $review,'rating' => $rating,'user_name'=> $user->name,'book_title'=>$book->title,'book_description'=>$book->description], function($message) use($author){
                $message->to("test@yopmail.com")->subject("Email Notifications!");
            });
        }
    }
}
