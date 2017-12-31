<?php 
 $str_get_all_sach="SELECT * FROM sach";
 $result_sach=mysql_query($str_get_all_sach,$connect);
 
 
 
 //Xử lý phân trang dữ liệu 
 
//số hàng hiện có trong cơ sở dữ liệu
$numRow=mysql_num_rows($result_sach);
$numRowPerPage=3;
$maxPage=floor($numRow/$numRowPerPage)+1;

//gán trang mặc định khi chạy chương trình
if(!isset($_GET['page']))
{
	$_GET['page']=1;
}

//vị trí của mẫu tin đầu tiên khi load page
$offset=($_GET['page']-1)*$numRowPerPage;
 
//lấy về số sách hiển thị trên trang hiện tại
$str_get_sach_page="select * from sach limit $offset,$numRowPerPage";
$result_sach_per_page=mysql_query($str_get_sach_page);
 
 
 
 echo "<table width='100%'>
 <tr style='background:url(images/bg_tr.jpg);background-size: 100% 100%; margin-bottom:10;'>
 	<td align='center' colspan='2'>
 		<b><font color='white' size='6pt'>Sách Hiện Có</font></b>
 	</td>
 </tr>
 ";
//đưa loại sách ra hàng thứ nhất
while ($row=mysql_fetch_array($result_sach_per_page))
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

	echo "<br /><br /><div align='center'>";

	if($_GET['page']>1)
	{
		//tạo nút back
		echo "<a href=".$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."> <img src='images/prev.png' style='width:120;height:80;'></a>";
	}

	//tạo liên kết cho trang 
	for ($i = 1; $i <= $maxPage; $i++) {
		if ($i==$_GET['page'])
		{
			echo " <b><font size='6' color='red'>  Trang $i  </font></b>";
		}
		else {
			echo "<a href=".$_SERVER['PHP_SELF']."?page=".$i." STYLE='text-decoration: none'><font size='4'>   Trang $i  </font></b></a>";
		}
	}
	
	if ($_GET['page']<$maxPage) {
		//tạo nút next
	echo "<a href=".$_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."> <img src='images/next.png' style='width:120;height:80;'></a>";;
	}
	
	
	echo "</div><br /><br /><center>Tổng số trang : $maxPage</center>";
	

?>