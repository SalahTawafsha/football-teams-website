
CREATE TABLE `player` (
  `player_name` varchar(32) NOT NULL,
  `team_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `team` (
  `name` varchar(64) NOT NULL,
  `skill_level` int(11) NOT NULL,
  `game_day` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `user` (
  `name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


ALTER TABLE `player`
  ADD PRIMARY KEY (`player_name`,`team_name`),
  ADD KEY `team_name` (`team_name`);

ALTER TABLE `team`
  ADD PRIMARY KEY (`name`),
  ADD KEY `email` (`email`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);


ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`team_name`) REFERENCES `team` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
