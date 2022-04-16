<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contents.department.index', [
            'departments' => Department::all()
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
            'name' => ['required', 'string', 'max:255'],
            'start_closure_date' => ['required', 'date'],
            'end_closure_date' => ['required', 'date'],
        ])->validate();

        try {
            Department::create([
                'name' => $request->input('name'),
                'start_closure_date' => $request->input('start_closure_date'),
                'end_closure_date' => $request->input('end_closure_date'),
            ]);

            return back()->with('flash_success_message', 'Department creation successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('flash_error_message', 'Department creation failed');
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
        $department = Department::findBySlugOrFail($slug);

        return view('contents.department.edit', [
            'departments' => Department::all(),
            'department' => $department
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'start_closure_date' => ['required', 'date'],
            'end_closure_date' => ['required', 'date'],
        ])->validate();

        try {
            $department = Department::findBySlugOrFail($slug);
            $department->update([
                'name' => $request->input('name'),
                'start_closure_date' => $request->input('start_closure_date'),
                'end_closure_date' => $request->input('end_closure_date'),
            ]);

            return back()->with('flash_success_message', 'Department updated successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('flash_error_message', 'Department updated failed');
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
        try {
            $department = Department::findBySlugOrFail($slug);
            $department->delete();

            return back()->with('flash_success_message', 'Department deletion successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('flash_error_message', 'Department deletion failed');
        }
    }
}
