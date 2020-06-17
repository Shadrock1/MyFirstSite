phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 17 2020 г., 13:09
-- Версия сервера: 5.7.30-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `MyBD`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Posts`
--

CREATE TABLE `Posts` (
                         `id` int(11) UNSIGNED NOT NULL,
                         `name` varchar(100) NOT NULL,
                         `post` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Posts`
--

INSERT INTO `Posts` (`id`, `name`, `post`) VALUES
(16, 'Best capture cards for PC gaming', '                    The best capture card for PC gaming offers recording freedom, the ability to expand your gaming repertoire beyond PC platforms and into console exclusive territory, and lessens the load on your gaming PC for high-fidelity streaming. If you\'re a budding Twitch or Mixer streamer, a capture card makes your dual-PC broadcast that little bit easier&mdash;so make sure you pick the right one for the job.'),
(17, 'PAX West cancels in-person event, will host PAX Online this year instead', '                    Seattle gaming convention PAX West will not be happening this Labor Day weekend. Instead, it will shift into a nine-day online conference that takes place in the middle of September, the conference&rsquo;s organizers announced today.\r\n\r\nThe new PAX Online will take place virtually from September 12th through the 20th. There will be three channels hosting content &ldquo;non-stop each and every day,&rdquo; including panels, concerts, competitions, and esports events. PAX Online plans to offer downloadable demos to replicate the experience of trying games out on the show floor, and if you want to get PAX merch, you&rsquo;ll be able to buy it online.'),
(18, 'Google has a new Stadia starter kit, and it&rsquo;s $30 cheaper', '                    You don&rsquo;t need Google&rsquo;s own gamepad or dongle to try its Stadia cloud gaming service, particularly now that it works on practically any Android phone &mdash; but if you want to fire up Stadia on your 4K TV with a wireless gamepad, you can do that for cheaper now.\r\n\r\nToday, Google is offering a new Stadia Premiere Edition starter kit for $99, which comes with the company&rsquo;s Chromecast Ultra HDMI dongle and the Stadia Controller you&rsquo;ll need to control it from your couch, and which also works plugged into a phone or wirelessly with a computer.'),
(19, 'The FDA just approved the first prescription video game &mdash; it&rsquo;s for kids with ADHD', '                    It might not look like much of a video game, but Akili Interactive&rsquo;s EndeavorRX, formerly Project EVO, may go down in history: it&rsquo;s the first video game that can legally be marketed and prescribed as medicine in the US.\r\n\r\nThat&rsquo;s the landmark decision from the Food and Drug Administration (FDA), which is authorizing doctors to prescribe the iPhone and iPad game for kids between ages eight and 12 years old with ADHD, after it underwent seven years of clinical trials that studied over 600 children to figure out whether a game could actually make a difference.');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
                         `id` int(11) UNSIGNED NOT NULL,
                         `login` varchar(20) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Posts`
--
ALTER TABLE `Posts`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Posts`
--
ALTER TABLE `Posts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
    MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;