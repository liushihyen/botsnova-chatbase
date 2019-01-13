<?php

namespace Botsnova\Chatbase\Auth {

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\RequestException;
    use GuzzleHttp\Exception\GuzzleException;

    /**
     * Class ChatbaseAuthService
     * @package Botsnova\Chatbase\Auth
     */
    class ChatbaseAuthService
    {
        /**
         * @var string
         */
        private $api_key = '';
        /**
         * @var string
         */
        private $base_url = 'https://chatbase.com/api/';

        /**
         * @return string
         */
        public function getApiKey(): string
        {
            return $this->api_key;
        }

        /**
         * @param string $api_key
         * @return ChatbaseAuthService
         */
        public function setApiKey(string $api_key): ChatbaseAuthService
        {
            $this->api_key = $api_key;
            return $this;
        }

        /**
         * @return string
         */
        public function getBaseUrl(): string
        {
            return $this->base_url;
        }

        /**
         * @param string $base_url
         * @return ChatbaseAuthService
         */
        public function setBaseUrl(string $base_url): ChatbaseAuthService
        {
            $this->base_url = $base_url;
            return $this;
        }
    }
}