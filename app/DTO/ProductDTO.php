<?php

declare(strict_types = 1);

namespace App\DTO;

use App\DTO\Abstracts\CollectionDTO;
use App\DTO\Abstracts\DTO;
use App\Product;
use Illuminate\Support\Facades\Storage;

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
            'price'=>$this->product->price,
            'images'=>$this->getImages(),
            'categories'=> $this->getCategories(),
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
}