<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class AdminTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializa o template padrao para novo projeto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $continue = $this->confirm("Deseja construir o template padrao?", true);
            if($continue) {
                $progress = $this->output->createProgressBar(4);
                $progress->setFormat("Progresso: %percent:3s%%");

                $this->output->title("Iniciando construcao do template");

                // LINK PARA STORAGE
                $progress->advance(2);
                $this->line(" - Criando link para storage...\n");
                Artisan::call("storage:link");
                mkdir(base_path()."\\storage\\app\\public\\uploads");
                mkdir(base_path()."\\storage\\app\\public\\uploads\\usuarios");

                // MIGRATIONS
                $progress->advance();
                $this->line(" - Criando estrutura do banco de dados...\n");
                Artisan::call("migrate", ['--seed' => true]);

                // KEY GENERATION
                $progress->advance();
                $this->line(" - Gerando chave da aplicacao...\n");
                Artisan::call("key:generate");

                $progress->finish();
                $this->line(" - Finalizado!\n");

                $this->info("\nTemplate gerado com sucesso");
            } else {
                $this->info("Construcao de template cancelada.");
            }
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
