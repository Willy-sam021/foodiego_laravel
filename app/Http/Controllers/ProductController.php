<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Requests\Product\ProductCreateRequest;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService, public CategoryService $categoryService)
    {
        $this->productService = $productService;
    }

    public function index(){
        $products = $this->productService->getAllProducts();
        $categories = $this->categoryService->getAllCategories();
        return view("product.products",compact("products", "categories"));
    }

    public function create(){
        $categories = $this->categoryService->getAllCategories();
        return view("seller.productCreate",compact("categories"));
    }

    public function store(ProductCreateRequest $request){

        $data = $request->validated();
        $product=$this->productService->createProduct($data);
        if($product){
            return redirect()->route('product.create')->with('success', 'Product created successfully.');
        }else{
            return redirect()->route('product.create')->with('error', 'Failed to create product. Please try again.');
        }

    }

    public function productDetail($id){
       $product= $this->productService->getProductById($id);
       if($product){
            return view('product.productDetail',[
                'product'=>$product,

            ]);
        }else{
            return view('product.productDetail',['Error'=>'No product found']);
        }

    }

    public function filterByCategory(Request $request){
        $categoryId= $request->input('category_id');
        $products=$this->productService->getProducts($categoryId);
        if($products){
            return response()->json([
                "data" => $products,
                "status" => 'success'
            ]);
        }
        return response()->json([
                "data" => [],
                "status" => 'failed'
            ]);
    }




}
