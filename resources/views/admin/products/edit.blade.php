@extends('admin.layouts.app')

@section('title', 'Cập nhật sản phẩm')
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
                        <h4 class="card-title">Cập nhật sản phẩm</h4>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-primary float-right">Quay lại</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data" method="POST" data-toggle="validator">
                        @csrf
                        @method('put')
                        <div class="row">    
                            <div class="col-md-6 form-group">
                                <label>Danh mục sản phẩm</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $id => $category)
                                    <option value="{{ $id }}" {{ (isset($product) && $product->category->id == $id) ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>                                        
                                    @endforeach
                                </select>
                            </div>     
                            <div class="col-md-6 form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" name="name" value="{{ $product->name}}" class="form-control" placeholder="Nhập tên sản phẩm">                                                         
                            </div>     
                            <div class="col-md-3 form-group">
                                <label>Trọng lượng</label>
                                <input type="number" name="weight" value="{{ $product->weight }}" class="form-control" placeholder="Nhập trọng lượng sản phẩm">                                                         
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Dung tích</label>
                                <input type="number" name="capacity" value="{{ $product->capacity }}" class="form-control" placeholder="Nhập dung tích sản phẩm">                                                         
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Chu kỳ</label>
                                <input type="number" name="cycle" value="{{ $product->cycle }}" class="form-control" placeholder="Nhập chu kỳ sản phẩm">                                                         
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Số lượng</label>
                                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Nhập số lượng sản phẩm">                                                         
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Giá</label>
                                <input type="number" name="price" value="{{ $product->price }}" class="form-control" placeholder="Nhập giá sản phẩm">                                                         
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Màu sắc</label>
                                <input type="text" name="color" value="{{ $product->color }}" class="form-control" placeholder="Nhập màu sắc sản phẩm">                                                         
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Hình ảnh</label><br/>
                                <input type="file" name="image" onchange="loadPreviewImage(this);">
                                <img id="preview_img" class="mt-3" src="{{ $product->getFirstMediaUrl('products') }}" width="200" height="150"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Bản vẽ kỹ thuật</label><br/>
                                <input type="file" name="drawing" onchange="loadPreviewDrawing(this);">
                                <img id="preview_drawing" class="mt-3" src="{{ $product->getFirstMediaUrl('product_drawing') }}" width="200" height="150"/>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea name="short_description" class="form-control" rows="3">{{ $product->short_description }}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Chi tiết sản phẩm</label>
                                <textarea name="description" id="description" class="form-control" rows="12">
                                    {{ $product->description }}
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
      <script>
        function loadPreviewImage(input, id) {
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
        function loadPreviewDrawing(input, id) {
        id = id || '#preview_drawing';
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
@endpush