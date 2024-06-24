<?php

namespace App\DTO;

readonly class ProductInfoDTO
{
    public function __construct(
        public ?string $link,
        public ?string $title,
        public ?string $ean,
        public ?string $price,
        public ?string $thumbnail
    ) {
    }
}
