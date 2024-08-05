<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member1 = User::firstWhere('username', 'member1');
        $member2 = User::firstWhere('username', 'member2');
        $member3 = User::firstWhere('username', 'member3');
        
        Bid::create([
            'auction_id' => 1,
            'user_id' => $member1->id,
            'value' => 50000,
        ]);

        Bid::create([
            'auction_id' => 1,
            'user_id' => $member2->id,
            'value' => 100000,
        ]);

        Bid::create([
            'auction_id' => 1,
            'user_id' => $member3->id,
            'value' => 200000,
        ]);

        Bid::create([
            'auction_id' => 1,
            'user_id' => $member2->id,
            'value' => 500000,
        ]);
    }
}
