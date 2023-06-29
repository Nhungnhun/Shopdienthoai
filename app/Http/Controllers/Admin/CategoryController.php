<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index(Request $request) {
        $category = Category::paginate(5);

        $currentPage = $request->input('page', 1);
        if (! is_numeric($currentPage) || $currentPage < 1 || $currentPage > $category->lastPage()) {
            return redirect()->back();
        }

        return view('admin.category.index', compact('category'));
    }

    public function add(){
        return view('admin.category.add');
    }

    public function insert(Request $request) {
        $category = new Category;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->has('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $resize = Image::make($file->getRealPath());
            $resize->resize(100, 100);
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/category' , $filename);

            $category->image = $filename;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->status = $request->input('status') == TRUE ? '1' : '0';

        $category->save();

        return redirect('categories')->with('success', 'Add category successfully.');

    }

    public function edit($id) {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);

        if ($request ->hasFile('image')) {
            $path = 'assets/uploads/category/'.$category->image;

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $resize = Image::make($file->getRealPath());
            $resize->resize(100, 100);
            $filename = time(). '.' . $ext;
            $file->move('assets/uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';

        $category->update();
        return redirect('categories')->with('success', 'Category update successfully.');
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
        $categorySearch = Category::where('name', 'like', '%'.$searchTerm.'%')->paginate(6);
        $currentPage = $request->input('page', 1);
        if (! is_numeric($currentPage) || $currentPage < 1 || $currentPage > $categorySearch->lastPage()) {
            return redirect()->back();
        }

        return view('admin.category.index', ['categorySearch' => $categorySearch->appends(['searchTerm' => $searchTerm])]);
    }

    public function destroy($id) {
        $category  = Category::find($id);

        if ($category->image) {
            $path = 'assets/uploads/category/'.$category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('categories')->with('success', 'Category deleted successfully.');
    }
}
