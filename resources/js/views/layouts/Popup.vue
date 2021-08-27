<template>
	<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xem dự án</h4>
                    <button type="button" @click.prevent="data = null" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="padding:0.6rem" v-if="data">
                    <div style="padding:8px;margin:0 auto;background:#fff;border:2px solid #0067c0">
						
						<table style="background:#fff;border-collapse:collapse;border-style:solid;border-color:#fff;border-bottom:1px solid #efefef;color:#696969;font-size:10pt" width="100%" cellspacing="0" cellpadding="0" border="1">
							<tbody>
								<tr>
									<td colspan="2" style="background-color:#0067c0;color:#fff;padding:8px;" width="220">
										<div style="font-size:13px;font-weight:bold;text-transform:uppercase">Thông Tin Lập Trình</div>
									</td>
								</tr>
								<tr>
									<td style="padding:8px" width="28%"><strong>Nhân viên phụ trách</strong></td>
									<td style="padding:8px" >
										<p v-for="dev in data.dev" v-if="dev.name!=''">
										{{dev.name}} - <a :href="'mailto:'+dev.email" target="_blank">{{dev.email}}</a>
										</p>
									</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Ngày nhận lập trình</strong></td>
									<td style="padding:8px">
										{{data.begin_at}}
									</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Ngày dự kiến hoàn thành</strong></td>
									<td style="padding:8px">
										{{data.estimated_at}}
									</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Ngày hoàn thành</strong></td>
									<td style="padding:8px">
										{{data.ended_at}}
									</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Link hoàn thành</strong></td>
									<td style="padding:8px">
										<a :href="data.link_end" target="_blank">
											{{data.link_end}}
										</a>
									</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Tên đăng nhập</strong></td>
									<td style="padding:8px">{{data.username}}</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Mật khẩu</strong></td>
									<td style="padding:8px">{{data.password}}</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Ghi chú</strong></td>
									<td style="padding:8px">{{data.note_end}}</td>
								</tr>
										<tr>
									<td style="padding:8px"><strong>Link up host</strong></td>
									<td style="padding:8px"><a>{{data.link_host}}</a></td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Ghi chú up host</strong></td>
									<td style="padding:8px">{{data.note_host}}</td>
								</tr>
										<tr>
									<td colspan="2" style="background-color:#0067c0;color:#fff;padding:8px;">
										<div style="font-size:13px;font-weight:bold;text-transform:uppercase">Thông Tin Hợp Đồng</div>
									</td>
								</tr>
										<tr>
								</tr>
								
								
								
								
								<tr>
									<td style="padding:8px"><strong>Mô tả chức năng</strong></td>
									<td style="padding:8px">{{data.function}}</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>File đặc tả lập trình</strong></td>
									<td style="padding:8px">
					    				<a 
                :href="'http://docs.google.com/gview?url=uploads/files/' + data.file + '&embedded=true'">
                <b class="text-success">Xem file</b></a>
									</td>
								</tr>
								<tr>
									<td style="padding:8px"><strong>Ghi chú</strong></td>
									<td style="padding:8px">{{data.note}}</td>
								</tr>
							</tbody>
						</table><div class="yj6qo"></div><div class="adL">
					</div></div>
                </div>
            </div>
        </div>
    </div>
    
</template>
<script>
	export default {
      data() {
        return {
          data: null,
        };
      },
      mounted() {
        this.$bus.on('data-project', data => {
            this.data = data;
        });
      }
    };
</script>