<?php
namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryContract;

class CategoryRepository implements CategoryRepositoryContract
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function get($columns = ["*"])
    {
        return $this->category->select($columns)->get();
    }

    public function paginate($option)
    {
        return $this->category->paginate($option);
    }

    public function find($id)
    {
        return $this->category->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->category->create($data);
    }

    public function update($id,array $data)
    {
        return $this->category->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->category->findOrFail($id)->delete();
    }
}
