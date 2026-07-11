<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Post::updateOrCreate(
            ['slug' => 'about-us'],
            [
                'title' => 'About Us',
                'content' => '<h2>Our Story</h2><p>Welcome to Svaadvika, your ultimate destination for authentic food.</p>',
                'type' => 'page',
                'status' => 'published',
            ]
        );

        \App\Models\Post::updateOrCreate(
            ['slug' => 'terms-of-service'],
            [
                'title' => 'Terms of Service',
                'content' => '<h2>Terms of Service</h2><p>Please read these terms carefully before using our website.</p>',
                'type' => 'page',
                'status' => 'published',
            ]
        );
        
        \App\Models\Post::updateOrCreate(
            ['slug' => 'how-to-make-perfect-biryani'],
            [
                'title' => 'How to make perfect Biryani',
                'content' => '<h2>The Secret to Perfect Biryani</h2><p>Start with high quality basmati rice...</p>',
                'type' => 'recipe',
                'status' => 'published',
            ]
        );
    }
}
