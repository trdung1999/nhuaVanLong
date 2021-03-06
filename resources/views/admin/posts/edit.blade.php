@extends('admin.layouts.app')

@section('title', 'Cập nhật bài viết')
@push('styles')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endpush
@section('content')
<div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Cập nhật bài viết</h4>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary float-right">Quay lại</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data" method="POST" data-toggle="validator">
                        @csrf
                        @method('put')
                        <div class="row">    
                            <div class="col-md-6 form-group">
                                <label>Danh mục bài viết</label>
                                <select name="post_category_id" class="form-control">
                                    @foreach ($postCategories as $id => $postCategory)
                                    <option value="{{ $id }}" {{ $post->postCategory->id == $id ? 'selected' : '' }}>
                                        {{ $postCategory }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-md-6 form-group">
                                    <label>Tên bài viết</label>
                                    <input type="text" name="name" value="{{ $post->name }}" class="form-control" placeholder="Nhập tên bài viết">                                                         
                            </div>     
                            <div class="col-md-3 form-group">
                                <label>Hình ảnh</label><br/>
                                <input type="file" name="image" onchange="loadPreview(this);">
                            </div>
                            <div class="col-md-9">
                                <label for="profile_image"></label>
                                <img id="preview_img" src="{{ $post->getFirstMediaUrl('posts') }}" width="200" height="150"/>
                            </div>
                            <div class="col-md-12">
                                <label for="tags" class="mr-4">Chủ đề bài viết</label>
                                @foreach ($tags as $id => $tag)
                                    <input type="checkbox" class="ml-3" name="tags[]" id="tag{{ $id }}" value="{{ $id }}"
                                    {{ (isset($post) && $post->tags->contains($id)) ? 'checked' : '' }}>
                                    <label for="tag{{ $id }}">{{ $tag }}</label>
                                @endforeach
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Mô tả bài viết</label>
                                <textarea name="short_description" class="form-control" rows="3">
                                    {{ $post->short_description }}
                                </textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Chi tiết bài viết</label>
                                <textarea name="description" id="description" class="form-control" rows="12">
                                    {{ $post->description }}
                                </textarea>
                            </div>
                        </div>                            
                        <button type="submit" class="btn btn-primary mr-2">Lưu lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
@push('scripts')
<script src="https://cdn.tiny.cloud/1/wl0hy3kumawhadevkqc4e81r6m900s5jbcbx30qu575s6ptk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>    
    {!! Toastr::message() !!}   
    
    <script>
        tinymce.init({
            selector: '#description',
          setup: (editor) => {
            editor.on('change', (e) => {
                editor.on('init change', function() {
                    editor.save();
                });
            })
          },
          plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste imagetools"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ],
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/upload',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];
    
                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                }
       });
      </script>
@endpush