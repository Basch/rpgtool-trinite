<?php

namespace App\Object;


class FlashResponse
{
    private $type;
    private $message;

    public function __construct( string $type = 'message', string $message = '' )
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType( string $type ): self
    {
        $this->type = $type;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage( string $message ): self
    {
        $this->message = $message;
        return $this;
    }


}