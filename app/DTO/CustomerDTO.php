<?php
declare(strict_types=1);
namespace App\DTO;

use App\DTO\Abstracts\DTO;
use App\User;

class CustomerDTO extends DTO
{
    private $customer;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }

    protected function jsonData(): array
    {
        return [
            'name'=> $this->customer->name,
            'email'=>$this->customer->email,
        ];
    }
}