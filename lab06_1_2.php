<?php
// Hàm postIndex dùng để lấy dữ liệu từ form POST
function postIndex($index, $value = "")
{
    // Nếu biến $_POST[$index] chưa được gửi lên thì trả về giá trị mặc định $value
    if (!isset($_POST[$index])) return $value;
    // Nếu có thì trả về dữ liệu sau khi loại bỏ khoảng trắng thừa ở đầu/cuối
    return trim($_POST[$index]);
}

// Lấy dữ liệu từ form với các trường tương ứng
$username   = postIndex("username");   // Lấy tên đăng nhập
$password1  = postIndex("password1");  // Lấy mật khẩu lần 1
$password2  = postIndex("password2");  // Lấy mật khẩu lần 2 (nhập lại)
$name       = postIndex("name");       // Lấy họ tên
$thong_tin       = postIndex("thong_tin");       // Lấy thong tin
$sm         = postIndex("submit");     // Lấy giá trị nút submit

?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Lab6_4.2</title>
  <style>
    fieldset {
      width: 50%;
      margin: 20px auto;
      padding: 10px;
      border: 2px solid orange;
      border-radius: 10px;
      background: #f9f9f9;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    legend {
      font-size: 22px;
      color: #333;
      padding: 3px 6px;
      background-color: #f9f9f9;
      border-radius: 20px;
    }

    .info {
      width: 600px;
      color: #006;
      background: #6FC;
      margin: 0 auto;
      padding: 10px;
    }

    input[type="submit"] {
      background: red;
      color: white;
      margin: 10px;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: background 0.3s;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);

    }

    input[type="submit"]:hover {
      background: orange;
    }

    #frm1 input {
      width: auto;
    }
  </style>
</head>

<body>
  <fieldset>
    <legend style="margin:0 auto; font-weight: bold;">ĐĂNG KÍ THÔNG TIN</legend>
    <form action="lab06_1_2.php" method="post" enctype="multipart/form-data" id='frm1'>
      <table align="center">
        <tr>
          <td width="120">UserName</td>
          <td width="317"><input type="text" name="username" value="" />*</td>
        </tr>
        <tr>
          <td>Mật khẩu</td>
          <td><input type="password" name="password" id="password" />*</td>
        </tr>
        <tr>
          <td></td>
          <td><input type="checkbox" onclick="displayPass()">Hiện mật khẩu</td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="text" name="email" value="" />*</td>
        </tr>
        <tr>
          <td>Ngày sinh "text"</td>
          <td><input type="text" placeholder="dd/mm/yyyy" name="date" value="" />*</td>
        </tr>
        <tr>
          <td>Ngày sinh "date"</td>
          <td><input type="date" name="date2" value="" />*</td>
        </tr>
        <tr>
          <td>Điện thoại</td>
          <td><input type="text" name="phone" value="" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" value="Đăng kí" name="submit"></td>
        </tr>
      </table>
    </form>
  </fieldset>

  <script>
    // Hàm hiện mật khẩu bằng JS
    function displayPass() {
      var passwordField = document.getElementById('password');
      var checkbox = document.querySelector('input[type="checkbox"]');
      if (checkbox.checked) {
        passwordField.type = 'text'; // Hiển thị mật khẩu
      } else {
        passwordField.type = 'password'; // Ẩn mật khẩu
      }
    }
  </script>
 </div></body>

</html>
<script>
  // Hàm hiện mật khẩu bằng JS
  function displayPass() {
    var passwordField = document.getElementById('password');
    var checkbox = document.querySelector('input[type="checkbox"]');
    if (checkbox.checked) {
      passwordField.type = 'text'; // Hiển thị mật khẩu
    } else {
      passwordField.type = 'password'; // Ẩn mật khẩu
    }
  }
</script>
<?php
// Xử lý để không hiện số 1 khi thỏa các điều kiện
// code here
if ($sm != "") {
?>
  <div class="info">
  <?php
// ... Đoạn mã PHP của bạn...

// Giả sử có biến $username, $password, $email, $phone, $date, $date2 được định nghĩa

// Hàm checkUsername được giả định (đang bị thiếu trong đoạn code bạn cung cấp)
if (checkUsername($username) == false) {
    echo "Username: Các ký tự được phép: a-z, A-Z, số 0-9, ký tự ., _ và - <br>";
}
// Kiểm tra MẬT KHẨU không hợp lệ
elseif (checkPassword($password) !== true) {
    // Nếu checkPassword trả về chuỗi lỗi, in nó ra.
    // Nếu nó trả về false, in thông báo lỗi chung.
    echo (is_string(checkPassword($password)) ? checkPassword($password) : "Mật khẩu không hợp lệ!<br>");
}
// Kiểm tra EMAIL
elseif (checkEmail($email) == false) {
    echo "Định dạng email sai!<br>";
}
// Kiểm tra SỐ ĐIỆN THOẠI
elseif (checksdt($phone) == false) {
    echo "Số điện thoại chỉ chứa ký tự số!<br>";
}
// Kiểm tra NGÀY SINH (dạng text input)
elseif (checkNgaySinh($date) == false) {
    echo "Ngày sinh 'text' phải theo định dạng dd/mm/yyyy hoặc dd-mm-yyyy!<br>";
}
// Kiểm tra NGÀY SINH (dạng date picker)
elseif (formatNgaySinh($date2) == false) {
    echo "Chưa chọn ngày sinh 'date'";
}
// Tất cả kiểm tra đều thành công
else {
    echo "✔️ Đăng kí thành công <br />";
}
// ...
?>
</div>
  </div>
<?php
}
?>