<?php


namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Roles;
use App\Services\AdminService;
use App\Services\RouteAccessManager;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{

    private $routeAccessManager;
    private $service;

    public function __construct(AdminService $adminService,RouteAccessManager $routeAccessManager)
    {
        $this->service = $adminService;
        $this->routeAccessManager=$routeAccessManager;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $admins = Admin::query()->paginate();
        return view('admin.list',[
            'list'=>$admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles=Roles::query()->orderBy('id')->get(['id','name']);
        return view('admin.form',[
        'roles'=>$roles
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request): RedirectResponse
    {
        try {
            $admin=$this->service->create(
            $request->getEmail(),
            $request->getPass(),
            $request->getActive(),
            $request->getData()
        );
            // $admin = Admin::query()->create($request->getData());
            $admin->roles()->sync($request->getRoles());

        } catch (\Exception $exeption) {
            return redirect()->back()
            ->withInput()
            ->with('danger',$exeption->getMessage());
        }
        return redirect()->route('admins.index')->with('status','admin created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return View
     */
    public function edit(Admin $admin): View {
        $roles=Roles::query()->orderBy('id')->get(['id','name']);
        $rolesIds = $admin->roles->pluck('id')->toArray();

        return view('admin.form',[
        'item'=>$admin,
        'roles'=>$roles,
        'rolesIds'=>$rolesIds
    ]);
    }


    public function me(): View
    {
        /** @var Admin $admin */
        $admin = Auth::user();
        /** @var Collection $roles */
        $roles = Roles::query()->orderBy('id')->get(['id', 'name']);
        $rolesIds = $admin->roles->pluck('id')->toArray();

        return view('admin.form', [
            'item' => $admin,
            'roles' => $roles,
            'rolesIds' => $rolesIds,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, Admin $admin): RedirectResponse
    {
        try {
            $admin->update($request->getData());
            $admin->roles()->sync($request->getRoles());

            $this->routeAccessManager->flushUserCache($admin);
        } catch (Exception $exception) {
            return redirect()->back()
                ->withInput()
                ->with('danger', 'Something wrong on try to update admin.');
        }

        return redirect()->route('admins.index')
            ->with('status', 'Admin Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        Admin::query()
        ->where('id', '=', $admin->id)
        ->delete();
        $this->routeAccessManager->flushUserCache($admin);


    return redirect()->route('admins.index');
    }
}
