<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Templates;

use Inisiatif\Package\WhatsApp\HSM\Image;
use Inisiatif\Package\WhatsApp\HSM\Media;
use Inisiatif\Package\WhatsApp\HSM\Component;
use MessageBird\Objects\Conversation\Message;

final class SampleMediaTemplate extends AbstractMediaTemplate
{
    private string $to;

    private string $imageUrl;

    public function __construct(string $to, string $imageUrl)
    {
        $this->to = $to;
        $this->imageUrl = $imageUrl;
    }

    public function components(): array
    {
        $media = new Media();
        $media->url = $this->imageUrl;

        $image = new Image();
        $image->image = $media;

        $header = new Component();
        $header->type = Component::TYPE_HEADER;
        $header->parameters = [$image];

        return [$header];
    }

    public function message(): Message
    {
        return $this->buildMessage();
    }

    public function number(): string
    {
        return $this->to;
    }

    protected function templateName(): string
    {
        return 'update_payment_juni_2021';
    }
}
