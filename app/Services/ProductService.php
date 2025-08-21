<?php
namespace App\Services;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        $data= $this->productRepository->all();
        if($data->isEmpty()){
            return [];
        }
        return $data;
    }

    public function getProductById($id)
    {
        $product= $this->productRepository->findById($id);
        if(!$product){
            Log::error("no product found for id $id");
            abort(433,"Oops! No product found");
        }
        return $product;
    }

    public function createProduct($data)
    {
        $user = currentAuthUser();

        $data['user_id'] = $user->id;
        $file = $data['image'];
        $filename = 'FG'.'_'.Str::uuid(). $file->getClientOriginalExtension(); // e.g., 1722438890_image.jpg
        $data['image'] = $file->storeAs('products', $filename, 'public');

        $product= $this->productRepository->create($data);
        return $product;
    }

    public function updateProduct($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    public function searchProducts($param)
    {
        return $this->productRepository->search($param);
    }

    public function getProducts($id){
        $data = $this->productRepository->getProductsByCat($id);

        if(!$data){
            return false;
        }
        return $data;

    }

}
?>
