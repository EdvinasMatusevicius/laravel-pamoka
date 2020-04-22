<?php
declare(strict_types=1);
namespace App\DTO\Abstracts;

use App\User;

class CustomerDTO extends DTO
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    protected function jsonData(): array
    {
        return [
            'name' =>$this->user->name,
            'email' =>$this->user->email,
            'created' =>$this->user->created,
            'updated' =>$this->user->updated
        ];
    }
}