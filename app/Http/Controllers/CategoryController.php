<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        /** @var LengthAwarePaginator $categories */
        $categories = Category::query()->paginate();

        return view('category.list', ['list' => $categories]);
    }

    /**
     * @return View
     */
    public function create(): View {
        return view('category.form');
    }

    /**
     * @param Request $request
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
        // SELECT * FROM products WHERE id = ?
        $category = Category::query()->find($id);

        return view('category.form', ['category' => $category]);
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse {
        $data = $request->getData();

        $category->update($data);

        return redirect()->route('categories.index');
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse {
        // DELETE FROM products WHERE id = ?
        Category::query()
            ->where('id', '=', $id)
            ->delete();

        return redirect()->route('categories.index');
    }

}
