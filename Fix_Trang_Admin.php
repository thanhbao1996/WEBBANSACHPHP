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

		 <table width='100%' align="center" bgcolor="white">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Quản trị</font></b>
		 	</td>
		 </tr>
		 
		<?php 
				if (empty($_SESSION['TenDangNhap'])==true)
				{
					echo "<b><font color='red' size='5'>Vui lòng đăng nhập để vào trang này !</b></font>";
				}
				else {
					if ($_SESSION['MaQuyen']!='Admin')
					{
						echo "<b><font color='red' size='5'>Bạn không có quyền vào trang này..vui lòng liên hệ quản trị viên !</b></font>";
					}
					else 
					{
						//hiện thông tin cho quản trị viên
						echo "<tr><td>";
						echo "<p><b><font size='5'><a href='themsach.php'>1) Thêm Sách Mới</a></font></b></p>
							<b><hr color='red' size='3'></b>
							<p><b><font size='5'><a href='them_loai_sach.php'>2) Thêm Loại Sách Mới</a></font></b></p>
							<p><b><font size='5'><a href='sua_loai_sach.php'>3) Sửa Và Xóa Loại Sách</a></font></b></p>
							
							<b><hr color='red' size='3'></b>
							
							<p><b><font size='5'><a href='them_thanh_vien.php'>4) Thêm Thành Viên</a></font></b></p>	
							<p><b><font size='5'><a href='option_thanh_vien.php'>5) Sửa Và Xóa Thành Viên</a></font></b></p>	
						";
						echo "</td></tr>";
					}
				}
			
		
		?>
		 
		</table>

</td>

<!-- Menu Bên Phải -->
<td width="300" valign="top">

<?php 
	include 'right_column.php';
	?>

</td>
</tr>



<tr>
<td colspan="3" align="center" style="background-image:url('images/bg_footer.png'); background-size: 100% 150px;" height="150px"><b><font color="white" size="6pt" face="verdana,arial,sans-serif">Design & Develop By Group 5</font></b>

<p><b><font color="white" size="4pt" face="verdana,arial,sans-serif">Nha Trang University &reg; <?php echo date("Y");?></font></b></p>

</td>
</tr>

</table>



</body>

</html>
