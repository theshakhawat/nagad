<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Website extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'domain',
        'logo',
        'api_key',
        'status',
        'webhook_secret',
        'callback_url',
    ];

    /**
     * Generate a new unique API key.
     */
    public static function generateApiKey(): string
    {
        return 'np_live_'.Str::random(32);
    }

    /**
     * Generate a new unique webhook secret.
     */
    public static function generateWebhookSecret(): string
    {
        return 'whsec_'.Str::random(32);
    }
}
