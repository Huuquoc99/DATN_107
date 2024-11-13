<!DOCTYPE html>
<html>
<head>
    <title>Đơn hàng của bạn đã bị hủy</title>
</head>
<body>
    <p>Chào {{ $order->user->name }},</p>
    <p>Chúng tôi xin thông báo rằng đơn hàng của bạn với mã đơn hàng <strong>{{ $order->id }}</strong> đã bị hủy theo yêu cầu của bạn.</p>
    <p>Chúng tôi xin lỗi về sự bất tiện này. Nếu bạn có bất kỳ câu hỏi nào hoặc cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi.</p>
    <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
</body>
</html>
