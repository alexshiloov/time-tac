<?php
declare(strict_types=1);

namespace App\Service;


use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TimeTacClient
{
    /** @var HttpClientInterface  */
    private $httpClient;

    /** @var string */
    private $accessToken;

    /** @var string */
    private $accountName;

    /** @var string */
    private $timeTacApiHost;

    public function __construct(HttpClientInterface $httpClient, string $accessToken, string $accountName, string $timeTacApiHost)
    {
        $this->httpClient = $httpClient;
        $this->accessToken = $accessToken;
        $this->accountName = $accountName;
        $this->timeTacApiHost = $timeTacApiHost;
    }

    public function getUsers(): array
    {
        $params = [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
            ],
        ];

        $response = $this->httpClient->request(
            'GET',
            sprintf('%s/%s/userapi/V3/users/read', $this->timeTacApiHost, $this->accountName),
            $params
        );

        $result = json_decode($response->getContent(), true);
        if (json_last_error()) {
            throw new Exception(json_last_error_msg());
        }

        if (!isset($result['Success']) || !isset($result['Results'])) {
            throw new Exception('Request was not executed correctly');
        }

        return $result;
    }
}