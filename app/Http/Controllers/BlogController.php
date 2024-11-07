<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;

        $blog = Blog::with('pengguna')
            ->where('title', 'like', "%" . $cari . "%")
            ->orWhere('content', 'like', "%" . $cari . "%")
            ->orWhere('category', 'like', "%" . $cari . "%")
            ->paginate(20);

        return view('page.blog.data-blog', compact('blog'));
    }
    public function delete($id)
    {
        $blog = Blog::find($id);
        $file = public_path() . '/thumbnail/' . $blog->image;
        if (file_exists($file)) {
            unlink($file);
        }
        $blog->delete();
        Alert::success('Success', 'Data Blog Berhasil Dihapus');

        return redirect()->route('blog');
    }

    public function create()
    {
        return view('page.blog.create-blog');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages)->flash();
            return back()->withErrors($validator)->withInput();
        }
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension(); //mengambil ekstensi file

            $request->file('image')->move(public_path() . '/thumbnail', $fileName); //mengupload file ke public/produk
            $blog->image = $fileName;
        }
        $blog->id_pengguna = auth()->user()->pengguna->id;

        $blog->save();
        // return redirect('/blog');

        // ])

        Alert::success('Success', 'Data Blog berhasil di tambahkan');

        return redirect()->route('blog');
    }
    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('page.blog.edit-blog', compact('blog'));
    }
    public function detail($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('page.blog.detail-blog', compact('blog'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages)->flash();
            return back()->withErrors($validator)->withInput();
        }
        $blog = Blog::where('id', $id)->first();
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;
        if ($request->hasFile('image')) {
            $file = public_path() . '/thumbnail/' . $blog->image;
            if (file_exists($file)) {
                unlink($file);
            }
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension(); //mengambil ekstensi file

            $request->file('image')->move(public_path() . '/thumbnail', $fileName); //mengupload file ke public/produk
            $blog->image = $fileName;
        }
        $blog->id_pengguna = auth()->user()->pengguna->id;
        $blog->update();

        Alert::success('Success', 'Data Blog berhasil di ubah');

        return redirect()->route('blog');
    }
}
