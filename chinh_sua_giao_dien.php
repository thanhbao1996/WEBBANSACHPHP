<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">

<title>Cửa Hàng Sách Online</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>

<body
	style="margin-top: 0px; background: #000000 url(images/bg.jpg); center top no-repeat fixed; background-size: 100%;">


<!-- thực hiện các kết nối đến cơ sở dữ liệu để thao tác -->
<?php
include 'config.php';
?>


<table border="0" cellpadding="2" cellspacing="2"
	style="border-collapse: collapse; margin-top: 0px;" width="1200px"
	align="center">

	<tr>
		<td colspan="3" align="center" bgcolor="white"
			style="background: #000000 url(images/banner.png); width: 1200px; height: 330px;"></td>
	</tr>

	<tr>
		<td colspan="3" align="left" bgcolor="white"><!--thanh navbar--> <?php 
		include 'navbar.php';
		?></td>
	</tr>

	<tr style="background: #000000 url(images/bg_td.jpg)">


		<!-- menu trái -->
		<td width="250" valign="top" background="#FFFFFF"><?php 
		include 'left_column.php';
		?></td>


		<td width="650" valign="top"><!--load sách đồng thời xử lý phân trang-->
		<?php
		include 'content_page_home.php';
		?></td>

		<!-- Menu bên phải -->
		<td width="300" valign="top"><?php 
		include 'right_column.php';
		?></td>
	</tr>



	<?php
	include 'footer.php';
	?>

</table>



</body>

</html>
