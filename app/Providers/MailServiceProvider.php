<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $host = setting('smtp.MAIL_HOST', env('MAIL_HOST', 'smtp.mailgun.org'));
        $port = setting('smtp.MAIL_PORT', env('MAIL_PORT', 587));
        $enc = setting('smtp.MAIL_ENCRYPTION', env('MAIL_ENCRYPTION', 'tls'));
        $uname = setting('smtp.MAIL_USERNAME', env('MAIL_USERNAME'));
        $pwd = setting('smtp.MAIL_PASSWORD', env('MAIL_PASSWORD'));
        $adrs = setting('smtp.MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS', 'hello@example.com'));
        $name = setting('smtp.MAIL_FROM_NAME', env('MAIL_FROM_NAME', 'Example'));

        Config::set('mail.mailers.smtp.host', $host);
        Config::set('mail.mailers.smtp.port', $port);
        Config::set('mail.mailers.smtp.encryption', $enc);
        Config::set('mail.mailers.smtp.username', $uname);
        Config::set('mail.mailers.smtp.password', $pwd);
        Config::set('mail.from.address', $adrs);
        Config::set('mail.from.name', $name);

        Log::info('Mail Service Provider Berjalan!');
    }
}
