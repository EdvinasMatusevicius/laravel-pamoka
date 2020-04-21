<?php
declare(strict_types = 1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Roles;
use App\Services\RouteAccessManager;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    private $routeAccessManager;
    PUBLIC FUNCTION __construct(RouteAccessManager $routeAccessManager)
    {
        $this->routeAccessManager=$routeAccessManager;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $roles = Roles::query()->paginate();
        return view('role.index',[
            'list'=>$roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $routesNames = $this->routeAccessManager->getRoutes();
        return view('role.form', [
            'routes'=>$routesNames,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request):RedirectResponse
    {
        try {
            Roles::query()->create($request->getData());
        } catch (Exception $exeption) {
            return redirect()->back()->withInput()->with('danger', $exeption->getMessage());
        }

        return redirect()->route('roles.index')->with('status','Role created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $role): View
    {
        return view('role.view',[
            'item'=>$role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $role): View
    {
        $routesNames = $this->routeAccessManager->getRoutes();
        return view('role.form', [
            'item' => $role,
            'routes'=>$routesNames,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Roles $role):RedirectResponse
    {
        try {
            $role->update($request->getData());
            $this->routeAccessManager->flushCache();
        } catch (Exception $exeption) {
            return back()->withInput()
            ->with('danger',$exeption->getMessage());
        }

        return redirect()->route('roles.index')->with('status','Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $role)
    {
        try {
            $role->delete();
            $this->routeAccessManager->flushCache();

        } catch (Exception $exeption) {
            return back()
            ->with('danger',$exeption->getMessage());
        }

        return redirect()->route('roles.index')->with('status','Role deleted');
    }
}
