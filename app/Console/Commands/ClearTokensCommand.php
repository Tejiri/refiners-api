<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearTokensCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-tokens-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all Sanctum tokens from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('personal_access_tokens')->delete();

        $this->info('Tokens cleared successfully.');
        //
    }
}
