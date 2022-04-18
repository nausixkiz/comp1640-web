<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contents.user.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contents.user.create', [
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6', 'max:50'],
            'email' => ['required', 'string', 'email', 'min:6', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'phone' => ['required', 'string', 'min:6', 'max:255', 'unique:users,phone'],
            'role' => ['required', 'string', Rule::in(Role::all()->pluck('name'))],
            'birth' => ['nullable', 'date'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'address' => ['nullable', 'string', 'min:6', 'max:255'],
        ])->validate();

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->phone = $request->input('phone');
            $user->birth = $request->input('birth');
            $user->gender = $request->input('gender');
            $user->address = $request->input('address');
            $user->save();

            $user->assignRole($request->input('role'));

            Session::flash('flash_success_message', 'User successfully updated!');

            return redirect()->route('users.index');
        } catch (Exception $e) {
            Log::error('Error while updating user: ' . $e->getMessage());
            Session::flash('flash_error_message', 'Error while updating user!');

            return redirect()->route('users.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        return view('contents.user.edit', [
            'user' => User::findBySlugOrFail($slug),
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $slug)
    {
        $user = User::findBySlugOrFail($slug);

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6', 'max:50'],
            'email' => ['required', 'string', 'email', 'min:6', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'max:255', 'confirmed'],
            'phone' => ['required', 'string', 'min:6', 'max:255', 'unique:users,phone,' . $user->id],
            'role' => ['required', 'string', Rule::in(Role::all()->pluck('name'))],
            'birth' => ['nullable', 'date'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'address' => ['nullable', 'string', 'min:6', 'max:255'],
        ])->validate();

        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->phone = $request->input('phone');
            $user->birth = $request->input('birth');
            $user->gender = $request->input('gender');
            $user->address = $request->input('address');
            $user->save();

            $user->assignRole($request->input('role'));

            Session::flash('flash_success_message', 'User successfully updated!');

            return redirect()->route('users.index');
        } catch (Exception $e) {
            Log::error('Error while updating user: ' . $e->getMessage());
            Session::flash('flash_error_message', 'Error while updating user!');

            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return RedirectResponse
     */
    public function destroy(string $slug)
    {
        $user = User::findBySlugOrFail($slug);
        $user->delete();

        Session::flash('flash_success_message', 'User successfully deleted!');

        return back();
    }
}
