<div class="multiple-upload-dev">
  <div class="form-group">
    <label for="filer-gallery" class="label-filer-gallery">Album hình: (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)
      <input type="file" name="file_photos[]" id="filer-gallery" class="multiple-image" multiple="multiple">
      <p class="multiple-upload-choose btn btn-outline-success"><i class="fas fa-cloud-upload-alt"></i> Chọn hoặc kéo nhiều hình vào đây</p>
      <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
      <input type="hidden" class="act-filer" value="man">
      <input type="hidden" class="folder-filer" value="product">
    </label>
  </div>
  <div class="gallery-preview">
    <div class="row row-preview">
        @if(isset($item->photos) && count($item->photos))
          @foreach(@$item->photos as $photo)
            <div class="col-md-3"> 
              <div class="card mt-2 mb-1 shadow-none border dz-processing dz-success dz-complete dz-image-preview"> 
                <div class="p-2 text-center"> 
                  <a class="btn btn-link btn-lg text-muted remove-image">
                    <i class="mdi mdi-close-circle" onclick="removeImage(this)"></i>
                  </a> 
                  <img style="height:100px;" 
                  class="rounded bg-light img-child" alt="" 
                  src="{{URL::to('/uploads/products').'/'.$photo->photo}}">
                  <input type="text" class="name-img" name="data_album[name][]" value="{{$photo->name}}" placeholder="Tiêu đề"> 
                  <input type="text" name="data_album[stt][]" value="{{$photo->is_priority}}" placeholder="Số thứ tự"> 
                  <input type="hidden" name="data_album[hidden][]" value="{{$photo->photo}}"> 
                </div> 
              </div> 
            </div>
          @endforeach
        @endif
    </div>
  </div>
</div>