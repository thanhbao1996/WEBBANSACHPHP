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

$arrLoaiSach=array();
 
while ($row=mysql_fetch_array($result_loaisach))
{
	echo "<tr style='background:url(images/bg_tr_1.png);background-size: 100% 100%;'><td style='padding: 15 15 15 15;'>";
	echo "<a href='loaisach.php?maloaisach={$row['MaLoaiSach']}' style='text-decoration:none'><b><font color='yellow' size='5pt'>".$row['TenLoaiSach']."</font></b></a>";
	echo "</td></tr>";
	
	$maloaisach=$row['MaLoaiSach'];
	$tenloaisach=$row['TenLoaiSach'];
	$arrLoaiSach[$maloaisach]=$tenloaisach;
}

echo "</table>";

?>

<!--lấy tất cả mã quyền và tên quyền-->
<?php 
									
									

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


			
						<!-- Xử lý việc thêm thành viên -->
						<?php 
							
							$strKetQua="";
							$TenDangNhap=$_GET['tendangnhap'];
							

							//lấy thông tin thành viên đưa vào input
							$str_get_one_thanh_vien="select * from taikhoan WHERE TenDangNhap=N'$TenDangNhap'";
							$result_taikhoan=mysql_query($str_get_one_thanh_vien);
							while ($row_taikhoan=mysql_fetch_array($result_taikhoan))
							{
								$MatKhau=$row_taikhoan['MatKhau'];
								$HoTen=$row_taikhoan['HoTen'];
								$Email=$row_taikhoan['Email'];
								$DienThoai=$row_taikhoan['DienThoai'];
								$MaQuyen=$row_taikhoan['MaQuyen'];
							}
							
							
							//tiến hành sửa thành viên nếu được click
							if (isset($_POST['SuaThanhVien']))
							{
								//lấy lại dữ liệu từ input vào để tiến hành cập nhật
								$mat_khau=$_POST['MatKhau'];
								$ho_ten=$_POST['HoTen'];
								$email=$_POST['Email'];
								$dien_thoai=$_POST['DienThoai'];
								$ma_quyen=$_POST['MaQuyen'];
								$str_update_thanh_vien="UPDATE taikhoan SET MatKhau=N'$mat_khau', HoTen=N'$ho_ten',Email=N'$email', DienThoai='$dien_thoai', MaQuyen=N'$ma_quyen' WHERE TenDangNhap=N'$TenDangNhap'";
								
//								echo $str_update_thanh_vien;
								
								if (!mysql_query($str_update_thanh_vien))
								{
									$strKetQua="Lỗi cập nhật dữ liệu !";
								}
								else {
									$strKetQua="Cập nhật thành công !";
									//cập nhật lại thông tin sau khi sửa đổi
									$MatKhau=$mat_khau;
									$HoTen=$ho_ten;
									$Email=$email;
									$DienThoai=$dien_thoai;
									$MaQuyen=$ma_quyen;
								}
							}
							
						?>



		<form action="sua_thanh_vien.php?tendangnhap=<?php echo $TenDangNhap;?>" method="post">
		 <table width='100%' align="center" bgcolor="white">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Thêm Thành Viên</font></b>
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
				?>		
				
						
						
				
						<!-- giao diện thêm loại sách mới -->
						
							<tr>
							<td width="200px"><b><font size="5">Tên đăng nhập : </font></b></td>
							<td style="padding:10px"><input type="text" name="TenDangNhap" style="width:200px; padding:5; font-size:20;" value="<?php echo $TenDangNhap;?>" disabled="disabled"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Mật khẩu : </font></b></td>
							<td style="padding:10px"><input type="text" name="MatKhau" style="width:200px; padding:5; font-size:20;" value="<?php echo $MatKhau;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Họ tên : </font></b></td>
							<td style="padding:10px"><input type="text" name="HoTen" style="width:200px; padding:5; font-size:20;" value="<?php echo $HoTen;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Email : </font></b></td>
							<td style="padding:10px"><input type="text" name="Email" style="width:200px; padding:5; font-size:20;" value="<?php echo $Email;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Điện thoại : </font></b></td>
							<td style="padding:10px"><input type="text" name="DienThoai" style="width:200px; padding:5; font-size:20;" value="<?php echo $DienThoai;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Quyền hạn : </font></b></td>
							<td style="padding:10px">
							
							
							
							<select name="MaQuyen" style="width:200px; padding:5; font-size:20;">
							
								
								<?php 
									$str_get_all_MaQuyen="SELECT taikhoan.*,quyentaikhoan.TenQuyen FROM taikhoan,quyentaikhoan WHERE taikhoan.MaQuyen=quyentaikhoan.MaQuyen";
									$result_maquyen=mysql_query($str_get_all_MaQuyen);
									
									$arrMaQuyen=array();
									while ($row_maquyen=mysql_fetch_array($result_maquyen))
									{
										$maquyen=$row_maquyen['MaQuyen'];
										$tenquyen=$row_maquyen['TenQuyen'];
										$arrMaQuyen[$maquyen]=$tenquyen;
									}
								
								
									foreach ($arrMaQuyen as $key => $value) {
										echo "<option value='$key'";
										if ($key==$MaQuyen)
										{
											echo " selected='selected'";
										}
										echo ">$value</option>";
									}
									
									
								?>
							
							</select>
							
							</td>
							</tr>
							
							<tr>
							<td width="200px"></td>
							<td style="padding:10px"><input type="submit" value="Hoàn Thành" name="SuaThanhVien" style="width:200px;padding:5;font-size:20; font-weight:bold;"></td>
							</tr>
							
							<!-- Thông báo -->
							<tr>
							<td></td>
							<td><label><b><font color="red" size="4"><?php echo $strKetQua;?></font></b></label></td>
							</tr>
							
				<?php 		
					}
				}
			
		
		?>
		 
		</table></form> 

</td>

<!-- Menu Bên Phải -->
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


