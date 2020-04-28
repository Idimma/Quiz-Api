-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2018 at 07:10 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edg`
--

-- --------------------------------------------------------

--
-- Table structure for table `draw1`
--

CREATE TABLE `draw1` (
  `S/N` int(1) DEFAULT NULL,
  `QUESTION` varchar(117) DEFAULT NULL,
  `A` varchar(11) DEFAULT NULL,
  `B` varchar(12) DEFAULT NULL,
  `C` varchar(10) DEFAULT NULL,
  `D` varchar(11) DEFAULT NULL,
  `Answer` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `draw1`
--

INSERT INTO `draw1` (`S/N`, `QUESTION`, `A`, `B`, `C`, `D`, `Answer`) VALUES
(1, 'The point where the x and y axes meet in a graph is called:', 'Cartesian', 'Intersection', 'Plane ', 'Origin', 'D'),
(2, 'Choose the option nearest in meaning to the underlined word.\n\nHer problem was exacerbated by the loss of her father.\n', 'exaggerated', 'solved', 'aggravated', ' infuriated', 'C'),
(3, 'What sum of money will amount to D10,400 in 5 years at 6% simple interest?\n ', 'D8,000.00', 'D10,000.00', 'D12,000.00', 'D16,000.00', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `draw2`
--

CREATE TABLE `draw2` (
  `S/N` int(1) DEFAULT NULL,
  `QUESTION` varchar(148) DEFAULT NULL,
  `A` varchar(11) DEFAULT NULL,
  `B` varchar(9) DEFAULT NULL,
  `C` varchar(12) DEFAULT NULL,
  `D` varchar(11) DEFAULT NULL,
  `Answer` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `draw2`
--

INSERT INTO `draw2` (`S/N`, `QUESTION`, `A`, `B`, `C`, `D`, `Answer`) VALUES
(1, 'Choose the word that is opposite in meaning to the underlined word.<br>\n\nThe warring communities were <u>coerced</u> into negotiating a settlement.\n', 'driven', 'compelled', 'persuaded', 'pressured', 'C'),
(2, 'The sum of two numbers is twice their difference. If the difference of the numbers is p, find the larger of the two numbers\n', 'p/2', '3p/2', '5p/2', '3p', 'B'),
(3, 'Choose the option nearest in meaning to the underlined word.<br>\nSince its <u>inception</u> 1983, the newspaper has attracted thousands of readers.\n', 'renaissance', 'coming', 'commencement', 'publication', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `draw3`
--

CREATE TABLE `draw3` (
  `S/N` int(1) DEFAULT NULL,
  `QUESTION` varchar(183) DEFAULT NULL,
  `A` varchar(13) DEFAULT NULL,
  `B` varchar(11) DEFAULT NULL,
  `C` varchar(36) DEFAULT NULL,
  `D` varchar(23) DEFAULT NULL,
  `Answer` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `draw3`
--

INSERT INTO `draw3` (`S/N`, `QUESTION`, `A`, `B`, `C`, `D`, `Answer`) VALUES
(1, '5/12 of all the students are girls and 1/4 of all the students are girls who take Spanish.<br>What fraction of the girls speak Spanish?', '  5/48', ' 3/7', ' 2/5', ' 3/5', 'D'),
(2, 'Complete this sentence by choosing the option that most suitably fills the space;    For _______ he is a secretary we shall not have correct minutes\n', 'because', 'as long as', 'so long', 'in as much', 'B'),
(3, 'What value of k makes the given expression a perfect square ? M<sup>2</sup> - 8m + k = 0\n', '4', '8', '16', '64', 'C'),
(4, 'Choose the option that best conveys the meaning of the underlined portion in the following sentence;\nThe balance sheet at the end of the business year shows that we <u>broke even</u>\n', ' lost heavily', 'made profit', 'were heavily indebted to our bankers', 'neither lost nor gained', 'D'),
(5, 'If 3log<sub>a</sub> + 5log<sub>a</sub> - 6log<sub>a</sub> = log64, what is a?\n', '4', '8', '16', '32', 'B'),
(6, 'In question below fill the gap with the appropriate option:<br>\nI have stopped writing letters application because I _________ that all the vacancies are filled\n', 'have heard', 'had heard', 'heard', 'hear', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `sn` int(11) DEFAULT NULL,
  `school_name` text,
  `scores` text,
  `passed` text,
  `picked` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`sn`, `school_name`, `scores`, `passed`, `picked`) VALUES
(1, 'OakMan', '0 / 3', 'draw2', ' , , ,');

-- --------------------------------------------------------

--
-- Table structure for table `stage1`
--

CREATE TABLE `stage1` (
  `S/N` int(2) DEFAULT NULL,
  `QUESTION` varchar(210) DEFAULT NULL,
  `A` varchar(39) DEFAULT NULL,
  `B` varchar(36) DEFAULT NULL,
  `C` varchar(39) DEFAULT NULL,
  `D` varchar(42) DEFAULT NULL,
  `Answer` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stage1`
