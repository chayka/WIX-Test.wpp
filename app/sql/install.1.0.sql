--
-- Table structure for table `tree_nodes`
--

CREATE TABLE IF NOT EXISTS `{prefix}tree_nodes` (
  `node_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `dt_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tree_nodes`
--
ALTER TABLE `{prefix}tree_nodes`
 ADD PRIMARY KEY (`node_id`), ADD KEY `parent_id` (`parent_id`), ADD KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tree_nodes`
--
ALTER TABLE `{prefix}tree_nodes`
MODIFY `node_id` int(11) NOT NULL AUTO_INCREMENT;

