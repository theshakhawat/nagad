<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websites = [
            [
                'name' => 'My BD SMS',
                'domain' => 'mybdsms.com',
                'logo' => null,
                'api_key' => 'np_live_8f39a4b120c94e81ad849b2f114c5678',
                'status' => 'active',
                'webhook_secret' => 'whsec_99182a4729c14bc28a01f7823901bce4',
                'callback_url' => 'https://mybdsms.com/api/payment/nagad/callback',
            ],
            [
                'name' => 'My BD Phone',
                'domain' => 'mybdphone.com',
                'logo' => null,
                'api_key' => 'np_live_1b2c3d4e5f60718293a4b5c6d7e8f901',
                'status' => 'active',
                'webhook_secret' => 'whsec_a1b2c3d4e5f6789012345678abcdef01',
                'callback_url' => 'https://mybdphone.com/api/nagad/callback',
            ],
            [
                'name' => 'Dokan Digital',
                'domain' => 'dokandigital.com',
                'logo' => null,
                'api_key' => 'np_live_3c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f',
                'status' => 'active',
                'webhook_secret' => 'whsec_b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7',
                'callback_url' => 'https://dokandigital.com/payment/callback',
            ],
            [
                'name' => 'Prime Video Cards',
                'domain' => 'primevideo.cards',
                'logo' => null,
                'api_key' => 'np_live_5e6f7a8b9c0d1e2f3a4b5c6d7e8f9a0b',
                'status' => 'active',
                'webhook_secret' => 'whsec_c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8',
                'callback_url' => 'https://primevideo.cards/webhook/nagad',
            ],
            [
                'name' => 'AI Workspace Center',
                'domain' => 'aiworkspace.center',
                'logo' => null,
                'api_key' => 'np_live_7a8b9c0d1e2f3a4b5c6d7e8f9a0b1c2d',
                'status' => 'active',
                'webhook_secret' => 'whsec_d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9',
                'callback_url' => 'https://aiworkspace.center/api/v1/callback',
            ],
            [
                'name' => 'CSN BD',
                'domain' => 'csnbd.com',
                'logo' => null,
                'api_key' => 'np_live_9c0d1e2f3a4b5c6d7e8f9a0b1c2d3e4f',
                'status' => 'inactive',
                'webhook_secret' => 'whsec_e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0',
                'callback_url' => 'https://csnbd.com/api/nagad/webhook',
            ],
        ];

        foreach ($websites as $data) {
            Website::updateOrCreate(['domain' => $data['domain']], $data);
        }
    }
}
