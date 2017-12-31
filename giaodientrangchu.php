<?php 
session_start();

?>

<html>
<head>
<meta charset="utf-8">

<title>Cửa Hàng Sách Online</title>
 <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>

<body style="margin-top: 0px; background: #000000 url(images/bg.jpg);center top no-repeat fixed;background-size:100%;" >


<!-- thực hiện các kết nối đến cơ sở dữ liệu để thao tác -->
<?php 
//kết nối database
$connect=mysql_connect("localhost","root","") or die("Không thể kết nối đến cơ sở dữ liệu !");

//tên database và thông tin kết nối
mysql_select_db("cua_hang_sach",$connect);

mysql_query("set names 'utf8'",$connect);


//khởi tạo phiên làm việc



?>


<table border="0" cellpadding="2" cellspacing="2" style="border-collapse:collapse;margin-top: 0px;" width="1200px" align="center">

<tr>
<td colspan="3" align="center" bgcolor="white" style="background: #000000 url(images/banner.png); width:1200px; height:330px;"></td>
</tr>

<tr>
<td colspan="3" align="left" bgcolor="white">

<!--thanh navbar--> <?php 
		include 'navbar.php';
		?>


</td>
</tr>

<tr style="background: #000000 url(images/bg_td.jpg)">


<!-- menu trái -->
<td width="250" valign="top" background="#FFFFFF">

<table width="100%">

<tr>
<td>
<!-- lấy tất cả loại sách -->
<?php 
 $str_get_all_loai_sach="SELECT * FROM loaisach";
 $result_loaisach=mysql_query($str_get_all_loai_sach,$connect);
 
 
 echo "<table width='100%'>
 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%;'>
 	<td align='center' style='padding:20;'>
 		<b><font color='white' size='6pt'>Thể Loại Sách</font></b>
 	</td>
 </tr>
 ";
//đưa loại sửa ra hàng thứ nhất
while ($row=mysql_fetch_array($result_loaisach))
{
	echo "<tr style='background:url(images/bg_tr_1.png);background-size: 100% 100%;'><td style='padding: 15 15 15 15;'>";
	echo "<a href='loaisach.php?maloaisach={$row['MaLoaiSach']}' style='text-decoration:none'><b><font color='yellow' size='5pt'>".$row['TenLoaiSach']."</font></b></a>";
	echo "</td></tr>";
}

echo "</table>";

?>
</td>
</tr>

<tr>
<td>
<!-- dữ liệu dòng thứ 2 -->
</td>
</tr>
<tr>
<td><!-- dữ liệu dòng thứ 2 --></td>
</tr>
</table>


</td>



<td width="650" valign="top">

<!-- Xử lý việc đăng nhập tài khoản -->

<?php 
$TenDangNhap="";
$MatKhau="";
$strKetQua="";


//kiểm tra tồn tại
if (isset($_POST['TenDangNhap'])&&isset($_POST['MatKhau']))
{
	//thực hiện việc lấy dữ liệu từ View
		$TenDangNhap=$_POST['TenDangNhap'];
		$MatKhau=$_POST['MatKhau'];
		
	
	if (isset($_POST['DangNhap']))
	{
		if ((empty($_POST['TenDangNhap'])==false) && (empty($_POST['MatKhau'])==false))
		{
			//kiểm tra tên tài khoản đã tồn tại chưa
			$strKiemTra="SELECT TenDangNhap,MatKhau,HoTen,Email,DienThoai,taikhoan.MaQuyen,TenQuyen FROM taikhoan,quyentaikhoan WHERE taikhoan.MaQuyen=quyentaikhoan.MaQuyen AND taikhoan.TenDangNhap='$TenDangNhap'";
			$result_taikhoan=mysql_query($strKiemTra);
			if (mysql_num_rows($result_taikhoan)==1)
			{
				while ($row_taikhoan=mysql_fetch_array($result_taikhoan))
				{
					$strKetQua="Cảm ơn (".$row_taikhoan['TenDangNhap']."), đã đăng nhập thành công !";
					
					//khởi tạo session để lưu biến tên đăng nhập
					
					$_SESSION['TenDangNhap']=$row_taikhoan['TenDangNhap'];
					$_SESSION['MaQuyen']=$row_taikhoan['MaQuyen'];
					$_SESSION['TenQuyen']=$row_taikhoan['TenQuyen'];
				}
			}
			else {
				$strKetQua="Sai tên đăng nhập hoặc mật khẩu !";
			}
			
		}
		else {
			$strKetQua="Nhập thiếu tên đăng nhập hoặc mật khẩu !";
		}
	}
	
}


?>


<form action="dangnhap.php" method="post">
 
		 <table width='100%' align="center">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Đăng Nhập</font></b>
		 	</td>
		 </tr>
		 
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Tên đăng nhập : </font></b></td>
		<td style="padding:10px"><input type="text" name="TenDangNhap" style="width:200px; padding:5; font-size:20;"></td>
		</tr>
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Mật khẩu : </font></b></td>
		<td style="padding:10px"><input type="password" name="MatKhau" style="width:200px; padding:5; font-size:20;"></td>
		</tr>
		
		<tr>
		<td width="200px"></td>
		<td style="padding:10px"><input type="submit" value="Đăng Nhập" name="DangNhap" style="width:200px;padding:5;font-size:20; font-weight:bold;"></td>
		</tr>
		
		<!-- Thông báo -->
		<tr>
		<td></td>
		<td><label><b><font color="red" size="4"><?php echo $strKetQua;?></font></b></label></td>
		</tr>
		
		</table>

 </form> 




</td>
<td width="300" valign="top">

<?php 
	include 'right_column.php';
	?>

</td>
</tr>



<tr>
<td colspan="3" align="center" style="background-image:url('images/bg_footer.png'); background-size: 100% 150px;" height="150px"><b><font color="white" size="6pt" face="verdana,arial,sans-serif">Design & Develop By Group 9</font></b>

<p><b><font color="white" size="4pt" face="verdana,arial,sans-serif">HUTECH University &reg; <?php echo date("Y");?></font></b></p>

</td>
</tr>

</table>



</body>

</html>
