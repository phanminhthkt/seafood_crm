<template>
  <!-- start page title -->
  <div>
    <div class="row">
       <div class="col-12">
          <div class="page-title-box">
             <div class="page-title-left">
                <ol class="breadcrumb m-0">
                   <li class="breadcrumb-item">
                    <router-link :to="{ name: 'index'}" > 
                      <i class="remixicon-home-8-line"></i>
                    </router-link>
                  </li>
                    <li class="breadcrumb-item">
                      <router-link :to="{ name: 'project.index'}" > 
                        Dự án
                      </router-link>
                    </li>
                   <li class="breadcrumb-item active">Tạo dự án</li>
                </ol>
             </div>
          </div>
       </div>
       
      </div>
      <form role="form"  @submit.prevent="create" action="" enctype="multipart/form-data" novalidate>
       <div class="row d-flex flex-sm-row-reverse">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header py-2">
                <h5 class="card-title mb-0">File đặc tả</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="dropzone">
                  <div class="text-center">
                      <label for="file-taptin">
                        <p class="h1 text-muted"><i class="mdi mdi-cloud-upload"></i></p>
                        <h5>Kéo file vào đây</h5>
                        <div class="custom-file-dev fileupload">
                            <input 
                            type="file" 
                            class="custom-file upload" 
                            name="file"
                            ref="fileInput" 
                            id="file"
                            v-on:change="handleFileUpload()"
                          >
                        </div>
                        <div class="change-file"><b class="text-sm text-split text-danger"></b></div>
                      </label>
                      
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
                  <div class="form-group">
                    <label>Tên hợp đồng</label>
                      <div class="input-group">
                        <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        v-model="dataPost.name" 
                        placeholder="Hợp đồng" value="" required="">
                        <div class="invalid-feedback">Vui lòng nhập tên hợp đồng</div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label id="contract_code">Mã hợp đồng</label>
                    <input 
                    type="text" 
                    class="form-control" 
                    id="contract_code" 
                    v-model="dataPost.contract_code"
                    placeholder="Mã hợp đồng" 
                    value="" 
                    required="">
                    <div class="invalid-feedback">Vui lòng nhập mã hợp đồng</div>
                  </div>
                  <div class="form-group">
                    <label id="function">Chức năng</label>
                    <input 
                    type="text" 
                    class="form-control" 
                    id="function" 
                    v-model="dataPost.function"
                    placeholder="Mô tả chức năng" 
                    value=""
                    required="" 
                    >
                    <div class="invalid-feedback">Vui lòng nhập chức năng</div>
                  </div>
                  <div class="form-group">
                    <label id="link_design">Link design</label>
                    <input 
                    type="text" 
                    class="form-control" 
                    id="link_design" 
                    v-model="dataPost.link_design" 
                    placeholder="Link design"
                    >
                  </div>
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <div class="input-group">
                      <textarea 
                        rows="4" 
                        v-model="dataPost.note" 
                        id="note" 
                        class="form-control"
                      >
                      </textarea>
                    </div>
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
          return{
              message: {
                text: null,
                type: ''
              },
              dataPost :{
                name:'',
                contract_code:'',
                function:'',
                link_design:'',
                note:'',
                file: ''
              },
          }
      },
      
      mounted(){
        $('body').on('change','.custom-file-dev input[type=file]', function(){
          var fileName = $(this).val();
          fileName = fileName.substr(fileName.lastIndexOf('\\') + 1, fileName.length);
          $(this).siblings('label').html(fileName);
          $(this).parents("div.form-group").children(".change-photo").find("b.text-sm").html(fileName);
          $(this).parents("div.form-group  label").children(".change-file").find("b.text-sm").html(fileName);
        });
      },
      created(){
        this.checkPermission()
      },
      methods: {
        checkPermission(){
          if(window.__user__.role!='nhom-kinh-doanh'){
            this.$router.push({name: 'project.index'})
          }
        },
        handleFileUpload(){
            this.file = this.$refs.fileInput.files[0]
        },
        async create() {
             try {
              var data = new FormData()
              this.file !=null ? data.append('file', this.file) : ''
              data.append('name', this.dataPost.name)
              data.append('contract_code', this.dataPost.contract_code)
              data.append('link_design', this.dataPost.link_design)
              data.append('function', this.dataPost.function)
              data.append('id', window.__user__.id)
              data.append('note', this.dataPost.note)
              const response = await axios.post('/api/project/store',data)

              this.message.type="success"
              this.message.text=response.data.success
              this.$bus.emit('flash-message', this.message)
              this.$router.push({name: 'project.index'})

             }catch (error) {
                this.$bus.emit('flash-messages', error.response.data)
             }
         }
      },
   }
</script>


<style type="text/css">
	
</style>