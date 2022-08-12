-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 18, 2022 lúc 12:42 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_bansach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaCTDH` int(11) NOT NULL,
  `MaDH` int(11) NOT NULL COMMENT 'Mã đơn hàng',
  `MaSach` int(11) NOT NULL COMMENT 'Mã sách',
  `SoLuong` int(5) NOT NULL COMMENT 'Số lượng sách trong đơn hàng',
  `ThanhTien` int(10) NOT NULL COMMENT 'Tiền sách sau khi nhân số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaCTDH`, `MaDH`, `MaSach`, `SoLuong`, `ThanhTien`) VALUES
(1, 1, 11, 2, 192000),
(2, 1, 17, 1, 148000),
(3, 3, 34, 1, 134400),
(4, 10, 60, 1, 54400),
(5, 10, 34, 2, 268800),
(6, 10, 48, 1, 76800),
(7, 10, 5, 1, 104000),
(11, 20, 48, 1, 76800),
(12, 21, 29, 2, 110400),
(14, 23, 12, 1, 118400),
(15, 24, 52, 1, 135200),
(16, 24, 11, 1, 96000),
(17, 24, 12, 2, 236800),
(18, 24, 60, 1, 54400),
(19, 25, 60, 1, 54400);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `MaCTGH` int(11) NOT NULL,
  `SoLuong` int(5) NOT NULL,
  `ThanhTien` int(10) NOT NULL,
  `MaSach` int(11) NOT NULL,
  `MaGioHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietgiohang`
--

INSERT INTO `chitietgiohang` (`MaCTGH`, `SoLuong`, `ThanhTien`, `MaSach`, `MaGioHang`) VALUES
(45035, 1, 76800, 48, 5),
(45036, 1, 96000, 11, 5),
(45038, 1, 76800, 48, 1),
(45039, 4, 540800, 52, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` int(11) NOT NULL,
  `TenDM` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_MaDM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDM`, `parent_MaDM`) VALUES
