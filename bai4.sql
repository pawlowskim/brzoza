-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Lis 2014, 20:17
-- Wersja serwera: 5.6.20
-- Wersja PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `bai4`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `message` varchar(255) COLLATE latin2_bin NOT NULL,
  `owner` varchar(50) COLLATE latin2_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_bin AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `message`, `owner`) VALUES
(1, 'some new message text\r\n', 'liseu'),
(2, 'some new message text\r\n', 'lisek'),
(3, 'some new message text\r\n', 'jordan'),
(4, 'some new message text\r\n', 'łach'),
(11, 'u2 msg', 'u2'),
(13, 'u2 dla user1 zmiana', 'u2'),
(14, 'zczxcasd11111111111111', 'u2'),
(15, 'zzzzzzzzzzzzzzzzzz ccccccccccccc', 'user1'),
(16, 'addsaf', 'u1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
`id` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_bin AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `privileges`
--

INSERT INTO `privileges` (`id`, `messageId`, `ownerId`, `userId`) VALUES
(1, 10, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(30) COLLATE latin2_bin NOT NULL,
  `pass` varchar(30) COLLATE latin2_bin NOT NULL,
  `login_mode` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int(11) NOT NULL DEFAULT '3',
  `failed` int(11) NOT NULL DEFAULT '0',
  `last_success` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_failed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logins_success_number` int(11) NOT NULL DEFAULT '0',
  `state` int(11) DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_bin AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `login_mode`, `attempts`, `failed`, `last_success`, `last_failed`, `logins_success_number`, `state`) VALUES
(1, 'user1', 'user1', 1, 5, 5, '2014-11-17 20:58:12', '2014-11-17 20:58:51', 0, 0),
(2, 'user2', 'user2', 0, 3, 0, '2014-11-17 20:25:33', '2014-11-17 20:20:49', 0, 1),
(3, 'user3', 'user3', 0, 3, 0, '2014-11-17 20:23:55', '2014-11-17 20:20:49', 0, 1),
(4, 'sdaf', 's61h35l2gdsa12', 1, 3, 0, '2014-11-12 07:43:07', '2014-11-17 20:20:49', 0, 0),
(5, 'asd', 's61h35l2gdsa12', 1, 3, 25, '2014-11-12 07:43:07', '2014-11-17 20:20:49', 0, 0),
(6, 'asdf', 's61h35l2gdsa12', 1, 3, 26, '0000-00-00 00:00:00', '2014-11-17 20:20:49', 0, 0),
(7, '', 's61h35l2gdsa12', 1, 3, 27, '0000-00-00 00:00:00', '2014-11-17 20:20:49', 0, 0),
(8, 'asdfe', '707780414546a6240edb061.413921', 1, 3, 2, '0000-00-00 00:00:00', '2014-11-17 21:01:59', 0, 1),
(9, 'lkjh', '55850435546a625eb64d82.8150586', 1, 3, 2, '0000-00-00 00:00:00', '2014-11-17 21:02:29', 0, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `privileges`
--
ALTER TABLE `privileges`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
