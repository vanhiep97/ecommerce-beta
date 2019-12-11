<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Services\Contracts\BrandServiceContract;
// use App\Services\Contracts\ProductServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Exception;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class BrandController extends Controller
{
    use UploadTrait;
    protected $brandService;
    protected $productService;
    public function __construct(BrandServiceContract $brandService)
    {
        $this->brandService = $brandService;
    }
    // public function __construct(ProductServiceContract $productService)
    // {
    //     $this->productService = $productService;
    // }

    public function index()
    {
        $brands = $this->brandService->get();
        return view('admin.modules.brands.index', compact('brands'));
    }
    public function updateStatus(Request $request)
    {
        try {
            $brand = $this->brandService->find($request->brand_id);
            $brand->br_status = $request->status;
            $brand->save();
            return response()->json(['result' => $brand]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function create()
    {
        $brands = $this->brandService->get();
        return view('admin.modules.brands.create', compact('brands'));
    }

    public function store(BrandCreateRequest $request)
    {
        try {
            if ($request->hasFile('bra_image')) {
                $fileName = $this->uploadFile('uploads/brands', $request->file('bra_image'));
            } else {
                $fileName = null;
            }
            $brands = $this->brandService->store([
                'br_image' => $fileName,
                'br_name' => $request->bra_name,
                'br_slug' => !empty($request->bra_slug) ? $request->bra_slug : Str::slug($request->bra_name, '-'),
                'br_description' => $request->bra_description,
                'br_seo_description' => $request->bra_seo_description,
                'br_seo_keyword' => $request->bra_seo_keyword,
                'br_status' => $request->bra_status,
                'admin_create' => Auth::user()->name,
            ]);
            return response()->json([
                'brands' => $brands,
                'status' => true,
            ]);   
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function edit($id)
    {
        $brands = $this->brandService->find($id);
        return view('admin.modules.brands.edit', compact('brands'));
    }

    public function update(BrandUpdateRequest $request)
    {
        $check = false;
        try {
            if ($request->hasFile('br_image')) {
                $fileName = $this->uploadFile('uploads/brands', $request->file('br_image'));
            } else {
                     $fileName = $request->br_image_old;
                     $check =true;
            }
            if (strcmp($request->br_slug, $request->br_slug_old) == 0) {
                $br_slug = Str::slug($request->br_name, '-');
            } else {
                $br_slug = $request->br_slug;
            }
            $updated = $this->brandService->update($request->id,[
                'br_image' => $fileName,
                'br_name' => $request->br_name,
                'br_slug' => $br_slug,
                'br_description' => $request->br_description,
                'br_seo_description' => $request->br_seo_description,
                'br_seo_keyword' => $request->br_seo_keyword,
                'br_status' => $request->br_status,
                'admin_create' => Auth::user()->name,
            ]);
            if (!empty($request->br_image_old) && $check =false) {
                $this->deleteFile('uploads/brands', $request->br_image_old);
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
            $file = $this->brandService->find($id)->br_image;
            $destroy = $this->brandService->destroy($id);
            $this->deleteFile('uploads/brands', $file);
            return response()->json($destroy);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }
}
