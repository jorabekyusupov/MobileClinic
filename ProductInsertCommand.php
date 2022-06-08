<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Product\Database\factories\ProductFactory;
use Modules\Product\Models\Product;
use Modules\StoresProduct\Database\factories\StoresProductFactory;
use Modules\StoresProduct\Models\StoresProduct;

class ProductInsertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return \string[][]
     */
    public function handle()
    {
        $products = [
            ["id" => 26419, "price" => 77.00],
            ["id" => 26418, "price" => 77.00],
            ["id" => 24410, "price" => 49.50],
            ["id" => 24331, "price" => 49.50],
            ["id" => 27157, "price" => 66.00],
            ["id" => 27158, "price" => 66.00],
            ["id" => 25179, "price" => 49.50],
            ["id" => 25181, "price" => 49.50],
            ["id" => 25180, "price" => 49.50],
            ["id" => 26536, "price" => 363.00],
            ["id" => 5113, "price" => 506.00],
            ["id" => 2672, "price" => 506.00],
            ["id" => 22604, "price" => 55.00],
            ["id" => 14931, "price" => 33.00],
            ["id" => 23506, "price" => 38.50],
            ["id" => 39463, "price" => 55.00],
            ["id" => 26350, "price" => 47.30],
            ["id" => 33212, "price" => 77.00],
            ["id" => 26341, "price" => 198.00],
            ["id" => 22622, "price" => 60.50],
            ["id" => 26323, "price" => 66.00],
            ["id" => 46843, "price" => 14.30],
            ["id" => 32961, "price" => 44.00],
            ["id" => 26470, "price" => 319.00],
            ["id" => 33138, "price" => 313.50],
            ["id" => 33178, "price" => 143.00],
            ["id" => 33022, "price" => 60.50],
            ["id" => 2000, "price" => 49.50],
            ["id" => 6025, "price" => 24.20],
            ["id" => 20253, "price" => 55.00],
            ["id" => 22621, "price" => 49.50],
            ["id" => 5152, "price" => 11.00],
            ["id" => 24771, "price" => 27.50],
            ["id" => 2666, "price" => 33.00],
            ["id" => 39217, "price" => 23.10],
            ["id" => 2646, "price" => 11.00],
            ["id" => 2647, "price" => 11.00],
            ["id" => 56798, "price" => 198.00],
            ["id" => 56794, "price" => 242.00],
            ["id" => 56804, "price" => 517.00],
            ["id" => 22617, "price" => 33.00],
            ["id" => 22623, "price" => 14.30],
            ["id" => 28644, "price" => 253.00],
            ["id" => 28643, "price" => 253.00],
            ["id" => 28645, "price" => 253.00],
            ["id" => 28656, "price" => 286.00],
            ["id" => 28657, "price" => 286.00],
            ["id" => 28608, "price" => 308.00],
            ["id" => 28609, "price" => 308.00],
            ["id" => 28618, "price" => 346.50],
            ["id" => 28619, "price" => 346.50],
            ["id" => 28957, "price" => 104.50],
            ["id" => 28955, "price" => 104.50],
            ["id" => 28953, "price" => 104.50]
        ];


        $bar = $this->output->createProgressBar(count($products));

        $bar->start();
        foreach ($products as $product) {
            try {
                $StoreProduct = StoresProduct::create([
                    "store_id" => 26344,
                    "product_id" => $product["id"],
                    "price_usd" => $product["price"],
                    "price" => $product["price"] * 11300,
                    "quantity" => 5,
                    "status" => 1,
                    "currency" => "usd"
                ]);
                $StoreProduct->save();
                $productUpdate = Product::find($product['id']);
                $productUpdate->update([
                    "price" => $product['price'] * 11300,
                    "price_usd" => $product['price'],
                    "quantity" => 5,
                    "currency" => "usd",
                    "status" => 1
                ]);
                $productUpdate->save();
                $bar->advance();
            } catch (\Exception $e) {
                $this->error('Product_ID:' . $product['id'] . ' Error:' . $e->getMessage());

            }
        }
        $bar->finish();
        $this->info('Product Inserted');
    }
}
