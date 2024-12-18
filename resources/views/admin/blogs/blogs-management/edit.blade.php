@extends('admin.layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.blogs.edit', $blog) }}
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
                id="validation-form">
                @csrf
                @method('PATCH')
                <div class="custom-sec custom-sec--form">
                    <div class="custom-sec__header">
                        <div class="section-content">
                            <h3 class="heading">Edit Blog: {{ isset($title) ? $title : '' }}</h3>
                            <div class="permalink">
                                <div class="title">Permalink:</div>
                                <div class="title">
                                    <div class="full-url">{{ buildUrl(url('/'), 'blogs/') }}</div>
                                    <input value="{{ $blog->slug ?? '#' }}" type="button" class="link permalink-input"
                                        data-field-id="slug">
                                    <input type="hidden" id="slug" value="{{ $blog->slug ?? '#' }}" name="slug">
                                </div>
                            </div>
                        </div>
                        <a href="{{ buildUrl(url('/'), 'blogs', $blog->slug) }}" target="_blank" class="themeBtn">View
                            Blog</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Blog Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Title <span class="text-danger">*</span> :</label>
                                        <input type="text" name="title" class="field"
                                            value="{{ old('title', $blog->title) }}" placeholder="New Blog"
                                            data-error="Title">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-fields">
                                        <label class="title">Content <span class="text-danger">*</span> :</label>
                                        <textarea class="editor" name="content" data-placeholder="content" data-error="Content">
                                            {!! old('content', $blog->content) !!}
                                        </textarea>
                                        @error('content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Gallery <span class="text-danger">*</span> :</label>
                                        <div class="multiple-upload" data-upload-multiple>
                                            <input type="file" class="gallery-input d-none" multiple
                                                data-upload-multiple-input accept="image/*" id="gallery" name="gallery[]">
                                            <label class="multiple-upload__btn themeBtn" for="gallery">
                                                <i class='bx bx-plus'></i>
                                                Select Images
                                            </label>
                                            <div class="dimensions mt-3">
                                                <strong>Dimensions:</strong> 730 &times; 400
                                            </div>
                                            <ul class="multiple-upload__imgs" data-upload-multiple-images>
                                            </ul>
                                            <div class="text-danger error-message d-none" data-upload-multiple-error></div>
                                        </div>

                                    </div>
                                    @if (!$blog->media->isEmpty())
                                        <div class="form-fields">
                                            <label class="title">Current Gallery images:</label>
                                            <ul class="multiple-upload__imgs">
                                                @foreach ($blog->media as $media)
                                                    <li class="single-image">
                                                        <a href="{{ route('admin.media.delete', $media->id) }}"
                                                            onclick="return confirm('Are you sure you want to delete this media?')"
                                                            class="delete-btn">
                                                            <i class='bx bxs-trash-alt'></i>
                                                        </a>
                                                        <a class="mask" href="{{ asset($media->image_path) }}"
                                                            data-fancybox="gallery">
                                                            <img src="{{ asset($media->image_path) }}" class="imgFluid"
                                                                alt="{{ $media->alt_text }}" />
                                                        </a>
                                                        <input type="text" value="{{ $media->alt_text }}" class="field"
                                                            readonly>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    @endif
                                    <div class="form-fields">
                                        <label class="title">
                                            Right side top highlighted tour card
                                            <span class="text-danger">*</span> :
                                        </label>
                                        <select name="top_highlighted_tour_id" class="select2-select"
                                            {{ !$tours->isEmpty() ? '' : '' }}
                                            data-error="Right Side Top Highlighted Tour Card">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($tours as $tour)
                                                <option value="{{ $tour->id }}"
                                                    {{ old('top_highlighted_tour_id', $blog->top_highlighted_tour_id) == $tour->id ? 'selected' : '' }}>
                                                    {{ $tour->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('top_highlighted_tour_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-fields">
                                        @php
                                            $selectedTours = json_decode($blog->featured_tours_ids, true) ?? [];
                                        @endphp
                                        <label class="title">Below Blog Slider Tour Card <span class="text-danger">*</span>
                                            :</label>
                                        <select name="featured_tours_ids[]" multiple class="select2-select"
                                            data-max-items="4" placeholder="Select Tours"
                                            {{ !$tours->isEmpty() ? '' : '' }} data-error="Below Blog Slider Tour Card">
                                            @foreach ($tours as $tour)
                                                <option value="{{ $tour->id }}"
                                                    {{ in_array($tour->id, old('featured_tours_ids', $selectedTours)) ? 'selected' : '' }}>
                                                    {{ $tour->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('featured_tours_ids')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                </div>
                            </div>
                            <x-seo-options :seo="$seo ?? null" :resource="'blogs'" :slug="$blog->slug" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="seo-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Publish</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="publish"
                                            value="publish"
                                            {{ old('status', $blog->status ?? '') == 'publish' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="publish">
                                            Publish
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="status" id="draft"
                                            value="draft"
                                            {{ old('status', $blog->status ?? '') == 'draft' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="draft">
                                            Draft
                                        </label>
                                    </div>
                                    <button class="themeBtn ms-auto mt-4">Save Changes</button>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Author Settings</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Author <span class="text-danger">*</span> :</label>
                                        <select class="select2-select" name="user_id" data-error="Author">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($users as $users)
                                                <option value="{{ $users->id }}"
                                                    {{ old('user_id', $blog->user_id) == $users->id ? 'selected' : '' }}>
                                                    {{ $users->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Options</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Categories <span class="text-danger">*</span> :</label>
                                        <select name="category_id" class="select2-select" data-error="Category">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-fields">
                                        <label class="title">Tags <span class="text-danger">*</span> :</label>

                                        <select name="tags_ids[]" class="select2-select" multiple
                                            placeholder="Select tags">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ in_array($tag->id, old('tags_ids', $blog->tags->pluck('id')->toArray()) ?? []) ? 'selected' : '' }}>
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('tags_ids')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Feature Image</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <div class="upload" data-upload>
                                            <div class="upload-box-wrapper">
                                                <div class="upload-box {{ empty($blog->featured_image) ? 'show' : '' }}"
                                                    data-upload-box>
                                                    <input type="file" name="featured_image"
                                                        {{ empty($blog->featured_image) ? '' : '' }}
                                                        data-error="Feature Image" id="featured_image"
                                                        class="upload-box__file d-none" accept="image/*" data-file-input>
                                                    <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                    </div>
                                                    <label for="featured_image" class="upload-box__btn themeBtn">Upload
                                                        Image</label>
                                                </div>
                                                <div class="upload-box__img {{ !empty($blog->featured_image) ? 'show' : '' }}"
                                                    data-upload-img>
                                                    <button type="button" class="delete-btn" data-delete-btn><i
                                                            class='bx bxs-trash-alt'></i></button>
                                                    <a href="{{ asset($blog->featured_image) }}" class="mask"
                                                        data-fancybox="gallery">
                                                        <img src="{{ asset($blog->featured_image) }}"
                                                            alt="{{ $blog->feature_image_alt_text }}" class="imgFluid"
                                                            data-upload-preview>
                                                    </a>
                                                    <input type="text" name="feature_image_alt_text" class="field"
                                                        placeholder="Enter alt text"
                                                        value="{{ $blog->feature_image_alt_text }}">
                                                </div>
                                            </div>
                                            <div data-error-message class="text-danger mt-2 d-none text-center">Please
                                                upload a
                                                valid image file
                                            </div>
                                            @error('featured_image')
                                                <div class="text-danger mt-2 text-center">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="dimensions text-center mt-3">
                                            <strong>Dimensions:</strong> 270 &times; 260
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
