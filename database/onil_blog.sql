-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2023 at 06:09 AM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aarahin_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL,
  `cat_image` text NOT NULL,
  `cat_status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `cat_desc`, `cat_image`, `cat_status`) VALUES
(19, 'Fashion', '<p>Jennie Launches Her&nbsp; <a href=\"https://aarahin.com/elah\" target=\"_blank\"><strong>Elah </strong></a>Collection with Jungkookj in Seoul</p>\r\n', '93713-elah.jpg', 1),
(24, 'Web Design', '<p>Web design is&nbsp;<strong>the process of planning, conceptualizing, and arranging content online</strong>. Today, designing a website goes beyond aesthetics to include the website&#39;s overall&nbsp;</p>\r\n', '', 0),
(54, 'test', '', '19871-Screenshot_1.jpg', 0),
(59, 'Design', '<p>Web design is&nbsp;<strong>the process of planning, conceptualizing, and arranging content online</strong>. Today, designing</p>\r\n\r\n<p>a website goes beyond aesthetics to include the website&#39;s overall functionality. Web design also includes web apps, mobile apps, and user interface design.</p>\r\n', '19322-cryptiva.jpg', 1),
(60, 'Technical', '<p>In publishing &amp;graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final&nbsp;</p>\r\n', '93853-izzy.jpg', 1),
(61, 'Education', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, repellendus. Sunt tenetur optio commodi .</p>\r\n', '97677-email-temlate.jpg', 1),
(62, 'Sports', '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus, voluptas.</p>\r\n', '99311-io.jpg', 1),
(63, 'Political', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, minima debitis.</p>\r\n\r\n<p>galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>\r\n', '1838-nbook.jpg', 1),
(64, 'dfgfgfdg', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmt_date` date NOT NULL DEFAULT current_timestamp(),
  `date_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comments`, `post_id`, `user_id`, `cmt_date`, `date_time`) VALUES
(248, 'Hello', 8, 109, '2023-06-11', '01-Aug-2023 08:38pm'),
(251, 'HI', 9, 110, '2023-06-11', '07-Aug-2023 08:38pm'),
(252, 'Hello everyone!', 9, 1, '2023-06-11', '08-Aug-2023 04:38pm'),
(280, 'How are you!', 11, 56, '2023-06-18', '08-Aug-2023 05:38am'),
(281, 'Enjoy', 3, 11, '2023-06-18', '03-Aug-2023 08:38pm'),
(292, 'hello', 12, 1, '2023-08-09', '08-Aug-2023 08:38pm');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thaumbnail` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `meta_tag` text NOT NULL,
  `post_status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `thaumbnail`, `category_id`, `author_id`, `post_date`, `meta_tag`, `post_status`) VALUES
