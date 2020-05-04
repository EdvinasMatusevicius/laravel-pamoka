<?php

declare(strict_types = 1);

namespace Modules\Product\DTO;

use App\DTO\Abstracts\CollectionDTO;
use App\DTO\Abstracts\DTO;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Entities\Product;
use Modules\Product\Facades\PriceFormatter;

class ProductDTO extendS DTO
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    protected function jsonData(): array
    {
        return [
            'title'=> $this->product->title,
            'slug'=>$this->product->slug,
            'description'=>$this->product->description,
            'price'=>PriceFormatter::formaterWithCurrencyCode($this->product->price,'usd'),
            'images'=>$this->getImages(),
            'categories'=> $this->getCategories(),
            'suppliers'=> $this->getSuppliers()
        ];
    }
    private function getImages(): array
    {
        $images= [];

        foreach($this->product->images as $image){
            $images[] = Storage::url($image->file);
        }

        return $images;
    }
    private function getCategories(): CollectionDTO
    {
        $categoriesDTO = new CollectionDTO();

        foreach($this->product->categories as $category){
            $categoriesDTO->pushItem(new CategoryDTO($category));
        }

        return $categoriesDTO;
    }
    
    private function getSuppliers(): CollectionDTO
    {
        $suppliersDTO = new CollectionDTO();

        foreach ($this->product->suppliers as $supplier){
            $suppliersDTO->pushItem(new SupplierDTO($supplier));
        }

        return $suppliersDTO;
    }
    
    
}