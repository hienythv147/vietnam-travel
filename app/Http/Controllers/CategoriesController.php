<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Category;
use Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:categories|max:200',
            'description' => 'required|max:220',
            'image' => 'required'
        ],[
            'title.required' => 'Yêu cầu nhập tiêu đề',
            'title.unique' => 'Tiêu đề đã được sử dụng',
            'description.required' => 'Yêu cầu nhập mô tả',
            'image.required' => 'Yêu cầu hình ảnh'
        ]);
        $category = new Categories();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->status =  $request->status == 'on' ? 1 : 0;
        $category->slug = Str::slug($request->title);
        // thêm hình ảnh 
        $get_image = $request->image;
        $path = 'uploads/categories';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $category->image = $new_image;
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        
        $file = "uploads/categories/".$category->image;
        $category->delete();
        // remove image
        if (file_exists($file)) {
            if (unlink($file)) {
                echo "Image '$file' đã được xóa thành công.";
            } else {
                echo "Xảy ra lỗi khi xóa file '$file'.";
            }
        } else {
            echo "Image '$file' không tồn tại.";
        }

        return redirect()->route("categories.index");
    }
}
