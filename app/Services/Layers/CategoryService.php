<?php
namespace App\Services\Layers;

use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Services\Contracts\CategoryServiceContract;

class CategoryService implements CategoryServiceContract
{
    protected $repository;

    public function __construct(CategoryRepositoryContract $repository)
    {
        return $this->repository = $repository;
    }
    public function get($columns=["*"])
    {
        return $this->repository->get();
    }
    public function paginate($option)
    {
        return $this->repository->paginate($option);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
