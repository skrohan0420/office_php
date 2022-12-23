CREATE TABLE `payment_data` (
  `id` integer,
  `uid` varchar(255),
  `paidDate` datetime,
  `amountPaid` integer,
  `guardianUid` varchar(255)
);

CREATE TABLE `subscription_data` (
  `id` integer,
  `uid` varchar(255),
  `guardianUid` varchar(255),
  `subscriptionType` varchar(255),
  `subscriptionAmount` integer,
  `subscriptionStatus` boolean,
  `subscriptionEndDate` datetime,
  `lastUpdatedOn` datetime,
  `createdOn` datetime
);

CREATE TABLE `guardian_data` (
  `id` integer,
  `uid` varchar(255),
  `name` varchar(255),
  `phoneNumber` numeric,
  `email` varchar(255),
  `password` varchar(255),
  `address` varchar(255),
  `lastUpdatedOn` datetime,
  `createdOn` datetime,
  `subscriptionUid` varchar(255),
  `kidUid` varchar(255)
);

CREATE TABLE `kid_data` (
  `id` integer,
  `uid` varchar(255),
  `name` varchar(255),
  `lastUpdatedOn` datetime,
  `createdOn` datetime,
  `guardianUid` varchar(255)
);

CREATE TABLE `kid_location_data` (
  `id` integer,
  `kidId` varchar(255),
  `longitude` decimal,
  `latitude` decimal,
  `time` datetime,
);
