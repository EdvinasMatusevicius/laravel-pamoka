<?php

namespace Modules\Product\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Product\Services\CategoryService;
use Modules\Product\Services\ProductService;
use Throwable;

class CategoryController extends Controller
{

    private $categoryService;
    private $productService;


    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
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
            $categoryDTO =$this->categoryService->getAllForApi();

            return (new ApiResponse())->success($categoryDTO);
        } catch (\Throwable $exeption) {
            logger()->error($exeption->getMessage());

            return (new ApiResponse())->exeption();
        }

    }



    public function show(string $slug): JsonResponse
    {
        try {
            $categoryDTO = $this->productService->getPaginateByCategorySlugForApi($slug);

            return (new ApiResponse())->success($categoryDTO);

        } catch (ModelNotFoundException $exeption) {
             
            return (new ApiResponse())->modelNotFound();

        }catch(Throwable $exeption){

            logger()->error($exeption->getMessage());
            return (new ApiResponse())->exeption();
        }

    }


}
