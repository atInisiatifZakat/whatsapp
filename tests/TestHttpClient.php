<?php

declare(strict_types=1);

namespace Inisiatif\Package\WhatsApp\Tests;

use MessageBird\Common;

final class TestHttpClient extends Common\HttpClient
{
    public function performHttpRequest($method, $resourceName, $query = null, $body = null): array
    {
        switch ($resourceName) {
            case 'conversations/start':
                return [[], [], $this->conversationsStart()];
            default:
                return [];
        }
    }

    protected function conversationsStart(): string
    {
        return <<<JSON
{
  "id": "2e15efafec384e1c82e9842075e87beb",
  "contactId": "a621095fa44947a28b441cfdf85cb802",
  "contact": {
  "id": "a621095fa44947a28b441cfdf85cb802",
  "href": "https://rest.messagebird.com/1/contacts/a621095fa44947a28b441cfdf85cb802",
  "msisdn": 316123456789,
  "firstName": "Jen",
  "lastName": "Smith",
  "customDetails": {
        "custom1": null,
        "custom2": null,
        "custom3": null,
        "custom4": null
      },
      "createdDatetime": "2018-06-03T20:06:03Z",
      "updatedDatetime": null
  },
  "channels": [
      {
        "id": "853eeb5348e541a595da93b48c61a1ae",
        "name": "SMS",
        "platformId": "sms",
        "status": "active",
        "createdDatetime": "2018-08-28T11:56:57Z",
        "updatedDatetime": "2018-08-29T08:16:33Z"
      },
      {
        "id": "619747f69cf940a98fb443140ce9aed2",
        "name": "My WhatsApp",
        "platformId": "whatsapp",
        "status": "active",
        "createdDatetime": "2018-08-28T11:56:57Z",
        "updatedDatetime": "2018-08-29T08:16:33Z"
      }
  ],
  "status": "active",
  "createdDatetime": "2018-08-13T09:17:22Z",
  "updatedDatetime": "2018-08-29T07:35:48Z",
  "lastReceivedDatetime": "2018-08-29T07:35:48Z",
  "lastUsedChannelId": "619747f69cf940a98fb443140ce9aed2",
  "lastUsedPlatformId": "whatsapp",
  "messages": {
  "totalCount": 24,
  "href": "https://conversations.messagebird.com/v1/conversations/2e15efafec384e1c82e9842075e87beb/messages",
  "lastMessageId": "9d5d5921f5b34f8db415a2397eb762f9"
  }
}
JSON;
    }
}
