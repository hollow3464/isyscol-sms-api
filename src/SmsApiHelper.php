<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

final class SmsApiHelper
{
    private const BASE_URL = 'http://api.messaging-service.com';

    private readonly string $authString;
    private readonly TreeMapper $mapper;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly RequestFactoryInterface $requests,
        private readonly UriFactoryInterface $uri,
        private readonly StreamFactoryInterface $streams,
        string $username,
        string $password,
        ?TreeMapper $mapper = null,
    ) {
        $this->authString = "Basic " . base64_encode("$username:$password");

        if (is_null($mapper)) {
            $this->mapper = (new MapperBuilder())
                ->enableFlexibleCasting()
                ->allowSuperfluousKeys()
                ->supportDateFormats('Y-m-d H:i:s', 'Y-m-d H:i', 'Y-m-d')
                ->mapper();
        } else {
            $this->mapper = $mapper;
        }
    }

    /**
     * @throws MappingError
     */
    public function sendSms(SmsMessage $message): SendSmsResponse
    {
        $response =  $this->client->sendRequest(
            $this->requests->createRequest(
                'POST',
                $this->uri
                    ->createUri(self::BASE_URL)
                    ->withPath('/sms/1/text/single'),
            )
                ->withHeader('Content-type', 'application/json')
                ->withHeader('Accept', 'application/json')
                ->withHeader('Authorization', $this->authString)
                ->withBody($this->streams->createStream((string) json_encode($message))),
        );

        return $this->mapper->map(
            SendSmsResponse::class,
            Source::json((string) $response->getBody()),
        );
    }
}
