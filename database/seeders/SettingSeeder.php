<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'group' => 'website',
                'name' => 'name',
                'payload_type' => 'text',
                'payload' => 'My Awesome Site'
            ],
            [
                'group' => 'website',
                'name' => 'email',
                'payload_type' => 'text',
                'payload' => 'admin@example.com'
            ],
            [
                'group' => 'website',
                'name' => 'phone',
                'payload_type' => 'text',
                'payload' => '+1234567890'
            ],
            [
                'group' => 'website',
                'name' => 'location',
                'payload_type' => 'text',
                'payload' => '123 Main St, New York, NY 10001'
            ],
            [
                'group' => 'social',
                'name' => 'facebook',
                'payload_type' => 'text',
                'payload' => 'https://facebook.com/myawesomesite'
            ],
            [
                'group' => 'social',
                'name' => 'twitter',
                'payload_type' => 'string',
                'payload' => 'https://twitter.com/myawesomesite'
            ],
            [
                'group' => 'social',
                'name' => 'instagram',
                'payload_type' => 'string',
                'payload' => 'https://instagram.com/myawesome.site'
            ],
            [
                'group' => 'social',
                'name' => 'linkedin',
                'payload_type' => 'string',
                'payload' => 'https://linkedin.com/company/myawesomesite'
            ],
            [
                'group' => 'social',
                'name' => 'youtube',
                'payload_type' => 'string',
                'payload' => 'https://youtube.com/channel/myawesomesite'
            ],
            [
                'group' => 'social',
                'name' => 'whatsapp',
                'payload_type' => 'string',
                'payload' => '0123456789'
            ],
            [
                'group' => 'social',
                'name' => 'twitch',
                'payload_type' => 'string',
                'payload' => 'https://twitch.tv/my/channel'
            ],
            [
                'group' => 'social',
                'name' => 'google-plus',
                'payload_type' => 'string',
                'payload' => 'https://google-plus.com/myawes/omesite'
            ],


        ];

        foreach ($settings as $setting) {
            // firstOrCreate will create a new record if it doesn't exist
            Setting::firstOrCreate($setting);
            
        }
    }
}
