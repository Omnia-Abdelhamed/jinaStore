-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2020 at 10:39 AM
-- Server version: 10.2.33-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `janastore_janastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'janastore', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_image`) VALUES
(1, 'banner_80807.jpeg'),
(2, 'banner_21647.png'),
(9, 'banner_32470.png'),
(10, 'banner_40616.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name_ar` varchar(255) NOT NULL,
  `category_name_en` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name_ar`, `category_name_en`, `category_image`) VALUES
(12, 'الصحة والجمال', 'Health & Beauty', 'banner_99837.jpg'),
(18, 'عطور وبخور', 'Perfumes', 'banner_40679.jpg'),
(19, 'أدوات منزلية', 'Home Stuff', 'banner_85259.png'),
(20, 'أدوات كهربائية', 'ELECTRONICS', 'banner_76936.jpg'),
(22, 'رياضة ورشاقة', 'Sport & Fitness', 'banner_14891.jpg'),
(23, 'الأطفال والألعاب', 'Kids & Toys', 'category_98949.jpeg'),
(24, 'الموبايل والتابليت', 'Mobile & Tablet', 'category_76350.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `clothes_size`
--

CREATE TABLE `clothes_size` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clothes_size`
--

INSERT INTO `clothes_size` (`id`, `product_code`, `size_id`, `quantity`) VALUES
(33, 'HEC10047', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name_ar` varchar(50) CHARACTER SET utf8 NOT NULL,
  `country_name_en` varchar(50) CHARACTER SET utf8 NOT NULL,
  `shipping` float NOT NULL DEFAULT 0,
  `taxes` float NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name_ar`, `country_name_en`, `shipping`, `taxes`) VALUES
(1, 'الكويت', 'kuwait', 2, 0),
(2, 'مصر', 'egypt', 70, 3),
(3, 'قطر', 'qatar', 80, 3.5),
(5, 'سلطنة عمان', 'oman', 6.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `discound_codes`
--

CREATE TABLE `discound_codes` (
  `code_id` int(11) NOT NULL,
  `discound_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `value` float NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discound_codes`
--

INSERT INTO `discound_codes` (`code_id`, `discound_code`, `value`) VALUES
(6, 'Jina_Family929', 15),
(5, '525', 10);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message_order` varchar(255) NOT NULL,
  `subject` varchar(6) NOT NULL,
  `message` text NOT NULL,
  `send_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(150) NOT NULL,
  `notes` text NOT NULL,
  `discound` float NOT NULL DEFAULT 0,
  `done` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_time`, `fullname`, `email`, `phone`, `country`, `city`, `street`, `notes`, `discound`, `done`) VALUES
(36, 13, '2020-08-20 12:45:16', '1597927516', 'waleed', 'waleed@nanologistic.net', '23423423', 1, 'salmiya', 'st55', 'This is a test', 0, 1),
(37, 9, '2020-08-22 08:14:42', '1598084082', 'فيصل محمد', 'ameen_24@hotmail', '97125256', 1, 'farwaniya', '4', '', 0, 1),
(38, 9, '2020-08-22 08:15:36', '1598084136', 'فيصل محمد', 'ameen_24@hotmail', '97125256', 1, 'farwaniya', '4', '', 0, 0),
(39, 3, '2020-08-23 09:44:37', '1598175877', 'omnia abdelhamed', 'omnia.silmy@gmail.com', '01060368263', 2, 'الزقازيق', 'زقازيق', '', 0, 0),
(40, 11, '2020-09-02 16:19:24', '1599063564', 'Ah', 'eng.ah2019@gmail.com', '0096550970589', 1, 'Fff', 'Fff', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `product_code`, `order_quantity`, `size_id`) VALUES
(74, 36, 'efca', 1, NULL),
(75, 37, 'HEF10119', 1, NULL),
(76, 38, 'HEF10119', 1, NULL),
(77, 39, 'HEN10033', 2, NULL),
(78, 40, 'ELS10116', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_code` varchar(100) NOT NULL,
  `product_title_ar` varchar(255) NOT NULL,
  `product_title_en` varchar(255) NOT NULL,
  `product_main_image` varchar(255) NOT NULL,
  `product_details_ar` text NOT NULL,
  `product_details_en` text NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `product_added_date` datetime NOT NULL,
  `product_last_updated_date` datetime NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) NOT NULL,
  `best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_code`, `product_title_ar`, `product_title_en`, `product_main_image`, `product_details_ar`, `product_details_en`, `product_price`, `product_added_date`, `product_last_updated_date`, `product_quantity`, `category_id`, `subcategory_id`, `best_seller`, `new_arrival`, `id`) VALUES
('efca', 'adfcsdc', 'cadcadc', 'efca_mainImage.PNG', 'نتيشبؤتي شيىشسةيش يتسشىيةشسي شيتشىسيسي شتيشسيشسي شسيىشسيشسي شيىشنتيشسي شسيتنشميصشي تنينشيصشيشي نتيىشسيضصي تصيشصيشيشي ضصتيييييييييييي صنتييييييييي تنييييييييييييييييييييييي تييييييييييييييييي تنيصضيضي صتييييييييييييييييييي', '', '1.5', '2020-08-19 13:56:03', '2020-08-19 13:56:03', 1, 12, 8, 0, 0, 34),
('ELB10097', 'فلولبس هو الحل الكامل للجسم لإزالة الشعر بشكل فوري وغير مؤلم.', 'Flawlbss Body is the total body solution for instant, painless, hair removal.', 'ELB10097_mainImage.jpg', 'فلولبس هو الحل الكامل للجسم لإزالة الشعر بشكل فوري وغير مؤلم. \r\nمع تقنية الحساس ، فهي مثالية للمناطق الأكثر حساسية ، \r\nوتحت الإبطين ، والبيكيني ، والكاحلين ، والركبتين.', 'Flawlbss Body is the total body solution for instant, painless, hair removal. \r\nWith sense-guard technology, it’s perfect for your most sensitive areas,\r\n underarms, bikini, ankles, and knees.', '5', '2020-08-21 20:28:05', '2020-08-21 20:28:05', 1, 20, 26, 0, 0, 38),
('ELS10016', 'سولو، تحتوي كل عبوة على ماكينة حلاقة وتشذيب كاملة للجسم والوجه واللحية.', 'Solo; Each package contains an all-in-one full body, face and beard shaver and trimmer.', 'ELS10016_mainImage.jpg', 'سولو، تحتوي كل عبوة على ماكينة حلاقة وتشذيب كاملة للجسم والوجه واللحية. ث\r\nلاثة ملحقات تقليم وكابل شحن USB واحد. ت\r\nحتوي كل ماكينة حلاقة على ضوء LED مدمج ورأس محوري يحيط بعنقك وظهرك وصدرك بكل سهولة. \r\nأمشاط التشذيب (1 مم ، 3 مم ، 5 مم)', 'Flawlbss Body is the total body solution for instant, painless,\r\n hair removal. \r\nWith sense-guard technology, it’s perfect for your most sensitive\r\nareas,  underarms, bikini, ankles, and knees.', '4', '2020-08-21 20:33:37', '2020-08-21 20:33:37', 1, 20, 26, 0, 0, 39),
('ELS10030', 'سومو، ماكينة قص الشعر - 5 شفرات -اللون أحمر', 'Sumo; Hair Clipper - 5 Blades - Color Red.', 'ELS10030_mainImage.jpeg', 'سومو، ماكينة قص الشعر - 5 شفرات -اللون أحمر -\r\n وداعًا لشفرات الحلاقة المرهقة والصالونات باهظة الثمن. \r\nيوفر Sumo Clipper بمحركه الفعال تشذيبًا على غرار الصالون دائمًا. \r\nيأتي مع شفرات من الفولاذ المقاوم للصدأ ، صديقة للبشرة، للحصول على أفضل تجربة. \r\nإلى جانب الخيارات لأطوال اللحية المختلفة', 'Sumo; Hair Clipper - 5 Blades - Color Red - \r\nSay good-bye to cumbersome razors and expensive salons. \r\nThe Sumo Clipper with its efficient motor, offers a salon-style trim, always.\r\n It comes with stainless-steel, skin-friendly blades and comb tips, \r\nfor the best experience. Along with options for different beard lengths', '5', '2020-08-21 20:36:00', '2020-08-21 20:36:00', 1, 20, 26, 0, 0, 40),
('ELS10032', 'يوكو، مكينة 3 في 1 للرجال', 'Yoko; Trimmer - 3 in 1 For Men.', 'ELS10032_mainImage.jpg', 'يوكو، مكينة 3 في 1 للرجال ، ماكينة حلاقة قابلة للشحن ، \r\nحواف رقيقة للغاية للحية، أداة تشذيب الشعر الطويل لتشكيل شعر الوجه والشارب والسوالف. \r\nشحن البطارية بالكامل خلال 8 ساعات.', 'Yoko; Trimmer - 3 in 1 For Men,  \r\nRechargeable Hair Trimmer, Ultra-thin Alloy sharp edge. \r\nAgreeable outline of switch catch. \r\nLong hair trimmer for forming facial hair, mustache and sideburns. \r\nBattery completely revives in 8 hours.', '5', '2020-08-21 20:56:29', '2020-08-21 20:56:29', 1, 20, 26, 0, 0, 41),
('ELS10070', 'موزر، ماكينة قص الشعر الاحترافية التي تعمل بالتيار الرئيسي', 'Moser 1400; Professional Mains-Operated Hair Clipper', 'ELS10070_mainImage.jpg', '&#34;موزر، ماكينة قص الشعر الاحترافية التي تعمل بالتيار الرئيسي\r\nشفرة النجم: مجموعة شفرات من الفولاذ المقاوم للصدأ بدقة 0.1 - 3 مم طول قطع\r\nمتغير: تعديل طول قطع MultiClick مع 5 أوضاع محددة مسبقًا 0.7 - 3 مم\r\nقوي: محرك حديد متذبذب للغاية وقوي للغاية مع أداء أعلى بنسبة 50٪\r\nالمحرك المتذبذب: تقريبا. 6000 دورة في الدقيقة .&#34;', '&#34;Moser 1400; Professional Mains-Operated Hair Clipper\r\nStar Blade: Precision-ground stainless steel blade set 0.1 - 3 mm cutting length\r\nVariable: MultiClick cutting length adjustment with 5 pre-set positions 0.7 - 3 mm\r\nStrong: Extremely quite and powerful oscillating armature motor with 50% higher performance\r\nOscillating Armature motor: Approx. 6000rpm ; Type of operation: Cord&#34;', '5.5', '2020-08-21 20:59:13', '2020-08-21 20:59:13', 1, 20, 26, 0, 0, 42),
('ELS10071', 'كوليدا، جهاز حلاقة الشعر، يحتوي على 4 شفرات للتدريج، يعمل بالكهرباء', 'Koleda; Hair Clipper - 4 Blades; code RF-6040', 'ELS10071_mainImage.png', 'كوليدا، جهاز حلاقة الشعر، يحتوي على 4 شفرات للتدريج، يعمل بالكهرباء', 'Koleda; Hair Clipper - 4 Blades; code RF-6040', '4', '2020-08-22 07:01:43', '2020-08-22 07:01:43', 1, 20, 26, 1, 1, 43),
('ELS10116', '4 شفرات تدريج خاصة لمكينه موزر', 'Four Blades special for Moser 1400', 'ELS10116_mainImage.jpg', 'شفرات تدريج خاصة لمكينه موزر\r\n4 أحجام مختلفة لحلاقة اسهل وتحكم أكثر بطول الشعر', 'Four Blades special for Moser 1400\r\nDifferent sizes for better shaving & control', '2.250', '2020-08-22 07:04:46', '2020-08-22 07:04:46', 1, 20, 26, 1, 1, 44),
('HEB10042', 'موس حلاقة  صنع في باكستان - بلاستيك', 'Straight Razor - Plastic', 'HEB10042_mainImage.png', 'موس حلاقة  صنع في باكستان - بلاستيك', 'Straight Razor - Plastic', '1', '2020-08-22 07:12:06', '2020-08-22 07:12:06', 1, 12, 15, 1, 0, 45),
('HEB10125', 'خيمة الساونا', 'Family Sauna', 'HEB10125_mainImage.jpg', 'خيمة الساونا', 'Family Sauna', '20', '2020-08-22 07:13:50', '2020-08-22 07:13:50', 1, 12, 18, 1, 0, 46),
('HEC10003', 'فرشاة شعر مستديرة خشبية', 'Round Hair Brush Wood', 'HEC10003_mainImage.jpeg', 'فرشاة شعر مستديرة خشبية\r\nمناسب للسشوار \r\nالحجم الكبير\r\nرقم 53', 'Round Hair Brush\r\nLarge Size\r\ncode. 9-13 No. 53', '2.25', '2020-08-16 18:51:58', '2020-08-16 18:51:58', 4, 12, 9, 0, 0, 25),
('HEC10004', 'فرشاة شعر مستديرة خشبية', 'Round Hair Brush Wood', 'HEC10004_mainImage.jpeg', 'فرشاة شعر مستديرة خشبية\r\nمناسب للسشوار \r\nالحجم الكبير اكسترا\r\nرقم 65', 'Round Hair Brush\r\nX-Large Size\r\ncode. 9-14 No. 65', '3', '2020-08-16 18:53:22', '2020-08-16 18:53:22', 1, 12, 9, 0, 0, 26),
('HEC10005', 'فرشاة شعر مستديرة سيراميك حجم S', 'Round Hair Brush Ceramic Size S', 'HEC10005_mainImage.jpg', 'فرشاة شعر مستديرة سيراميك حجم S\r\nمناسب للسشوار', 'Round Hair Brush Ceramic Size S\r\ncode. 9-1', '2.250', '2020-08-16 19:08:22', '2020-08-16 19:08:22', 2, 12, 9, 0, 0, 27),
('HEC10006', 'فرشاة شعر مستديرة سيراميك حجم M', 'Round Hair Brush Ceramic Size M', 'HEC10006_mainImage.jpg', 'فرشاة شعر مستديرة سيراميك حجم M\r\nمناسب للسشوار', 'Round Hair Brush Ceramic Size M\r\ncode. 9-1', '2.75', '2020-08-16 19:10:53', '2020-08-16 19:10:53', 1, 12, 9, 0, 0, 28),
('HEC10007', 'فرشاة شعر مستديرة سيراميك حجم L', 'Round Hair Brush Ceramic Size L', 'HEC10007_mainImage.jpg', 'فرشاة شعر مستديرة سيراميك حجم L\r\nمناسب للسشوار', 'Round Hair Brush Ceramic Size L\r\ncode. 9-3', '3.500', '2020-08-16 19:12:17', '2020-08-16 19:12:17', 2, 12, 9, 0, 0, 29),
('HEC10008', 'فرشاة شعر مستديرة سيراميك حجم XL', 'Round Hair Brush Ceramic Size XL', 'HEC10008_mainImage.jpg', 'فرشاة شعر مستديرة سيراميك حجم XL\r\nمناسب للسشوار', 'Round Hair Brush Ceramic Size XL\r\ncode. 9-4', '4', '2020-08-16 19:13:25', '2020-08-16 19:13:25', 3, 12, 9, 0, 0, 30),
('HEC10047', 'مشط خشبي code. 1-07', 'Comb Wood code. 1-07', 'HEC10047_mainImage.png', 'مشط خشبي code. 1-07', 'Comb Wood code. 1-07', '0.750', '2020-08-22 07:17:35', '2020-08-22 07:17:35', 1, 12, 9, 1, 0, 47),
('HEC10048', 'مشط زمن الطيبين الخشبي للحناء', 'Comb Wood for Henna', 'HEC10048_mainImage.png', 'مشط زمن الطيبين الخشبي للحناء', 'Comb Wood for Henna', '0.750', '2020-08-22 07:19:02', '2020-08-22 07:19:02', 1, 12, 9, 0, 0, 48),
('HEC10049', '&#34;Toni & Guy مشط اللحية الكلاسيكي الأسود المقاوم للكهرباء الساكنة.&#34;', 'Toni & Guy; Code.980 - Beard Comb.', 'HEC10049_mainImage.jpg', '&#34;Toni & Guy\r\nمشط اللحية الكلاسيكي الأسود المقاوم للكهرباء الساكنة. تم تصميمه وفقًا لأعلى المعايير لتقديم الأفضل في الدقة والجودة.\r\n18.5 x 1.5-2.5 x 0.4cm&#34;', 'Toni & Guy; Code.980 - Beard Comb, The Professional Salon Hair Cutting Combs; Classic Carbon Anti-Static Black Barber Comb; designed to the highest standards to offer the best in precision and quality.', '0.750', '2020-08-22 07:20:42', '2020-08-22 07:20:42', 1, 12, 9, 0, 0, 49),
('HEC10050', '&#34;Toni & Guy مشط الشعر الكلاسيكي الأسود المقاوم للكهرباء الساكنة. &#34;', 'Toni & Guy;  Code 4011; Hair Comb.', 'HEC10050_mainImage.jpg', '&#34;Toni & Guy\r\nمشط الشعر الكلاسيكي الأسود المقاوم للكهرباء الساكنة. تم تصميمه وفقًا لأعلى المعايير لتقديم الأفضل في الدقة والجودة.\r\n18.4 x 2.8 x 0.3cm&#34;', 'Toni & Guy;  Code 4011; Hair Comb, The Professional Salon Hair Cutting Combs; Classic Carbon Anti-Static Black Barber Comb; designed to the highest standards to offer the best in precision and quality.', '0.750', '2020-08-22 07:25:22', '2020-08-22 07:25:22', 1, 12, 9, 0, 0, 50),
('HEC10056', 'مشط القمل Novax.', 'Novax Lice Comb.', 'HEC10056_mainImage.png', 'مشط القمل Novax. يمكن استخدام مشط القمل ذو الأسنان الدقيقة للكشف\r\n عن قمل الرأس وإجراء العلاج باستخدام طريقة التمشيط الرطب.', 'Novax Lice Comb; a fine toothed nit comb can be used to \r\ndetect head lice and undertake treatment using wet combing method.', '0.750', '2020-08-22 07:36:05', '2020-08-22 07:36:05', 1, 12, 9, 0, 0, 51),
('HEE10061', 'فلولبس، مزيل شعر الحاجب الزائد،', 'Flawlbss; Eyebrow Remover; Chargable', 'HEE10061_mainImage.jpg', 'فلولبس، مزيل شعر الحاجب الزائد،\r\n يجب استخدام رأس إزالة الشعر الدقيق في الجزء العلوي والسفلي من الحواجب وبين الحاجبين ، \r\nلازالة شعر الحاجب غير المرغوب فيه والشارد. آمن و فوري بدون معاناة', 'Flawlbss\r\nEyebrow Remover\r\nThe precision hair removal tip is to be used on the top and bottom of brows and in between eyebrows,\r\n to erase unwanted and stray eyebrow hair.\r\nThe perfect substitute for eyebrow shaver. SAFE AND INSTANT PAINLESS Chargeable', '5', '2020-08-22 07:42:46', '2020-08-22 07:42:46', 1, 12, 13, 0, 0, 52),
('HEF10035', 'مزيل الطبقة الصلبة للقدم.', 'Foot Callus Remover.', 'HEF10035_mainImage.jpg', 'مزيل الطبقة الصلبة للقدم.\r\n لطيف على قدميك وسهل الاستخدام ، حجر الدوران الإلكتروني يساعدك بسرعة للحصول على أقدام ناعمة وحريرية.\r\n تم تصميم حجر الدوران الإلكتروني هذا لإزالة الجلد الصلب للحصول على نتائج سلسة بعد استخدام واحد فقط.', 'Foot Callus Remover\r\nGentle on your feet and easy to use, Electronic Foot File quickly helps you achieve soft, silky feet.\r\n This electronic foot file is designed to remove hard skin for smooth results after just one use.', '2', '2020-08-22 07:45:57', '2020-08-22 07:45:57', 1, 12, 14, 0, 0, 53),
('HEF10101', 'حفافة خيط يدوية لإزالة شعر الوجه والجسم، سهل الاستخدام', 'Manual Face & Body Hair Threading System, So Easy to use', 'HEF10101_mainImage.jpg', 'حفافة خيط يدوية لإزالة شعر الوجه والجسم، سهل الاستخدام', 'Manual Face & Body Hair Threading System, So Easy to use', '1.500', '2020-08-22 07:48:58', '2020-08-22 07:48:58', 1, 12, 8, 0, 0, 54),
('HEF10102', 'قوارير صغير فارغة مناسبة لزيوت الشعر والكريمات', 'Empty Bottle Set, Perfect for Travelling', 'HEF10102_mainImage.PNG', 'قوارير صغير فارغة مناسبة لزيوت الشعر والكريمات', 'Empty Bottle Set, Perfect for Travelling', '1.500', '2020-08-22 07:50:32', '2020-08-22 07:50:32', 1, 12, 21, 0, 0, 55),
('HEF10119', 'لصقات التنظيف العميق لمسامات سطح الانف', 'PUREDERM; Nose Strips; 6 Sheets in box', 'HEF10119_mainImage.PNG', 'قوارير صغير فارغة مناسبة لزيوت الشعر والكريمات', 'Empty Bottle Set, Perfect for Travelling', '1', '2020-08-22 08:00:26', '2020-08-22 08:00:26', 1, 12, 8, 0, 0, 56),
('HEG10028', 'منظم مستحضرات التجميل صغير وأنيق', 'Cosmetic Organizer,', 'HEG10028_mainImage.jpeg', 'منظم مستحضرات التجميل ، لتوفير مساحة في لمحة', 'Cosmetic Organizer, To save a space at a glance', '2.5', '2020-08-22 08:05:48', '2020-08-22 08:05:48', 1, 12, 21, 0, 0, 57),
('HEG10120', 'بوكس تخزين علب المناكير (فارغ)', 'Empty nail polish box', 'HEG10120_mainImage.jpg', 'بوكس تخزين علب المناكير (فارغ)\r\nمساحة تتسع ل 48 علبة مناكير', 'Empty nail polish box \r\nspace enough for 48 Pcs', '7.5', '2020-08-22 08:12:02', '2020-08-22 08:12:02', 1, 12, 10, 0, 0, 58),
('HEH10040', 'بخاخ الشعر H2O', '&#34;H2O Water Spray Bottle. Body Material: Steel&#34;', 'HEH10040_mainImage.png', 'بخاخ الشعر H2O بشكله المميز والفريد يسهل عملية التسريح \r\nوالقص والسشوار مصنوع من الستيل. سعة 300مل', '&#34;H2O Water Spray Bottle; it&#39;s an extremely useful type of machine and an excellent demonstration\r\n of basic plumbSSing principles\r\nBody Material: Steel&#34;\r\n300ML', '1.5', '2020-08-22 08:23:04', '2020-08-22 08:23:04', 1, 12, 12, 0, 0, 59),
('HEH10150', 'فرش و طبق خاص للصبغة 4 قطع', '4 PCS Dye Brush Kit', 'HEH10150_mainImage.jpg', 'فرش و طبق خاص للصبغة 4 قطع', '4 PCS Dye Brush Kit', '1.5', '2020-08-22 08:24:10', '2020-08-22 08:24:10', 1, 12, 12, 0, 0, 60),
('HEN10010', 'شنطة العناية بالاظافر تتكون من 15 قطعة، لون أزرق', 'Nail Care Bag - Color Blue 15 Pcs', 'HEN10010_mainImage.jpg', 'شنطة العناية بالاظافر تتكون من 15 قطعة، لون أزرق', 'Nail Care Bag - Color Blue 15 Pcs', '15', '2020-08-22 08:31:24', '2020-08-22 08:31:24', 1, 12, 10, 0, 0, 61),
('HEN10011', 'شنطة العناية بالاظافر تتكون من 15 قطعة، لون رمادي', 'Nail Care Bag - Color Gray 15 Pcs', 'HEN10011_mainImage.jpg', 'شنطة العناية بالاظافر تتكون من 15 قطعة، لون رمادي', 'Nail Care Bag - Color Gray 15 Pcs', '15', '2020-08-22 08:53:15', '2020-08-22 08:53:15', 2, 12, 10, 0, 1, 62),
('HEN10033', 'سائل العناية بالاظافر', 'Podicare Liquid', 'HEN10033_mainImage.jpeg', 'سائل العناية بالاظافر، للاستخدام قبل وبعد البوديكير.', 'Podicare Liquid', '1', '2020-08-22 08:55:32', '2020-08-22 08:55:32', 1, 12, 10, 0, 0, 63),
('HEN10036', 'طقم مونيكير مكون من 17 قطعة داخل شنطة مميزة وتغليف فاخر', 'Monicare Kit 17 pcs', 'HEN10036_mainImage.jpg', 'طقم مونيكير\r\n مكون من 17 قطعة\r\n داخل شنطة مميزة وتغليف فاخر', 'Monicare Set\r\n17 Pcs\r\nFancy Packing', '4', '2020-08-24 17:50:40', '2020-08-24 17:50:40', 1, 12, 10, 1, 0, 64),
('HEN10037', 'مقص لحمية', 'Nipper', 'HEN10037_mainImage.png', 'مقص لحمية', 'Nipper', '1.5', '2020-08-24 17:52:51', '2020-08-24 17:52:51', 1, 12, 10, 0, 0, 65),
('HEN10051', 'قصاصة اظافر', 'Nail Clipper Cutter', 'HEN10051_mainImage.png', 'قصاصة اظافر', 'Nail Clipper Cutter', '0.500', '2020-08-24 17:54:14', '2020-08-24 17:54:14', 1, 12, 10, 0, 0, 66),
('HEN10053', 'مبرد اظافر ستيل', 'Nail File Steel', 'HEN10053_mainImage.png', 'مبرد اظافر ستيل', 'Nail File Steel', '0.750', '2020-08-24 17:56:02', '2020-08-24 17:56:02', 1, 12, 10, 0, 0, 67),
('HEN10096', 'ملمع اظافر', 'Shine Nail - Nail File', 'HEN10096_mainImage.jpg', 'ملمع اظافر', 'Shine Nail - Nail File', '0.500', '2020-08-24 17:57:22', '2020-08-24 17:57:22', 1, 12, 10, 0, 0, 68),
('HES10012', 'فرشة حلاقة  للرجال بقاعدة خشب', 'Shaving Brush - Men - Wood', 'HES10012_mainImage.png', 'فرشة حلاقة  للرجال بقاعدة خشب', 'Shaving Brush - Men - Wood', '0.750', '2020-08-24 18:09:09', '2020-08-24 18:09:09', 1, 12, 29, 0, 0, 70),
('HES10013', 'شنطة حلاقة متكاملة للرجال', 'Shaving Bag Set for Men', 'HES10013_mainImage.png', 'شنطة حلاقة متكاملة للرجال 16 قطعه', 'Shaving Bag Set for Men\r\n16 Pcs', '15', '2020-08-24 18:14:20', '2020-08-24 18:14:20', 1, 12, 29, 0, 0, 71),
('HES10014', 'جهاز 7 في 1 مزيل الطبقة الصلبة ومدلك للوجه والجسم', 'Face & Body  7 in 1 Callous Remover & Massager', 'HES10014_mainImage.jpeg', 'جهاز 7 في 1 مزيل الطبقة الصلبة ومدلك ؛ \r\nامنحي نفسك باديكير احترافيًا وأنتي في المنزل لأن جهاز  7 في 1 هو كل ما تحتاجينه للحصول على أيدي وأقدام مثالية ومهذبة. \r\nتساعد المرفقات السبعة مع الجهاز في أداء المهمة بكفاءة وبجهد أقل.', 'Face 7 in 1 Callous Remover & Massager; Give yourself a professional pedicure while at home because this 7 in 1 Callous Massager is all you need to get perfect and groomed hands and feet. The 7 attachments with the device help in doing the job efficiently with fewer efforts.', '2.5', '2020-08-16 19:29:01', '2020-08-16 19:29:01', 6, 12, 11, 0, 0, 31),
('HES10015', '&#34;جونديلي، فرشاة تنظيف الوجه وأداة العناية بالجمال  Code. JDL-808&#34;', 'Jundeli. Facial Cleansing Brush  Code. JDL-808', 'HES10015_mainImage.jpg', '&#34;جونديلي، \r\nفرشاة تنظيف الوجه وأداة العناية بالجمال بالإضافة الى جهاز ازالة الشعر بالخيوط \r\nومدلك الوجه  يترك بشرتك ناعمة، يعمل بالشحن.\r\n\r\nCode. JDL-0808&#34;', 'Jundeli. \r\nFacial Cleansing Brush  & Beauty Care Artifact & Professional\r\n natural threading hair remover and facial cleansing massager\r\n Hair remover leaves your skin soft and stubble free A safe home use facial threader Rechargeable hair remover.  \r\nCode. JDL-0808', '6.5', '2020-08-24 18:23:55', '2020-08-24 18:23:55', 1, 12, 11, 0, 0, 73),
('HES10019', 'جهاز شفط البثور، بالبطاريات (البطاريات غير مشمولة)', 'Derma Suction Cup (battries not included)', 'HES10019_mainImage.jpg', 'جهاز شفط البثور، \r\nطريقة جديدة لتنظيف المسام. يزيل الرؤوس السوداء والأوساخ بلطف\r\n من المسام على وجهك دون الضغط، يعمل بالبطاريات.', 'Derma Suction Cup; \r\nNew way to clean pores. \r\nIt gently removes blackheads and dirt from the pores on your face without squeezing. \r\nWroks with Battries.', '4', '2020-08-24 18:33:13', '2020-08-24 18:33:13', 1, 12, 11, 0, 0, 74),
('HES10022', 'جهاز بخار الوجه', 'Facial Steamer', 'HES10022_mainImage.png', 'جهاز بخار الوجه', 'Facial Steamer', '7', '2020-08-24 18:38:14', '2020-08-24 18:38:14', 1, 12, 8, 0, 0, 75),
('HES10044', 'مقص شعر الراس رقم 6.5 -  صنع في باكستان', 'Hair Cut Scissor No. 6.5 Made in Pakistan', 'HES10044_mainImage.png', 'مقص شعر الراس رقم 6.5 -  صنع في باكستان', 'Hair Cut Scissor No. 6.5 Made in Pakistan', '2.5', '2020-08-24 18:39:55', '2020-08-24 18:39:55', 1, 12, 16, 0, 0, 76),
('HES10052', 'ملقط حواجب', 'Slant/ Brow Twezzer', 'HES10052_mainImage.png', 'ملقط حواجب', 'Slant/ Brow Twezzer', '1', '2020-08-24 18:42:15', '2020-08-24 18:42:15', 1, 12, 16, 0, 0, 77),
('HES10057', 'طاسة حلاقة اللحية', 'Shaving Tasa', 'HES10057_mainImage.jpg', 'طاسة حلاقة اللحية', 'Shaving Tasa', '0.500', '2020-08-24 18:47:12', '2020-08-24 18:47:12', 1, 12, 29, 0, 0, 78),
('HES10058', 'ماكينة حلاقة شعر الأنف والأذن', 'Stallion; Nose and Ears Hair Trimmer', 'HES10058_mainImage.jpeg', 'ماكينة حلاقة شعر الأنف والأذن', 'Stallion; Nose and Ears Hair Trimmer', '1.750', '2020-08-24 18:49:22', '2020-08-24 18:49:22', 1, 12, 29, 0, 0, 79),
('HES10067', 'فرشاة الجسم سبين سبا تسمح بتنظيف قوي مليء بالفخامة والراحة.', 'The Spinning SPA Brush, Battery powered', 'HES10067_mainImage.jpg', '&#34;فرشاة الجسم سبين سبا تسمح بتنظيف قوي مليء بالفخامة والراحة.\r\nتشمل الملحقات: التدليك | | تقشير الجلد || حجر الخوخ\r\nاسفنجة شبكية || تنظيف\r\nتتطلب 3 بطاريات AA (غير متضمنة) ||| القياسات: عرض 8.74 سم × ارتفاع 35.56 سم × عمق 20.32 سم.\r\nيمكن استخدام أي نوع صابون&#34;', '&#34;The Spinning SPA Brush, Battery powered - 3 AAA (not included)\r\nNothing to install\r\nIncludes Five Attachments: Microderm, Massage, Brush, Pumice And Cleansing Headو \r\nLong Handle Makes Reaching Your Back And Lower Legs Easier ; Featured With A Hi/Low Button For Speed Adjustments\r\nUse any soap or body wash&#34;', '5', '2020-08-24 18:52:41', '2020-08-24 18:52:41', 1, 12, 11, 0, 0, 80),
('HES10073', 'جهاز تسخين الشمع، ممكن تعديل درجة الحرارة من 0 درجة إلى 55 درجة', 'The Pro-Wax100 Brand Wax Warmer by ouye inc.', 'HES10073_mainImage.png', '&#34;جهاز تسخين الشمع، ممكن تعديل درجة الحرارة من 0 درجة إلى 55 درجة\r\nكما أنها رائعة لفنيي الأظافر والمعالجين المتنقلين والطلاب أو للاستخدام المنزلي\r\nمناسب لجميع أنواع الشموع. مناسبة لاستخدام الصالون&#34;', '&#34;The Pro-Wax100 Brand Wax Warmer by ouye inc.\r\nTemperature can be adjustable from 0 degree to 55 degree\r\nAlso great for Nail Technicians, mobile Therapists, students or for home use\r\nSuitable for all types of waxes; Suitable for professional salon use&#34;', '5', '2020-08-24 18:55:15', '2020-08-24 18:55:15', 1, 12, 11, 0, 0, 81),
('HES10074', 'جهاز اذابة الشمع والبارافين للاستخدام الشخصي، للصالونات ومراكز السبا،', 'Paraffin Wax Warmer /Wax Heater for Salon and SPA Use', 'HES10074_mainImage.jpg', 'جهاز اذابة الشمع والبارافين للاستخدام الشخصي، \r\nللصالونات ومراكز السبا، مكن تعديل درجة الحرارة من 0 درجة إلى 80 درجة', 'Paraffin Wax Warmer /Wax Heater for Salon and SPA Use\r\nfrom zero to 80 degree', '12', '2020-08-24 18:59:52', '2020-08-24 18:59:52', 1, 12, 11, 0, 0, 82),
('HES10105', 'جهاز شفط البثور', 'Menqshahayd; code xn-8030 -Suction Cup', 'HES10105_mainImage.jpg', 'جهاز شفط البثور، \r\nطريقة جديدة لتنظيف المسام. يزيل الرؤوس السوداء والأوساخ بلطف\r\n من المسام على وجهك دون الضغط، يعمل بالشحن.\r\n كود 8030', 'Menqshahayd; \r\ncode xn-8030 -Suction Cup; \r\nElectric Blackhead Remover: \r\nA revolutionary new facial care product aims to clean \r\nblackhead more effective. Popular product, \r\nMost wish for and Best gift for fourteen years and up. \r\nSafe and Painless.', '4', '2020-08-24 19:04:09', '2020-08-24 19:04:09', 1, 12, 11, 0, 0, 83),
('HES10110', '&#34;Excel مقص حواجب باكستاني&#34;', 'Excel - Eyebrow Scissor, Made in Pakistan.', 'HES10110_mainImage.png', '&#34;Excel\r\nمقص حواجب باكستاني&#34;', 'Excel - Eyebrow Scissor, Made in Pakistan.', '1', '2020-08-25 18:20:01', '2020-08-25 18:20:01', 1, 12, 16, 0, 0, 84),
('HES10111', 'مقص شنب رقم 4 باكستاني', 'mustache scissor No. 4, Made in Pakistan.', 'HES10111_mainImage.png', 'مقص شنب رقم 4 باكستاني', 'mustache scissor No. 4, Made in Pakistan.', '1', '2020-08-25 18:22:51', '2020-08-25 18:22:51', 1, 12, 16, 0, 0, 85),
('HES10112', 'ملقط ستيل للوجه حجم كبير', 'Face tweezer Large Size', 'HES10112_mainImage.png', 'ملقط ستيل للوجه حجم كبير', 'Face tweezer Large Size', '1', '2020-08-25 18:26:29', '2020-08-25 18:26:29', 1, 12, 16, 0, 0, 86),
('HES10118', 'جل حلاقة', 'Reborn; Shaving Gel', 'HES10118_mainImage.jpg', 'جل حلاقة، 500 مل', 'Reborn; Shaving Gel- 500ML', '0.750', '2020-08-25 18:29:48', '2020-08-25 18:29:48', 1, 12, 29, 0, 0, 87),
('HES10126', 'بلوك شمع إيطالي بالعسل', 'Milano Plus; Hot Wax Block (Honey), Yellow', 'HES10126_mainImage.jpg', 'بلوك شمع إيطالي بالعسل، وزن 1 كيلو', 'Milano Plus; Hot Wax Block (Honey), Yellow', '3.500', '2020-08-25 18:37:15', '2020-08-25 18:37:15', 1, 12, 11, 0, 0, 88);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_extra_image` varchar(255) NOT NULL,
  `image_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_code`, `product_extra_image`, `image_num`) VALUES
(19, 'HEC10005', 'HEC10005_addionalImage0.jpg', 0),
(20, 'HES10014', 'HES10014_addionalImage0.jpg', 0),
(27, 'ELB10097', 'ELB10097_addionalImage0.jpg', 0),
(28, 'ELS10016', 'ELS10016_addionalImage0.jpeg', 0),
(29, 'ELS10030', 'ELS10030_addionalImage0.jpeg', 0),
(30, 'ELS10032', 'ELS10032_addionalImage0.jpg', 0),
(31, 'ELS10070', 'ELS10070_addionalImage0.jpg', 0),
(32, 'ELS10071', 'ELS10071_addionalImage0.png', 0),
(33, 'ELS10116', 'ELS10116_addionalImage0.jpg', 0),
(34, 'HEB10042', 'HEB10042_addionalImage0.png', 0),
(35, 'HEB10125', 'HEB10125_addionalImage0.jpg', 0),
(36, 'HEC10047', 'HEC10047_addionalImage0.png', 0),
(37, 'HEC10048', 'HEC10048_addionalImage0.png', 0),
(38, 'HEC10049', 'HEC10049_addionalImage0.jpg', 0),
(39, 'HEC10050', 'HEC10050_addionalImage0.jpg', 0),
(40, 'HEC10056', 'HEC10056_addionalImage0.png', 0),
(41, 'HEE10061', 'HEE10061_addionalImage0.jpg', 0),
(42, 'HEF10035', 'HEF10035_addionalImage0.jpeg', 0),
(43, 'HEF10101', 'HEF10101_addionalImage0.jpg', 0),
(44, 'HEF10102', 'HEF10102_addionalImage0.png', 0),
(45, 'HEF10119', 'HEF10119_addionalImage0.png', 0),
(46, 'HEG10028', 'HEG10028_addionalImage0.jpeg', 0),
(47, 'HEG10120', 'HEG10120_addionalImage0.png', 0),
(48, 'HEH10040', 'HEH10040_addionalImage0.jpeg', 0),
(49, 'HEH10150', 'HEH10150_addionalImage0.jpg', 0),
(50, 'HEN10010', 'HEN10010_addionalImage0.jpg', 0),
(51, 'HEN10011', 'HEN10011_addionalImage0.jpg', 0),
(52, 'HEN10033', 'HEN10033_addionalImage0.jpeg', 0),
(53, 'HEN10036', 'HEN10036_addionalImage0.jpg', 0),
(54, 'HEN10037', 'HEN10037_addionalImage0.png', 0),
(55, 'HEN10051', 'HEN10051_addionalImage0.png', 0),
(56, 'HEN10053', 'HEN10053_addionalImage0.png', 0),
(57, 'HEN10096', 'HEN10096_addionalImage0.jpg', 0),
(59, 'HES10012', 'HES10012_addionalImage0.png', 0),
(60, 'HES10013', 'HES10013_addionalImage0.png', 0),
(62, 'HES10015', 'HES10015_addionalImage0.jpg', 0),
(63, 'HES10019', 'HES10019_addionalImage0.jpg', 0),
(64, 'HES10022', 'HES10022_addionalImage0.png', 0),
(65, 'HES10044', 'HES10044_addionalImage0.png', 0),
(66, 'HES10052', 'HES10052_addionalImage0.png', 0),
(67, 'HES10057', 'HES10057_addionalImage0.jpg', 0),
(68, 'HES10058', 'HES10058_addionalImage0.jpeg', 0),
(69, 'HES10067', 'HES10067_addionalImage0.jpg', 0),
(70, 'HES10073', 'HES10073_addionalImage0.png', 0),
(71, 'HES10074', 'HES10074_addionalImage0.jpg', 0),
(72, 'HES10105', 'HES10105_addionalImage0.jpg', 0),
(73, 'HES10110', 'HES10110_addionalImage0.png', 0),
(74, 'HES10111', 'HES10111_addionalImage0.png', 0),
(75, 'HES10112', 'HES10112_addionalImage0.png', 0),
(76, 'HES10118', 'HES10118_addionalImage0.jpg', 0),
(77, 'HES10126', 'HES10126_addionalImage0.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `product_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `nickname`, `summary`, `review`, `product_code`) VALUES
(15, 'Ameem_24_ameen', 'جهاز جميل', 'very nice i love it', 'HES10014'),
(16, 'Ameem_24_ameen', 'جهاز جميل', 'very nice i love it', 'HES10014');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `about_title` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `about_title_en` varchar(255) NOT NULL,
  `about_en` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `ar_currency` varchar(20) NOT NULL,
  `en_currency` varchar(20) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `about_title`, `about`, `about_title_en`, `about_en`, `email`, `phone`, `whatsapp`, `ar_currency`, `en_currency`, `facebook`, `instagram`) VALUES
