<?php
session_start(); // Bắt đầu session

// Hủy tất cả session
session_unset();
session_destroy();

// Trả về phản hồi thành công
header('Content-Type: application/json'); // Đặt kiểu phản hồi là JSON
echo json_encode(['success' => true, 'message' => 'Đăng xuất thành công']);
http_response_code(200); // Mã HTTP 200: Thành công
exit();
?>