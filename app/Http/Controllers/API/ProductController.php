<?php
declare(strict_types=1);
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            
            $productDTO = $this->productService->getPaginateForApi();
            return (new ApiResponse())->success($productDTO);
            
        } catch (\Throwable $exeption) {
            logger()->error($exeption->getMessage());

            return (new ApiResponse())->exeption();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $productDTO = $this->productService->getBySlugForApi($slug);

            return (new ApiResponse())->success($productDTO);

        } catch (ModelNotFoundException $exeption) {
            return (new ApiResponse())->modelNotFound();
            
        } catch(Throwable $exeption){
            logger()->error($exeption->getMessage());
            return (new ApiResponse())->exeption();
        }
    }


}
