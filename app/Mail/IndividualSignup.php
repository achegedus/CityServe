<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\Server;
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
    public $server;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, Server $server)
    {
        //
        $this->project = $project;
        $this->server = $server;
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
