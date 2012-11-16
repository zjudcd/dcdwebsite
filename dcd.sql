-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- ����: localhost
-- ��������: 2012 �� 11 �� 16 �� 01:41
-- �������汾: 5.5.16
-- PHP �汾: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- ���ݿ�: `dcd`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `privilege` int(11) DEFAULT NULL COMMENT '��������ԱȨ��',
  `username` varchar(16) COLLATE utf8_bin NOT NULL COMMENT '�û���',
  `password` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'md5���ܺ������',
  `name` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '����',
  `tel` varchar(16) COLLATE utf8_bin DEFAULT NULL COMMENT '�绰��',
  `email` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'email',
  `addr` varchar(256) COLLATE utf8_bin DEFAULT NULL COMMENT '��ַ',
  `createtime` int(11) NOT NULL COMMENT '�˺Ŵ���ʱ��',
  `lastlogintime` int(11) DEFAULT NULL COMMENT '�ϴε�¼ʱ��',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 COMMENT='��վ����Ա�˺ű�' ;

--
-- ת����е����� `administrator`
--

INSERT INTO `administrator` (`uid`, `privilege`, `username`, `password`, `name`, `tel`, `email`, `addr`, `createtime`, `lastlogintime`) VALUES
(1, 1, 'root', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'jdp@zju.edu.cn', NULL, 1352975885, 1353027595);

-- --------------------------------------------------------

--
-- ��Ľṹ `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '��ϢID',
  `type` int(11) NOT NULL COMMENT '��Ϣ����ID',
  `title` varchar(256) COLLATE utf8_bin NOT NULL COMMENT '��Ϣ����',
  `content` varchar(10240) COLLATE utf8_bin NOT NULL COMMENT '��Ϣ����',
  `publisher` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'publisher name',
  `date` int(11) NOT NULL COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='֪ͨ��Ϣ��' AUTO_INCREMENT=1 ;


--
-- ת����е����� `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `publisher`, `date`) VALUES
(4, '[��Ҫ]�����ܶ�����˶ʿ�������㱨��֪ͨ', '<pre style="line-height: 23px; word-wrap: break-word; white-space: pre-wrap; font-size: 14px">\r\n��Һã�\r\n\r\n���ܶ�����6:30���ܹ����¥201��ʵ����˶ʿ�������ᣬ���������һ����Ҫ�������������ݱ�ľ�����Ʒ�����\r\n\r\n�������Ŀǰ���ڴ����ʾϵͳ��������Ҫȷ��ͳһ������ȡ������ʹ�ã�\r\n\r\n1.	�����Ѿ���Ҫ��ȡ�����ݿ�����ͳһ�ĸ�ʽ��ţ��Ա����ǽ����ȶ���ʵʱ������ץȡ�ӹ�ƽ̨��\r\n2.	���ڿ������Ƶ��ϲ�Ӧ��ϵͳ����ͼ��ͼ��������ӻ����ʴ�ϵͳ�������Ի��ڴ˴洢�����ṩ�Ľӿڣ�����ȡ���ݣ��Դ˼ӿ쿪�����ȣ������ظ��Ͷ���\r\n\r\n���ڴˣ���ǰ��һ����Ҫ������ȷ���洢ϵͳ�����ݱ�ľ�����Ʒ������������۽���ʦ�ṩ������\r\n&ldquo;��ý�������֤ϵͳ&rdquo;�ж�������ݱ��ʽ�������ڶԿ�ý�����ݵ�ͳһ�洢��\r\n\r\n���Ƕ�������Ŀǰ��Ҫ�������ϲ�Ӧ��ϵͳ����ͼ��ͼ��������ӻ����ʴ�ϵͳ�����ԣ�����Ҫ����ܶ��м������ݱ����磬�ʴ�ϵͳ�е�֪ʶ��δ洢�����⽨ģ�еĸ�Ҫ�ء��¼������⡢ժҪ��δ洢���ȵȣ�\r\n\r\n���λ����ϵͳ������˶ʿ���Լ����ڴ�������о��Ĳ�ʿ�����󡢸ߺ����ȣ���˼��һ�¸����е����ݱ��ʽ�Ƿ�����Ƿ���Ҫ����µ����ݣ��������Ŀǰ���µĿ������о�����Ҫʲô�����м����ݣ�Ӧ����δ洢��\r\n\r\n��㱨��˶ʿ����Щ�������ڻ㱨����֮����Ϊ�㱨��һ���֡�\r\n&nbsp;</pre>\r\n<p><span style="line-height: 23px; white-space: pre-wrap; font-size: 14px">˹��</span>&nbsp;</p>\r\n<p><img alt="" width="240" height="120" src="/dcd/Attachments/FCKeditor/201211/20121106_101711_191.png" /></p>', 'root', 1352975885),
(5, '�������޸���һ�����', '<p>&nbsp;�������޸���һ�����</p>\r\n<p>&nbsp;</p>\r\n<p>��ףһ�°�</p>\r\n<p>����</p>', 'root', 1352992650);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `newstype`
--

