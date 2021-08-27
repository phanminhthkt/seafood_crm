  <template>
    <div>

    <!-- start page title -->
    <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <div class="page-title-left">
              <ol class="breadcrumb m-0">
                 <li class="breadcrumb-item"><a href=""><i class="remixicon-home-8-line"></i></a></li>
                 <li class="breadcrumb-item active">Dự án</li>
              </ol>
           </div>
        </div>
     </div>
  </div>
  <div class="row">
      <div class="col-12">
      </div>
  </div>
  <!-- end page title --> 
  <div class="row">
     <div class="col-12">
        <div class="card">
          <div class="card-header flex-wrap d-inline-flex justify-content-between py-1">
              <h4 class="card-title d-inline-block mb-0 py-1">Danh sách dự án
                <span class="text-success fs-15 ml-1">(Note - TT: Tình trạng)</span>
              </h4>
              <div class="d-inline-flex flex-wrap align-center mt-sm-0 mt-1">
                  <input type="text" v-model="search" placeholder="search..." class="select-custom mr-md-1 mb-1 mb-md-0  w-sm-100">
                  <select v-on:change="filterProject" class="select-custom" v-model="fdate">
                    <option v-for="(value) in listDate">{{value}}</option>
                  </select>
                  <select v-on:change="filterProject" class="select-custom" v-model="fyear">
                    <option v-for="(value) in listYear">{{value}}</option>
                  </select>
                  <select v-on:change="filterProject" class="select-custom" v-model="fstatus">
                    <option value="">Tất cả hợp đồng</option>
                    <option v-for="(value) in listStatus" :key="value.id" v-bind:value="value.id">{{value.name}}</option>
                  </select>
              </div>
              
          </div>

           <div class="card-body">
              <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                 <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                       <table id="basic-datatable" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="basic-datatable_info" >
                          <thead>
                             <tr role="row">
                                
                                <th width="3%" class="text-center">STT</th>
                                <th class="text-center"width="5%">Mã HĐ</th>
                                <th class="text-center"width="20%">Dự án</th>
                                <th width="10%" class="text-center">TT hợp đồng</th>
                                <th width="8%" class="text-center">TT lập trình</th>
                                <th width="8%" class="text-center">Tiến độ</th>
                                <th width="95px" class="text-center">Bắt đầu</th>
                                <th width="95px" class="text-center">Kết thúc</th>

                                <th width="10%"
                                v-if="$root.user.role === 'nhom-ky-thuat'" 
                                class="text-center">Hành động</th>
                                <th width="10%"  class="text-center">Thao tác</th>
                             </tr>
                          </thead>
                          <tbody>
                             <tr >
                               <tr 
                               v-for="(project, index) in filteredProject" 
                               :key="project.id"
                               role="row" 
                               class="even" 
                              >  
                                <td align="center">
                                 {{index+1}}
                                </td>
                                <td align="center">
                                    {{project.contract_code}}
                                </td>
                                <td align="">
                                  <div v-if="$root.user.role === 'nhom-kinh-doanh'" >
                                  <router-link :to="{ name: 'project.edit.sale' , params: { id: project.id }}">
                                    <span class="text-dark">{{project.name}}</span>
                                  </router-link>
                                </div>
                                  <div v-else>
                                    <span class="text-dark">{{project.name}}</span>
                                  </div>
                                </td>
                                
                                <td align="center">
                                  <a v-for="status_code in project.status_code">
                                    <span 
                                      :class="{
                                        'badge badge-warning': status_code.id === 1,
                                        'badge badge-info': status_code.id === 2,
                                        'badge badge-primary': status_code.id === 3
                                      }"
                                      >
                                      {{status_code.name}}
                                    </span>
                                  </a>
                                </td>
                                <td align="center">
                                  <a v-for="status_project in project.status_project">
                                    <span 
                                      :class="{
                                        'badge badge-purple': status_project.id === 4,
                                        'badge badge-danger': status_project.id === 5,
                                        'badge badge-dark': status_project.id === 6
                                      }"
                                      >
                                     {{status_project.name}}
                                    </span>
                                  </a>
                                </td>
                                <!-- <td align="center">
                                  <a v-for="dev in project.dev" v-if="dev.name!=''">
                                     {{dev.name}}
                                  </a>
                                  <a v-else>Chưa nhận</a>
                                </td>
                                <td align="center">
                                  <a v-for="saler in project.saler">
                                     {{saler.name}}
                                  </a>
                                </td> -->
                              <td align="center">
                                <div class="progress">
                                    <div 
                                      class="progress-bar bg-primary progress-bar-striped" role="progressbar" 
                                      v-bind:style="{'font-size':'10px',width:project.progress + '%'}"
                                      aria-valuemin="0" 
                                      aria-valuemax="100">
                                      {{project.progress}}%
                                  </div>
                                </div>
                              </td>
                              <td align="center">{{project.begin_at}}</td>
                              <td align="center">{{project.ended_at}}</td>
                              <td align="center" v-if="$root.user.role === 'nhom-ky-thuat'" >
                                 <button 
                                    v-check="{action:'view',component:'project'}"
                                    title="Xem dự án"
                                    class="btn waves-effect waves-light btn-purple mb-1"
                                    data-toggle="modal" data-target="#edit-close-modal" data-animation="fadein" data-plugin="custommodal"
                                    v-on:click="pushValuePopup(project.id)"
                                    >
                                    Báo cáo
                                  </button>
                              </td>  

                                <td align="center">
                                  <div class="d-inline">
                                    <button 
                                      v-check="{action:'view',component:'project'}"
                                      title="Xem dự án"
                                      class="btn btn-icon waves-effect waves-light btn-warning"
                                      data-toggle="modal" data-target="#con-close-modal" data-animation="fadein" data-plugin="custommodal"
                                      v-on:click="showValuePopup(project.id)"
                                      >
                                      <i class="mdi mdi-eye"></i>
                                    </button>
                                    
                                    <router-link 
                                    v-check="{action:'update',component:'project'}"
                                    :to="{ name: 'project.edit.sale' , params: { id: project.id }}"
                                    class="btn btn-icon waves-effect waves-light btn-success ml-1"
                                    title="Sửa dự án"
                                    >
                                    <i class="mdi mdi-pencil"></i>  
                                    </router-link>
                                    <!-- <a href="" 
                                      class="btn btn-icon waves-effect waves-light btn-info ml-1">
                                      <i class="mdi mdi-send-circle"></i>
                                    </a> -->
                                  </div>
                                  
                                </td>
                             </tr>

                          </tbody>
                       </table>
                       <transition name="bounce">
                         <Popup></Popup>
                       </transition>
                       <EditDev></EditDev>
                     </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
    </div>
    </div>
  </template>

