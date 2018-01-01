<?php 
	session_start();
	$masach_get=$_REQUEST['masach'];
	$_SESSION['masach']=$_REQUEST['masach'];
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


			
		
						<?php 
						
								//Xử lý việc sửa sách		
								$strKetQua="";
					
								if (isset($_POST['SuaSach']))
								{
									//lấy dữ liệu
									$MaSach=$_GET['masach'];
									$TenSach=$_POST['TenSach'];
									$TacGia=$_POST['TacGia'];
									$TenNXB=$_POST['TenNXB'];
									$MoTa=$_POST['MoTa'];
									$DonGia=$_POST['DonGia'];
									$MaLoaiSach=$_POST['MaLoaiSach'];
									
									
										$tmp_name = $_FILES['AnhSach']['tmp_name'];
										
									    $file_name = $MaSach.".png";
										
																		
										
										
										//UPDATE sach SET TenSach=N'tên',AnhSach=N'ảnh.png',TacGia=N'tác giả',TenNXB=N'tên nhà xuất bản',MoTa=N'mô tả',DonGia='23456',MaLoaiSach=N'giaoduc' WHERE sach.MaSach='ss'
										$str_sach_update="UPDATE sach SET TenSach=N'$TenSach',AnhSach=N'$file_name',TacGia=N'$TacGia',TenNXB=N'$TenNXB',MoTa=N'$MoTa',DonGia='$DonGia',MaLoaiSach=N'$MaLoaiSach' WHERE sach.MaSach='$MaSach'";
										
//										echo $str_sach_update;
										
										
										//tiến hành upload
										move_uploaded_file($tmp_name,"C:\wamp\www\BaiTap\QuanLyBanSach\images\book\\".$file_name);
										
										
										//kiểm tra câu truy vấn đã được thực thi thành công hay chưa
										$result_update_sach= mysql_query($str_sach_update);
									
										
										if (!$result_update_sach)
										{
											$strKetQua="Lỗi cập nhật !";
										}
										else {
											$strKetQua="cập nhật thành công !";
										}
										
										
										
//								//nếu có file được chọn thì mới upload
//										if ($_FILES['AnhSach']['name']!=null)
//										{
//											//chỉ cho upload file ảnh
//											if ($_FILES['AnhSach']['type']=="image/jpeg" || $_FILES['AnhSach']['type']=="image/png" || $_FILES['AnhSach']['type']=="image/gif")
//											{
//												//kiểm tra dung lượng file <=8MB
////												if ($_FILES['AnhSach']['size'] > 307200)
////												{
////													$strKetQua="Dung lượng file không được quá 300kb";
////												}
////												else 
////												{
//													//tiến hành upload
//													move_uploaded_file($tmp_name,"C:\wamp\www\BaiTap\QuanLyBanSach\images\book\\".$file_name);
////												}
//											}
//											else {
//												$strKetQua= "Chỉ cho phép JPEG|PNG|GIF";
//											}
//											
//										}
//										else {
//											$strKetQua="Chưa chọn file !";
//										}
										
										
										
								}
								
								
							//Get nội dung vào input
								
								$str_get_one_sach="select * from sach where sach.MaSach='$masach_get'";
									$result_sach_get=mysql_query($str_get_one_sach);
									
									$ma_sach="";
									$ten_sach="";
									$anh_sach="";
									$tac_gia="";
									$ten_nxb="";
									$mo_ta="";
									$don_gia="";
									$ma_loai_sach="";
									
									
									while ($row_one_sach=mysql_fetch_array($result_sach_get))
									{
										$ma_sach=$row_one_sach['MaSach'];
										$ten_sach=$row_one_sach['TenSach'];
										$anh_sach=$row_one_sach['AnhSach'];
										$tac_gia=$row_one_sach['TacGia'];
										$ten_nxb=$row_one_sach['TenNXB'];
										$mo_ta=$row_one_sach['MoTa'];
										$don_gia=$row_one_sach['DonGia'];
										$ma_loai_sach=$row_one_sach['MaLoaiSach'];
									}
							
							
							
						?>




		<!-- https://www.youtube.com/watch?v=nGX-vRXiLyw -->

		<form action="edit_sach.php?masach=<?php echo $masach_get;?>" method="post" enctype="multipart/form-data">
		 <table width='100%' align="center" bgcolor="white">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Chỉnh Sửa Sách</font></b>
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
				
				
						<!-- giao diện thêm điện sách mới -->
						
							<tr>
							<td width="200px"><b><font size="5">Mã số sách : </font></b></td>
							<td style="padding:10px"><input type="text" name="MaSach" style="width:200px; padding:5; font-size:20;" disabled="disabled" value="<?php echo $ma_sach;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Tên sách : </font></b></td>
							<td style="padding:10px"><input type="text" name="TenSach" style="width:200px; padding:5; font-size:20;" value="<?php echo $ten_sach;?>"></td>
							</tr>
							
							<tr>
							<td width="200px" valign="top"><b><font size="5">Ảnh sách : </font></b></td>
							<td style="padding:10px"><input type="file"" name="AnhSach" style="width:200px; padding:5; font-size:20;">
							<p><img src="images/book/<?php echo $anh_sach;?>" style="width:200px;height:200px;" ></p>							
							</td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Tác giả : </font></b></td>
							<td style="padding:10px"><input type="text" name="TacGia" style="width:200px; padding:5; font-size:20;" value="<?php echo $tac_gia;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Nhà xuất bản : </font></b></td>
							<td style="padding:10px"><input type="text" name="TenNXB" style="width:200px; padding:5; font-size:20;" value="<?php echo $ten_nxb;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font  size="5">Mô tả : </font></b></td>
							<td style="padding:10px"><input type="text" name="MoTa" style="width:200px; padding:5; font-size:20;" value="<?php echo $mo_ta;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Đơn giá : </font></b></td>
							<td style="padding:10px"><input type="text" name="DonGia" style="width:200px; padding:5; font-size:20;" value="<?php echo $don_gia;?>"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Loại sách : </font></b></td>
							<td style="padding:10px">
							<!-- load loại sách -->
							
							
								<select name="MaLoaiSach" style="width:200px; padding:5; font-size:20;">
							
								 	<?php 
								 	
								 	foreach ($arrLoaiSach as $key => $value) {
										echo "<option value='$key'";
										if ($ma_loai_sach==$key)
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
							<td style="padding:10px"><input type="submit" value="Hoàn thành" name="SuaSach" style="width:200px;padding:5;font-size:20; font-weight:bold;"></td>
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
<td colspan="3" align="center" style="background-image:url('images/bg_footer.png'); background-size: 100% 150px;" height="150px"><b><font color="white" size="6pt" face="verdana,arial,sans-serif">Design & Develop By Group 5</font></b>

<p><b><font color="white" size="4pt" face="verdana,arial,sans-serif">Nha Trang University &reg; <?php echo date("Y");?></font></b></p>

</td>
</tr>

</table>



</body>

</html>
