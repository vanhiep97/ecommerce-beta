<?php
namespace App\Repositories\Eloquents;
use App\Models\TypeProduct;
use App\Repositories\Contracts\TypeProductRepositoryContract;

class TypeProductRepository implements TypeProductRepositoryContract
{
    protected $typeProduct;
    public function __construct(TypeProduct $typeProduct)
    {
        $this->typeProduct = $typeProduct;
    }

    public function get($columns = ["*"])
    {
        return $this->typeProduct->select($columns)->get();
    }

    public function paginate($option)
    {
        return $this->typeProduct->paginate($option);
    }

    public function find($id)
    {
        return $this->typeProduct->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->typeProduct->create($data);
    }

    public function update($id,array $data)
    {
        return $this->typeProduct->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->typeProduct->findOrFail($id)->delete();
    }
}