(1, 'Văn học Việt Nam', 0),
(2, 'Tiểu thuyết', 1),
(3, 'Truyện ngắn', 1),
(4, 'Thơ / Kịch', 1),
(5, 'Hồi ký / Phê bình / Tiểu luận', 1),
(6, 'Tạp bút / Tản văn', 1),
(7, 'Văn học Nước Ngoài', 0),
(8, 'Đương đại', 7),
(9, 'Lãng mạn', 7),
(10, 'Trinh thám / Kinh dị', 7),
(11, 'Kiếm hiệp', 7),
(12, 'Kinh điển', 7),
(13, 'Thơ / Kịch', 7),
(14, 'Hồi ký / Tiểu luận', 7),
(15, 'Huyền ảo / Giả tưởng', 7),
(16, 'Tạp văn / Tản bút', 7),
(17, 'Thiếu nhi', 0),
(18, 'Tuổi Teen', 17),
(19, 'Truyện tranh', 17),
(20, 'Thiếu nhi', 17),
(21, 'Thời sự / Chính trị', 0),
(22, 'Hồi ký / Tự truyện', 21),
(23, 'Thế giới hiện đại', 21),
(24, 'Khoa học tự nhiên / Nhân văn', 0),
(25, 'Lịch sử', 24),
(26, 'Triết học', 24),
(27, 'Tâm lý học', 24),
(28, 'Kinh tế', 24),
(29, 'Vũ trụ', 24),
(30, 'Sinh học', 24),
(31, 'Tham khảo', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` int(11) NOT NULL,
  `NgayLap` date NOT NULL COMMENT 'Ngày lập đơn hàng',
  `HoTenNguoiNhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ tên người nhận hàng',
  `SDTNguoiNhan` varchar(10) NOT NULL COMMENT 'Số điện thoại người nhận hàng',
  `EmailNguoiNhan` varchar(255) NOT NULL COMMENT 'Email người nhận hàng',
  `DiaChiNguoiNhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ nhận hàng',
  `PhiVanChuyen` int(10) NOT NULL COMMENT 'Phí vận chuyển',
  `TongTien` int(10) NOT NULL COMMENT 'Tổng tiền của đơn hàng',
  `TinhTrang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Trạng thái của đơn hàng',
  `GhiChu` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Ghi chú của khách hàng',
  `MaTK` int(11) NOT NULL COMMENT 'Mã tài khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDH`, `NgayLap`, `HoTenNguoiNhan`, `SDTNguoiNhan`, `EmailNguoiNhan`, `DiaChiNguoiNhan`, `PhiVanChuyen`, `TongTien`, `TinhTrang`, `GhiChu`, `MaTK`) VALUES
(1, '2022-04-13', 'Nguyễn Văn A', '0123456789', 'member@gmail.com', 'Số 10, Ba Đình, Hà Nội', 22000, 340000, 'completed', '', 2),
(2, '2022-04-01', 'Nguyễn Văn B', '0987654321', 'nguyenvanb@gmail.com', 'Số 28, Trần Duy Hưng, Hà Nội', 22000, 143200, 'completed', '', 2),
(3, '2022-05-05', 'Lương Bích Ngọc', '0963573231', 'ngoc1062000@gmail.com', '77 An Dương Vương, Phường Phương Lâm, Thành phố Hòa Bình, Tỉnh Hòa Bình', 22000, 134400, 'completed', NULL, 4),
(10, '2022-05-14', 'Bích Ngọc', '0123456789', 'member@gmail.com', '296 Bắc Từ Liêm', 22000, 504000, 'pending', '', 2),
(20, '2022-05-14', 'Nguyễn Văn A', '0987654321', 'member2@gmail.com', '77 - Tổ 3 - Đường An Dương Vương - Thành phố Hòa Bình - Tỉnh Hòa Bình', 22000, 76800, 'canceled', '', 4),
(21, '2022-05-14', 'Bích Ngọc', '0123456789', 'member@gmail.com', '296 Bắc Từ Liêm', 22000, 110400, 'canceled', '', 2),
(23, '2022-05-14', 'Nguyễn Văn C', '0123456789', 'snowcandy106@gmail.com', '88 Hồ Tùng Mậu', 22000, 118400, 'pending', '', 4),
(24, '2022-05-14', 'Bích Ngọc', '0123456789', 'member@gmail.com', '296 Bắc Từ Liêm', 22000, 522400, 'pending', '', 2),
(25, '2022-05-16', 'Bích Ngọc', '0123456789', 'member@gmail.com', '296 Bắc Từ Liêm', 22000, 54400, 'pending', '', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGioHang` int(11) NOT NULL,
  `MaTK` int(11) NOT NULL COMMENT 'Mã tài khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MaGioHang`, `MaTK`) VALUES
(1, 2),
(2, 4),
(3, 10),
(4, 12),
(5, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `MaSach` int(11) NOT NULL,
  `TenSach` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sách',
  `SoTrang` int(5) DEFAULT NULL COMMENT 'Số trang',
  `KichThuoc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Kích thước sách',
  `NgayPhatHanh` date DEFAULT NULL COMMENT 'Ngày phát hành sách',
  `Gia` int(10) NOT NULL COMMENT 'Giá của cửa hàng',
  `GiaGoc` int(10) NOT NULL COMMENT 'Giá bìa ',
  `SoLuongCo` int(5) NOT NULL COMMENT 'Số lượng có trong kho',
  `SoLuongBan` int(5) NOT NULL COMMENT 'Số lượng sách đã bán',
  `MoTa` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Mô tả sách',
  `AnhChup` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ảnh bìa sách',
  `TacGia` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tác giả',
  `DichGia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Dịch giả',
  `NXB` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nhà xuất bản',
  `MaDM` int(11) NOT NULL COMMENT 'Mã danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`MaSach`, `TenSach`, `SoTrang`, `KichThuoc`, `NgayPhatHanh`, `Gia`, `GiaGoc`, `SoLuongCo`, `SoLuongBan`, `MoTa`, `AnhChup`, `TacGia`, `DichGia`, `NXB`, `MaDM`) VALUES
(2, 'Thăm thẳm mùa hè', 336, '14 x 20.5 cm', '2018-09-26', 92000, 115000, 0, 100, 'Cô công chúa nhỏ ấy đã chết rồi. Tự sát ư? Xinh đẹp, thông minh, danh giá và một tương lai ngời ngời trước mặt, dường như cô chẳng có lý do gì để làm thế. Hay ai đã giết cô? Có thể lắm chứ, cha cô là một nhà chính trị và chắc hẳn không ít kẻ thù. Nhưng chẳng có gì trong những manh mối để lại cho thấy đó là một vụ giết người.\r\n\r\n \r\n\r\nNguyên, Thụy, Nam Phong, mỗi người đều bị ám ảnh về cô theo những cách khác nhau, và đi tìm câu trả lời theo những cách khác nhau, để rồi đều nhận ra vị của trái táo xanh mùa hè năm nào, vị của thanh xuân, đã trở nên đắng ngắt.\r\n\r\n \r\n\r\nVới Thăm thẳm mùa hè, Nguyễn Dương Quỳnh lần đầu tiên thách thức mình với trinh thám, một thể loại gần như còn trống vắng trong văn học Việt.', 'tham-tham-mua-he.jpg', 'Nguyễn Dương Quỳnh', '', 'Hội nhà văn', 2),
(3, 'Ký túc xá phòng 307', 176, '14 x 20.5 cm', '2019-11-29', 55200, 69000, 0, 100, '“Thời sinh viên, trong tôi, ý nghĩ trở thành vĩ nhân luôn thường trực.\r\nBill Gates, Steve Jobs, Mark Zuckerberg.\r\nĐặc điểm chung của các vĩ nhân là họ luôn bỏ ngang đại học.\r\nSuốt năm năm ngồi trên giảng đường, ý nghĩ “mình sẽ bỏ học” lóe lên trong đầu\r\ntôi 226 lần. Nhưng rốt cuộc, tôi không đi theo tiếng gọi của các vĩ nhân. Tôi hoàn\r\nthành 180 tín chỉ học phần. Tốt nghiệp đại học, cầm tấm bằng đỏ chót, rồi lao vào\r\nđời.”\r\nNhững câu chuyện chân thực, hài hước, mang nhiều niềm vui xen lẫn những nỗi\r\nngậm ngùi của những cậu sinh viên nghèo sống trong Ký túc xá phòng 307.\r\nMột cuốn sách dành tặng cho những ai đã-đang-và-sẽ là sinh viên.', 'ky-tuc-xa-phong-307.jpg', 'Zihua Nguyễn', NULL, 'Hội nhà văn', 3),
(4, 'California Universities & colleges và những điều cần biết khi đi du học Hoa Kỳ', 262, '14 x 20.5 cm', '2019-04-04', 68000, 85000, 50, 80, '“… Nhưng, ở một bình diện quan trọng hơn, thì Dân Trí được nâng cao cũng là nền tảng giúp bảo đảm sự Công bằng trong xã hội và tinh thần Dân chủ trong chính trị nhằm mở rộng hơn nữa cánh cửa Tự do của tư duy. Dân trí được nâng cao thì cũng phong phú hoá đời sống người dân về khía cạnh Văn hoá và Nhân văn, giúp thăng hoa con người một cách cân bằng hơn.\r\n\r\n \r\n\r\n… Cuốn sách này chỉ trình bày sơ lược về hệ thống giáo dục đại học của Hoa Kỳ. Ước mong trong tương lai sẽ có những khảo cứu tương tự về nền giáo dục đại học của các quốc gia tiền tiến khác, từ Âu sang Á, để những cá nhân và cơ chế có trách nhiệm tìm hiểu và rút tỉa được kinh nghiệm nhằm áp dụng vào nỗ lực đổi mới nền giáo dục hậu trung học, giúp người trẻ Việt Nam vươn lên và quê hương sớm được phú cường.”\r\n\r\n \r\n\r\n“Tôi nghĩ rằng đây sẽ là nguồn tư liệu quý báu cho bất kỳ ai mong muốn tìm hiểu về hệ thống giáo dục ‘hậu trung học’ của Hoa Kỳ nói chung và bang California nói riêng. Cuốn sách đồng thời cũng là nguồn tham khảo hữu ích cho công cuộc cải cách giáo dục Đại học tại Việt Nam.”\r\n\r\n- PGS.TS.KTS Phạm Tứ, Hiệu trưởng ĐH Kiến trúc Tp. HCM, thư ngày 20/6/2013', 'california-universities-&-colleges-va-nhung-dieu-can-biet-khi-di-du-hoc-hoa-ky.jpg', 'Đỗ Hữu Tâm', NULL, 'Thế Giới', 3),
(5, 'Bài thơ của một người yêu nước mình', 210, '14 x 20.5 cm', '2020-12-31', 104000, 130000, 49, 51, '\"Thơ của Trần Vàng Sao chính là cuộc đời ông. [...] Thơ ông hiện ra như chính áo quần ông, tóc tai ông, hơi thở ông, ánh mắt ông, giọng nói ông, cảm giác ông, mồ hôi ông, đau đớn ông, giận dữ ông, giày vò ông, tuyệt vọng ông, khát vọng ông... và nhịp đập trái tim ông là thứ kỳ diệu nhất gắn kết toàn bộ những gì thuộc về ông để vang lên thành thi ca. Bởi thế, thơ ông chân thực và mãnh liệt như máu chảy trong huyết quản ông.\r\n\r\n[...] Trần Vàng Sao là một thi sĩ chân chính đến trầm luân, Trần Vàng Sao là một người yêu nước đến đau đớn.\"\r\n\r\n- Nguyễn Quang Thiều - Phó chủ tịch Hội Nhà văn Việt Nam\r\nGiám đốc, Tổng biên tập Nhà xuất bản Hội Nhà văn', 'bai-tho-cua-mot-nguoi-yeu-nuoc-minh.jpg', 'Trần Vàng Sao', NULL, 'Hội nhà văn', 4),
(6, 'Ta còn em', 172, '15 x 24 cm', '2018-05-02', 56000, 70000, 0, 80, '“Ta còn em Cổ Ngư, tên thật cũ\r\n\r\nNắng chiều phai\r\n\r\nLa đà cành phượng vĩ\r\n\r\nBông hoa muộn in hình ngọn lửa…\r\n\r\n \r\n\r\nChiếc lá rụng\r\n\r\nKhởi đầu nguồn gió\r\n\r\nLao xao sóng biếc Tây Hồ\r\n\r\nHoàng hôn xa đến tự bao giờ?\r\n\r\nNhững bước chân tìm nhau\r\n\r\nVồi vội\r\n\r\nTiếng thì thầm đến sớm hơn buổi tối\r\n\r\nCuộc tình hờ bỗng chốc nghiêm trang…”', 'ta-con-em.jpg', 'Phan Vũ', NULL, 'Hội nhà văn', 4),
(7, 'Bức xúc không làm ta vô can', 222, '14 x 20.5 cm', '2018-08-06', 68000, 85000, 60, 70, '\"Từ chỗ vô danh cách đây bảy, tám năm, bây giờ, nếu gõ \"bức xúc\" vào Google, ta sẽ được 29 triệu kết quả, gấp gần 10 lần \"Ngọc Trinh\" một con số ấn tượng cho một làn da xấu xí như vậy.\"\r\n\r\nĐây là một trong rất nhiều các quan sát thú vị, kèm theo các giải mãi hóm hỉnh, không kém phần chua xót song cũng rất giàu nhân văn trong tuyển tập BỨC XÚC KHÔNG LÀM TA VÔ CAN của tiến sĩ Đặng Hoàng Giang. 26 bài viết là 26 câu chuyện từ quen thuộc như thịt chó, ấn đền Trần, phẫu thuật thẩm mỹ, từ thiện câu like...đến ngỡ như vĩ mô xa xôi nhưng lại ảnh hưởng mật thiết đến cuộc sống từng cá nhân như sự tàn phá của kinh tế thị trường, lí do khiến quốc gia thất bại, du lịch đại trà, hay các vấn đề văn hóa không bao giờ hết nóng như sính ngoại, truyền hình thực tế...Không chỉ phân tích khách quan và bình luận sắc sảo, tác giả còn đề xuất nhiều giài pháp bất ngờ và đầy trách nhiệm, khiến các bài viết, trước khi được tập hợp lại trong tuyển tập này, đã nhận được hàng trăm nghìn lượt xem và rất nhiều chia sẻ từ đông đảo cư dân mạng.\r\n\r\n\"Một góc nhìn thằng thắn và tỉnh táo, xoáy vào những vấn đề bằng những con dao mổ sắc cạnh của tri thức...Từ lâu, những cây viết của nước ta vẫn dùng dao gọt hoa quả có lưỡi lượn sóng để mổ xẻ các vấn đề. Chúng ta thiếu những con dao mổ lạnh, nằm trong những bàn tay ấm.\"', 'buc-xuc-khong-lam-ta-vo-can.jpg', 'Đặng Hoàng Giang', NULL, 'Hội nhà văn', 5),
(8, 'Nhật ký Đặng Thùy Trâm', 296, '13 x 20.5 cm', '2018-05-29', 60800, 76000, 50, 180, 'Một cuốn nhật kí nhặt được bên xác của một nữ Việt Cộng đã suýt bị người lính Mỹ ném vào lửa, nhưng người phiên dịch đã khuyên anh ta nên giữ lại vì \"trong đó có lửa\". Nhật kí Đặng Thùy Trâm là những ghi chép hàng ngày của một người nữ bác sĩ về cuộc sống của chị nơi chiến tuyến. Cuốn nhật kí là thế giới riêng của người trí thức nhạy cảm mà không yếu đuối, tha thiết với cuộc sống mà không hề sợ hãi trước những gian nan. Ở đó ta vẫn gặp những băn khoăn trăn trở trước tình yêu, trước cuộc sống phức tạp hàng ngày, những nỗi buồn, nỗi nhớ nhung, sự cô đơn của một người con gái, nhưng đồng thời chúng ta cũng thấy được một ý chí mãnh liệt, những lời nói tự động viên cảnh tỉnh, một lòng can đảm phi thường - những điều đã làm nên một thế hệ anh hùng.', 'nhat-ky-dang-thuy-tram.jpg', 'Đặng Thùy Trâm', NULL, 'Hội nhà văn', 5),
(9, 'Muốn làm nữ hoàng, đừng yêu như hầu gái', 200, '14 x 20.5 cm', '2019-12-04', 57600, 72000, 0, 130, 'Khi nàng biết cách làm một người đàn bà thực sự, ấy là khi nàng xứng được yêu.\r\n\r\nĐược yêu, trong lý lẽ của nàng, là được sóng bước bên cạnh người đàn ông chứ không phải lặng thầm núp sau lưng họ. Được yêu, là được nâng niu theo cái cách mà nàng chờ đợi. Được yêu, là được kiêu hãnh trong tình yêu ấy, được là mình, và yêu không gắng gượng.\r\n\r\n \r\n\r\nLà đàn bà, nàng chẳng dại “cầm cung”. Nàng chủ động mà như thụ động. Nàng chinh phục mà tựa chỉ ngồi yên. Nở nụ cười xinh đẹp của riêng mình, nàng hiểu: “Muốn làm nữ hoàng, đừng yêu như hầu gái”.', 'muon-lam-nu-hoang-dung-yeu-nhu-hau-gai.jpg', 'Blog của May', NULL, 'Dân Trí', 6),
(10, 'Để con được chích - Hiểu biết về vắc xin và miễn dịch', 296, '14 x 20.5 cm', '2019-06-28', 86400, 108000, 40, 145, 'Bạn có phân vân trong việc đưa con đi tiêm chủng? Bạn có lo ngại về thông tin vắc xin MMR (sởi-rubella-quai bị) gây hội chứng tự kỷ? Và thủy ngân, cùng nhôm có thể được truyền vào cơ thể của trẻ cùng các mũi vắc xin? Con của bạn có phải là một trong hàng nghìn đứa trẻ mắc sởi vào mùa xuân 2019? Hay bé đã may mắn không mắc bệnh? Và hệ miễn dịch của trẻ, cùng của chính chúng ta thực ra hoạt động như thế nào?\r\n\r\n \r\n\r\nVô vàn câu hỏi về chủng ngừa và hệ miễn dịch sẽ được giải đáp trong cuốn sách này. Việc của bạn là lật giở nó để rồi có quyết định Tiêm hay Không tiêm. Sức khỏe của con luôn nằm trong tay cha mẹ.\r\n\r\n \r\n\r\n“Cuốn sách này không chỉ dành cho tất cả các ông bố bà mẹ còn đang hoang mang về việc đi chích ngừa cho con, và có thể là một tài liệu tham khảo cho tất cả nhân viên y tế trong việc giải đáp thắc mắc cho bệnh nhân của chúng ta một cách đồng nhất và khoa học về vaccine và thực hành tiêm chủng.”\r\n\r\n- Ts, Bs. Phạm Lê Duy', 'de-con-duoc-chich---hieu-biet-ve-vac-xin-va-mien-dich.jpg', 'BS. Vân Hương, BS. Lê Duy Minh, Uyên Bùi', NULL, 'Thế Giới', 6),
(11, '9 màu chia ly', 256, '14 x 20.5 cm', '2022-03-25', 96000, 120000, 98, 52, 'Được viết ra ở nửa muộn của tuổi bảy mươi, với 9 màu chia ly – cuốn truyện ngắn thứ ba liên tiếp của Bernhard Schlink sau Những cuộc chạy trốn tình yêu và Mùa hè dối trả -  người đọc dễ đoán rằng ông nghĩ nhiều đến sự chia ly mà ai cũng phải làm trong đời. Và nghĩ đến quá khứ trước khi chia ly. Quả thực rất khó hình dung Schlink bên ngoài chủ đề văn chương gốc rễ của ống: sự đối mặt với dĩ vãng, với gánh nặng lịch sử và đạo lý... Nhưng với những cốt truyện đầy kịch tỉnh ở cả chín truyện ngắn, điều khó ngờ là tác giả có thể điềm tĩnh giữ cái kết ở tình trạng lửng lơ. Những màu của chia ly đều ở gam trầm, ngả về tiết thu chứ không xuân hè rực rỡ. Không thích hợp để ai đó đọc nhanh giết thì giờ một cách vô nghĩa, mà phải thấy giờ đọc là giờ quý giá của cuộc đời ta cần nâng niu!', '9-mau-chia-ly.jpg', 'Bernhard Schlink', 'Lê Quang', 'Hội nhà văn', 8),
(12, 'Và rồi núi vọng', 512, '14 x 20.5 cm', '2021-10-06', 118400, 148000, 67, 93, 'Afghanistan, mùa thu năm 1952.\r\n\r\nAbdullah và Pari sống cùng cha, mẹ kế và em khác mẹ trong ngôi làng nhỏ xác xơ Shadbagh, nơi đói nghèo và mùa đông khắc nghiệt luôn chực chờ cướp đi sinh mệnh lũ trẻ. Abdullah yêu thương em vô ngần, còn với Pari, anh trai chẳng khác gì người cha, chăm lo cho nó từng bữa ăn, giấc ngủ. Mùa thu năm ấy hai anh em theo cha băng qua sa mạc tới thành Kabul náo nhiệt, không mảy may hay biết số phận nào đang chờ đón phía trước: một cuộc chia ly sẽ mãi đè nặng lên Abdullah và để lại nỗi trống trải mơ hồ không thể lấp đầy trong tâm hồn Pari…\r\n\r\nTừ một sự kiện duy nhất đó, câu chuyện mở ra nhiều ngã rẽ phức tạp, qua các thế hệ, vượt đại dương, đưa chúng ta từ Kabul tới Paris, từ San Francisco tới hòn đảo Tinos xinh đẹp của Hy Lạp. Với sự uyên thâm, chiều sâu và lòng trắc ẩn, Khaled Hosseini đã viết nên những áng văn tuyệt đẹp về mối dây gắn kết định hình nên con người cũng như cuộc đời, về những quyết định tưởng chừng nhỏ nhoi mà vang vọng qua hàng thế kỷ.', 'va-roi-nui-vong.jpg', 'Khaled Hosseini', 'Tất An', 'Hội nhà văn', 8),
(13, 'Hoa vẫn nở mỗi ngày', 532, '15.5 x 24 cm', '2020-11-13', 187200, 234000, 50, 100, '“Một tiểu thuyết đầy cảm xúc, một cuốn sách đưa ta đi từ tiếng cười đến những giọt nước mắt với các nhân vật hài hước và cuốn hút.”\r\n– Ban giám khảo giải thưởng Prix des Maisons de la Presse.\r\n\r\nGIỚI THIỆU SÁCH:\r\nViolette Toussaint sống mà như chết. Người phụ nữ ấy bị mẹ đẻ bỏ rơi ngay khi vừa lọt lòng, tới lượt cô con gái nhỏ mà cô yêu thương nhất lại bỏ cô mà đi trong một tai nạn thảm khốc, rồi cả đến người chồng một ngày kia cũng không còn ở lại bên cô. Cuộc đời của một nhân viên gác chắn nơi ga xép với những chuyến tàu nhỏ mỗi ngày đến rồi đi hay của một người quản trang tại nghĩa trang tỉnh lẻ chuyên đón nhận người chết và chăm sóc các phần mộ tưởng chừng chỉ gắn chặt với mất mát, buồn đau, rồi úa tàn dần theo năm tháng. Nhưng sự sống là mầu nhiệm, hy vọng vẫn còn đó, hạnh phúc lại có dịp được hồi sinh khi hoa kia được thay nước, khi chính con người vẫn tin vào cuộc đời.\r\n\r\nMột câu chuyện sẽ ở lại lâu trong lòng độc giả. Nhẹ nhàng mà thấm thía. Bởi dẫu có lẽ không ít lần lấy đi nước mắt của người đọc, câu chuyện về tình yêu, tổn thương và hy vọng này cuối cùng sẽ để lại trong ta những cảm xúc tích cực, hạnh phúc cùng niềm mãn nguyện êm đềm một khi đã lật giở đến những trang cuối.\r\n\r\nVỀ TÁC GIẢ:\r\nValérie Perrin sinh năm 1967 tại Gueugnon, Pháp. Ngoài viết văn, bà còn là một nhiếp ảnh gia hậu trường và nhà biên kịch, nhưng các tác phẩm văn chương mới chính là thứ đưa tên tuổi của bà đến với đông đảo công chúng. Tiểu thuyết đầu tay của Perrin, tạm dịch Những người bị lãng quên ngày Chủ nhật (Les Oubliés du dimanche) giành được gần mười giải thưởng. Tiểu thuyết thứ hai, Hoa vẫn nở mỗi ngày cũng giành nhiều giải thưởng, nổi bật là Prix des Maisons de la Presse.', 'hoa-van-no-moi-ngay.jpg', 'Valérie Perrin', 'Nguyễn Thị Tươi', 'Hà Nội', 9),
(14, 'Điên toàn tập!', 468, '14 x 20.5 cm', '2019-12-10', 111200, 139000, 40, 50, 'Mệt mỏi, chán nản cả trong một thế giới nơi ông có cảm giác mình không còn chỗ đứng, bị tách khỏi những người thân thiết cứ lần lượt rời đi, Andrew Blake quyết định rời bỏ nước Anh và chức vụ đứng đầu công ty để đến xin làm quản gia tại một dinh thự ở nước Pháp, nơi ông đã gặp vợ mình trước đây.\r\n\r\n \r\n\r\nKhi đến dinh thự Beauvillier, nơi không ai biết ông thực sự là ai, ông hy vọng sẽ tìm lại được dấu vết của quá khứ. Tuy nhiên, những con người, những tình huống vượt ngoài tầm kiểm soát của Andrew sẽ khiến ông buộc phải có một khởi đầu mới, ở cái tuổi tưởng như mọi thứ đã an bài.\r\n\r\n \r\n\r\nCuốn sách như một cái nháy mắt tinh nghịch về những khác biệt thú vị giữa sự điềm tĩnh Ăng lê và nét Pháp hào hoa phóng khoáng.\r\n\r\n \r\n\r\n“Một vở hải kịch đầy ắp những bất ngờ thú vị”\r\n\r\n- Prima', 'dien-toan-tap.jpg', 'Gilles Legardinier', 'Phúc Chi Nhi', 'Hà Nội', 9),
(15, 'Hình như ta đã yêu nhau', 256, '14 x 20.5 cm', '2019-11-29', 96000, 120000, 35, 95, 'Từng mảnh ký ức vuột đi như cát trôi qua kẽ ngón tay, không cách nào giữ lại được. Mỗi ngày Flora Banks đều trải nghiệm nỗi buồn đó, bởi cô bị mất trí nhớ. Cô thức dậy mà không biết mình bao nhiêu tuổi, có bạn bè gì không, năm nay là năm nào.\r\n\r\n \r\n\r\nThế rồi cô hôn một chàng trai, và ngày hôm sau, cô vẫn nhớ chuyện ấy. Lần đầu tiên kể từ khi mười tuổi, cô nhớ được một chuyện từ ngày hôm trước sang tận ngày hôm sau.\r\n\r\n \r\n\r\nCô phải theo đuổi chàng trai. Không phải chỉ vì anh là tình yêu đích thực của cô, mà có lẽ anh còn có thể giúp cô lấy lại trí nhớ, cứu vớt cuộc đời cô.\r\n\r\n \r\n\r\nNhưng trước bàn tay ma quái của ký ức, những giây phút hoang tưởng mà ngỡ là sự thật, tình yêu của cô có thực sự đáng tin không?\r\n\r\n \r\n\r\nTình cảnh và chứng bệnh của Flora có thể hiếm gặp, nhưng mỗi người trưởng thành đều có thể nhìn thấy mình trong khát vọng vượt lên nghịch cảnh và ý chí kiếm tìm sự thật, cảm xúc yêu đương cuồng nộ của cô gái. Có lẽ bởi thế mà Hình như ta đã yêu nhau, tiểu thuyết đầu tay của Emily Barr đã nhanh chóng vươn lên dẫn đầu top sách bán chạy tại Anh quốc. Một cuốn tiểu thuyết không thể quên về chứng bệnh quên.', 'hinh-nhu-ta-da-yeu-nhau.jpg', 'Emily Barr', 'Lan Hương', 'Hội nhà văn', 9),
(16, 'Hòm thư số 110', 492, '14 x 20.5 cm', '2019-11-22', 127200, 159000, 25, 100, 'Tình yêu của anh nhón chân rón rén bước\r\n\r\nEm đã bước vào vườn hoa của anh rồi nhỉ.\r\n\r\nDù chưa được cho phép.\r\n\r\n \r\n\r\nỞ độ tuổi 30, bận bịu trong nhịp sống thường ngày quen thuộc khiến Jin Sol lẳng lặng đem cất những rung động tình yêu xa xỉ vào góc sâu trái tim. Mục tiêu cô đề ra là “Đừng để lòng vướng bận”. Song lẽ dĩ nhiên, trời chẳng chiều lòng người, đợt cải tổ nhân sự định kỳ của đài phát thanh đã mang đến cho cô một cộng sự khó nhằn - một nhà sản xuất chương trình còn sáng tác cả thơ. Để đối phó với anh ta, dường như mọi sự phòng bị là không đủ, hoặc chỉ một cốc smoothie đã đủ…\r\n\r\n \r\n\r\nViết về những con người gần gũi trong cuộc đời bình dị, những người lớn dù đã khoác lên mình lớp vỏ trưởng thành song vẫn còn vô số khuyết điểm cũng như nhược điểm, ngày ngày vẫn đối mặt với nỗi cô đơn trong chừng mực cho phép, đây là câu chuyện “thử yêu thêm lần nữa” của họ, của bạn và của tôi. ', 'hom-thu-so-110.jpg', 'Yi Doo-woo', 'Trần Hải Dương', 'Hà Nội', 9),
(17, 'Tàn lửa', 484, '14 x 20.5 cm', '2022-03-21', 148000, 185000, 120, 50, 'Cuộc sống bình lặng của gia đình Kajima Isao, một cựu thẩm phán mới về hưu hoàn toàn xáo trộn trước sự xuất hiện của người hàng xóm mới. Người đó là Takeuchi Shingo, bị cáo của một vụ sát hại ba người trong một gia đình từng được ông tuyên vô tội cách đây hai năm. Cư xử lịch thiệp và tinh tế, Takeuchi dần trở thành một người láng giềng thân thiết với gia đình Isao. Nhưng rồi, những sự việc bí ẩn liên tiếp xảy đến với gia đình ông: cái chết đột ngột của người mẹ già, sự thật ngỡ đã được chôn vùi trong quá khứ đột nhiên bị phơi bày trước mắt… Những nghi ngờ bắt đầu nhen lên, rồi sau đó là cuộc đua nghẹt thở và kịch tính hòng tìm ra sự thật trước khi một thảm kịch khác kéo đến…\r\n\r\nTàn lửa cũng được dựng thành phim truyền hình một tập vào năm 2005 và phim truyền hình nhiều tập vào năm 2016.\r\n\r\nTÁC GIẢ:\r\nShizukui Shusuke, nhà văn người Nhật Bản.\r\n\r\nShizukui Shusuke ra mắt vào năm 2000 với tác phẩm Kouei itto (Hết mình cho vinh quang – tạm dịch). Sau đó, Hannin ni tsugu (Gửi đến hung thủ - tạm dịch) ra mắt năm 2004 đã đứng đầu trong hạng mục “Shukanbunshun mystery best 10” của tạp chí Shukanbunshun. Ngoài ra, Shizukui Shusuke cũng chấp bút nhiều tác phẩm khác nữa.', 'tan-lua.jpg', 'Shizukui Shusuke', 'Dương Hoa', 'Hà Nội', 10),
(18, 'Trúc thư dao 1 - Nước Tần - Có nàng tên Thập', 528, '14 x 20.5 cm', '2022-03-11', 143200, 179000, 120, 50, '“Tộc Hồ sinh cháu người thưởng khác xa,\r\n\r\ntrai tròng kép vượng quốc gia,\r\n\r\ngái thời mắt biếc Tấn đà diệt vong.\"\r\n\r\nMới bốn tuổi, Thập đã phải lê la ngoài phố ăn xin, đôi mắt cô ánh xanh dưới trăng nên bị gọi là \"quỷ núi . Sau cái chết của mẹ, tướng quân nước Tần là Ngũ Phong cứu mạng và cưu mang cô. Mười năm sống bình yên trong phủ tướng quân, cô thể hiện tài trí xuất chúng, lại luôn cố gắng học tập chỉ để có thể kề vai sát cảnh với người ấy, bày mưu tinh kể cho y. Nhưng rồi dòng xoáy của thời cuộc và những âm mưu chính trị, cùng thân thế bị ẩn của bản thân đã đưa đẩy cô vào một hành trình mới...', 'truc-thu-dao-1---nuoc-tan---co-nang-ten-thap.jpg', 'Văn Giản Tử', 'Tố Hinh', 'Hà Nội', 10),
(19, 'Bạch dạ hành (TB 2021)', 628, '15 x 24 cm', '2021-06-30', 167200, 209000, 20, 120, 'Osuke, chủ một tiệm cầm đồ bị sát hại tại một ngôi nhà chưa hoàn công, một triệu yên mang theo người cũng bị \r\ncướp mất.\r\n \r\nSau đó một tháng, nghi can Fumiyo được cho rằng có quan hệ tình ái với nạn nhân và đã sát hại ông để cướp một \r\ntriệu yên, cũng chết tại nhà riêng vì ngộ độc khí ga. Vụ án mạng ông chủ tiệm cầm đồ rơi vào bế tắc và bị bỏ xó.\r\n \r\nNhưng với hai đứa trẻ mười một tuổi, con trai nạn nhân và con gái nghi can, vụ án mạng năm ấy chưa bao giờ kết \r\nthúc. Sinh tồn và trưởng thành dưới bóng đen cái chết của bố mẹ, cho đến cuối đời, Ryoji vẫn luôn khao khát được \r\nmột lần đi dưới ánh mặt trời, còn Yukiho cứ ra sức vẫy vùng rồi mãi mãi chìm vào đêm trắng. ', 'bach-da-hanh-(-tb-2021-).jpg', 'Higashino Keigo', 'Diệu Thư', 'Hội nhà văn', 10),
(20, 'Cuộc đời là một tiểu thuyết', 268, '14 x 20.5 cm', '2021-01-12', 112000, 140000, 35, 85, 'Với anh, mọi thứ đã được viết sẵn\r\nVới cô, mọi thứ đang đợi viết tiếp\r\n\r\n“Sáu tháng trước, ngày 12 tháng Tư năm 2010, con gái ba tuổi của tôi, Carrie Conway, đã bị bắt cóc trong lúc hai mẹ con đang chơi trốn tìm trong căn hộ nhà mình ở Williamsburg.”\r\n\r\nCâu chuyện của Flora Conway, nữ tiểu thuyết gia nổi tiếng sống kín đáo, đã bắt đầu như thế. Carrie đột ngột mất tích, không cách nào lý giải được. Cửa chính và các cửa sổ đều đóng kín, các camera giám sát trong tòa nhà không phát hiện điều khả nghi nào. Cuộc điều tra của cảnh sát không mang lại kết quả gì.\r\nCùng thời điểm ấy, ở bờ kia Đại Tây Dương, một nhà văn với trái tim tan nát trốn tránh xã hội trong một ngôi nhà xập xệ, bế tắc với tiểu thuyết đang viết dở.\r\nAnh là người duy nhất nắm giữ chìa khóa của bí ẩn.\r\nVà Flora sẽ đánh bật anh.\r\n\r\nVới Cuộc đời là một tiểu thuyết, bạn sẽ bắt gặp một Guillaume Musso hoàn toàn mới, người dẫn bạn bước vào mê cung, dắt bạn đi theo mạch truyện ly kỳ bằng nguồn sức mạnh rút từ quyền năng của những cuốn sách và khát khao mãnh liệt sống cuộc đời của các nhân vật.\r\n\r\n“Guillaume Musso là một cao thủ phù phép, luôn biến hóa ra điều bất khả trong cuộc đời các nhân vật giữa lúc ta không ngờ tới.”\r\n- Anne Michelet, Version Femina\r\n\r\n“Một câu chuyện tuyệt vời làm hài lòng cả độc giả sách trinh thám lẫn tín đồ văn chương. (…) Guillaume Musso, chắc chắn là nhà văn lớn và độc giả phi thường, trở lại với chủ đề nghề viết, nguồn cảm hứng, cuộc đời thực và tưởng tượng… một cách thật điêu luyện (…) Cuộc đời là một tiểu thuyết không khỏi khiến ta nghĩ tới Romain Gary.”\r\n- Alain-Jean Robert, AFP\r\n\r\nTÁC GIẢ:\r\nGuillaume Musso sinh năm 1974 tại Antibes, thị trấn nhỏ bên bờ Địa Trung Hải. Ngay từ năm mười tuổi, cậu bé Guillaume đã phải lòng văn chương và tuyên bố một ngày nào đó sẽ viết tiểu thuyết. Lớn lên, anh theo học ngành kinh tế rồi trở thành giáo viên sau khi tốt nghiệp, nhưng niềm đam mê thuở ban đầu vẫn tràn đầy. Năm 2001, tiểu thuyết đầu tay của anh ra đời và nhận được tín hiệu tốt từ giới phê bình. Tác phẩm thứ hai, Rồi sau đó, xuất bản năm 2004, đã gây ấn tượng mạnh và đưa tên tuổi Guillaume Musso đến với công chúng. Từ đó đến nay, anh đều đặn cho ra đời các tiểu thuyết mới và giành được thành công vang dội không chỉ tại Pháp mà còn trên khắp thế giới. Các tác phẩm của Guillaume Musso đã được dịch ra nhiều thứ tiếng và được chuyển thể thành phim.', 'cuoc-doi-la-mot-tieu-thuyet.jpg', 'Guillaume Musso', 'Danh Việt', 'Hội nhà văn', 10),
(21, 'Thiên môn chi hùng', 282, '14 x 20.5 cm', '2016-10-07', 57600, 72000, 10, 90, 'Hễ là cờ bạc, ắt có lỗ hổng. Đạo lý trong đổ thuật chính là sự phát triển từ vòng tuần hoàn phá giải và phản phá giải liên tục. Có thể phát hiện ra lỗ hổng mà người khác không phát hiện được và nắm bắt chuẩn xác mới chính là cao thủ Thiên Môn đích thực.\r\n\r\nTrước cơ hội giáng một đòn trí mạng vào kẻ thù không đội trời chung Nam Cung Phóng, trợ thủ được Vân Tương nghĩ tới đầu tiên không ai khác chính là Thư Á Nam, đóa phù dung mới nở trong giới lừa đảo. Tài giả trang, tùy cơ ứng biến của “Thiên Môn chi hoa” kết hợp cùng thiên thuật cao minh, biến hóa khôn lường của “Thiên Môn công tử” hứa hẹn là bánh răng sắt nghiền nát hai sòng bạc lớn của Nam Cung thế gia ở Hàng Châu và Dương Châu. Súc sắc, bài cửu, đặt cửa… không bàn đỏ đen nào vắng bóng họ - bạc thỏi lanh canh trút vào túi, kế hoạch diễn ra quá thuận lợi, song cặp mắt lạnh lùng lí trí của Tương công tử lại bắt đầu bị lửa hận che mờ. Canh bạc lớn lớn hơn nữa liều lĩnh bày ra mà không lường trước cơ trí hơn người của tên công tử xảo quyệt Nam Cung. Sau cùng, cái giá phải trả cho sự trả thù sẽ là gì?', 'thien-mon-chi-hung.jpg', 'Phương Bạch Vũ', 'Đào Anh Thu', 'Văn học', 11),
(22, 'Thiên môn chi môn', 398, '14 x 20.5 cm', '2017-09-15', 80000, 100000, 0, 130, NULL, 'thien-mon-chi-mon.jpg', 'Phương Bạch Vũ', 'Đỗ Đình Huấn', 'Văn học', 11),
(23, 'Thiên môn chi tâm', 252, '14 x 20.5 cm', '2017-11-16', 61600, 77000, 50, 100, 'Cảnh giới cao nhất của thiên đạo là không để lại vết tích. Như luyện Thái Cực Quyền, phải che giấu sức mạnh bản thân, cố gắng mượn sức người khác, khéo léo duy trì cán cân giữa các phía, chưa đến lúc vạn bất đắc dĩ thì chưa giáng đòn sấm sét…\r\n\r\n \r\n\r\nSau thất bại nặng nề ở Kim Lăng, Phúc vương vẫn nung nấu dã tâm nuốt trọn của cải trong thiên hạ. Một mặt lão không từ thủ đoạn tiếp cận và khắc chế công tử Tương, mặt khác vạch ra tầng tầng âm mưu thực hiện kế hoạch của mình. Lần này kẻ được mượn tay là sứ đoàn Đông Doanh cùng võ thánh Đông Doanh Đằng Nguyên Tú Trạch, núp dưới chiêu bài tỷ thí võ nghệ, mở ra ván cược đỏ đen lớn chưa từng thấy. Dân chúng đua nhau đặt cược để rồi đến khuynh gia bại sản, các cao thủ võ lâm Trung Nguyên lần lượt ngã xuống làm bước đệm cho kẻ quyền lực nghiêng triều đoạt lấy lợi ích tối thượng.\r\n\r\n \r\n\r\nTrời đất vô tâm, người có tâm, ta dùng hành động chứng thiên tâm – Lần này, Thiên Môn công tử, kẻ không ở Thiên Tâm Cư nhưng vẫn mang tấm lòng Bồ Tát, phải làm gì để cứu vớt chúng sinh?', 'thien-mon-chi-tam.jpg', 'Phương Bạch Vũ', 'Đào Anh Thu', 'Văn học', 11),
(24, 'Thiên môn chi thánh', 340, '14 x 20.5 cm', '2018-04-16', 80000, 100000, 60, 120, '“Núi xanh có thể làm chứng cho chúng ta, trời cao cũng có thể làm chứng cho chúng ta, chúng ta không sợ dùng máu tươi và tính mạng của mình để bảo vệ nhà cửa của chúng ta, bảo vệ người thân của chúng ta!”\r\n\r\n \r\n\r\nKhấu Diệm, Môn chủ Ma Môn dùng Thất Hồn Đơn khuấy đảo võ lâm, thao túng Thiếu Lâm, hòng đoạt lấy địa vị đứng đầu thiên hạ. Bên ngoài, kỵ binh Ngõa Thích tràn vào xâm phạm bờ cõi, tàn sát sinh linh, đẩy trăm họ vào cảnh dầu sôi lửa bỏng. Để cứu vớt chúng sinh, Thiên Môn công tử Tương quyết định xả thân vì nước, dẫn một cánh quân cảm tử đánh thẳng vào đất Ngõa Thích, nhằm ép chúng phải lui về thủ thành.\r\n\r\n \r\n\r\nHàng loạt biến cố dồn dập, hết thảy bí mật lần lượt phơi bày. Thiên thuật tính được cả thiên hạ, nhưng không tính nổi lòng người biến hóa. Cuộc đời người đứng đầu Thiên Môn cũng biến ảo xoay vần như con xúc xắc trên sòng thời cuộc, bản thân y có nắm chắc được phần thắng về mình?', 'thien-mon-chi-thanh.jpg', 'Phương Bạch Vũ', 'Đào Anh Thu', 'Văn học', 11),
(25, 'Thiên đường tiền xu tập 1', 144, '14 x 20.5 cm', '2019-05-02', 56000, 70000, 20, 70, 'Bánh kẹo ở Thiên đường tiền xu ẩn chứa một sức hút vô cùng kỳ lạ, chẳng ai cưỡng lại được! Nào Kẹo dẻo người cá, Bánh quy mãnh thú, Kem ma ám, Cần câu bánh cá nướng…, thứ nào cũng lấp lánh mời gọi. Để rồi, khách cứ thế bước vào tiệm, vui vẻ trao cho bà chủ Beniko một đồng xu và nhận lại món bánh kẹo nào đó mà họ ngỡ như chính định mệnh của đời mình. Nhưng họ chẳng hề hay biết, rằng chính những món đồ ngọt nhỏ bé đó sẽ dẫn họ bước vào một con đường, nơi ranh giới giữa hạnh phúc và bất hạnh thì vô cùng mong manh…', 'thien-duong-tien-xu-tap-1.jpg', 'Hiroshima Reiko', 'Quỳnh Anh', 'Hà Nội', 18),
(26, 'Thiên đường tiền xu tập 2', 144, '14 x 20.5 cm', '2019-05-04', 61600, 77000, 65, 89, 'Thiên đường Tiền xu vẫn vậy, luôn làm vui lòng khách đến , vừa lòng khách đi. Ngặt một nỗi đám bánh kẹo ở tiệm lạ làng quá, khiến họ mê mẩn hết rồi. Đến nỗi lần nào Beniko cũng phải cẩn thận dặn dò khách về những tai ương có thể ập đến nếu lỡ ăn bánh kẹo không đúng cách, vậy mà người thì quên béng, người thì nghe rồi bỏ đấy. Để rồi cuối cùng có thể bị cuốn vào một thế giới xa lạ...', 'thien-duong-tien-xu-tap-2.jpg', 'Hiroshima Reiko', 'Quỳnh Hương', 'Hà Nội', 18),
(27, 'Bà ngoại thời @ (TB 2019)', 202, '13 x 20.5 cm', '2019-06-24', 52800, 66000, 0, 140, 'Không ti vi, không máy tính, không điện thoại di động. Đó là giải pháp của bố mẹ để đối phó với 1 kẻ nghiện đủ các thể lại màn hình như Sam, khi quyết định gửi nó về sống ở nhà bà ngoại tại Nice. Địa ngục là đây chứ còn đâu nữa! Nhưng địa ngục ấy không chỉ dành cho Sam, bởi bà ngoại Martha từ giờ trở đi sẽ phải sống với cuộc sống độc thân yêu thích của mình, lại suốt ngày vất vả nấu nướng, chăm sóc và kèm cặp thằng cháu ngoại 16 tuổi lộc ngộc đang độ ương bướng. Nhưng có ai học được chữ ngờ. Biết đâu chừng cuộc sống chung cưỡng ép ấy lại là cơ hội cho cả hai bà cháu  để thay đổi những thói quen của mình và nhìn thế giới dưới một góc độ khác? Nhất là khi, bà ngoại bỗng chốc  biến thành một con người không ai hình dung nổi.', '82NPSBBS.jpg', 'Susie Morgenstern', 'Trần Thị Khánh Vân', 'Thế giới', 18),
(28, 'Thiên đường tiền xu tập 3', 145, '14.5 x 20.5 cm', '2019-06-27', 56000, 70000, 55, 100, 'Thiên đường Tiền xu có đối thủ cạnh tranh! Đó là điều chẳng ai ngờ tới, bởi bánh kẹo nơi đây mang sức mạnh thay đổi cả vận mệnh người sở hữu chúng. Nhưng Cửa hiệu Tai ương đã xuất hiện. Ma thuật hay không thì bánh kẹo ở đây cũng không hề kém cạnh. Chỉ có điều, trong khi bánh kẹo Thiên đường tiền xu đưa đường chỉ lối con người ta đến những gì tươi sáng, thì các món hàng của Cửa hiệu tai ương lại có thể khơi dậy những mảng tối sâu nhất trong tâm hồn mỗi người. Để rồi, một cuộc đấu kẹo vô cùng ly kỳ  bắt đầu, mở ra một thế giới ngỡ chỉ có trong mơ, ma mị và lôi cuốn ta tới tận trang cuối.', 'LU8RY7GQ.jpg', 'Hiroshima Reiko', 'Quỳnh Anh', 'Hà Nội', 18),
(29, 'Khó khăn như chăn mèo', 112, '15 x 20 cm', '2019-07-17', 55200, 69000, 20, 130, 'Cuộc sống của một họa sĩ biếm họa nổi tiếng thế giới không dễ dàng tẹo nào. Những deadline dày đặc, hàng đống giấy gói đồ ăn nhanh lăn lóc dưới màn hình máy tính sáng xanh, và đàn thú nuôi gia tăng đến chóng mặt… ừmm, à không, thực ra vẫn từng ấy con mà thôi.\r\n\r\n \r\n\r\n“Mặn” hơn muối và đầy duyên dáng, tuyển tập thứ ba của Sarah Andersen, gồm truyện tranh và các chia sẻ riêng của cô cùng kèm tranh minh họa, là một cuốn cẩm nang chứa bí kíp sinh tồn trong cuộc sống hiện đại đảo điên: từ tầm quan trọng của việc tránh mặt những người thuộc tuýp dậy sớm, 101 cách đối phó với thị phi trên mạng xã hội, tới sự bất lực khi thay đổi thói quen dọn dẹp. Nhưng khi tất cả mọi sự đều thất bại và thế giới quanh bạn đang sụp đổ, hãy pha một cốc sô-cô-la nóng, đếm ngược tới ngày Halloween, và cuộn tròn bên tụi thú cưng lông xù để thấy đời tươi sáng hơn.\r\n\r\n \r\n\r\nSarah Andersen là một họa sĩ trẻ sống tại Brooklyn, Mỹ. Hiện cô đang quyết tâm giảm số lần nhấn nút “hoãn báo thức” vào buổi sáng mà chưa ăn thua.', 'JF5OFZ9K.jpg', 'Sarah Andersen', 'Hà Thu', 'Hội nhà văn', 18),
(30, 'Mèo chiến binh - Bí mật rừng sâu', 400, '14 x 20.5 cm', '2017-07-17', 86400, 108000, 0, 135, 'CHỈ CÓ LỬA MỚI CỨU ĐƯỢC TỘC CHÚNG TA...\r\n\r\n \r\n\r\nCăng thẳng vẫn leo thang trong khu rừng nơi bốn tộc mèo cư ngụ. Khi lòng trung thành dần chuyển dịch, mèo trước kia là bạn có thể trở thành thù chỉ sau một đêm, những mèo khác lại sẵn sàng giết chóc để đạt được thứ mình muốn.\r\n\r\n \r\n\r\nGiữa lúc ấy, Tim Lửa quyết tâm đi tìm sự thật về cái chết bí ẩn của ông chiến binh tộc Sấm can trường Đuôi Đỏ. Thế nhưng trên đường tìm kiếm câu trả lời, chú đã khám phá ra những bí mật vĩnh viễn nên nằm yên trong câm lặng.', 'BFVFPF12.jpg', 'Erin Hunter', 'Nguyễn Minh Thư', 'Hội nhà văn', 18),
(31, 'Thiên đường tiền xu tập 4', 168, '14 x 20.5 cm', '2019-07-30', 64000, 80000, 38, 62, 'Cuộc đấu đã chính thức bắt đầu! Hoa quả đóng hộp linh tính và Bánh giầy rán lươn lẹo, Hộp tiết kiệm giấc ngủ và Bánh gạo mất ngủ… Liệu bánh kẹo ở một cửa tiệm thử vận may người mua như Thiên đường tiền xu có thể  níu chân khách hàng trước đám bánh kẹo đầy cám dỗ chết người từ Cửa hiệu tai ương? Ham muốn rồi ân hận, mừng vui rồi phẫn nộ, ganh ghét rồi đồng cảm… Cuộc phiêu lưu vào thế giới ma thuật với mọi cung bậc cảm xúc vẫn vô cùng gay cấn và đầy bất ngờ ở phía trước.', 'B7EW1UG3.jpg', 'Hiroshima Reiko', 'Quỳnh Hương', 'Hà Nội', 18),
(32, 'Pikalong - LONG YÊU VIỆT NAM', 136, '14.5 x 20.5 cm', '2019-09-23', 60000, 75000, 50, 80, NULL, 'IR9GZAXT.jpg', 'Thăng Fly Comics', NULL, 'Hội nhà văn', 18),
(33, 'Kẻ dị biệt tại trường học phép thuật 5', 376, '13 x 18 cm', '2019-09-23', 108800, 136000, 20, 145, 'Kẻ dị biệt, tập đặc biệt, bao gồm những mẩu truyện ngắn chưa từng đăng tải trên mạng, hé lộ những sự kiện bất ngờ trong cuộc sống của các học sinh trường phép thuật.\r\n\r\n \r\n\r\n“Kỳ nghỉ hè” - Tatsuya cùng bạn bè đến thăm biệt thự nhà Shizuku. Trong khi cả bọn đang thư giãn tại khu nghỉ dưỡng sang trọng, thì Honoka - người đang thầm yêu Tatsuya - đã đưa ra một quyết định quan trọng...!?\r\n\r\n \r\n\r\n“Tình bạn, lòng tin và nghi vấn lolicon” - Ichijou Masaki là tộc trưởng đời tiếp theo của nhà Ichijou trong Thập Sư Tộc. Bí mật của cậu ta cùng với người bạn thân Kichijouji là gì?\r\n\r\n \r\n\r\n“Ký ức ngày hè” - Tatsuya và Miyuki cùng vào thành phố mua sắm. Trái tim Miyuki đập rộn ràng trước tình huống chẳng khác gì hẹn hò này, tuy nhiên...\r\n\r\n \r\n\r\n“Nữ hoàng và kỳ bầu cử hội trưởng” - Mayumi, vốn là học sinh năm ba, sắp phải rời khỏi vị trí hội trưởng Hội học sinh. Và cô đã chọn ra người sẽ thế chỗ mình...', 'UFZQKHX1.jpg', 'Sato Tsutomu', 'Khoa Sin', 'Hội nhà văn', 18),
(34, 'Mê cung thư viện', 518, '13 x 18 cm', '2022-04-12', 134400, 168000, 98, 12, 'Năm năm trước, cha của Okutsuki Soushi, pháp sư vĩ đại của Thành phố Thư viện Alexandria, đã bị giết hại dã man trong mê cung ngay trước mắt con trai mình. Sau sự kiện này, Soushi đã bị sang chấn tâm lý, mất đi ký ức và khả năng sử dụng phép thuật. Năm năm sau, ngay trong ngày đầu tiên trở lại Alexandria, cậu đã gặp “High Daylight Walker” Arteria và bị cô ta biến thành ma cà rồng. Kể từ đó, cậu cùng Arteria dấn thân vào Mê cung Thư viện hòng tìm ra kẻ thù đang lẩn trốn, để có thể thoát khỏi nỗi khổ tâm giày vò suốt năm năm, cũng là để hoàn thành ước mơ của mình. Hãy nhớ lấy điều này: bạn phải tìm ra kẻ thù giết cha đang lẩn trốn trong bóng đen của chấn thương tâm lý. Bạn phải lấy lại phép thuật đã mất, phải giành lại danh dự đã bị đánh cắp. Bạn phải làm tất cả những điều đó cùng Arteria, Chân tổ Ma cà rồng. Tác phẩm đầu tay của Sei Toaza, cũng là tác phẩm tiêu biểu đã lọt vào vòng ba giải thưởng dành cho tác giả Light Novel mới lần thứ 10 do MF Bunko J tổ chức.\r\n\r\nVỀ TÁC GIẢ\r\nSei Toaza – Nhà văn | Kỹ sư | Chuyên viên tư vấn\r\nCông việc chính là kỹ sư làm việc trong mảng Trí tuệ Nhân tạo. Sở thích của anh\r\nlà trí tuệ nhân tạo và các hoạt động liên quan đến sáng tạo, trong đó có lập trình và viết\r\ntiểu thuyết.\r\nMê cung Thư viện là sáng tác đầu tay của anh.\r\n\r\nMinh họa: Shirabi\r\nHọa sĩ sống ở Saitama. Họa sĩ minh họa cho nhiều tác phẩm nổi tiếng như “Công\r\nviệc của Long Vương!, 86…', 'N2I8JZJ6.jpg', 'Sei Toaza, Shirabii minh họa', 'Vinky', 'Hà Nội', 18),
(35, 'Ba muốn nuôi con bằng sữa mẹ', 237, '14 x 20.5 cm', '2015-04-25', 54400, 68000, 10, 60, '\"Ít ra cuộc đời đã không lấy đi của ba tất cả, ba vẫn còn Ủn để nhớ, để thương, để quay về bình lặng sau cơn sóng dữ. Ủn là hạnh phúc của ba, là tất cả với ba bây giờ. Thật đáng sợ khi không còn gì bám víu trong lòng nước dữ, con người ta sẽ để mặc cho dòng đời cuốn đi. Ba sẽ thành kẻ đầu đường xó chợ, hay có thể là kẻ tâm thần ăn mày dĩ vãng, hay tệ hơn mà ai biết...Cảm ơn con đã níu ba lại để ba không gục ngã, để hôm nay nhận thấy tim mình còn thổn thức vì con.\"\r\n\r\nTrình Tuấn', 'VWCK4GHB.jpg', 'Trình Tuấn', NULL, 'Thế Giới', 22),
(36, 'Xuyên Mỹ', 280, '14 x 20.5 cm', '2016-10-07', 63200, 79000, 0, 150, NULL, 'D8XX3HRD.jpg', 'Phan Việt', NULL, 'Hội nhà văn', 22),
(37, '41 năm làm báo', 224, '14 x 20.5 cm', '2017-05-25', 52000, 65000, 0, 100, '“… khi viết hồi ký nầy, tôi sẽ có dịp nhắc đến một số người, một số việc, một số cảnh vật, mà nếu tôi không nhắc đến, e sẽ bị chôn vùi trong lãng quên. Vậy thiên hồi ký nầy có thể kể là một chứng tích lịch sử, mà khi tôi nói đến “cái tôi”, ấy không phải vì mục đích muốn khoe mình, mà là muốn tài liệu nầy có tánh cách nhân chứng. Sử gia có thể lượm lặt trong thiên hồi ký nầy một ít tài liệu, về khoảng từ năm 1926 cho đến ngày nay. Ít nữa, công viết không hoài, đến nỗi tiếc sao đã phí phạm vô ích.”\r\n\r\n41 năm làm báo không chỉ là câu chuyện đời chuyện nghề của một ký giả miền Nam lão thành mà cuộc đời gắn chặt cùng nhiều biến động của dân tộc, mỗi trang sách còn là một thước phim tài liệu sống động, đôi chỗ hài hước nhưng chân thực về cuộc đời viết sách, làm báo, làm chính trị của Hồ Hữu Tường và những đồng chí cùng thời với ông: Nguyễn An Ninh, Phan Văn Hùm, Tạ Thu Thâu – những con người thuộc một thế hệ trẻ trung, phóng khoáng,dấn thân, không chọn vinh thân phì gia mà coi cách mạng là con đường tất yếu của cuộc đời mình trong thời mất nước.', 'BUYI5Y47.jpg', 'Hồ Hữu Tường', NULL, 'Hội nhà văn', 22),
(38, 'Nam và Sylvie', 258, '14 x 20.5 cm', '2017-10-30', 60000, 75000, 0, 120, NULL, 'PD22EN6D.jpg', 'Phạm Duy Khiêm', 'Nguyễn Duy Bình', 'Hội nhà văn', 22),
(39, 'Ta ba lô trên đất Á', 412, '14 x 20.5 cm', '2018-07-31', 86400, 108000, 20, 120, 'Quyển sách đầu tiên của Rosie Nguyễn, nay trở lại với một diện mạo mới và một quốc gia mới mà trước đây tác giả chưa có dịp nhắc đến. Ta ba lô trên đất Á không chỉ là cẩm nang du lịch bụi dành cho những ai yêu thích khám phá Đông Nam Á, mà còn là dấu ấn rất riêng của Rosie Nguyễn khi một mình đeo ba lô, tay cầm bản đồ ngược xuôi khắp các nước láng giềng để đi tìm chính mình và theo đuổi đam mê.\r\n\r\n \r\n\r\n“Ta ba lô trên đất Á là quyển du ký của tác giả Việt Nam yêu thích nhất từ trước đến nay của tôi. Sách nhẹ nhàng, tình cảm và chứa đầy cảm xúc của mỗi vùng đất tác giả dạo bước qua. Mỗi trang sách, câu chuyện là một cánh cửa dẫn dắt những trái tim đam mê phiêu lưu vào những chốn vừa lạ vừa quen ở các quốc gia Đông Nam Á cũng như các nước láng giềng của quê hương Việt Nam. Đây chắc chắn còn là quyển sách gối đầu giường cực kỳ hữu ích cho những bạn trẻ đang chập chững những bước chân đầu tiên để bước ra thế giới ngoài kia, để tìm đến những chân trời mới, để thấy thế gian này thật rộng lớn và đẹp đẽ biết bao.”\r\n\r\n- Trần Đặng Đăng Khoa (chàng trai đi vòng quanh thế giới bằng xe máy)\r\n\r\n \r\n\r\n“Ta ba lô trên đất Á là ba lô hành trang đầy ắp kiến thức và cảm xúc không thể thiếu để những bạn trẻ Việt trải nghiệm đất Á, rồi vững vàng bản lĩnh để in dấu năm châu.”\r\n\r\n- Nhà báo, nhiếp ảnh gia Ngô Trần Hải An (biệt danh “phượt thủ Quỷ Cốc Tử”)', 'LE1IFARB.jpg', 'Rosie Nguyễn', NULL, 'Hội nhà văn', 22),
(40, 'Nếu... thì', 384, '17 x 23 cm', '2018-04-23', 103200, 129000, 32, 56, NULL, 'Q8BU6718.jpg', 'Randall Munroe', 'Nguyễn Hoài Anh, Nguyễn Văn Trà', 'Lao động', 23),
(41, '28', 488, '15 x 24 cm', '2018-04-23', 123200, 154000, 63, 89, NULL, 'O26SIBEF.jpg', 'Jeong You- Jeong', 'Kim Ngân', 'Hà Nội', 23),
(42, 'Chuyện người tùy nữ (TB)', 407, '14.5 x 20.5 cm', '2019-01-09', 100000, 125000, 58, 93, 'Một thể chế thần quyền mọc lên trên cái nền nước Mỹ dân chủ vừa trải qua chính biến: Gilead, ngọn đèn trên quả đồi, quyết tâm đem ánh sáng của tem phiếu, của chuyên chế xã hội và của đạo đức Thanh giáo thế kỷ mười bảy cứu vãn thế giới đang chìm vào sa đọa, ô nhiễm môi trường và nạn vô sinh. Và tương lai của Gilead nằm trong tay các Tùy nữ như Offred: những cô gái mắn con được nuôi trong nhà các Quân trưởng, được chăm bẵm và o bế, chỉ cần mỗi tháng một lần nằm xuống làm bổn phận với quốc gia.\r\n\r\n \r\n\r\nNhưng Offred không thể quên cái “thời trước” đó, sáng sáng đi làm, tối tối trở về nhà với chồng và con gái, đôi khi bù khú với cô bạn thời đại học nay đã thành nhà hoạt động đồng tính nữ, thỉnh thoảng tranh cãi với bà mẹ còn ôm lý tưởng của làn sóng nữ quyền thứ hai. Cái thời cô không phải là Offred, mà còn mang “cái tên ngời sáng của mình”. Cái tên cô chôn chặt trong lòng, cùng những ký ức về thời ấy, lấy can đảm để ngày ngày cảnh giác lần đường, khám phá và tìm cách sống sót trong xã hội toàn trị có một không hai này.\r\n\r\n \r\n\r\nNhư một “1984 dưới điểm nhìn nữ giới”, cuốn sách phản địa đàng của Margaret Atwood mãi gây tranh luận dữ dội, bởi những vấn đề về quyền phụ nữ vẫn chưa bao giờ hết nóng bỏng, nhưngcũng như vậy, liên tục được tìm đọc, bởi vẫn là một tiểu thuyết hấp dẫn, tỉnh táo với lối uy mua thâm trầm sắc sảo cùng những trang viết tuyệt đẹp.', 'GZK3OD2T.jpg', 'Margaret Atwood', 'Nguyễn An Lý', 'Văn học', 23),
(43, 'Tia lửa', 159, '14 x 20.5 cm', '2019-01-25', 56000, 70000, 56, 82, 'Đêm pháo hoa, nghệ sĩ hài trẻ tuổi Tokunaga gặp người đàn anh Kamiya. Một Kamiya kỳ lạ, thất thường, không tuân theo bất cứ chuẩn mực nào khiến Tokunaga vừa bối rối vừa ngưỡng mộ. Cậu xin anh nhận mình làm đệ tử, bước theo anh trên con đường hướng tới lý tưởng thuần khiết. Nhưng rồi hiện thực cuộc sống nghiệt ngã giáng một đòn mạnh khiến Tokunaga choáng váng, và cậu buộc phải đưa ra lựa chọn…\r\n\r\n \r\n\r\nTia lửa khắc họa sống động cuộc đời thăng trầm của người nghệ sĩ hài trong xã hội Nhật Bản hiện đại, đồng thời cũng là câu chuyện về tuổi trẻ và sự trưởng thành chông chênh nhưng kiêu hãnh, về khát khao được bừng sáng rực rỡ giữa màn đêm bất tận, dù chỉ trong phút giây ngắn ngủi.', '6WTBFOOO.jpg', 'Matayoshi Naoki', 'Nhật Minh - Ngọc Diệp - Minh Hiếu', 'Hội nhà văn', 23),
(44, 'Rễ trời', 624, '14 x 20.5 cm', '2019-05-22', 144000, 180000, 62, 98, 'Lấy bối cảnh châu Phi sau chiến tranh thế giới lần thứ nhất, Rễ trời kể về thảm kịch của loài voi trên các xa van cũng như cuộc chiến của một “tay người Pháp” điên khùng, một kẻ muốn chuyển loài.\r\n\r\n \r\n\r\nNgay từ khi xuất bản vào năm 1956, Rễ trời đã được coi là cuốn tiểu thuyết đầu tiên về sinh thái học, tiếng kêu cứu đầu tiên dành cho hệ sinh quyển đang bị đe dọa của chúng ta. Nhưng thông qua cuộc chiến bảo vệ thiên nhiên ấy, Romain Gary còn đan cài vào một cuộc chiến khác nhằm bảo vệ cái mà nhân vật chính gọi là một “khoảng lề nhân loại”. Được viết cách đây hơn 60 năm và mang lại cho tác giả giải thưởng Goncourt cao quý, Rễ trời cùng những trăn trở trong đó chưa bao giờ là quá khứ. Romain Gary đã từng viết rằng: “Những con voi trong tiểu thuyết của tôi hoàn toàn không phải là phúng dụ: chúng bằng xương bằng thịt, cũng giống như chính các quyền con người…”', '8Z13FS8D.jpg', 'Romain Gary', 'Cao Việt Dũng', 'Văn học', 23),
(45, 'Chuyện phiếm sử học - Bìa cứng', 284, '14 x 20.5 cm', '2021-04-06', 96000, 120000, 86, 82, '“Tạ Chí Đại Trường là một nhà sử học có tính độc lập và phong cách riêng trong nghiên cứu lịch sử. Ông có những công trình nghiên cứu sâu sắc trên phương pháp luận sử học nghiêm túc mà tiêu biểu là Lịch sử nội chiến Việt Nam từ 1771 đến 1802. Các tác phẩm của Tạ Chí Đại Trường mang nặng tính suy ngẫm lịch sử, gần như một thứ triết lý lịch sử, như Những bài dã sử Việt, hay Thần, người và đất Việt. Tạ Chí Đại Trường luôn nhìn lịch sử Việt Nam với tấm lòng của một con người Việt Nam.”\r\n\r\n- GS Phan Huy Lê\r\n\r\n \r\n\r\n“Khi chúng ta đọc các tác phẩm của Tạ Chí Đại Trường, chúng ta thấy có một sự tìm kiếm sự thật rất là công phu, có sự nhận định và lý luận rất thẳng thắn. Nó khác với các quan điểm của các sử quan ngày trước, và đến mãi sau này nữa, là dùng lịch sử như là một dụng cụ để củng cố chế độ đương quyền…”\r\n\r\n- Nguyễn Gia Kiểng\r\n\r\n \r\n\r\n“Tạ Chí Đại Trường còn là một ngòi bút thực thụ. Mỗi tác phẩm lịch sử của ông đều thật sự là một tác phẩm văn học đáng giá…”\r\n\r\n- Nguyên Ngọc', 'AJZ467BW.jpg', 'Tạ Chí Đại Trường', NULL, 'Tri Thức', 25),
(46, 'Lịch triều tạp kỷ', 604, '15.5 x 24 cm', '2021-04-12', 188000, 235000, 87, 103, 'Lịch triều tạp kỷ do Cao Lãng biên soạn, Xiển Trai con trai tác giả bổ sung, là một cuốn sử ghi chép khá toàn diện về giai đoạn lịch sử cuối thời Lê-Trịnh. Trong khoảng thời gian kéo dài hơn 100 năm, từ Lê Gia Tông năm Dương Đức thứ nhất (1672) đến Lê Mẫn đế năm Chiêu Thống thứ tư (1789), hầu hết các phương diện trong đời sống chính trị, xã hội ở Đàng ngoài đều được tác giả ghi nhận, từ các pháp lệnh được ban ra ở chính quyền trung ương, trong đó có vai trò chủ đạo của phủ chúa, đến các hoạt động của quan quân và dân chúng ở địa phương. Các sự kiện chính trị, kinh tế, văn hóa, giáo dục, quân sự được ghi chép một cách khá đầy đủ, kỹ lưỡng và sinh động.\r\n\r\n \r\n\r\nTuy là một cuốn sử do tư nhân biên soạn, nhưng với những ghi chép cung phu, nghiêm túc, có thể xem Lịch triều tạp kỷ như là cuốn sử tiếp nối pho Việt sử trục biên nằm trong bộ Đại Việt sử ký toàn thư. Đó chắc chắn là nguồn sử liệu rất quý báu đối với bạn đọc hôm nay về giai đoạn lịch sử từ cuối thế kỷ XVII đến cuối thế kỷ XVIII.', '6KCM16U4.jpg', 'Cao Lãng biên soạn , Xiển Trai bổ sung', 'Hoa Bằng , Hoàng Văn Lâu , Văn Tân', 'Hội nhà văn', 25),
(47, 'Tôi tư duy, vậy thì tôi vẽ', 364, '14 x 20.5 cm', '2020-09-21', 118400, 148000, 62, 108, 'Vậy là, sau best seller Plato và con thú mỏ vịt bước vào quán bar… Thomas Cathcart và Daniel Klein một lần nữa dẫn dắt bạn đọc bước vào ngôi đền triết học linh thiêng bằng những tràng cười ngả nghiêng.\r\n\r\nWittgenstein, triết gia vĩ đại người Áo từng bảo rằng người ta có thể viết nên cả một tác phẩm triết học hay ho và nghiêm túc bằng toàn những câu đùa. Giá mà mọi chuyện diễn ra như vậy, vì sự thực là mấy ai hiểu được các triết gia viết cái khỉ gió gì!\r\n\r\nẤy thế mà có những họa sĩ thiên tài có thể vạch ra những tư tưởng triết học qua các nét vẽ hài hước. Cuốn sách này sẽ mang đến cho bạn sự khoái chí khi xem tranh của họ - những tay hí họa chắc hẳn từng nghiền ngẫm đến nát sách của Nietzsche, Aristotle, Sartre, Russell, Quine, Derrida v.v. Và để giúp bạn không bị chìm trong lý luận cao siêu, Thomas Cathcart và Daniel Klein diễn giải rất hóm những gì mà các tay hí họa kia giảng cho ta về các câu hỏi lớn trong triết học, tỉ như “Có thực con gái và con trai khác nhau không?”, và “Phải chăng có một “Bản tổng đồ vũ trụ?””, hay “Có gì không ổn với cái gọi là sự phân biệt đúng sai?”.\r\n\r\nVừa xem tranh vui vừa hiểu sâu triết học, âu cũng là một thống khoái ở đời!\r\n\r\nVỀ TÁC GIẢ:\r\nThomas Cathcart và Daniel Klein làm những công việc bình thường sau khi tốt nghiệp chuyên ngành Triết học tại Harvard. Thomas đã kinh qua nhiều trường thần học. Daniel đã viết nhiều truyện cười cho các diễn viên hài như Flip Wilson và Lily Tomlin', 'EMXVABG9.jpg', 'Thomas Cathcart - Daniel Klein', 'Như Huy', 'Thế Giới', 26),
(48, 'Luận về yêu', 256, '14 x 20.5 cm', '2022-04-12', 76800, 96000, 149, 11, 'Cuốn sách này chứa đựng chính xác những gì lâu nay ta vẫn muốn biết về tình yêu: không thiếu ảo tưởng nhưng cũng đầy sáng suốt, mê đắm nhưng biết giữ khoảng cách, nồng nhiệt và rất hài hước nhưng cùng lúc ngập tràn phân tích lạnh lùng. Chính khía cạnh “phân tích” này làm nên sự hấp dẫn nhất của Luận về yêu, vì tác giả đã sử \r\ndụng những triết thuyết tưởng chừng khô cứng để tiếp cận tình yêu một cách thấu đáo, từ rất nhiều phương diện, kể cả những phương diện mà những người đang yêu thường muốn giấu kín.\r\n \r\nLuận về yêu, tác phẩm thời trẻ của Alain de Botton, hiện nay là một nhà văn, triết gia và diễn giả nổi tiếng thế giới, \r\ncòn đặc biệt hấp dẫn vì tùy theo tạng riêng của mình, độc giả có thể đọc nó như một tập tiểu luận sâu sắc, hoặc như một cuốn tiểu thuyết vô cùng hấp dẫn và không hề thiếu kịch tính.', '35I2XI5F.jpg', 'Alain de Botton', 'Trần Quốc Tân', 'Thế Giới', 26),
(49, 'Tâm lý người An Nam', 264, '14 x 20.5 cm', '2019-06-17', 72000, 90000, 30, 120, '“Trên hết, người An Nam giữ mối hằn thù thâm sâu đối với bất cứ kẻ ngoại bang nào có thể tới để đánh bật họ ra khỏi tín ngưỡng, tập tục và định chế của họ. Dù cho người Trung Quốc hay người châu Âu đến xâm lăng xứ sở, sai khiến họ nhân danh một người chủ này hay người chủ kia, điều đó chẳng mấy quan trọng đối với họ, chừng nào người ta còn tôn trọng tôn giáo, luật lệ và tập quán của họ.”\r\n\r\n \r\n\r\nPaul Giran, một quan chức của chính quyền Đông Dương thuộc địa, có tham vọng tường giải tâm lý dân tộc An Nam, bằng một cuộc truy nguyên về cội nguồn dân tộc đó ở đại gia đình dòng giống Mông Cổ chiếm cứ vùng trung tâm châu Á, đánh giá những nhân tố tác động thuộc về môi trường tự nhiên và nhân văn, để rồi đúc kết nên cá tính và tâm hồn bản địa trải qua cuộc tiến hóa dài lâu của lịch sử. Với kiến văn sắc sảo và sự hiểu biết khá phong phú của Paul Giran về lịch sử, ngôn ngữ, tôn giáo và văn hóa Việt Nam, Tâm lý người An nam là một tư liệu có giá trị lịch sử, chí ít là khi đối sánh với tâm lý thực dân cai trị.', '9Z6VRIBE.jpg', 'Paul Giran', 'Nguyễn Tiến Văn', 'Hội nhà văn', 27),
(50, 'Đừng lắm lời với đàn ông - Đừng đấu lý với phụ nữ', 268, '14 x 20.5 cm', '2019-09-18', 87200, 109000, 0, 130, 'Mối quan hệ giữa nam và nữ luôn là vấn đề gây ra nhiều rắc rối, hiểu nhầm và cả những căng thẳng với đôi bên, không chỉ trong những mối quan hệ cá nhân mà cả trong công việc.\r\n\r\n \r\n\r\nSau nhiều năm đưa ra lời khuyên và tư vấn cho khách hàng trong công việc cũng như đời sống cá nhân như một chuyên gia tư vấn tâm lý, tác giả Iota Tatsunari cho rằng đó là vì “yếu tố cảm xúc” của mỗi người và mỗi giới đều có những đặc điểm phức tạp, thật khó có thể làm cho nhau hiểu nếu chỉ bằng lời nói hay thái độ.\r\n\r\n \r\n\r\nVì vậy, cuốn sách sẽ truyền tải ý tưởng của tác giả - như một người thông dịch, một cầu nối giữa hai giới lớn trong xã hội - để giúp họ hóa giải những nhầm tưởng giữa đôi bên, hiểu nhau hơn, đi đến một mối quan hệ tốt đẹp và bền vững hơn.\r\n\r\n \r\n\r\nThực tế, cuốn sách sẽ giải quyết những câu hỏi dường như bất tận trong mối quan hệ của người với người, như: Tại sao câu chuyện với người này chẳng thú vị gì?Tại sao có người tệ đến vậy? Tại sao mọi người lại không hiểu tôi?', '9ZO26UAN.jpg', 'Iota Tatsunari', 'Lưu Hà', 'Thông Tấn', 27);
INSERT INTO `sach` (`MaSach`, `TenSach`, `SoTrang`, `KichThuoc`, `NgayPhatHanh`, `Gia`, `GiaGoc`, `SoLuongCo`, `SoLuongBan`, `MoTa`, `AnhChup`, `TacGia`, `DichGia`, `NXB`, `MaDM`) VALUES
(51, 'Thế lưỡng nan của nhà lãnh đạo', 420, '14 x 20.5 cm', '2022-03-25', 144000, 180000, 120, 40, 'Trong hầu hết các tình huống thực tế, nhà lãnh đạo luôn ở vào thế lưỡng nan. Nếu quá áp đặt, đội nhóm sẽ miễn cưỡng thực thi mà thiếu sự linh hoạt, chủ động; nếu quá mềm mỏng, đội nhóm lơi lỏng kỷ cương, kém hiệu quả. Nếu quá vội vàng, họ có nguy cơ làm hỏng nhiệm vụ; nhưng nếu chờ đợi quá lâu mới hành động, kết quả có thể tai hại không kém. Nhà lãnh đạo còn có thể làm tổn thương đời sống cá nhân của mình nếu quá tập trung vào công việc; hoặc có thể bỏ bê công việc nếu dành quá nhiều thời gian với gia đình. Những thế lưỡng nan này là vô tận, và mỗi lần lại đòi hỏi một sự cân bằng khác nhau.\r\n\r\nTheo các tác giả, những sự cân bằng đó có thể chia thành: Cân bằng con người, Cân bằng nhiệm vụ và Tự cân bằng bản thân. Và lần lượt 12 chương sách của cuốn sách này sẽ giúp chúng ta cân bằng những thể lưỡng nan trong lãnh đạo qua những tình huống thực tế cả trong chiến đấu và kinh doanh, với những nguyên tắc cụ thể, rõ ràng như: Quyết đoán nhưng không áp chế; Quyết liệt nhưng không liều lĩnh; Khiêm nhường nhưng không thụ động...\r\n\r\nGiống như nhiều thách thức trong lãnh đạo, tìm kiếm và duy trì sự cân bằng không dễ dàng; đôi khi nó còn đẩy người lãnh đạo đổi mặt với những thách thức gắt gao hơn. Nhưng khi nhận thức và hiểu rõ hơn về thế lưỡng nan của lãnh đạo, người lãnh đạo có thể giải phóng năng lực hoạt động ở mức cao nhất, cho phép họ cùng đội nhóm của mình thống trị mọi chiến trường và giành chiến thắng\r\n\r\n \r\n\r\nTÁC GIẢ:\r\nJocko Willink và Leif Babin là hai cựu sĩ quan Hải quân SEAL Mỹ, từng phục vụ trong những cuộc chiến dữ dội nhất tại Iraq. Vào năm 2010, sau khi rời binh nghiệp, hai người đã thành lập công ty tư vấn lãnh đạo cho các doanh nghiệp mang tên Echolon Front. Công ty đã đạt được những thành công lớn, với việc hợp tác cùng hơn 400 doanh nghiệp lớn và nhỏ trên toàn thế giới.\r\nJocko Willink từng là chỉ huy Đội Đặc nhiệm Bruiser của đội SEAL 3, tham chiến trong các cuộc chiến khốc liệt nhất trong cuộc chiến chống quân nổi dậy tại Ramadi, Iraq. Ông được vinh dự nhận huân chương Ngôi sao Bạc (Silver Star) và Ngôi sao Đồng (Bonze Star) cho các đóng góp của mình và được phong hàm Thiếu tá Hải quân.\r\n\r\nLeif Babin có 13 năm phục vụ Hải quân Mỹ, trong đó có 9 năm tham gia các đội SEAL, từng là chỉ huy trung đội trong Đội Đặc nhiệm Bruiser thuộc đội SEAL 3, tham chiến trong những cuộc chiến dữ dội nhất tại Ramadi, Iraq.', '9X4IJDSY.jpg', 'Jocko Willink , Leif Babin', 'Trần Trọng Hải Minh', 'Thế Giới', 28),
(52, 'AI cho MARKETING và ĐỔI MỚI SẢN PHẨM - Chọn đúng sản phẩm - Chốt đơn hiệu quả', 400, '14 x 20.5 cm', '2022-03-31', 135200, 169000, 129, 33, 'Al và Học máy chính là tương lai của kinh doanh - và cuốn sách này cung cấp cho các nhà sáng tạo và chuyên gia marketing một cẩm nang về công nghệ sẽ cách mạng hóa cách chúng ta bán hàng, giúp chúng ta đón đầu và tận dụng sức mạnh vô song của cặp công nghệ song sinh này.\r\n\r\nKhông chỉ là một tài liệu tóm lược dễ hiểu về công nghệ, cuốn sách này vượt ra khỏi phạm vi khái niệm để chỉ cho bạn: Làm thế nào để có thể vận dụng Al và Học máy theo những cách thể hiện được tinh thần của con người? Chúng ta có thể biến đổi những cải tiến công nghệ lạnh lùng thành các công cụ sáng tạo giúp tạo nên những mối quan hệ sâu sắc giữa con người với nhau như thế nào?\r\n\r\nCác chương trong sách giải quyết vô số chủ đề liên quan đến kinh doanh, từ việc định giá và các chương trình khuyến mãi đến tương lai của các công ty nghiên cứu thị trường và quảng cáo.\r\n\r\nKhông chỉ truyền cảm hứng cho các chuyên gia marketing hoặc nhà cải tiến sản phẩm; sách mang tới một lượng kiến thức gợi mở to lớn để giúp bạn khi đặt sách xuống sẽ nghĩ xem mình có thể làm gì!', 'C3NEMBBZ.jpg', 'Tiến sĩ A.K.Pradeep, Andrew Appel, Stan Sthanunathan', 'Linh M. Nguyễn', 'Dân Trí', 28),
(53, 'Các thế giới song song (TB 128.000)', 483, '15 x 24 cm', '2020-03-03', 102400, 128000, 56, 128, 'Một chuyến du hành đầy trí tuệ qua các vũ trụ, được dẫn dắt tài tình bởi \"thuyền trưởng\" Michio Kaku và độc giả có dịp chiêm ngưỡng vẻ đẹp kì vĩ của vũ trụ kể từ vụ nổ lớn, vượt qua những hố đen, lỗ sâu, bước vào các thế giới lượng tử muôn màu kì lạ nằm ngay trước mũi chúng ta, vốn dĩ tồn tại song song trên một màng bên ngoài không - thời gian bốn chiều, ngắm nhìn thực tại vật chất quen thuộc hòa quyện với thế giới của những điều diệu kỳ như năng lượng và vật chất tối, sự này chồi của các vũ trụ, những chiều không gian bí ẩn và sự biến ảo của các dây rung siêu nhỏ...\r\n\r\nDẫn chuyện lôi cuốn, kết hợp tường minh, sống động một lượng thông tin, đồ sộ để khai mở những giới hạn tột cùng của trí tưởng tượng, Kaku thực sự xứng đáng là \"nhà truyền giáo\" vĩ đại đã mang thế giới vật lý lý thuyết tới quảng đại quần chúng.', 'GFAC9WGQ.jpg', 'Michio Kaku', 'Vương Ngân Hà', 'Thế Giới', 29),
(54, 'Các loài quý hiếm vùng Trường Sơn - Sự sống nơi dãy núi hùng vĩ giữa Việt Nam và Lào', 43, '23 x 23 cm', '2017-12-06', 52800, 66000, 0, 250, 'Ai trong chúng ta có thể nói mình biết về Trường Sơn, một kho tàng thiên nhiên của đất nước? Cùng tham gia chuyến hành trình xuyên rừng Lào Việt của một người cha và hai con, chúng ta sẽ đi dọc các con sông, băng rừng tre, trèo vách đá, vào rừng nhiệt đới, khám phá thế giới diệu kỳ của những loài động vật hoang dã vùng rừng núi Trường Sơn, một kho báu của cả Đông Nam Á.\r\n\r\n \r\n\r\nCuốn sách nhỏ này là tâm huyết của các nhà bảo tồn thiên nhiên hoang dã của Dự án Anoulak. Sau nhiều năm sống chung với các loài quý hiếm vùng Trường Sơn, họ đã tái tạo vẻ đẹp và sự kỳ diệu của thiên nhiên nơi ấy. Với lối dẫn chuyện nhẹ nhàng, lôi cuốn, những thông tin cô đọng, và tranh vẽ sinh động, đầy màu sắc, cuốn sách khiến ta như được dịp làm một chuyến thực địa thu nhỏ đến những vùng rừng núi hùng vĩ, và làm ta suy nghĩ sâu sắc về những nguy cơ mà kho báu này đang phải đối mặt. Một cuốn sách thật hữu ích, giúp vun bồi tình yêu thiên nhiên và ý thức bảo vệ môi trường cho các em.\r\n\r\n \r\n\r\nLà sách song ngữ, Các loài quý hiếm vùng Trường Sơn còn là một phương tiện tuyệt vời để các em có cơ hội thực tập tiếng Anh thông qua một đề tài đầy say mê, thú vị.', 'CFGRMEF1.jpg', 'Eric Losh', 'Lê Quỳnh Huệ', 'Thế Giới', 30),
(60, 'Ngày xưa của con', 92, '15 x 21 cm', '2022-04-26', 54400, 68000, 197, 3, '<p style=\"padding: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 68); font-family: arial; font-size: 14px;\">“...Ngày xưa của con giống như một cuốn nhật kí bằng thơ; ghi chép vội vã những câu nói ngây thơ của con , trong nhà, dọc đường đi, những cuộc đối thoại của mẹ- con bên vai nhau, kề má nhau, rủ rỉ suốt ngày không chán và mãi vẫn ngạc nhiên. Đôi từ còn chưa chau truốt nhưng trong sáng ngây thơ như rót mật vào tim. Bất cứ bộ đôi mẹ - con nào cũng có thể cùng nhau đọc lên những bài thơ đó như chuyện tình yêu của mình. Những hình ảnh rung động tận trái tim: “Mẹ nâng thật khẽ Bàn tay trắng xinh Đặt trong tay mình Như bông hoa nhỏ”</p><p style=\"padding: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 68); font-family: arial; font-size: 14px;\">(trích review của nhà báo Tạ Bích Loan)</p>', 'OUBHBBZ2.jpg', 'Huỳnh Mai Liên', '', 'Hội nhà văn', 20),
(61, 'Công thức hạnh phúc', 164, '14 x 20.5 cm', '2020-08-10', 70400, 88000, 50, 0, '<p style=\"padding: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 68); font-family: arial; font-size: 14px;\">Hạnh phúc thực ra là gì? Công thức nào tạo ra hạnh phúc?</p><p style=\"padding: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 68); font-family: arial; font-size: 14px;\">Trong cuốn sách này, Kets de Vries nỗ lực giải cấu trúc khái niệm trừu tượng ấy. Ông đi từ quan điểm sinh học, thống kê học, tâm lý học, triết học tự cổ chí kim đến cả các trích dẫn từ nhà văn, nhà thơ, nghệ sĩ, và trên hết, những trải nghiệm cá nhân, nhằm tìm ra một \"đơn thuốc\" giúp tăng cường khả năng đạt được hạnh phúc. Đơn thuốc ấy có hiệu quả hay không tùy thuộc ở mỗi người, nhưng có một điều chắc chắn: hạnh phúc luôn ở đâu đó, trong hiện tại và trong tương lai, và ta không bao giờ được mất hy vọng.</p><p style=\"padding: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 68); font-family: arial; font-size: 14px;\">Tác giả<br style=\"padding: 0px; margin: 0px;\">MANFRED F. R. KETS DE VRIES là một học giả về quản trị, nhà phân tâm học, cố vấn, giáo sư môn phát triển lãnh đạo và thay đổi tổ chức tại trường kinh doanh INSEAD. Ông là tác giả của 48 cuốn sách cùng hơn 500 bài luận khoa học về các chủ đề như lãnh đạo, phát triển sự nghiệp và thay đổi tổ chức. Năm 2001, ông được Hiệp hội Tâm lý học Hoa Kỳ trao giải Harry và Miriam Levinson vì những đóng góp trong lĩnh vực tư vấn. Năm 2005, ông là người nước ngoài đầu tiên nhận Giải Lãnh đạo Quốc tế của Hoa Kỳ dành cho những đóng góp của ông trong lĩnh vực quản trị. Các tạp chí The Financial Times, Le Capital, Wirtschaftswoche và The Economist xếp ông là một trong những nhà tư tưởng về lãnh đạo hàng đầu thế giới.</p>', 'NLL2XI5Y.jpg', 'Manfred F. R. Kets de Vries', 'Hoàng Nam', 'Thế giới', 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` int(11) NOT NULL,
  `TenDangNhap` varchar(255) NOT NULL COMMENT 'Tên đăng nhập',
  `MatKhau` varchar(255) NOT NULL COMMENT 'Mật khẩu',
  `HoTen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Họ và tên người dùng',
  `SoDienThoai` varchar(10) DEFAULT NULL COMMENT 'Số điện thoại người dùng',
  `Email` varchar(255) NOT NULL COMMENT 'Địa chỉ email của người dùng',
  `DiaChi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Địa chỉ người dùng',
  `VaiTro` varchar(255) NOT NULL COMMENT 'Vai trò của người dùng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `HoTen`, `SoDienThoai`, `Email`, `DiaChi`, `VaiTro`) VALUES
(1, 'admin', 'admin', '', '', 'admin@gmail.com', '', 'admin'),
(2, 'member', 'member', 'Bích Ngọc', '0123456789', 'member@gmail.com', '296 Bắc Từ Liêm', 'member'),
(4, 'member2', 'member2', '', '', 'member2@gmail.com', '', 'member'),
(9, 'sale', 'sale123', 'Trần Thị C', '0928941356', 'sale@gmail.com', '88 Hồ Tùng Mậu', 'sale'),
(10, 'member3', '10062000', NULL, NULL, 'member3@gmail.com', NULL, 'member'),
(11, 'sale2', 'sale234', '', '', 'sale2@gmail.com', '', 'sale'),
(12, 'member4', '123456', NULL, NULL, 'member4@gmail.com', NULL, 'member'),
(13, 'member5', 'member5', NULL, NULL, 'member5@gmail.com', NULL, 'member');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `MaTinTuc` int(11) NOT NULL,
  `TieuDe` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề của tin tức',
  `NoiDung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nội dung của tin tức'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`MaTinTuc`, `TieuDe`, `NoiDung`) VALUES
(1, 'Giới thiệu', 'Công ty cổ phần Văn hóa và Truyền thông Nhã Nam \r\n<p>Tháng 2 năm 2005, Nhã Nam, tên đầy đủ là Công ty Cổ phần Văn hóa và Truyền thông Nhã Nam đã gia nhập thị trường sách. Tác phẩm \"Balzac và cô bé thợ may Trung hoa\" của Đới Tư Kiệt là cuốn sách đầu tiên được những người sáng lập Nhã Nam xuất bản cả trước khi công ty ra đời. Ngay lập tức từ cuốn sách đầu tiên, độc giả đã dành sự quan tâm và yêu mến cho một thương hiệu sách mới mẻ mang trong mình khát vọng góp phần tạo lập diện mạo mới cho xuất bản văn học tại Việt Nam.</p> \r\n\r\n<p>Lòng say mê của đội ngũ là viên đá đầu tiên. Trải qua mấy năm phát triển, Nhã Nam đã được xây dựng dần lên trong diện mạo một nhà xuất bản vững chãi và chuyên nghiệp. Sáu tháng sau khi thành lập công ty, Nhật ký Đặng Thùy Trâm ra đời, tạo nên một cơn sốt trong xã hội, với gần 500,000 bản sách được phát hành, phá mọi kỷ lục về xuất bản trước đó, kéo theo một loạt những hiệu ứng xã hội và dư luận có ý nghĩa. Từ đó trở đi, thông qua Nhã Nam, các cuốn sách văn học nước ngoài có giá trị được liên tục mua bản quyền và xuất bản tại Việt Nam, thu hút nhiều tầng lớp độc giả. Sách của Nhã Nam nổi bật bởi nội dung văn học tinh tế, bởi vẻ đẹp của thiết kế hiện đại ở hình thức, bởi sự chăm chút kỹ lưỡng cho mỗi cuốn sách như một con thuyền mang tới niềm vui, tri thức, ngạc nhiên, và đồng cảm.</p>\r\n\r\n<p>Trong lĩnh vực văn học, các dòng sách được phát triển cả bề rộng lẫn chiều sâu, mang độc giả vào những chuyến viễn du diệu vợi nhất của thế giới hư cấu. Và những tác động trở lại thật đáng kinh ngạc. Rất nhiều những nhân vật truyện thiếu nhi đã hiện diện sống động trong sự yêu mến của độc giả Việt Nam, như Nhóc Nicolas, Bác Phiôđo, Cedric, Pippi Tất dài, Emil, Gấu Pooh… Liên tiếp các giải thưởng văn học của Hội Nhà văn Hà Nội, Hội Nhà văn Việt Nam đã được trao cho những tác phẩm, những bản dịch chất lượng hàng năm của Nhã Nam như: Cuộc đời của Pi (Trịnh Lữ dịch), Gửi V.B (Phan Thị Vàng Anh), Biên niên ký chim vặn dây cót (Trần Tiễn Cao Đăng dịch), Nửa kia của Hítle (Nguyễn Đình Thành dịch), Tên tôi là Đỏ (Phạm Viêm Phương dịch). Đặc biệt cuốn Trần Dần - Thơ, vào năm 2008, là cuốn sách đáng tự hào vì sự dũng cảm và đóng góp cho văn hóa của Nhà xuất bản, tôn vinh một trong những nhà thơ huyền thoại có cuộc đời sóng gió trong thế kỷ XX, đoạt Giải thành tựu trọn đời của Hội Nhà văn Hà Nội... Từ Nhã Nam, những cuốn sách đã thực sự mở ra những cách nhìn mới về lối sống, làm thay đổi hệ quan niệm cũ, như: Rừng Na-uy của Haruki Murakami, Đôi mắt ấy vẫn ở trên giường của Yamada Amy... Những tác phẩm văn chương, triết lý trứ danh một thời cũng tiếp tục được phát hiện lại và có được đời sống mới: Bắt trẻ đồng xanh (J. D. Salinger), Giết con chim nhại (Harper Lee), Người tình (Marguerite Duras), Đại gia Gatsby (Scott Fitzgerald), Siêu hình tình yêu siêu hình sự chết (Arthur Shopenhauer), Zarathustra đã nói như thế (F. Nietzsche)... Nhã Nam, đã có thể tự hào khi trở thành nhà xuất bản Việt Nam của những cái tên lẫy lừng nhất của văn học thế giới: Salman Rushdie, Milan Kundera, Italo Calvino, Umberto Eco, Vladimir Nabokov, Orhan Pamuk, Margaret Atwood, Philip Roth, Herman Hesse, Ernest Hemingway… Và cuối cùng, một loạt những tác giả do Nhã Nam xuất bản đã có được lượng fan đông đảo, góp phần đánh thức niềm say mê đọc văn chương trong số đông các độc giả trẻ tuổi, như Marc Levy, Guillaume Musso, Anna Gavalda, Amélie Nothomb, Cecelia Ahern, Banana Yoshimoto, Koji Suzuki…Nhã Nam, trên thực tế, đã trở thành một người bạn tinh thần, người định hướng đọc sách cho rất nhiều bạn trẻ, là cầu nối giữa độc giả Việt Nam với nền văn hóa đọc mênh mông của thế giới.</p>\r\n\r\n<p>Từ cuối năm 2008, với sự trưởng thành mạnh mẽ của tổ chức, Nhã Nam đã mở rộng sự quan tâm sang các mảng sách non-fiction như lịch sử, triết học, khoa học, sách về các vấn đề xã hội, văn hóa đương đại, sách khai trí, tham khảo, triết lý sống... Trong lĩnh vực này, Nhã Nam đã trở thành nhà xuất bản của những tác gia quan trọng trên thị trường xuất bản thế giới hiện nay: Đức Đạt Lai Lạt Ma, Deepak Chopra, Don Miguel Ruiz, Naomi Klein, Elisabeth Gilbert... Trong thời gian tới, công ty sẽ tiếp tục phát triển mạnh các mảng sách văn học mà lâu nay vẫn chưa được quan tâm đúng mức ở Việt Nam, như tiểu thuyết khoa học giả tưởng, văn chương kỳ ảo, truyện tranh thế hệ mới… Sự ra đời của các bộ sách lớn của J.R.R Tolkien hay Frank Herbert trong năm 2009 là một minh chứng cho điều đó.</p>\r\n***\r\n<p>Hiểu thời đại đang sống thông qua sách, song hành với những biến chuyển sâu sắc trong lòng xã hội bằng những hoạt động xuất bản miệt mài và quả cảm, con đường Nhã Nam đã chọn để đi sẽ còn dài. Nhiều khó khăn, thử thách đang ở phía trước. Bước qua thời kỳ sơ khai với những bài học và những kinh nghiệm đầu tiên, Nhã Nam giờ đã sẵn sàng cho một chặng đường phát triển mới. Và chúng tôi muốn hoàn thiện mình trong sự cầu thị và cẩn trọng. Tất cả vì một gia sản sách to lớn, có sức sống dài lâu, có ý nghĩa với nhiều thế hệ bạn đọc.<br>\r\nBởi vì sách là thế giới. </p>'),
(2, 'Chính sách bảo mật', '<p><strong>Cam kết bảo mật thông tin cá nhân khách hàng</strong></p>\r\n\r\n \r\n\r\n<p>Thông tin của bạn sẽ không được có thể được chia sẻ cho bên thứ ba nào, trừ trường hợp có văn bản yêu cầu của cơ quan chức năng.</p>\r\n\r\n \r\n\r\n<p>Bạn có quyền yêu cầu chúng tôi cho phép bạn có thể truy cập hoặc chỉnh sửa, xóa thông tin cá nhân của bạn, hoặc nếu bạn có bất kỳ câu hỏi nào về các điều khoản thông tin cá nhân Nhã Nam, hãy gửi e-mail cho chúng tôi.</p>\r\n\r\n \r\n\r\n<p>Khi bạn gửi thông tin cá nhân của bạn cho chúng tôi, bạn đã đồng ý với các điều khoản mà chúng tôi đã nêu ở trên. Chúng tôi cam kết rằng những thông tin mà bạn đã cung cấp cho chúng tôi sẽ được bảo mật và được sử dụng để đem lại lợi ích tối đa cho bạn. Nhã Nam sẽ nỗ lực để đảm bảo thông tin của bạn được giữ bí mật. Tuy nhiên do hạn chế về mặt kỹ thuật, không một dữ liệu nào có thể được truyền trên đường truyền internet mà có thể được bảo mật 100%. Do vậy, chúng tôi không thể đưa ra một cam kết chắc chắn rằng thông tin bạn cung cấp cho chúng tôi sẽ được bảo mật một cách tuyệt đối an toàn, và chúng tôi không thể chịu trách nhiệm trong trường hợp có sự truy cập trái phép thông tin cá nhân của bạn. Nếu bạn không đồng ý với các điều khoản như đã mô tả ở trên, Chúng tôi khuyên bạn không nên gửi thông tin đến cho chúng tôi.</p>\r\n\r\n \r\n\r\n<p>Trang web có thể có các liên kết đến các website khác. Các website liên kết này có thể không thuộc phạm vi quản lý của Nhã Nam và Nhã Nam không chịu trách nhiệm đối với bất kỳ website liên kết nào.</p>\r\n\r\n \r\n\r\n<p>Nhã Nam có đặc quyền và toàn quyền chỉnh sửa nội dung trong trang này mà không cần phải cảnh báo hoặc báo trước. Bạn đã đồng ý rằng, khi bạn sử dụng website của chúng tôi sau khi chỉnh sửa nghĩa là bạn đã thừa nhận,  đồng ý tuân thủ cũng như tin tưởng vào sự chỉnh sửa này. Do đó bạn nên xem trước nội dung trang này trước khi truy cập các nội dung khác trên website.</p>'),
(3, 'Chính sách vận chuyển', '<strong>-  Giao hàng và thu tiền tại địa chỉ nhận hàng (COD):</strong> 22.000/đơn<br>\r\n <strong>* Thời gian vận chuyển:</strong>\r\n<br>\r\n<strong>- Khu vực nội thành Hà Nội và thành phố Hồ Chí Minh :</strong> Thời gian giao hàng dự kiến là 48 giờ  làm việc tính từ thời điểm đơn hàng được xác nhận (qua SMS)<br>\r\n\r\n<strong>- Khu vực khác:</strong> Thời gian dự kiến chậm nhất 72 giờ làm việc.\r\n<br>\r\n<em> * Đối với các đơn hàng có địa chỉ nhận hàng nằm ngoài trung tâm, tỉnh, thị xã, thị trấn vui lòng cộng thêm 2-3 ngày so với thời gian quy định tính theo khu vực. </em><br>\r\n\r\n<strong>Quý khách lưu ý:</strong><br>\r\n\r\n<em>* Quý khách hàng không phải trả thêm bất kì khoản phí nào khác khi nhận hàng.\r\n<br>\r\n* Đối với sách mới xuất bản lần đầu, Nhã Nam chỉ bắt đầu giao hàng kể từ khi chi nhánh Nhã Nam TP.Hồ Chí Minh có sách (áp dụng từ khu vực Đà Nẵng trở vào miền Nam)</em>'),
(4, 'Hình thức thanh toán', '<strong>Thanh toán tại thời điểm nhận hàng - COD.</strong>\r\n\r\n<p>  Khách hàng thanh toán cho nhân viên giao nhận hàng hoá của Nhã Nam ngay tại thời điểm nhận hàng. Khách hàng vui lòng kiểm tra kỹ sản phẩm trước khi nhận hàng. </p>\r\n<p><em>Lưu ý: Mọi vướng mắc khách hàng vui lòng liên hệ 0903.244.248 để được hướng dẫn và giải đáp. </em></p>'),
(5, 'Quy định đổi, trả và hủy đơn hàng', '<p><em>Mặc dù bộ phận kiểm soát chất lượng sản phẩm của Nhã Nam đã kiểm duyệt sách trước khi giao cho khách hàng nhưng cũng không thể tránh khỏi sai sót nên rất mong quý khách vui lòng kiểm tra sản phẩm trước khi ký xác nhận với nhân viên giao hàng để đảm bảo chất lượng sản phẩm được đảm bảo. Trường hợp, sản phẩm không đúng như đã đặt mua qua website hay sản phẩm bị hư hỏng (rách, xước, .v.v.), quý khách có quyền từ chối nhận và yêu cầu Nhã Nam đổi sản phẩm khác.</em></p>\r\n\r\n<p><strong><em>1) Quy định đổi hàng</em></strong><br>\r\n<strong>-  Trường hợp sản phẩm bị hư hỏng do quá trình vận chuyển; sản phẩm không đúng quy cách chất lượng hay được giao nhầm bởi Nhã Nam:</strong> Khách hàng vui lòng kiểm tra và từ chối nhận hàng ngay tại thời điểm nhận hàng( Nhã Nam không chịu trách nhiệm giải quyết trong trường hợp khách hàng đã ký nhận và thanh toán sản phẩm ).<br>\r\n<strong>-  Trường hợp sản phẩm có lỗi kỹ thuật( thiếu trang, lỗi trang...):</strong> Khách hàng được đổi sản phẩm mới hoàn toàn miễn phí không giới hạn thời gian sử dụng sản phẩm.\r\n<p><strong><em>2) Các bước đổi hàng:</em></strong><br>\r\n<strong>-Đối với đơn hàng trong nội thành Hà Nội:</strong> Sau khi nhận sách khách hàng vui lòng kiểm tra lại sản phẩm trước khi ký xác nhận nhận hàng. Trong trường hợp sản phẩm bị hư hỏng hoặc không đúng như sản phẩm khách hàng đã đặt khách hàng có quyền yêu cầu Nhã Nam đổi hàng. Nhã Nam sẽ kiểm tra và xử lý đổi hàng ngay khi nhận được phản ánh.<br>\r\n<strong>- Đối với các đơn hàng chuyển ngoại thành Hà Nội hoặc các tỉnh khác:</strong><br>\r\nQuý khách gửi yêu cầu hỗ trợ về địa chỉ bookstore@nhanam.vn hoặc gọi điện số 0903.244.248 để được trợ giúp.<br>\r\nChúng tôi sẽ nhanh chóng kiểm tra và liên hệ quý khách để xử lý yêu cầu.<br>\r\nNgay sau khi xác nhận lại, Nhã Nam sẽ gửi hàng mới đến cho quý khách.<br>\r\nQuý khách không phải trả thêm chi phí nào khác. Chi phí phát sinh từ việc gửi trả hàng và gửi lại hàng đều được Nhã Nam hỗ trợ 100% cho quý khách.<br>\r\nChúng tôi sẽ gửi sản phẩm mới cùng tính chất với sản phẩm quý khách đã chọn mua. Tuy nhiên, trường hợp không còn hàng thay thế hoặc sản phẩm không còn được tiếp tục sản xuất, quý khách có thể yêu cầu mặt hàng tương tự. Nếu có chênh lệch về giá, quý khách sẽ được hoàn trả hoặc phải bù thêm.<br>\r\nTrường hợp lỗi sản phẩm được gây ra bởi quý khách, ví dụ như: để rơi, hỏng do bảo quản .v.v. sau khi đã ký xác nhận từ nhân viên giao hàng, Nhã Nam sẽ không chịu trách nhiệm và không giải quyết đổi hàng cho các trường hợp này hoặc tương tự.</p>\r\n<p><strong><em>3) Quy trình khiếu nại về đơn hàng: </em></strong><br>\r\n<strong>- Quý khách có khiếu nại về đơn hàng gửi email về địa chỉ bookstore@nhanam.vn</strong><br>\r\nTrong email khiếu nại yêu cầu cung cấp rõ mã số đơn hàng, thời gian đặt hàng, địa chỉ và thông tin người nhận, hình thức, thời gian thanh toán, các yêu cầu khác (nếu có)<br>\r\n<strong>- Nhã Nam sẽ kiểm tra và xử lý khiếu nại trong vòng 48h làm việc:</strong><br>\r\n  Sau khi xác nhận chính xác các thông tin được cung cấp, tính từ lúc nhận được email, Nhã Nam sẽ kiểm tra vận đơn và có phản hồi thông báo tới khách hàng theo số điện thoại được cung cấp trong đơn hàng để thông báo về tình trạng đơn hàng được yêu cầu.<br>\r\n  Trường hợp khẩn cấp sau khi khách hàng gửi khiếu nại về email bookstore@nhanam.vn có thể liện hệ theo số hotline để được giải quyết sớm.</p>\r\n<p><strong><em>4) Quy định hủy đơn hàng</strong></em><br>\r\nKhi quý khách có nhu cầu hủy đơn hàng, đơn hàng sẽ được hủy nếu đang trong tình trạng chưa chuyển hàng đi. Để biết tình trạng hiện tại của đơn hàng, quý khách vui lòng xem trong mục Kiểm tra đơn hàng hoặc gọi điện số 0903.244.248 để được trợ giúp. <br>\r\nĐể hủy đơn hàng, quý khách vui lòng gọi điện số 0903.244.248.</p>'),
(6, 'Hướng dẫn đặt hàng', '<p><strong>Bước 1. Tìm sản phẩm bạn muốn</strong><br>\r\nBạn có thể tìm sản phẩm bằng một trong những cách sau:<br>\r\n-Sử dụng hộp tìm kiếm ở trên cùng của nhanam.com: Bạn có thể lựa chọn tìm kiếm theo các lựa chọn: Tìm theo tên sách, tìm theo tên tác giả, tìm theo tên dịch giả.  Sau đó sẽ có một Danh sách các kết quả chứa các sản phẩm phù hợp với Từ khóa mà bạn vừa tìm kiếm. Bạn có thể click vào gợi ý phù hợp với yêu cầu của bạn.<br>\r\n- Nếu bạn không xác định ngay sản phẩm cần mua có thể tìm sản phẩm mong muốn bằng cách duyệt các Menu lớn của Nhã Nam là  Danh mục sách,  sách bán chạy<br>\r\n- Nếu bạn không thể tìm thấy sách bằng 2 cách trên hoặc bạn gặp khó khăn khi tìm sách, bạn có thể liên hệ với bộ phận bán hàng để được trợ giúp. Bằng cách: gọi điện thoại tới số 0903244248 (Các bạn vui lòng không nhắn tin) hoặc gửi mail : bookstore@nhanam.vn</p>\r\n<p><strong>Bước 2. Thêm sản phẩm vào giỏ hàng, điền thông tin khách hang</strong><br>\r\n- Khi đã chọn được sản phẩm bạn bấm vào nút \"Thêm vào giỏ hàng\".<br>\r\n- Sau đó màn hình sẽ hiện ra toàn bộ sản phẩm trong giỏ hàng. Bạn có thể lựa chọn \"Tiếp tục mua hàng\" để thêm sản phẩm mong muốn. Hoặc chọn \"Thanh toán đặt hàng\" để chuyển sang bước tiếp theo.<br>\r\n- Tại mọi thời điểm, bạn có thể xem giỏ hàng bằng cách bấm vào biểu tượng giỏ hàng<br>\r\n- Mua ngay: Nếu bạn đang vội, muốn mua ngay cuốn sách mà mình cần, hãy lựa chọn phương thức này để mua hàng nhanh chóng nhất mà không cần phải đăng nhập hay đăng ký tài khoản.  <br>\r\n- Nhập chính xác tên và họ người nhận. Vì nếu nhập sai có thể đối tác vận chuyển của Nhã Nam sẽ không bàn giao đơn hàng cho bạn được.<br>\r\n- Tương tự như vậy, địa chỉ của người mua hàng & người nhận hàng cũng chính xác tức là gồm: Tên người nhận hàng; Tỉnh/Thành phố, Quận/huyện, xã phường và địa chỉ chi tiết nhất; số điện thoại liên hệ<br>\r\n* Với trường hợp Đơn hàng Quốc tế vui lòng liên hệ bộ phận chăm sóc khách hàng của Nhã Nam: bookstore@nhanam.vn hoặc gọi điện đến 0903244248 (Các bạn vui lòng không nhắn tin)</p>\r\n<p><strong>Bước 3. Phương thức vận chuyển và thanh toán</strong><br>\r\nNhã Nam sẽ vận chuyển trong khu vực các quận nội thành, còn ngoài khu vực này, bưu điện Việt Nam sẽ giao hàng cho khách hàng.</p>\r\n<p><strong>Bước 4. Kiểm tra và Xác nhận Đơn hàng</strong><br>\r\nTrước khi bấm nút “Hoàn thành đơn hàng”, bạn cần kiểm tra lại chính xác một lần nữa thông tin đơn hàng của bạn gồm: Tổng giá trị đơn hàng, số lượng sản phẩm trong giỏ hàng, chi phí giao hàng.<br>\r\nSau khi đã chắc chắn, bấm nút “Hoàn thành đơn hàng” để xác nhận thực hiện Đơn hàng.\r\n</p>\r\n<p><strong>Bước 5. Kiểm tra tình trạng Đơn hàng của bạn</strong><br>\r\nSau khi đơn hàng đã được đặt, bạn có thể kiểm tra trạng thái Đơn hàng của mình bất kỳ lúc nào bằng cách bấm vào Kiểm tra đơn hàng. <br>\r\nBạn có thể liên hệ bộ phận chăm sóc khách hàng của Nhã Nam qua email: bookstore@nhanam.vn và số điện thoại 0903244248 (Các bạn vui lòng không nhắn tin) từ 8h30 - 17h30 thứ 2 – thứ 6 hàng tuần.<br></p>\r\n<p><em>- Xác nhận đơn hàng như thế nào?</em><br>\r\nXác nhận đơn hàng là việc Nhã Nam kiểm chứng lại các thông tin đơn hàng bạn đã đặt. Việc làm này có tác dụng như một lời cam kết xác nhận đặt hàng từ bạn và Nhã Nam có trách nhiệm thực hiện đơn hàng đó.<br>\r\nSau khi đặt hàng thành công, đơn hàng sẽ được xác nhận qua email. Các trường hợp phát sinh trong quá trình thực hiện đơn hàng sẽ được Nhã Nam liên hệ trực tiếp qua điện thoại.<br>\r\n<em>- Hỗ trợ đặt hàng ở đâu?</em><br>\r\nSau khi đọc xong hướng dẫn và vẫn không biết cách đặt hàng hoặc gặp trục trặc kỹ thuật, vui lòng liên hệ bộ phận bán hàng của Nhã Nam 04.6239.1859  Nhã Nam sẽ giúp bạn đặt được đơn hàng mong muốn.<br>\r\n<em>- Tôi muốn xem hoặc mua hàng trực tiếp tại Nhã Nam thì làm như thế nào?</em><br>\r\nNhã Nam là website bán hàng trực tuyến, tuy nhiên Nhã Nam cũng có cửa hàng phục vụ khách hàng tại các địa chỉ sau trên cả nước :<br>\r\n- Hiệu sách Nhã Nam, số 59, Đỗ Quang, Trung Hoà, Cầu Giấy, Hà Nội 04.35146875 (máy lẻ 12)<br>\r\n- Hiệu sách Nhã Nam, số 22, nhà B14, Phạm Ngọc Thạch, Đống Đa, Hà Nội 04.62593451<br>\r\n- Hiệu sách Nhã Nam, số 107 B9 Tô Hiệu, Nghĩa Tân, Cầu Giấy, Hà Nội 04.62593461<br>\r\n- Hiệu sách Nhã Nam, 49 Chùa Láng, Đống Đa, Hà Nội 04.62598850<br>\r\n- Hiệu sách Nhã Nam, 383 Kim Ngưu, Tầng 3 Creative City, Hai Bà Trưng, Hà Nội  04. 62913403<br>\r\n- Hiệu sách Nhã Nam, Kiot 16, HH1B Linh Đàm, Hoàng Mai, Hà Nội 04.66508250<br>\r\n- Hiệu sách Nhã Nam, 70 Văn Cao, quận Ngô Quyền, Hải Phòng  03.16291817<br>\r\n- Hiệu sách Nhã Nam, số 101B, Nguyễn Chí Thanh, Hải Châu, Đà Nẵng 0511.3828.277<br>\r\n- Hiệu sách Nhã Nam, số 15, lô B, chung cư 43, Hồ Văn Huê, phường 9, Phú Nhuận, thành phố Hồ Chí Minh.   08.38479853</p>'),
(7, 'Liên hệ', '<p><strong>Công ty cổ phần Văn hóa và Truyền thông Nhã Nam</strong><br>\r\nĐịa chỉ: 59 - Đỗ Quang - Trung Hòa - Cầu Giấy - Hà Nội<br>\r\nHotline: 0903244248 (Quý khách vui lòng không nhắn tin) từ 8h30 - 17h30 thứ 2 – thứ 6 hàng tuần.<br>\r\nEmail : bookstore@nhanam.vn<br>\r\nHỗ trợ trực tuyến : <br>\r\n- Skype: van.bcnv<br>\r\n- Facebook: nhanampublishing<br></p>\r\n<p>Nhã Nam là website bán hàng trực tuyến, tuy nhiên Nhã Nam cũng có cửa hàng phục vụ khách hàng tại các địa chỉ sau trên cả nước :<br>\r\n- Hiệu sách Nhã Nam, số 59, Đỗ Quang, Trung Hoà, Cầu Giấy, Hà Nội 024.35146875 (43)<br>\r\n- Hiệu sách Nhã Nam, số 22, nhà B14, Phạm Ngọc Thạch, Đống Đa, Hà Nội 024.62593451<br>\r\n- Hiệu sách Nhã Nam, số 107 B9 Tô Hiệu, Nghĩa Tân, Cầu Giấy, Hà Nội 024.62593461<br>\r\n- Hiệu sách Nhã Nam, 49 Chùa Láng, Đống Đa, Hà Nội 024.62598850\r\n- Hiệu sách Nhã Nam, 383 Kim Ngưu, Hai Bà Trưng, Hà Nội  024. 62913403<br>\r\n- Hiệu sách Nhã Nam, Kiot 16, HH1B Linh Đàm, Hoàng Mai, Hà Nội 024.66508250<br>\r\n- Hiệu sách Nhã Nam, Cửa hàng phố sách 19/12 Trần Hưng Đạo , Hoàn Kiếm , Hà Nội  024 62597490\r\n- Hiệu sách Nhã Nam, 80 Nguyễn Đức Cảnh, Quận Lê Chân, Hải Phòng  02256553878<br>\r\n- Hiệu sách Nhã Nam, số 15, lô B, chung cư 43, Hồ Văn Huê, phường 9, Phú Nhuận, thành phố Hồ Chí Minh.   028.38479853<br>\r\n- Hiệu sách Nhã Nam,Nhã Nam, Gian M4-M5 Đường sách Nguyễn Văn Bình, Phường Bến Nghé , Quận 1 . thành phố Hồ Chí Minh .  028 38223391<br>\r\n- Nhã Nam Book N\'Coffee : 24A - Đường D5, Phường 25, Bình Thạnh ,TP Hồ Chí Minh  SĐT : 028.351.06778<br>\r\n- Nhã Nam Book N\'Coffee Vũng Tàu : 156 Nguyễn Văn Trỗi - TP. Vũng Tàu <br>\r\n- Nhã Nam Book N\'Coffee Đà Đẵng : 19 Pasteur, Quận Hải Châu , TP Đà Nẵng SĐT : 0236.3828.277<br>\r\n- Hiệu sách Nhã Nam,Nhã Nam - Số 3 Nguyễn Quý Đức - Thanh Xuân - Hà Nội SĐT:0246 6594535</p>'),
(8, 'Thông báo', '<p><b>Nhã Nam xin thông báo lịch nghỉ lễ 30/4 - 1/5:</b></p><p>Từ thứ Bảy ngày <b>30/04/2022</b> đến hết thứ Ba ngày <b>03/05/2022</b>. Các đơn hàng, thông tin cần tư vấn, khiếu nại phát sinh trong khoảng thời gian nghỉ lễ sẽ được Nhã Nam chăm sóc và tiếp tục xử lý từ thứ Tư ngày <b>04/05/2022</b>.</p>');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaCTDH`),
  ADD KEY `MaDH` (`MaDH`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`MaCTGH`),
  ADD KEY `MaSach` (`MaSach`),
  ADD KEY `MaGioHang` (`MaGioHang`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `MaTK` (`MaTK`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD KEY `MaTK` (`MaTK`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MaSach`),
  ADD KEY `MaDM` (`MaDM`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`MaTinTuc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `MaCTDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  MODIFY `MaCTGH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45045;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MaGioHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `sach`
--
ALTER TABLE `sach`
  MODIFY `MaSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `MaTinTuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`);

--
-- Các ràng buộc cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `chitietgiohang_ibfk_1` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`),
  ADD CONSTRAINT `chitietgiohang_ibfk_2` FOREIGN KEY (`MaGioHang`) REFERENCES `giohang` (`MaGioHang`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
