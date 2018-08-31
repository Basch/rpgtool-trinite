<?php

namespace App\Object;


class RedirectResponse
{
    private $route;
    private $arguments;
    private $flash;

    public function __construct( string $route = 'login', array $arguments = [], FlashResponse $flash = null )
    {
        $this->route = $route;
        $this->arguments = $arguments;
        $this->flash = $flash;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute( string $route ): self
    {
        $this->route = $route;
        return $this;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function setArguments( array $arguments ): self
    {
        $this->arguments = $arguments;
        return $this;
    }

    public function getFlash(): ?FlashResponse
    {
        return $this->flash;
    }

    public function setFlash( FlashResponse $flash ): self
    {
        $this->flash = $flash;
        return $this;
    }



}