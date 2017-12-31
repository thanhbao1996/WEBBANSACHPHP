-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 27, 2017 lúc 05:31 AM
-- Phiên bản máy phục vụ: 5.7.19
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cua_hang_sach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

DROP TABLE IF EXISTS `chitiethoadon`;
CREATE TABLE IF NOT EXISTS `chitiethoadon` (
  `SoHD` int(11) DEFAULT NULL,
  `MaSach` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`SoHD`, `MaSach`, `SoLuong`) VALUES
(1, 'S03', 3),
(3, 'S04', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondathang`
--

DROP TABLE IF EXISTS `dondathang`;
CREATE TABLE IF NOT EXISTS `dondathang` (
  `SoHD` int(11) NOT NULL AUTO_INCREMENT,
  `DiaChi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TenDangNhap` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SoHD`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dondathang`
--

INSERT INTO `dondathang` (`SoHD`, `DiaChi`, `TenDangNhap`) VALUES
(1, '02 Nguyễn Đình Chiểu - Nha Trang -Khánh Hòa', 'hoahong'),
(3, '70 Thống Nhất-Nha Trang-Khánh Hòa', 'chiemquang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gopy`
--

DROP TABLE IF EXISTS `gopy`;
CREATE TABLE IF NOT EXISTS `gopy` (
  `TenDangNhap` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TieuDeGopY` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NoiDungGopY` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gopy`
--

INSERT INTO `gopy` (`TenDangNhap`, `TieuDeGopY`, `NoiDungGopY`) VALUES
('chiemquang', 'yêu sách', 'Sách rất hay.. Cám ơn các bạn...'),
('abc', 'em có chút ý kiến', 'qua 1 vòng lượn sơ...em thấy giao diện khá đẹp và nội dung khá hay...mong admin có thể cập nhật sách mới thường xuyền =))');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisach`
--

DROP TABLE IF EXISTS `loaisach`;
CREATE TABLE IF NOT EXISTS `loaisach` (
  `MaLoaiSach` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TenLoaiSach` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaLoaiSach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisach`
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
-- Cấu trúc bảng cho bảng `quyentaikhoan`
--

DROP TABLE IF EXISTS `quyentaikhoan`;
CREATE TABLE IF NOT EXISTS `quyentaikhoan` (
  `MaQuyen` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã Quyền',
  `TenQuyen` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Quyền',
  PRIMARY KEY (`MaQuyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyentaikhoan`
--

INSERT INTO `quyentaikhoan` (`MaQuyen`, `TenQuyen`) VALUES
('Admin', 'Administrator'),
('Member', 'Thành viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

DROP TABLE IF EXISTS `sach`;
CREATE TABLE IF NOT EXISTS `sach` (
  `MaSach` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TenSach` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AnhSach` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TacGia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TenNXB` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MoTa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DonGia` double DEFAULT NULL,
  `MaLoaiSach` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaSach`),
  KEY `Ma` (`MaLoaiSach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
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
-- Cấu trúc bảng cho bảng `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `TenDangNhap` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Đăng Nhập',
  `MatKhau` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu ',
  `HoTen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Họ Tên',
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Email',
  `DienThoai` int(20) DEFAULT NULL COMMENT 'Số điện thoại',
  `MaQuyen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Quyền truy cập',
  PRIMARY KEY (`TenDangNhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
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
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `Ma` FOREIGN KEY (`MaLoaiSach`) REFERENCES `loaisach` (`MaLoaiSach`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
