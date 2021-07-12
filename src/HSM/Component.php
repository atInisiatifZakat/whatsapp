<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\HSM;

final class Component
{
    public const TYPE_HEADER = 'header';

    public const TYPE_BODY = 'body';

    public string $type;

    public array $parameters;
}
