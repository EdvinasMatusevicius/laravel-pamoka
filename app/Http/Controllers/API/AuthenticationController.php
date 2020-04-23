<?php
declare(strict_types=1);
namespace App\Http\Controllers\API;

use App\DTO\Abstracts\CustomerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;

class AuthenticationController extends Controller
{
    private $loginAfterSignUp = true;
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            User::query()->create($request->getData());
            
        } catch (Exception $exeption) {
            return (new ApiResponse())->exeption($exeption->getMessage());
        }
        if($this->loginAfterSignUp){
            return $this->login($request);
        }

        return (new ApiResponse())->success();
    }
    public function login(LoginRequest $request): JsonResponse
    {
        try {
           if(!auth()->attempt($request->getCredentials())){
            return (new ApiResponse())->unauthorized('invalid credentials');
           }
           $customer=auth()->user();

           $token=$customer->createToken('Grant Client')->accessToken;

           return (new ApiResponse())->success([
               'token'=>$token,
               'token_type'=>'bearer',
           ]);
            
        } catch (Exception $exeption) {
            return (new ApiResponse())->exeption($exeption->getMessage());
        }
    }
    public function me(): JsonResponse
    {
        try{
           $customer = auth('api')->user();

           $customerDTO= new CustomerDTO($customer);

           return (new ApiResponse())->success($customerDTO);
        }catch(Exception $exeption){
            return (new ApiResponse())->exeption($exeption->getMessage());
        }
    }
    public function logout(Request $request):JsonResponse
    {
        try{
            $value = $request->bearerToken();
            $tokenId = (new Parser())->parse($value)->getClaim('jti');

            $customer = auth('api')->user();
            $token = $customer->tokens->find($tokenId);

            $token->revoke();
        }catch(Exception $exeption){
            return (new ApiResponse())->exeption($exeption->getMessage());
        }
        return (new ApiResponse())->success();
    }
}
