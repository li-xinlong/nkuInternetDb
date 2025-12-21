-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: Webbase
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `battle`
--

DROP TABLE IF EXISTS `battle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `battle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '战役名称',
  `english_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '英文名称',
  `location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '战役地点',
  `latitude` decimal(10,7) DEFAULT NULL COMMENT '纬度',
  `longitude` decimal(10,7) DEFAULT NULL COMMENT '经度',
  `start_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `duration_days` int DEFAULT NULL COMMENT '持续天数',
  `commander_cn` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中方指挥官',
  `commander_jp` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '日方指挥官',
  `troops_cn` int DEFAULT NULL COMMENT '中方兵力',
  `troops_jp` int DEFAULT NULL COMMENT '日方兵力',
  `casualties_cn` int DEFAULT NULL COMMENT '中方伤亡',
  `casualties_jp` int DEFAULT NULL COMMENT '日方伤亡',
  `result` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '战役结果:victory胜利/defeat失败/stalemate僵持',
  `significance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '历史意义',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '战役描述',
  `importance_level` tinyint DEFAULT '3' COMMENT '重要程度:1-5',
  `views` int DEFAULT '0' COMMENT '浏览量',
  `status` tinyint DEFAULT '1' COMMENT '状态',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-battle-start_date` (`start_date`),
  KEY `idx-battle-result` (`result`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `battle`
--

LOCK TABLES `battle` WRITE;
/*!40000 ALTER TABLE `battle` DISABLE KEYS */;
INSERT INTO `battle` VALUES (13,'淞沪会战','Battle of Shanghai','上海',31.2304160,121.4737010,'1937-08-13','1937-11-26',106,'张治中、冯玉祥','松井石根',700000,300000,300000,40000,'defeat','淞沪会战是中国抗日战争中第一场大型会战，也是整个中日战争中进行的规模最大、战斗最惨烈的一场战役。此战粉碎了日本\"三个月灭亡中国\"的计划，为中国争取了宝贵的战略准备时间。','淞沪会战是抗日战争全面爆发后的第一场大型会战。1937年8月13日，日军进攻上海，中国军队奋起抵抗。战役历时三个月，中国军队浴血奋战，给日军以沉重打击。虽然最终上海失守，但这场战役打破了日本\"三个月灭亡中国\"的狂妄计划，极大地鼓舞了全国人民的抗战信心。',5,1580,1,1766237149,1766237149),(14,'平型关大捷','Battle of Pingxingguan','山西灵丘县',39.4422000,114.2340000,'1937-09-25','1937-09-25',1,'林彪、聂荣臻','板垣征四郎',15000,4000,600,1000,'victory','平型关大捷是全面抗战爆发后中国军队主动寻歼敌人的第一个大胜仗，打破了\"日军不可战胜\"的神话，极大地振奋了全国军民的抗战信心。','1937年9月25日，八路军第115师在平型关伏击日军第5师团第21旅团，歼敌1000余人，击毁汽车100余辆，缴获大量军用物资。这是全面抗战以来中国军队取得的第一个大胜利，打破了日军不可战胜的神话。',5,2340,1,1766237149,1766237149),(15,'台儿庄战役','Battle of Taierzhuang','山东枣庄台儿庄',34.5628000,117.7342000,'1938-03-16','1938-04-07',23,'李宗仁、孙连仲','矶谷廉介',400000,60000,30000,20000,'victory','台儿庄大捷是抗战以来正面战场取得的最大胜利，极大地鼓舞了全国军民的抗战士气，坚定了抗战必胜的信念。','台儿庄战役是抗日战争初期中国军队在徐州会战中取得的一次重大胜利。1938年3月，日军矶谷师团进攻台儿庄，中国军队在李宗仁指挥下顽强抵抗，最终歼敌1万余人。这次胜利极大地鼓舞了全国人民的抗战信心。',5,1890,1,1766237149,1766237149),(16,'武汉会战','Battle of Wuhan','湖北武汉',30.5930990,114.3053930,'1938-06-11','1938-10-27',139,'陈诚、薛岳','畑俊六',1100000,350000,254000,40000,'stalemate','武汉会战是抗战初期规模最大、时间最长的战役，大量消耗了日军有生力量，为持久抗战奠定了基础。','武汉会战历时4个半月，是抗日战争战略防御阶段规模最大、时间最长、歼敌最多的一次战役。中国军队虽然最终撤出武汉，但大量消耗了日军有生力量，为战略相持阶段的到来创造了条件。',5,1670,1,1766237149,1766237149),(17,'长沙会战','Battle of Changsha','湖南长沙',28.2282090,112.9388140,'1939-09-14','1944-08-08',1795,'薛岳、罗卓英','冈村宁次',300000,120000,70000,60000,'victory','长沙会战前三次均以中国军队胜利告终，是抗战中期正面战场的重大胜利，沉重打击了日军的嚣张气焰。','长沙会战共进行了四次，前三次会战中国军队均取得胜利。特别是第三次长沙会战，中国军队歼敌5万余人，击毙日军中将指挥官，是抗战以来正面战场的重大胜利。',5,1450,1,1766237149,1766237149),(18,'百团大战','Hundred Regiments Offensive','华北地区',37.8735320,112.5623980,'1940-08-20','1940-12-05',108,'彭德怀、左权','多田骏',400000,150000,17000,20000,'victory','百团大战是抗战期间八路军在华北地区发动的规模最大、持续时间最长的战役，沉重打击了日军的\"囚笼政策\"。','百团大战是八路军在华北敌后战场发动的一次大规模进攻战役。参战部队达105个团约40万人，攻击目标主要是破坏日军的交通线，摧毁日伪军据点。此战沉重打击了日军的\"囚笼政策\"，振奋了全国军民的抗战信心。',5,2100,1,1766237149,1766237149),(19,'枣宜会战','Battle of Zaoyang-Yichang','湖北枣阳、宜昌',31.8917000,112.7688000,'1940-05-01','1940-06-18',49,'张自忠、李宗仁','园部和一郎',400000,150000,50000,7000,'defeat','枣宜会战中，上将张自忠壮烈殉国，成为抗战中牺牲的最高将领，其精神永垂不朽。','枣宜会战是1940年日军为控制长江交通、切断通往重庆的运输线而发动的战役。中国军队奋勇抵抗，第33集团军总司令张自忠将军在战斗中壮烈殉国，成为抗战期间牺牲的最高将领。',5,1780,1,1766237149,1766237149),(20,'中国远征军入缅作战','Chinese Expeditionary Force in Burma','缅甸',21.9162210,95.9559740,'1942-03-01','1942-08-01',154,'杜聿明、戴安澜','饭田祥二郎',100000,60000,50000,4500,'defeat','远征军入缅作战是中国军队首次出国作战，虽然失利但展现了中国军人的英勇气概，戴安澜将军殉国缅甸。','1942年，应英国请求，中国组建远征军入缅作战。远征军在极其艰苦的条件下与日军作战，第200师师长戴安澜将军在战斗中壮烈牺牲。虽然此次作战未能达到预期目标，但展现了中国军人的英勇气概。',4,1560,1,1766237149,1766237149),(21,'常德会战','Battle of Changde','湖南常德',29.0316730,111.6984970,'1943-11-02','1943-12-20',49,'孙连仲、余程万','横山勇',100000,70000,50000,20000,'victory','常德会战中，第74军57师8000余人坚守常德16天，展现了中国军人宁死不屈的精神。','1943年11月，日军进攻常德。第74军57师师长余程万率8000余人坚守常德城16天，与数倍于己的日军激战，最后仅剩200余人突围。这次战役展现了中国军人视死如归的英雄气概。',4,1320,1,1766237149,1766237149),(22,'豫湘桂会战','Battle of Henan-Hunan-Guangxi','河南、湖南、广西',32.6378000,113.8214000,'1944-04-17','1944-12-10',238,'蒋鼎文、汤恩伯','冈村宁次',500000,510000,300000,100000,'defeat','豫湘桂会战是抗战后期中国正面战场的一次大溃败，但也暴露了国民党军队的腐败，促使国共合作抗日。','豫湘桂会战是1944年日军为打通大陆交通线而发动的大规模进攻。由于国民党军队指挥失当、装备落后，战役以失败告终。但这次失败也促使中国军队进行改革，为最后的反攻奠定了基础。',4,1240,1,1766237149,1766237149),(23,'湘西会战','Battle of West Hunan','湖南西部',27.5500000,109.7330000,'1945-04-09','1945-06-07',60,'王耀武、施中诚','板西一良',200000,80000,28000,28000,'victory','湘西会战是中国抗战的最后一次会战，中国军队取得完胜，标志着中国军队已完全掌握战场主动权。','湘西会战是抗日战争的最后一次大规模会战。中国军队装备精良，士气高昂，在王耀武指挥下取得完胜，歼敌2.8万余人。这次胜利标志着中国军队已完全掌握战场主动权，为最终胜利奠定了基础。',5,1680,1,1766237149,1766237149),(24,'滇西反攻战役','Yunnan-Burma Campaign','云南西部',25.0406090,98.5783630,'1944-05-11','1945-01-20',255,'卫立煌、宋希濂','松山守备队',160000,50000,67000,21000,'victory','滇西反攻是中国军队首次大规模反攻作战，收复了大片国土，打通了中印公路。','1944年5月，中国远征军和驻印军发起滇西反攻，经过8个月激战，收复了滇西全部失地，打通了中印公路。这次反攻标志着中国军队由防御转入反攻，为最后胜利创造了条件。',5,1520,1,1766237149,1766237149),(25,'S','S','A',NULL,NULL,'2025-12-06','2025-12-19',NULL,'A','',NULL,NULL,NULL,NULL,'victory','A','B',NULL,0,1,1766314136,1766315882),(26,'S','S','A',NULL,NULL,'2025-12-06','2025-12-19',NULL,'A','',NULL,NULL,NULL,NULL,'victory','hh','yh',NULL,0,1,1766315901,1766315901),(27,'S','S','A',NULL,NULL,'2025-12-06','2025-12-19',NULL,'A','',NULL,NULL,NULL,NULL,'victory','saa','asc',NULL,0,1,1766316057,1766316057);
/*!40000 ALTER TABLE `battle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `battle_phase`
--

DROP TABLE IF EXISTS `battle_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `battle_phase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `battle_id` int NOT NULL COMMENT '战役ID',
  `phase_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '阶段名称',
  `phase_order` int DEFAULT NULL COMMENT '阶段顺序',
  `start_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '阶段描述',
  `key_events` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '关键事件',
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-battle_phase-battle_id` (`battle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `battle_phase`
--

