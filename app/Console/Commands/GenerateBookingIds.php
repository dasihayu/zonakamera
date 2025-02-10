<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class GenerateBookingIds extends Command
{
    protected $signature = 'bookings:generate-ids {--force : Force regenerate all booking IDs}';
    protected $description = 'Generate unique booking IDs for bookings without an ID';

    public function handle()
    {
        $force = $this->option('force');

        if ($force) {
            $bookings = Booking::all();
            $this->info('Regenerating booking IDs for all bookings...');
        } else {
            $bookings = Booking::whereNull('booking_id')->get();
            $this->info('Generating booking IDs for bookings without IDs...');
        }

        if ($bookings->isEmpty()) {
            $this->info('No bookings found to update.');
            return;
        }

        $bar = $this->output->createProgressBar($bookings->count());
        $bar->start();

        $count = 0;
        foreach ($bookings as $booking) {
            try {
                $oldId = $booking->booking_id;
                $newId = $booking->generateUniqueId();

                if ($force || !$oldId || $oldId !== $newId) {
                    $booking->booking_id = $newId;
                    $booking->save();

                    if ($oldId) {
                        $this->line("\nUpdated: {$oldId} -> {$newId} for Booking #{$booking->id}");
                    } else {
                        $this->line("\nGenerated: {$newId} for Booking #{$booking->id}");
                    }

                    $count++;
                }
            } catch (\Exception $e) {
                $this->error("\nError generating ID for booking {$booking->id}: {$e->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine(2);
        $this->info("Successfully generated/updated IDs for {$count} bookings.");
    }
}
