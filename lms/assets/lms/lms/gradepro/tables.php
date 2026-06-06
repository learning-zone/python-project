CREATE TABLE IF NOT EXISTS `grade_year_setup` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(75) NOT NULL,
  `exam_sub_name` varchar(50) NOT NULL,
  `per_info` int(3) NOT NULL,
  `mark` int(4) NOT NULL,
  `acc_year` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  `order_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `grade_cat_setup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class` int(3) NOT NULL,
  `title` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `acc_year` int(4) NOT NULL,
  `term` int(4) NOT NULL,
  PRIMARY KEY (`id`)
);