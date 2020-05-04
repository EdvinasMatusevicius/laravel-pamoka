<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Entities\Supply;
use Modules\Product\Enum\ProductTypeEnum;
use Modules\Product\Http\Requests\ProductStoreRequest;
use Modules\Product\Http\Requests\ProductUpdateRequest;
use Modules\Product\Services\ImagesManager;
use ReflectionException;

/**
 * Class ProductController
 * @package Modules\Product\Http\Controllers\Admin
 */
class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::query()
            ->with(['images', 'categories'])
            ->paginate();

        return view('product::product.list', [
            'list' => $products,
        ]);
    }

    /**
     * @return View
     * @throws ReflectionException
     */
    public function create(): View
    {
        /** @var Collection|Category[] $categories */
        $categories = Category::query()->get();

        $suppliers = Supply::query()->pluck('title', 'id');

        $types = ProductTypeEnum::enum();

        return view('product::product.form', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'types' => $types,
        ]);
    }

    /**
     * @param ProductStoreRequest $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->getData();

        $catIds = $request->getCategories();
        $supplierIds = $request->getSuppliers();

        /** @var Product $product */
        $product = Product::query()->create($data);
        $product->categories()->sync($catIds);
        $product->suppliers()->sync($supplierIds);

        ImagesManager::saveMany($product, $request->getImages(), ProductImage::class,
            'file', ImagesManager::PATH_PRODUCT);

        return redirect()->route('products.index')
            ->with('status', 'Product created.');
    }

    /**
     * @param int $id
     *
     * @return View
     * @throws ReflectionException
     */
    public function edit(int $id): View
    {
        /** @var Product $product */
        $product = Product::query()->find($id);
        $productCategoryIds = $product->categories()->pluck('id')->toArray();
        $productSupplierIds = $product->suppliers()->pluck('id')->toArray();
        /** @var Collection|Category[] $categories */
        $categories = Category::query()->get();
        $suppliers = Supply::query()->pluck('title', 'id');
        $types = ProductTypeEnum::enum();

        return view('product::product.form', [
            'product' => $product,
            'categoryIds' => $productCategoryIds,
            'supplierIds' => $productSupplierIds,
            'categories' => $categories,
            'suppliers' => $suppliers,
            'types' => $types,
        ]);
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $data = $request->getData();
        $catIds = $request->getCategories();
        $suppliersIds = $request->getSuppliers();

        $product->update($data);
        $product->categories()->sync($catIds);
        $product->suppliers()->sync($suppliersIds);

        ImagesManager::saveMany($product, $request->getImages(), ProductImage::class,
            'file', ImagesManager::PATH_PRODUCT, $request->getDeleteImages());

        return redirect()->route('products.index')
            ->with('status', 'Product updated.');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete(
            $product->images->pluck('file')->toArray()
        );

        $product->delete();

        return redirect()->route('products.index')
            ->with('status', 'Product deleted.');
    }
}
