-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2017 at 04:10 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `网站名称已替换`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_node_group`
--

CREATE TABLE `active_node_group` (
  `id` int(8) NOT NULL COMMENT '自增 ID',
  `node_group` int(8) NOT NULL COMMENT '服务器群组号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `active_node_group`
--

INSERT INTO `active_node_group` (`id`, `node_group`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL COMMENT '自增 ID',
  `create_time` datetime NOT NULL COMMENT '调试日志生成时间',
  `data_key` varchar(10240) COLLATE utf8_unicode_ci NOT NULL COMMENT '键',
  `data_value` varchar(10240) COLLATE utf8_unicode_ci NOT NULL COMMENT '值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `node_data_record`
--

CREATE TABLE `node_data_record` (
  `id` int(8) NOT NULL COMMENT '自增 ID',
  `create_time` datetime NOT NULL COMMENT '可以理解为正式激活拥有帐号的时间，比订单激活时间会略晚',
  `update_time` datetime NOT NULL COMMENT '可以理解为流量更新时间',
  `uid` int(8) NOT NULL COMMENT '用户 ID',
  `ip_id` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '通过 ID 来获取IP，不能写 IP，万一 IP 被封了呢？',
  `port` int(4) NOT NULL COMMENT '端口',
  `in_data` bigint(32) NOT NULL COMMENT '进站流量',
  `out_data` bigint(32) NOT NULL COMMENT '出站流量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `node_data_record`
--

INSERT INTO `node_data_record` (`id`, `create_time`, `update_time`, `uid`, `ip_id`, `port`, `in_data`, `out_data`) VALUES
(184, '2017-02-10 11:41:25', '2017-02-10 16:05:34', 116, '1', 2000, 17996, 66286),
(185, '2017-02-10 11:41:25', '2017-02-10 16:05:34', 116, '2', 2000, 164405, 964885),
(186, '2017-02-10 12:01:30', '2017-02-10 16:05:34', 117, '1', 2001, 13820967, 236895431),
(187, '2017-02-10 12:01:30', '2017-02-10 16:05:34', 117, '2', 2001, 14698792, 293551082),
(188, '2017-02-10 15:37:14', '2017-02-10 16:05:34', 118, '1', 2002, 0, 0),
(189, '2017-02-10 15:37:14', '2017-02-10 16:05:34', 118, '2', 2002, 539924, 6159288);

-- --------------------------------------------------------

--
-- Table structure for table `node_list`
--

CREATE TABLE `node_list` (
  `id` int(8) NOT NULL COMMENT '自增 ID',
  `update_time` datetime NOT NULL COMMENT '节点最新更新时间',
  `ip` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '节点服务器 IP',
  `address` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '节点服务器域名',
  `user_count_limit` int(8) NOT NULL COMMENT '节点服务器人数限制',
  `user_count_now` int(8) NOT NULL COMMENT '当前服务器节点上有多少个用户',
  `country` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '节点服务器所在国家和地区',
  `node_group` int(8) NOT NULL COMMENT '服务器分组，每一组的配置完全一样'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `node_list`
--

INSERT INTO `node_list` (`id`, `update_time`, `ip`, `address`, `user_count_limit`, `user_count_now`, `country`, `node_group`) VALUES
(1, '2017-02-10 15:37:14', '45.63.82.86', 'us.网站名称已替换.online', 500, 3, '美国', 1),
(2, '2017-02-10 15:37:14', '45.76.99.89', 'jp.网站名称已替换.online', 500, 3, '日本', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(8) NOT NULL COMMENT '自增 ID',
  `create_time` datetime NOT NULL COMMENT '订单创建时间',
  `active_time` datetime NOT NULL COMMENT '订单激活时间',
  `uid` int(8) NOT NULL COMMENT '用户 ID',
  `type` int(8) NOT NULL COMMENT '订单类型',
  `price` int(8) NOT NULL COMMENT '订单价格，单位为分',
  `pay_time` datetime NOT NULL COMMENT '订单支付时间',
  `pay_money` int(8) NOT NULL COMMENT '支付系统确认收到的金额',
  `status` int(8) NOT NULL DEFAULT '0' COMMENT '支付状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `create_time`, `active_time`, `uid`, `type`, `price`, `pay_time`, `pay_money`, `status`) VALUES
(187, '2017-02-10 11:41:01', '2017-02-10 11:41:25', 116, 1, 1, '2017-02-10 11:41:18', 1, 2),
(188, '2017-02-10 12:00:57', '2017-02-10 12:01:30', 117, 1, 1, '2017-02-10 12:01:23', 1, 2),
(189, '2017-02-10 15:36:47', '2017-02-10 15:37:14', 118, 1, 1, '2017-02-10 15:37:09', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(8) NOT NULL COMMENT '自增 ID',
  `day_limit` int(11) NOT NULL COMMENT '日期限制，天数',
  `data_limit` bigint(32) NOT NULL COMMENT '流量限制，GB',
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `introduction` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '简介',
  `price` int(8) NOT NULL COMMENT '价格，单位分',
  `discount` int(8) NOT NULL COMMENT '折扣，1-100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `day_limit`, `data_limit`, `title`, `introduction`, `price`, `discount`) VALUES
(1, 1, 1, '试用套餐', '美国、日本2条线路', 100, 1),
(2, 30, 20, '月付套餐', '美国、日本2条线路', 1500, 52),
(3, 180, 150, '半年套餐', '美国、日本2条线路', 6000, 52),
(4, 365, 300, '年付套餐', '美国、日本2条线路', 10000, 52);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT '自增用户 ID',
  `reg_time` datetime NOT NULL COMMENT '注册时间',
  `username` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `update_time` datetime NOT NULL COMMENT '信息更新时间，比如修改密码',
  `email` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户邮箱',
  `password` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `ss_password` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT 'shadowsocks 密码',
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱验证码',
  `recommender_email` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '推荐者邮箱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `reg_time`, `username`, `update_time`, `email`, `password`, `ss_password`, `code`, `recommender_email`) VALUES
(116, '2017-02-10 11:40:42', 'leiquan', '2017-02-10 11:40:42', 'leiquan@live.com', '782d552ea87eaefa1230342a3edf88d1', 'cUwzRnBIY24=', '', ''),
(117, '2017-02-10 12:00:45', 'chenjianwei', '2017-02-10 12:00:45', 'sohucw@163.com', '202cb962ac59075b964b07152d234b70', 'S0pDeDhmYXA=', '', ''),
(118, '2017-02-10 15:36:19', 'webxzy@qq.com', '2017-02-10 15:36:19', 'webxzy@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 'N3BSRGpDT20=', '', 'webxzy@qq.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_data_contronl`
--

