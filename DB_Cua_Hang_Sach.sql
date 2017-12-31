-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2015 at 03:07 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cua_hang_sach`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `SoHD` int(11) default NULL,
  `MaSach` varchar(100) collate utf8_unicode_ci default NULL,
  `SoLuong` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`SoHD`, `MaSach`, `SoLuong`) VALUES
(1, 'S03', 3),
(3, 'S04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

CREATE TABLE `dondathang` (
  `SoHD` int(11) NOT NULL auto_increment,
  `DiaChi` varchar(100) collate utf8_unicode_ci default NULL,
  `TenDangNhap` varchar(100) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`SoHD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`SoHD`, `DiaChi`, `TenDangNhap`) VALUES
(1, '02 Nguyễn Đình Chiểu - Nha Trang -Khánh Hòa', 'hoahong'),
(3, '70 Thống Nhất-Nha Trang-Khánh Hòa', 'chiemquang');

-- --------------------------------------------------------

--
-- Table structure for table `gopy`
--

CREATE TABLE `gopy` (
  `TenDangNhap` varchar(100) collate utf8_unicode_ci NOT NULL,
  `TieuDeGopY` varchar(100) collate utf8_unicode_ci NOT NULL,
  `NoiDungGopY` varchar(1000) collate utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gopy`
--

INSERT INTO `gopy` (`TenDangNhap`, `TieuDeGopY`, `NoiDungGopY`) VALUES
('chiemquang', 'yêu sách', 'Sách rất hay.. Cám ơn các bạn...'),
('abc', 'em có chút ý kiến', 'qua 1 vòng lượn sơ...em thấy giao diện khá đẹp và nội dung khá hay...mong admin có thể cập nhật sách mới thường xuyền =))');

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `MaLoaiSach` varchar(100) collate utf8_unicode_ci NOT NULL,
  `TenLoaiSach` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaLoaiSach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`MaLoaiSach`, `TenLoaiSach`) VALUES
('giaoduc', 'Giáo Dục'),
('gioitinh', 'Giới Tính'),
('laptrinh', 'Lập Trình'),
('tieuthuyet', 'Tiểu Thuyết'),
('TNKH', 'Tự Nhiên Và Khoa Học'),
('truyentranh', 'Truyện Tranh');

-- --------------------------------------------------------

--
-- Table structure for table `quyentaikhoan`
--

CREATE TABLE `quyentaikhoan` (
  `MaQuyen` varchar(100) collate utf8_unicode_ci NOT NULL COMMENT 'Mã Quyền',
  `TenQuyen` varchar(100) collate utf8_unicode_ci NOT NULL COMMENT 'Tên Quyền',
  PRIMARY KEY  (`MaQuyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quyentaikhoan`
--

INSERT INTO `quyentaikhoan` (`MaQuyen`, `TenQuyen`) VALUES
('Admin', 'Administrator'),
('Member', 'Thành viên');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `MaSach` varchar(100) collate utf8_unicode_ci NOT NULL,
  `TenSach` varchar(100) collate utf8_unicode_ci default NULL,
  `AnhSach` varchar(100) collate utf8_unicode_ci default NULL,
  `TacGia` varchar(100) collate utf8_unicode_ci default NULL,
  `TenNXB` varchar(100) collate utf8_unicode_ci default NULL,
  `MoTa` varchar(100) collate utf8_unicode_ci default NULL,
  `DonGia` double default NULL,
  `MaLoaiSach` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaSach`),
  KEY `Ma` (`MaLoaiSach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`MaSach`, `TenSach`, `AnhSach`, `TacGia`, `TenNXB`, `MoTa`, `DonGia`, `MaLoaiSach`) VALUES
('a', 'Lập Trình C/C++', 'a.png', 'Lê Hoài Thanh', 'Giáo dục', 'Trang bị kiến thức cơ bản về lập trình', 25000, 'laptrinh'),
('anh', 'Ngôi nhà đá', 'anh.png', 'Nguyễn đăng khoa', 'a', 'a', 2345, 'tieuthuyet'),
('df', 'Cuộc Sống Quanh Ta', 'df.png', 'Nguyễn Du', 'Giáo dục', 'Trang bị những hiểu biết, kỹ năng sống cho người đọc ở mọi lứa tuổi', 13000, 'giaoduc'),
('S01', 'Thiết Kế và Lập Trình WEB', 'S01.png', 'Nguyễn Hoài Ân', 'Thanh Niên', 'hướng dẫn căn bản về lập trình web ', 43000, 'laptrinh'),
('S02', 'PHP and MySQL', 'S02.png', 'Trần Hữu Nghĩa', 'Giáo Dục', '', 75000, 'laptrinh'),
('ss', 'Lập Trình C# Với Visual Studio 2015', 'ss.png', 'Jayce', 'Khoa học', 'Cung cấp kiến thức lập trình nâng cao cho người đọc', 50000, 'laptrinh'),
('tddv', 'Thần Đồng Đất Việt', 'tddv.png', 'Nguyễn Văn Chung', 'Kim Đồng', 'Truyện hài thiếu nhi', 7500, 'truyentranh'),
('test', 'test', 'test.png', 'test', 'test', 'test', 0, 'giaoduc');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TenDangNhap` varchar(100) collate utf8_unicode_ci NOT NULL COMMENT 'Tên Đăng Nhập',
  `MatKhau` varchar(100) collate utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu ',
  `HoTen` varchar(100) collate utf8_unicode_ci default NULL COMMENT 'Họ Tên',
  `Email` varchar(100) collate utf8_unicode_ci default NULL COMMENT 'Email',
  `DienThoai` int(20) default NULL COMMENT 'Số điện thoại',
  `MaQuyen` varchar(100) collate utf8_unicode_ci default NULL COMMENT 'Quyền truy cập',
  PRIMARY KEY  (`TenDangNhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TenDangNhap`, `MatKhau`, `HoTen`, `Email`, `DienThoai`, `MaQuyen`) VALUES
('admin', '123', 'Admin', 'admin@gmail.com', 12345, 'Admin'),
('anhdayma1', '123', 'anhdayma', 'anhdayma@gmail.com', 1234567, 'Member'),
('anhdayma2', 'matkhau', 'Họ tên', 'email', 262345, 'Member'),
('chiemquang', 'huynhchiemquang', 'Huỳnh Chiếm Quang', 'chiemquangcth54@gmail.com', 23456789, 'Member'),
('hieupro', '123456789', 'Lương Văn Hiếu', 'vanhieucth54@gmail.com', 12385776, 'Admin'),
('hoahong', 'khongbiet', 'Nguyễn Thị Hoa Hồng', 'hoahong19@yahoo.com', 23456789, 'Member'),
('Kingleoric', '123456789', 'Mai Thanh Quang', 'quangmtcth54@gmail.com', 987473554, 'Admin'),
('nh0ckti', '123', 'Lê Quang Tuấn Anh', 'tuananhcth54@gmail.com', 19287474, 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `Ma` FOREIGN KEY (`MaLoaiSach`) REFERENCES `loaisach` (`MaLoaiSach`);
