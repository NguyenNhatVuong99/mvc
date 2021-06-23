
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <body style="width:100% !important; margin:0 !important; padding:0 !important; -webkit-text-size-adjust:none; -ms-text-size-adjust:none; background-color:#F7F7F9;">
        <table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" style="height:auto !important; margin:0; padding:0; width:100% !important; background-color:#F7F7F9; color:#474747;">
            <tr>
                <td style="padding:50px 0;">
                    <div id="tablewrap" style="width:100% !important; max-width:600px !important; text-align:center !important; margin-top:0 !important; margin-right: auto !important; margin-bottom:0 !important; margin-left: auto !important;">
                        <table id="contenttable" width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF; text-align:center !important; margin-top:0 !important; margin-right: auto !important; margin-bottom:0 !important; margin-left: auto !important; border:none; width: 100% !important; max-width:600px !important; ">
                            <tr>
                                <td width="100%">
                                    
                                    <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="50" width="100%">
                                        <tr>
                                            <td width="100%" bgcolor="#ffffff" style="text-align:left;">
                                                <p style="color:#212121; font-family:Arial, Helvetica, sans-serif; font-size:28px; line-height:32px; margin-top:0; margin-bottom:10px; padding:0; font-weight: 600;">
                                                    Xin chào {{ $order->name }}
                                                </p>
                                                
                                                <p style="color:#212121; font-family:Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px; margin-top:0; margin-bottom:10px; padding:0; font-weight:normal; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px">
                                                Cảm ơn bạn đã đặt hàng tại shop
                                                </p>
                                                <p style="color:#212121; font-family:Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px; margin-top:0; margin-bottom:10px; padding:0; font-weight:normal; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px">
                                                Đơn hàng của bạn đã {{ $status }}
                                                </p>
                                                <table border="0" cellspacing="0" cellpadding="0" width="100%" class="emailwrapto100pc">
                                                    <tr>
                                                        <td class="emailcolsplit" align="left" valign="top" width="50%" style="padding-right: 20px;">
                                                            <h3 style="color:#212121; font-family:Arial, Helvetica, sans-serif; font-size: 28px; line-height: 30px; margin-bottom: 45px;">
                                  Thông tin
                                </h3>
                                <table valign="top" border="0" cellspacing="0" cellpadding="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px;">
                                  <tbody>
                                    <tr>
                                      <td valign="top" width="40%"><strong>Mã đơn hàng</strong><td>
                                      <td valign="top">{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                      <td valign="top" width="40%"><strong>Email</strong><td>
                                      <td valign="top">{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                      <td valign="top" width="40%"><strong>Số điện thoại</strong><td>
                                      <td valign="top">{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                      <td valign="top" width="40%"><strong>Thời gian</strong><td>
                                      <td valign="top">
                                        @php
                                        echo date_format($order->created_at,"H:i:s d/m/Y ");
                                    @endphp
                                      </td>
                                    </tr>
                                    <tr>
                                      <td valign="top" width="40%"><strong>Địa chỉ:</strong><td>
                                        <td valign="top">
                                          {{ $order->address }} <br />
                                          {{ $order->ward->name }}<br />
                                          {{ $order->district->name }} <br />
                                          {{ $order->province->name }} <br />
                                        </td>
                                    </tr>
                                    
                                  </tbody>
                                </table>
                                                        
                          <div style="border-top: 1px solid #f0f0f0; padding-top: 40px; margin-top: 40px;">
                            <a href="http://127.0.0.1:8000/user/order/show/{{ $order->id }}" style="color:#212121; font-family:Arial, Helvetica, sans-serif; font-size: 28px; line-height: 30px; margin-bottom: 45px;">
                              Chi tiết đơn hàng
                            </h3>
                           
                          </div>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </body>
    
</body>
</html>