@extends('layouts.template')

@section('content')

    <body>
        <div class="main-wrapper main-wrapper-1">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <div class="section-header-back">
                            <a href="{{ route('blog') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <h1>Blog Baru</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Blog</a></div>
                            <div class="breadcrumb-item">Blog Baru</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">Buat Blog Baru Anda</h2>
                        <p class="section-lead">
                            Di halaman ini anda bisa membuat blog baru.
                        </p>

                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('updateblog', $blog->id) }}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Tulis Blog Anda</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="title" value="{{ $blog->title }}">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <select class="form-control selectric" name="category">
                                                        <option value="Tech"{{ $blog->category == 'Tech' ? 'selected' : '' }}>Tech</option>
                                                        <option value="News" {{ $blog->category == 'News' ? 'selected' : ''  }}>News</option>
                                                        <option value="Agriculture" {{ $blog->category == 'Agriculture' ? 'selected' : ''  }}>Agriculture</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <textarea class="summernote-simple" name="content">{{ $blog->content }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <div id="image-preview" class="image-preview">
                                                        @if ($blog->image)
                                                            <img src="{{ asset('thumbnail/' . $blog->image) }}" alt="Current Thumbnail" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                                                        @endif
                                                        <label for="image-upload" id="image-label">Choose File</label>
                                                        <input type="file" name="image" id="image-upload" accept="image/*" />
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control inputtags" name="tags">
                                                </div>
                                            </div> --}}
                                            <!-- <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control selectric">
                            <option>Publish</option>
                            <option>Draft</option>
                            <option>Pending</option>
                          </select>
                        </div>
                      </div> -->
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <div class="col-sm-12 col-md-7">
                                                    <button class="btn btn-primary" type="submit">Create Post</button>
                                                </div>
                                            </div>
                                        </div>

                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
        </div>
    @endsection
