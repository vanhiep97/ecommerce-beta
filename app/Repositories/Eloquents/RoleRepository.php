<?php
namespace App\Repositories\Eloquents;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryContract;

class RoleRepository implements RoleRepositoryContract
{
    protected $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function get($columns = ["*"])
    {
        return $this->role->select($columns)->get();
    }

    public function paginate($option)
    {
        return $this->role->paginate($option);
    }

    public function find($id)
    {
        return $this->role->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->role->create($data);
    }

    public function update($id,array $data)
    {
        return $this->role->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->role->findOrFail($id)->delete();
    }
}
