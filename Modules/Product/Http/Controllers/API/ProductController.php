<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Product\Services\ProductService;
use Throwable;

/**
 * Class ProductController
 * @package Modules\Product\Http\Controllers\API
 */
class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $productsDto = $this->productService->getPaginateForApi();

            return (new ApiResponse())->success($productsDto);
        } catch (Throwable $exception) {
            logger()->error($exception->getMessage());

            return (new ApiResponse())->exception();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $productDTO = $this->productService->getBySlugForApi($slug);

            return (new ApiResponse())->success($productDTO);
        } catch (ModelNotFoundException $exception) {
            return (new ApiResponse())->modelNotFound();
        } catch (Throwable $exception) {
            logger()->error($exception->getMessage());

            return (new ApiResponse())->exception();
        }
    }
}
