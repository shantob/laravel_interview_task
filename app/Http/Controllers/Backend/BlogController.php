<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();
        return view('backend.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',

        ]);
        $data = $request->all();
       // dd($data);
        if ($request->hasFile('image')) {
            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('/app/public/blogs'), $fileName);

            $data['image'] = '/storage/blogs/' . $fileName;
        }
        // dd($data);
        Blog::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'A Blog Created Successfully!');
    }


    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('backend.blog.edit', compact('blog'));
    }
    public function show($id)
    {
    //    
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $blog = Blog::find($id);
        if ($request->hasFile('image')) {
            $image = $blog->image;
            $image_path = public_path($image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $fileName = date('y-m-d') . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(storage_path('/app/public/blogs'), $fileName);

            $data['image'] = '/storage/blogs/' . $fileName;
        }
        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'A Blog Created Successfully!');

    }

    public function destroy($id)
    {
        $blogs = Blog::find($id);
        $image_path = public_path($blogs->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $blogs->delete();

        return redirect()->back()->with('success', 'Blog Delete Successfully');
    }
}
