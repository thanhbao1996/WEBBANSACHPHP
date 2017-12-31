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
							
							if (isset($_POST['MaLoaiSach']) && isset($_POST['TenLoaiSach']))
							{
								//lấy dữ liệu
								$MaLoaiSach=$_POST['MaLoaiSach'];
								$TenLoaiSach=$_POST['TenLoaiSach'];
								
								
								if (isset($_POST['NhapLoaiSach']))
								{
									if (empty($_POST['MaLoaiSach'])==true || empty($_POST['TenLoaiSach'])==true)
									{
										$strKetQua="Không được bỏ trống thông tin !";
									}
									else 
									{
									
									    
										$str_loai_sach_insert="INSERT INTO loaisach (MaLoaiSach,TenLoaiSach) VALUES (N'$MaLoaiSach',N'$TenLoaiSach')";
										
										//kiểm tra việc thêm dữ liệu vào database
										if (!mysql_query($str_loai_sach_insert))
										{
											$strKetQua="Không thể thêm dữ liệu !";
										}
										else {
											$strKetQua="Thêm loại sách mới thành công !";
										}
										
									}
								}
							}
							
							
						
						?>



		<form action="them_loai_sach.php" method="post">
		 <table width='100%' align="center" bgcolor="white">
		 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
		 	<td align='center' colspan='2'>
		 		<b><font color='white' size='6pt'>Thêm Loại Sách</font></b>
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
							<td width="200px"><b><font size="5">Mã loại sách : </font></b></td>
							<td style="padding:10px"><input type="text" name="MaLoaiSach" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							<tr>
							<td width="200px"><b><font size="5">Tên loại sách : </font></b></td>
							<td style="padding:10px"><input type="text" name="TenLoaiSach" style="width:200px; padding:5; font-size:20;"></td>
							</tr>
							
							
							
							<tr>
							<td width="200px"></td>
							<td style="padding:10px"><input type="submit" value="Nhập Loại Sách Mới" name="NhapLoaiSach" style="width:200px;padding:5;font-size:20; font-weight:bold;"></td>
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
