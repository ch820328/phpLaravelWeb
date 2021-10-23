<?php

namespace App\Providers;

use Gelf\Publisher;
use Gelf\Transport\UdpTransport;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\GelfHandler;
use Monolog\Handler\SwiftMailerHandler;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SwiftMailerHandler::class, function () {
            // Create the Transport
            $transport = new Swift_SmtpTransport();
            $transport->setHost(config('mail.host'));
            $transport->setPort(config('mail.port'));
            $transport->setPassword(config('mail.password'));
            $transport->setUsername(config('mail.username'));
            $transport->setEncryption(config('mail.encryption'));

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            // Create a message

            $title = config('app.name') . ' Error';

            $message = (new Swift_Message($title))
                ->setFrom([config('mail.from.address') => config('mail.from.name') . '-' . config('app.env')])
                ->setContentType('text/html')
                ->setTo(config('mail.team')[config('app.env')])
                ->setBody('Here is the message itself');

            return new SwiftMailerHandler($mailer, $message);
        });

        $this->app->singleton(GelfHandler::class, function () {
            $transport = new UdpTransport(
                config('logging.gary_log.host'),
                config('logging.gary_log.port'),
                UdpTransport::CHUNK_SIZE_LAN
            );

            $publisher = new Publisher($transport);
            return new GelfHandler($publisher);
        });
    }
}
