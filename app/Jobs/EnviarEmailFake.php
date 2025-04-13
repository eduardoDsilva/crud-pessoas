<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnviarEmailFake implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    public function handle()
    {
        Log::info("📧 Enviando e-mail para {$this->usuario}");
    }
}

