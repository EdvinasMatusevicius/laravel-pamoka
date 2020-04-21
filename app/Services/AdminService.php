<?php
declare(strict_types=1);

namespace App\Services;

use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function create(string $email,string $password,bool $active=false,array $additionalData=[]): Admin {

        $data=[
            'email'=>$email,
            'password'=>Hash::make($password),
            'active'=>$active,
        ];
        if(!empty($additionalData)){
            $data=array_merge($data,$additionalData);
        }
        return Admin::query()->create($data);
    }
}