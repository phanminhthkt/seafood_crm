<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
</head>
<html >
	<meta content="telephone=no" name="format-detection">
			<body style="margin:0px;">
				<div style="background: #fbfbfb;padding: 30px;">
					<div style="padding: 10px;max-width: 620px;margin:0 auto;background: #fff;border: 2px solid #0067c0;">
						
						<img src="{{asset('backend/')}}\images\logo-idtvn.png" alt="logo company">
						<table style="background:#fff;border-collapse:collapse;border-style:solid;border-color: #fff;border-bottom:1px solid #efefef;color: #696969;font-family: 'Nunito';margin-top:10px;font-size:10pt;" width="100%" cellspacing="0" cellpadding="0" border="1">
							<tbody>
								<tr>
									<td colspan="2" style="background-color: #0067c0;color:#fff;padding:8px;text-align: center;" width="220">
										<div style="font-size: 15px;font-weight:bold;text-transform: uppercase;">Thông Tin Lập Trình</div>
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px" width="28%"><strong>Nhân viên phụ trách</strong></td>
									<td style="padding:8px 8px">{{$item->dev->first()->name}} - <a href="mailto:$item->dev->first()->email" target="_blank">{{$item->dev->first()->email}}</a>
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Ngày nhận lập trình</strong></td>
									<td style="padding:8px 8px">
										{{\Carbon\Carbon::parse($item->begin_at)->format('d-m-Y H:i')}}
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Ngày dự kiến hoàn thành</strong></td>
									<td style="padding:8px 8px">
										{{\Carbon\Carbon::parse($item->estimated_at)->format('d-m-Y H:i')}}
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Ngày hoàn thành</strong></td>
									<td style="padding:8px 8px">
										{{\Carbon\Carbon::parse($item->ended_at)->format('d-m-Y H:i')}}
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Link hoàn thành</strong></td>
									<td style="padding:8px 8px">
										<a href="{{$item->link_end}}">{{$item->link_end}}
										</a>
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Tên đăng nhập</strong></td>
									<td style="padding:8px 8px">{{$item->username}}</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Mật khẩu</strong></td>
									<td style="padding:8px 8px">{{$item->password}}</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Ghi chú</strong></td>
									<td style="padding:8px 8px">{{$item->note_end}}</td>
								</tr>
										<tr>
									<td style="padding:8px 8px"><strong>Link up host</strong></td>
									<td style="padding:8px 8px"><a>{{$item->link_host}}</a></td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Ghi chú up host</strong></td>
									<td style="padding:8px 8px">{{$item->note_host}}</td>
								</tr>
										<tr>
									<td colspan="2" style="background-color: #0067c0;color:#fff;padding:8px;text-align: center;">
										<div style="font-size: 15px;font-weight: bold;text-transform: uppercase;">Thông Tin Hợp Đồng</div>
									</td>
								</tr>
										<tr>
								</tr>
								
								<!-- <tr>
									<td style="padding:8px 8px" width="220"><strong>Nhân viên phụ trách</strong></td>
									<td style="padding:8px 8px">{{$item->saler->first()->name}} - <a href="mailto:{{$item->saler->first()->email}}" target="_blank">{{$item->saler->first()->email}}</a> - 0931333759</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Tên hợp đồng</strong></td>
									<td style="padding:8px 8px">{{$item->name}}</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Mã hợp đồng</strong></td>
									<td style="padding:8px 8px">{{$item->contract_code}}</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Lĩnh vực kinh doanh</strong></td>
									<td style="padding:8px 8px">Nhôm Kính</td>
								</tr> -->
								<!-- <tr>
									<td style="padding:8px 8px"><strong>Nhân viên design</strong></td>
									<td style="padding:8px 8px">Vân</td>
								</tr> -->
								<!-- <tr>
									<td style="padding:8px 8px"><strong>Link design</strong></td>
									<td style="padding:8px 8px"><a href="{{$item->link_design}}" target="_blank">{{$item->link_design}} </a></td>
								</tr> -->
								<tr>
									<td style="padding:8px 8px"><strong>Mô tả chức năng</strong></td>
									<td style="padding:8px 8px">{{$item->function}}</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>File đặc tả lập trình</strong></td>
									<td style="padding:8px 8px">
					    				<a href="http://docs.google.com/gview?url={{public_path('uploads/files').$item->file}}&embedded=true">Click vào xem file</a>
									</td>
								</tr>
								<tr>
									<td style="padding:8px 8px"><strong>Ghi chú</strong></td>
									<td style="padding:8px 8px">{{$item->note}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			
		
	</body>
</html>