CREATE TABLE `user_data_contronl` (
  `id` int(8) NOT NULL,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '用户控制更新时间，表示上次有效更新，比如激活了两个订单',
  `uid` int(8) NOT NULL,
  `expires_time` datetime NOT NULL,
  `data_limit` bigint(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_data_contronl`
--

INSERT INTO `user_data_contronl` (`id`, `create_time`, `update_time`, `uid`, `expires_time`, `data_limit`) VALUES
(87, '2017-02-10 11:41:25', '2017-02-10 11:41:25', 116, '2017-02-11 19:41:25', 1073741824),
(88, '2017-02-10 12:01:30', '2017-02-10 12:01:30', 117, '2027-02-11 20:01:30', 43434341073741824),
(89, '2017-02-10 15:37:14', '2017-02-10 15:37:14', 118, '2017-02-11 23:37:14', 1073741824);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_node_group`
--
ALTER TABLE `active_node_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node_data_record`
--
ALTER TABLE `node_data_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node_list`
--
ALTER TABLE `node_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data_contronl`
--
ALTER TABLE `user_data_contronl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_node_group`
--
ALTER TABLE `active_node_group`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '自增 ID', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增 ID', AUTO_INCREMENT=705;
--
-- AUTO_INCREMENT for table `node_data_record`
--
ALTER TABLE `node_data_record`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '自增 ID', AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `node_list`
--
ALTER TABLE `node_list`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '自增 ID', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '自增 ID', AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '自增 ID', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增用户 ID', AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `user_data_contronl`
--
ALTER TABLE `user_data_contronl`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
