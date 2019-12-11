<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Models\User;

class UserRepository implements UserRepositoryContract
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get($columns = ["*"])
    {
        return $this->user->select($columns)->get();
    }

    public function paginate($option)
    {
        return $this->user->paginate($option);
    }

    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id,array $data)
    {
        return $this->user->findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->user->findOrFail($id)->delete();
    }


}
