<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function index(Request $request) {
        $products = Product::paginate(6);
        
        $currentPage = $request->input('page', 1);
        if (! is_numeric($currentPage) || $currentPage < 1 || $currentPage > $products->lastPage()) {
            return redirect()->back();
        }

        return view('admin.product.index', compact('products'));
    }

    public function add() {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }

    public function insert(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cate_id' => 'required|integer',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $products = new Product();

        if ($request->has('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $resize = Image::make($file->getRealPath());
            $resize->resize(100, 100);
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/product' , $filename);

            $products->image = $filename;
        }

        $products->cate_id = $request->input('cate_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input( 'selling_price');
        $products->tax = $request->input('tax');
        $products->qty = $request->input('qty');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending') == TRUE ? '1': '0';

        $products->save();
        return redirect('products')->with('success', 'Product added successfully.');

    }

    public function edit($id) {
        $products = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('products', 'categories'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
    
        if ($request->hasFile('image')) {

    
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $resize = Image::make($file->getRealPath());
            $resize->resize(100, 100);
            $filename = time(). '.' . $ext;
    
            // Di chuyển và lưu trữ ảnh mới
            $file->move('assets/uploads/product/', $filename);
    
            // Cập nhật đường dẫn ảnh mới vào thuộc tính image
            $product->image = $filename;
        }
    
        // Cập nhật các thuộc tính khác
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->tax = $request->input('tax');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == true ? '1' : '0';
        $product->trending = $request->input('trending') == true ? '1' : '0';
    
        // Lưu các thay đổi vào cơ sở dữ liệu
        $product->save();
    
        return redirect('products')->with('success', 'Products updated successfully.');
    }

    public function search(Request $request) {

        $validator = Validator::make($request->all(), [
            'searchTerm' => 'required',
        ], [
            'searchTerm.required' => 'Please enter search keyword.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $searchTerm = $request->input('searchTerm');
        $productSearch = Product::where('name', 'like', '%'.$searchTerm.'%')->paginate(6);
        $currentPage = $request->input('page', 1);
        if (! is_numeric($currentPage) || $currentPage < 1 || $currentPage > $productSearch->lastPage()) {
            return redirect()->back();
        }
        return view('admin.product.index', ['productSearch' => $productSearch->appends(['searchTerm' => $searchTerm])]);
    }

    public function destroy($id) {
        $product = Product::find($id);

        if ($product->image) {
            $path = 'assets/uploads/category/'.$product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();
        return redirect('products')->with('success', 'Product deleted successfully.');
    }
}
