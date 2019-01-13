<?php

namespace Botsnova\Chatbase\Message\FacebookMessage {

    use Botsnova\Chatbase\Message\FacebookMessage\MessageService;

    /**
     * Class MessageCollection
     * @package Botsnova\Chatbase\Message\FacebookMessage
     */
    class MessageCollection implements \IteratorAggregate
    {
        /**
         * @var array
         */
        public $collection = [];

        /**
         * MessageCollection constructor.
         * @param array $collection
         */
        public function __construct(array $collection = [])
        {
            $this->collection = $collection;
        }

        /**
         * @param MessageService $MessageService
         * @return $this
         */
        public function addMessage(
            MessageService $MessageService
        )
        {
            array_push($this->collection, $MessageService);

            return $this;
        }

        /**
         * @return MessageService[] | \ArrayIterator
         */
        public function getIterator()
        {
            return new \ArrayIterator($this->collection);
        }
    }
}