<?php

namespace App\Message\Middleware;

use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\SentStamp;

class AutoAmqpRoutingMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (!$envelope->last(AmqpStamp::class) && !$envelope->last(SentStamp::class)) {
            $message = $envelope->getMessage();
            $messageClass = (new \ReflectionClass($message))->getShortName();

            $routingKey = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', str_replace('Message', '', $messageClass)));

            $envelope = $envelope->with(new AmqpStamp($routingKey));
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
