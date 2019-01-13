<?php

namespace Botsnova\Chatbase\Message\GenericMessage {

    /**
     * Class MessageService
     * @package Botsnova\Chatbase\Message\GenericMessage
     */
    class MessageService
    {
        /**
         * @var string
         * string, <required> valid values "user" or "agent" (aka your bot) message
         */
        private $type = '';
        /**
         * @var string
         * string, <required> the ID of the end-user
         */
        private $user_id = '';
        /**
         * @var int
         * int, <required> milliseconds since the UNIX epoch, used to sequence messages.
         * (must be within previous 30 days)
         */
        private $time_stamp = 0;
        /**
         * @var string
         * string, <required> valid values "Facebook", "SMS", "Web", "Android", "iOS",
         * "Actions", "Alexa", "Cortana", "Kik", "Skype", "Twitter", "Viber", "Telegram",
         * "Slack", "WhatsApp", "WeChat", "Line", "Kakao" or a custom name like "Workplace"
         * or "OurPlatform"
         */
        private $platform = '';
        /**
         * @var string
         * string, <optional> the raw message body regardless of type for example a
         * typed-in or a tapped button or tapped image; 1,200 characters max
         */
        private $message = '';
        /**
         * @var string
         * string, <optional> set for user messages only; if not set usage metrics will
         * not be shown per intent; do not set if it is a generic catch all intent, like
         * default fallback, so that clusters of similar messages can be reported
         */
        private $intent = '';
        /**
         * @var bool
         * bool, <optional> set for user messages only; indicates that the bot was not
         * able to handle the message because it was not understood
         * (e.g. no intent for "Start over"), or it was understood (e.g. has intent for "Order drink")
         * but not supported; if not set then these high churn issues are not shown across reports;
         * set for generic catch all intents, like default fallback
         */
        private $not_handled = false;
        /**
         * @var string
         * string, <optional> set for user and bot messages; used to track versions of
         * your code or to track A/B tests
         */
        private $version = '';
        /**
         * @var string
         * string, <optional> set for user and bot messages; used to define your own custom
         * sessions for Session Flow report and daily session metrics
         */
        private $session_id = '';

        /**
         * @return string
         */
        public function getType(): string
        {
            return $this->type;
        }

        /**
         * @param string $type
         * @return MessageService
         */
        public function setType(string $type): MessageService
        {
            $this->type = $type;
            return $this;
        }

        /**
         * @return string
         */
        public function getUserId(): string
        {
            return $this->user_id;
        }

        /**
         * @param string $user_id
         * @return MessageService
         */
        public function setUserId(string $user_id): MessageService
        {
            $this->user_id = $user_id;
            return $this;
        }

        /**
         * @return int
         */
        public function getTimeStamp(): int
        {
            return $this->time_stamp;
        }

        /**
         * @param int $time_stamp
         * @return MessageService
         */
        public function setTimeStamp(int $time_stamp): MessageService
        {
            $this->time_stamp = $time_stamp;
            return $this;
        }

        /**
         * @return string
         */
        public function getPlatform(): string
        {
            return $this->platform;
        }

        /**
         * @param string $platform
         * @return MessageService
         */
        public function setPlatform(string $platform): MessageService
        {
            $this->platform = $platform;
            return $this;
        }

        /**
         * @return string
         */
        public function getMessage(): string
        {
            return $this->message;
        }

        /**
         * @param string $message
         * @return MessageService
         */
        public function setMessage(string $message): MessageService
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
         * @return string
         */
        public function getSessionId(): string
        {
            return $this->session_id;
        }

        /**
         * @param string $session_id
         * @return MessageService
         */
        public function setSessionId(string $session_id): MessageService
        {
            $this->session_id = $session_id;
            return $this;
        }
    }
}