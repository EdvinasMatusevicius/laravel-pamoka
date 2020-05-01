<?php
declare(strict_types=1);
namespace App\DTO\Abstracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginateLengthAwareDTO extends PaginateDTO
{
    protected $paginator;

    public function __construct(LengthAwarePaginator $paginator)
    {
        parent::__construct();

        $this->paginator = $paginator;
        $this->setDefaultData();
    }
    private function setDefaultData(): void
    {
        // dd($this->paginator->items());
        $lastPage = $this->paginator->lastPage();

        $this->setCurrentPage($this->paginator->currentPage())
        ->setData()
        ->setTotal($this->paginator->total())
        ->setPerPage($this->paginator->perPage())
        ->setFirstPageUrl($this->paginator->url(1))
        ->setLastPageUrl($this->paginator->url($lastPage))
        ->setNextPageUrl($this->paginator->nextPageUrl())
        ->setPrevPageUrl($this->paginator->previousPageUrl());
    }

}