<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registre as políticas de autenticação e quaisquer outras dependências.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();  // Este método deve estar aqui

        Passport::routes();  // Registra as rotas do Passport
    }

    /**
     * Registrar as políticas de autenticação para a aplicação.
     *
     * @return void
     */
    protected function registerPolicies()
    {
        // Se você tiver políticas, pode registrar aqui
    }
}
