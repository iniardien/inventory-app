CREATE TABLE `users` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`name` VARCHAR(50) NOT NULL,
	`username` VARCHAR(50) NOT NULL,
	`password` VARCHAR(100),
	PRIMARY KEY(`id`)
);


CREATE TABLE `barang` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`kategori_id` INTEGER,
	`kode_barang` BIGINT,
	`nama_barang` VARCHAR(100),
	`satuan` VARCHAR(10),
	`stock` BIGINT,
	`keterangan` VARCHAR(255) NOT NULL,
	PRIMARY KEY(`id`)
);


CREATE TABLE `kategori` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`nama_kategori` VARCHAR(50),
	PRIMARY KEY(`id`)
);


CREATE TABLE `barang_masuk` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`barang_id` INTEGER,
	`user_id` INTEGER,
	`tanggal_masuk` DATE,
	`jumlah` BIGINT,
	PRIMARY KEY(`id`)
);


CREATE TABLE `barang_keluar` (
	`id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`barang_id` INTEGER,
	`user_id` INTEGER,
	`tanggal_keluar` DATE,
	`jumlah` BIGINT,
	PRIMARY KEY(`id`)
);


ALTER TABLE `barang`
ADD FOREIGN KEY(`kategori_id`) REFERENCES `kategori`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `barang_masuk`
ADD FOREIGN KEY(`barang_id`) REFERENCES `barang`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `barang_masuk`
ADD FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `barang_keluar`
ADD FOREIGN KEY(`barang_id`) REFERENCES `barang`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `barang_keluar`
ADD FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;