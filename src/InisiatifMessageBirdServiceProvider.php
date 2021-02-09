<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp;

use MessageBird\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Inisiatif\Package\WhatsApp\Command\SendingTestingCommand;

final class InisiatifMessageBirdServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Client::class, static function (Application $application) {
            /** @var Repository $config */
            $config = $application->make(Repository::class);

            /** @var string $accessKey */
            $accessKey = $config->get('services.messagebird.accessKey');

            return new Client($accessKey);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                SendingTestingCommand::class,
            ]);
        }
    }
}
