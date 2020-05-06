<?php

declare(strict_types = 1);

namespace Modules\Product\Services;

use App\DTO\Abstracts\CollectionDTO;
use App\DTO\Abstracts\PaginateLengthAwareDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Modules\Product\DTO\ProductDTO;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Repositories\ProductRepository;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    private $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getPaginateWithRelationsAdmin(): LengthAwarePaginator
    {
        return $this->productRepository->paginateWithRelations(['images', 'categories']);
    }

    public function createWithRelationsAdmin(
        array $data,
        array $catIds = [],
        array $supplierIds = [],
        array $images = []
        ): Product
    {
        $product = $this->productRepository->create($data);
        $product->categories()->sync($catIds);
        $product->suppliers()->sync($supplierIds);

        ImagesManager::saveMany($product,$images, ProductImage::class,
            'file', ImagesManager::PATH_PRODUCT);

        return $product;
    }

    public function updateWIthRelationsAdmin(
        array $data,
        int $id,
        bool $deleteImages = false
    ): Product
    {
        $this->productRepository->update($data,$id);
        $product = $this->getById($id);
        
        $product->categories()->sync(Arr::get($data,'categories',[]));
        $product->suppliers()->sync(Arr::get($data,'suppliers',[]));

        $images = Arr::get($data,'images',[]);
        ImagesManager::saveMany($product, $images, ProductImage::class,
        'file', ImagesManager::PATH_PRODUCT, $deleteImages);

        return $product;
    }

    public function getById(int $id): Product
    {
        return $this->productRepository->findOrFail($id);
    }

    public function delete(int $id): void
    {
        $product = $this->getById($id);

        ImagesManager::deleteAll($product);

        $this->productRepository->delete($product->id);
    }

    /**
     * @param string $slug
     * @return ProductDTO
     */
    public function getBySlugForApi(string $slug): ProductDTO
    {
        $product = $this->productRepository->getBySlug($slug);

        return new ProductDTO($product);
    }

 

    /**
     * @return PaginateLengthAwareDTO
     */
    public function getPaginateForApi(): PaginateLengthAwareDTO
    {
        $productsDTO = new CollectionDTO();

        $products = $this->productRepository->paginateWithRelations(['images', 'categories'],true);
       
        foreach ($products as $product) {
            $productsDTO->pushItem(new ProductDTO($product));
        }

        return (new PaginateLengthAwareDTO($products))->setData($productsDTO);
    }

    /**
     * @param string $categorySlug
     * @return PaginateLengthAwareDTO
     */
    public function getPaginateByCategorySlugForApi(string $categorySlug): PaginateLengthAwareDTO
    {
        $productsDTO = new CollectionDTO();

        $products = $this->productRepository->getByCategorySlug($categorySlug);
            

        foreach ($products as $product) {
            $productsDTO->pushItem(new ProductDTO($product));
        }

        return (new PaginateLengthAwareDTO($products))->setData($productsDTO);
    }
}