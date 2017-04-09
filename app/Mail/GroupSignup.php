<?php

namespace App\Mail;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupSignup extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Project
     */
    public $project;
    /*
     * @var group;
     */
    public $group;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, Group $group)
    {
        //
        $this->project = $project;
        $this->group = $group;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@sc-cityserve.org')
                    ->markdown('emails.project.signup.group');
    }
}
