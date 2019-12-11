<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Services\Contracts\CategoryServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Exception;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class CategoryController extends Controller
{
    use UploadTrait;
    protected $categorySerrvice;
    public function __construct(CategoryServiceContract $categoryService)
    {
        $this->categorySerrvice = $categoryService;
    }

    public function index()
    {
        $categories = $this->categorySerrvice->get();
        return view('admin.modules.categories.index', compact('categories'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $category = $this->categorySerrvice->find($request->category_id);
            $category->cat_status = $request->status;
            $category->save();
            return response()->json(['result' => $category]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function create()
    {
        $categories = $this->categorySerrvice->get();
        return view('admin.modules.categories.create', compact('categories'));
    }

    public function store(CategoryCreateRequest $request)
    {
        try {
            if ($request->hasFile('cat_image')) {
                $fileName = $this->uploadFile('uploads/categories', $request->file('cat_image'));
            } else {
                $fileName = null;
            }
            $categories = $this->categorySerrvice->store([
                'cat_image' => $fileName,
                'cat_parent_id' => $request->cat_parent_id,
                'cat_name' => $request->cat_name,
                'cat_slug' => !empty($request->cat_slug) ? $request->cat_slug : Str::slug($request->cat_name, '-'),
                'cat_description' => $request->cat_description,
                'cat_seo_description' => $request->cat_seo_description,
                'cat_seo_keyword' => $request->cat_seo_keyword,
                'cat_status' => $request->cat_status,
                'admin_create' => Auth::user()->name,
            ]);
            return response()->json([
                'categories' => $categories,
                'status' => true,
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function edit($id)
    {
        $category = $this->categorySerrvice->get();
        $categories = $this->categorySerrvice->find($id);
        return view('admin.modules.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        try {
            if ($request->hasFile('cat_image')) {
                $fileName = $this->uploadFile('uploads/categories', $request->file('cat_image'));
            } else {
                $fileName = $request->cat_image_old;
            }
            if (strcmp($request->cat_slug, $request->cat_slug_old) == 0) {
                $cat_slug = Str::slug($request->cat_name, '-');
            } else {
                $cat_slug = $request->cat_slug;
            }
            $updated = $this->categorySerrvice->update($request->id,[
                'cat_image' => $fileName,
                'cat_parent_id' => $request->cat_parent_id,
                'cat_name' => $request->cat_name,
                'cat_slug' => $cat_slug,
                'cat_description' => $request->cat_description,
                'cat_seo_description' => $request->cat_seo_description,
                'cat_seo_keyword' => $request->cat_seo_keyword,
                'cat_status' => $request->cat_status,
                'admin_create' => Auth::user()->name,
            ]);
            if (!empty($request->cat_image_old)) {
                $this->deleteFile('uploads/categories', $request->cat_image_old);
            }
            return response()->json([
                'result' => $updated,
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function destroy($id) {
        try {
            $file = $this->categorySerrvice->find($id)->cat_image;
            $destroy = $this->categorySerrvice->destroy($id);
            $this->deleteFile('uploads/categories', $file);
            return response()->json($destroy);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }
}
