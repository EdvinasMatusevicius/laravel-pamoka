<?php
declare(strict_types=1);
namespace App\DTO\Abstracts;

class CollectionDTO extends DTO
{
    private $collection;

    public function __construct(array $data = [])
    {
        $this->collection = collect($data);
    }

    public function pushItem(DTO $item): CollectionDTO
    {
        $this->collection->push($item);
        return $this;
    }

    public function putItem(string $key,DTO $item): CollectionDTO
    {
        $this->collection->put($key,$item);
        return $this;
    }

    protected function jsonData(): array
    {
        return $this->collection->toArray();
    }
}