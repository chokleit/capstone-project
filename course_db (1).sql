-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 12:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `batch_number` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `course_id`, `batch_number`, `title`, `start`, `end`, `tutor_id`, `course`) VALUES
('I9XzoHjBJ12Y2T2VGWRN', '', '2024-01', 'Basic Computer Education', '2024-11-14', '2024-11-30', 'SOROjc6mE6IKQhCH6o1J', 'JZ3nAqvQ2bniziJnpFIs'),
('l5cEl8y5Xw6XuJEKPavW', 'PrwD4HhxbjGnlwQWkNAn', '2024-02', 'Entering Text', '2024-11-06', '2024-11-20', 'SOROjc6mE6IKQhCH6o1J', 'PrwD4HhxbjGnlwQWkNAn'),
('Hy2j4D0mXHKgFArZ1Fyt', 'CRS-SOR-67451bef4d48', '2024-05', 'testing', '2024-11-19', '2024-11-28', 'SOROjc6mE6IKQhCH6o1J', ''),
('0SIVSoGwkvYqLZjRsgVP', 'CRS-SOR-67451bef4d48', '2024-03', 'testingggg', '2024-11-05', '2024-11-22', 'SOROjc6mE6IKQhCH6o1J', ''),
('CgXaMOOte7pvjKfwqbSm', 'CRS-SOR-674590e3f2b9', '2024-03', 'Basic Computer Education', '2024-11-22', '2024-11-15', 'SOROjc6mE6IKQhCH6o1J', ''),
('HCYUYiqOxrD6Y2Hm1liF', 'CRS-SOR-674590e3f2b9', '2024-03', 'aaa', '2024-11-13', '2024-11-13', 'SOROjc6mE6IKQhCH6o1J', '');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('RJY9zU5KGuOlZJklmBT6', 'JZ3nAqvQ2bniziJnpFIs');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `tutor_id`, `name`, `email`, `number`, `message`) VALUES
('', '', 'Leira Kathleen', 'heeee@gmail.com', 4456644, 'gjtyht'),
('', '', 'Leira Kathleen', 'heeee@gmail.com', 4456644, 'yuyujy');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `lesson_id` varchar(20) NOT NULL,
  `lesson_number` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `tutor_id`, `playlist_id`, `lesson_id`, `lesson_number`, `title`, `description`, `thumb`, `pdf`, `activity`, `date`) VALUES
