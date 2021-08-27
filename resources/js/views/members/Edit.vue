<template>
  <!-- start page title -->
  <div>
    <div class="row">
       <div class="col-12">
          <div class="page-title-box">
             <div class="page-title-left">
                <ol class="breadcrumb m-0">
                   <li class="breadcrumb-item">
                    <route-link><i class="remixicon-home-8-line"></i></route-link>
                    </li>
                   <li class="breadcrumb-item active">Sửa thông tin</li>
                </ol>
             </div>
          </div>
       </div>
       <div class="col-12">
        </div>
     </div>
     <form 
      class='needs-validation'
      role="form" 
      method="POST" 
      action="" 
      enctype="multipart/form-data" 
      novalidate >
      <div class="row d-flex flex-sm-row-reverse">
       <div class="col-lg-4">
          <div class="card">
            <div class="card-header py-2">
                <h5 class="card-title mb-0">THÔNG TIN CHUNG</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                  <label>Nhóm</label>
                  <select class="selectpicker" data-live-search="true" name="group_id" id="group">
                  <option value="" >Chọn nhóm</option>
                    <option 
                      value="" 
                      
                    >
                   
                    </option>
                  </select>
                  <div class="invalid-feedback">Vui lòng chọn nhóm</div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6 col-12">
                    <div class="form-group">
                    <label>Tình trạng</label>
                    <select class="selectpicker" name="is_status">
                        <option value="1" > Hiển thị</option>
                        <option value="0" > Ẩn</option>
                    </select>
                  </div>
                  </div>
                  <div class="col-sm-6 col-12">
                    <div class="form-group">
                      <label id="priority">Thứ tự</label>
                        <input type="text" class="form-control" id="priority" name='is_priority' placeholder="Thứ tự" value="">
                    </div>
                  </div>
                </div>
                  
              </div>

            </div>
          </div>
       </div>
       <div class="col-lg-8">
          <div class="card">
            <div class="card-header py-2 text-white">
                <h5 class="card-title mb-0">THÔNG TIN CHI TIẾT</h5>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs nav-bordered">
                <li class="nav-item">
                    <a href="#vi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Tiếng Việt</span> 
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a href="#en" data-toggle="tab" aria-expanded="true" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Tiếng Anh</span> 
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a href="#kr" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-inline-block">Tiếng Hàn</span>  
                    </a>
                </li>
              </ul>
              <div class="tab-content">
                  <div class="tab-pane fade active show" id="vi">
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" id="username" name="username"  placeholder="Tên người dùng" value="" required="">
                          <div class="invalid-feedback">Vui lòng nhập username</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope"></i></span>
                          </div>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="" required="">
                          <div class="invalid-feedback">Vui lòng nhập email</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
                          </div>
                          <input type="password" class="form-control" id="password" name="password"  placeholder="Mật khẩu" value="" required="">
                          <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
                          </div>
                          <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" value="" required="">
                          <div class="invalid-feedback">Vui lòng xác nhận lại mật khẩu.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" value="" required="">
                          <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade d-none" id="en">Anh</div>
                <div class="tab-pane fade d-none" id="kr">Hàn</div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Submit</button>
          <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
       </div>
       
    </div>
    </form>
  </div>
</template>

<script>
   export default {
       data() {
           return {
               product: {
                   name: '',
                   price: 0
               },
               error: null
           }
       },
       methods: {
           async createProduct() {
               try {
                   this.error = null
                   const response = await axios.post('/products', {
                       name: this.product.name,
                       price: this.product.price
                   })
                   console.log(response.data.product)
               } catch (error) {
                   this.error = error.response.data
               }
           }
       }
   }
</script>


<style type="text/css">
	
</style>