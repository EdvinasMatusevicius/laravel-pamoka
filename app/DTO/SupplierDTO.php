<?php

declare(strict_types = 1);

namespace App\DTO;

use App\DTO\Abstracts\DTO;
use App\Supply;
use Illuminate\Support\Facades\Storage;

/**
 * Class SupplierDTO
 * @package App\DTO
 */
class SupplierDTO extends DTO
{
    /**
     * @var Supply
     */
    private $supply;


    /**
     * SupplierDTO constructor.
     * @param Supply $supply
     */
    public function __construct(Supply $supply)
    {
        $this->supply = $supply;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'title' => $this->supply->title,
            'logo' => $this->supply->logo ? Storage::url($this->supply->logo) : null,
        ];
    }
} 