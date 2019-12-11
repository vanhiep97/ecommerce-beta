<?php

namespace App\Http\Controllers\Admin;
use App\Services\Contracts\BrandServiceContract;
use App\Services\Contracts\CategoryServiceContract;
use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceContract;
use App\Services\Contracts\TypeProductServiceContract;
use App\Traits\UploadEditorTrait;
use App\Traits\UploadMutiFileTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Support\Str;
use Exception;
use App\Exports\ExportProducts;
use App\Imports\ImportProducts;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    use UploadTrait;
    use UploadMutiFileTrait;
    use UploadEditorTrait;
    protected $categoryService;
    protected $productService;
    protected $typeProductService;
    protected $brandService;
    public function __construct(CategoryServiceContract $categoryService, ProductServiceContract $productService, TypeProductServiceContract $typeProductService, BrandServiceContract $brandService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->typeProductService = $typeProductService;
        $this->brandService = $brandService;
    }

    public function index()
    {
        $products = $this->productService->get();
        foreach ($products as $product) {
            $product_id = $product->id;
        }
        $product_details = $this->productService->find($product_id)->product_details->first();
        return view('admin.modules.products.index', compact('products', 'product_details'));
    }

    public function create()
    {
        $categories = $this->categoryService->get();
        $type_products = $this->typeProductService->get();
        $brands = $this->brandService->get();
        return view('admin.modules.products.create', compact('categories', 'type_products', 'brands'));
    }

    public function edit(Request $request, $id)
    {
        $categories = $this->categoryService->get();
        $type_products = $this->typeProductService->get();
        $brands = $this->brandService->get();
        $product = $this->productService->find($id);
        $product_details = $product->product_details->first();
        return view('admin.modules.products.edit', compact('product', 'product_details', 'categories', 'type_products', 'brands'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->hasFile('pro_avatar')) {
                $fileName = $this->uploadFile('uploads/products/images/', $request->file('pro_avatar'));
            } else {
                $fileName = null;
            }
            if ($request->hasFile('prd_gallery')) {
                $gallery = $this->uploadMultiFile('uploads/products/images/', $request->file('prd_gallery'));
            } else {
                $gallery = null;
            }
            $products = $this->productService->store([
                'type_pro_id' => $request->type_pro_id,
                'pro_code' => $request->pro_code,
                'pro_name' => $request->pro_name,
                'pro_slug' => !empty($request->pro_slug) ? $request->pro_slug : Str::slug($request->pro_name, '-'),
                'pro_status' => $request->pro_status,
                'pro_seo_description' => $request->pro_seo_description,
                'pro_seo_keyword' => $request->pro_seo_keyword,
                'pro_avatar' => $fileName,
                'brand_id' => $request->brand_id,
                'admin_create' => Auth::user()->name,
            ]);
            $product_details = $products->product_details()->create([
                'product_id' => $products->id,
                'prd_price' => $request->prd_price,
                'prd_percent_discount' => $request->prd_percent_discount,
                'prd_excerpt' => $request->prd_excerpt,
                'prd_content' => $request->prd_content,
                'prd_gallery' => $gallery,
            ]);
            $product_find = $products->find($products->id);
            $product_find->category()->attach($request->category_id);
            return response()->json([
                'status' => true
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()->json(false);
        }
    }

    public function uploadEditor(Request $request)
    {
        $file=$request->file('file');
        $path= url('/uploads/products/editors/').'/'.$file->getClientOriginalName();
        $file->move(public_path('/uploads/products/editors/'),$file->getClientOriginalName());
        $fileNameToStore= $path;
        return json_encode(['location' => $fileNameToStore]);
    }

    public function importExport()
    {
        return view('admin.modules.products.import-csv');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new ExportProducts, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new ImportProducts, request()->file('file'));
        return back();
    }
}
