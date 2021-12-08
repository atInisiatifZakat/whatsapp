<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\HSM;

final class Document
{
    public string $type = 'document';

    public Media $document;
}
