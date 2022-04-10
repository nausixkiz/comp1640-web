<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Common\CommonApiController;
use App\Models\File;
use App\Models\Post;
use Brainstud\FileVault\Facades\FileVault;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileController extends CommonApiController
{
    public function uploadDocument(Request $request)
    {
        try {
            dd($request->thump);
            $validator = Validator::make($request->all(), [
                'post_slug' => 'required|string|min:3|max:255',
                'file_name' => 'required|string|min:3|max:191',
                'file_md5' => 'required|string|min:3|max:191',
                'file' => 'required|file',
            ]);

            if ($validator->fails()) {
                return $this->respondFailedValidation($validator);
            }

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $post = Post::findBySlug($request->input('post_slug'));

                if (!$post) {
                    return $this->respondError('Post not found.');
                }

                $fileUpload = $request->file('file');
                $filePath = 'files/' . $post->slug;
                $fileName = Carbon::now()->format('YYYYmmdd') . '_' . $fileUpload->getClientOriginalName();

                Storage::disk('local')->putFileAs(
                    $filePath,
                    $fileUpload,
                    $fileName
                );

                Log::info('Upload ' . $fileName . ' to ' . $filePath . ': OK!!!');

                if ($fileName) {
                    FileVault::encrypt($filePath . '/' . $fileName);

                    Log::info("File encrypted: OK!!!");

                    $fileModel = new File();
                    $fileModel->name = $request->input('file_name');
                    $fileModel->path = $filePath;
                    $fileModel->local_name = $fileName . '.enc';
                    $fileModel->original_name = $fileName;
                    $fileModel->size = $fileUpload->getSize();
                    $fileModel->mime_type = $fileUpload->getMimeType();
                    $fileModel->md5 = Hash::make(Str::lower($request->file_md5));
                    $fileModel->product()->associate($post->id);
                    $fileModel->save();

                    Log::info("File DB: OK!!!");

                    return $this->respondCreated($fileModel);
                }
            }

            return $this->respondNoContent();
        } catch (Exception $exception) {
            Log::error('Exception throw when handle access log with code: ' . $exception->getCode());
            Log::error('Detail: ' . $exception->getMessage());

            return $this->respondError($exception->getMessage());
        }
    }


}
