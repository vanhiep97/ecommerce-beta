<?php
namespace App\Repositories\Eloquents;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryContract;

class BrandRepository implements BrandRepositoryContract
{
    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function get($columns = ["*"])
    {
        return $this->brand->select($columns)->get();
    }

    public function paginate($option)
    {
        return $this->brand->paginate($option);
    }

    public function find($id)
    {
        return $this->brand->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->brand->create($data);
    }

    public function update($id,array $data)
    {
        return $this->brand->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->brand->findOrFail($id)->delete();
    }
}
