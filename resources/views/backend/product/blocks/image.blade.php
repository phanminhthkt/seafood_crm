<div class="photoUpload-zone">
  <div class="row">
    <div class="col-md-12">
      <label class="photoUpload-file" id="photo-zone" for="file-zone">
        <input type="file" name="file_photo" id="file-zone">
        <!-- <i class="fas fa-cloud-upload-alt"></i> -->
        <!-- <p class="photoUpload-drop">Kéo và thả hình vào đây</p> -->
        <!-- <p class="photoUpload-or">hoặc</p> -->
        <p class="photoUpload-choose btn btn-sm btn-outline-success"><i class="fas fa-cloud-upload-alt"></i> Chọn hình</p>
      </label>
    </div>
    <div class="col-md-12">
      <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded"  onerror="src='{{asset('backend/')}}/images/no-image.png'" src="{{URL::to('/uploads/products').'/'.@$item->photo}}" alt="Alt Photo"/></div>
    </div>
  </div>
</div>