LOCK TABLES `battle_phase` WRITE;
/*!40000 ALTER TABLE `battle_phase` DISABLE KEYS */;
INSERT INTO `battle_phase` VALUES (10,1,'淞沪会战第一阶段',1,'1937-08-13','1937-08-22','中国军队主动出击，进攻日军在上海的据点。','8月13日，中国军队向日军虹口、杨树浦等据点发起进攻。日军增援部队陆续到达。双方在市区展开激烈巷战。',1766237149),(11,1,'淞沪会战第二阶段',2,'1937-08-23','1937-10-25','日军大规模增援，战线扩大到整个上海及周边地区。','日军在吴淞、川沙等地登陆，战线扩大。中日双方投入大量兵力，在罗店、大场等地展开激战。中国军队伤亡惨重，但始终坚守阵地。',1766237149),(12,1,'淞沪会战第三阶段',3,'1937-10-26','1937-11-12','中国军队全线撤退，上海失守。','10月26日，日军在杭州湾金山卫登陆，对中国军队形成包围之势。中国军队被迫全线撤退。11月12日，上海失守。',1766237149),(13,3,'台儿庄战役第一阶段',1,'1938-03-16','1938-03-23','日军进攻台儿庄，中国军队顽强抵抗。','3月16日，日军矶谷师团进攻台儿庄。中国军队在外围与日军激战，逐步后撤。3月23日，日军进入台儿庄城。',1766237149),(14,3,'台儿庄战役第二阶段',2,'1938-03-24','1938-04-06','中国军队坚守台儿庄，与日军展开激烈巷战。','中国军队在台儿庄城内与日军展开逐屋争夺的巷战。双方伤亡惨重，战斗异常激烈。中国军队始终坚守阵地，等待反攻时机。',1766237149),(15,3,'台儿庄战役第三阶段',3,'1938-04-06','1938-04-07','中国军队发起反攻，收复台儿庄。','4月6日夜，中国军队发起反攻，对日军形成包围。经过一夜激战，收复台儿庄，歼敌1万余人，取得抗战以来正面战场的最大胜利。',1766237149),(16,6,'百团大战第一阶段',1,'1940-08-20','1940-09-10','破袭正太铁路为重点的交通破袭战。','8月20日，八路军105个团在华北地区同时发起攻击，重点破袭正太铁路。攻克日军据点多处，破坏铁路、公路数百公里。',1766237149),(17,6,'百团大战第二阶段',2,'1940-09-22','1940-10-05','继续扩大战果，攻击日军据点。','八路军继续扩大战果，攻击日军据点和交通线。涞源、灵丘等战斗激烈，日军遭受重大损失。',1766237149),(18,6,'百团大战第三阶段',3,'1940-10-06','1940-12-05','反\"扫荡\"作战。','日军集结重兵对根据地进行报复性\"扫荡\"。八路军进行反\"扫荡\"作战，保卫根据地。虽然付出较大代价，但最终粉碎了日军的\"扫荡\"。',1766237149);
/*!40000 ALTER TABLE `battle_phase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_message`
--

DROP TABLE IF EXISTS `contact_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT '留言者 ID',
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '留言內容',
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '管理員回覆',
  `status` smallint NOT NULL DEFAULT '0' COMMENT '0 未回覆 1 已回覆',
  `created_at` int NOT NULL,
  `replied_at` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-contact_message-user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_message`
--

LOCK TABLES `contact_message` WRITE;
/*!40000 ALTER TABLE `contact_message` DISABLE KEYS */;
INSERT INTO `contact_message` VALUES (1,1,'afv','absb',1,1766309019,1766309031),(2,1,'ava',NULL,0,1766309297,NULL),(3,5,'abe','zgs',1,1766315686,1766315870),(4,6,'SVDV','AAA',1,1766316027,1766316040);
/*!40000 ALTER TABLE `contact_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guestbook`
--

DROP TABLE IF EXISTS `guestbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guestbook` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '留言者姓名',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '留言内容',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类别:tribute缅怀/comment评论/suggestion建议',
  `related_model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关联模型',
  `related_id` int DEFAULT NULL COMMENT '关联ID',
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '回复内容',
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP地址',
  `is_public` tinyint DEFAULT '1' COMMENT '是否公开',
  `status` tinyint DEFAULT '0' COMMENT '状态:0待审核1已审核2已回复',
  `replied_at` int DEFAULT NULL COMMENT '回复时间',
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-guestbook-status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guestbook`
--

LOCK TABLES `guestbook` WRITE;
/*!40000 ALTER TABLE `guestbook` DISABLE KEYS */;
INSERT INTO `guestbook` VALUES (6,'王明','wangming@example.com','向抗日英烈致敬！他们用生命和鲜血换来了今天的和平，我们永远不会忘记！','tribute',NULL,NULL,NULL,'192.168.1.100',1,1,NULL,1766237149),(7,'李华','lihua@example.com','看了张自忠将军的事迹，深受感动。作为新时代的青年，我们要继承先烈遗志，为中华民族的伟大复兴而奋斗！','tribute','hero',1,NULL,'192.168.1.101',1,1,NULL,1766237149),(8,'张伟','zhangwei@example.com','网站做得很好，内容丰富，资料详实。建议增加更多的视频资料和互动功能。','suggestion',NULL,NULL,NULL,'192.168.1.102',1,1,NULL,1766237149),(9,'刘芳','liufang@example.com','参观了侵华日军南京大屠杀遇难同胞纪念馆，心情非常沉重。勿忘国耻，吾辈自强！','tribute','memorial',2,NULL,'192.168.1.103',1,1,NULL,1766237149),(10,'陈杰','chenjie@example.com','平型关大捷的故事让我热血沸腾！八路军战士的英勇无畏，永远值得我们学习！','comment','battle',2,NULL,'192.168.1.104',1,1,NULL,1766237149),(11,'用户1','1@163.com','adv','comment','battle',13,NULL,'192.168.188.1',1,1,NULL,1766245457),(12,'aa','1@163.com','sa','comment','battle',13,NULL,'192.168.188.1',1,1,NULL,1766245727),(13,'aa','1@163.com','sccf','comment','battle',13,NULL,'192.168.188.1',1,1,NULL,1766302449),(14,'aa','1@163.com','o\'','comment','story',14,NULL,'192.168.188.1',1,1,NULL,1766303647),(15,'aa','1@163.com','fzgfxdh','comment','story',14,NULL,'192.168.188.1',1,1,NULL,1766303756),(16,'aa','1@163.com','afff','comment','story',25,NULL,'192.168.188.1',1,1,NULL,1766311330),(17,'aa','1@163.com','agag','comment','story',25,NULL,'192.168.188.1',1,1,NULL,1766311495),(18,'aa','1@163.com','vvv','comment','story',15,NULL,'192.168.188.1',1,1,NULL,1766311941),(19,'测试用户1',NULL,'示例评论 1',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309263),(20,'测试用户2',NULL,'示例评论 2',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309832),(21,'测试用户3',NULL,'示例评论 3',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311417),(22,'测试用户4',NULL,'示例评论 4',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310187),(23,'测试用户5',NULL,'示例评论 5',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312549),(24,'测试用户6',NULL,'示例评论 6',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310989),(25,'演示用户7',NULL,'自动生成评论 1',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311655),(26,'演示用户8',NULL,'自动生成评论 2',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312230),(27,'演示用户9',NULL,'自动生成评论 3',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311213),(28,'演示用户10',NULL,'自动生成评论 4',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309449),(29,'演示用户11',NULL,'自动生成评论 5',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311129),(30,'演示用户12',NULL,'自动生成评论 6',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311053),(31,'演示用户13',NULL,'自动生成评论 7',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309463),(32,'演示用户14',NULL,'自动生成评论 8',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310694),(33,'演示用户15',NULL,'自动生成评论 9',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312503),(34,'演示用户16',NULL,'自动生成评论 10',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312034),(35,'演示用户17',NULL,'自动生成评论 11',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310903),(36,'演示用户18',NULL,'自动生成评论 12',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312488),(37,'演示用户19',NULL,'自动生成评论 13',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310326),(38,'演示用户20',NULL,'自动生成评论 14',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309914),(39,'演示用户21',NULL,'自动生成评论 15',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310059),(40,'演示用户22',NULL,'自动生成评论 16',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310169),(41,'演示用户23',NULL,'自动生成评论 17',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312159),(42,'演示用户24',NULL,'自动生成评论 18',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311576),(43,'演示用户25',NULL,'自动生成评论 19',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312638),(44,'演示用户26',NULL,'自动生成评论 20',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312013),(45,'演示用户27',NULL,'自动生成评论 21',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311198),(46,'演示用户28',NULL,'自动生成评论 22',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310893),(47,'演示用户29',NULL,'自动生成评论 23',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312435),(48,'演示用户30',NULL,'自动生成评论 24',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311666),(49,'演示用户31',NULL,'自动生成评论 25',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312380),(50,'演示用户32',NULL,'自动生成评论 26',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311938),(51,'演示用户33',NULL,'自动生成评论 27',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309136),(52,'演示用户34',NULL,'自动生成评论 28',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311732),(53,'演示用户35',NULL,'自动生成评论 29',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309751),(54,'演示用户36',NULL,'自动生成评论 30',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311262),(55,'演示用户37',NULL,'自动生成评论 31',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312634),(56,'演示用户38',NULL,'自动生成评论 32',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312092),(57,'演示用户39',NULL,'自动生成评论 33',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766312310),(58,'演示用户40',NULL,'自动生成评论 34',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311582),(59,'演示用户41',NULL,'自动生成评论 35',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766309649),(60,'演示用户42',NULL,'自动生成评论 36',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311442),(61,'演示用户43',NULL,'自动生成评论 37',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311357),(62,'演示用户44',NULL,'自动生成评论 38',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311743),(63,'演示用户45',NULL,'自动生成评论 39',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766311287),(64,'演示用户46',NULL,'自动生成评论 40',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1766310856),(65,'qqq','123@163.com','adfggg','comment','story',14,NULL,'192.168.188.1',1,1,NULL,1766315324),(66,'qqqqq','234@163.com','afghhh','comment','story',14,NULL,'192.168.188.1',1,1,NULL,1766315558),(67,'aaaaa','55555@163.com','asdfg','comment','story',14,NULL,'192.168.188.1',1,1,NULL,1766315974),(68,'aaaaa','55555@163.com','ad','comment','story',18,NULL,'192.168.188.1',1,1,NULL,1766316924);
/*!40000 ALTER TABLE `guestbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero`
--

DROP TABLE IF EXISTS `hero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '别名/字号',
  `gender` tinyint DEFAULT NULL COMMENT '性别:1男2女',
  `birth_date` date DEFAULT NULL COMMENT '出生日期',
  `death_date` date DEFAULT NULL COMMENT '牺牲日期',
  `birthplace` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '籍贯',
  `rank` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '军衔',
  `unit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '所属部队',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类别:general将领/soldier士兵/spy特工/civilian平民',
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '照片',
  `biography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '人物传记',
  `major_battles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '参与战役',
  `honors` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '荣誉勋章',
  `famous_quotes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '名言',
  `sacrifice_location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '牺牲地点',
  `memorial_location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '纪念地',
  `views` int DEFAULT '0',
  `status` tinyint DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-hero-category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero`
--

LOCK TABLES `hero` WRITE;
/*!40000 ALTER TABLE `hero` DISABLE KEYS */;
INSERT INTO `hero` VALUES (13,'张自忠','荩忱',1,'1891-08-11','1940-05-16','山东临清','陆军上将','第33集团军','general',NULL,'张自忠将军是抗日战争中牺牲的最高将领。他一生戎马，英勇善战，在枣宜会战中身先士卒，最后壮烈殉国，年仅49岁。毛泽东称其为\"抗战军人之魂\"。','淞沪会战、徐州会战、武汉会战、随枣会战、枣宜会战','追赠陆军上将、革命烈士','为国家民族死之决心，海不清，石不烂，决不半点改变！','湖北宜城南瓜店','重庆梅花山、北京卢沟桥',3450,1,1766237149,1766237149),(14,'赵登禹','舜诚',1,'1898-01-01','1937-07-28','山东菏泽','陆军上将','第29军','general',NULL,'赵登禹将军是著名抗日将领，在喜峰口战役中率大刀队夜袭日军，取得重大胜利。七七事变后，在南苑战役中壮烈殉国，是第一位在抗战中牺牲的师级将领。','长城抗战、喜峰口战役、南苑战役','追赠陆军上将、革命烈士','军人战死沙场原是本分，没有什么值得悲伤的。','北京南苑','北京卢沟桥抗战纪念馆',2890,1,1766237149,1766237149),(15,'佟麟阁','捷三',1,'1892-10-29','1937-07-28','河北高阳','陆军上将','第29军','general',NULL,'佟麟阁将军是著名抗日将领，七七事变后率部在南苑与日军激战，身中数弹仍坚持指挥战斗，最后壮烈殉国。他是抗战初期牺牲的最高将领之一。','长城抗战、南苑战役','追赠陆军上将、革命烈士','战死者光荣，偷生者耻辱；荣辱系于一人者轻，而系于国家民族者重。','北京南苑','北京卢沟桥抗战纪念馆',2670,1,1766237149,1766237149),(16,'戴安澜','衍功',1,'1904-11-25','1942-05-26','安徽无为','陆军中将','第200师','general',NULL,'戴安澜将军是著名抗日将领，率第200师参加中国远征军入缅作战。在同古保卫战中重创日军，后在撤退途中遭遇日军伏击，身负重伤，壮烈殉国。','淞沪会战、徐州会战、武汉会战、昆仑关战役、同古保卫战','追赠陆军中将、革命烈士、国家一级英雄','现在孤军奋斗，决心全部牺牲，以报国家养育！','缅甸北部茅邦','安徽芜湖赭山公园',3120,1,1766237149,1766237149),(17,'左权','纪权',1,'1905-03-15','1942-05-25','湖南醴陵','八路军副总参谋长','八路军总部','general',NULL,'左权将军是八路军高级将领，黄埔军校一期毕业，后留学苏联。回国后参加长征，抗战期间任八路军副总参谋长。1942年在反扫荡战斗中壮烈牺牲，是八路军在抗战中牺牲的最高将领。','平型关战役、百团大战','革命烈士、八路军高级将领','我牺牲了我的一切幸福为我的事业奋斗，请你相信这一道路是光明的、伟大的。','山西辽县十字岭','山西左权县烈士陵园',2980,1,1766237149,1766237149),(18,'杨靖宇','马尚德',1,'1905-02-26','1940-02-23','河南确山','东北抗日联军第一路军总司令','东北抗日联军','general',NULL,'杨靖宇将军是著名抗日英雄，东北抗日联军创建人和领导人之一。在极端艰苦的条件下坚持游击战争，最后孤身一人与日军周旋5昼夜，壮烈牺牲。日军解剖其遗体，发现胃里只有草根、树皮和棉絮。','东北抗日游击战争','革命烈士、抗日民族英雄','革命就像火一样，任凭大雪封山，鸟兽藏迹，只要我们有火种，就能驱赶严寒，带来光明和温暖。','吉林濛江县保安村','吉林靖宇县杨靖宇烈士陵园',3680,1,1766237149,1766237149),(19,'赵一曼','李坤泰',2,'1905-10-25','1936-08-02','四川宜宾','东北抗日联军第三军第二团政委','东北抗日联军','general',NULL,'赵一曼是著名女英雄，东北抗日联军的杰出领导人。1935年被日军逮捕，遭受酷刑仍坚贞不屈，1936年英勇就义。她在狱中给儿子写下遗书：\"母亲不用千言万语来教育你，就用实际行动来教育你。\"','东北抗日游击战争','革命烈士、抗日民族英雄','未惜头颅新故国，甘将热血沃中华。','黑龙江珠河县','黑龙江尚志市赵一曼纪念馆',3240,1,1766237149,1766237149),(20,'狼牙山五壮士','',1,'1920-01-01','1941-09-25','河北','八路军战士','晋察冀军区第一军分区','soldier',NULL,'狼牙山五壮士是指在河北省易县狼牙山战斗中英勇抗击日军的八路军5位英雄：马宝玉、葛振林、宋学义、胡德林、胡福才。他们为掩护群众和主力部队转移，主动把敌人引向绝路，弹尽粮绝后跳崖殉国。','狼牙山战斗','革命烈士、抗日英雄','打倒日本帝国主义！中国共产党万岁！','河北易县狼牙山','河北易县狼牙山五勇士纪念塔',2560,1,1766237149,1766237149),(21,'八女投江','',2,'1920-01-01','1938-10-05','东北','东北抗日联军战士','东北抗日联军第五军','soldier',NULL,'八女投江是指1938年10月，东北抗日联军第五军妇女团8名女战士：冷云、胡秀芝、杨贵珍、郭桂琴、黄桂清、王惠民、李凤善、安顺福，为掩护主力部队突围，主动吸引日军火力，最后弹尽援绝，宁死不屈，集体投江殉国。','东北抗日游击战争','革命烈士、抗日英雄','宁死不当亡国奴！','黑龙江牡丹江市林口县','黑龙江牡丹江市八女投江纪念碑',2780,1,1766237149,1766237149),(22,'谢晋元','中民',1,'1905-04-26','1941-04-24','广东蕉岭','陆军中校','第88师524团','general',NULL,'谢晋元将军率\"八百壮士\"坚守上海四行仓库四天四夜，击退日军数十次进攻，鼓舞了全国军民的抗战士气。后被汪伪政府收买的叛徒刺杀身亡。','淞沪会战、四行仓库保卫战','革命烈士、抗日英雄','我们是中国人，我们要为祖国而战！','上海孤军营','上海四行仓库抗战纪念馆',2450,1,1766237149,1766237149),(23,'彭雪枫','隆雍',1,'1907-09-09','1944-09-11','河南镇平','新四军第四师师长','新四军','general',NULL,'彭雪枫将军是新四军的杰出指挥员，在抗日战争和解放战争中屡建奇功。1944年在河南夏邑八里庄战斗中不幸中流弹牺牲，年仅37岁。','淮北抗日根据地建设、西华战役','革命烈士、新四军高级将领','为了人民的解放事业，我愿意献出自己的一切。','河南夏邑八里庄','河南镇平彭雪枫纪念馆',2120,1,1766237149,1766237149),(24,'吉鸿昌','世五',1,'1895-10-18','1934-11-24','河南扶沟','陆军中将','抗日同盟军','general',NULL,'吉鸿昌将军是著名抗日将领，曾组织抗日同盟军。1933年在张家口抗击日军，后被国民党逮捕。1934年在北平英勇就义，临刑前写下绝命诗：\"恨不抗日死，留作今日羞。国破尚如此，我何惜此头！\"','长城抗战','革命烈士、抗日英雄','恨不抗日死，留作今日羞。国破尚如此，我何惜此头！','北京','河南扶沟吉鸿昌纪念馆',2340,1,1766237149,1766237149);
/*!40000 ALTER TABLE `hero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero_achievement`
--

DROP TABLE IF EXISTS `hero_achievement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero_achievement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hero_id` int NOT NULL COMMENT '英雄ID',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '事迹标题',
  `event_date` date DEFAULT NULL COMMENT '事件日期',
  `location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '事件地点',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '详细描述',
  `impact` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '影响意义',
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '相关图片JSON',
  `sort_order` int DEFAULT '0',
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-hero_achievement-hero_id` (`hero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero_achievement`
--

LOCK TABLES `hero_achievement` WRITE;
/*!40000 ALTER TABLE `hero_achievement` DISABLE KEYS */;
INSERT INTO `hero_achievement` VALUES (16,1,'指挥临沂战役','1938-03-14','山东临沂','1938年3月，张自忠指挥第59军在临沂与日军激战，击退日军板垣师团的进攻，为台儿庄战役的胜利创造了条件。','临沂战役的胜利，粉碎了日军南北夹击台儿庄的计划，为台儿庄大捷奠定了基础。',NULL,1,1766237149),(17,1,'坚守襄河防线','1940-05-01','湖北襄阳','1940年5月，张自忠率部坚守襄河防线，多次击退日军进攻，展现了高超的指挥艺术和顽强的战斗精神。','襄河防线的坚守，迟滞了日军的进攻，为中国军队争取了宝贵时间。',NULL,2,1766237149),(18,1,'壮烈殉国','1940-05-16','湖北宜城','1940年5月16日，张自忠在枣宜会战中身先士卒，率部与日军激战，最后壮烈殉国，成为抗战中牺牲的最高将领。','张自忠将军的牺牲，震惊全国。他的英勇事迹，激励着全国军民坚持抗战到底。',NULL,3,1766237149),(19,4,'指挥昆仑关战役','1939-12-18','广西南宁','1939年12月，戴安澜率第200师参加昆仑关战役，与日军激战，收复昆仑关，取得重大胜利。','昆仑关战役是抗战以来攻坚战的典范，戴安澜因此役成名，被誉为\"当代之标准青年将领\"。',NULL,1,1766237149),(20,4,'血战同古','1942-03-20','缅甸同古','1942年3月，戴安澜率第200师在缅甸同古与日军激战12天，以劣势装备重创日军，展现了中国军人的英勇气概。','同古保卫战打出了中国军人的威风，提高了中国的国际地位，英国首相丘吉尔称赞：\"立功异域，扬威国际\"。',NULL,2,1766237149),(21,4,'壮烈殉国','1942-05-26','缅甸茅邦','1942年5月26日，戴安澜在率部撤退途中遭遇日军伏击，身负重伤，壮烈殉国，年仅38岁。','戴安澜将军的牺牲，是中国军队的重大损失。毛泽东、蒋介石都为他题写了挽词，表达了对这位抗日英雄的敬意。',NULL,3,1766237149),(22,5,'指挥平型关战役','1937-09-25','山西灵丘','1937年9月25日，左权协助林彪指挥平型关战役，取得全面抗战以来的第一个大胜利。','平型关大捷打破了日军不可战胜的神话，极大地鼓舞了全国军民的抗战信心。',NULL,1,1766237149),(23,5,'指挥百团大战','1940-08-20','华北地区','1940年8月，左权协助彭德怀指挥百团大战，沉重打击了日军的\"囚笼政策\"。','百团大战是抗战期间八路军发动的规模最大的战役，提高了共产党和八路军的威望。',NULL,2,1766237149),(24,5,'壮烈殉国','1942-05-25','山西辽县','1942年5月25日，左权在反\"扫荡\"战斗中壮烈牺牲，是八路军在抗战中牺牲的最高将领。','左权将军的牺牲，是八路军的重大损失。他的英勇事迹，永远激励着中国人民。',NULL,3,1766237149),(25,6,'创建东北抗日联军','1933-01-01','东北地区','杨靖宇是东北抗日联军的创建人和领导人之一，在极端艰苦的条件下坚持游击战争。','东北抗日联军的建立，开辟了东北抗日游击战争的新局面，牵制了大量日军。',NULL,1,1766237149),(26,6,'孤身战斗五昼夜','1940-02-18','吉林濛江','1940年2月，杨靖宇在极端艰苦的条件下，孤身一人与日军周旋5昼夜，展现了钢铁般的意志。','杨靖宇将军的英勇事迹，震撼了敌人，教育了人民，成为中华民族精神的象征。',NULL,2,1766237149),(27,6,'英勇就义','1940-02-23','吉林濛江','1940年2月23日，杨靖宇在濛江县保安村壮烈牺牲。日军解剖其遗体，发现胃里只有草根、树皮和棉絮。','杨靖宇将军的牺牲，展现了中国人民不屈不挠的抗战精神，永远激励着后人。',NULL,3,1766237149),(28,7,'领导东北抗日游击战','1935-01-01','东北地区','赵一曼是东北抗日联军的杰出领导人，在极端艰苦的条件下领导抗日游击战争。','赵一曼的英勇斗争，沉重打击了日本侵略者，鼓舞了东北人民的抗日斗争。',NULL,1,1766237149),(29,7,'被捕后坚贞不屈','1935-11-15','黑龙江珠河','1935年11月，赵一曼在战斗中负伤被俘。在狱中，日军对她施以酷刑，但她始终坚贞不屈。','赵一曼在狱中的表现，展现了共产党员的坚强意志和崇高品格，成为中国妇女的光辉榜样。',NULL,2,1766237149),(30,7,'英勇就义','1936-08-02','黑龙江珠河','1936年8月2日，赵一曼在珠河县英勇就义，年仅31岁。临刑前，她给儿子写下了感人的遗书。','赵一曼的牺牲，是中国人民的重大损失。她的英勇事迹和遗书，教育和激励了无数中国人。',NULL,3,1766237149);
/*!40000 ALTER TABLE `hero_achievement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型:image图片/video视频/audio音频/document文档',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分类:photo照片/poster海报/map地图/film影片/song歌曲',
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文件路径',
  `file_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '外部链接',
  `file_size` int DEFAULT NULL COMMENT '文件大小(字节)',
  `duration` int DEFAULT NULL COMMENT '时长(秒)',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '描述',
  `source` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
  `date_taken` date DEFAULT NULL COMMENT '拍摄/创作日期',
  `photographer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '摄影师/创作者',
  `location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '拍摄地点',
  `related_model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关联模型:battle/hero/memorial',
  `related_id` int DEFAULT NULL COMMENT '关联ID',
  `views` int DEFAULT '0',
  `downloads` int DEFAULT '0',
  `status` tinyint DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-media-type` (`type`),
  KEY `idx-media-related` (`related_model`,`related_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (6,'淞沪会战历史照片','image','photo','/uploads/media/songhu_battle.jpg',NULL,NULL,NULL,'1937年淞沪会战期间，中国军队在上海与日军激战的珍贵照片。','中国人民抗日战争纪念馆','1937-08-20','不详','上海','battle',1,2340,450,1,1766237149,1766237149),(7,'平型关大捷纪录片','video','film','/uploads/media/pingxingguan.mp4',NULL,NULL,NULL,'平型关大捷纪录片，记录了八路军115师在平型关伏击日军的英勇事迹。','中央电视台','2015-09-03','CCTV摄制组','山西灵丘','battle',2,3450,560,1,1766237149,1766237149),(8,'义勇军进行曲','audio','song','/uploads/media/yiyongjun.mp3',NULL,NULL,NULL,'《义勇军进行曲》是中华人民共和国国歌，创作于1935年，激励了无数中国人投身抗日救国。','聂耳作曲','1935-05-01','聂耳','上海',NULL,NULL,5670,890,1,1766237149,1766237149),(9,'张自忠将军照片','image','photo','/uploads/media/zhangzizhong.jpg',NULL,NULL,NULL,'张自忠将军戎装照，摄于1939年。','国民政府军事委员会','1939-01-01','不详','重庆','hero',1,1890,230,1,1766237149,1766237149),(10,'赵一曼烈士遗书','document','document','/uploads/media/zhaoyiman_letter.pdf',NULL,NULL,NULL,'赵一曼烈士临刑前写给儿子的遗书，字字泣血，感人至深。','黑龙江省档案馆','1936-08-01','不详','黑龙江珠河','hero',7,4560,780,1,1766237149,1766237149);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_username` (`username`),
  UNIQUE KEY `member_email` (`email`),
  UNIQUE KEY `member_password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'aa','Qpvbqmslx4QcAIdZKZYFKgJu23ualuc-','$2y$13$8lCzUje9MTiiL62NY8CPbur.adfZwmAPtfGI/uK/teTynQUyrqmUK',NULL,'1@163.com',10,1766236400,1766236400,NULL,NULL,NULL),(2,'testuser1','wN9EyLtU3ejE-NOzj89KNylQVhYcg29v','$2y$13$XW5jyHtIIyhTYCm0Jo5.LOE5OThH9ZF1YNUOL0B8t0gdLdTxGLShy',NULL,'testuser1@example.com',10,1766246368,1766246368,NULL,NULL,'测试用户1'),(3,'testuser2','E-gkxU4QaisPcjpLpuq1_Hz2St2sZ9fE','$2y$13$XW5jyHtIIyhTYCm0Jo5.LOE5OThH9ZF1YNUOL0B8t0gdLdTxGLShy',NULL,'testuser2@example.com',10,1766246368,1766246368,NULL,NULL,'测试用户2'),(4,'qqq','iRGD-0_UgfdqjsbecI0kXfGdXcRrNPGD','$2y$13$Lo4vbGokXiHA8b5AJttVHub3oVm4U13xeYZrCiO7Lvaazmk1LIhXy',NULL,'123@163.com',10,1766315296,1766315296,NULL,NULL,NULL),(5,'qqqqq','JaB-aqL4LhulWrAqMW10ggKp4CFFuf_Z','$2y$13$4HgN./ggUxmmbvIM324CseFMBSqmkpKMU7rFV1bj7O7NgxdxdKSlm',NULL,'234@163.com',10,1766315531,1766315531,NULL,NULL,NULL),(6,'aaaaa','fsehgXhySp0hXlG9bx72VSyGWE7kKrez','$2y$13$dpx4wX3jLKOA6MgckIimSe7LOFxDN517ENhUOwQFbNbLMJ1iudOY.',NULL,'55555@163.com',10,1766315949,1766315949,NULL,NULL,NULL);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memorial`
--

DROP TABLE IF EXISTS `memorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memorial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '纪念馆名称',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类型:museum纪念馆/monument纪念碑/site遗址/cemetery烈士陵园',
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '省份',
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '详细地址',
  `latitude` decimal(10,7) DEFAULT NULL COMMENT '纬度',
  `longitude` decimal(10,7) DEFAULT NULL COMMENT '经度',
  `established_date` date DEFAULT NULL COMMENT '建立日期',
  `area` decimal(10,2) DEFAULT NULL COMMENT '占地面积(平方米)',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '简介',
  `collections` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '馆藏文物',
  `opening_hours` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '开放时间',
  `ticket_price` decimal(10,2) DEFAULT NULL COMMENT '门票价格',
  `contact_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `website` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '官方网站',
  `views` int DEFAULT '0',
  `rating` decimal(3,1) DEFAULT '0.0' COMMENT '评分',
  `status` tinyint DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-memorial-type` (`type`),
  KEY `idx-memorial-province` (`province`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memorial`
--

LOCK TABLES `memorial` WRITE;
/*!40000 ALTER TABLE `memorial` DISABLE KEYS */;
INSERT INTO `memorial` VALUES (11,'中国人民抗日战争纪念馆','museum','北京','北京','北京市丰台区卢沟桥宛平城内街101号',39.8514000,116.2133000,'1987-07-07',35000.00,'中国人民抗日战争纪念馆是全国唯一一座全面反映中国人民抗日战争历史的大型综合性专题纪念馆。馆内收藏各类文物达3万余件，展览面积近6000平方米。','包括历史照片、文献资料、实物展品等3万余件，其中珍贵文物2000余件。展品涵盖抗战时期的武器装备、军服徽章、文件电报、生活用品等。','9:00-16:30（周一闭馆）',0.00,'010-83893163','http://www.1937china.com',5680,4.8,1,1766237149,1766237149),(12,'侵华日军南京大屠杀遇难同胞纪念馆','museum','江苏','南京','江苏省南京市建邺区水西门大街418号',32.0418000,118.7342000,'1985-08-15',74000.00,'侵华日军南京大屠杀遇难同胞纪念馆是为铭记侵华日军攻占南京后制造的南京大屠杀暴行而筹建的。馆内通过大量历史照片、文物、影像资料，揭露了日军的暴行。','馆藏文物史料20余万件，包括当年日军屠杀现场照片、幸存者证言、国际友人的记录等珍贵史料。','8:30-17:30（周一闭馆）',0.00,'025-86612230','http://www.nj1937.org',8920,4.9,1,1766237149,1766237149),(13,'九一八历史博物馆','museum','辽宁','沈阳','辽宁省沈阳市大东区望花南街46号',41.7856000,123.4578000,'1991-09-18',36600.00,'九一八历史博物馆是为警示后人勿忘国耻而建立的专题博物馆。博物馆建筑外形为一本翻开的台历，标注着\"1931年9月18日\"，寓意着这一天永远铭刻在人民心中。','馆藏文物1000余件，包括九一八事变时期的历史照片、文献资料、实物等，真实再现了日本侵略者的罪行和中国人民的抗争历史。','9:00-16:00（周一闭馆）',0.00,'024-88338981','http://www.918museum.org.cn',4560,4.7,1,1766237149,1766237149),(14,'台儿庄大战纪念馆','museum','山东','枣庄','山东省枣庄市台儿庄区沿河南路6号',34.5628000,117.7342000,'1993-04-08',34000.00,'台儿庄大战纪念馆是为纪念抗日战争初期著名的台儿庄大捷而建立的专题纪念馆。纪念馆通过大量珍贵文物和历史照片，再现了台儿庄大战的壮烈场面。','收藏抗战文物3000余件，包括当年战斗使用的武器、军服、电报、照片等，以及参战将士的回忆录和证言。','8:30-17:30',40.00,'0632-6679038','http://www.tezdzjng.com',3780,4.6,1,1766237149,1766237149),(15,'平型关大捷纪念馆','museum','山西','大同','山西省大同市灵丘县白崖台乡',39.4422000,114.2340000,'1997-09-25',12000.00,'平型关大捷纪念馆是为纪念八路军115师在平型关伏击日军取得抗战首次大捷而建立的。纪念馆位于平型关战役旧址，真实再现了当年激战的场景。','收藏文物800余件，包括战斗遗留的武器弹药、战士使用的生活用品、战斗经过的文字记录和照片等。','8:00-18:00',20.00,'0352-8588888','',2890,4.5,1,1766237149,1766237149),(16,'卢沟桥','monument','北京','北京','北京市丰台区卢沟桥城南街77号',39.8514000,116.2133000,'1189-01-01',5000.00,'卢沟桥始建于金代，是北京现存最古老的石造联拱桥。1937年7月7日，日军在此挑起事端，史称\"七七事变\"或\"卢沟桥事变\"，标志着中国全面抗战的开始。','卢沟桥本身就是珍贵的历史文物，桥上的石狮子形态各异，共有501只。桥头的宛平城墙上至今还保留着当年战斗的弹痕。','全天开放',20.00,'010-83893919','',6230,4.8,1,1766237149,1766237149),(17,'四行仓库抗战纪念馆','site','上海','上海','上海市静安区光复路1号',31.2514000,121.4603000,'2015-08-13',4000.00,'四行仓库是1937年淞沪会战中\"八百壮士\"坚守四天四夜的战斗遗址。2015年改建为抗战纪念馆，保留了当年战斗的痕迹，是上海市区唯一的战争遗址类爱国主义教育基地。','保存了四行仓库原有建筑及战斗痕迹，收藏了当年战斗使用的武器、战士遗物、历史照片等文物500余件。','9:00-17:00（周一闭馆）',0.00,'021-63808222','http://www.sixingmuseum.com',4120,4.7,1,1766237149,1766237149),(18,'重庆大轰炸遗址','site','重庆','重庆','重庆市渝中区磁器街1号',29.5567000,106.5774000,'1941-06-05',3000.00,'重庆大轰炸遗址是1941年6月5日日军轰炸重庆时，大隧道惨案发生地。当时上万民众在此躲避空袭，因通风不良和踩踏事故，造成数千人死亡。','保留了当年防空洞的原貌，展示了大轰炸期间的历史照片、幸存者证言、遇难者名单等珍贵史料。','9:00-17:00',0.00,'023-63845678','',3450,4.6,1,1766237149,1766237149),(19,'雨花台烈士陵园','cemetery','江苏','南京','江苏省南京市雨花台区雨花路215号',32.0012000,118.7791000,'1950-01-01',1130000.00,'雨花台烈士陵园是新中国规模最大的纪念性陵园，纪念在此牺牲的革命烈士。抗战期间，许多抗日志士在此英勇就义。','陵园内安葬和纪念了近10万名烈士，其中包括众多抗日英烈。建有烈士纪念馆、烈士纪念碑等纪念设施。','8:00-17:00',0.00,'025-52411523','http://www.yuhuatai.gov.cn',5670,4.8,1,1766237149,1766237149),(20,'延安革命纪念馆','museum','陕西','延安','陕西省延安市宝塔区王家坪',36.5854000,109.4897000,'1950-01-01',29000.00,'延安革命纪念馆是中国共产党在延安时期革命历史的综合性纪念馆。展示了中国共产党领导全国人民进行抗日战争和解放战争的光辉历程。','馆藏文物3.5万余件，包括毛泽东、周恩来等领导人使用过的物品，以及大量抗战时期的文献、照片、实物等。','8:00-18:00（冬季17:30）',0.00,'0911-2332870','http://www.yagmjng.com',6780,4.9,1,1766237149,1766237149);
/*!40000 ALTER TABLE `memorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m130524_201442_init',1766237148),('m190124_110200_add_verification_token_column_to_user_table',1766237149),('m251220_031659_create_war_memorial_tables',1766237149),('m251220_100000_insert_test_data',1766237149),('m251220_110000_create_sensitive_word_table',1766246368),('m251220_110000_insert_member_data',1766246368),('m251220_120000_remove_event_date_location_from_story_table',1766304695),('m251220_130000_create_contact_message_table',1766308869),('m251220_140000_drop_fk_contact_message',1766309000),('m251220_150000_seed_demo_data',1766312712),('m251220_150100_seed_more_today',1766312712),('m251220_150200_adjust_visit_stats',1766312828),('m251221_185653_remove_image_columns_from_battle_and_memorial',1766314899);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensitive_word`
--

DROP TABLE IF EXISTS `sensitive_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensitive_word` (
  `id` int NOT NULL AUTO_INCREMENT,
  `word` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '敏感詞',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`),
  KEY `idx-sensitive_word-word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensitive_word`
--

LOCK TABLES `sensitive_word` WRITE;
/*!40000 ALTER TABLE `sensitive_word` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensitive_word` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statistics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stat_date` date NOT NULL COMMENT '统计日期',
  `stat_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型:visit访问/search搜索/popular热门',
  `model_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模型类型:battle/hero/weapon等',
  `model_id` int DEFAULT NULL COMMENT '模型ID',
  `count` int DEFAULT '0' COMMENT '计数',
  `extra_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '额外数据JSON',
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-statistics-date` (`stat_date`),
  KEY `idx-statistics-type` (`stat_type`,`model_type`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES (16,'2025-12-20','search',NULL,NULL,89,NULL,1766237149),(17,'2025-12-20','popular','battle',2,234,NULL,1766237149),(18,'2025-12-20','popular','hero',6,267,NULL,1766237149),(19,'2025-12-20','like','guestbook',11,1,NULL,1766245460),(20,'2025-12-20','like','guestbook',12,1,NULL,1766245734),(21,'2025-12-21','like','guestbook',14,1,NULL,1766303749),(22,'2025-12-21','like','story',14,3,NULL,1766303973),(23,'2025-12-21','like','story',25,1,NULL,1766304339),(26,'2025-12-21','visit','frontend',0,387,NULL,1766312828),(27,'2025-12-20','visit','frontend',0,275,NULL,1766226428),(28,'2025-12-21','like','guestbook',66,1,NULL,1766315581),(29,'2025-12-21','like','guestbook',67,1,NULL,1766315997);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story`
--

DROP TABLE IF EXISTS `story`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `story` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '故事标题',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类别:memoir回忆录/legend传奇/diary日记/letter家书',
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者/讲述人',
  `author_role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者身份',
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '摘要',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '故事内容',
  `related_hero_id` int DEFAULT NULL COMMENT '关联英雄ID',
  `related_battle_id` int DEFAULT NULL COMMENT '关联战役ID',
  `source` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图',
  `audio_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '音频链接',
  `video_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '视频链接',
  `is_verified` tinyint DEFAULT '0' COMMENT '是否已验证',
  `views` int DEFAULT '0',
  `likes` int DEFAULT '0',
  `status` tinyint DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-story-category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story`
--

LOCK TABLES `story` WRITE;
/*!40000 ALTER TABLE `story` DISABLE KEYS */;
INSERT INTO `story` VALUES (13,'狼牙山五壮士的英雄事迹','legend','葛振林','狼牙山五壮士幸存者','1941年9月25日，八路军晋察冀军区第一军分区第一团七连六班的5名战士，为掩护群众和主力部队转移，主动把敌人引向狼牙山绝路，弹尽粮绝后纵身跳崖。','1941年秋，日伪军3500余人对晋察冀边区易县一带进行\"扫荡\"。9月25日，七连六班的马宝玉、葛振林、宋学义、胡德林、胡福才5名战士接受了掩护群众和主力部队转移的任务。他们边打边撤，把敌人引向狼牙山顶峰棋盘陀。在顶峰，他们英勇抗击，打退敌人多次冲锋。当子弹打光后，他们用石块还击。面对步步逼近的敌人，5位战士宁死不屈，砸烂枪支，高呼\"打倒日本帝国主义！\"\"中国共产党万岁！\"纵身跳下数十丈深的悬崖。马宝玉、胡德林、胡福才壮烈殉国，葛振林、宋学义被山腰的树枝挂住，幸免于难。',NULL,NULL,'葛振林口述，《人民日报》',NULL,NULL,NULL,1,4560,890,1,1766237149,1766237149),(14,'八女投江的壮烈牺牲','legend','冷云','东北抗日联军战士','1938年10月，东北抗日联军第五军妇女团8名女战士为掩护主力部队突围，主动吸引日军火力，最后弹尽援绝，宁死不屈，集体投江殉国。','1938年10月，东北抗日联军第五军一部在牡丹江地区乌斯浑河渡口与日伪军千余人遭遇。妇女团指导员冷云和班长胡秀芝、杨贵珍、郭桂琴、黄桂清、王惠民、李凤善、安顺福等8名女战士，为掩护大部队突围，主动吸引日军火力，与敌人展开激战。她们在背水作战至弹尽援绝的情况下，面对日军的劝降，誓死不屈。冷云坚定地对大家说：\"同志们，我们是共产党员、抗联战士，宁死也不做俘虏！为祖国的解放而战死，是我们最大的光荣！\"她们毁掉枪支，挽臂涉入波涛滚滚的乌斯浑河，高唱着《国际歌》，集体沉江，壮烈殉国。牺牲时，她们中年龄最大的冷云23岁，最小的安顺福只有13岁。',NULL,NULL,'《东北抗日联军史料》',NULL,NULL,NULL,1,3890,720,1,1766237149,1766237149),(15,'四行仓库八百壮士','legend','谢晋元','第88师524团团长','1937年10月，谢晋元率领第88师524团一营（实际420余人，对外号称800人）坚守上海四行仓库，孤军奋战四天四夜，击退日军数十次进攻。','1937年10月26日，淞沪会战已近尾声，中国军队大部撤退。为了向世界表明中国抗战到底的决心，第88师524团副团长谢晋元率领一营官兵420余人（对外号称800人），坚守苏州河北岸的四行仓库。四行仓库与公共租界仅一河之隔，战斗在各国记者和上海市民的注视下进行。谢晋元率部与日军激战四天四夜，击退敌人十余次进攻，毙伤日军200余人。战斗期间，上海市民冒着生命危险，将中国国旗和食物送入仓库。一位名叫杨惠敏的女童子军冒死将国旗送入仓库，次日清晨，国旗在四行仓库楼顶升起，极大地鼓舞了全国人民的抗战信心。10月30日，\"八百壮士\"奉命撤入租界，继续坚持抗战。',NULL,NULL,'《谢晋元传》',NULL,NULL,NULL,1,5230,1020,1,1766237149,1766237149),(16,'赵一曼的英勇就义','memoir','赵一曼','东北抗日联军政委','赵一曼是东北抗日联军的杰出领导人，1935年被日军逮捕后，遭受酷刑仍坚贞不屈，1936年英勇就义，年仅31岁。','赵一曼原名李坤泰，1905年出生于四川宜宾。1926年加入中国共产党，后被派往东北从事革命工作。九一八事变后，她积极投身抗日斗争，成为东北抗日联军的杰出领导人。1935年11月，赵一曼在与日军作战中负伤被俘。在狱中，日军对她施以酷刑，用钢针刺她的手指，用烧红的烙铁烙她的皮肉，但她始终坚贞不屈，没有泄露任何党的机密。1936年6月，她在就医期间，在看护和医生的帮助下逃脱，但不久再次被捕。临刑前，她给儿子写下遗书：\"母亲对于你没有能尽到教育的责任，实在是遗憾的事情。母亲因为坚决地做了反满抗日的斗争，今天已经到了牺牲的前夕了。希望你，宁儿啊！赶快成人，来安慰你地下的母亲！在你长大成人之后，希望不要忘记你的母亲是为国而牺牲的！\"1936年8月2日，赵一曼在珠河县英勇就义，年仅31岁。',NULL,NULL,'《赵一曼烈士传》',NULL,NULL,NULL,1,4670,890,1,1766237149,1766237149),(17,'张自忠将军的最后一战','legend','张克侠','第33集团军参谋','1940年5月，张自忠将军在枣宜会战中身先士卒，率部与日军激战，最后壮烈殉国，成为抗战中牺牲的最高将领。','1940年5月，日军集结15万兵力发动枣宜会战，企图切断通往重庆的运输线。第33集团军总司令张自忠将军亲率2000余人渡过襄河，与日军主力激战。5月16日，张自忠部被日军包围在南瓜店。面对数倍于己的敌人，张自忠毫不畏惧，亲自率队冲锋。激战中，他身中数弹，仍坚持指挥战斗。当左臂负伤后，他改用右手持枪射击。最后，他身中7弹，壮烈殉国，时年50岁。张自忠将军牺牲后，日军发现他的身份，为其举行了隆重的葬礼，以示敬意。蒋介石得知消息后，追赠张自忠为陆军上将。毛泽东称赞他为\"抗战军人之魂\"。重庆举行了10万人参加的追悼大会，全城下半旗致哀。张自忠将军的英勇事迹，永远激励着中国人民。',NULL,NULL,'《张自忠传》',NULL,NULL,NULL,1,5890,1150,1,1766237149,1766237149),(18,'戴安澜将军血战同古','legend','戴复东','戴安澜之子','1942年3月，戴安澜率第200师在缅甸同古与日军激战12天，以劣势装备重创日军，展现了中国军人的英勇气概。','1942年3月，中国远征军第200师师长戴安澜奉命率部进入缅甸作战。3月20日，第200师到达同古，与日军第55师团遭遇。日军兵力数倍于我，且有飞机、坦克支援。戴安澜率部在同古与日军激战12天，击退日军20余次进攻，毙伤敌5000余人。战斗中，戴安澜身先士卒，多次亲临前线指挥。他对部下说：\"现在孤军奋斗，决心全部牺牲，以报国家养育！\"由于友军未能及时增援，第200师弹药、粮食耗尽，被迫突围。在撤退途中，戴安澜不幸遭遇日军伏击，身负重伤。5月26日，戴安澜在缅北茅邦村壮烈殉国，年仅38岁。毛泽东为他题写挽词：\"外侮需人御，将军赋采薇。师称机械化，勇夺虎罴威。浴血东瓜守，驱倭棠吉归。沙场竟殒命，壮志也无违。\"',NULL,NULL,'《戴安澜传》',NULL,NULL,NULL,1,4230,810,1,1766237149,1766237149),(19,'杨靖宇将军的最后五天','legend','杨靖宇','东北抗日联军总司令','1940年2月，杨靖宇将军在极端艰苦的条件下，孤身一人与日军周旋5昼夜，最后壮烈牺牲。日军解剖其遗体，发现胃里只有草根、树皮和棉絮。','1940年2月，东北正值严冬，气温降至零下40度。杨靖宇率领的抗日联军在日伪军的\"围剿\"下，处境极其艰难。由于叛徒出卖，部队被打散，杨靖宇身边的战士一个个牺牲或失散。2月18日，最后两名战士也牺牲了，杨靖宇成了孤身一人。在零下40度的严寒中，没有粮食，没有棉衣，杨靖宇靠啃树皮、吃棉絮充饥。日军劝降，他严词拒绝：\"我是中国人，不能做亡国奴！\"2月23日，在濛江县保安村，杨靖宇被日军包围。他依托大树，用手枪与敌人激战，击毙击伤日伪军20余人。最后，身中数弹，壮烈牺牲，年仅35岁。日军残忍地将他的遗体解剖，发现他的胃里只有草根、树皮和棉絮，没有一粒粮食。连日军都被他的精神所震撼。杨靖宇将军的英雄事迹，永远激励着中国人民。',NULL,NULL,'《杨靖宇传》',NULL,NULL,NULL,1,6120,1280,1,1766237149,1766237149),(20,'平型关大捷的胜利','legend','杨成武','八路军115师独立团团长','1937年9月25日，八路军115师在平型关伏击日军，歼敌1000余人，取得全面抗战以来的第一个大胜利。','1937年9月，日军第5师团沿平绥路西进，企图进攻太原。八路军115师师长林彪、副师长聂荣臻决定在平型关设伏，歼灭日军。9月24日夜，115师主力秘密进入平型关东北公路两侧山地设伏。25日拂晓，日军第21旅团辎重队进入伏击圈。林彪一声令下，八路军从山上冲下，与日军展开白刃战。战斗异常激烈，八路军战士冒着敌人的炮火，冲入敌群，与日军展开肉搏。经过一天激战，八路军全歼日军第21旅团1000余人，击毁汽车100余辆，缴获大量军用物资。平型关大捷是全面抗战以来中国军队取得的第一个大胜利，打破了\"日军不可战胜\"的神话，极大地鼓舞了全国军民的抗战信心。这一胜利证明，中国军队完全有能力战胜日本侵略者。',NULL,NULL,'《八路军抗战史》',NULL,NULL,NULL,1,5340,1050,1,1766237149,1766237149),(21,'台儿庄大捷的辉煌','legend','池峰城','第31师师长','1938年春，中国军队在台儿庄与日军激战，经过半个多月的浴血奋战，取得抗战以来正面战场的最大胜利。','1938年3月，日军矶谷师团沿津浦路南下，进攻徐州。第五战区司令长官李宗仁决定在台儿庄与日军决战。3月23日，日军进攻台儿庄。第31师师长池峰城率部坚守台儿庄，与日军展开激烈巷战。战斗中，中国军队与日军逐屋争夺，有时一座房子要反复争夺数次。池峰城对部下说：\"士兵打完了，你就自己填进去！你填过了，我就来填进去！\"在最危急的时刻，第31师只剩下600余人，仍坚守阵地。4月6日，中国军队发起反攻，经过一夜激战，收复台儿庄，歼敌1万余人。台儿庄大捷是抗战以来正面战场取得的最大胜利，极大地鼓舞了全国军民的抗战士气，证明了中国军队完全有能力战胜日本侵略者。',NULL,NULL,'《台儿庄战役亲历记》',NULL,NULL,NULL,1,4780,920,1,1766237149,1766237149),(22,'常德保卫战的悲壮','legend','余程万','第74军57师师长','1943年11月，第74军57师8000余人坚守常德16天，与数倍于己的日军激战，最后仅剩200余人突围。','1943年11月2日，日军11万人进攻常德。第74军57师师长余程万率8000余人坚守常德城。日军动用飞机、大炮、毒气弹，对常德城进行疯狂轰炸。余程万率部顽强抵抗，与日军展开激烈巷战。战斗中，中国军队伤亡惨重，但始终坚守阵地。余程万给上级的电报中写道：\"弹尽，援绝，人无，城已破。职率副师长、师附、政治部主任、参谋主任等固守中央银行，各团长划分区域，扼守一屋，作最后抵抗，誓死为止，并祝胜利。\"11月18日，常德城被日军攻占，但第57师仍在城内坚持战斗。11月21日夜，余程万率仅剩的200余人突围。12月9日，中国军队收复常德。常德保卫战中，第57师8000余人，最后仅剩200余人，展现了中国军人视死如归的英雄气概。',NULL,NULL,'《常德会战纪实》',NULL,NULL,NULL,1,4120,780,1,1766237149,1766237149),(23,'百团大战的辉煌战果','legend','彭德怀','八路军副总司令','1940年8月，八路军在华北地区发动百团大战，参战部队达105个团约40万人，沉重打击了日军的\"囚笼政策\"。','1940年8月20日，八路军在华北地区同时对日军发动大规模进攻，史称\"百团大战\"。这次战役由八路军副总司令彭德怀指挥，参战部队达105个团约40万人，是抗战期间八路军发动的规模最大的战役。战役分为三个阶段：第一阶段以破袭正太铁路为重点，第二阶段继续扩大战果，第三阶段进行反\"扫荡\"作战。战役历时3个半月，进行大小战斗1824次，攻克据点2900余个，毙伤日伪军4万余人，俘虏日伪军1.8万余人，破坏铁路470余公里、公路1500余公里，缴获大量武器弹药。百团大战沉重打击了日军的\"囚笼政策\"，鼓舞了全国人民的抗战信心，提高了共产党和八路军的威望。但八路军也付出了伤亡1.7万余人的代价。',NULL,NULL,'《百团大战亲历记》',NULL,NULL,NULL,1,5670,1120,1,1766237149,1766237149),(24,'新四军黄桥战役','legend','粟裕','新四军江南指挥部副指挥','1940年10月，新四军在黄桥地区与国民党顽固派军队作战，以少胜多，歼敌1.1万余人，巩固了苏北抗日根据地。','1940年10月，国民党顽固派军队1.5万人进攻新四军苏北根据地。新四军江南指挥部副指挥粟裕率7000余人在黄桥地区迎战。粟裕采取\"诱敌深入、各个击破\"的战术，将敌人引入黄桥地区。10月4日，战斗打响。新四军战士英勇作战，经过两天激战，歼敌1.1万余人，击毙敌89军军长李守维。黄桥战役的胜利，巩固了苏北抗日根据地，为新四军的发展创造了条件。战役中，黄桥人民全力支援新四军，烙制了30万个烧饼送往前线，留下了\"黄桥烧饼\"的佳话。',NULL,NULL,'《新四军抗战史》',NULL,NULL,NULL,1,3450,670,1,1766237149,1766237149),(25,'FF','memoir','aa',NULL,'SX','DN',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766304331,1766304331),(26,'FF','legend','aa',NULL,'gs','dfd',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1766304874,1766304874),(27,'v','legend','aa',NULL,'ja','sv',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1766305070,1766305070),(28,'v','memoir','aa',NULL,'AG','HS',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1766305219,1766305219),(29,'示例故事 1','memoir',NULL,NULL,NULL,'这是一个示例故事内容1',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766309979,1766309270),(30,'示例故事 2','memoir',NULL,NULL,NULL,'这是一个示例故事内容2',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311154,1766310276),(31,'示例故事 3','memoir',NULL,NULL,NULL,'这是一个示例故事内容3',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311868,1766312558),(32,'示例故事 4','memoir',NULL,NULL,NULL,'这是一个示例故事内容4',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311906,1766310550),(33,'自动生成故事 1','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容1',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311675,1766312610),(34,'自动生成故事 2','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容2',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311350,1766312005),(35,'自动生成故事 3','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容3',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311011,1766310898),(36,'自动生成故事 4','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容4',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766309820,1766310226),(37,'自动生成故事 5','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容5',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766310420,1766311433),(38,'自动生成故事 6','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容6',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766310646,1766310353),(39,'自动生成故事 7','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容7',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766310405,1766312419),(40,'自动生成故事 8','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容8',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766309869,1766312311),(41,'自动生成故事 9','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容9',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311175,1766311236),(42,'自动生成故事 10','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容10',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311292,1766310140),(43,'自动生成故事 11','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容11',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766312184,1766309187),(44,'自动生成故事 12','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容12',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311441,1766310126),(45,'自动生成故事 13','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容13',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766312475,1766312191),(46,'自动生成故事 14','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容14',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311346,1766311759),(47,'自动生成故事 15','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容15',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311361,1766311674),(48,'自动生成故事 16','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容16',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766311914,1766311565),(49,'自动生成故事 17','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容17',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766310425,1766310540),(50,'自动生成故事 18','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容18',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766312428,1766312240),(51,'自动生成故事 19','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容19',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766309765,1766310173),(52,'自动生成故事 20','memoir',NULL,NULL,NULL,'这是自动生成的示例故事内容20',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766309799,1766309692),(53,'s','legend','qqqqq',NULL,'aca','s',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766315845,1766315845),(54,'gg','memoir','qqqqq',NULL,'sggs','fkmu',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766315855,1766315855),(55,'acd','diary','aaaaa',NULL,'acs','aCS',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,1,1766316012,1766316012);
/*!40000 ALTER TABLE `story` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeline_event`
--

DROP TABLE IF EXISTS `timeline_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeline_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_date` date NOT NULL COMMENT '事件日期',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '事件标题',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类别:battle战役/politics政治/diplomacy外交/massacre屠杀/victory胜利',
  `location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '事件地点',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '事件描述',
  `participants` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '参与人物',
  `impact` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '历史影响',
  `related_battle_id` int DEFAULT NULL COMMENT '关联战役ID',
  `related_hero_id` int DEFAULT NULL COMMENT '关联英雄ID',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '事件图片',
  `importance_level` tinyint DEFAULT '3' COMMENT '重要程度:1-5',
  `views` int DEFAULT '0',
  `status` tinyint DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-timeline_event-event_date` (`event_date`),
  KEY `idx-timeline_event-category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeline_event`
--

LOCK TABLES `timeline_event` WRITE;
/*!40000 ALTER TABLE `timeline_event` DISABLE KEYS */;
INSERT INTO `timeline_event` VALUES (24,'1931-09-18','九一八事变','battle','辽宁沈阳','1931年9月18日夜，日本关东军炸毁沈阳柳条湖附近的南满铁路路轨，反诬中国军队所为，随即炮轰北大营，进攻沈阳。这就是震惊中外的\"九一八事变\"。由于国民政府的不抵抗政策，东北三省在短短4个多月内全部沦陷。','日本关东军、东北军','九一八事变是日本帝国主义侵华的开端，标志着中国人民抗日战争的开始，也标志着世界反法西斯战争的开始。',NULL,NULL,NULL,5,4560,1,1766237149,1766237149),(25,'1932-01-28','一二八事变','battle','上海','1932年1月28日，日军突然进攻上海闸北，十九路军奋起抵抗。战斗持续一个多月，中国军队英勇作战，给日军以沉重打击。最后在国际调停下，双方停火。','十九路军、日本海军陆战队','一二八事变是中国军队首次大规模抗击日本侵略的战斗，打破了日军不可战胜的神话，鼓舞了全国人民的抗日热情。',NULL,NULL,NULL,4,2340,1,1766237149,1766237149),(26,'1933-03-01','长城抗战','battle','河北、热河','1933年3月，日军进攻长城各口。中国军队在喜峰口、古北口等地奋勇抵抗，其中喜峰口战役中，大刀队夜袭日军，取得重大胜利。','第29军、日本关东军','长城抗战是九一八事变后中国军队首次大规模抗日作战，虽然最终失利，但展现了中国军人的英勇气概。',NULL,NULL,NULL,4,1890,1,1766237149,1766237149),(27,'1935-12-09','一二九运动','politics','北京','1935年12月9日，北平学生举行抗日救国示威游行，反对华北自治，要求停止内战、一致抗日。运动得到全国人民的支持和响应。','北平学生、全国民众','一二九运动促进了中华民族的觉醒，推动了抗日民族统一战线的建立，为全面抗战奠定了思想基础。',NULL,NULL,NULL,4,2120,1,1766237149,1766237149),(28,'1936-12-12','西安事变','politics','陕西西安','1936年12月12日，张学良、杨虎城在西安扣留蒋介石，要求停止内战、联共抗日。经过中国共产党的调停，事变和平解决。','张学良、杨虎城、蒋介石、周恩来','西安事变的和平解决，标志着十年内战基本结束，抗日民族统一战线初步形成，为全面抗战奠定了基础。',NULL,NULL,NULL,5,3450,1,1766237149,1766237149),(29,'1937-07-07','七七事变','battle','北京卢沟桥','1937年7月7日夜，日军在卢沟桥附近演习时，借口一名士兵失踪，要求进入宛平城搜查。遭到拒绝后，日军炮轰宛平城和卢沟桥。中国守军奋起抵抗，全面抗战由此爆发。','第29军、日本华北驻屯军','七七事变标志着日本全面侵华战争的开始，也标志着中国全面抗战的开始。中华民族到了最危险的时候。',NULL,NULL,NULL,5,5670,1,1766237149,1766237149),(30,'1937-08-13','淞沪会战爆发','battle','上海','1937年8月13日，日军大举进攻上海。中国军队奋起抵抗，在上海及其周边地区与日军展开激战。战役历时三个月，是抗战初期规模最大的战役。','中国军队、日本上海派遣军','淞沪会战粉碎了日本\"三个月灭亡中国\"的狂妄计划，为中国争取了宝贵的战略准备时间。',NULL,NULL,NULL,5,3890,1,1766237149,1766237149),(31,'1937-09-22','国共第二次合作','politics','全国','1937年9月22日，国民党中央通讯社发表《中国共产党为公布国共合作宣言》。23日，蒋介石发表谈话，承认中国共产党的合法地位。至此，抗日民族统一战线正式形成。','中国共产党、中国国民党','抗日民族统一战线的形成，实现了全民族抗战，为抗战胜利奠定了政治基础。',NULL,NULL,NULL,5,2780,1,1766237149,1766237149),(32,'1937-09-25','平型关大捷','victory','山西灵丘','1937年9月25日，八路军第115师在平型关伏击日军第5师团第21旅团，歼敌1000余人，击毁汽车100余辆。这是全面抗战以来中国军队取得的第一个大胜利。','八路军第115师、日军第5师团','平型关大捷打破了日军不可战胜的神话，极大地鼓舞了全国军民的抗战信心。',NULL,NULL,NULL,5,4230,1,1766237149,1766237149),(33,'1937-12-13','南京大屠杀','massacre','江苏南京','1937年12月13日，日军攻占南京后，对手无寸铁的中国平民和已放下武器的士兵进行了长达6周的大规模屠杀、抢劫、强奸等暴行，遇难者达30万人以上。','侵华日军、南京民众','南京大屠杀是人类历史上最黑暗的一页，是日本军国主义暴行的铁证。这段历史永远不能忘记。',NULL,NULL,NULL,5,6780,1,1766237149,1766237149),(34,'1938-03-16','台儿庄战役开始','battle','山东台儿庄','1938年3月，日军进攻徐州，中国军队在台儿庄与日军激战。经过半个多月的浴血奋战，中国军队取得胜利，歼敌1万余人。','第五战区、日军第10师团','台儿庄大捷是抗战以来正面战场取得的最大胜利，极大地鼓舞了全国军民的抗战士气。',NULL,NULL,NULL,5,3560,1,1766237149,1766237149),(35,'1938-06-11','武汉会战开始','battle','湖北武汉','1938年6月，日军集结35万兵力进攻武汉。中国军队投入110万兵力，在武汉周围与日军展开大规模会战。战役历时4个半月。','中国军队、日军华中派遣军','武汉会战是抗战初期规模最大、时间最长的战役，大量消耗了日军有生力量，为持久抗战奠定了基础。',NULL,NULL,NULL,5,2890,1,1766237149,1766237149),(36,'1940-08-20','百团大战','battle','华北地区','1940年8月20日，八路军在华北地区发动百团大战。参战部队达105个团约40万人，主要目标是破坏日军的交通线，摧毁日伪军据点。','八路军、日军华北方面军','百团大战是抗战期间八路军在华北地区发动的规模最大的战役，沉重打击了日军的\"囚笼政策\"。',NULL,NULL,NULL,5,4120,1,1766237149,1766237149),(37,'1941-12-07','珍珠港事件','battle','美国夏威夷','1941年12月7日，日本偷袭美国珍珠港海军基地，太平洋战争爆发。美国对日宣战，中国抗战成为世界反法西斯战争的重要组成部分。','日本海军、美国太平洋舰队','珍珠港事件标志着太平洋战争爆发，中国抗战从此不再孤军作战，获得了国际支持。',NULL,NULL,NULL,5,3780,1,1766237149,1766237149),(38,'1942-01-01','《联合国家宣言》签署','diplomacy','美国华盛顿','1942年1月1日，中、美、英、苏等26国在华盛顿签署《联合国家宣言》，承诺共同对抗轴心国，不单独媾和。中国成为四大国之一。','中美英苏等26国','《联合国家宣言》的签署，标志着国际反法西斯统一战线正式形成，中国的国际地位大大提高。',NULL,NULL,NULL,4,2340,1,1766237149,1766237149),(39,'1943-11-22','开罗会议','diplomacy','埃及开罗','1943年11月22日至26日，中美英三国首脑在开罗举行会议，讨论对日作战和战后安排。会议发表《开罗宣言》，明确日本必须归还侵占的中国领土。','蒋介石、罗斯福、丘吉尔','开罗会议确认了中国的大国地位，《开罗宣言》为战后收复失地提供了国际法依据。',NULL,NULL,NULL,5,2890,1,1766237149,1766237149),(40,'1945-04-23','中共七大召开','politics','陕西延安','1945年4月23日至6月11日，中国共产党第七次全国代表大会在延安召开。大会确立了毛泽东思想为党的指导思想，为夺取抗战最后胜利和新民主主义革命胜利奠定了基础。','中国共产党','中共七大的召开，为抗战胜利和新中国的建立奠定了思想和组织基础。',NULL,NULL,NULL,5,2560,1,1766237149,1766237149),(41,'1945-08-06','美国向广岛投掷原子弹','battle','日本广岛','1945年8月6日，美国向日本广岛投掷原子弹，造成大量人员伤亡。8月9日，又向长崎投掷第二颗原子弹。','美国、日本','原子弹的使用加速了日本投降的进程，但也造成了巨大的人道主义灾难。',NULL,NULL,NULL,5,3120,1,1766237149,1766237149),(42,'1945-08-08','苏联对日宣战','battle','中国东北','1945年8月8日，苏联对日宣战，出兵中国东北。苏军迅速击溃日本关东军，为中国抗战胜利作出了重要贡献。','苏联红军、日本关东军','苏联出兵东北，加速了日本的投降，为中国抗战的最后胜利创造了条件。',NULL,NULL,NULL,5,2780,1,1766237149,1766237149),(43,'1945-08-15','日本宣布无条件投降','victory','日本东京','1945年8月15日，日本天皇裕仁发表《终战诏书》，宣布接受《波茨坦公告》，无条件投降。中国人民抗日战争取得最后胜利。','日本政府','日本投降标志着中国人民抗日战争的伟大胜利，也标志着世界反法西斯战争的最后胜利。',NULL,NULL,NULL,5,8920,1,1766237149,1766237149),(44,'1945-09-02','日本签署投降书','victory','日本东京湾','1945年9月2日，日本代表在停泊于东京湾的美国战列舰\"密苏里\"号上签署投降书。中国抗日战争暨世界反法西斯战争正式结束。','同盟国、日本','日本签署投降书，标志着第二次世界大战正式结束，中国人民取得了抗日战争的完全胜利。',NULL,NULL,NULL,5,7890,1,1766237149,1766237149),(45,'1945-09-03','中国抗战胜利纪念日','victory','中国','1945年9月3日，中国举国欢庆抗战胜利。2014年，全国人大常委会将9月3日确定为中国人民抗日战争胜利纪念日。','全国人民','9月3日成为中国人民抗日战争胜利纪念日，永远铭记这一伟大胜利。',NULL,NULL,NULL,5,6780,1,1766237149,1766237149),(46,'1945-09-09','中国战区受降仪式','victory','江苏南京','1945年9月9日，中国战区日本投降签字仪式在南京举行。日本中国派遣军总司令冈村宁次向中国陆军总司令何应钦呈交投降书。','何应钦、冈村宁次','中国战区受降仪式标志着中国人民抗日战争取得完全胜利，洗刷了百年国耻。',NULL,NULL,NULL,5,5670,1,1766237149,1766237149);
/*!40000 ALTER TABLE `timeline_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '头像',
  `nickname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '昵称',
  `role` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'user' COMMENT '角色:admin/editor/user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin','abcdefghijklmnopqrstuvwxyz123456','$2y$10$kvdbJXnexSgSqzU1Q.brfOsUbbkyFE.GC3n3a2qfPOrxxSSec5nQK',NULL,'admin@example.com',10,1766238467,1766238467,NULL,NULL,NULL,'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weapon`
--

DROP TABLE IF EXISTS `weapon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weapon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '武器名称',
  `model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '型号',
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '生产国:中国/苏联/美国/德国/日本等',
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类别:rifle步枪/machinegun机枪/artillery火炮/tank坦克/aircraft飞机/ship舰船',
  `caliber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '口径',
  `weight` decimal(10,2) DEFAULT NULL COMMENT '重量(kg)',
  `range` int DEFAULT NULL COMMENT '射程(m)',
  `rate_of_fire` int DEFAULT NULL COMMENT '射速(发/分)',
  `production_year` int DEFAULT NULL COMMENT '生产年份',
  `quantity_used` int DEFAULT NULL COMMENT '使用数量',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '武器描述',
  `technical_specs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '技术参数JSON',
  `famous_battles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '著名战役',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '武器图片',
  `blueprint` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '设计图纸',
  `views` int DEFAULT '0',
  `status` tinyint DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-weapon-category` (`category`),
  KEY `idx-weapon-country` (`country`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weapon`
--

LOCK TABLES `weapon` WRITE;
/*!40000 ALTER TABLE `weapon` DISABLE KEYS */;
INSERT INTO `weapon` VALUES (13,'中正式步枪','中正式','中国','rifle','7.92mm',4.08,800,15,1935,600000,'中正式步枪是中国抗战时期使用最广泛的步枪，由德国毛瑟98式步枪改进而来。该枪性能可靠，射击精度高，是中国军队的主力武器之一。',NULL,'淞沪会战、台儿庄战役、武汉会战等',NULL,NULL,2340,1,1766237149,1766237149),(14,'汉阳造步枪','汉阳88式','中国','rifle','7.92mm',4.30,600,10,1896,1000000,'汉阳造是中国自制的第一种步枪，仿制自德国1888式步枪。虽然性能较老旧，但在抗战中仍大量使用，是中国军队的重要武器。',NULL,'平型关战役、百团大战',NULL,NULL,1890,1,1766237149,1766237149),(15,'捷克式轻机枪','ZB26','捷克斯洛伐克','machinegun','7.92mm',9.60,1000,500,1926,30000,'捷克式轻机枪是抗战时期中国军队装备最好的轻机枪之一。该枪火力强大，性能可靠，深受中国士兵喜爱，被称为\"捷克造\"。',NULL,'淞沪会战、台儿庄战役、长沙会战',NULL,NULL,2120,1,1766237149,1766237149),(16,'马克沁重机枪','M1908','德国/中国','machinegun','7.92mm',60.00,2000,600,1908,5000,'马克沁重机枪是世界上第一种真正成功的自动机枪。中国在抗战中使用了大量马克沁重机枪，在阵地防御战中发挥了重要作用。',NULL,'淞沪会战、四行仓库保卫战',NULL,NULL,1780,1,1766237149,1766237149),(17,'三八式步枪','三八式','日本','rifle','6.5mm',3.95,460,15,1905,3400000,'三八式步枪是日军在抗战中使用的主力步枪。该枪射击精度高，但威力较小。中国军队缴获后也大量使用。',NULL,'所有抗日战役',NULL,NULL,2560,1,1766237149,1766237149),(18,'歪把子机枪','大正11年式','日本','machinegun','6.5mm',10.20,600,500,1922,29000,'歪把子机枪是日军的制式轻机枪，因弹匣位置偏左而得名。该枪结构复杂，但火力较强，是日军的重要支援武器。',NULL,'所有抗日战役',NULL,NULL,1920,1,1766237149,1766237149),(19,'九二式重机枪','九二式','日本','machinegun','7.7mm',55.30,800,450,1932,45000,'九二式重机枪是日军的主力重机枪，火力强大，常用于阵地防御。中国军队缴获后也使用这种武器。',NULL,'所有抗日战役',NULL,NULL,1670,1,1766237149,1766237149),(20,'汤姆森冲锋枪','M1928A1','美国','rifle','.45 ACP',4.88,150,700,1928,10000,'汤姆森冲锋枪是二战中著名的冲锋枪，通过租借法案提供给中国。该枪火力猛烈，在近战中威力巨大，深受中国士兵喜爱。',NULL,'缅甸战役、滇西反攻',NULL,NULL,2230,1,1766237149,1766237149),(21,'勃朗宁M1917重机枪','M1917','美国','machinegun','.30-06',47.00,1500,600,1917,3000,'勃朗宁M1917重机枪是美国援助中国的重要武器之一。该枪性能优良，火力强大，在抗战后期发挥了重要作用。',NULL,'滇西反攻、湘西会战',NULL,NULL,1560,1,1766237149,1766237149),(22,'莫辛-纳甘步枪','M1891/30','苏联','rifle','7.62mm',4.00,800,10,1930,50000,'莫辛-纳甘步枪是苏联援助中国的主要步枪。该枪结构简单，坚固耐用，在东北抗日联军中大量使用。',NULL,'东北抗日游击战',NULL,NULL,1340,1,1766237149,1766237149),(23,'德普轻机枪','DP-27','苏联','machinegun','7.62mm',9.12,800,550,1927,8000,'德普轻机枪是苏联援助中国的轻机枪，因弹盘形状被称为\"转盘机枪\"。该枪火力强大，在抗战中发挥了重要作用。',NULL,'东北抗日游击战、百团大战',NULL,NULL,1450,1,1766237149,1766237149),(24,'M3式37毫米战防炮','M3','美国','artillery','37mm',414.00,3700,25,1940,1000,'M3式37毫米战防炮是美国援助中国的反坦克炮。虽然威力有限，但在对付日军轻型坦克时仍有一定效果。',NULL,'滇西反攻、湘西会战',NULL,NULL,1120,1,1766237149,1766237149);
/*!40000 ALTER TABLE `weapon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'Webbase'
--

--
-- Dumping routines for database 'Webbase'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-21 19:51:26
