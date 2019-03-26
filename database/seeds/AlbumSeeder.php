<?php

use App\Albums;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run()
    {
        factory(Albums::class, 10)->create();
    }
}
