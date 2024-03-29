<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use App\Models\Department;
use App\Streams\MediaStreamCustom;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use ZipStream\Option\Archive as ArchiveOptions;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('contents.category.index', [
            'categories' => Category::all(),
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
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'department' => ['required', 'exists:departments,slug'],
        ])->validate();

        try {
            $department = Department::findBySlugOrFail($request->input('department'));
            $category = new Category();
            $category->name = $request->input('name');
            $category->department()->associate($department);
            $category->save();

            return back()->with('flash_success_message', 'Category created successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('flash_error_message', 'Category creation failed');
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
        $category = Category::findBySlugOrFail($slug);

        return view('contents.category.edit', [
            'category' => $category,
            'categories' => Category::all(),
            'departments' => Department::all()
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
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'department' => ['required', 'exists:departments,slug'],
        ])->validate();

        try {
            $department = Department::findBySlugOrFail($request->input('department'));
            $category = Category::findBySlugOrFail($slug);
            $category->name = $request->input('name');
            $category->department()->associate($department);
            $category->save();

            return back()->with('flash_success_message', 'Category updated successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('flash_error_message', 'Category update failed');
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
            $category = Category::findBySlugOrFail($slug);
            $category->delete();
            return back()->with('flash_success_message', 'Category deleted successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('flash_error_message', 'Category deletion failed');
        }
    }

    public function exportCSV(Request $request)
    {
        if (!$request->has('category')) {
            return back()->with('flash_error_message', 'Bạn chưa có tuổi');
        }

        try {
            return Excel::download(new CategoryExport(Crypt::decrypt($request->input('category'))), 'categories_' . Carbon::now()->toTimeString() . '.csv', \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv',
            ]);
        } catch (DecryptException $e) {
            return back()->with('flash_error_message', 'This file could not be downloaded. Please try again later!');
        }
    }

    public function exportZip(Request $request)
    {
        if (!$request->has('category')) {
            return back()->with('flash_error_message', 'Bạn chưa có tuổi');
        }

        try {
            $documents = [];
            $category = Category::whereIn('id', Crypt::decrypt($request->input('category')))->get();
            foreach ($category as $cate) {
                foreach ($cate->posts as $post) {
                    if ($post->hasMedia('documents')) {
                        $documents[] = $post->getMedia('documents');
                    }
                }
            }

            if (!empty($documents)) {
                $collection = Collection::make($documents);

                return MediaStreamCustom::create('Documents-' . Carbon::now()->format('Y-m-d') . '.zip')
                    ->useZipOptions(function (ArchiveOptions $zipOptions) {
                        $zipOptions->setZeroHeader(true);
                    })
                    ->addMediaCollection($collection);
            }

            return back()->with('flash_error_message', 'This file could not be downloaded or you made the wrong choice. Please try again later!');

        } catch (DecryptException $e) {
            Log::error($e->getMessage());
            return back()->with('flash_error_message', 'This file could not be downloaded. Please try again later!');
        }
    }
}
