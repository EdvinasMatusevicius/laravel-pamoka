<?php
declare(strict_types=1);
namespace App\DTO\Abstracts;

use JsonSerializable;

abstract class DTO implements JsonSerializable
{

    abstract protected function jsonData():array;

    public function jsonSerialize():array
    {
        return $this->jsonData();
    }
}