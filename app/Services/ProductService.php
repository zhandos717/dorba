<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Kaypu\KaypuBarCodeService;
use Illuminate\Validation\ValidationException;

class ProductService
{

    public function __construct(private KaypuBarCodeService $codeService)
    {
    }

    public function search(string $barcode): Product
    {
        $product = Product::firstWhere('barcode', $barcode);

        if ($product) {
            return $product;
        }

        $info = $this->codeService->getInfo($barcode);

        if (blank($info->title)) {
            throw   ValidationException::withMessages([
                'search' => 'Штрихкод не найден!'
            ]);
        }

        return Product::updateOrCreate(
            [
                'barcode' => $info->ean
            ], [
                'image' => $info->thumbnail,
                'name'  => $info->title
            ]
        );
    }
}