<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
</head>

<body style="margin:0;padding:0;background-color:#e9f8ec;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 10px;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#fff;border-radius:12px;border:1px solid #cce7d0;overflow:hidden">

                    <!-- HEADER -->
                    <tr>
                        <td align="center" style="padding:30px">
                            <h1 style="margin:0;color:#088178;letter-spacing:2px">TOY MARK</h1>
                            <h3 style="margin-top:10px;color:#212121">Đặt lại mật khẩu</h3>
                        </td>
                    </tr>

                    <!-- CONTENT -->
                    <tr>
                        <td style="padding:0 30px 20px;color:#465b52;font-size:15px;line-height:24px">
                            Xin chào,<br><br>
                            Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn tại
                            <strong>TOY MARK</strong>.
                            <br><br>
                            Nhấn vào nút bên dưới để tiếp tục:
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    <tr>
                        <td align="center" style="padding:20px">
                            <a href="{{ $url }}" style="display:inline-block;background:#088178;color:#fff;
                                  padding:14px 36px;border-radius:8px;
                                  text-decoration:none;font-weight:600">
                                ĐẶT LẠI MẬT KHẨU
                            </a>
                        </td>
                    </tr>

                    <!-- NOTE -->
                    <tr>
                        <td align="center" style="padding:0 30px 30px;font-size:13px;color:#9ca3af">
                            Nếu bạn không yêu cầu, vui lòng bỏ qua email này.
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center" style="background:#088178;color:#fff;padding:16px;font-size:14px">
                            © {{ date('Y') }} TOY MARK Store. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>