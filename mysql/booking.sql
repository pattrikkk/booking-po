-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 13.Dec 2023, 22:42
-- Verzia serveru: 10.4.27-MariaDB
-- Verzia PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `booking`
--
CREATE DATABASE IF NOT EXISTS `booking` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `booking`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `listing`
--

CREATE TABLE `listing` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `rooms` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `amenities` text NOT NULL,
  `price` float NOT NULL,
  `publishedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `publishedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Sťahujem dáta pre tabuľku `listing`
--

INSERT INTO `listing` (`id`, `name`, `location`, `description`, `rooms`, `beds`, `amenities`, `price`, `publishedDate`, `publishedBy`) VALUES
(1, 'Test123', 'Bratislavaaaaa', 'lorem', 1, 1, '[\"petsAllowed\"]', 5, '2023-12-12 11:43:18', 7),
(2, 'Custom title 123', 'Nové Zámky, Slovakia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Id porta nibh venenatis cras sed. Sed augue lacus viverra vitae congue. Iaculis at erat pellentesque adipiscing commodo elit. Aliquam nulla facilisi cras fermentum odio. Lorem mollis aliquam ut porttitor. Augue eget arcu dictum varius duis. Urna duis convallis convallis tellus id. Nisi porta lorem mollis aliquam ut porttitor. Malesuada fames ac turpis egestas integer. Ac turpis egestas maecenas pharetra. Ipsum a arcu cursus vitae congue mauris. Mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et netus. Ut eu sem integer vitae justo eget magna fermentum iaculis. Tincidunt praesent semper feugiat nibh sed. Urna neque viverra justo nec ultrices. A arcu cursus vitae congue mauris rhoncus aenean.\r\n\r\nId velit ut tortor pretium viverra suspendisse potenti nullam ac. Amet aliquam id diam maecenas ultricies mi eget mauris pharetra. At volutpat diam ut venenatis tellus. Tellus in hac habitasse platea dictumst vestibulum rhoncus. Mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. Urna molestie at elementum eu. Sed felis eget velit aliquet sagittis id consectetur purus ut. Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Vestibulum lorem sed risus ultricies tristique. Integer malesuada nunc vel risus. Sem viverra aliquet eget sit. Augue mauris augue neque gravida in fermentum. Nibh cras pulvinar mattis nunc sed. Quisque id diam vel quam elementum pulvinar. Scelerisque in dictum non consectetur a erat. Massa ultricies mi quis hendrerit dolor magna. Id ornare arcu odio ut sem nulla pharetra. At in tellus integer feugiat scelerisque.\r\n\r\nAmet nulla facilisi morbi tempus iaculis urna. Diam ut venenatis tellus in metus vulputate eu. Vel orci porta non pulvinar neque. Imperdiet dui accumsan sit amet nulla facilisi morbi tempus. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae. Nec sagittis aliquam malesuada bibendum. Pharetra et ultrices neque ornare. Varius morbi enim nunc faucibus. Purus semper eget duis at tellus at urna condimentum. Gravida quis blandit turpis cursus. Platea dictumst vestibulum rhoncus est. Tortor dignissim convallis aenean et tortor at risus viverra. Nisl purus in mollis nunc sed id semper risus in. Nullam vehicula ipsum a arcu cursus vitae congue mauris rhoncus. Risus ultricies tristique nulla aliquet enim tortor at auctor.', 7, 5, '[\"wifi\",\"parking\",\"catering\",\"petsAllowed\"]', 10, '2023-12-12 12:12:37', 7),
(7, 'Chata', 'Zvolen, Slovakia', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi scelerisque luctus velit. Donec quis nibh at felis congue commodo. Etiam posuere lacus quis dolor. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. In convallis. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam dictum tincidunt diam. Etiam neque. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin mattis lacinia justo. Aliquam erat volutpat. Nullam at arcu a est sollicitudin euismod. Integer in sapien. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Curabitur vitae diam non enim vestibulum interdum. Aenean placerat. Cras elementum.\r\n\r\nFusce suscipit libero eget elit. Praesent dapibus. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Aenean fermentum risus id tortor. Nunc dapibus tortor vel mi dapibus sollicitudin. Pellentesque sapien. Nullam dapibus fermentum ipsum. Cras elementum. Etiam neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Aenean id metus id velit ullamcorper pulvinar.\r\n\r\nNullam faucibus mi quis velit. Integer lacinia. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Maecenas libero. Nulla quis diam. Integer malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce suscipit libero eget elit. Ut tempus purus at lorem. Integer malesuada. Mauris elementum mauris vitae tortor. Ut tempus purus at lorem. Integer pellentesque quam vel velit. Quisque porta. Integer malesuada. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Vestibulum fermentum tortor id mi.\r\n\r\nPhasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Vivamus ac leo pretium faucibus. In convallis. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Praesent in mauris eu tortor porttitor accumsan. Fusce consectetuer risus a nunc. Curabitur bibendum justo non orci. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Maecenas aliquet accumsan leo.', 2, 3, '[\"wifi\",\"catering\"]', 6, '2023-12-12 14:37:02', 11),
(8, '&lt;h1&gt;asdasdsaddsa&lt;/h1&gt;', '1', '1', 1, 1, '[\"parking\"]', 1, '2023-12-13 17:36:15', 11);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `listingId` int(11) NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `message` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Sťahujem dáta pre tabuľku `reservation`
--

INSERT INTO `reservation` (`id`, `userId`, `listingId`, `dateFrom`, `dateTo`, `message`, `approved`, `adults`, `children`, `createdAt`) VALUES
(5, 11, 1, '2023-12-14', '2023-12-16', 'Hello', 0, 4, 3, '2023-12-13 22:38:58');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `phone`) VALUES
(7, '1', '1', '1', '$2y$10$kHTHmnmHYVGwHdID.RbcaOaIrN5IcdipEGKDhQbjNVD7fAQLME/W.', '1'),
(8, '1', '1', 'test', '$2y$10$oTkL.Ke34heKtMCUeBVKq.tlZAr6wOnCQ6A63md4NfHqAw7a6IPMy', '1'),
(9, '2', '2', '2', '$2y$10$zG/Hy.X6Na1r1AolFWYyeeWcf0oP/bo2edQNG5U90qRAorb48P1/y', '2'),
(10, '\'', '\'', '\'', '$2y$10$fe3XT0KAWTHT6lwJftk4Z.81n3HX6qPzLtu2HvXHPwpk7uCwduoVW', '\''),
(11, 'Jozef', 'Novák', 'jozef123@gmail.com', '$2y$10$0rYF3xNRK3OJ/5eAZrgV6OTpPM.DOOuQW.voyewIT9.AW.pt4bEI.', '+421 915 864 943');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pre tabuľku `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
