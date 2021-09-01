@extends('backend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="remixicon-home-8-line"></i> Danh mục</a></li>
               <li class="breadcrumb-item active">Thêm danh mục</li>
            </ol>
         </div>
      </div>
   </div>

   <div class="col-lg-8">
      <div class="card">
        <div class="card-header bg-purple py-2 text-white">
            <h5 class="card-title mb-0 text-white">THÔNG TIN CHI TIẾT</h5>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs nav-bordered">
            <li class="nav-item">
                <a href="#vi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Việt</span> 
                </a>
            </li>
            <li class="nav-item">
                <a href="#en" data-toggle="tab" aria-expanded="true" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Anh</span> 
                </a>
            </li>
            <li class="nav-item">
                <a href="#kr" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Hàn</span>  
                </a>
            </li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane fade active show" id="vi">
                <div class="form-group">
                  <label for="namevi">Tiêu đề (vi)</label>
                  <input type="text" class="form-control" id="namevi" placeholder="Tiêu đề vi" value="" required="">
                  <div class="invalid-feedback">Vui lòng nhập tiêu đề</div>
              </div>
              <div class="form-group">
                  <label for="motavi">Mô tả (vi)</label>
                  <textarea rows="4" name="motavi" id="motavi" class="form-control"></textarea>
              </div>
              <div class="form-group">
                  <label for="noidungvi">Nội dung (vi)</label>
                  <textarea rows="4" name="noidungvi" id="noidungvi" class="form-control"></textarea>
              </div>
            </div>
            <div class="tab-pane fade" id="en">Anh</div>
            <div class="tab-pane fade" id="kr">Hàn</div>
          </div>
        </div>
      </div>
   </div>
   <div class="col-lg-4">
      <div class="card">
        <div class="card-header bg-purple py-2 text-white">
            <h5 class="card-title mb-0 text-white">THÔNG TIN CHUNG</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
              <label id="slug">Đường dẫn</label>
              <input type="text" class="form-control" id="slug" placeholder="Đường dẫn" value="" required="">
          </div>
          
          <div class="form-group">
              <label>Danh mục</label>

              <select class="selectpicker">
                  <option>Mustard</option>
                  <option>Ketchup</option>
                  <option>Relish</option>
              </select>
          </div>
          <div class="form-group">
            <label id="code">Tải hình ảnh</label>
              <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                  <div class="fallback">
                      <input name="file" type="file">
                  </div>
                  <div class="photoUpload-detail" id="photoUpload-preview">
                    <!-- <img class="rounded" src="assets/images/noimage.png" onerror="src='assets/images/noimage.png'" alt="Alt Photo"> -->
                  </div>
                  <div class="dz-message needsclick">
                      <p class="h1 text-muted"><i class="mdi mdi-cloud-upload"></i></p>
                      <h5>Kéo và thả hình vào đây</h5>
                      <span class="btn btn-purple bg-gradient-primary text-white"><i class="mr-1 mdi mdi mdi-wallpaper"></i>Chọn hình</span>
                  </div>
              </form>
              <p class="text-muted font-13 m-b-30">
                  Hình: (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)
              </p>
          </div>
          <div class="form-group">
              <label id="code">Mã sản phẩm</label>
              <input type="text" class="form-control" id="code" placeholder="Mã sản phẩm" value="">
          </div>
          <div class="form-group">
              <label id="price">Giá bán</label>
              <div class="input-group">
                <input type="text" class="form-control" id="price" placeholder="Giá bán" value="">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon1">VNĐ</span>
                </div>
              </div>
          </div>
          <div class="form-group">
              <label id="price_old">Giá cũ</label>
              <div class="input-group">
                <input type="text" class="form-control" id="price_old" placeholder="Giá cũ" value="">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon1">VNĐ</span>
                </div>
              </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6 col-12">
                <div class="form-group">
                <label>Tình trạng</label>
                <select class="selectpicker" name="is_status">
                    <option>Hiển thị</option>
                    <option>Ẩn</option>
                </select>
              </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="priority">Thứ tự</label>
                    <input type="text" class="form-control" id="priority" placeholder="Thứ tự" value="">
                </div>
              </div>
            </div>
              
          </div>

        </div>
      </div>
   </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title m-t-0">Tải hình ảnh lên</h4>
                <p class="text-muted font-13 m-b-30">
                    Album hình: (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)
                </p>

                <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                    <div class="fallback">
                        <input name="file" type="file" multiple="">
                    </div>

                    <div class="dz-message needsclick">
                        <p class="h1 text-muted"><i class="mdi mdi-cloud-upload"></i></p>
                        <h3>Kéo và thả hình vào đây</h3>
                        <p class="text-muted font-13">--</p>
                        <span class="btn btn-purple bg-gradient-primary text-white"><i class="mr-1 mdi mdi mdi-wallpaper"></i>Chọn hình</span>
                    </div>
                </form>

                <!-- Preview -->
                <div class="dropzone-previews mt-3" id="file-previews"></div>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
   <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-purple py-2 text-white">
            <h5 class="card-title mb-0 text-white">THÔNG TIN SEO</h5>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs nav-bordered">
            <li class="nav-item">
                <a href="#seovi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Việt</span> 
                </a>
            </li>
            <li class="nav-item">
                <a href="#seoen" data-toggle="tab" aria-expanded="true" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Anh</span> 
                </a>
            </li>
            <li class="nav-item">
                <a href="#seokr" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Hàn</span>  
                </a>
            </li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane fade active show" id="seovi">
                <div class="form-group">
                  <label for="titlevi">Title (vi)</label>
                  <input type="text" class="form-control" id="titlevi" placeholder="Title" value="">
                </div>
                <div class="form-group">
                  <label for="keywordsvi">Keywords (vi)</label>
                  <input type="text" class="form-control" id="keywordsvi" placeholder="Keywords" value="">
                </div>
                <div class="form-group">
                  <label for="descriptionvi">Descriptions (vi)</label>
                  <textarea rows="4" name="descriptionvi" id="descriptionvi" class="form-control"></textarea>
              </div>
            </div>
            <div class="tab-pane fade" id="seoen">Anh</div>
            <div class="tab-pane fade" id="seokr">Hàn</div>
          </div>
      </div>
      </div>
   </div>
</div>


@endsection