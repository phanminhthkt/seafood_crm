<style type="text/css">
    .printBox{font-family: arial;}
    @page { size: auto;  margin: 0mm; }
</style>
<script type="text/javascript">
   window.print();
</script>
<div class="printBox">
    <div style="text-align:center; padding:10px 0 0;"><strong style="font-size:16px">HÓA ĐƠN ĐIỀU CHUYỂN HÀNG</strong></div>
    <table width="100%">
        <tbody>
            <tr>
                <td colspan="2" style="text-align:center; font-size:13px;">Ngày: {{formatDate($item->transfer_created_at,'d/m/Y H:i')}}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; font-size:13px;">Số HĐ: {{$item->code}}</td>
            </tr>
            <tr style="height: 20px;"></tr>
            <tr>
                <td style="text-align:left; font-size:13px;">
                    <p>Từ cửa hàng: {{$item->fromStore->name}}</p>
                    <p>Địa chỉ: {{$item->fromStore->address}}</p>
                    <p>Số điện thoại: {{$item->fromStore->phone}}</p>
                </td>

                <td style="text-align:left; font-size:13px;">
                    <p>Đến cửa hàng: {{$item->toStore->name}}</p>
                    <p>Địa chỉ: {{$item->toStore->address}}</p>
                    <p>Số điện thoại: {{$item->toStore->phone}}</p>
                </td>
            </tr>
            <tr style="height: 10px;"></tr>
        </tbody>
    </table>
    <table style="width:100%;" cellpadding="3" >
        <tbody>
            <tr>
                <td width="35%" style="width:35%; border-top:1px solid black; border-bottom:1px solid black;"><strong><span style="font-size:14px;">Đơn giá</span></strong></td>
                <td width="25%" style="text-align:right;width:30%; border-top:1px solid black; border-bottom:1px solid black;"><strong><span style="font-size:14px;">SL</span></strong></td>
                <td width="40%" style="text-align:right; border-top:1px solid black; border-bottom:1px solid black;"><strong><span style="font-size:14px;">T.Tiền</span></strong></td>
            </tr>
            @foreach($item->details as $v)
            <tr>
                <td colspan="3" style="padding-top:3px;">
                    <span style="font-size:14px;">{{$v->product_name}}</span>
                    (<span class='unit-val' style="font-size: 11px;">{{$v->product_unit}}</span>)  
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px dashed black;vertical-align: middle">
                    <span style="font-size:13px;">{{number_format($v->product_price, 0,'',',')}} đ</span>
                </td>
                <td style="text-align:right;border-bottom:1px dashed black;vertical-align: middle">
                    <span style="font-size:13px;">{{$v->product_quantity}}</span>
                </td>
                <td style="text-align:right;border-bottom:1px dashed black;vertical-align: middle">
                    <span style="font-size:13px;">{{number_format($v->product_price * $v->product_quantity, 0,'',',')}} đ</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table style="border-collapse:collapse;width: 100%; margin-top:20px;" cellpadding="3" border="0">
        <tfoot>
            <tr>
                <td style="text-align:right; font-weight:bold;font-size:11px; white-space:nowrap;">Tổng tiền hàng:</td>
                <td style="text-align:right; font-weight:bold;font-size:14px;">{{number_format($item->total_price, 0,'',',')}} đ</td>
            </tr>
        </tfoot>
    </table>
    <table style="margin-top:20px; width:100%">
        <tbody>
            <tr>
                <td style="font-size:13px; font-style:bold; text-align:center;word-break: break-word;">
                    Mọi thông tin đơn hàng và chính sách bảo hành vui lòng truy cập: https://xxx.com
                </td>
            </tr>
            <tr>
                <td style="font-size:13px; font-style:italic; text-align:center">Xin cảm ơn và hẹn gặp lại !</td>
            </tr>
        </tbody>
    </table>
</div>