(1, 'Jina Store', 'header_logo.png', 'موقع جينا ستور', 'وجهة التجميل المفضلة على الإنترنت في الشرق الأوسط لمستحضرات التجميل والعناية بالبشرة والعطور بوتيكات هو معرض مكياج افتراضي يتميز بمزيج منسق يدويًا من منتجات التجميل والأزياء من أكثر من 700 علامة تجارية عالمية ، وعلامات تجارية محلية وحصرية ، حيث يمكن للعملاء اكتشاف التوصيات الشخصية من أشهر المشاهير في الشرق الأوسط وتسوق اختياراتهم على الإنترنت -اذهب. إنه المكان المناسب لمحبي الموضة ومدمني المكياج الذين يبحثون عن الحل المثالي لجميع مستحضرات التجميل وهواجس الموضة! يتوخى رجل الأعمال الكويتي الشاب ، المتوخى في عام 2015 ، أن يميز منصات التجارة الإلكترونية بين الأقران عن طريق دمج عنصر اجتماعي: فهو يضم المشاهير الخليجيين والعرب والمؤثرين على وسائل التواصل الاجتماعي الذين يوصون بالمنتجات ، مما يسمح للمستهلكين بالتسوق مباشرة من هؤلاء المؤثرين الافتراضيين مخازن داخل بوتيكات. ما بدأ كموزع لمستحضرات التجميل والبضائع في التجارة الإلكترونية في الكويت اليوم ، نمت بشكل كبير ليس فقط لتصبح الوجهة المتميزة لأحدث مجموعة من مستحضرات التجميل ومستحضرات التجميل في الشرق الأوسط ، ولكن أيضًا مركزًا شهيرًا للجمال يقدم تجارب لا مثيل لها لعشاق المكياج والأزياء. تتيح لك البوابة التواصل بسلاسة مع المشاهير المفضلين لديك ، خبراء التجميل والمؤثرين الذين يوفرون وصولًا غير محدود إلى أحدث اتجاهات الموضة وأنماط الموضة ، وأسرار الجمال والموضة ، ونصائح الخبراء ، والتوصيات الشخصية ، وأكثر من ذلك بكثير', 'jinaStore website', 'efds sdfsdf sefse sfs sef xdvsdv 1212', 'jina.storekw@hotmail.com', '0096597125256', '0096597125256', 'د.ك', 'KWD', 'https://www.facebook.com/Jina.Store.Kw/', 'http://instagram.com/jina_storekw');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_title`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, '3XL'),
(9, '4XL');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name_ar` varchar(255) NOT NULL,
  `subcategory_name_en` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `subcategory_name_ar`, `subcategory_name_en`, `category_id`) VALUES
