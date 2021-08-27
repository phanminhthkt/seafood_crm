<template>
  <div id="edit-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Báo cáo tiến độ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="padding:0.6rem" v-if="data">
                   <div class="row d-flex">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Ngày bắt đầu</label>
                            <div class="input-group" v-if="data.begin_at==''">
                              <input 
                              type="datetime-local" 
                              class="form-control" 
                              id="name" 
                              v-model="data.begin_at" 
                              >
                            </div>
                            <p v-else class="p-alert alert alert-warning">{{data.begin_at}}</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Ngày dự kiến hoàn thành</label>
                            <div class="input-group" v-if="data.estimated_at==''">
                              <input 
                              type="datetime-local" 
                              class="form-control" 
                              id="name" 
                              v-model="data.estimated_at" 
                              >
                            </div>
                            <p v-else class="p-alert alert alert-danger">{{data.estimated_at}}</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Tiến độ</label>
                            <div class="input-group">
                              <input 
                              type="number" 
                              class="form-control" 
                              id="name" 
                              v-model="data.progress" 
                              >
                              <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Ngày kết thúc</label>
                            <div class="input-group" v-if="data.ended_at==''">
                              <input 
                              type="datetime-local" 
                              class="form-control" 
                              id="name" 
                              value=""
                              v-model="data.ended_at" 
                              >
                            </div>
                            <p v-else class="p-alert alert alert-primary">{{data.ended_at}}</p>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label id="contract_code">Link demo</label>
                          <input 
                          type="text" 
                          class="form-control" 
                          id="link_end" 
                          v-model="data.link_end"
                          placeholder="Link demo" 
                          >
                        </div>
                        <div class="form-group">
                          <label id="note_end">Ghi chú</label>
                          <textarea 
                            rows="3" 
                            v-model="data.note_end" 
                            id="note_end" 
                            class="form-control"
                          >
                          </textarea>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label id="contract_code">Link host</label>
                          <input 
                          type="text" 
                          class="form-control" 
                          id="link_host" 
                          v-model="data.link_host"
                          placeholder="Link up host" 
                          value="">
                        </div>
                        <div class="form-group">
                          <label id="note">Ghi chú</label>
                          <textarea 
                            rows="3" 
                            v-model="data.note_host" 
                            id="note" 
                            class="form-control"
                          >
                          </textarea>
                        </div>
                      </div>
                </div>
                   
                </div>
                  <div class="modal-footer">
                      <button type="button" v-if="data && data.link_host===null" v-on:click="sendMail()" class="btn btn-purple waves-effect waves-light mb-0"
                        v-html="buttonContent"
                      >
                      </button>
                      <button type="button" v-on:click="update()" class="btn btn-info waves-effect waves-light mb-0"><strong>Cập nhật</strong></button>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  export default {
      data() {
        return {
          message: {
            text: null,
            type: ''
          },
          data: null,
          buttonContent:'<strong>Gửi mail</strong>'
        };
      },
      mounted() {
        this.$bus.on('data-project', data => {
            this.data = data;
        });
      },
      methods: {
          async update() {
            try {
              var dataPost = new FormData()
              dataPost.append('begin_at', this.data.begin_at)
              dataPost.append('estimated_at', this.data.estimated_at)
              dataPost.append('ended_at', this.data.ended_at)
              dataPost.append('progress', this.data.progress)
              dataPost.append('link_host', this.data.link_host!=null ? this.data.link_host :'')
              dataPost.append('link_end', this.data.link_end!=null ? this.data.link_end :'')
              dataPost.append('note_end', this.data.note_end!=null ? this.data.note_end :'')
              dataPost.append('note_host', this.data.note_host!=null ? this.data.note_host :'')
              dataPost.append('_method', 'PUT')
              const response = await axios.post('/api/project/update-dev/'+this.data.id,dataPost)
              this.message.type="success"
              this.message.text=response.data.success
              this.$bus.emit('flash-message', this.message)
              const responseD = await axios.get('/api/project/edit-dev/'+this.data.id)
              this.$bus.emit('data-edited', responseD.data[0])
            }catch (error) {
              this.$bus.emit('flash-messages', error.response.data)
            }
          },
          async sendMail() {
            this.buttonContent = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
            try {
              const response = await axios.get('/api/project/send-mail/'+this.data.id)
              this.message.type="success"
              this.message.text=response.data.success
              this.$bus.emit('flash-message', this.message)
              this.buttonContent = '<strong>Gửi mail</strong>';
            }catch (error) {
                this.$bus.emit('flash-messages', error.response.data)
            }
          }     
       },
    };
</script>
<style>
  
</style>