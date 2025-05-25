<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
class DebloquerUtilisateurs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:debloquer-utilisateurs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('blocquee', "blocquee")
        ->where('updated_at', '<=', Carbon::now()->subDays(2))
        ->get();

    foreach ($users as $user) {
        $user->blocquee = "non blocquee";
        $user->save();

    }
}
}
