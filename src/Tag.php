<?php

namespace OFXReader;

class Tag
{
    public function __construct(
        public readonly string $text,
        //public readonly string $isLeaf
    ) {}
}
