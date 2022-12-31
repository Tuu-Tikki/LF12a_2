CREATE DATABASE IF NOT EXISTS `energiedaten` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `energiedaten`;
CREATE TABLE `kennwerte` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `einheit` varchar(20) NOT NULL,
  `titel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `kennwerte` (`id`, `name`, `einheit`, `titel`) VALUES
(1, 'solar', 'GW', 'Solar'),
(2, 'wind-onshore', 'GW', 'Wind Onshore'),
(3, 'wind-offshore', 'GW', 'Wind Offshore'),
(4, 'run-of-the-river', 'GW', 'Wasserkraft'),
(5, 'biomass', 'GW', 'Biomasse'),
(6, 'hydro-pumped-storage', 'GW', 'Pumpspeicher'),
(7, 'gas', 'GW', 'Erdgas'),
(8, 'coal', 'GW', 'Steinkolhe'),
(9, 'lignite', 'GW', 'Braunkohle'),
(10, 'uranium', 'GW', 'Kernenergie'),
(11, 'other', 'GW', 'Andere'),
(12, 'total-load', 'GW', 'Stromverbrauch'),
(13, 'conventional-power', 'GW', 'Konv. Kraftwerke'),
(14, 'emission-intensity', 'g/kWh', 'emission-intensity');
CREATE TABLE `werte` (
  `id` int(11) NOT NULL,
  `kennwertIdf` int(11) NOT NULL,
  `unixzeitstempel` varchar(13) NOT NULL,
  `datumzeit` varchar(19) NOT NULL,
  `wert` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `kennwerte`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `werte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kennwertIdf` (`kennwertIdf`);
ALTER TABLE `kennwerte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
ALTER TABLE `werte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
ALTER TABLE `werte`
  ADD CONSTRAINT `werte_ibfk_1` FOREIGN KEY (`kennwertIdf`) REFERENCES `kennwerte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `werte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `einmaligkeit` (`kennwertIdf`,`unixzeitstempel`,`wert`) USING BTREE,
  ADD KEY `kennwertIdf` (`kennwertIdf`);