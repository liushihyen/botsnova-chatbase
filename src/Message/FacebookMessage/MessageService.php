<?php

namespace Botsnova\Chatbase\Message\FacebookMessage {

    /**
     * Class MessageService
     * @package Botsnova\Chatbase\Message\FacebookMessage
     */
    class MessageService
    {
        /**
         * @var string
         */
        private $sender_id = '';
        /**
         * @var string
         */
        private $recipient_id = '';
        /**
         * @var string
         */
        private $timestamp = '';
        /**
         * @var array
         */
        private $message = [];
        /**
         * @var string
         */
        private $intent = '';
        /**
         * @var string
         */
        private $version = '';
        /**
         * @var bool
         */
        private $not_handled = false;

        /**
         * @return string
         */
        public function getSenderId(): string
        {
            return $this->sender_id;
        }

        /**
         * @param string $sender_id
         * @return MessageService
         */
        public function setSenderId(string $sender_id): MessageService
        {
            $this->sender_id = $sender_id;
            return $this;
        }

        /**
         * @return string
         */
        public function getRecipientId(): string
        {
            return $this->recipient_id;
        }

        /**
         * @param string $recipient_id
         * @return MessageService
         */
        public function setRecipientId(string $recipient_id): MessageService
        {
            $this->recipient_id = $recipient_id;
            return $this;
        }

        /**
         * @return string
         */
        public function getTimestamp(): string
        {
            return $this->timestamp;
        }

        /**
         * @param string $timestamp
         * @return MessageService
         */
        public function setTimestamp(string $timestamp): MessageService
        {
            $this->timestamp = $timestamp;
            return $this;
        }

        /**
         * @return array
         */
        public function getMessage(): array
        {
            return $this->message;
        }

        /**
         * @param array $message
         * @return MessageService
         */
        public function setMessage(array $message): MessageService
        {
            $this->message = $message;
            return $this;
        }

        /**
         * @return string
         */
        public function getIntent(): string
        {
            return $this->intent;
        }

        /**
         * @param string $intent
         * @return MessageService
         */
        public function setIntent(string $intent): MessageService
        {
            $this->intent = $intent;
            return $this;
        }

        /**
         * @return string
         */
        public function getVersion(): string
        {
            return $this->version;
        }

        /**
         * @param string $version
         * @return MessageService
         */
        public function setVersion(string $version): MessageService
        {
            $this->version = $version;
            return $this;
        }

        /**
         * @return bool
         */
        public function isNotHandled(): bool
        {
            return $this->not_handled;
        }

        /**
         * @param bool $not_handled
         * @return MessageService
         */
        public function setNotHandled(bool $not_handled): MessageService
        {
            $this->not_handled = $not_handled;
            return $this;
        }
    }
}