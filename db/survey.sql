-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 08:40 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdds`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `emp_id` int(11) NOT NULL,
  `survey_date` date DEFAULT NULL,
  `engagement_score` int(16) DEFAULT NULL,
  `satisfaction_score` int(18) DEFAULT NULL,
  `worklifebalance_score` int(23) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`emp_id`, `survey_date`, `engagement_score`, `satisfaction_score`, `worklifebalance_score`) VALUES
(1001, '2022-10-10', 2, 5, 5),
(1002, '2023-08-03', 4, 5, 3),
(1003, '2023-01-03', 2, 5, 2),
(1004, '2023-07-30', 3, 5, 3),
(1005, '2023-06-19', 2, 4, 5),
(1006, '2023-05-03', 5, 2, 1),
(1007, '2023-07-18', 2, 1, 5),
(1008, '2023-06-21', 5, 2, 2),
(1009, '2023-06-06', 2, 5, 1),
(1010, '2022-09-15', 2, 4, 2),
(1011, '2022-12-08', 1, 2, 3),
(1012, '2023-01-13', 3, 5, 4),
(1013, '2022-12-13', 5, 4, 3),
(1014, '2023-06-28', 4, 4, 1),
(1015, '2023-07-11', 1, 1, 3),
(1016, '2022-12-09', 2, 3, 2),
(1017, '2023-07-16', 4, 1, 3),
(1018, '2023-06-21', 4, 1, 4),
(1019, '2023-06-21', 1, 3, 5),
(1020, '2023-08-01', 2, 1, 2),
(1021, '2023-03-09', 5, 1, 4),
(1022, '2023-02-12', 1, 4, 4),
(1023, '2023-01-17', 4, 4, 3),
(1024, '2022-10-12', 5, 3, 1),
(1025, '2023-01-24', 4, 1, 4),
(1026, '2022-10-09', 5, 2, 5),
(1027, '2023-04-05', 2, 3, 5),
(1028, '2023-03-26', 5, 5, 4),
(1029, '2022-11-07', 3, 5, 4),
(1030, '2023-01-03', 4, 4, 1),
(1031, '2023-02-27', 5, 3, 2),
(1032, '2023-05-22', 5, 4, 4),
(1033, '2023-07-02', 3, 1, 3),
(1034, '2023-07-09', 2, 5, 1),
(1035, '2023-07-19', 1, 5, 5),
(1036, '2022-08-09', 5, 2, 1),
(1037, '2022-11-25', 5, 1, 4),
(1038, '2023-03-10', 5, 1, 2),
(1039, '2022-12-03', 2, 4, 5),
(1040, '2022-09-27', 5, 3, 1),
(1041, '2023-01-19', 3, 1, 4),
(1042, '2023-02-17', 1, 3, 4),
(1043, '2023-02-25', 1, 1, 3),
(1044, '2022-11-26', 2, 4, 5),
(1045, '2022-08-08', 1, 4, 1),
(1046, '2023-02-18', 3, 5, 4),
(1047, '2023-05-12', 4, 2, 3),
(1048, '2022-10-19', 3, 1, 4),
(1049, '2023-07-27', 3, 5, 2),
(1050, '2023-07-03', 4, 5, 1),
(1051, '2023-01-01', 2, 4, 5),
(1052, '2022-11-19', 1, 4, 4),
(1053, '2022-10-12', 2, 1, 4),
(1054, '2023-07-05', 1, 5, 2),
(1055, '2022-09-23', 3, 4, 1),
(1056, '2023-01-17', 4, 2, 2),
(1057, '2023-03-12', 3, 2, 5),
(1058, '2023-03-06', 4, 2, 1),
(1059, '2023-03-29', 4, 3, 3),
(1060, '2023-07-01', 5, 5, 4),
(1061, '2023-02-05', 3, 3, 1),
(1062, '2023-01-03', 3, 2, 1),
(1063, '2023-07-25', 5, 2, 4),
(1064, '2022-12-14', 5, 4, 4),
(1065, '2023-01-20', 5, 3, 4),
(1066, '2023-07-15', 4, 3, 5),
(1067, '2023-06-10', 3, 2, 5),
(1068, '2022-10-09', 3, 2, 2),
(1069, '2023-02-04', 3, 1, 2),
(1070, '2023-03-05', 3, 1, 2),
(1071, '2023-05-15', 1, 2, 2),
(1072, '2023-02-18', 2, 2, 3),
(1073, '2023-02-16', 4, 4, 2),
(1074, '2023-02-10', 3, 4, 1),
(1075, '2023-04-10', 1, 2, 3),
(1076, '2023-04-11', 1, 3, 1),
(1077, '2022-10-12', 5, 2, 4),
(1078, '2023-07-28', 3, 3, 4),
(1079, '2022-10-08', 2, 2, 1),
(1080, '2023-03-04', 3, 1, 3),
(1081, '2023-03-03', 1, 3, 3),
(1082, '2023-02-27', 1, 4, 1),
(1083, '2023-01-09', 5, 5, 3),
(1084, '2023-02-19', 1, 2, 4),
(1085, '2023-01-09', 5, 5, 3),
(1086, '2023-03-14', 1, 1, 5),
(1087, '2023-05-03', 1, 5, 2),
(1088, '2023-04-20', 4, 3, 1),
(1089, '2023-04-19', 3, 1, 5),
(1090, '2023-05-16', 4, 3, 4),
(1091, '2023-04-22', 2, 4, 3),
(1092, '2023-03-08', 1, 4, 1),
(1093, '2023-03-05', 3, 1, 4),
(1094, '2023-01-22', 5, 4, 5),
(1095, '2023-03-17', 1, 2, 1),
(1096, '2022-12-17', 1, 3, 2),
(1097, '2022-10-31', 1, 2, 5),
(1098, '2022-12-28', 2, 2, 2),
(1099, '2023-08-04', 1, 5, 5),
(1100, '2022-09-10', 1, 4, 5),
(1101, '2023-03-21', 1, 1, 3),
(1102, '2023-03-02', 5, 1, 4),
(1103, '2022-11-06', 5, 3, 1),
(1104, '2022-12-21', 1, 4, 2),
(1105, '2023-02-15', 1, 4, 1),
(1106, '2023-01-31', 2, 3, 3),
(1107, '2022-10-18', 4, 5, 1),
(1108, '2023-07-24', 4, 5, 3),
(1109, '2022-10-16', 4, 5, 4),
(1110, '2023-02-23', 1, 1, 4),
(1111, '2023-05-11', 4, 1, 1),
(1112, '2023-07-06', 4, 1, 1),
(1113, '2023-04-09', 3, 3, 5),
(1114, '2023-03-03', 1, 3, 3),
(1115, '2023-03-11', 4, 1, 3),
(1116, '2022-12-16', 3, 4, 4),
(1117, '2023-07-29', 4, 5, 1),
(1118, '2023-02-22', 1, 5, 3),
(1119, '2023-04-16', 4, 4, 5),
(1120, '2023-06-05', 3, 3, 4),
(1121, '2023-01-21', 1, 1, 4),
(1122, '2022-12-04', 2, 1, 2),
(1123, '2023-06-10', 2, 3, 1),
(1124, '2023-02-27', 3, 2, 3),
(1125, '2023-03-17', 4, 3, 4),
(1126, '2023-04-23', 3, 3, 2),
(1127, '2023-01-27', 5, 1, 3),
(1128, '2023-02-18', 4, 2, 4),
(1129, '2022-10-31', 1, 1, 1),
(1130, '2023-05-07', 1, 5, 4),
(1131, '2023-05-11', 4, 4, 4),
(1132, '2023-07-15', 1, 5, 5),
(1133, '2023-06-15', 1, 2, 4),
(1134, '2022-12-29', 4, 1, 2),
(1135, '2023-02-23', 5, 4, 4),
(1136, '2023-04-09', 2, 5, 2),
(1137, '2022-11-12', 3, 3, 5),
(1138, '2022-10-19', 4, 5, 1),
(1139, '2022-08-27', 2, 4, 2),
(1140, '2023-05-04', 5, 3, 2),
(1141, '2022-12-26', 5, 5, 2),
(1142, '2023-06-21', 4, 4, 4),
(1143, '2022-12-13', 2, 4, 2),
(1144, '2022-11-03', 5, 3, 2),
(1145, '2022-10-24', 3, 3, 4),
(1146, '2022-09-21', 3, 2, 2),
(1147, '2023-03-19', 1, 3, 5),
(1148, '2023-04-02', 4, 1, 3),
(1149, '2022-11-03', 3, 2, 5),
(1150, '2022-12-28', 3, 4, 4),
(1151, '2022-12-12', 5, 3, 1),
(1152, '2022-12-14', 1, 1, 5),
(1153, '2023-02-28', 3, 4, 2),
(1154, '2023-06-09', 1, 3, 2),
(1155, '2022-08-25', 2, 3, 1),
(1156, '2023-05-12', 1, 5, 2),
(1157, '2023-06-06', 1, 4, 2),
(1158, '2023-03-17', 2, 4, 4),
(1159, '2023-02-18', 1, 2, 4),
(1160, '2022-08-20', 4, 2, 3),
(1161, '2023-04-09', 3, 4, 4),
(1162, '2022-10-05', 3, 3, 2),
(1163, '2022-12-14', 1, 2, 3),
(1164, '2022-10-23', 5, 5, 5),
(1165, '2023-01-09', 3, 3, 1),
(1166, '2023-02-27', 2, 1, 4),
(1167, '2023-05-22', 2, 3, 4),
(1168, '2022-08-28', 2, 2, 2),
(1169, '2023-08-03', 1, 3, 2),
(1170, '2023-02-05', 1, 5, 4),
(1171, '2023-06-24', 4, 1, 4),
(1172, '2023-06-19', 1, 3, 2),
(1173, '2023-06-16', 5, 5, 2),
(1174, '2023-03-06', 2, 1, 5),
(1175, '2023-04-22', 2, 1, 2),
(1176, '2022-10-17', 2, 2, 5),
(1177, '2022-08-12', 2, 2, 5),
(1178, '2023-05-03', 2, 1, 2),
(1179, '2023-07-10', 3, 5, 1),
(1180, '2023-05-15', 4, 3, 1),
(1181, '2023-07-05', 5, 5, 4),
(1182, '2022-08-25', 2, 4, 5),
(1183, '2023-03-07', 4, 5, 5),
(1184, '2022-10-03', 1, 3, 1),
(1185, '2022-08-13', 1, 2, 4),
(1186, '2023-05-12', 3, 3, 5),
(1187, '2022-11-19', 4, 1, 1),
(1188, '2023-07-16', 4, 1, 1),
(1189, '2023-07-19', 5, 5, 3),
(1190, '2023-04-07', 2, 5, 3),
(1191, '2023-07-13', 4, 4, 4),
(1192, '2022-12-24', 3, 1, 1),
(1193, '2022-08-15', 5, 2, 3),
(1194, '2022-12-04', 5, 4, 2),
(1195, '2023-01-30', 5, 3, 2),
(1196, '2023-06-02', 4, 5, 4),
(1197, '2022-11-09', 3, 5, 4),
(1198, '2022-12-12', 3, 2, 2),
(1199, '2023-06-27', 3, 3, 3),
(1200, '2023-04-19', 4, 5, 1),
(1201, '2023-02-23', 2, 4, 4),
(1202, '2022-08-14', 1, 3, 2),
(1203, '2022-10-03', 3, 5, 3),
(1204, '2023-06-22', 1, 4, 3),
(1205, '2023-04-07', 2, 1, 2),
(1206, '2022-10-17', 3, 4, 2),
(1207, '2022-08-06', 2, 1, 2),
(1208, '2022-08-18', 5, 1, 5),
(1209, '2023-05-28', 1, 3, 1),
(1210, '2022-10-24', 4, 5, 1),
(1211, '2023-03-16', 3, 3, 1),
(1212, '2023-01-31', 4, 5, 4),
(1213, '2022-09-28', 1, 2, 4),
(1214, '2023-06-02', 1, 5, 3),
(1215, '2022-10-25', 2, 1, 5),
(1216, '2022-09-09', 4, 1, 1),
(1217, '2022-08-23', 5, 5, 1),
(1218, '2023-02-27', 2, 3, 1),
(1219, '2023-07-17', 2, 2, 2),
(1220, '2023-05-08', 5, 2, 4),
(1221, '2022-08-17', 5, 5, 3),
(1222, '2023-03-31', 5, 2, 1),
(1223, '2023-05-07', 4, 1, 4),
(1224, '2023-05-20', 4, 2, 3),
(1225, '2022-11-05', 1, 2, 4),
(1226, '2023-04-04', 4, 5, 4),
(1227, '2022-12-12', 1, 2, 2),
(1228, '2023-01-21', 2, 5, 3),
(1229, '2023-05-20', 4, 2, 5),
(1230, '2022-11-30', 5, 4, 4),
(1231, '2023-03-13', 2, 2, 1),
(1232, '2022-08-22', 2, 1, 5),
(1233, '2023-05-01', 5, 5, 3),
(1234, '2022-12-11', 4, 1, 5),
(1235, '2023-03-23', 5, 5, 3),
(1236, '2023-07-25', 1, 4, 1),
(1237, '2023-07-11', 4, 3, 1),
(1238, '2022-12-29', 1, 3, 3),
(1239, '2022-10-07', 4, 5, 5),
(1240, '2023-08-02', 1, 4, 3),
(1241, '2023-01-16', 4, 4, 3),
(1242, '2023-07-28', 4, 4, 1),
(1243, '2023-05-04', 5, 2, 3),
(1244, '2022-08-17', 2, 3, 5),
(1245, '2022-09-23', 3, 5, 5),
(1246, '2023-01-12', 4, 3, 2),
(1247, '2022-11-13', 2, 4, 5),
(1248, '2022-12-05', 5, 3, 2),
(1249, '2022-12-22', 2, 4, 2),
(1250, '2023-04-26', 4, 5, 1),
(1251, '2022-12-03', 5, 5, 3),
(1252, '2023-06-10', 2, 3, 2),
(1253, '2023-01-10', 2, 4, 2),
(1254, '2023-06-18', 3, 1, 5),
(1255, '2022-11-03', 3, 1, 1),
(1256, '2022-10-24', 4, 4, 2),
(1257, '2023-07-19', 2, 1, 1),
(1258, '2023-04-16', 3, 5, 4),
(1259, '2022-10-17', 1, 3, 4),
(1260, '2023-02-21', 5, 2, 5),
(1261, '2023-07-13', 2, 5, 4),
(1262, '2022-12-16', 3, 4, 1),
(1263, '2023-01-24', 4, 5, 3),
(1264, '2023-04-21', 3, 5, 4),
(1265, '2023-06-28', 4, 2, 5),
(1266, '2023-03-29', 1, 3, 1),
(1267, '2023-04-25', 4, 1, 5),
(1268, '2023-04-18', 2, 1, 2),
(1269, '2022-09-19', 1, 2, 4),
(1270, '2023-03-16', 5, 5, 1),
(1271, '2023-01-13', 3, 1, 5),
(1272, '2022-10-31', 4, 2, 3),
(1273, '2023-02-26', 1, 4, 2),
(1274, '2023-03-19', 2, 1, 5),
(1275, '2022-08-19', 2, 5, 3),
(1276, '2023-06-01', 1, 4, 5),
(1277, '2023-08-01', 4, 3, 3),
(1278, '2023-05-28', 2, 4, 5),
(1279, '2022-10-11', 3, 3, 5),
(1280, '2022-11-12', 3, 2, 2),
(1281, '2023-05-31', 4, 2, 1),
(1282, '2022-10-04', 3, 3, 1),
(1283, '2022-11-19', 2, 1, 2),
(1284, '2022-11-24', 5, 1, 5),
(1285, '2023-07-05', 3, 2, 2),
(1286, '2023-04-13', 1, 5, 1),
(1287, '2023-07-30', 3, 5, 2),
(1288, '2023-07-15', 2, 4, 5),
(1289, '2023-05-09', 5, 3, 1),
(1290, '2023-04-12', 5, 4, 2),
(1291, '2023-05-24', 5, 4, 5),
(1292, '2023-03-21', 1, 4, 3),
(1293, '2023-03-15', 2, 3, 2),
(1294, '2023-08-03', 5, 4, 2),
(1295, '2023-02-18', 3, 3, 3),
(1296, '2023-02-07', 1, 1, 5),
(1297, '2022-08-10', 2, 4, 4),
(1298, '2022-12-06', 1, 2, 1),
(1299, '2023-07-02', 1, 2, 2),
(1300, '2022-10-07', 1, 3, 1),
(1301, '2023-01-21', 1, 4, 2),
(1302, '2023-06-04', 1, 2, 4),
(1303, '2023-01-01', 5, 3, 5),
(1304, '2023-04-11', 3, 5, 1),
(1305, '2023-02-22', 2, 5, 2),
(1306, '2022-11-12', 1, 3, 5),
(1307, '2022-11-18', 1, 5, 1),
(1308, '2022-08-28', 4, 5, 2),
(1309, '2022-09-07', 1, 1, 3),
(1310, '2023-04-24', 3, 4, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1311;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;