<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Command;

use Exception;
use MessageBird\Client;
use Illuminate\Console\Command;
use MessageBird\Objects\Conversation\SendMessage;
use Inisiatif\Package\WhatsApp\Templates\DonationVerified;
use Inisiatif\Package\WhatsApp\Contracts\TemplateInterface;
use Inisiatif\Package\WhatsApp\Templates\SampleMediaTemplate;
use Inisiatif\Package\WhatsApp\Templates\DonationConfirmation;

final class SendingTestingCommand extends Command
{
    protected $signature = 'whatsapp:test
                            {to : Phone number destination}
                            {template : Template message for send to user, support "confirmation", "verified", "media"}';

    protected $description = 'Testing sending whatsapp';

    public function handle(Client $client): int
    {
        try {
            /** @var string $template */
            $template = $this->argument('template');

            $message = $this->makeTemplate()->message();

            if ($message instanceof SendMessage) {
                $conversation = $client->conversationSend->send($message);
            } else {
                $conversation = $client->conversations->start($message);
            }

            $this->info(sprintf(
                'Sending message with template `%s` . ' . json_encode($conversation, JSON_PRETTY_PRINT),
                $template
            ));

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error(sprintf('%s: %s', get_class($e), $e->getMessage()));

            return self::FAILURE;
        }
    }

    /**
     * @throws Exception
     */
    protected function makeTemplate(): TemplateInterface
    {
        /** @var string $template */
        $template = $this->argument('template');

        /** @var string $to */
        $to = $this->argument('to');

        switch (mb_strtolower($template)) {
            case 'confirmation':
                return new DonationConfirmation($to, 'Fulan', '1.000.000');
            case 'verified':
                return new DonationVerified($to, '1.000.000', 'Fulan');
            case 'media':
                return new SampleMediaTemplate($to, 'https://inisiatif-assets.imgix.net/whatsapp/update_payment_juni_2021.jpeg');
            default:
                throw new Exception('Template not supported . ' . $template);
        }
    }
}
