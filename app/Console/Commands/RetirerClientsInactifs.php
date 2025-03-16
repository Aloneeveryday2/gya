<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Abonnement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RetirerClientsInactifs extends Command
{
    protected $signature = 'clients:retirer';
    protected $description = 'Retire les clients qui ne paient pas après 3 rappels';

    public function handle()
    {
        $clients = Abonnement::where('rappels_envoyes', '>=', 3)
                             ->where('is_active', true)
                             ->where('updated_at', '<=', Carbon::now()->subDays(7))
                             ->get();

        foreach ($clients as $client) {
            $client->delete();
            Log::info("Client retiré : " . $client->id);
        }

        $this->info("Clients inactifs retirés.");
    }
}

