<?php

namespace Hollow3464\SmsApiHelper;

use Hollow3464\SmsApiHelper\Sms\Logs\LogOptions;
use Hollow3464\SmsApiHelper\Sms\Logs\SmsLogsResponse;
use Hollow3464\SmsApiHelper\Sms\Reports\SmsReportResponse;
use Hollow3464\SmsApiHelper\Sms\SendSmsResponse;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

use Hollow3464\SmsApiHelper\Sms\Reports\ReportOptions;
use Hollow3464\SmsApiHelper\Sms\Messages\SmsMessage;
use Hollow3464\SmsApiHelper\Sms\Messages\AdvancedSmsMessage;

class SmsApiHelper
{
    private readonly string $auth_string;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly RequestFactoryInterface $requests,
        private readonly UriFactoryInterface $uri,
        private readonly StreamFactoryInterface $streams,
        private readonly string $base_url,
        string $username,
        string $password,
    ) {
        $this->auth_string = "Basic " . base64_encode("$username:$password");
    }


    public function sendSms(SmsMessage $message): SendSmsResponse
    {
        $response =  $this->client->sendRequest(
            $this->requests->createRequest(
                'POST',
                $this->uri
                    ->createUri($this->base_url)
                    ->withPath('/sms/1/text/single')
            )
            ->withHeader('Content-type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $this->auth_string)
            ->withBody($this->streams->createStream(json_encode($message)))
        );

        return SendSmsResponse::fromJson($response->getBody());
    }

    public function sendAdvancedSms(AdvancedSmsMessage $message): SendSmsResponse
    {
        $response = $this->client->sendRequest(
            $this->requests->createRequest(
                'POST',
                $this->uri
                    ->createUri($this->base_url)
                    ->withPath('/sms/1/text/advanced')
            )
            ->withHeader('Content-type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $this->auth_string)
            ->withBody($this->streams->createStream(json_encode($message)))
        );

        return SendSmsResponse::fromJson($response->getBody());
    }

    public function getDeliveryReports(ReportOptions $options): SmsReportResponse
    {
        $response = $this->client->sendRequest(
            $this->requests->createRequest(
                'GET',
                $this->uri
                    ->createUri($this->base_url)
                    ->withPath('/sms/1/reports')
                    ->withQuery($options)
            )
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $this->auth_string)
        );

        return SmsReportResponse::fromJson($response->getBody());
    }

    public function getMessageLogs(LogOptions $options): SmsLogsResponse
    {
        $response =  $this->client->sendRequest(
            $this->requests->createRequest(
                'GET',
                $this->uri
                    ->createUri($this->base_url)
                    ->withPath('/sms/1/logs')
                    ->withQuery($options)
            )
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $this->auth_string)
        );

        return SmsLogsResponse::fromJson($response->getBody());
    }
}
