<?php
namespace App\Services\Layers;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\Contracts\ProductServiceContract;

class ProductService implements ProductServiceContract
{
    protected $repository;

    public function __construct(ProductRepositoryContract $repository)
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

    public function createTwoTable(array $data)
    {
        return $this->repository->createTwoTable($data);
    }
}
