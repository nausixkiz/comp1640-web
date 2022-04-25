<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IdeaCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $idea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $idea)
    {
        $this->idea = $idea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.idea_created');
    }
}
