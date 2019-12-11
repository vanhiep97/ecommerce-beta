<?php
namespace App\Repositories\Eloquents;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;

class ProductRepository implements ProductRepositoryContract
{
    protected $product;
    protected $categoryProduct;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function get($columns = ["*"])
    {
        return $this->product->select($columns)->get();
    }

    public function paginate($option)
    {
        return $this->product->paginate($option);
    }

    public function find($id)
    {
        return $this->product->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->product->create($data);
    }

    public function update($id,array $data)
    {
        return $this->product->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->product->findOrFail($id)->delete();
    }
}