CREATE TABLE IF NOT EXISTS `newstype` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `typeid` int(11) NOT NULL COMMENT '��Ϣ����ID',
  `typename` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��Ϣ������',
  `note` varchar(1024) COLLATE utf8_bin COMMENT '��Ϣ��ע',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='֪ͨ���ͱ�' AUTO_INCREMENT=1 ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `innerreport`
--

CREATE TABLE IF NOT EXISTS `innerreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '�ڲ���������',
  `introduction` varchar(500) COLLATE utf8_bin NOT NULL COMMENT '���ݼ��',
  `date` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '���������',
  `speaker` varchar(255) COLLATE utf8_bin COMMENT '�������б���;�ָ�',
  `audience` varchar(255) COLLATE utf8_bin COMMENT '�λ���Ա�б���;�ָ�',
  `attachment` varchar(255) COLLATE utf8_bin COMMENT '��������ϸ���·��',
  `note` varchar(255) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='�ڲ�ѧ��������' AUTO_INCREMENT=1 ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- --------------------------------------------------------

--
-- ��Ľṹ `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL COMMENT '����',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '����',
  `photo` varchar(100) COLLATE utf8_bin COMMENT '��Ƭ��ַ',
  `gender` varchar(1) COLLATE utf8_bin NOT NULL COMMENT '�Ա�',
  `position` varchar(8) COLLATE utf8_bin NOT NULL COMMENT 'ְ��',
  `birthday` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '����',
  `politicsstatus` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '������ò',
  `birthplace` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '������',
  `politicsposition` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '����ְ��',
  `ismarried` tinyint(1) DEFAULT NULL COMMENT '���',
  `researchdir` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '�о�����',
  `degree` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '���ѧλ',
  `degreedate` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '������ѧλ���',
  `academichonour` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'ѧ���ƺ�',
  `phonenum` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '��ϵ��ʽ',
  `idcardno` varchar(20) COLLATE utf8_bin   COMMENT '���֤��',
  `address` varchar(50) COLLATE utf8_bin   COMMENT 'סַ',
  `email` varchar(100) COLLATE utf8_bin   COMMENT 'email��������������;�ָ�',
  `postgraduateschool` varchar(100) COLLATE utf8_bin   COMMENT '�о���ԺУ',
  `postgraduatefaculty` varchar(100) COLLATE utf8_bin   COMMENT '�о���Ժϵ',
  `postgraduatemajor` varchar(100) COLLATE utf8_bin   COMMENT '�о���רҵ',
  `postgraduatedegree` varchar(10) COLLATE utf8_bin   COMMENT '�о����׶λ��ѧλ',
  `postgraduateend` varchar(20)   COMMENT '�о�����ҵ����',
  `collegeschool` varchar(100) COLLATE utf8_bin   COMMENT '����ԺУ',
  `collegefaculty` varchar(100) COLLATE utf8_bin   COMMENT '����Ժϵ',
  `collegemajor` varchar(100) COLLATE utf8_bin   COMMENT '����רҵ',
  `collegedegree` varchar(10) COLLATE utf8_bin   COMMENT '���ƽ׶λ��ѧλ',
  `collegeend` varchar(20)   COMMENT '���Ʊ�ҵ����',
  `introduction` varchar(1000) COLLATE utf8_bin DEFAULT NULL COMMENT '���˼��',
  `academicparticipation` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'ѧ����ְ',
  `reachergroup` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '���������飬�ɶ�ѡ����;�ָ�',
  `lab` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '����ʵ���ң��ɶ�ѡ����;�ָ�',  
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='��ʦ��';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL COMMENT '����',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '����',
  `photo` varchar(100) COLLATE utf8_bin COMMENT '��Ƭ��ַ',
  `gender` varchar(1) COLLATE utf8_bin NOT NULL COMMENT '�Ա�',
  `position` varchar(8) COLLATE utf8_bin NOT NULL COMMENT 'ְ��',
  `birthday` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '����',
  `politicsstatus` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '������ò',
  `birthplace` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '������',
  `politicsposition` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '����ְ��',
  `ismarried` tinyint(1) DEFAULT NULL COMMENT '���',
  `phonenum` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '�칫�ҵ绰',
  `idcardno` varchar(20) COLLATE utf8_bin   COMMENT '���֤��',
  `cellphone` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '�ֻ���',
  `address` varchar(50) COLLATE utf8_bin   COMMENT 'סַ',
  `email` varchar(100) COLLATE utf8_bin   COMMENT 'email��������������;�ָ�',
  `lab` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '����ʵ���ң��ɶ�ѡ����;�ָ�', 
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='ʵ���ҹ�����Ա��(����վ������Ա)';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- ��Ľṹ `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) COLLATE utf8_bin NOT NULL COMMENT 'ѧ��',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '����',
  `photo` varchar(100) COLLATE utf8_bin COMMENT '��Ƭ��ַ',
  `gender` varchar(1) COLLATE utf8_bin COMMENT '�Ա�',
  `labaddr` varchar(50) COMMENT 'ʵ���ҵ�ַ',
  `birthday` varchar(20) COLLATE utf8_bin COMMENT '��������',
  `politicsstatus` varchar(10) COLLATE utf8_bin   COMMENT '������ò',
  `nativeplace` varchar(20) COLLATE utf8_bin   COMMENT '��Դ��',
  `birth_place` varchar(20) COLLATE utf8_bin   COMMENT '������',
  `teacher` int(11) COLLATE utf8_bin NOT NULL COMMENT '��ʦid',
  `category` varchar(8) COLLATE utf8_bin NOT NULL COMMENT '��𣺲���˶...',
  `entrancedate` varchar(20) COLLATE utf8_bin   COMMENT '��ѧ����',
  `phonenum` varchar(20) COLLATE utf8_bin   COMMENT '�绰',
  `idcardno` varchar(20) COLLATE utf8_bin   COMMENT '���֤��',
  `address` varchar(50) COLLATE utf8_bin   COMMENT 'סַ',
  `email` varchar(50) COLLATE utf8_bin   COMMENT 'email',
  `hobby` varchar(50) COLLATE utf8_bin   COMMENT '�س�����',
  `introduction` varchar(1000) COLLATE utf8_bin   COMMENT '���˼��',
  `postgraduateschool` varchar(100) COLLATE utf8_bin   COMMENT '�о���ԺУ',
  `postgraduatefaculty` varchar(100) COLLATE utf8_bin   COMMENT '�о���Ժϵ',
  `postgraduatemajor` varchar(100) COLLATE utf8_bin   COMMENT '�о���רҵ',
  `postgraduatedegree` varchar(10) COLLATE utf8_bin   COMMENT '�о����׶λ��ѧλ',
  `postgraduateend` varchar(20) COLLATE utf8_bin  COMMENT '�о�����ҵ����',
  `collegeschool` varchar(100) COLLATE utf8_bin   COMMENT '����ԺУ',
  `collegefaculty` varchar(100) COLLATE utf8_bin   COMMENT '����Ժϵ',
  `collegemajor` varchar(100) COLLATE utf8_bin   COMMENT '����רҵ',
  `collegedegree` varchar(10) COLLATE utf8_bin   COMMENT '���ƽ׶λ��ѧλ',
  `collegeend` varchar(20) COLLATE utf8_bin  COMMENT '���Ʊ�ҵ����',
  `seniorschool` varchar(100) COLLATE utf8_bin   COMMENT '����ѧУ',
  `seniorstart` varchar(20) COLLATE utf8_bin   COMMENT '������ѧ����',
  `seniorend` varchar(20) COLLATE utf8_bin   COMMENT '���б�ҵ����',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='ѧ����Ϣ��';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- ��Ľṹ `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '��¼ID���Զ�����',
  `personid` int(11) NOT NULL COMMENT '��ԱID',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '����',
  `category` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '���',
  `note` varchar(255) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='��Ա�ܱ�';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





