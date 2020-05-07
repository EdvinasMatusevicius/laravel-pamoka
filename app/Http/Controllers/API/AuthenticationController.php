<?php
declare(strict_types=1);
namespace App\Http\Controllers\API;

use App\DTO\Abstracts\CustomerDTO;
use App\Events\API\CustomerLoginEvent;
use App\Events\API\CustomerLogoutEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Lcobucci\JWT\Parser;

class AuthenticationController extends Controller
{
    private $loginAfterSignUp = true;
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            User::query()->create($request->getData());
            
        } catch (Exception $exception) {
            return (new ApiResponse())->exception($exception->getMessage());
        }
        if($this->loginAfterSignUp){
            return $this->login($request);
        }

        return (new ApiResponse())->success();
    }
    public function login(LoginRequest $request): JsonResponse
    {
        try {
          if (!auth()->attempt($request->getCredentials())) {
                return (new ApiResponse())->unauthorized('Invalid credentials.');
            }

            /** @var User $customer */
            $customer = auth()->user();

            $personalAccessToken = $customer->createToken('Grant Client');

            event(new CustomerLoginEvent($customer, $personalAccessToken->token->id, Carbon::now()));

           return (new ApiResponse())->success([
            'token' => $personalAccessToken->accessToken,
               'token_type'=>'bearer',
           ]);
            
        } catch (Exception $exception) {
            return (new ApiResponse())->exception($exception->getMessage());
        }
    }
    public function me(): JsonResponse
    {
        try{
           $customer = auth('api')->user();

           $customerDTO= new CustomerDTO($customer);

           return (new ApiResponse())->success($customerDTO);
        }catch(Exception $exception){
            return (new ApiResponse())->exception($exception->getMessage());
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
            event(new CustomerLogoutEvent($customer,$tokenId,Carbon::now()));

        }catch(Exception $exception){
            return (new ApiResponse())->exception($exception->getMessage());
        }
        return (new ApiResponse())->success();
    }
}
