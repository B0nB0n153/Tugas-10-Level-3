CREATE DATABASE `fazztrack`;

CREATE TABLE `produk`(
	`id` INT (11) NOT NULL,
	`nama_produk` VARCHAR (255) NOT NULL,
	`keterangan` VARCHAR(255) NOT NULL,
	`harga` VARCHAR(255) NOT NULL,
	`jumllah` VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
);
