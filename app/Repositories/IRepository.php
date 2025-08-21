<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

interface IRepository{

    public function all();
    public function findById($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    
}
