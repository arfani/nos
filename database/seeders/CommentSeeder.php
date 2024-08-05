<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $member1 = User::firstWhere('username', 'member1');
        $member2 = User::firstWhere('username', 'member2');
        $member3 = User::firstWhere('username', 'member3');
        
        Comment::create([
            'auction_id' => 1,
            'user_id' => $member1->id,
            'comment' => 'Gua mulai',
        ]);

        Comment::create([
            'auction_id' => 1,
            'user_id' => $member3->id,
            'comment' => 'Gua harus dapet ini',
        ]);

        Comment::create([
            'auction_id' => 1,
            'user_id' => $member2->id,
            'comment' => 'Gua yang menang',
        ]);
    }
}
