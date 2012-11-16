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
  `username` varchar(16) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'md5加密后的密码',
  `name` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '姓名',
  `tel` varchar(16) COLLATE utf8_bin DEFAULT NULL COMMENT '电话号',
  `email` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'email',
  `addr` varchar(256) COLLATE utf8_bin DEFAULT NULL COMMENT '地址',
  `createtime` int(11) NOT NULL COMMENT '账号创建时间',
  `lastlogintime` int(11) DEFAULT NULL COMMENT '上次登录时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 COMMENT='网站管理员账号表' ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '信息ID',
  `type` int(11) NOT NULL COMMENT '信息类型ID',
  `title` varchar(256) COLLATE utf8_bin NOT NULL COMMENT '信息标题',
  `content` varchar(10240) COLLATE utf8_bin NOT NULL COMMENT '信息内容',
  `publisher` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'publisher name',
  `date` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='通知信息表' AUTO_INCREMENT=1 ;


--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `publisher`, `date`) VALUES
(4, '[重要]关于周二晚上硕士生工作汇报的通知', '<pre style="line-height: 23px; word-wrap: break-word; white-space: pre-wrap; font-size: 14px">\r\n大家好，\r\n\r\n本周二晚上6:30，曹光标主楼201，实验室硕士工作例会，本次例会的一个主要议题是讨论数据表的具体设计方案。\r\n\r\n针对我们目前正在搭建的演示系统，迫切需要确立统一完整存取方案，使得：\r\n\r\n1.	我们已经或将要爬取的数据可以以统一的格式存放，以便我们建立稳定、实时的数据抓取加工平台。\r\n2.	正在开发完善的上层应用系统（以图搜图、主题可视化、问答系统），可以基于此存储方案提供的接口，来获取数据，以此加快开发进度，减少重复劳动。\r\n\r\n基于此，当前的一个重要任务是确定存储系统中数据表的具体设计方案，附件（邵建老师提供）中是\r\n&ldquo;跨媒体计算验证系统&rdquo;中定义的数据表格式，可用于对跨媒体数据的统一存储。\r\n\r\n但是对于我们目前需要开发的上层应用系统（以图搜图、主题可视化、问答系统）而言，还需要定义很多中间层的数据表（比如，问答系统中的知识如何存储？主题建模中的各要素、事件、主题、摘要如何存储？等等）\r\n\r\n请各位参与系统开发的硕士，以及正在从事相关研究的博士（刘洋、高海东等），思考一下附件中的数据表格式是否合理，是否需要添加新的内容，针对你们目前从事的开发和研究，需要什么样的中间数据，应该如何存储？\r\n\r\n请汇报的硕士将这些问题列在汇报工作之后，作为汇报的一部分。\r\n&nbsp;</pre>\r\n<p><span style="line-height: 23px; white-space: pre-wrap; font-size: 14px">斯亮</span>&nbsp;</p>\r\n<p><img alt="" width="240" height="120" src="/dcd/Attachments/FCKeditor/201211/20121106_101711_191.png" /></p>', 'root', 1352975885),
(5, '今天又修改了一点代码', '<p>&nbsp;今天又修改了一点代码</p>\r\n<p>&nbsp;</p>\r\n<p>庆祝一下吧</p>\r\n<p>哈哈</p>', 'root', 1352992650);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `newstype`
--

CREATE TABLE IF NOT EXISTS `newstype` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `typeid` int(11) NOT NULL COMMENT '信息类型ID',
  `typename` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '信息类型名',
  `note` varchar(1024) COLLATE utf8_bin COMMENT '信息备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='通知类型表' AUTO_INCREMENT=1 ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `innerreport`
--

