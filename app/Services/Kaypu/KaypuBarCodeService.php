<?php

namespace App\Services\Kaypu;

use App\DTO\ProductInfoDTO;
use App\Models\Product;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class KaypuBarCodeService
{

    public function getInfo(string $barcode): ProductInfoDTO
    {
        $response = Http::send(Request::METHOD_POST, 'https://kaypu.com/data/loadlist.php', [
            'headers' => [
                'Cookie'       => 'sess=342no5lmpjbm0jv8vof56hr9el337dsm; sess=486rok43ibjqm383oubv614a9g3enuit',
                'Content-Type' => 'text/plain'
            ],
            'body'    => "t=searchlist&offset=0&lang=RU&q=$barcode"
        ]);

        if ($response->failed()) {
            throw new BadRequestHttpException('Сервис штрихкодов не отвечает');
        }

        return $this->parseProductInfo($response->json('searchlist.0'));
    }

    private function parseProductInfo(string $html): ProductInfoDTO
    {
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        // Создание объекта DOMDocument
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Игнорирование ошибок парсинга HTML
        $dom->loadHTML($html);
        libxml_clear_errors();

        // XPath для извлечения информации
        $xpath = new DOMXPath($dom);

        // Извлечение ссылки
        $linkNode = $xpath->query('//a')->item(0);
        $link = $linkNode?->getAttribute('href');

        // Извлечение заголовка
        $title = $linkNode?->getAttribute('title');

        // Извлечение текста внутри span с классом good-info
        $goodInfoNode = $xpath->query('//span[@class="good-info"]')->item(0);
        $goodInfo = $goodInfoNode ? trim($goodInfoNode->textContent) : '';

        // Извлечение EAN
        $ean = null;
        if (preg_match('/EAN (\d+)/', $goodInfo, $matches)) {
            $ean = $matches[1];
        }

        // Извлечение цены
        $price = null;
        if (preg_match('/\d+\.\d+ KZT/', $goodInfo, $matches)) {
            $price = $matches[0];
        }

        // Извлечение миниатюры
        $thumbnailNode = $xpath->query('//img[@class="good-thumbnail"]')->item(0);
        $thumbnail = $thumbnailNode?->getAttribute('src');

        // Подготовка массива с результатами
        return new ProductInfoDTO(
            link: $link,
            title: $title,
            ean: $ean,
            price: $price,
            thumbnail: "https://kaypu.com/$thumbnail"
        );
    }

}