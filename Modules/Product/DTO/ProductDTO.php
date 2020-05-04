<?php

declare(strict_types = 1);

namespace Modules\Product\DTO;

use App\DTO\Abstracts\CollectionDTO;
use App\DTO\Abstracts\DTO;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Entities\Product;
use Modules\Product\Facades\PriceFormatter;

/**
 * Class ProductDTO
 * @package App\DTO
 */
class ProductDTO extends DTO
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductDTO constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'title' => $this->product->title,
            'slug' => $this->product->slug,
            'description' => $this->product->description,
            'price' => PriceFormatter::formatWithCurrencyCode($this->product->price),
            'price_other' => PriceFormatter::formatPrice($this->product->price, 6),
            'images' => $this->getImages(),
            'categories' => $this->getCategories(),
            'suppliers' => $this->getSuppliers(),
        ];
    }

    /**
     * @return array
     */
    private function getImages(): array
    {
        $images = [];

        foreach ($this->product->images as $image) {
            $images[] = Storage::url($image->file);
        }

        return $images;
    }

    /**
     * @return CollectionDTO
     */
    private function getCategories(): CollectionDTO
    {
        $categoriesDTO = new CollectionDTO();

        foreach ($this->product->categories as $category) {
            $categoriesDTO->pushItem(new CategoryDTO($category));
        }

        return $categoriesDTO;
    }

    /**
     * @return CollectionDTO
     */
    private function getSuppliers(): CollectionDTO
    {
        $suppliersDTO = new CollectionDTO();

        foreach ($this->product->suppliers as $supplier) {
            $suppliersDTO->pushItem(new SupplierDTO($supplier));
        }

        return $suppliersDTO;
    }
}