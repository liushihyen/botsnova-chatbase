<?php

namespace Botsnova\Chatbase\Message\GenericMessage {

    use Botsnova\Chatbase\Message\GenericMessage\MessageService;

    /**
     * Class MessageCollection
     * @package Botsnova\Chatbase\Message\GenericMessage
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