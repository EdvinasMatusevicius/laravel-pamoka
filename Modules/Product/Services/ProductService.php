<?php

declare(strict_types = 1);

namespace Modules\Product\Services;

use App\DTO\Abstracts\CollectionDTO;
use App\DTO\Abstracts\PaginateLengthAwareDTO;
use Illuminate\Database\Eloquent\Builder;
use Modules\Product\DTO\ProductDTO;
use Modules\Product\Entities\Product;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    /**
     * @param string $slug
     * @return ProductDTO
     */
    public function getBySlugForApi(string $slug): ProductDTO
    {
        $product = Product::query()
            ->where('active', '=', 1)
            ->where('slug', '=', $slug)
            ->firstOrFail();

        return new ProductDTO($product);
    }

    /**
     * @return CollectionDTO
     */
    public function getAllForApi(): CollectionDTO
    {
        $productsDTO = new CollectionDTO();

        $products = Product::query()
            ->with(['images', 'categories'])
            ->where('active', '=', 1)
            ->get();

        foreach ($products as $product) {
            $productsDTO->pushItem(new ProductDTO($product));
        }

        return $productsDTO;
    }

    /**
     * @return PaginateLengthAwareDTO
     */
    public function getPaginateForApi(): PaginateLengthAwareDTO
    {
        $productsDTO = new CollectionDTO();

        $products = Product::query()
            ->with(['images', 'categories'])
            ->where('active', '=', 1)
            ->paginate();

        foreach ($products as $product) {
            $productsDTO->pushItem(new ProductDTO($product));
        }

        return (new PaginateLengthAwareDTO($products))->setData($productsDTO);
    }

    /**
     * @param string $slug
     * @return PaginateLengthAwareDTO
     */
    public function getPaginateByCategorySlugForApi(string $slug): PaginateLengthAwareDTO
    {
        $productsDTO = new CollectionDTO();

        $products = Product::query()
            ->with(['images', 'categories'])
            ->where('active', '=', 1)
            ->whereHas('categories', function (Builder $query) use ($slug) {
                $query->where('slug', '=', $slug);
            })
            ->paginate();

        foreach ($products as $product) {
            $productsDTO->pushItem(new ProductDTO($product));
        }

        return (new PaginateLengthAwareDTO($products))->setData($productsDTO);
    }
}