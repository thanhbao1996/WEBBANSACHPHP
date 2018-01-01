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



<!-- Xử lý việc đăng ký tài khoản -->

<?php 
$TenDangNhap="";
$MatKhau="";
$HoTen="";
$Email="";
$DienThoai="";

$strKetQua="(*) Không được bỏ trống !";

//kiểm tra tồn tại
if (isset($_POST['TenDangNhap'])&&isset($_POST['MatKhau']))
{
	//thực hiện việc lấy dữ liệu từ View
		$TenDangNhap=$_POST['TenDangNhap'];
		$MatKhau=$_POST['MatKhau'];
		$HoTen=$_POST['HoTen'];
		$Email=$_POST['Email'];
		$DienThoai=$_POST['DienThoai'];
	
	if (isset($_POST['DangKy']))
	{
		if ((empty($_POST['TenDangNhap'])==false) && (empty($_POST['MatKhau'])==false))
		{
			//kiểm tra tên tài khoản đã tồn tại chưa
			$strKiemTra="select * from taikhoan where taikhoan.TenDangNhap='$TenDangNhap'";
			if (mysql_num_rows(mysql_query($strKiemTra))==1)
			{
				$strKetQua="Tài khoản đã tồn tại trong hệ thống, vui lòng chọn tên tài khoản khác !";
			}
			else {
				//tiến hành thêm thành viên
				$strDangKy="INSERT INTO taikhoan (TenDangNhap,MatKhau,HoTen,Email,DienThoai,MaQuyen) VALUES (N'$TenDangNhap',N'$MatKhau',N'$HoTen',N'$Email',$DienThoai,'Member')";
				mysql_query($strDangKy);
				$strKetQua="Đăng ký thành công !";
			}
		}
		else {
			$strKetQua="Đăng ký thất bại, vui lòng điền đầy đủ thông tin !";
		}
	}
	
}


?>


<form action="dangky.php" method="post">
 
		 <table width='100%' align="center">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Đăng Ký</font></b>
		 	</td>
		 </tr>
		 
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Tên đăng nhập : </font></b></td>
		<td style="padding:10px"><input type="text" name="TenDangNhap" style="width:200px; padding:5; font-size:20;"><b><font color="red" size="4">*</font></b></td>
		</tr>
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Mật khẩu : </font></b></td>
		<td style="padding:10px"><input type="password" name="MatKhau" style="width:200px; padding:5; font-size:20;"><b><font color="red" size="4">*</font></b></td>
		</tr>
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Họ tên : </font></b></td>
		<td style="padding:10px"><input type="text" name="HoTen" style="width:200px; padding:5; font-size:20;"></td>
		</tr>
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Email : </font></b></td>
		<td style="padding:10px"><input type="text" name="Email" style="width:200px; padding:5; font-size:20;"></td>
		</tr>
		
		<tr>
		<td width="200px"><b><font color="red" size="5">Điện thoại : </font></b></td>
		<td style="padding:10px"><input type="text" name="DienThoai" style="width:200px; padding:5; font-size:20;"></td>
		</tr>
		
		<tr>
		<td width="200px"></td>
		<td style="padding:10px"><input type="submit" value="Đăng Ký" name="DangKy" style="width:200px;padding:5;font-size:20; font-weight:bold;"></td>
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
