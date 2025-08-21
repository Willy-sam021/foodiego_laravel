<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository implements IRepository
{


    public function all()
    {
         $data= Product::active()->paginate(10);
         return $data;
    }

    public function findById($id)
    {
        $product= Product::active()->find($id);
        return $product;
    }

    public function create($data)
    {
        $product= Product::create($data);
        return $product;
    }

    public function update($id, $data)
    {
        $product = $this->findById($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete($id)
    {
        $product = $this->findById($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }

    public function search($param)
    {
        $data= Product::active()->query()
        ->where('name', 'like', "%{$param}%")
        ->orWhere('description', 'like', "%{$param}%")
        ->orWhere('category', 'like', "%{$param}%")
        ->get();
        return $data;
    }

    public function getProductsByCat($id){
       $data= Product::where('category_id', $id)->get();
       return $data;

    }
}
?>
