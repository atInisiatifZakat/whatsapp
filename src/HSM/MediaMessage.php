<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\HSM;

use MessageBird\Objects\Conversation\HSM\Message;

final class MediaMessage extends Message
{
    /**
     * @var Component[]
     */
    public array $components;
}
