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

<?php 
//lấy sách theo loại
$noidung=$_GET['noidung_timkiem'];
$KetQua="";
echo "<center><b><font color='red' size='5'>$KetQua</font></b></center>";
//kiểm tra biến chứa nội dung tìm kiếm
if (empty($noidung)==true)
{
	$KetQua="Chưa nhập nội dung tìm kiếm !";
	echo "<center><b><font color='red' size='5'>$KetQua</font></b></center>";
}
else {
	//bắt đầu công việc tìm kiếm
	$str_get_timkiem="SELECT * FROM sach WHERE TenSach LIKE '%$noidung%' OR TacGia LIKE '%$noidung%' OR TenNXB LIKE '%$noidung%' OR MoTa LIKE '%$noidung%'";
	$result_timkiem=mysql_query($str_get_timkiem); 
	//kiểm tra kết quả tìm được
	if (mysql_num_rows($result_timkiem)==0)
	{
		$KetQua="Không tìm thấy nội dung yêu cầu !";
		echo "<center><b><font color='red' size='5'>$KetQua</font></b></center>";
	}
	else {
		//hiển thị kết quả tìm được
			$KetQua="Những sách tìm được : ".mysql_num_rows($result_timkiem);
			echo "<center><b><font color='red' size='5'>$KetQua</font></b></center>";
		
			
					echo "<table width='100%'>
					 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
					 	<td align='center' colspan='2'>
					 		<b><font color='white' size='6pt'>Tìm Kiếm</font></b>
					 	</td>
					 </tr>
					 ";
					 
					 
					 
					//đưa loại sửa ra hàng thứ nhất
					while ($row=mysql_fetch_array($result_timkiem))
					{
						echo "<tr>";
						
						echo "<td width='200px' bgcolor='white'>"."<img src='images/book/".$row['AnhSach']."' style='width:200px;height:250px; padding:10;border-style: solid;border-color: green;'></td>";
						echo "<td valign='top' style='padding:20; border-style: dashed;border-top-color:green;border-bottom-color:green; border-left-color:white; border-right-color:white; ' bgcolor='white'>"."<b><font size=5pt>Tên sách : <font color='green'>".$row['TenSach'].
						"</font></b><p>"."Tác giả : <font color='blue'>".$row['TacGia']."</font></p>".
						"<p>"."Giá : <font color='red'>".$row['DonGia']." VNĐ</font></font></p>".
						"<p><center><a href='chitiet.php?masach={$row['MaSach']}'><img src='images/xemchitiet.png'>"."</a></center></p>"
						
						;
						echo "</td>";
						echo "</tr>";
					}
					
					echo "</table>";
	}
}




?>

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
