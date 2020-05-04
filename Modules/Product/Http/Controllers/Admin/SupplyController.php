<?php

declare(strict_types = 1);

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\Product\Entities\Supply;
use Modules\Product\Http\Requests\SupplierStoreRequest;
use Modules\Product\Http\Requests\SupplierUpdateRequest;


/**
 * Class SupplyController
 * @package Modules\Product\Http\Controllers\Admin
 */
class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $list = Supply::query()->paginate();

        return view('product::supply.list', [
            'list' => $list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('product::supply.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        try {
            Supply::query()->create($request->getData());

            return redirect()->route('supplier.index')
                ->with('status', 'Supplier created.');
        } catch (Exception $exception) {
            return redirect()->back()
                ->withInput()
                ->with('danger', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Supply $supplier
     * @return View
     */
    public function show(Supply $supplier): View
    {
        return view('product::supply.view', ['item' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Supply $supplier
     * @return View
     */
    public function edit(Supply $supplier): View
    {
        return view('product::supply.form', ['item' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SupplierUpdateRequest $request
     * @param Supply $supplier
     * @return RedirectResponse
     */
    public function update(SupplierUpdateRequest $request, Supply $supplier): RedirectResponse
    {
        try {
            $data = $request->getData();

            if ($request->getDeleteLogo()) {
                Storage::delete($supplier->logo);
                $data['logo'] = null;
            }

            if ($request->getLogo() !== null) {
                Storage::delete($supplier->logo);
                $logoPath = $request->getLogoPath();
                $data['logo'] = $logoPath;
            }

            $supplier->update($data);

            return redirect()->route('supplier.index')
                ->with('status', 'Supplier updated.');
        } catch (Exception $exception) {
            return redirect()->back()
                ->withInput()
                ->with('danger', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Supply $supplier
     * @return RedirectResponse
     */
    public function destroy(Supply $supplier): RedirectResponse
    {
        try {
            $supplier->delete();

            return redirect()->route('supplier.index')
                ->with('status', 'Supplier deleted.');
        } catch (Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage());
        }
    }
}
