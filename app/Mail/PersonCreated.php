<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PersonCreated extends Mailable
{
    use SerializesModels;

    public $person;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Person $person
     * @return void
     */
    public function __construct($person)
    {
        $this->person = $person;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->view('emails.person_created')
            ->subject('Pessoa Criada com Sucesso!')
            ->with([
                'name' => $this->person->full_name,
            ]);
    }
}
