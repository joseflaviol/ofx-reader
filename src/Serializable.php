<?php

namespace OFXReader;

use DateTimeInterface;
use JsonSerializable;

abstract class Serializable implements JsonSerializable
{
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
