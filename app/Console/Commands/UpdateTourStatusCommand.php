<?php

namespace App\Console\Commands;

use App\Enums\TourStatus;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Console\Command;

// TODO: لكي يعمل بشكل مستمر، أضف هذا إلى الـ cron job في السيرفر:
// * * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

class UpdateTourStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tours:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tour status to in_progress when start date is reached';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $updated = Tour::where(function ($query) {
            $query->where('status', TourStatus::Available->value)
                ->orWhere('status', TourStatus::Full->value);
        })
            ->where('start_date', '<=', Carbon::now())
            ->update(['status' => TourStatus::InProgress->value]);

        $this->info("Updated {$updated} tours to in_progress.");
    }
}
