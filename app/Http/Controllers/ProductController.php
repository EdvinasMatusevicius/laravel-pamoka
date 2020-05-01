<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Category;
use App\Enum\ProductTypeEnum;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\ProductImage;
use App\Services\ImagesManager;
use App\Supply;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(): View {
        // SELECT * FROM products LIMITS 15, 30
        /** @var LengthAwarePaginator $products */
        $products = Product::query()->with(['images','categories'])->paginate();

        return view('product.product-list', [
            'list' => $products,
        ]);
    }

    /**
     * @return View
     */
    public function create(): View {
        $categories= Category::query()->get();

        $suppliers = Supply::query()->pluck('title','id');

        $types = ProductTypeEnum::enum();

        return view('product.form',[
            'categories'=>$categories,
            'suppliers'=>$suppliers,
            'types'=>$types
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse {

        $data = $request->getData();
        $catIds = $request->getCategories();
        $supplierIds = $request->getSuppliers();

        
        $product = Product::query()->create($data);
        $product->categories()->sync($catIds);
        $product->suppliers()->sync($supplierIds);

        ImagesManager::saveMany(
        $product,
        $request->getImages()
        ,ProductImage::class,
        'file',
        ImagesManager::PATH_PRODUCT);
        return redirect()->route('products.index')->with('status','product created');
    }

    /**
     * @param int $id
     *
     * @return View
     */
    public function edit(int $id): View {
        // SELECT * FROM products WHERE id = ?
        $product = Product::query()->find($id);
        $productCategoryIds = $product->categories()->pluck('id')->toArray();
        $productSupplierIds = $product->suppliers()->pluck('id')->toArray();
        $categories= Category::query()->get();
        $suppliers = Supply::query()->pluck('title','id');
        $types = ProductTypeEnum::enum();


        return view('product.form', [
        'product' => $product,
        'categories'=>$categories,
        'categoryIds'=>$productCategoryIds,
        'supplierIds'=>$productSupplierIds,
        'suppliers'=>$suppliers,
        'types'=>$types,

    ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     *
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse {
        $data = $request->getData();
        $catIds = $request->getCategories();
        $supplierIds = $request->getSuppliers();

        $product->update($data);

        $product->categories()->sync($catIds);
        $product->suppliers()->sync($supplierIds);


        ImagesManager::saveMany(
            $product,$request->getImages(),ProductImage::class,
            'file',ImagesManager::PATH_PRODUCT,$request->getDeleteImages());

        return redirect()->route('products.index')
        ->with('status','product updated');
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse {
 
        Storage::delete($product->images->pluck('file')->toArray());

        $product->delete();

        return redirect()->route('products.index')->with('status','product deleted');
    }

}

