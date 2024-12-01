<?php
namespace App\Traits;
use App\Models\Order;
trait VnPayTrait {
  public function processVNPAY(Order $order)
  {
      $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
      $vnp_Returnurl = route('checkout.vnpayReturn');
      $vnp_TmnCode = "PMEREN0U";
      $vnp_HashSecret = "0NQH7VYE8X3CW9DI89Q82RVHH5VWONZ0";
      $vnp_TxnRef = $order->code;
      $vnp_OrderInfo = 'Payment for Order #' . $order->id;
      $vnp_OrderType = 'OnlineShopping';
      $vnp_Amount = $order->total_price * 100;
      $vnp_Locale = 'vn';
      $vnp_BankCode = '';
      $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
      $inputData = array(
          "vnp_Version" => "2.1.0",
          "vnp_TmnCode" => $vnp_TmnCode,
          "vnp_Amount" => $vnp_Amount,
          "vnp_Command" => "pay",
          "vnp_CreateDate" => date('YmdHis'),
          "vnp_CurrCode" => "VND",
          "vnp_IpAddr" => $vnp_IpAddr,
          "vnp_Locale" => $vnp_Locale,
          "vnp_OrderInfo" => $vnp_OrderInfo,
          "vnp_OrderType" => $vnp_OrderType,
          "vnp_ReturnUrl" => $vnp_Returnurl,
          "vnp_TxnRef" => $vnp_TxnRef,
      );
      if ($vnp_BankCode != "") {
          $inputData['vnp_BankCode'] = $vnp_BankCode;
      }
      if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
          $inputData['vnp_Bill_State'] = $vnp_Bill_State;
      }
      ksort($inputData);
      $query = "";
      $i = 0;
      $hashdata = "";
      foreach ($inputData as $key => $value) {
          if ($i == 1) {
              $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
          } else {
              $hashdata .= urlencode($key) . "=" . urlencode($value);
              $i = 1;
          }
          $query .= urlencode($key) . "=" . urlencode($value) . '&';
      }
      $vnp_Url = $vnp_Url . "?" . $query;
      if (isset($vnp_HashSecret)) {
          $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
          $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
      }
      $returnData = array(
          'code' => '00',
          'message' => 'success',
          'data' => $vnp_Url
      );
      if (isset($_POST['redirect'])) {
          header('Location: ' . $vnp_Url);
          die();
      } else {
          echo json_encode($returnData);
      }
  }
}
