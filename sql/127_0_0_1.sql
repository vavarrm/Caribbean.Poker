-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-07 11:10:11
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poker`
--
CREATE DATABASE IF NOT EXISTS `poker` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `poker`;

DELIMITER $$
--
-- 存储过程
--
DROP PROCEDURE IF EXISTS `win`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `win`()
    NO SQL
BEGIN
  DECLARE i INT DEFAULT 1;
  DECLARE p INT DEFAULT 0;
  DECLARE winlose_total INT DEFAULT 0;
  DECLARE bet_total INT DEFAULT 0;
  DECLARE double_total INT DEFAULT 0;
  DECLARE bet_lose_rate double ;
  DECLARE total_lose_rate double ;

CREATE TEMPORARY TABLE temp1 (
     winlose INT DEFAULT 0 , 
     bet INT DEFAULT 0  ,
     `double` INT DEFAULT 0 
   ) ENGINE=MEMORY;
   
   CREATE TEMPORARY TABLE temp2 (
     winlose_total INT DEFAULT 0  ,
     bet_total INT DEFAULT 0  ,
     double_total INT DEFAULT 0  ,
     bet_lose_rate double,
     total_lose_rate double
   ) ENGINE=MEMORY;
    WHILE i > 0 DO
    truncate temp1;
    	INSERT INTO temp1(winlose, bet, `double`)
    	SELECT  winlose ,bet, `double` FROM `caribbean_poker_income` ORDER BY RAND() LIMIT 0,1000;
    	SET i = i - 1;
        
    
    SET winlose_total = (SELECT SUM(winlose) FROM temp1);
    
    SET bet_total = (SELECT SUM(bet) FROM temp1);
    SET double_total = (SELECT SUM(`double`) FROM temp1);
    select  double_total;
    INSERT INTO temp2 (winlose_total, bet_total,  bet_lose_rate, total_lose_rate,  double_total) VALUES(winlose_total, bet_total, winlose_total/bet_total, winlose_total/(bet_total+double_total),   double_total);
    END WHILE;
	SELECT * , ROUND(t.bet_lose_rate*100,3) AS bet_lose_rate_pr , ROUND(t.total_lose_rate*100,3) AS total_lose_rate_pr FROM temp2 AS t ;
    SELECT * FROM temp1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `caribbean_poker_income`
--

DROP TABLE IF EXISTS `caribbean_poker_income`;
CREATE TABLE IF NOT EXISTS `caribbean_poker_income` (
  `id` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `player_card_type` varchar(20) NOT NULL,
  `banker_card_type` varchar(20) NOT NULL,
  `banker_hand_card` varchar(255) NOT NULL,
  `banker_card_style` varchar(30) NOT NULL,
  `banker_card_point` int(11) NOT NULL,
  `player_hand_card` varchar(255) NOT NULL,
  `player_card_style` varchar(30) NOT NULL,
  `player_card_point` int(11) NOT NULL,
  `winner` enum('banker','player','tie') NOT NULL,
  `odds` int(11) NOT NULL DEFAULT '1',
  `bet` int(11) NOT NULL,
  `double` int(11) NOT NULL DEFAULT '0',
  `winlose` int(11) NOT NULL,
  `play_point` int(11) NOT NULL DEFAULT '1000000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `caribbean_poker_income`
--

INSERT INTO `caribbean_poker_income` (`id`, `player_card_type`, `banker_card_type`, `banker_hand_card`, `banker_card_style`, `banker_card_point`, `player_hand_card`, `player_card_style`, `player_card_point`, `winner`, `odds`, `bet`, `double`, `winlose`, `play_point`) VALUES
(00000000000000000001, 'High card', 'Pairs', 's_6:s_7:d_8:d_3:h_4', 'High card', 87643, 'c_3:s_12:s_13:c_4:s_4', '4  Pairs', 1054500, 'player', 1, 5, 10, 5, 154183),
(00000000000000000002, 'Pairs', 'High card', 'h_10:d_7:c_4:c_12:h_4', '4  Pairs', 1053700, 'c_5:c_11:h_7:d_1:d_8', 'High card', 151875, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000003, 'High card', 'High card', 's_2:d_9:c_10:d_4:d_12', 'High card', 130942, 'h_4:c_6:s_9:d_5:d_1', 'High card', 149654, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000004, 'Pairs', 'Pairs', 'h_12:h_9:c_10:c_12:d_11', 'Q  Pairs', 1132900, 'd_3:h_10:s_3:c_13:h_7', '3  Pairs', 1044700, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000005, 'Pairs', 'High card', 's_2:h_12:h_5:c_2:s_4', '2  Pairs', 1032900, 's_10:h_2:c_12:c_6:s_8', 'High card', 130862, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000006, 'Pairs', 'Pairs', 'c_7:h_8:s_10:s_3:d_3', '3  Pairs', 1041500, 'c_5:c_9:h_11:h_9:d_2', '9  Pairs', 1101700, 'player', 1, 5, 10, 15, 154183),
(00000000000000000007, 'High card', 'High card', 'c_2:s_8:d_13:h_12:d_9', 'High card', 142982, 's_12:c_11:h_13:h_8:d_3', 'High card', 143183, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000008, 'High card', 'High card', 'd_1:d_6:d_13:c_4:c_10', 'High card', 154064, 'c_5:s_8:s_1:c_13:h_9', 'High card', 153985, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000009, 'Pairs', 'Pairs', 'h_7:c_1:h_3:s_5:h_1', 'A  Pairs', 1147800, 'd_8:s_4:d_6:c_4:s_11', '4  Pairs', 1052400, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000010, 'Pairs', 'Two Pairs', 'd_10:s_1:c_12:s_13:c_13', 'K  Pairs', 1146200, 's_4:h_4:h_11:c_11:c_8', '4-J Two Pairs', 2051008, 'player', 2, 5, 10, 25, 154183),
(00000000000000000011, 'Pairs', 'High card', 's_12:h_4:d_9:c_4:s_3', '4  Pairs', 1053200, 's_5:s_7:c_3:c_12:s_6', 'High card', 127653, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000012, 'Pairs', 'Pairs', 's_10:h_1:h_11:c_10:d_4', 'T  Pairs', 1115500, 'h_9:d_7:h_8:s_4:s_8', '8  Pairs', 1090100, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000013, 'High card', 'Pairs', 's_13:h_3:c_2:d_4:d_6', 'High card', 136432, 's_3:h_4:c_6:c_11:s_11', 'J  Pairs', 1116700, 'player', 1, 5, 10, 5, 154183),
(00000000000000000014, 'High card', 'High card', 'h_4:d_3:c_11:d_7:d_10', 'High card', 120743, 'h_3:d_5:d_4:c_8:s_13', 'High card', 138543, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000015, 'High card', 'Pairs', 's_5:h_2:h_4:c_13:d_12', 'High card', 142542, 'd_9:c_9:d_8:s_4:c_6', '9  Pairs', 1099000, 'player', 1, 5, 10, 5, 154183),
(00000000000000000016, 'Pairs', 'High card', 'h_8:s_8:s_11:d_5:c_12', '8  Pairs', 1093600, 'd_11:h_1:h_6:s_10:d_13', 'High card', 154206, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000017, 'Pairs', 'High card', 'd_2:s_11:h_13:h_2:h_12', '2  Pairs', 1035300, 'h_7:s_10:s_3:d_12:h_5', 'High card', 130753, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000018, 'High card', 'High card', 's_11:s_4:s_9:s_12:h_13', 'High card', 143194, 'd_2:c_13:c_3:c_7:h_11', 'High card', 141732, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000019, 'Pairs', 'High card', 'd_13:s_13:c_11:s_10:s_8', 'K  Pairs', 1142800, 'h_10:h_1:d_7:c_9:s_3', 'High card', 150973, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000020, 'High card', 'High card', 'd_11:c_4:s_13:d_8:h_7', 'High card', 141874, 'd_3:d_2:h_13:h_5:s_8', 'High card', 138532, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000021, 'High card', 'Pairs', 'h_10:d_11:c_7:d_2:c_1', 'High card', 152072, 'c_8:h_8:h_9:h_1:s_4', '8  Pairs', 1095300, 'player', 1, 5, 10, 5, 154183),
(00000000000000000022, 'High card', 'Two Pairs', 'd_8:d_5:h_9:s_13:c_1', 'High card', 153985, 's_4:h_4:d_2:d_13:c_13', '4-K Two Pairs', 2053002, 'player', 2, 5, 10, 25, 154183),
(00000000000000000023, 'Pairs', 'Pairs', 'c_9:s_3:s_7:c_7:d_6', '7  Pairs', 1079900, 'c_3:s_8:d_1:d_3:c_11', '3  Pairs', 1045900, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000024, 'Four of a Kind', 'Pairs', 's_3:h_3:h_2:d_3:c_3', 'Four of a Kind of 3', 7000003, 'c_7:c_1:h_12:s_12:h_9', 'Q  Pairs', 1135600, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000025, 'High card', 'Pairs', 'd_6:s_9:d_13:h_7:h_11', 'High card', 141976, 'h_10:c_10:d_11:c_7:c_3', 'T  Pairs', 1112000, 'player', 1, 5, 10, 5, 154183),
(00000000000000000026, 'High card', 'High card', 'd_6:d_4:s_10:c_5:d_3', 'High card', 106543, 's_13:h_10:c_6:d_1:c_2', 'High card', 154062, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000027, 'High card', 'Pairs', 's_12:c_10:h_11:h_1:c_2', 'High card', 153202, 'c_1:c_4:s_1:s_2:c_12', 'A  Pairs', 1152600, 'player', 1, 5, 10, 15, 154183),
(00000000000000000028, 'Pairs', 'Pairs', 'h_1:s_1:c_3:s_13:s_5', 'A  Pairs', 1153800, 'd_8:d_4:c_7:d_7:d_2', '7  Pairs', 1078600, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000029, 'Pairs', 'High card', 'h_9:c_7:s_7:d_12:s_6', '7  Pairs', 1083500, 'c_6:d_9:c_2:h_8:c_13', 'High card', 139862, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000030, 'High card', 'High card', 'd_11:c_4:h_2:h_13:d_7', 'High card', 141742, 's_5:h_11:s_13:h_4:s_1', 'High card', 154154, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000031, 'High card', 'High card', 'd_11:h_9:s_7:d_1:c_6', 'High card', 151976, 'h_1:s_10:c_5:s_9:d_4', 'High card', 150954, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000032, 'High card', 'Pairs', 'd_11:s_3:d_4:d_1:h_7', 'High card', 151743, 'd_3:h_9:h_6:d_8:s_9', '9  Pairs', 1098900, 'player', 1, 5, 10, 5, 154183),
(00000000000000000033, 'High card', 'High card', 'c_9:c_3:h_7:s_2:h_6', 'High card', 97632, 'h_12:c_5:h_10:h_1:d_2', 'High card', 153052, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000034, 'High card', 'Pairs', 'd_11:h_4:s_8:h_10:d_12', 'High card', 132084, 'd_5:s_11:d_6:h_11:s_13', 'J  Pairs', 1124100, 'player', 1, 5, 10, 5, 154183),
(00000000000000000035, 'set', 'Two Pairs', 's_6:h_1:h_13:h_6:d_6', '6 set', 3000006, 'h_7:c_3:h_12:d_3:c_7', '7-3 Two Pairs', 2073012, 'banker', 1, 5, 10, -15, 154183),
(00000000000000000036, 'Pairs', 'High card', 's_4:h_4:h_1:c_13:c_3', '4  Pairs', 1055600, 'h_6:c_4:c_12:s_7:s_11', 'High card', 131764, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000037, 'High card', 'High card', 's_11:c_13:h_5:d_6:d_2', 'High card', 141652, 'c_4:c_7:d_8:d_13:s_12', 'High card', 142874, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000038, 'Pairs', 'Pairs', 'd_11:s_7:s_4:h_8:c_7', '7  Pairs', 1082200, 'c_10:c_2:c_11:s_11:c_12', 'J  Pairs', 1123200, 'player', 1, 5, 10, 15, 154183),
(00000000000000000039, 'Pairs', 'High card', 'd_12:s_2:d_13:h_12:c_6', 'Q  Pairs', 1133800, 's_7:c_10:s_1:s_9:s_12', 'High card', 153097, 'banker', 1, 5, 0, -5, 154183),
(00000000000000000040, 'High card', 'High card', 'd_2:h_7:h_8:h_6:s_4', 'High card', 87642, 's_6:s_7:h_2:h_5:c_4', 'High card', 76542, 'banker', 1, 5, 0, -5, 154183);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
