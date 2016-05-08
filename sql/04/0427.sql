ALTER TABLE `ezi2u`.`my_goods_order` ADD COLUMN `type` smallint(2) NOT NULL AFTER `dateline`, ADD COLUMN `userid` varchar(20) NOT NULL AFTER `type`, ADD COLUMN `useddate` int(10) AFTER `userid`;

ALTER TABLE `ezi2u`.`my_goods_order` CHANGE COLUMN `useddate` `useddate` int(10) NOT NULL,
ADD COLUMN `infoid` int(10) NOT NULL AFTER `useddate`, ADD COLUMN `totalamount` float(10,0) NOT NULL AFTER `infoid`, ADD COLUMN `realamount` float(10,0) NOT NULL AFTER `totalamount`;

ALTER TABLE `ezi2u`.`my_goods_order` CHANGE COLUMN `totalamount` `totalamount` float(10,2) NOT NULL, CHANGE COLUMN `realamount` `realamount` float(10,2) NOT NULL;

ALTER TABLE `ezi2u`.`my_member` CHANGE COLUMN `money_own` `money_own` float(10,2) NOT NULL DEFAULT 0;