(8, 'الوجه', 'Face', 12),
(9, 'فرش ومشط للشعر', 'Comb & Brush', 12),
(10, 'الأظافر', 'Nails', 12),
(11, 'البشرة', 'Skin', 12),
(12, 'الشعر', 'Hair', 12),
(13, 'الحواجب', 'Eyebrow', 12),
(14, 'القدم', 'Foot', 12),
(15, 'اللحية', 'Beard', 12),
(16, 'مقصات وملاقط', 'Scissors & Tweezers', 12),
(17, 'اليد', 'Hand', 12),
(18, 'الجسم', 'Body', 12),
(19, 'أطياب آية', 'Aya Fargrances', 18),
(21, 'ادوات واكسسوارات', 'Gadgets & Accessories', 12),
(22, 'الألعاب', 'Toys', 23),
(23, 'اكسسوارات', 'Gadgets & Accessories', 24),
(24, 'لوازم الأطفال', 'Kids Stuff', 23),
(25, 'لوازم المنزل', 'Home Stuff', 19),
(26, 'مكائن حلاقة', 'Shaving Machines', 20),
(27, 'مكائن للمساج', 'Massagers', 20),
(28, 'رياضة ورشاقة', 'Sport & Fitness', 22),
(29, 'أدوات حلاقة', 'Shaving Accessories', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_gender` varchar(6) NOT NULL,
  `regesteration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_fullname`, `password`, `user_email`, `user_phone`, `user_gender`, `regesteration_date`) VALUES
(3, 'omnia abdelhamed', '123456', 'omnia.silmy@gmail.com', '01060368263', 'female', '2020-08-01 16:31:24'),
(4, 'امنية عبدالحميد', '123456789', 'omnia_silmy@yahoo.com', '11223', 'female', '2020-08-05 18:11:29'),
(5, 'منشسنمش شسمنيشن', '1478963', 'omnia.silmy1@gmail.com', '12548', 'male', '2020-08-05 19:35:39'),
(6, 'mohammed alshafee', 'mkza1234', 'mh.1983@hotmail.com', '97244282', 'male', '2020-08-08 12:48:58'),
(7, 'mm', '123456', 'm@test.com', '011111111', 'female', '2020-08-09 15:12:10'),
(8, 'فيصل محمد', '123456', 'Faisal.ameen.2008@gmail.com', '99255027', 'male', '2020-08-12 17:30:44'),
(9, 'فيصل محمد', '123456', 'ameen_24@hotmail', '97125256', 'male', '2020-08-12 17:31:22'),
(10, 'omnia', '123456', 'omnia@gmail.com', '111111', 'female', '2020-08-13 13:18:05'),
(11, 'Ah', '123456', 'eng.ah2019@gmail.com', '0096550970589', 'male', '2020-08-15 12:26:16'),
(12, 'محمد امين', '123456', 'm.ameen@gmail.com', '99246893', '', '2020-08-16 08:10:38'),
(13, 'waleed', '123321', 'waleed@nanologistic.net', '23423423', 'male', '2020-08-20 12:43:49'),
(14, 'test', '123456', 'test@gmail.com', '90914635', 'female', '2020-09-03 13:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `address_id` bigint(20) NOT NULL,
  `user_country` int(11) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_area` varchar(100) NOT NULL,
  `user_block` varchar(100) NOT NULL,
  `user_street` varchar(100) NOT NULL,
  `user_house` varchar(100) NOT NULL,
  `user_number` varchar(20) NOT NULL,
  `user_notes` text NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`address_id`, `user_country`, `user_city`, `user_area`, `user_block`, `user_street`, `user_house`, `user_number`, `user_notes`, `user_id`) VALUES
