<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['italy', 'sun', 'coding', 'friends', 'life', 'surprises', 'fitness', 'tomatoes', 'writing', 'happyness'];

        foreach ($tags as $tag) {
            Tag::create([
                'name'  => $tag,
            ]);
        }
    }
}