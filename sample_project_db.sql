/*
 Navicat Premium Data Transfer

 Source Server         : localhost_server
 Source Server Type    : MySQL
 Source Server Version : 100131
 Source Host           : 127.0.0.1:3306
 Source Schema         : sample_project_db

 Target Server Type    : MySQL
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 02/06/2018 15:01:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions`  (
  `id` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  INDEX `ci_sessions_timestamp`(`timestamp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('ad4bknfthk19qro6de3q45febr908773', '::1', 1527023235, 0x5F5F63695F6C6173745F726567656E65726174657C693A313532373032333233353B);
INSERT INTO `ci_sessions` VALUES ('pf52emsf2im8sr1grq2p3tl00vfnmi30', '::1', 1527023452, 0x5F5F63695F6C6173745F726567656E65726174657C693A313532373032333433373B756E69715F69645F757365727C733A313A2232223B757365725F69647C733A353A2273616C6573223B757365726E616D657C733A353A225269616E61223B757365725F7077647C733A353A2273616C6573223B6C6576656C5F69647C733A313A2232223B6C6576656C5F6E616D657C733A353A2253616C6573223B69735F6C6F67696E7C623A313B);
INSERT INTO `ci_sessions` VALUES ('v86bhoqbo5v2tqn99eafj6fcl6ds015r', '::1', 1527044468, 0x5F5F63695F6C6173745F726567656E65726174657C693A313532373034343436383B);

-- ----------------------------
-- Table structure for dto_aktifasi
-- ----------------------------
DROP TABLE IF EXISTS `dto_aktifasi`;
CREATE TABLE `dto_aktifasi`  (
  `id_aktifasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_aktifasi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_aktifasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_aktifasi
-- ----------------------------
INSERT INTO `dto_aktifasi` VALUES (1, 'active');
INSERT INTO `dto_aktifasi` VALUES (2, 'waiting');
INSERT INTO `dto_aktifasi` VALUES (3, 'empty');
INSERT INTO `dto_aktifasi` VALUES (4, 'new data');

-- ----------------------------
-- Table structure for dto_customer_order
-- ----------------------------
DROP TABLE IF EXISTS `dto_customer_order`;
CREATE TABLE `dto_customer_order`  (
  `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NULL DEFAULT NULL,
  `no_po_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kode_produk` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_bill` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_email` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `customer_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `invoice_date` date NULL DEFAULT NULL,
  `nama_produk` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kategori_produk` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kuantitas` int(11) NULL DEFAULT NULL,
  `diskon` int(11) NULL DEFAULT NULL,
  `harga_produk` int(11) NULL DEFAULT NULL,
  `total_harga` float(11, 0) NULL DEFAULT NULL,
  `created_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_customer_order
-- ----------------------------
INSERT INTO `dto_customer_order` VALUES (1, 5, 'PO-1-20180528184802', 'CF1', 'BIL-001', 'PT. Adira', 'adira@adira.com', '13235346', 'jalan mana aja', '2018-06-02', 'Kopi Luwak Blend', 'kopi', 10, 2, 250000, 245000, '2018-06-02 14:56:43');
INSERT INTO `dto_customer_order` VALUES (2, 2, 'PO-13-2018052818475', 'CF3', 'BIL-001', 'PT. Adira', 'adira@adira.com', '13235346', 'jalan mana aja', '2018-06-02', 'Kopi Original Luwak', 'kopi', 25, 7, 225000, 209250, '2018-06-02 14:56:43');

-- ----------------------------
-- Table structure for dto_items
-- ----------------------------
DROP TABLE IF EXISTS `dto_items`;
CREATE TABLE `dto_items`  (
  `id_item` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_item` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_item` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `id_status` int(11) NULL DEFAULT NULL,
  `create_date` timestamp(0) NULL DEFAULT NULL,
  `update_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_item`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_items
-- ----------------------------
INSERT INTO `dto_items` VALUES (1, 'CF1', 'Kopi Luwak Blend', 1, 0, '2018-05-26 09:23:30', '2018-05-26 09:23:30');
INSERT INTO `dto_items` VALUES (2, 'CF2', 'Coffindo Gold', 1, 0, '2018-05-26 09:23:43', '2018-05-26 09:23:43');
INSERT INTO `dto_items` VALUES (3, 'CF3', 'Kopi Original Luwak', 1, 0, '2018-05-26 09:23:54', '2018-05-26 09:23:54');
INSERT INTO `dto_items` VALUES (4, 'CF4', 'Kopi Merah Putih', 1, 0, '2018-05-26 09:24:08', '2018-05-26 09:24:08');
INSERT INTO `dto_items` VALUES (5, 'CF5', 'Coffindo Classic', 1, 0, '2018-05-26 09:24:26', '2018-05-26 09:24:26');
INSERT INTO `dto_items` VALUES (6, 'CF6', 'Kopi Single Origin', 1, 0, '2018-05-26 09:24:40', '2018-05-26 09:24:40');
INSERT INTO `dto_items` VALUES (7, 'CF7', 'Green Been', 1, 0, '2018-05-26 09:24:55', '2018-05-26 09:24:55');
INSERT INTO `dto_items` VALUES (8, 'CF8', 'Coffindo Blue', 1, 0, '2018-05-26 09:25:09', '2018-05-26 09:25:09');
INSERT INTO `dto_items` VALUES (9, 'CF9', 'Kopi Authentic', 1, 0, '2018-05-26 09:25:28', '2018-05-26 09:25:28');
INSERT INTO `dto_items` VALUES (10, 'CF10', 'Kopi Capsules', 1, 0, '2018-05-26 09:25:43', '2018-05-26 09:25:43');
INSERT INTO `dto_items` VALUES (11, 'CF11', 'Kopi Nusantara', 1, 0, '2018-05-26 09:25:54', '2018-05-26 09:25:54');
INSERT INTO `dto_items` VALUES (12, 'CF12', 'Kopi Single Origin 1 Kg', 1, 0, '2018-05-26 09:26:12', '2018-05-26 09:26:46');
INSERT INTO `dto_items` VALUES (13, 'CM1', 'Grinder', 2, 0, '2018-05-26 09:27:53', '2018-05-26 09:27:53');
INSERT INTO `dto_items` VALUES (14, 'CM2', 'Professional Machine', 2, 0, '2018-05-26 09:28:11', '2018-05-26 09:28:11');
INSERT INTO `dto_items` VALUES (15, 'CM3', 'Coffee Bolier', 2, 0, '2018-05-26 09:28:24', '2018-05-26 09:28:24');
INSERT INTO `dto_items` VALUES (16, 'CM4', 'Soft Ice Cream Machine', 2, 0, '2018-05-26 09:28:38', '2018-05-26 09:28:38');
INSERT INTO `dto_items` VALUES (17, 'CM5', 'Fully Automatic', 2, 0, '2018-05-26 09:28:55', '2018-05-26 09:28:55');
INSERT INTO `dto_items` VALUES (18, 'CM6', 'Roaster Machine', 2, 0, '2018-05-26 09:29:14', '2018-05-26 09:29:14');
INSERT INTO `dto_items` VALUES (19, 'CM7', 'Vending Machine', 2, 0, '2018-05-26 09:29:26', '2018-05-26 09:29:26');
INSERT INTO `dto_items` VALUES (20, 'CM8', 'Juicer', 2, 0, '2018-05-26 09:29:34', '2018-05-26 09:29:34');
INSERT INTO `dto_items` VALUES (21, 'CM9', 'Pum Espresso', 2, 0, '2018-05-26 09:29:58', '2018-05-26 09:29:58');
INSERT INTO `dto_items` VALUES (22, 'CM10', 'Mesin Kopi Capsule', 2, 0, '2018-05-26 09:30:18', '2018-05-26 09:30:18');
INSERT INTO `dto_items` VALUES (23, 'CM11', 'Slush Machine', 2, 0, '2018-05-26 09:30:33', '2018-05-26 09:30:33');
INSERT INTO `dto_items` VALUES (24, 'CM12', 'Coffee Maker', 2, 0, '2018-05-26 09:30:45', '2018-05-26 09:30:45');
INSERT INTO `dto_items` VALUES (25, 'CM13', 'Mesin Sortir Kopi', 2, 0, '2018-05-26 09:31:01', '2018-05-26 09:31:01');
INSERT INTO `dto_items` VALUES (26, 'CM14', 'Juice Dispenser', 2, 0, '2018-05-26 09:31:15', '2018-05-26 09:31:15');
INSERT INTO `dto_items` VALUES (27, 'CS1', 'Kettle', 3, 0, '2018-05-26 09:34:09', '2018-05-26 09:34:09');
INSERT INTO `dto_items` VALUES (28, 'CS2', 'Tea Pot', 3, 0, '2018-05-26 09:34:19', '2018-05-26 09:34:19');
INSERT INTO `dto_items` VALUES (29, 'CS3', 'Thermometer', 3, 0, '2018-05-26 09:34:29', '2018-05-26 09:34:29');
INSERT INTO `dto_items` VALUES (30, 'CS4', 'Whipper', 3, 0, '2018-05-26 09:34:43', '2018-05-26 09:34:43');
INSERT INTO `dto_items` VALUES (31, 'CS5', 'Whipper', 3, 0, '2018-05-26 09:35:02', '2018-05-26 09:35:02');
INSERT INTO `dto_items` VALUES (32, 'CS6', 'Tumblers', 3, 0, '2018-05-26 09:35:12', '2018-05-26 09:35:12');
INSERT INTO `dto_items` VALUES (33, 'CS7', 'Smoothers', 3, 0, '2018-05-26 09:35:27', '2018-05-26 09:35:27');
INSERT INTO `dto_items` VALUES (34, 'CS8', 'Head Brush', 3, 0, '2018-05-26 09:35:38', '2018-05-26 09:35:38');
INSERT INTO `dto_items` VALUES (35, 'CS9', 'Servers', 3, 0, '2018-05-26 09:42:45', '2018-05-26 09:42:45');
INSERT INTO `dto_items` VALUES (36, 'CS10', 'Canister', 3, 0, '2018-05-26 09:42:55', '2018-05-26 09:42:55');
INSERT INTO `dto_items` VALUES (37, 'CS11', 'Jigger', 3, 0, '2018-05-26 09:43:06', '2018-05-26 09:43:06');
INSERT INTO `dto_items` VALUES (38, 'CS12', 'Filter', 3, 0, '2018-05-26 09:43:14', '2018-05-26 09:43:14');
INSERT INTO `dto_items` VALUES (39, 'CS13', 'Milk Frother', 3, 0, '2018-05-26 09:43:25', '2018-05-26 09:43:25');
INSERT INTO `dto_items` VALUES (40, 'CS14', 'Decanter', 3, 0, '2018-05-26 09:43:36', '2018-05-26 09:43:36');
INSERT INTO `dto_items` VALUES (41, 'CS16', 'Thermos', 3, 0, '2018-05-26 09:43:46', '2018-05-26 09:43:46');
INSERT INTO `dto_items` VALUES (42, 'CS17', 'Hand Grinder', 3, 0, '2018-05-26 09:44:11', '2018-05-26 09:44:11');
INSERT INTO `dto_items` VALUES (43, 'CS18', 'Temper', 3, 0, '2018-05-26 09:44:32', '2018-05-26 09:44:32');
INSERT INTO `dto_items` VALUES (44, 'CS19', 'Knock Box', 3, 0, '2018-05-26 09:44:42', '2018-05-26 09:44:42');
INSERT INTO `dto_items` VALUES (45, 'CS20', 'Measuring Jugs', 3, 0, '2018-05-26 09:45:06', '2018-05-26 09:45:06');
INSERT INTO `dto_items` VALUES (46, 'CS21', 'Drip Stand', 3, 0, '2018-05-26 09:45:51', '2018-05-26 09:45:51');
INSERT INTO `dto_items` VALUES (47, 'CS22', 'Seasoning Bottle', 3, 0, '2018-05-26 09:46:05', '2018-05-26 09:46:05');
INSERT INTO `dto_items` VALUES (48, 'CS23', 'Cleaning Tool', 3, 0, '2018-05-26 09:46:17', '2018-05-26 09:46:17');
INSERT INTO `dto_items` VALUES (49, 'CS24', 'Spoon', 3, 0, '2018-05-26 09:46:43', '2018-05-26 09:46:43');
INSERT INTO `dto_items` VALUES (50, 'CS25', 'Pitcher', 3, 0, '2018-05-26 09:46:50', '2018-05-26 09:46:50');
INSERT INTO `dto_items` VALUES (51, 'CS26', 'Shaker', 3, 0, '2018-05-26 09:47:14', '2018-05-26 09:47:14');
INSERT INTO `dto_items` VALUES (52, 'CS28', 'Coffee Glass', 3, 0, '2018-05-26 09:47:27', '2018-05-26 09:47:27');
INSERT INTO `dto_items` VALUES (53, 'CS29', 'Dripper Pot', 3, 0, '2018-05-26 09:47:49', '2018-05-26 09:47:49');
INSERT INTO `dto_items` VALUES (54, 'CS30', 'Scale', 3, 0, '2018-05-26 09:47:56', '2018-05-26 09:47:56');
INSERT INTO `dto_items` VALUES (55, 'CS 31', 'Stove', 3, 0, '2018-05-26 09:48:04', '2018-05-26 09:48:04');

-- ----------------------------
-- Table structure for dto_kategori
-- ----------------------------
DROP TABLE IF EXISTS `dto_kategori`;
CREATE TABLE `dto_kategori`  (
  `id_kategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_kategori
-- ----------------------------
INSERT INTO `dto_kategori` VALUES (1, 'kopi');
INSERT INTO `dto_kategori` VALUES (2, 'mesin');
INSERT INTO `dto_kategori` VALUES (3, 'sparepart');

-- ----------------------------
-- Table structure for dto_level
-- ----------------------------
DROP TABLE IF EXISTS `dto_level`;
CREATE TABLE `dto_level`  (
  `level_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `level_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`level_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_level
-- ----------------------------
INSERT INTO `dto_level` VALUES (1, 'Admin');
INSERT INTO `dto_level` VALUES (2, 'Sales');
INSERT INTO `dto_level` VALUES (3, 'Technical');
INSERT INTO `dto_level` VALUES (4, 'Manager');
INSERT INTO `dto_level` VALUES (5, 'Customer');

-- ----------------------------
-- Table structure for dto_penawaran
-- ----------------------------
DROP TABLE IF EXISTS `dto_penawaran`;
CREATE TABLE `dto_penawaran`  (
  `id_penawaran` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `id_item` int(20) NULL DEFAULT NULL,
  `kuantitas` int(11) NULL DEFAULT NULL,
  `harga_item` float(11, 0) NULL DEFAULT NULL,
  `diskon` float(11, 0) NULL DEFAULT NULL,
  `id_stok` int(11) NULL DEFAULT NULL,
  `id_aktifasi` int(11) NULL DEFAULT NULL,
  `id_status` int(11) NULL DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_date` timestamp(0) NULL DEFAULT NULL,
  `update_date` timestamp(0) NULL DEFAULT NULL,
  `active_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_penawaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_penawaran
-- ----------------------------
INSERT INTO `dto_penawaran` VALUES (1, 1, 1, 10, 250000, 2, 1, 1, 0, 'sales', '2018-05-26 09:49:08', '2018-05-26 09:49:08', '2018-05-27 10:00:36');
INSERT INTO `dto_penawaran` VALUES (2, 2, 14, 20, 150000, 10, 1, 1, 0, 'sales', '2018-05-27 09:59:59', '2018-05-27 09:59:59', '2018-05-27 10:00:27');
INSERT INTO `dto_penawaran` VALUES (3, 2, 15, 10, 350000, 5, 1, 1, 0, 'sales', '2018-05-27 10:00:15', '2018-05-27 10:00:15', '2018-05-27 10:00:24');
INSERT INTO `dto_penawaran` VALUES (4, 1, 6, 11, 180000, 5, 1, 4, 0, 'sales', '2018-05-27 10:05:09', '2018-05-27 10:05:09', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (5, 1, 9, 15, 185000, 5, 1, 4, 0, 'sales', '2018-05-27 10:05:21', '2018-05-27 10:05:21', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (6, 2, 23, 21, 320000, 7, 1, 4, 0, 'sales', '2018-05-27 10:07:40', '2018-05-27 10:07:40', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (7, 2, 25, 16, 215000, 6, 1, 4, 0, 'sales', '2018-05-27 10:08:00', '2018-05-27 10:08:00', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (8, 3, 28, 25, 199000, 5, 1, 4, 0, 'sales', '2018-05-27 10:08:29', '2018-05-27 10:08:29', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (9, 3, 44, 24, 195200, 7, 1, 4, 0, 'sales', '2018-05-27 10:08:55', '2018-05-27 10:08:55', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (10, 1, 11, 15, 420000, 15, 1, 1, 0, 'mysales', '2018-05-28 15:47:32', '2018-05-28 15:47:32', '2018-05-28 16:22:23');
INSERT INTO `dto_penawaran` VALUES (11, 1, 4, 10, 250000, 5, 1, 4, 0, 'mysales', '2018-05-28 16:17:13', '2018-05-28 16:17:13', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (12, 1, 5, 10, 150000, 5, 1, 4, 0, 'mysales', '2018-05-28 16:17:24', '2018-05-28 16:17:24', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (13, 1, 3, 25, 225000, 7, 1, 1, 0, 'mysales', '2018-05-28 16:18:47', '2018-05-28 16:18:47', '2018-05-28 16:22:27');
INSERT INTO `dto_penawaran` VALUES (14, 2, 14, 16, 450000, 15, 1, 1, 0, 'mysales', '2018-05-28 16:20:11', '2018-05-28 16:20:11', '2018-05-28 16:22:15');
INSERT INTO `dto_penawaran` VALUES (15, 2, 20, 13, 125000, 2, 1, 4, 0, 'mysales', '2018-05-28 16:20:26', '2018-05-28 16:20:26', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (16, 3, 31, 125, 475000, 5, 1, 4, 0, 'mysales', '2018-05-28 16:21:11', '2018-05-28 16:21:11', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (17, 3, 39, 175, 656750, 5, 1, 1, 0, 'mysales', '2018-05-28 16:21:34', '2018-05-28 16:21:34', '2018-05-28 16:22:06');
INSERT INTO `dto_penawaran` VALUES (18, 3, 37, 160, 452250, 5, 1, 2, 0, 'mysales', '2018-05-28 16:22:01', '2018-05-28 16:22:01', '0000-00-00 00:00:00');
INSERT INTO `dto_penawaran` VALUES (19, 1, 12, 15, 185000, 5, 1, 2, 0, 'sales', '2018-05-30 17:24:09', '2018-05-30 17:24:09', '2018-05-30 17:24:18');

-- ----------------------------
-- Table structure for dto_purchase_order
-- ----------------------------
DROP TABLE IF EXISTS `dto_purchase_order`;
CREATE TABLE `dto_purchase_order`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `po_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_penawaran` int(11) NULL DEFAULT NULL,
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_aktifasi` int(11) NULL DEFAULT NULL,
  `activation_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_purchase_order
-- ----------------------------
INSERT INTO `dto_purchase_order` VALUES (1, 'PO-3-20180528174117', 3, 'sales', 1, '2018-05-28 17:41:17');
INSERT INTO `dto_purchase_order` VALUES (2, 'PO-13-2018052818475', 13, 'mysales', 1, '2018-05-28 18:47:54');
INSERT INTO `dto_purchase_order` VALUES (3, 'PO-10-2018052818475', 10, 'mysales', 1, '2018-05-28 18:47:57');
INSERT INTO `dto_purchase_order` VALUES (4, 'PO-14-2018052818475', 14, 'mysales', 1, '2018-05-28 18:47:59');
INSERT INTO `dto_purchase_order` VALUES (5, 'PO-1-20180528184802', 1, 'sales', 1, '2018-05-28 18:48:02');
INSERT INTO `dto_purchase_order` VALUES (6, 'PO-2-20180528184805', 2, 'sales', 1, '2018-05-28 18:48:05');
INSERT INTO `dto_purchase_order` VALUES (7, 'PO-17-2018052818480', 17, 'mysales', 1, '2018-05-28 18:48:07');

-- ----------------------------
-- Table structure for dto_status
-- ----------------------------
DROP TABLE IF EXISTS `dto_status`;
CREATE TABLE `dto_status`  (
  `id_status` int(2) NOT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_status
-- ----------------------------
INSERT INTO `dto_status` VALUES (0, 'enabled');
INSERT INTO `dto_status` VALUES (1, 'disabled');

-- ----------------------------
-- Table structure for dto_stok
-- ----------------------------
DROP TABLE IF EXISTS `dto_stok`;
CREATE TABLE `dto_stok`  (
  `id_stok` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_stok` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_stok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_stok
-- ----------------------------
INSERT INTO `dto_stok` VALUES (1, 'Ada');
INSERT INTO `dto_stok` VALUES (2, 'Kosong');

-- ----------------------------
-- Table structure for dto_user
-- ----------------------------
DROP TABLE IF EXISTS `dto_user`;
CREATE TABLE `dto_user`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dto_user
-- ----------------------------
INSERT INTO `dto_user` VALUES (1, 'admin', 'John', 'admin', 1);
INSERT INTO `dto_user` VALUES (2, 'sales', 'Riana', 'sales', 2);
INSERT INTO `dto_user` VALUES (3, 'mysales', 'Astuti', '12345', 2);
INSERT INTO `dto_user` VALUES (4, 'sales_mdn', 'Susi', '12345', 2);
INSERT INTO `dto_user` VALUES (5, 'sample', 'Sample Customer', '12345', 5);

-- ----------------------------
-- Procedure structure for getProductItemBy
-- ----------------------------
DROP PROCEDURE IF EXISTS `getProductItemBy`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductItemBy`(
	IN _kode VARCHAR(20)
)
BEGIN
	SELECT po.id, po.po_code, it.kode_item, it.nama_item, kt.nama_kategori, 
	pn.kuantitas, pn.diskon, pn.harga_item, 
	(((100-pn.diskon) * pn.harga_item)/100) * pn.kuantitas as total_harga
	FROM dto_penawaran pn
	INNER JOIN dto_purchase_order po ON po.id_penawaran = pn.id_penawaran
	INNER JOIN dto_items it ON it.id_item = pn.id_item
	INNER JOIN dto_kategori kt ON kt.id_kategori = pn.id_kategori
	WHERE it.kode_item = _kode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getRecordItems
-- ----------------------------
DROP PROCEDURE IF EXISTS `getRecordItems`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getRecordItems`()
BEGIN
	SELECT * FROM dto_items its;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
