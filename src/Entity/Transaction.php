<?php

namespace OFXReader\Entity;

use DateTimeInterface;
use JsonSerializable;

class Transaction implements JsonSerializable
{
    private string $id;
    private string $tipo;
    private string $date;
    private string $value;
    private string $extraInformation;

    public function __construct() {}

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getExtraInformation(): string
    {
        return $this->extraInformation;
    }

    public function setExtraInformation(string $extraInformation): void
    {
        $this->extraInformation = $extraInformation;
    }

    public function jsonSerialize(): array
    {
        return array_map(
            function ($dado) {
                if ($dado instanceof DateTimeInterface) {
                    return $dado->format('Y-m-d');
                }

                return $dado;
            },
            get_object_vars($this)
        );
    }
}
