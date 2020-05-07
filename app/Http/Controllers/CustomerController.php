<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $users = User::query()->paginate();
        return view('customer.list',['list'=>$users]);
    } 

    public function create(): View
    {
        return view('customer.form');
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        try {
            User::query()->create($request->getData());

            return redirect()->route('customers.index')
            ->with('status','Customer created');
        } catch (Exception $exception) {
            return redirect()->back()->withInput()
            ->with('danger',$exception->getMessage());
        }
    }

    public function edit(User $customer): View
    {
        return view('customer.form',['customer'=>$customer]);
    }

    public function update(CustomerUpdateRequest $request, User $customer): RedirectResponse
    {
        try {
            $customer->name = $request->getName();
            $customer->email = $request->getEmail();

            $password = $request->getHashPassword();
            if (!empty($password)) {
                $customer->password = $password;
            }

            $customer->save();

            return redirect()->route('customers.index')->with('status','customer updated successfuly');
        } catch (Exception $exception) {
            return redirect()->back()->withInput()
            ->with('danger',$exception->getMessage());
        }
       
    }

    public function show(User $customer): View
    {
        return view('customer.view',[
            'item'=>$customer
        ]);
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        // $this->routeAccessManager->flushUserCache($customer);


    return redirect()->route('customers.index');
    }
}
