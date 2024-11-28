-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Máj 08. 21:23
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szakdoga`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etel`
--

CREATE TABLE `etel` (
  `eid` int(11) NOT NULL,
  `etelNev` varchar(85) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tomeg` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `etel`
--

INSERT INTO `etel` (`eid`, `etelNev`, `tomeg`) VALUES
(8, 'Rántotta', 400),
(9, 'Bab főzelék', 300),
(15, 'Bab leves', 351),
(17, 'Sertés tarja hagymás törtburgonyával, pezsgős párolt káposztával', 450);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etelhozzav`
--

CREATE TABLE `etelhozzav` (
  `hid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `mennyi` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `etelhozzav`
--

INSERT INTO `etelhozzav` (`hid`, `eid`, `mennyi`) VALUES
(13, 8, 9),
(13, 9, 2),
(13, 17, 2),
(21, 8, 200),
(21, 9, 400),
(21, 17, 200),
(22, 8, 20),
(23, 17, 200);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `etlap`
--

CREATE TABLE `etlap` (
  `datum` date NOT NULL,
  `leves` int(11) NOT NULL,
  `aetel` int(11) NOT NULL,
  `betel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `etlap`
--

INSERT INTO `etlap` (`datum`, `leves`, `aetel`, `betel`) VALUES
('2021-03-01', 8, 8, 8),
('2021-03-02', 8, 8, 8),
('2021-03-10', 8, 8, 8),
('2021-03-11', 8, 8, 8),
('2021-03-17', 8, 8, 8),
('2021-03-19', 8, 8, 8),
('2021-03-20', 8, 8, 8),
('2021-03-22', 8, 8, 8),
('2021-03-23', 8, 8, 8),
('2021-03-24', 8, 8, 8),
('2021-04-01', 8, 8, 8),
('2021-04-05', 8, 8, 8),
('2021-04-08', 8, 8, 8),
('2021-04-14', 8, 8, 8),
('2021-03-31', 9, 8, 9),
('2021-03-25', 9, 9, 9),
('2021-04-12', 9, 15, 8),
('2021-04-07', 15, 8, 9),
('2021-04-20', 15, 8, 17),
('2021-04-09', 15, 9, 17),
('2021-04-06', 17, 8, 8),
('2021-04-13', 17, 8, 8),
('2021-04-15', 17, 15, 8);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzavalo`
--

CREATE TABLE `hozzavalo` (
  `hid` int(11) NOT NULL,
  `megys` varchar(3) COLLATE utf8mb4_swedish_ci NOT NULL,
  `hnev` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `allergen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `hozzavalo`
--

INSERT INTO `hozzavalo` (`hid`, `megys`, `hnev`, `allergen`) VALUES
(13, 'db', 'tojás', 1),
(21, 'g', 'só', 0),
(22, 'g', 'bors', 0),
(23, 'ml', 'tej', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `napirendeles`
--

CREATE TABLE `napirendeles` (
  `napId` int(11) NOT NULL,
  `rendId` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `napirendeles`
--

INSERT INTO `napirendeles` (`napId`, `rendId`, `datum`) VALUES
(159, 101, '2021-03-08'),
(160, 102, '2021-04-07'),
(161, 102, '2021-04-14'),
(162, 102, '2021-04-15'),
(163, 103, '2021-04-07'),
(164, 104, '2021-04-07'),
(165, 105, '2021-04-15'),
(166, 106, '2021-04-08'),
(167, 106, '2021-04-09'),
(168, 106, '2021-04-14'),
(169, 106, '2021-04-15'),
(170, 107, '2021-04-08'),
(171, 107, '2021-04-14'),
(172, 107, '2021-04-15'),
(173, 107, '2021-04-20'),
(174, 108, '2021-04-08'),
(175, 109, '2021-04-09'),
(176, 110, '2021-04-09'),
(177, 111, '2021-04-09'),
(178, 112, '2021-03-08'),
(185, 115, '2021-04-09'),
(186, 115, '2021-04-20'),
(205, 125, '2021-04-12'),
(206, 125, '2021-04-13'),
(207, 125, '2021-04-14'),
(208, 126, '2021-04-12'),
(209, 126, '2021-04-13'),
(210, 127, '2021-04-12'),
(211, 127, '2021-04-15'),
(212, 128, '2021-02-08');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles`
--

CREATE TABLE `rendeles` (
  `rendId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `renddatum` datetime NOT NULL DEFAULT current_timestamp(),
  `kartyase` tinyint(1) NOT NULL,
  `fizetette` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `rendeles`
--

INSERT INTO `rendeles` (`rendId`, `userId`, `renddatum`, `kartyase`, `fizetette`) VALUES
(101, 5, '2021-04-06 12:16:29', 0, 1),
(102, 5, '2021-04-06 12:19:38', 0, 1),
(103, 5, '2021-04-06 12:20:16', 0, 1),
(104, 5, '2021-04-06 15:28:49', 1, 1),
(105, 5, '2021-04-06 15:38:17', 0, 1),
(106, 5, '2021-04-06 16:49:05', 0, 1),
(107, 5, '2021-04-06 17:01:13', 0, 1),
(108, 5, '2021-04-07 09:43:01', 1, 1),
(109, 5, '2021-04-07 09:47:16', 1, 1),
(110, 16, '2021-04-07 10:46:29', 0, 1),
(111, 5, '2021-04-07 12:03:57', 0, 1),
(112, 16, '2021-04-07 13:53:19', 0, 1),
(115, 5, '2021-04-07 16:51:57', 0, 1),
(125, 17, '2021-04-10 18:46:37', 0, 1),
(126, 17, '2021-04-10 18:46:43', 0, 1),
(127, 5, '2021-04-11 10:26:20', 0, 1),
(128, 2, '2021-04-11 10:34:28', 0, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telepules`
--

CREATE TABLE `telepules` (
  `tid` int(11) NOT NULL,
  `irsz` varchar(4) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telepulesNev` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `telepules`
--

INSERT INTO `telepules` (`tid`, `irsz`, `telepulesNev`) VALUES
(14, '2600', 'Tatabánya');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tetelesrend`
--

CREATE TABLE `tetelesrend` (
  `napId` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `menny` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `tetelesrend`
--

INSERT INTO `tetelesrend` (`napId`, `eid`, `menny`) VALUES
(159, 9, 2),
(160, 9, 3),
(161, 8, 2),
(162, 15, 2),
(162, 17, 1),
(163, 9, 1),
(164, 8, 1),
(165, 17, 3),
(166, 8, 9),
(167, 9, 1),
(167, 15, 1),
(167, 17, 2),
(168, 8, 5),
(169, 8, 2),
(169, 15, 1),
(169, 17, 2),
(170, 8, 2),
(171, 8, 3),
(172, 8, 1),
(172, 17, 2),
(173, 8, 2),
(173, 15, 6),
(173, 17, 3),
(174, 8, 4),
(175, 9, 1),
(175, 15, 2),
(175, 17, 3),
(176, 9, 1),
(176, 15, 2),
(176, 17, 3),
(177, 9, 1),
(177, 15, 2),
(178, 9, 1),
(185, 9, 1),
(185, 15, 3),
(185, 17, 1),
(186, 8, 4),
(205, 9, 2),
(205, 15, 1),
(206, 17, 1),
(207, 8, 1),
(208, 15, 1),
(209, 8, 1),
(210, 8, 1),
(210, 15, 1),
(211, 15, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `unev` varchar(40) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8mb4_swedish_ci NOT NULL,
  `tid` int(11) DEFAULT NULL,
  `utca_hsz` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(35) COLLATE utf8mb4_swedish_ci NOT NULL,
  `jelszo` varchar(40) COLLATE utf8mb4_swedish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`userId`, `unev`, `tel`, `tid`, `utca_hsz`, `email`, `jelszo`, `admin`) VALUES
(2, 'a@b.hu', '2344', NULL, 'gfdg', 'gf', '123456', 0),
(5, 'pogi', '123', 14, 'asdsdasd 56.', 'a@b.hu', 'e10adc3949ba59abbe56e057f20f883e', 1),
(6, 'Alma', '0601-234-4567', NULL, 'nasjda', 'alama@b.hu', '202cb962ac59075b964b07152d234b70', 0),
(7, 'dgdg', '0612-345-4444', NULL, 'dgcf', 'asdf@b', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(8, 'Alma', '0612-121-1212', NULL, 'gfcfc', 'k@b.hu', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(9, 'test', '0611-111-1111', NULL, 'test', 'sv@mail.hu', '098f6bcd4621d373cade4e832627b4f6', 0),
(10, 'nasjdn', '0633-333-3333', NULL, 'ghcvg', 'a@b.hu', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(11, 'bjhfbhj', '0688-888-8888', NULL, 'cfgcg', 'sdfs@b.hu', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(12, 'jaj', '0600-000-0000', NULL, 'admin', 'a@b.hu', '21232f297a57a5a743894a0e4a801fc3', 0),
(13, 'admin', '0600-000-0000', NULL, 'admin', 'admin@ala', '21232f297a57a5a743894a0e4a801fc3', 0),
(14, 'test', '0633-333-2233', NULL, '1sdfasdf', 'k@v.hu', '098f6bcd4621d373cade4e832627b4f6', 0),
(15, 'sfsd', '0612-121-2121', NULL, 'asdvasd', 'test@jaj', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(16, 'Kiss Vince', '0600-000-0000', 14, 'TEST u. 10', 'vincekiss1414@gmail.com', '529df86b28d492e6c971133dd6526f15', 0),
(17, 'Játékos Ádám', '0670-433-6977', 14, 'Ibolya köz 17.', 'jatekadi@gmail.com', '5bb50314c7d970ce6cb07afb583c4c9d', 0),
(18, 'rendelesTest', '0600-000-0000', 14, 'test', 'test@test', 'c20ad4d76fe97759aa27a0c99bff6710', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `etel`
--
ALTER TABLE `etel`
  ADD PRIMARY KEY (`eid`);

--
-- A tábla indexei `etelhozzav`
--
ALTER TABLE `etelhozzav`
  ADD PRIMARY KEY (`hid`,`eid`),
  ADD KEY `eid` (`eid`);

--
-- A tábla indexei `etlap`
--
ALTER TABLE `etlap`
  ADD PRIMARY KEY (`datum`),
  ADD KEY `leves` (`leves`,`aetel`,`betel`),
  ADD KEY `aetel` (`aetel`),
  ADD KEY `betel` (`betel`);

--
-- A tábla indexei `hozzavalo`
--
ALTER TABLE `hozzavalo`
  ADD PRIMARY KEY (`hid`);

--
-- A tábla indexei `napirendeles`
--
ALTER TABLE `napirendeles`
  ADD PRIMARY KEY (`napId`) USING BTREE,
  ADD KEY `rendId` (`rendId`);

--
-- A tábla indexei `rendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`rendId`) USING BTREE,
  ADD KEY `userId` (`userId`);

--
-- A tábla indexei `telepules`
--
ALTER TABLE `telepules`
  ADD PRIMARY KEY (`tid`);

--
-- A tábla indexei `tetelesrend`
--
ALTER TABLE `tetelesrend`
  ADD PRIMARY KEY (`napId`,`eid`),
  ADD KEY `eid` (`eid`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `tid` (`tid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `etel`
--
ALTER TABLE `etel`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT a táblához `napirendeles`
--
ALTER TABLE `napirendeles`
  MODIFY `napId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT a táblához `rendeles`
--
ALTER TABLE `rendeles`
  MODIFY `rendId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT a táblához `telepules`
--
ALTER TABLE `telepules`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `etelhozzav`
--
ALTER TABLE `etelhozzav`
  ADD CONSTRAINT `etelhozzav_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hozzavalo` (`hid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etelhozzav_ibfk_2` FOREIGN KEY (`eid`) REFERENCES `etel` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `etlap`
--
ALTER TABLE `etlap`
  ADD CONSTRAINT `etlap_ibfk_1` FOREIGN KEY (`leves`) REFERENCES `etel` (`eid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `etlap_ibfk_2` FOREIGN KEY (`aetel`) REFERENCES `etel` (`eid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `etlap_ibfk_3` FOREIGN KEY (`betel`) REFERENCES `etel` (`eid`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `napirendeles`
--
ALTER TABLE `napirendeles`
  ADD CONSTRAINT `napirendeles_ibfk_2` FOREIGN KEY (`rendId`) REFERENCES `rendeles` (`rendId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `rendeles`
--
ALTER TABLE `rendeles`
  ADD CONSTRAINT `rendeles_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `tetelesrend`
--
ALTER TABLE `tetelesrend`
  ADD CONSTRAINT `tetelesrend_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `etel` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tetelesrend_ibfk_2` FOREIGN KEY (`napId`) REFERENCES `napirendeles` (`napId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `telepules` (`tid`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
