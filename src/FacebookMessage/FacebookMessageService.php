<?php

namespace Botsnova\Chatbase\FacebookMessage {

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\RequestException;
    use GuzzleHttp\Exception\GuzzleException;

    use Botsnova\Chatbase\Auth\ChatbaseAuthService;

    use Botsnova\Chatbase\Message\FacebookMessage\MessageService;

    use Botsnova\Chatbase\Message\FacebookMessage\MessageCollection;

    class FacebookMessageService
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
         * @return FacebookMessageService
         */
        public function setAuth(?ChatbaseAuthService $auth): FacebookMessageService
        {
            $this->auth = $auth;
            return $this;
        }

        /**
         * @param MessageService $MessageService
         * @return string
         * @throws \Exception
         */
        function sendMessage(
            MessageService $MessageService
        )
        {
            try {

                $query = http_build_query([
                    'api_key' => $this->getAuth()->getApiKey(),
                ]);

                $client = new Client([
                    'base_uri' => $this->getAuth()->getBaseUrl(),
                ]);

                $body = [
                    'sender' => [
                        'id' => $MessageService->getSenderId()
                    ],
                    'recipient' => [
                        'id' => $MessageService->getRecipientId()
                    ],
                    'timestamp' => $MessageService->getTimestamp(),
                    'message' => $MessageService->getMessage(),
                    'chatbase_fields' => [
                        'intent' => $MessageService->getIntent(),
                        'version' => $MessageService->getVersion(),
                        'not_handled' => $MessageService->isNotHandled(),
                    ]
                ];

                $body = json_encode($body);

                $restApiResponse = $client->request(
                    'POST',
                    "facebook/message_received?{$query}",
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

        /**
         * @param MessageCollection $MessageCollection
         * @return string
         * @throws \Exception
         */
        function sendMultipleMessages(
            MessageCollection $MessageCollection
        )
        {
            $messages = [];

            if ($MessageCollection->getIterator()->count() > 100) {

                throw new \Exception('You can send up to 100 messages only in a single call to this API.');

            }

            foreach ($MessageCollection->getIterator() as $message) {

                $messages[] = [
                    'sender' => [
                        'id' => $message->getSenderId()
                    ],
                    'recipient' => [
                        'id' => $message->getRecipientId()
                    ],
                    'timestamp' => $message->getTimestamp(),
                    'message' => $message->getMessage(),
                    'chatbase_fields' => [
                        'intent' => $message->getIntent(),
                        'version' => $message->getVersion(),
                        'not_handled' => $message->isNotHandled(),
                    ]
                ];
            }

            try {

                $query = http_build_query([
                    'api_key' => $this->getAuth()->getApiKey(),
                ]);

                $client = new Client([
                    'base_uri' => $this->getAuth()->getBaseUrl(),
                ]);

                $body = [
                    'messages' => $messages
                ];

                $body = json_encode($body);

                $restApiResponse = $client->request(
                    'POST',
                    "facebook/message_received_batch?{$query}",
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