(2, 'Full Stack Web ', '<p>It is a long established</p>\r\n\r\n<p>fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less</p>\r\n\r\n<p>normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages</p>\r\n\r\n<p>f type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containf type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets contain</p>\r\n\r\n<p>tes still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', '17736-cryptiva.jpg', 60, 1, '2023-05-14', 'html, css, javascript, php', 0),
(3, ' The English football terms you need to ', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes&nbsp; sometimes on purpose (injected humour and the like).</p>\r\n', '80223-f.jpg', 62, 1, '2023-05-14', 'football, sport', 1),
(4, 'Prime Minister of Bangladesh', '<p>Sheikh Hasina Wazed is a prominent Bangladeshi politician who has been serving as the Prime Minister of the People&rsquo;s Republic of Bangladesh since January 2009. She is the longest-serving prime minister in the history of Bangladesh, having previously served as the country&#39;s prime minister</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>\r\n\r\n<p>but also the leap into electronic typesetting, remaining essentially unchange</p>\r\n', '87170-s.png', 63, 1, '2023-05-14', 'Awamliq   ,political', 1),
(5, 'We are learning PHP & MySQL', '<p>Judging by how quickly technology has evolved over the past few decades, it&rsquo;s hard to believe there was a time that existed before things like the Internet and smartphones. Everything has a beginning. And the beginning of programming languages might just surprise you.</p>\r\n\r\n<p>Let&rsquo;s take a look at a short history of coding before we dive into what some of the most popular programming languages are in 2022.&nbsp;</p>\r\n\r\n<p>Judging by how quickly technology has evolved over the past few decades, it&rsquo;s hard to believe there was a time that existed before things like the Internet and smartphones. Everything has a beginning. And the beginning of programming languages might just surprise you.Let&rsquo;s take a look at a short history of coding before we dive into popular programming languages are in 2022.&nbsp;</p>\r\n', '85108-c.jpg', 60, 1, '2023-05-14', 'html, css, javascript, php,laravel', 1),
(6, 'Bangladesh Vs Ireland Cricket Match', '<p>In publishing&nbsp; Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface&nbsp;</p>\r\n\r\n<p>In publishing&nbsp; Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface&nbsp;&nbsp;In publishing&nbsp; Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface</p>\r\n\r\n<p>In publishing&nbsp; Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface&nbsp;&nbsp;In publishing&nbsp; Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface</p>\r\n', '72045-bangladesh-gfx.jpg', 62, 1, '2023-05-14', 'cricket, sport', 1),
(8, '14 Amazing Website Designs Made With WordPress', '<p><strong>In this post,</strong> we&rsquo;re happy to give you a taste of what is out there. We&rsquo;re going to share 14 different websites that are made with WordPress as their content</p>\r\n\r\n<p>management system. Although each website might be a different type, they do have one this in common; they&rsquo;re all amazing website designs that leave a great impression on you.</p>\r\n', '14877-hoobank.jpg', 59, 11, '2023-05-15', 'html,css', 1),
(9, 'Barcelona Vs Real Madrid ', '<p>It&#39;s five and a half years since the two clubs last met in a final. That was also in the Super Cup back in the days when it was a two-legged affair. Madrid won that one. In fact, in seven Super Cup finals against the all-whites, Bar&ccedil;a have only emerged victorious once, in 2011, which was also the last time they beat their eternal rivals in any kind of final.</p>\r\n\r\n<p>When it comes to Copa del Rey Finals, matters are more tightly matched. Real Madrid are still top overall, with 4 victories over Bar&ccedil;a compared to three for the Catalans 1967/68 (1-0), 1982/83 (2-1) and 1989/90 (2-0). On Sunday, they&#39;ll be going for each other again in what promises to be a gripping encounter on Saudi Arabian soil.&nbsp;</p>\r\n\r\n<p>o Copa del Rey Finals, matters are more tightly matched. Real Madrid are still top 1982/83 (2-1) and 1989/90 (2-0). On Sunday, they&#39;ll be going for each other again in what promises to be a gripping encounter on Saudi Arabian soil.&nbsp;</p>\r\n', '78686-images.jpeg', 62, 11, '2023-05-22', 'football,sport', 1),
(10, 'Educational Beliefs of Higher Education', '<p>Education is the transmission of knowledge, skills, and character traits. There are many debates about its precise definition, for example, about which aims it tries to achieve. A further issue is whether part of the meaning of education is that some form of&nbsp;whether they are beliefs about religion, education,</p>\r\n\r\n<p>All teachers and students hold a range of beliefs &ndash; whether they are beliefs about religion, education, health, politics or a multitude of other topics. When combined,&nbsp;<strong>teachers&#39; and students&#39; beliefs about teaching and learning</strong>&nbsp;are often referred to as educational beliefs.</p>\r\n', '78925-edu.jpg', 61, 11, '2023-05-23', 'education', 1),
(11, 'Web Design & Development', '<p>PHP is a general-purpose scripting language geared toward web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1993 and released in 1995. The PHP reference implementation is now produced by The PHP Group.</p>\r\n\r\n<p>Designed by:&nbsp;Rasmus Lerdorf</p>\r\n\r\n<p>First appeared:&nbsp;8 June 1995; 27 years ago</p>\r\n\r\n<p>Implementation language:&nbsp;C&nbsp;(primarily; some components&nbsp;C++)</p>\r\n\r\n<p>Paradigm:&nbsp;Multi-paradigm:&nbsp;imperative, functional, object-oriented,&nbsp;procedural, reflective</p>\r\n\r\n<p>Stable release:&nbsp;8.2.6 / 9 May 2023; 9 days ago</p>\r\n\r\n<p>Typing discipline:&nbsp;Dynamic, weak, gradual</p>\r\n\r\n<p><em>PHP</em>&nbsp;is a server side scripting language that is embedded in HTML. It is used to manage dynamic content, databases, session tracking, even build entire e</p>\r\n', '40317-elah.jpg', 60, 1, '2023-05-23', 'php,laravel', 1),
(12, '3 Benefits Showing Why Education Is Important', '<p><strong>1. Creating More Employment Opportunities</strong></p>\r\n\r\n<p>Finding a job is not easy, especially in times of economic turmoil. You often need to compete with hundreds of other candidates for a vacant position. In addition, the lower the education level, the greater the number of people applying for the same low-paying entry-level post. However, with the right qualifications and educational background, you will increase your chances of landing a fulfilling job. Would you like to find a way to stand out from a pool of applicants? Learn, educate yourself, graduate and get as many qualifications, skills, knowledge, and experience as possible.&nbsp;</p>\r\n\r\n<p><strong>2. Securing a Higher Income</strong></p>\r\n\r\n<p>People with higher education and varied experience are more likely to&nbsp;<a href=\"https://totempool.com/blog/high-income-skills/\" target=\"_blank\">get high-paying</a>, expert jobs. Study hard, dedicate your time and effort to acquire knowledge and reach a high level of competence if you would like to lead a comfortable lifestyle. Your credentials are what will motivate a potential employer to choose you instead of another candidate. Studying hard throughout your school and studies shows you are not afraid of hard work and are able to fulfill your goals. Employers see this as a huge advantage as they all prefer a responsible and knowledgeable workforce. Once you graduate, you can start searching for jobs that will give you the opportunity to practice what you have learned and, at the same time, secure sufficient pay for your needs.&nbsp;</p>\r\n\r\n<p><strong>3. Developing Problem-solving Skills&nbsp;</strong></p>\r\n\r\n<p>One of the benefits of education&nbsp;is that the educational system teaches us how to obtain and develop critical and logical thinking and make independent decisions. When children become adults, they are faced with a lot of challenging issues &ndash; pay off your student loans, get a job, buy a car and a house, provide for your family, etc. However, if one has spent years educating themselves, they should be able to make sound decisions on these various quandaries. Not only are people able to form their own opinions, but they are also good at finding solid and reliable arguments and evidence to back up and confirm their decisions.&nbsp;</p>\r\n', '9662-b.jpg', 61, 1, '2023-05-23', '   education , science  ', 1),
(13, 'Web Application ', '<p>Hello! Looking for web designer to help me update photos, colors and text to a simple landing page design made in WordPress (Using Elementor) Scope: - Check attachment called &quot;New design&quot;, this should replace current elements on site (Please check &quot;Current site&quot; attachment. - The new design should &hellip;</p>\r\n', '30741-iteck.jpg', 60, 1, '2023-05-28', 'php laravel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersinfo`
--

CREATE TABLE `usersinfo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `phone` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=User',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=inactive',
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersinfo`
--

INSERT INTO `usersinfo` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `image`) VALUES
(1, 'Rahin Ahmed', 'ahmedrahin660@gmail.com', 'cfa1150f1787186742a9a884b73a43d8cf219f9b', '01887497149', '', 1, 1, '66467-me.jpg'),
(11, 'Rabby khan', 'rabby@gmail.com', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', '018859409', 'Dhaka', 1, 1, '56574-2.jpg'),
(56, 'Mehjabin Hossain', 'mehjabin@gmail.com', 'f3226f91f77a87d909b8920adc91f9a301a7316b', '09308291', 'Sonagazi', 2, 1, '14312-1.png'),
(102, 'Sayed Ibnul', 'sayed@gmail.com', '9a900f538965a426994e1e90600920aff0b4e8d2', '', '', 2, 1, '79759-2.png'),
(103, 'Onil', 'onil@gmail.com', '9dce7f7468503cfb65f35abf2d5f711beb8c9260', NULL, NULL, 2, 1, NULL),
(104, 'Sadia Mariam', 'sadia@gmail.com', 'ed70c57d7564e994e7d5f6fd6967cea8b347efbc', '', '', 2, 1, '4983-f4.jpg'),
(106, 'Tunan', 'tunan@gmail.com', 'ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', '0989293', '', 2, 1, '25460-attorney-andres-lope.jpg'),
(107, 'Hritik', 'hritik@gmail.com', '8effee409c625e1a2d8f5033631840e6ce1dcb64', '', '', 2, 1, '52106-review.png'),
(108, 'Abdul hai', 'abdul@gmail.com', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', NULL, NULL, 2, 1, '75797-lopez.jpg'),
(109, 'Faisal Hamid Hemal', 'faisal@gmail.com', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', '', '', 2, 1, '85661-3.png'),
(110, 'Faisal Hamid Hemal', 'faisal@gmail.com', '12c6fc06c99a462375eeb3f43dfd832b08ca9e17', '', '', 2, 1, '65871-3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersinfo`
--
ALTER TABLE `usersinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usersinfo`
--
ALTER TABLE `usersinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
