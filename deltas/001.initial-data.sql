DELETE FROM `users`;
INSERT INTO `users` (`user_id`, `name`, `email`) VALUES
(1, 'John Doe', 'johny@kf8grwe.com'),
(2, 'Admin', 'admin@thisdomain.com'),
(3, 'Max Maiser', 'max.m@pochta.ru'),
(10, 'Mad Max', 'mmmmad@yahoo.com'),
(11, 'Anton', 'the.korotkov@gmail.com');

DELETE FROM `messages`;
INSERT INTO `messages` (`message_id`, `user_id`, `header`, `text`, `is_approved`, `date_created`) VALUES
(1, 1, 'Good job', 'Works just fine.', 1, '2016-12-23 14:22:48'),
(2, 3, 'Raw', 'This code could use some improvement', 1, '2016-12-23 14:21:48'),
(3, 2, 'Working on it', 'Just wait a sec!', 1, '2016-12-23 16:10:58'),
(8, 11, 'Finally', 'I''m done with this', 0, '2016-12-23 20:45:40');