<script>
    let now = new Date();
    import Popup from '../layouts/Popup.vue'
    import EditDev from '../project/EditDev.vue'
    export default {
      data() {
        return {
          listProjects: {},
          listDate:['01','02','03','04','05','06','07','08','09','10','11','12'],
          listYear:['2020','2021','2022'],
          listStatus:{},
          fdate: now.getMonth()+1 < 10 ? '0'+(now.getMonth()+1) : now.getMonth()+1,
          fyear:now.getFullYear(),
          fstatus:'',
          search:'',
        }
      },
      created() {
        this.getListProjects()
        this.getListStatus()
        
      },
      mounted() {
        this.$bus.on('data-edited', dataEdited => {
          let i = null
          this.listProjects.data.forEach(function(item, index) {
            if(item.id === dataEdited.id){
                i = index
            }
          })
          if(i!=null){
            this.listProjects.data[i].progress = dataEdited.progress
            this.listProjects.data[i].status_code = dataEdited.status_code
            this.listProjects.data[i].begin_at = dataEdited.begin_at
            this.listProjects.data[i].ended_at = dataEdited.ended_at
          }
        });
      },
      computed: {
        filteredProject() {
          if(this.listProjects.data){
            return this.listProjects.data.filter(project => {
              return project.name.toLowerCase().includes(this.search.toLowerCase())
            })
          }else{
            return this.listProjects.data
          }
        }
      },
      methods: {
          async pushValuePopup(id){
            try{
              const response =  await axios.get('/api/project/edit-dev/'+id)
              this.$bus.emit('data-project', response.data[0])
            }catch (error) {
              this.error = error.response.data
            }
          },
          async showValuePopup(id){
            try{
              const response =  await axios.get('/api/project/edit/'+id)
              this.$bus.emit('data-project', response.data[0])
            }catch (error) {
              this.error = error.response.data
            }
          },
          async getListProjects() {
            try {
              const response = await axios.get('/api/project')
              this.listProjects = response.data[0]
            }catch (error) {
              this.error = error.response.data
            }
          },
          async getListStatus() {
            try {
              const response = await axios.get('/api/status')
              this.listStatus = response.data[0]
            }catch (error) {
              this.error = error.response.data
            }
          },
          async filterProject(){
            try {
              const response = await axios.get('/api/project?time='+this.fyear+'-'+this.fdate+'&status='+this.fstatus+'')
              this.listProjects = response.data[0]
            }catch (error) {
              this.error = error.response.data
            }
          }, 
       },
        components: {
            Popup,
            EditDev,
        }
   }
</script>


 <style lang="scss" scoped>
  .select-custom{
    background: #f1f5f7;
    border: none;
    padding: 7px 7px;
    outline: none;
  }
  .select-custom option{
    background:#fff
  }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0;
    }
    .modal-enter {
      opacity: 0;
    }

    .modal-leave-active {
      opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }
</style>


