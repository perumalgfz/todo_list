
--
-- Database: `todo_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo_list`
--

CREATE TABLE `todo_list` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `title` varchar(255) NOT NULL,
  `task` mediumtext NOT NULL,
  `status` int(1) DEFAULT 0 COMMENT '0=Active, 1=Done, 3=Delete ',
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

