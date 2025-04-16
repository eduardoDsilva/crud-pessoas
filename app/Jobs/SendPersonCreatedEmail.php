<?php

namespace App\Jobs;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPersonCreatedEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected Person $person;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Person $person
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->person->email)->send(new \App\Mail\PersonCreated($this->person));
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }

}
