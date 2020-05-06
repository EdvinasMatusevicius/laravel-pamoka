<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Supply;
use Modules\Product\Enum\ProductTypeEnum;
use Modules\Product\Exceptions\ModelRelationMissingException;
use Modules\Product\Http\Requests\ProductStoreRequest;
use Modules\Product\Http\Requests\ProductUpdateRequest;
use Modules\Product\Repositories\CategoryRepository;
use Modules\Product\Repositories\SupplyRepository;
use Modules\Product\Services\ProductService;
use ReflectionException;

/**
 * Class ProductController
 * @package Modules\Product\Http\Controllers\Admin
 */
class ProductController extends Controller
{

    private $categoryRepository;

    private $supplyRepository;

    private $productService;


    public function __construct(
        CategoryRepository $categoryRepository,
        SupplyRepository $supplyRepository,ProductService $productService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->supplyRepository = $supplyRepository;
        $this->productService = $productService;
    }
    /**
     * @return View
     */
    public function index(): View
    {
        $products = $this->productService->getPaginateWithRelationsAdmin();

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
        $categories = $this->categoryRepository->all(['id','title']);

        $suppliers = $this->supplyRepository->pluck('title', 'id');

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
        try{
            $this->productService->createWithRelationsAdmin(
                $request->getData(),
                $request->getCategories(),
                $request->getSuppliers(),
                $request->getImages()
            );
        }catch(ModelRelationMissingException $exeption){
            return redirect()->route('products.index')
            ->with('danger',$exeption->getMessage());

        }catch(Exception $exeption){
            return redirect()->route('products.index')
            ->with('danger','Something wrong');
        }



        return redirect()->route('products.index')
            ->with('status', 'Product created.');
    }

    /**
     * @param int $id
     *
     * @return View
     * @throws ReflectionException
     */
    public function edit(int $id)
    {
        try {
            

        $product = $this->productService->getById($id);
        $productCategoryIds = $product->categories()->pluck('id')->toArray();
        $productSupplierIds = $product->suppliers()->pluck('id')->toArray();
        /** @var Collection|Category[] $categories */
        $categories = $this->categoryRepository->all(['id','title']);
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
    } catch (ModelNotFoundException $exeption) {
        return redirect()->route('products.index')->with('danger','Record not found');
    } catch (Exception $exeption){
        return redirect()->route('products.index')->with('danger','Something went wrong');
    }
    }

    /**
     * @param ProductUpdateRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(ProductUpdateRequest $request, int $id): RedirectResponse
    {
        try{
            
            $this->productService->updateWIthRelationsAdmin(
                $request->getData(),
                $id,$request->getDeleteImages()
            );
        }catch(ModelNotFoundException $exeption){
            return redirect()->back()->withInput()
            ->with('danger','Record not found');
        }catch(ModelRelationMissingException $exeption){
            return redirect()->back()->withInput()
            ->with('danger',$exeption->getMessage());
        }catch(Exception $exeption){
            return redirect()->back()->withInput()
            ->with('danger','Record not found');
        }

        return redirect()->route('products.index')
            ->with('status', 'Product updated.');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        try{
        $this->productService->delete($id);
        }catch(ModelNotFoundException $exeption){
            return redirect()->route('products.index')
            ->with('danger','Record not found');

        }catch(ModelRelationMissingException $exeption){
            return redirect()->route('products.index')
            ->with('danger',$exeption->getMessage());

        }catch(Exception $exeption){
            return redirect()->route('products.index')
            ->with('danger','Something wrong');
        }
        return redirect()->route('products.index')
            ->with('status', 'Product deleted.');
    }
}
