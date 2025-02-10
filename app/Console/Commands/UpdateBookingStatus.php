<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    protected $signature = 'booking:update-status';
    protected $description = 'Update booking status to "not returned" if end_date has passed';

    public function handle()
    {
        $today = Carbon::today();

        $updated = Booking::whereDate('end_date', '<=', $today)
            ->whereNotIn('status', ['not returned', 'completed'])
            ->update(['status' => 'not returned']);

        $this->info("$updated bookings updated to 'not returned'.");
    }
}
