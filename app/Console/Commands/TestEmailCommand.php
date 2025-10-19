<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'test:email {email=teste@cacaloo.com}';

    /**
     * The console command description.
     */
    protected $description = 'Enviar email de teste para verificar MailHog';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email');

        try {
            Mail::raw('🧪 Teste do MailHog - Sistema de emails funcionando perfeitamente!', function ($message) use ($email) {
                $message->to($email)
                       ->subject('✅ Teste de Email - Casa de Caridade');
            });

            $this->info("✅ Email de teste enviado para: {$email}");
            $this->info("🌐 Acesse http://localhost:8025 para ver o email no MailHog");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error("❌ Erro ao enviar email: " . $e->getMessage());
            return self::FAILURE;
        }
    }
}
