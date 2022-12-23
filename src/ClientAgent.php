<?php

declare(strict_types=1);

namespace Cappuccino;

use foroco\BrowserDetection as Foroco;

class ClientAgent
{
    private readonly Foroco $browser;

    private readonly string $userAgent;

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
        $this->browser = new Foroco();
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

    public function getAll(): array
    {
        return $this->browser->getAll($this->userAgent);
    }

    public function getOperationalSystem(): string
    {
        $data = $this->getAll();

        return $data['os_name'];
    }

    public function getDevice(): string
    {
        $data = $this->getAll();

        return $data['device_type'];
    }

    public function getBrowser(): string
    {
        $data = $this->getAll();

        return $data['browser_name'].' '.$data['browser_version'];
    }

    public function getIpAddress(): IpAddress
    {
        return IpAddress::capture();
    }

    public function getHostname(): Hostname
    {
        return Hostname::capture();
    }

    public function info(): array
    {
        return [
            'browser' => $this->getBrowser(),
            'operationalSystem' => $this->getOperationalSystem(),
            'device' => $this->getDevice(),
            'ip' => $this->getIpAddress(),
            'hostname' => $this->getHostname(),
        ];
    }
}
