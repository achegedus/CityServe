<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectCreated extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Project
     */
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        //
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@sc-cityserve.org')
                    ->bcc(['kendra@calvarysc.org','Shelby@calvarysc.org','beckieromig@gmail.com','leamanguate@gmail.com'])
                    ->markdown('email.project.created');
    }
}
