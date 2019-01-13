<?php

namespace Botsnova\Chatbase\LinkTracking {

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\RequestException;
    use GuzzleHttp\Exception\GuzzleException;

    use Botsnova\Chatbase\Auth\ChatbaseAuthService;

    class LinkTrackingService
    {
        /**
         * @var null | ChatbaseAuthService
         */
        private $auth = null;

        /**
         * @return null|ChatbaseAuthService
         */
        public function getAuth(): ?ChatbaseAuthService
        {
            return $this->auth;
        }

        /**
         * @param null|ChatbaseAuthService $auth
         * @return LinkTrackingService
         */
        public function setAuth(?ChatbaseAuthService $auth): LinkTrackingService
        {
            $this->auth = $auth;
            return $this;
        }

        /**
         * @return string
         * @throws \Exception
         */
        function sendLinkTracking()
        {
            try {

                $query = http_build_query([
                    'api_key' => $this->getAuth()->getApiKey(),
                ]);

                $client = new Client([
                    'base_uri' => $this->getAuth()->getBaseUrl(),
                ]);

                $body = [
                    'api_key' => $this->getAuth()->getApiKey(),
                    'url' => 'https://www.slideshare.net/linecorp/line-link-chainlink',
                    'platform' => 'Messenger',
                    'user_id' => '267450867091514',
                    'version' => 'v1.0.0'
                ];

                $body = json_encode($body);

                $restApiResponse = $client->request(
                    'POST',
                    "click?{$query}",
                    [
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ],
                        'body' => $body
                    ]
                );

                $responseJSON = $restApiResponse->getBody()->getContents();

            } catch (RequestException $e) {

                throw new \Exception($e->getMessage(), $e->getCode(), $e);

            } catch (GuzzleException $e) {

                throw new \Exception($e->getMessage(), $e->getCode(), $e);

            } catch (\Exception $e) {

                throw new \Exception($e->getMessage(), $e->getCode(), $e);

            }

            return $responseJSON;
        }
    }
}