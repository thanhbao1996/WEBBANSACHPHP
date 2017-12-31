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


			
		<!-- Xử lý việc thêm sách mới -->
						<?php 
							$strKetQua="";
							
							if (isset($_POST['MaSach']) && isset($_POST['TenSach']))
							{
								//lấy dữ liệu
								$MaSach=$_POST['MaSach'];
								$TenSach=$_POST['TenSach'];
								$TacGia=$_POST['TacGia'];
								$TenNXB=$_POST['TenNXB'];
								$MoTa=$_POST['MoTa'];
								$DonGia=$_POST['DonGia'];
								$MaLoaiSach=$_POST['MaLoaiSach'];
								
								if (isset($_POST['NhapSach']))
								{
									if (empty($_POST['MaSach'])==true || empty($_POST['TenSach'])==true)
									{
										$strKetQua="Không được bỏ trống mã sách và tên sách !";
									}
									else 
									{
										$tmp_name = $_FILES['AnhSach']['tmp_name'];
									    $file_name = $_POST['MaSach'].".png";
										
										//INSERT INTO sach (MaSach,TenSach,AnhSach,TacGia,TenNXB,MoTa,DonGia,MaLoaiSach) VALUES (N'a',N'ss',N'a.png',N'Tác giả',N'nhà cxuất bản',N'mô tả','555',N'laptrinh')
									    
										$str_sach_insert="INSERT INTO sach (MaSach,TenSach,AnhSach,TacGia,TenNXB,MoTa,DonGia,MaLoaiSach) VALUES (N'$MaSach',N'$TenSach',N'$file_name',N'$TacGia',N'$TenNXB',N'$MoTa','$DonGia',N'$MaLoaiSach')";
										
										mysql_query($str_sach_insert);
										
										move_uploaded_file($tmp_name,"C:\wamp\www\BaiTap\QuanLyBanSach\images\book\\".$file_name);
										$strKetQua="Thêm sách mới thành công !";
									}
								}
							}
							
							
						
						?>



		<form action="themsach.php" method="post" enctype="multipart/form-data">
		 <table width='100%' align="center" bgcolor="white">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Thêm Sách Mới</font></b>
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
							<td style="padding:10px"><input type="text" name="MaSach" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Tên sách : </font></b></td>
							<td style="padding:10px"><input type="text" name="TenSach" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Ảnh sách : </font></b></td>
							<td style="padding:10px"><input type="file"" name="AnhSach" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Tác giả : </font></b></td>
							<td style="padding:10px"><input type="text" name="TacGia" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Nhà xuất bản : </font></b></td>
							<td style="padding:10px"><input type="text" name="TenNXB" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font  size="5">Mô tả : </font></b></td>
							<td style="padding:10px"><input type="text" name="MoTa" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Đơn giá : </font></b></td>
							<td style="padding:10px"><input type="text" name="DonGia" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Loại sách : </font></b></td>
							<td style="padding:10px">
							<!-- load loại sách -->
							
							
								<select name="MaLoaiSach" style="width:200px; padding:5; font-size:20;">
								 	<?php 
								 	
								 	foreach ($arrLoaiSach as $key => $value) {
										echo "<option value='$key'>$value</option>";
								 	}
								 	
								 	?>
								</select>
								
							
							</td>
							</tr>
							
							<tr>
							<td width="200px"></td>
							<td style="padding:10px"><input type="submit" value="Nhập Sách Mới" name="NhapSach" style="width:200px;padding:5;font-size:20; font-weight:bold;"></td>
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

<table width='100%'>
 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%;'>
 	<td align='center' style='padding:20;'>
 		<b><font color='white' size='5pt'>Thông tin cá nhân</font></b>
 	</td>
 </tr>
 
 <tr bgcolor="white">
 <td>
 
 

 <?php 
 
  //tiến hành đăng xuất nếu có yêu cầu
 if (isset($_POST['DangXuat']))
 	{
 		unset($_SESSION['TenDangNhap']);
 	}
 
 	//tiến hành đăng nhập và kiểm tra quyền
 if(empty($_SESSION['TenDangNhap'])==true)
 {
 	echo "<b>Chào Khách, Vui lòng đăng nhập để được hỗ trợ tốt hơn !</b>";
 }
 else 
 {
 	echo "Tên đăng nhập : <b><font color='blue' size='5'>".$_SESSION['TenDangNhap']."</font></b><br />Chức năng : <b><font color='green' size='5'>".$_SESSION['TenQuyen']."</font></b>";
 	echo "<form action='dangnhap.php' method='post'><p><center><input type='submit' value='Đăng xuất' name='DangXuat'></center></p></form>";
 }
 ?>
 
 <!-- tạo button đăng xuất -->
 
 
 </td>
 </tr>
 
 
 	<!-- ô tìm kiếm -->
	<?php 
	include 'button_timkiem.php';
	?>
 </table>

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
