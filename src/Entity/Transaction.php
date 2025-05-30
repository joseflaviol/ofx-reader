<?php

namespace OFXReader\Entity;

use DateTimeInterface;
use OFXReader\Serializable;

class Transaction extends Serializable
{
    protected  string $id;
    protected  string $tipo;
    protected  DateTimeInterface $date;
    protected  string $value;
    protected  string $extraInformation;
    protected ?string $name = null;

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

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): void
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