('x1mXSDa6G7BMkbfvBD2u', 'SOROjc6mE6IKQhCH6o1J', 'JZ3nAqvQ2bniziJnpFIs', '', 0, 'hi', 'jnjjnn', 'rxmRP8ajIKQvOPYCSO0u.png', '', '', '2024-11-06'),
('qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', 'JZ3nAqvQ2bniziJnpFIs', '', 0, 'Sample title', 'this is a samplee', 'bAMRIYs6I9VePTMtxv2c.png', '', '', '2024-11-20'),
('oCw0nTZQGF3P0i6FHzdJ', 'SOROjc6mE6IKQhCH6o1J', 'JZ3nAqvQ2bniziJnpFIs', '', 0, 'Lesson 3', 'this is lesson 3', 'AYH4PnC2J3zgPqIUMatD.png', 'J6zGqZYq3kzA8m4EQod0.pdf', 'Ow3b7vHQe44kN7eVCFJZ.pdf', '2024-11-25'),
('dY2rfDaSPxKsgTxsk13a', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'testing', 'testtt', 'PczLgg33Pvet1SIblKxT.png', '13W3EkkwgTcynK1J7YOn.pdf', 'py2zYOVAXJtJToPlgyg8.pdf', '2024-11-26'),
('bofCheLquebg2ng6KK0G', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'Basic Computer Education', 'hii', '5NYH93nGJnXPYXLAnKwy.png', 'CQMd5hJ1dJe3WURDsKML.pdf', 'On7Nt5Q5IqNwur6OdDCD.pdf', '2024-11-26'),
('0plDfRFgubn2sRf6mrWw', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'Lesson 1', 'this is lesson 1', 'A6DSuZMIzuMSSQ7hDQUw.png', 'DvwvRlcRTuN3gzIvTo9t.pdf', 'HHoVQQGzlDAZkvvTg6r6.pdf', '2024-11-26'),
('5iGiTphssEY9xH34RP1z', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'NC II', 'nc 2', 'adkWVH025J3ZnxJUI3rC.png', 'hNkjw5zQ1j5j9ONWhrSL.pdf', 'nhoH82RqmIya7sa2oDHH.pdf', '2024-11-26'),
('19agSqihjAo9994crLxX', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'NC II', 'testing', '8oyG1QfRYyxXlJXVLRGU.png', 'kEJSLWpeWqg1degl4Gmj.pdf', 'GsWU7w1lwA8d8ylCsZP9.pdf', '2024-11-26'),
('SbAA6CViXRueepN64dpg', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'NC II', 'test', '5ITCv3oxiEBEULpdEvmq.png', 'Nlcxep8qQ6hl06zWf3Ca.pdf', 'b9Y3UMJDrxzVnisoEDhe.pdf', '2024-11-26'),
('EnRV5CiW8sCtaQFuHgFt', 'SOROjc6mE6IKQhCH6o1J', '', '', 0, 'Lesson 1', 'jwdkkds', 'B5ISpWKRy8za7WekZggw.png', 'NcXvU2TlQcdesACwkW1K.pdf', 'MmRxhG1zNaz4Rfc5J2Mn.pdf', '2024-11-26'),
('anHYLl6yAV9uxdFJM7UU', 'SOROjc6mE6IKQhCH6o1J', 'BeqyEx4N9xwvfGUXUoer', '', 0, 'NC II', 'testing', '5D3QnROdbA85gHCIylnD.png', 'TvOSwqlJPSeBFDMOgFwk.pdf', 'iOQscZOSAxUp0Cz36Mab.pdf', '2024-11-26'),
('b7k4WmDnJQi6qt04t3w7', 'SOROjc6mE6IKQhCH6o1J', 'o2GP7lT4s0FpD2JXNzlk', '', 0, 'Lesson 1', 'description', 'ZWA1xNCbU3sDSqSDLXpk.png', 'U40vxtg2QiCAlvIjASDn.pdf', 'Nn5xnc9kRKsTMerlZlzK.pdf', '2024-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` varchar(20) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `batch_number` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_number`, `course_id`, `batch_number`, `fname`, `mname`, `lname`) VALUES
('IDtxoKO9w3yoUCXoeEUF', 'SN20241107', 'I9XzoHjBJ12Y2T2VGWRN', '2024-01', '', '', ''),
('7iX3wQsGA6fXa4y4MDtM', 'SN20241108', '0SIVSoGwkvYqLZjRsgVP', '2024-03', '', '', ''),
('FIRxbZggV5XzDhPx08zZ', 'SN20241109', '0SIVSoGwkvYqLZjRsgVP', '2024-03', '', '', ''),
('3MHzqwVKeCY9jVtHAtdh', 'SN20241110', 'CRS-SOR-67451bef4d48', '2024-03', '', '', ''),
('lXcZJqX0PZUOhboVWskQ', 'SN20241111', '', '2024-01', '', '', ''),
('Y0ee5oSopLPgMhSe1vp2', 'SN20241112', 'CRS-SOR-674590e3f2b9', '2024-03', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `tutor_id`, `content_id`) VALUES
('RJY9zU5KGuOlZJklmBT6', 'SOROjc6mE6IKQhCH6o1J', 'x1mXSDa6G7BMkbfvBD2u'),
('Ojiu1LpaG0eeKS5Xzolf', 'SOROjc6mE6IKQhCH6o1J', 'qpZ4df707oF3osguLmKC');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `course_id`, `tutor_id`, `title`, `description`, `thumb`, `date`, `status`) VALUES
('JZ3nAqvQ2bniziJnpFIs', '', 'SOROjc6mE6IKQhCH6o1J', 'Basic Computer Education', 'MS Word, MS Excel, Powerpoint', 'l4FXBciKVwdHKnxaqtQw.png', '2024-11-06', 'active'),
('JvmDZUkLhED5A2sIReuc', '', 'SOROjc6mE6IKQhCH6o1J', 'Web Development', 'This is for web development', 'qEYIvM2bPu7Gk1a9ikeD.png', '2024-11-25', 'active'),
('BeqyEx4N9xwvfGUXUoer', 'CRS-SOR-67451bef4d48', 'SOROjc6mE6IKQhCH6o1J', 'Computer Programming', 'Computer Programming', '9oOA3AZnhCNqexnOrttq.png', '2024-11-26', 'active'),
('o2GP7lT4s0FpD2JXNzlk', 'CRS-SOR-674590e3f2b9', 'SOROjc6mE6IKQhCH6o1J', 'Keyboard Shortcuts', 'Learn keyboard shortcuts', '1elLptz63RnSw918yySY.png', '2024-11-26', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_progress`
--

CREATE TABLE `student_progress` (
  `id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `lesson_id` varchar(20) NOT NULL,
  `activity_completed` varchar(100) NOT NULL,
  `lesson_completed` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sublesson`
--

CREATE TABLE `sublesson` (
  `id` varchar(20) NOT NULL,
  `lesson_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_number` varchar(20) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `pdf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sublesson`
--

INSERT INTO `sublesson` (`id`, `lesson_id`, `tutor_id`, `content_number`, `thumb`, `title`, `description`, `pdf`) VALUES
('3XdFl5nMCvS8EkTSiMNN', 'x1mXSDa6G7BMkbfvBD2u', 'SOROjc6mE6IKQhCH6o1J', '1', '1.png', 'testing', 'helllooo', ''),
('zUFw06guaCY9xeTF6Y54', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '1', '2.png', 'Lesson 1', 'this is lesson 1', ''),
('LtAl3RJmXO8TF2Jxmsrr', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '2', 'DFUmvP6NMsNp3HLEfBgc.png', 'Lesson 2', 'This is Lesson 2', ''),
('CPZKSQ7jaSloeZQVdEZv', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '3', 'VaaxgP0YfvRsaxm3An5n.jpeg', 'Entering Text', 'this is content for lesson 3', 'b5FxGjbAA1hUG9u4QgyT.pdf'),
('QRbPLgYBI0VW9bixoWPP', '', 'SOROjc6mE6IKQhCH6o1J', '4', 'QLL9AdW6AyxhfyV2iOa9.jpeg', 'Shortcuts', 'Keyboard Shortcuts', '8W3t1Ft623K5R5ewFg4r.pdf'),
('FGXA9SFhkvaEozkoS5qE', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '4', 'xTBgmgtcZcPpc0MAytje.jpeg', 'Shortcuts', 'Keyboard shortcuts', 'avKAqSQr7872IPA34Hi2.pdf'),
('8vADyRPBGAr7keWJdZth', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '5', '8gXPWf8qCCSrA0SH2So2.jpeg', 'try', 'tryyy', '9nOQ6a9LQITSw97ycKUv.pdf'),
('HRqKsPB0cm0LOX4zxVOE', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '6', 'bAjvVzzUuH3pyc8uHBqY.jpeg', 'testing', 'testinggg', 'BHF039WhczFhlZG1Fzld.pdf'),
('EBbVBaMpCiEYfLTwlT5K', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '6', 'OOQKEeMatVFRdN0x2yyv.png', 'pdf', 'testing pdf', 'vnJdHjrStFfaS57XzlyB.pdf'),
('bIs4NjlDoA62irdfsX7c', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '6', 'fNBDMUq3qOrxaZ2CvMbw.png', 'pdf', 'testing pdf', 'PJUi0iiWmVHfI7zdIt1u.pdf'),
('Q1TisfLQFCUtvIrnUMiT', 'qpZ4df707oF3osguLmKC', 'SOROjc6mE6IKQhCH6o1J', '7', '6vTWEp4NIYl3pS0inPSP.jpeg', 'testing again', 'again and again', 'FinTFvnN3TxCSCULr246.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_activities`
--

CREATE TABLE `submitted_activities` (
  `id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `file` varchar(100) NOT NULL,
  `uploaded_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `teacher_number` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactnum` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `teacher_number`, `fname`, `mname`, `lname`, `dob`, `address`, `profession`, `email`, `contactnum`, `password`, `image`) VALUES
('SOROjc6mE6IKQhCH6o1J', '', 'Leira Kathleen', '', '', '0000-00-00', '', 'teacher', 'leirasanagustin@gmai', '', '4b7c4966258c82f98b8bd65a3ac256232927b2f6', 'KhzOQbqKi9TPo3EZzIWm.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactnum` varchar(50) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `batch_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `dob`, `address`, `email`, `contactnum`, `student_number`, `password`, `image`, `batch_number`) VALUES
('v5ywlffk2nnwHqvWOVey', 'Uzzeah Ujanne', 'Loresca', 'Sambile', '2024-11-12', 'kawit,cavite', 'uzeah@gmail.com', 'doggy', 'SN20241101', '6203afb198bf4fd5e9a21546eab98a89f9cb8167', 'FtMEvn2gLSQnFJPOmB3c.png', '2024-2025'),
('p29lPNHLlREX7QFLjYzs', 'Chiro', 'Punzalan', 'San Agustin', '0000-00-00', 'kawit, cavite', '', '093455643', 'SN20241104', '8cb2237d0679ca88db6464eac60da96345513964', 'DL8V7fGjzGsnscY6Erry.png', '2024-2025'),
('sqz3VP8q7xKWoQHy2GR6', 'Chiro', 'Punzalan', 'San Agustin', '2024-11-06', 'kawit, cavite', 'chiroo@gmail.com', '092133', 'SN20241105', '8cb2237d0679ca88db6464eac60da96345513964', 'hY39ed0atPtLXnfcJ2uG.png', '2024-2025'),
('8O7qKye8ibkd8CMoJQyq', 'Jhomer', '', 'Vinzon', '2001-11-01', 'New York', 'jhomer@gmail.com', '09466428070', 'SN20241106', '8cb2237d0679ca88db6464eac60da96345513964', '51YqY8gQgfEZv5doVoig.png', '2024-01'),
('IDtxoKO9w3yoUCXoeEUF', 'Jhomer', '', 'Vinzon', '2001-11-01', 'New York', 'jhomer@gmail.com', '09466428070', 'SN20241107', 'd2bdb88e9d772ecffe6c15414def11dbba0bae4f', '2KNOoEQMWxohbJAhsMIQ.png', '2024-01'),
('7iX3wQsGA6fXa4y4MDtM', 'Leira', 'Punzalan', 'Kathleen', '2024-11-14', 'kawit, cavitec', 'leirasanagustin@gmai', '93455643', 'SN20241108', '8cb2237d0679ca88db6464eac60da96345513964', 'n7NsS6p3c1bP4aY1rG5W.png', '2024-03'),
('FIRxbZggV5XzDhPx08zZ', 'Chiro', 'Punzalan', 'San Agustin', '0000-00-00', 'kawit, cavite', '', '93455643', 'SN20241109', '8cb2237d0679ca88db6464eac60da96345513964', 'TTugowbgDjbAsaLM2pwX.png', '2024-03'),
('3MHzqwVKeCY9jVtHAtdh', 'Chiro', 'Punzalan', 'San Agustin', '0000-00-00', 'kawit, cavite', '', '93455643', 'SN20241110', '6f300d897719dcb374649a8548f23630690cae06', 'XiMYeFZIyCg6qhnzcdAP.png', '2024-03'),
('lXcZJqX0PZUOhboVWskQ', 'Gwen', 'Enriquez', 'Corpuz', '2024-11-01', 'Imus, Cavite', 'gwen@gmail.com', '09466428070', 'SN20241111', '6df5d842569184e9808221e0782b559dba727f8e', '2YKMltXdDFcZnLGa5tWX.png', '2024-01'),
('Y0ee5oSopLPgMhSe1vp2', 'Leira', 'Enriquez', 'Kathleen', '2024-11-05', 'Imus, Cavite', 'leirasanagustin@gmai', '09466428070', 'SN20241112', '5bf82649c8f5401745708119d12ab51dc7e17980', 'PQTKWsb9eZSfJ029wLeb.png', '2024-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD UNIQUE KEY `teacher_number` (`teacher_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `student_number` (`student_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
