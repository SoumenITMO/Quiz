-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2019 at 06:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printful_quiztest`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_list`
--

CREATE TABLE `quiz_list` (
  `quiz_id` int(2) NOT NULL,
  `quiz_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_list`
--

INSERT INTO `quiz_list` (`quiz_id`, `quiz_name`) VALUES
(1, 'Php Test'),
(2, 'Html Test');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_quesrions`
--

CREATE TABLE `quiz_quesrions` (
  `id` int(100) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `quiz_question` text NOT NULL,
  `quiz_answer_a` text NOT NULL,
  `quiz_answer_b` text NOT NULL,
  `quiz_answer_c` text NOT NULL,
  `quiz_answer_d` text NOT NULL,
  `quiz_correct_answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_quesrions`
--

INSERT INTO `quiz_quesrions` (`id`, `quiz_id`, `quiz_question`, `quiz_answer_a`, `quiz_answer_b`, `quiz_answer_c`, `quiz_answer_d`, `quiz_correct_answer`) VALUES
(1, 1, ' PHP Stands for', 'Hypertext Processor', 'Hypertext Preprocessor', 'Hypermarkup Preprocessor', 'Hypermarkup Processor', 'Hypertext Preprocessor'),
(2, 1, 'PHP is _______ scripting language', 'Server-side', 'Clint-side', 'Middle-side', 'Out-side', 'Server-side'),
(3, 1, 'PHP scripts are executed on ?', 'ISP Computer', 'Client Computer', 'Server Computer', 'It depends on PHP scripts', 'Server Computer'),
(5, 1, 'Which of the following statements prints in PHP?', 'Out', 'Write', 'Echo', 'Display', 'Echo'),
(6, 1, ' In PHP, each statement must be end with ?', '.(dot)', ';(semicolon)', '/(slash)', ':(colon)', ';(semicolon)'),
(7, 1, 'In PHP Language variables name starts with ?', '!(Exclamation)', '&(Ampersand)', '*(Asterisk)', '$(Dollar)', '$(Dollar)'),
(8, 1, 'What is the use of strlen() function in PHP?', 'It returns the type of a string\r\n', 'It returns the value of a string', 'It returns the length of a string', 'It returns the subset value of a string', 'It returns the length of a string'),
(9, 1, 'Which of the following is the Concatenation Operator in PHP?', '+', '.', '&', '%', '.'),
(10, 1, 'Which of the following is not PHP Loops?', 'while', 'do while', 'for', 'do for', 'do for'),
(11, 1, 'What is the use of strpos() function in PHP?', 'Search for a number within a string', 'Search for a Spaces within a string', 'Search for a character/text within a string', 'Search for a Capitalized string/text with in a string', 'Search for a character/text within a string'),
(13, 2, 'Client-Server requests are initiated by:', 'The Client', 'The Server', 'XHTML', 'HTML 4.01', 'None of these'),
(14, 2, 'Javascript is', 'A subset of Java', 'Fixed type', 'Statically typed', 'Dynamically typed', 'None of these'),
(15, 2, 'Javascript is generally agreed to be object-oriented', 'True', 'False', 'Maybe', 'I don\'t know', 'False'),
(16, 2, 'Javascript the \"this\" keyword (Choose one):', 'refers to the entire HTML tag for the current object', 'to the name field in the HTML tag for the current object', 'to the name field in the HTML tag for the current object', 'None of these', 'to the name field in the HTML tag for the current object'),
(17, 2, 'MIME (Check all that apply)', 'Was originally developed for email', 'Is used to specify to the browser the form of the file returned by the server', 'Is part of the HTTP protocol', 'None of these', 'Is part of the HTTP protocol'),
(18, 2, 'Which is the correct CSS syntax?', 'body:color=black', '{body;color:black}', '{body:color=black(body}', 'body {color: black}', 'body {color: black}'),
(19, 2, 'How do you insert a comment in a CSS file?', 'this is a comment', '/* this is a comment */', '-- this is a comment', '<@ this is a comment @>', '/* this is a comment */'),
(21, 2, 'How can you make a list that lists the items with numbers? ', 'ol', 'dl', 'ul', 'li', 'ol'),
(22, 2, 'Choose the correct HTML tag for the largest heading', 'head', 'h1', 'h6', 'header', 'h1'),
(23, 2, 'The attribute of \"form\" tag', 'Method', 'Action', 'Both (a)&(b)', 'None of these', 'Method');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `id` int(10) NOT NULL,
  `quiz_id` int(4) NOT NULL,
  `candidiate_name` varchar(200) NOT NULL,
  `correct_answer` int(4) NOT NULL,
  `incorrect_answer` int(4) NOT NULL,
  `not_answerd` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz_list`
--
ALTER TABLE `quiz_list`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_quesrions`
--
ALTER TABLE `quiz_quesrions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz_list`
--
ALTER TABLE `quiz_list`
  MODIFY `quiz_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_quesrions`
--
ALTER TABLE `quiz_quesrions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
