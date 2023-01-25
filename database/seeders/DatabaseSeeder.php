<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Purchase;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class
        ]);
        \App\Models\Customer::factory(1000)->create();
        // \App\Models\Purchase::factory(100)->create();

        $items = \App\Models\Item::all();
        Purchase::factory(500)->create()
        //useで関数の外にある$itemを使用できるようにしている
        ->each(function(Purchase $purchase) use ($items){
            $purchase->items()->attach(
                $items->random(rand(1,3))->pluck('id')->toArray(),['quantity' => rand(1,5)]
            );
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
