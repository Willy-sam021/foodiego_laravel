<?php
namespace App\Repositories;
use App\Models\Category;

class CategoryRepository implements IRepository
{
    public function all()
    {
        $data= Category::all();
        return $data;
    }

    public function findById($id)
    {
        $data= Category::find($id);
        return $data;
    }

    public function create($data)
    {
        $data= Category::create($data);
        return $data;
    }

    public function update($id, $data)
    {
        $category = $this->findById($id);
        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete($id)
    {
        $category = $this->findById($id);
        if ($category) {
            return $category->delete();
        }
        return false;
    }

    

}
?>
