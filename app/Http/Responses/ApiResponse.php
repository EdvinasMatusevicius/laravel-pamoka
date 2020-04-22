<?php

declare(strict_types = 1);

namespace App\Http\Responses;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ApiResponse
{

    private $status = null;

    public function unauthorized(string $string){
        $response = $this->setStatus(JsonResponse::HTTP_UNAUTHORIZED)->base();
        $response['message']= $message ?? 'Unautherised';

        return response()->json($response,JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function success($data=null): JsonResponse
    {
        $response=$this->base();
       if($data !== null){
           $response['data']=$data;
       }
        return response()->json($response,JsonResponse::HTTP_OK);
    }
    public function modelNotFound(): JsonResponse
    {
        $response = $this->setStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)->base();
        // $response['status'] = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
        $response['message']= 'No result found.';
        return response()->json($response,JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

    }
    public function exeption(?string $message = null): JsonResponse
    {
        $response = $this->setStatus(JsonResponse::HTTP_BAD_REQUEST)->base();
        $response['message']= $message ?? 'Something went wrong.';
        return response()->json($response,JsonResponse::HTTP_BAD_REQUEST);  //--------------[]
    }

    public function setStatus(int $status=null): ApiResponse
    {
        $this->status = $status;

        return $this;
    }

    protected function base(): array
    {
        return [
            'status'=>$this->status ?? JsonResponse::HTTP_OK,
            'time'=>Carbon::now()->timestamp,
            'message'=> '',
        ];
    }

}