CREATE TABLE IF NOT EXISTS `innerreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '内部报告类型',
  `introduction` varchar(500) COLLATE utf8_bin NOT NULL COMMENT '内容简介',
  `date` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '报告会日期',
  `speaker` varchar(255) COLLATE utf8_bin COMMENT '主讲人列表，以;分割',
  `audience` varchar(255) COLLATE utf8_bin COMMENT '参会人员列表，以;分割',
  `attachment` varchar(255) COLLATE utf8_bin COMMENT '报告会资料附件路径',
  `note` varchar(255) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='内部学术报告会表' AUTO_INCREMENT=1 ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL COMMENT '工号',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `photo` varchar(100) COLLATE utf8_bin COMMENT '照片地址',
  `gender` varchar(1) COLLATE utf8_bin NOT NULL COMMENT '性别',
  `position` varchar(8) COLLATE utf8_bin NOT NULL COMMENT '职称',
  `birthday` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '生日',
  `politicsstatus` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '政治面貌',
  `birthplace` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '出生地',
  `politicsposition` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '行政职务',
  `ismarried` tinyint(1) DEFAULT NULL COMMENT '婚否',
  `researchdir` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '研究方向',
  `degree` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '最高学位',
  `degreedate` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '获得最高学位年份',
  `academichonour` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '学术称号',
  `phonenum` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '联系方式',
  `idcardno` varchar(20) COLLATE utf8_bin   COMMENT '身份证号',
  `address` varchar(50) COLLATE utf8_bin   COMMENT '住址',
  `email` varchar(100) COLLATE utf8_bin   COMMENT 'email，可输入多个，用;分割',
  `postgraduateschool` varchar(100) COLLATE utf8_bin   COMMENT '研究生院校',
  `postgraduatefaculty` varchar(100) COLLATE utf8_bin   COMMENT '研究生院系',
  `postgraduatemajor` varchar(100) COLLATE utf8_bin   COMMENT '研究生专业',
  `postgraduatedegree` varchar(10) COLLATE utf8_bin   COMMENT '研究生阶段获得学位',
  `postgraduateend` varchar(20)   COMMENT '研究生毕业日期',
  `collegeschool` varchar(100) COLLATE utf8_bin   COMMENT '本科院校',
  `collegefaculty` varchar(100) COLLATE utf8_bin   COMMENT '本科院系',
  `collegemajor` varchar(100) COLLATE utf8_bin   COMMENT '本科专业',
  `collegedegree` varchar(10) COLLATE utf8_bin   COMMENT '本科阶段获得学位',
  `collegeend` varchar(20)   COMMENT '本科毕业日期',
  `introduction` varchar(1000) COLLATE utf8_bin DEFAULT NULL COMMENT '个人简介',
  `academicparticipation` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '学术任职',
  `reachergroup` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '所属课题组，可多选，用;分割',
  `lab` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '所在实验室，可多选，用;分割',  
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL COMMENT '工号',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `photo` varchar(100) COLLATE utf8_bin COMMENT '照片地址',
  `gender` varchar(1) COLLATE utf8_bin NOT NULL COMMENT '性别',
  `position` varchar(8) COLLATE utf8_bin NOT NULL COMMENT '职称',
  `birthday` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '生日',
  `politicsstatus` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '政治面貌',
  `birthplace` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '出生地',
  `politicsposition` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '行政职务',
  `ismarried` tinyint(1) DEFAULT NULL COMMENT '婚否',
  `phonenum` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '办公室电话',
  `idcardno` varchar(20) COLLATE utf8_bin   COMMENT '身份证号',
  `cellphone` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '手机号',
  `address` varchar(50) COLLATE utf8_bin   COMMENT '住址',
  `email` varchar(100) COLLATE utf8_bin   COMMENT 'email，可输入多个，用;分割',
  `lab` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '所在实验室，可多选，用;分割', 
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='实验室管理人员表(非网站管理人员)';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) COLLATE utf8_bin NOT NULL COMMENT '学号',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `photo` varchar(100) COLLATE utf8_bin COMMENT '照片地址',
  `gender` varchar(1) COLLATE utf8_bin COMMENT '性别',
  `labaddr` varchar(50) COMMENT '实验室地址',
  `birthday` varchar(20) COLLATE utf8_bin COMMENT '出生日期',
  `politicsstatus` varchar(10) COLLATE utf8_bin   COMMENT '政治面貌',
  `nativeplace` varchar(20) COLLATE utf8_bin   COMMENT '生源地',
  `birth_place` varchar(20) COLLATE utf8_bin   COMMENT '出生地',
  `teacher` int(11) COLLATE utf8_bin NOT NULL COMMENT '导师id',
  `category` varchar(8) COLLATE utf8_bin NOT NULL COMMENT '类别：博，硕...',
  `entrancedate` varchar(20) COLLATE utf8_bin   COMMENT '入学日期',
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
  `postgraduateend` varchar(20) COLLATE utf8_bin  COMMENT '研究生毕业日期',
  `collegeschool` varchar(100) COLLATE utf8_bin   COMMENT '本科院校',
  `collegefaculty` varchar(100) COLLATE utf8_bin   COMMENT '本科院系',
  `collegemajor` varchar(100) COLLATE utf8_bin   COMMENT '本科专业',
  `collegedegree` varchar(10) COLLATE utf8_bin   COMMENT '本科阶段获得学位',
  `collegeend` varchar(20) COLLATE utf8_bin  COMMENT '本科毕业日期',
  `seniorschool` varchar(100) COLLATE utf8_bin   COMMENT '高中学校',
  `seniorstart` varchar(20) COLLATE utf8_bin   COMMENT '高中入学日期',
  `seniorend` varchar(20) COLLATE utf8_bin   COMMENT '高中毕业日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- 表的结构 `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录ID，自动递增',
  `personid` int(11) NOT NULL COMMENT '人员ID',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `category` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '类别',
  `note` varchar(255) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='人员总表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL COMMENT '项目ID',
  `submittime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '提交时间',
  `typeid` int(11) NOT NULL COMMENT '项目类别ID',
  `number` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '主管部门给的项目编号',
  `principalid` int(11) NOT NULL COMMENT '负责人ID',
  `principalname` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '负责人姓名',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '项目标题',
  `introduction` varchar(500) COLLATE utf8_bin COMMENT '项目简介',
  `unit` varchar(500) COLLATE utf8_bin COMMENT '参与单位，用;分隔',
  `starttime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '开始时间',
  `endtime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '终止时间',
  `ispublic` tinyint(1) COMMENT '是否公开',
  `subsidizelimit` int(11) COMMENT '项目资助额度',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='科研项目信息表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `projecttype`
--

CREATE TABLE IF NOT EXISTS `projecttype` (
  `id` int(11) NOT NULL COMMENT '项目ID',
  `typename` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '项目类别名称',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='科研项目类别表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `journalpaper`
--

CREATE TABLE IF NOT EXISTS `journalpaper` (
  `id` int(11) NOT NULL COMMENT '论文ID',
  `time` int(11) NOT NULL COMMENT '录入系统的时间',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '论文标题',
  `abstract` varchar(1000) COLLATE utf8_bin NOT NULL COMMENT '论文摘要',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '代表图片1的路径',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '代表图片2的路径',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '代表图片3的路径',
  `journalname` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '期刊名称',
  `publishdate` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '发表日期',
  `volumenum` int(11) NOT NULL COMMENT '卷号',
  `issuenum` int(11) NOT NULL COMMENT '期号',
  `pagenum` int(11) NOT NULL COMMENT '页码',
  `SCI` tinyint(1) NOT NULL COMMENT 'SCI收录',
  `EI` tinyint(1) NOT NULL COMMENT 'EI收录',
  `ISTP` tinyint(1) NOT NULL COMMENT 'ISTP收录',
  `IF` double NOT NULL COMMENT '影响因子',
  `sponsor` varchar(200) COLLATE utf8_bin COMMENT '资助者列表，用;隔开',
  `official` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '正式版（pdf）路径',
  `draft` varchar(100) COLLATE utf8_bin COMMENT '草稿（word）路径',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='期刊论文表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- --------------------------------------------------------

--
-- 表的结构 `conferencepaper`
--

CREATE TABLE IF NOT EXISTS `conferencepaper` (
  `id` int(11) NOT NULL COMMENT '论文ID',
  `time` int(11) NOT NULL COMMENT '录入系统的时间',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '论文标题',
  `abstract` varchar(1000) COLLATE utf8_bin NOT NULL COMMENT '论文摘要',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '代表图片1的路径',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '代表图片2的路径',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '代表图片3的路径',
  `conferencename` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '会议名称',
  `publishdate` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '发表日期',
  `pagenum` int(11) NOT NULL COMMENT '页码',
  `SCI` tinyint(1) NOT NULL COMMENT 'SCI收录',
  `EI` tinyint(1) NOT NULL COMMENT 'EI收录',
  `ISTP` tinyint(1) NOT NULL COMMENT 'ISTP收录',
  `sponsor` varchar(200) COLLATE utf8_bin COMMENT '资助者列表，用;隔开',
  `official` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '正式版（pdf）路径',
  `draft` varchar(100) COLLATE utf8_bin COMMENT '草稿（word）路径',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='会议论文表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `patent`
--

CREATE TABLE IF NOT EXISTS `dcd_patent` (
  `id` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '专利ID',
  `time` int(11) NOT NULL COMMENT '录入系统时间',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '专利标题',
  `abstract` varchar(1000) COLLATE utf8_bin COMMENT '专利摘要',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '代表图片1的路径',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '代表图片2的路径',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '代表图片3的路径',
  `application` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '申请书文件地址',
  `status` varchar(1) COLLATE utf8_bin NOT NULL COMMENT '当前状态',
  `acceptnum` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '专利受理号',
  `acceptdate` varchar(20) COLLATE utf8_bin COMMENT '受理日期',
  `notice` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '受理通知书地址',
  `authorizationnum` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '授权号',
  `authorizationdate` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '授权日期',
  `authorizationcertificate` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '授权证书地址',
  `subsidize` varchar(100) COLLATE utf8_bin COMMENT '资助者列表，以;分割',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专利表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `softwareright`
--

CREATE TABLE IF NOT EXISTS `softwareright` (
  `id` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'ID',
  `submittime` int(11) NOT NULL COMMENT '录入系统时间',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '著作权标题',
  `abstract` varchar(500) COLLATE utf8_bin COMMENT '摘要',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '代表图片1',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '代表图片2',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '代表图片3',
  `regform` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '著作权登记表地址',
  `introduction` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '说明书地址',
  `code` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '源代码文档',
  `authorizationnum` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '授权号',
  `authorizationdate` varchar(20) NOT NULL COMMENT '授权日期',
  `authorizationcertificate` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '授权证书',
  `sponser` varchar(100) COLLATE utf8_bin COMMENT '项目资助者列表',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='软件著作权表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- 表的结构 `techreport`
--

CREATE TABLE IF NOT EXISTS `techreport` (
  `id` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'ID',
  `submittime` varchar(20) NOT NULL COMMENT '录入系统日期',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '著作权标题',
  `abstract` varchar(500) COLLATE utf8_bin COMMENT '摘要',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '代表图片1',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '代表图片2',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '代表图片3',
  `attachment` varchar(100) COLLATE utf8_bin COMMENT '附件',
  `sponser` varchar(100) COLLATE utf8_bin COMMENT '项目资助者列表',
  `public` tinyint(1) NOT NULL COMMENT '公开性质',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='技术报告表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `thesis`
--

CREATE TABLE IF NOT EXISTS `thesis` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `submitdate` varchar(20) NOT NULL COMMENT '提交时间',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '论文标题',
  `abstract` varchar(1000) COLLATE utf8_bin COMMENT '论文摘要',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '代表图片1的路径',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '代表图片2的路径',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '代表图片3的路径',
  `sponsor` varchar(200) COLLATE utf8_bin COMMENT '资助者列表，用;隔开',
  `official` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '正式版（pdf）路径',
  `draft` varchar(100) COLLATE utf8_bin COMMENT '草稿（word）路径',
  `note` varchar(500) COLLATE utf8_bin COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='毕业论文表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- 表的结构 `achieve`
--

CREATE TABLE IF NOT EXISTS `achieve` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
  `personid` int(11) NOT NULL  COMMENT '人员ID' ,
  `persontype` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '人员类型' ,
  `achievementid` int(11) NOT NULL  COMMENT '科研成果ID' ,
  `achievementtype` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '成果类型' ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='人员科研成果对应表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;