-- --------------------------------------------------------

--
-- ��Ľṹ `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL COMMENT '��ĿID',
  `submittime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '�ύʱ��',
  `typeid` int(11) NOT NULL COMMENT '��Ŀ���ID',
  `number` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '���ܲ��Ÿ�����Ŀ���',
  `principalid` int(11) NOT NULL COMMENT '������ID',
  `principalname` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '����������',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '��Ŀ����',
  `introduction` varchar(500) COLLATE utf8_bin COMMENT '��Ŀ���',
  `unit` varchar(500) COLLATE utf8_bin COMMENT '���뵥λ����;�ָ�',
  `starttime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��ʼʱ��',
  `endtime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��ֹʱ��',
  `ispublic` tinyint(1) COMMENT '�Ƿ񹫿�',
  `subsidizelimit` int(11) COMMENT '��Ŀ�������',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='������Ŀ��Ϣ��';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `projecttype`
--

CREATE TABLE IF NOT EXISTS `projecttype` (
  `id` int(11) NOT NULL COMMENT '��ĿID',
  `typename` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '��Ŀ�������',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='������Ŀ����';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `journalpaper`
--

CREATE TABLE IF NOT EXISTS `journalpaper` (
  `id` int(11) NOT NULL COMMENT '����ID',
  `time` int(11) NOT NULL COMMENT '¼��ϵͳ��ʱ��',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '���ı���',
  `abstract` varchar(1000) COLLATE utf8_bin NOT NULL COMMENT '����ժҪ',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����ͼƬ1��·��',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ2��·��',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ3��·��',
  `journalname` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '�ڿ�����',
  `publishdate` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��������',
  `volumenum` int(11) NOT NULL COMMENT '���',
  `issuenum` int(11) NOT NULL COMMENT '�ں�',
  `pagenum` int(11) NOT NULL COMMENT 'ҳ��',
  `SCI` tinyint(1) NOT NULL COMMENT 'SCI��¼',
  `EI` tinyint(1) NOT NULL COMMENT 'EI��¼',
  `ISTP` tinyint(1) NOT NULL COMMENT 'ISTP��¼',
  `IF` double NOT NULL COMMENT 'Ӱ������',
  `sponsor` varchar(200) COLLATE utf8_bin COMMENT '�������б���;����',
  `official` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '��ʽ�棨pdf��·��',
  `draft` varchar(100) COLLATE utf8_bin COMMENT '�ݸ壨word��·��',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='�ڿ����ı�';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- --------------------------------------------------------

--
-- ��Ľṹ `conferencepaper`
--

CREATE TABLE IF NOT EXISTS `conferencepaper` (
  `id` int(11) NOT NULL COMMENT '����ID',
  `time` int(11) NOT NULL COMMENT '¼��ϵͳ��ʱ��',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '���ı���',
  `abstract` varchar(1000) COLLATE utf8_bin NOT NULL COMMENT '����ժҪ',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����ͼƬ1��·��',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ2��·��',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ3��·��',
  `conferencename` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '��������',
  `publishdate` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��������',
  `pagenum` int(11) NOT NULL COMMENT 'ҳ��',
  `SCI` tinyint(1) NOT NULL COMMENT 'SCI��¼',
  `EI` tinyint(1) NOT NULL COMMENT 'EI��¼',
  `ISTP` tinyint(1) NOT NULL COMMENT 'ISTP��¼',
  `sponsor` varchar(200) COLLATE utf8_bin COMMENT '�������б���;����',
  `official` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '��ʽ�棨pdf��·��',
  `draft` varchar(100) COLLATE utf8_bin COMMENT '�ݸ壨word��·��',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='�������ı�';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `patent`
--

CREATE TABLE IF NOT EXISTS `dcd_patent` (
  `id` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'ר��ID',
  `time` int(11) NOT NULL COMMENT '¼��ϵͳʱ��',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'ר������',
  `abstract` varchar(1000) COLLATE utf8_bin COMMENT 'ר��ժҪ',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����ͼƬ1��·��',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ2��·��',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ3��·��',
  `application` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '�������ļ���ַ',
  `status` varchar(1) COLLATE utf8_bin NOT NULL COMMENT '��ǰ״̬',
  `acceptnum` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'ר�������',
  `acceptdate` varchar(20) COLLATE utf8_bin COMMENT '��������',
  `notice` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����֪ͨ���ַ',
  `authorizationnum` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��Ȩ��',
  `authorizationdate` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��Ȩ����',
  `authorizationcertificate` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '��Ȩ֤���ַ',
  `subsidize` varchar(100) COLLATE utf8_bin COMMENT '�������б���;�ָ�',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ר����';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `softwareright`
--

CREATE TABLE IF NOT EXISTS `softwareright` (
  `id` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'ID',
  `submittime` int(11) NOT NULL COMMENT '¼��ϵͳʱ��',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '����Ȩ����',
  `abstract` varchar(500) COLLATE utf8_bin COMMENT 'ժҪ',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����ͼƬ1',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ2',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ3',
  `regform` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����Ȩ�ǼǱ��ַ',
  `introduction` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '˵�����ַ',
  `code` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Դ�����ĵ�',
  `authorizationnum` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '��Ȩ��',
  `authorizationdate` varchar(20) NOT NULL COMMENT '��Ȩ����',
  `authorizationcertificate` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '��Ȩ֤��',
  `sponser` varchar(100) COLLATE utf8_bin COMMENT '��Ŀ�������б�',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='�������Ȩ��';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- ��Ľṹ `techreport`
--

CREATE TABLE IF NOT EXISTS `techreport` (
  `id` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'ID',
  `submittime` varchar(20) NOT NULL COMMENT '¼��ϵͳ����',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '����Ȩ����',
  `abstract` varchar(500) COLLATE utf8_bin COMMENT 'ժҪ',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����ͼƬ1',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ2',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ3',
  `attachment` varchar(100) COLLATE utf8_bin COMMENT '����',
  `sponser` varchar(100) COLLATE utf8_bin COMMENT '��Ŀ�������б�',
  `public` tinyint(1) NOT NULL COMMENT '��������',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='���������';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `thesis`
--

CREATE TABLE IF NOT EXISTS `thesis` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `submitdate` varchar(20) NOT NULL COMMENT '�ύʱ��',
  `title` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '���ı���',
  `abstract` varchar(1000) COLLATE utf8_bin COMMENT '����ժҪ',
  `image1` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '����ͼƬ1��·��',
  `image2` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ2��·��',
  `image3` varchar(100) COLLATE utf8_bin COMMENT '����ͼƬ3��·��',
  `sponsor` varchar(200) COLLATE utf8_bin COMMENT '�������б���;����',
  `official` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '��ʽ�棨pdf��·��',
  `draft` varchar(100) COLLATE utf8_bin COMMENT '�ݸ壨word��·��',
  `note` varchar(500) COLLATE utf8_bin COMMENT '��ע',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='��ҵ���ı�';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- ��Ľṹ `achieve`
--

CREATE TABLE IF NOT EXISTS `achieve` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
  `personid` int(11) NOT NULL  COMMENT '��ԱID' ,
  `persontype` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '��Ա����' ,
  `achievementid` int(11) NOT NULL  COMMENT '���гɹ�ID' ,
  `achievementtype` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '�ɹ�����' ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='��Ա���гɹ���Ӧ��';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;