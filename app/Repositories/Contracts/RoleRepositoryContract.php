<?php
namespace App\Repositories\Contracts;

interface RoleRepositoryContract
{
    public function get($columns=["*"]);
    public function paginate($option);
    public function find($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
