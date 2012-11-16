-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 11 月 16 日 01:41
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dcd`
--

-- --------------------------------------------------------

--
-- 表的结构 `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `privilege` int(11) DEFAULT NULL COMMENT '表明管理员权限',
  `username` varchar(16) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `name` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `addr` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `createtime` int(11) NOT NULL,
  `lastlogintime` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `administrator`
--

INSERT INTO `administrator` (`uid`, `privilege`, `username`, `password`, `name`, `tel`, `email`, `addr`, `createtime`, `lastlogintime`) VALUES
(1, 1, 'root', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'jdp@zju.edu.cn', NULL, 1352975885, 1353027595);

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_bin NOT NULL,
  `content` varchar(10240) COLLATE utf8_bin NOT NULL,
  `publisher` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'publisher name',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='信息表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `publisher`, `date`) VALUES
(4, '[重要]关于周二晚上硕士生工作汇报的通知', '<pre style="line-height: 23px; word-wrap: break-word; white-space: pre-wrap; font-size: 14px">\r\n大家好，\r\n\r\n本周二晚上6:30，曹光标主楼201，实验室硕士工作例会，本次例会的一个主要议题是讨论数据表的具体设计方案。\r\n\r\n针对我们目前正在搭建的演示系统，迫切需要确立统一完整存取方案，使得：\r\n\r\n1.	我们已经或将要爬取的数据可以以统一的格式存放，以便我们建立稳定、实时的数据抓取加工平台。\r\n2.	正在开发完善的上层应用系统（以图搜图、主题可视化、问答系统），可以基于此存储方案提供的接口，来获取数据，以此加快开发进度，减少重复劳动。\r\n\r\n基于此，当前的一个重要任务是确定存储系统中数据表的具体设计方案，附件（邵建老师提供）中是\r\n&ldquo;跨媒体计算验证系统&rdquo;中定义的数据表格式，可用于对跨媒体数据的统一存储。\r\n\r\n但是对于我们目前需要开发的上层应用系统（以图搜图、主题可视化、问答系统）而言，还需要定义很多中间层的数据表（比如，问答系统中的知识如何存储？主题建模中的各要素、事件、主题、摘要如何存储？等等）\r\n\r\n请各位参与系统开发的硕士，以及正在从事相关研究的博士（刘洋、高海东等），思考一下附件中的数据表格式是否合理，是否需要添加新的内容，针对你们目前从事的开发和研究，需要什么样的中间数据，应该如何存储？\r\n\r\n请汇报的硕士将这些问题列在汇报工作之后，作为汇报的一部分。\r\n&nbsp;</pre>\r\n<p><span style="line-height: 23px; white-space: pre-wrap; font-size: 14px">斯亮</span>&nbsp;</p>\r\n<p><img alt="" width="240" height="120" src="/dcd/Attachments/FCKeditor/201211/20121106_101711_191.png" /></p>', 'root', 1352975885),
(5, '今天又修改了一点代码', '<p>&nbsp;今天又修改了一点代码</p>\r\n<p>&nbsp;</p>\r\n<p>庆祝一下吧</p>\r\n<p>哈哈</p>', 'root', 1352992650);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




--
-- 数据库: `dcd`
--

-- --------------------------------------------------------

--
-- 表的结构 `student` 这是学生表
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) COLLATE utf8_bin NOT NULL COMMENT '学号，现在是8位，不知会不会变，预留10位',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `gender` varchar(1) COLLATE utf8_bin COMMENT '性别',
  `labaddr` varchar(50) COMMENT '实验室地址',
  `birthday` int(11) COMMENT '出生日期',
  `politicsstatus` varchar(10) COLLATE utf8_bin   COMMENT '政治面貌',
  `nativeplace` varchar(20) COLLATE utf8_bin   COMMENT '生源地',
  `birth_place` varchar(20) COLLATE utf8_bin   COMMENT '出生地',
  `teacher` int(11) COLLATE utf8_bin NOT NULL COMMENT '导师id',
  `category` varchar(8) COLLATE utf8_bin NOT NULL COMMENT '类别：博，硕...',
  `entrancedate` int(11)   COMMENT '入学日期',
  `phonenum` varchar(20) COLLATE utf8_bin   COMMENT '电话',
  `idcardno` varchar(20) COLLATE utf8_bin   COMMENT '身份证号',
  `address` varchar(50) COLLATE utf8_bin   COMMENT '住址',
  `email` varchar(50) COLLATE utf8_bin   COMMENT 'email',
  `hobby` varchar(50) COLLATE utf8_bin   COMMENT '特长爱好',
  `introduction` varchar(1000) COLLATE utf8_bin   COMMENT '个人简介',
  `postgraduateschool` varchar(100) COLLATE utf8_bin   COMMENT '研究生院校',
  `postgraduatefaculty` varchar(100) COLLATE utf8_bin   COMMENT '研究生院系',
  `postgraduatemajor` varchar(100) COLLATE utf8_bin   COMMENT '研究生专业',
  `postgraduatedegree` varchar(10) COLLATE utf8_bin   COMMENT '研究生阶段获得学位',
  `postgraduateend` int(11)   COMMENT '研究生毕业日期',
  `collegeschool` varchar(100) COLLATE utf8_bin   COMMENT '本科院校',
  `collegefaculty` varchar(100) COLLATE utf8_bin   COMMENT '本科院系',
  `collegemajor` varchar(100) COLLATE utf8_bin   COMMENT '本科专业',
  `collegedegree` varchar(10) COLLATE utf8_bin   COMMENT '本科阶段获得学位',
  `collegeend` int(11)   COMMENT '本科毕业日期',
  `seniorschool` varchar(100) COLLATE utf8_bin   COMMENT '高中学校',
  `seniorstart` int(11)   COMMENT '高中入学时间',
  `seniorend` int(11)   COMMENT '高中毕业时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';