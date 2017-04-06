<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class IndividualSignup extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Project
     */
    public $project;
    /*
     * @var user
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, User $user)
    {
        //
        $this->project = $project;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@sc-cityserve.org')
                    ->markdown('emails.project.signup.individual');
    }
}