(9, 2, 'الزقازيق', 'الزقازيق', 'dc', 'زقازيق', 'cd', '12', '', 3),
(10, 1, 'فروانية', 'اشبيلية', '4', '400', '3400', 'دور 5', 'شقه 12', 12);

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `wish_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name_ar` (`category_name_ar`);

--
-- Indexes for table `clothes_size`
--
ALTER TABLE `clothes_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `size` (`size_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `discound_codes`
--
ALTER TABLE `discound_codes`
  ADD PRIMARY KEY (`code_id`),
  ADD UNIQUE KEY `discound_code` (`discound_code`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `order_size` (`size_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_code`),
  ADD UNIQUE KEY `count` (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD UNIQUE KEY `subcategory_name_ar` (`subcategory_name_ar`),
  ADD KEY `categoryFK` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_country` (`user_country`),
  ADD KEY `user_country_2` (`user_country`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`wish_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_code` (`product_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clothes_size`
--
ALTER TABLE `clothes_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discound_codes`
--
ALTER TABLE `discound_codes`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `address_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `wish_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clothes_size`
--
ALTER TABLE `clothes_size`
  ADD CONSTRAINT `clothesProductFk` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `clothesclFk` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_product_fk` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `order_size_fk` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `productCategoryFk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `productSubcategoryFk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`subcategory_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `productImageFk` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `product_review_fk` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `categoryFK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `fk_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `fk_wish_product` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`),
  ADD CONSTRAINT `fk_wish_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
