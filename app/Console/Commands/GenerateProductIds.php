<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class GenerateProductIds extends Command
{
    protected $signature = 'products:generate-ids {--force : Force regenerate all product IDs}';
    protected $description = 'Generate unique product IDs using the new format';

    public function handle()
    {
        $force = $this->option('force');

        if ($force) {
            $products = Product::all();
            $this->info('Regenerating product IDs for all products...');
        } else {
            $products = Product::whereNull('product_id')->get();
            $this->info('Generating product IDs only for products without IDs...');
        }

        if ($products->isEmpty()) {
            $this->info('No products found to update.');
            return;
        }

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $count = 0;
        foreach ($products as $product) {
            try {
                $oldId = $product->product_id;
                $newId = $product->generateUniqueId();

                // Cek apakah ID berubah
                if ($force || !$oldId || $oldId !== $newId) {
                    $product->product_id = $newId;
                    $product->save();

                    if ($oldId) {
                        $this->line("\nUpdated: {$oldId} -> {$newId} for '{$product->title}'");
                    } else {
                        $this->line("\nGenerated: {$newId} for '{$product->title}'");
                    }

                    $count++;
                }
            } catch (\Exception $e) {
                $this->error("\nError generating ID for product {$product->id}: {$e->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine(2);
        $this->info("Successfully generated/updated IDs for {$count} products.");
    }
}
