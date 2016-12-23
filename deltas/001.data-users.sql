TRUNCATE TABLE `messages`;
INSERT INTO `messages` (`message_id`, `user_id`, `header`, `text`, `is_approved`, `date_created`) VALUES
(1, 1, 'Good job', 'Works just fine.', 1, '2016-12-23 14:22:48'),
(2, 3, 'Raw', 'This code could use some improvement', 1, '2016-12-23 14:21:48'),
(3, 2, 'Working on it', 'Just wait a sec!', 1, '2016-12-23 16:10:58'),
(8, 11, 'Finally', 'I''m done with this', 0, '2016-12-23 20:45:40');