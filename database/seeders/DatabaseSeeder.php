<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Rillo',
            'email'=> 'rillo@gmail.com',
            'password' => bcrypt('gajahterbang'),
            'role' => 'admin',
            'bio' => 'Aing Admin'
        ]);

        $students = User::factory(10)->create();

        $categories = collect([
            ['name'=>"Info Malam",'description'=>"ngopi"],
            ['name'=>"Info Matkul",'description'=>"kuliah dulu"],
            ['name'=>"BBB sehat",'description'=>"olahraga"],
        ])->map(function ($cat){
            return Category::create([
                'name' => $cat['name'],
                'description' => $cat['description'],
                'slug' => Str::slug($cat['name']),
            ]);
        });

        Announcement::create([
            'user_id' => $admin->id,
            'title' => 'Info Kelas',
            'content' => 'Besok Strukdat Online',
            'pinned' => true,
        ]);
        Announcement::factory(2)->create([
            'user_id' => $admin->id,
        ]);

        Discussion::factory(15)->recycle($students)->recycle($categories)->create()->each(function ($discussion) use ($students, $admin) {
            $replyCount = rand(1, 5);

            Reply::factory($replyCount)
                ->recycle($students->push($admin))
                ->create([
                    'discussion_id' => $discussion->id
                ]);
        });


    }
}
