<?php

declare(strict_types = 1);

namespace Modules\Product\DTO;

use App\DTO\Abstracts\DTO;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Entities\Supply;

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