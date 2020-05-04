<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Product\Entities\Category;
use Modules\Product\Http\Requests\CategoryStoreRequest;
use Modules\Product\Http\Requests\CategoryUpdateRequest;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View {
        $categories = Category::query()->paginate();

        return view('product::category.list', ['list' => $categories]);
    }

    /**
     * @return View
     */
    public function create(): View {
        return view('product::category.form');
    }

    /**
     * @param CategoryStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse {
        $data = $request->getData();

        Category::query()->create($data);

        return redirect()->route('categories.index');
    }

    /**
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit(int $id): View {
        $category = Category::query()->find($id);

        return view('product::category.form', ['category' => $category]);
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, int $id): RedirectResponse {
        $data = $request->getData();

        Category::query()
            ->where('id', '=', $id)
            ->update($data);

        return redirect()->route('categories.index');
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse {
        Category::query()
            ->where('id', '=', $id)
            ->delete();

        return redirect()->route('categories.index');
    }

}