--

INSERT INTO `stage1` (`S/N`, `QUESTION`, `A`, `B`, `C`, `D`, `Answer`) VALUES
(1, 'A trader bought 100 oranges at 5 for N40.00 and sold 20 for N120.00. Find the profit or loss percent?\n', '20% profit', '20% loss', '25% profit', '25% loss', 'D'),
(2, 'Choose the option that best completes the gap.\n\nIfe asked me __________\n', 'what time it was', 'what is it by my time', 'what time is it', 'what time it is', 'A'),
(3, 'The circular diagram in which all the elements have angular representations is called\n', 'bar chart', ' pie chart ', 'pictogram', 'histogram', 'B'),
(4, ' Choose the option that best completes the gap.                                                                                Lami\'s father ........ as a gardener when he was young, but now he is a driver.\n', 'had been working', 'use to work', 'has worked', 'used to work', 'D'),
(5, 'Solve for x in 3(x+2) = 2(x+2).', '-4', '-2', '2', '4', 'B'),
(6, 'In the question below choose the option opposite in meaning to the word underlined: \r\nOjo\'s response <U>infuriated</U> his wife', 'annoyed', 'pleased', 'surprised', 'confused', 'B'),
(7, 'The following are polygons except:', 'triangle', ' quadrilateral', 'heptagon', ' circle', 'D'),
(8, 'Choose the option which is nearest in meaning to the sentences in the following question.                                                                  We visited the home of one boy. That\'s the boy I mean.\n', 'That\'s the boy whom we visited his home', 'That\'s the boy whose home we visited', 'That\'s the boy to whose home we visited', 'That\'s the boy the home of whom we visited', 'B'),
(9, 'The marks of eight students in a test are: 3, 10, 4, 5, 14, 13, 16 and 7. Find the range\n', '16', '14', '13', '11', 'C'),
(10, 'Choose the option that best completes the gap.\n\nWhen his car tyre ......... on the way, he did not know what to do.\n', ' has burst', 'had burst', 'bursted', 'burst', 'D'),
(11, 'Express 1975 correct to 2 significant figures\n', '20', '1,900', '1,980', '2,000', 'D'),
(12, 'Choose the option that best completes the gap.\n\nI wonder how he will ......being absent from school for a long time.\n', 'make in', 'make up', 'make off', 'make out', 'B'),
(13, 'What is the probability of having an odd number in a single toss of a fair die?\n', ' 1/6', ' 1/3', ' 1/2', ' 2/3', 'C'),
(14, 'Choose the expression or word which best complete each sentence:\nThey went to the market and bought a suitcase and .... bag\n', 'a big leather brown', 'a big brown leather', 'a brown big leather', 'a leather big brown', 'B'),
(15, 'Which of these is not a prime number?', '41', '43', '47', '49', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `stage2`
--

CREATE TABLE `stage2` (
  `S/N` int(2) DEFAULT NULL,
  `QUESTION` varchar(190) DEFAULT NULL,
  `A` varchar(31) DEFAULT NULL,
  `B` varchar(29) DEFAULT NULL,
  `C` varchar(22) DEFAULT NULL,
  `D` varchar(33) DEFAULT NULL,
  `Answer` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stage2`
--

INSERT INTO `stage2` (`S/N`, `QUESTION`, `A`, `B`, `C`, `D`, `Answer`) VALUES
(1, 'Choose the option that best conveys the meaning of the underlined portion in the following sentence;\nIn the match against the uplanders team, the sub mariners turned out to be the dark horse', 'played most brilliantly', 'played below their usual form', 'won unexpectedly', 'lost as expected', 'C'),
(2, 'Halima is n years old. Her brother\'s age is 5 years more than half of her age. How old is her brother?\n', 'n/2 + 5/2', 'n/2  -  5', '5  -  n/2', 'n/2  +  5', 'D'),
(3, 'Choose the option that most appropriately completes the sentence;\n\nThe Lagos Trade Fair________ annually.\n', 'are held', ' is held', 'is holding', 'may be holding', 'B'),
(4, 'If 2 times a certain integer is subtracted from five times the integer, the result is 63. Find the integer.\n', '21', '9', '7', '3', 'A'),
(5, 'Choose the option that best conveys the meaning of the underlined portion in the following sentence;\nOnly the small fry get punished for such social misdemeanours\n', 'small boys', 'unimportant people', 'frightened people', 'frivolous people', 'B'),
(6, 'A sales girl gave a change of N1.15 to a customer instead of N1.25. Calculate her percentage error\n', '2.40%', '8.00%', '7%', '10%', 'B'),
(7, 'Choose the option that best completes the gap.\n\nAudu took these actions purely ...... his own career.\n ', 'on furtherance of', 'in furtherance of', 'to furtherance in', 'in furtherance with', 'B'),
(8, 'Points P and Q are respectively 24m north and 7m east of point R\n', '20', '24', '25', '31', 'C'),
(9, 'Choose the word that is opposite in meaning to the underlined word.\n\n\'I do not trust him\', he said, in a rare moment of candour?\n', 'reproach', 'dishonesty', 'frankness', 'fairness', 'B'),
(10, 'a is inversely proportional to b. If a = 16 when b = 1, what is b when a = 8?', '4', '2', '0.5', '-2', 'B'),
(11, 'Choose the expression or word which best complete each sentence:There were so many children ....\n', 'that she couldn\'t feed them all', 'hat she couldn\'t feed', 'than she could feed', 'more than she could feed them all', 'A'),
(12, 'Which of these is not associated with a circle?', 'diagonal', 'tangent', 'segment', 'arc', 'A'),
(13, 'Complete this sentence by choosing the option that most suitably fills the space;  \nIsn\'t it high time you .... your office?\n\n', 'are leaving', 'do leave', 'left', 'did leave', 'C'),
(14, 'On a map, 1cm represent 5km. Find the area on the map that represents 100km?.\n ', '2cm?', '4cm?', ' 8cm?', '20cm?', 'B'),
(15, 'Choose the interpretation that you consider most appropriate for the following sentence.\nJoe is very down to earth. This means that Joe is\n', 'a good farmer', 'rather short', 'practical and sensible', 'rough and dirty', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `stage3`
--

CREATE TABLE `stage3` (
  `S/N` int(2) DEFAULT NULL,
  `QUESTION` varchar(189) DEFAULT NULL,
  `A` varchar(18) DEFAULT NULL,
  `B` varchar(36) DEFAULT NULL,
  `C` varchar(29) DEFAULT NULL,
  `D` varchar(32) DEFAULT NULL,
  `Answer` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stage3`
--

INSERT INTO `stage3` (`S/N`, `QUESTION`, `A`, `B`, `C`, `D`, `Answer`) VALUES
(1, 'Complete this sentence by choosing the option that most suitably fills the space;\nHe went abroad with a view .... a business partner\n', 'to find', 'to be finding', 'to have found', 'to finding', 'D'),
(2, ' The locus of a point which moves with a constant distance from a line |PQ| is a:', 'circle', 'perpendicular line', '         parallel line', 'point', 'C'),
(3, 'Complete this sentence by choosing the option that most suitably fills the space;    His suggestion are completely .... the point and cannot be accepted\n', 'beside', 'under', 'about', 'to', 'A'),
(4, 'If (x + 3)<sup>2</sup> = 225,</br>which of the following could be the value of x - 1?', '13', '12', '-16', '-19', 'D'),
(5, 'Complete this sentence by choosing the option that most suitably fills the space;    Now that Michael has become rich, Nancy has begun to make much of him. This means that Nancy __________\n', 'now values Michael', 'now gets a lot of money from Michael', 'only recently married Michael', 'no longer wants to leave Michael', 'A'),
(6, 'Evaluate (101.5)<sup>2</sup> - (100.5)<sup>2</sup>\n', '1', '20.02', '202', '2020', 'C'),
(7, 'Choose the option that best conveys the meaning of the underlined portion in the following sentence;\nThere is some obvious <u>symmetry</u> in the whole presentation\n', 'confusion', 'excitement', 'orderliness', 'dissatisfaction', 'C'),
(8, 'Find the 8th term of the A.P -3, -1, 1 ......\n', '13', '11', '-8', '-11', 'B'),
(9, 'In the question below choose the option nearest in meaning to the word underlined:\nIf your life is in <u>turmoil</u>, always take courage\n', 'devastation', 'crisis', 'trial', 'tragedy', 'B'),
(10, 'If the hypotenuse of an isosceles right triangle is 10, what is the area of the triangle?', '2.5', '25', '50', '100', 'B'),
(11, 'In the question below fill the gap with the appropriate option :\nAdaobi is contemptuous .... dishonest people\n', 'to', 'at', 'for', 'of', 'D'),
(12, 'Find the quadratic equation whose roots are x = -2 or x = 7\n', 'x? + 2x - 7 = 0', 'x? - 2x + 7 = 0', 'x? + 5x +14 = 0', 'x? - 5x - 14 = 0', 'D'),
(13, 'Complete the following sentence by choosing the option that most suitably fills the space;\nHe went up quickly and returned ....\n', 'fastest', 'fastly', 'in fastness', 'as fast', 'D'),
(14, 'Find the next three terms of the sequence; 0, 1, 1, 2, 3, 5, 8...\n', '13, 19, 23', '9, 11, 13', '11, 15, 19', '13, 21, 34', 'D'),
(15, 'Complete this sentence by choosing the option that most suitably fills the space;     In West Africa the ___________ of sickle cell is about 25 percent\n', 'incident', ' incidence', 'accident', 'accidence', 'B');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
