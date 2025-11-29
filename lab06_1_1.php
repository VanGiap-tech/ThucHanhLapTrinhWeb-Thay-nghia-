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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Lab6_1</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->
<style>
    fieldset {
        width: 50%;
        margin: 20px auto;
        padding: 10px;
        border: 2px solid lightskyblue;
        border-radius: 10px;
        background: transparent;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    legend {
        font-size: 22px;
		color: #333;
		padding: 3px 6px;
		background-color: WHITE;
		border-radius: 20px;
    }

    table {
        width: 100%;
    }

    td {
        padding: 5px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"],
    input[type="password"],
    textarea {
        width: 95%;
        padding: 3px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    textarea:focus {
        border: 2px solid lightcoral;
        outline: none;
    }

    textarea {
        height: 50px;
        resize: none;
    }

    input[type="submit"] {
        background: cornflowerblue;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
		box-shadow: 0 0 10px rgba(0,0,0,0.4);

    }

    input[type="submit"]:hover {
        background: lightskyblue;
    }
	
	.info {
		width: 90%;
        margin: 5px auto;
        padding: 10px;
        /* border: 2px solid lightblue; */
        border-radius: 5px;
        background: lightblue;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
	}
</style>

</head>

<body>
	<fieldset>
		<legend style="margin:0 auto; font-weight: bolder;">THÔNG TIN ĐĂNG KÍ</legend>
		<form action="lab06_1_1.php" method="post" enctype="multipart/form-data">
			<table align="center">
				<tr>
					<td>Tên đăng nhập:</td>
					<td><input type="text" name="username" placeholder="ít nhất 6 ký tự"
							value=""></td>
				</tr>
				<tr>
					<td>Mật khẩu:</td>
					<td><input type="password" name="password1" placeholder="ít nhất 8 ký tự" /></td>
				</tr>
				<tr>
					<td>Nhập lại mật khẩu:</td>
					<td><input type="password" name="password2" placeholder="" /></td>
				</tr>
				<tr>
					<td>Họ Tên:</td>
					<td><input type="text" name="name" placeholder="chứa ít nhất 2 từ" value="" /></td>
				</tr>
				<tr>
					<td>Thông tin:</td>
					<td><textarea name="thong_tin"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Đăng kí" name="submit"></td>
				</tr>
			</table>
		</form>
	</fieldset>

</div>
</body>

</html>
<?php
    if ($sm != "") {
        $err = "";
        if (strlen($username) < 6)         $err .= " Username ít nhất phải 6 ký tự!<br>";
        if ($password1 != $password2)     $err .= "Mật khẩu và mật khẩu nhập lại không khớp. <br>";
        if (strlen($password1) < 8)         $err .= "Mật khẩu phải ít nhất 8 ký tự.<br>";
        if (str_word_count($name) < 2)     $err .= "Họ tên phải chứa ít nhất 2 từ ";
        // 1. Loại bỏ các thẻ HTML trong thong_tin
        $thong_tin = strip_tags($thong_tin);
        // 2. Thay thế các ký tự xuống dòng (\n) bằng <br>
        $thong_tin = nl2br($thong_tin);
        // 3. Thêm dấu \ trước các ký tự nháy đơn ('), dùng addslashes
        $thong_tin_escaped = addslashes($thong_tin);
        // 4. Loại bỏ các ký tự \ trước các ký tự đặc biệt
        $thong_tin_escaped = stripslashes($thong_tin_escaped);
?>
    <div class="info">
        <?php
        if ($err != "") echo $err;
        else {
            echo "Username: $username <br>";
            $password_md5 = md5($password1);  // Mã hóa bằng MD5 (128bit) 32 ký tự
            $password_sha1 = sha1($password_md5); // Mã hóa kết quả MD5 bằng SHA1 (160bit) 40 ký tự
            $password_sha256 = hash('sha256', $password1); //sha256 64 ký tự HEX
            $password_sha3_256 = hash('sha3-256', $password1);

            echo "Mật khẩu đã mã hóa MD5: " . $password_md5 . "<br>";
            echo "Mật khẩu đã mã hóa SHA1: " . $password_sha1 . "<br>";
            echo "<hr>";
            echo "Mật khẩu đã mã hóa sha256: " . $password_sha256 . "<br>";
            echo "Mật khẩu đã mã hóa sha3-256: " . $password_sha3_256 . "<br>";
            echo "<hr>";
            echo "Họ tên: " . ucwords($name) . "<br>";
            echo "Thông tin đã xử lý: $thong_tin_escaped";
            // echo "Mã hóa MD5 file " .$file . ' :' . md5_file($file);
            // echo "<hr>";
            // echo "Mã hóa SHA1 file " .$file . ' :' . sha1_file($file);
            // echo "<hr>";
            // echo "Mã hóa văn bản với RIPEMD: " .hash('ripemd160',$password1) ;
            // echo "<hr>";
            // echo "Mã hóa nhị phân với RIPEMD: " .hash('ripemd160',$password1,TRUE) ;
            // echo "<hr>";

        }
        ?>
    </div>
    <?php
    }
    ?>