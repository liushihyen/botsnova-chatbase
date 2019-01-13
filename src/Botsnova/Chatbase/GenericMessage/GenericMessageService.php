<?php

namespace Botsnova\Chatbase\GenericMessage {

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\RequestException;
    use GuzzleHttp\Exception\GuzzleException;

    use Botsnova\Chatbase\Auth\ChatbaseAuthService;

    use Botsnova\Chatbase\Message\GenericMessage\MessageService;

    use Botsnova\Chatbase\Message\GenericMessage\MessageCollection;

    class GenericMessageService
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
         * @return GenericMessageService
         */
        public function setAuth(?ChatbaseAuthService $auth): GenericMessageService
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
            if (empty($this->getAuth()->getApiKey()) || is_null($this->getAuth()->getApiKey())) {

                throw new \Exception('Missing required parameter: api_key');

            }

            try {

                $query = http_build_query([
                ]);

                $client = new Client([
                    'base_uri' => $this->getAuth()->getBaseUrl(),
                ]);

                $body = [
                    'api_key' => $this->getAuth()->getApiKey(),
                    'type' => $MessageService->getType(),
                    'user_id' => $MessageService->getUserId(),
                    'time_stamp' => $MessageService->getTimeStamp(),
                    'platform' => $MessageService->getPlatform(),
                ];

                if (!empty($MessageService->getMessage())
                    && !is_null($MessageService->getMessage())
                ) {
                    $body['message'] = $MessageService->getMessage();
                }

                if (!empty($MessageService->getIntent())
                    && !is_null($MessageService->getIntent())
                ) {
                    $body['intent'] = $MessageService->getIntent();
                }

                if (!empty($MessageService->isNotHandled())
                    && !is_null($MessageService->isNotHandled())
                    && gettype($MessageService->isNotHandled() === 'boolean'
                    )
                ) {
                    $body['not_handled'] = $MessageService->isNotHandled();
                }

                if (!empty($MessageService->getVersion())
                    && !is_null($MessageService->getVersion()
                    )
                ) {
                    $body['version'] = $MessageService->getVersion();
                }

                if (!empty($MessageService->getSessionId())
                    && !is_null($MessageService->getSessionId()
                    )
                ) {
                    $body['session_id'] = $MessageService->getSessionId();
                }

                $body = json_encode($body);

                $restApiResponse = $client->request(
                    'POST',
                    "message?{$query}",
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

            foreach ($MessageCollection->getIterator() as $MessageService) {

                $message = [
                    'api_key' => $this->getAuth()->getApiKey(),
                    'type' => $MessageService->getType(),
                    'user_id' => $MessageService->getUserId(),
                    'time_stamp' => $MessageService->getTimeStamp(),
                    'platform' => $MessageService->getPlatform(),
                ];

                if (!empty($MessageService->getMessage())
                    && !is_null($MessageService->getMessage())
                ) {
                    $message['message'] = $MessageService->getMessage();
                }

                if (!empty($MessageService->getIntent())
                    && !is_null($MessageService->getIntent())
                ) {
                    $message['intent'] = $MessageService->getIntent();
                }

                if (!empty($MessageService->isNotHandled())
                    && !is_null($MessageService->isNotHandled())
                    && gettype($MessageService->isNotHandled() === 'boolean'
                    )
                ) {
                    $message['not_handled'] = $MessageService->isNotHandled();
                }

                if (!empty($MessageService->getVersion())
                    && !is_null($MessageService->getVersion()
                    )
                ) {
                    $message['version'] = $MessageService->getVersion();
                }

                if (!empty($MessageService->getSessionId())
                    && !is_null($MessageService->getSessionId()
                    )
                ) {
                    $message['session_id'] = $MessageService->getSessionId();
                }

                array_push($messages, $message);
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
                    "messages?{$query}",
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