CREATE TABLE pizza
(
	pizza_id INT UNSIGNED AUTO_INCREMENT,
	title VARCHAR(200) NOT NULL,
	subtitle VARCHAR(200) NOT NULL,
	price VARCHAR(200) NOT NULL,
    last_price VARCHAR(200),
	pizza_img_path VARCHAR(200),
	PRIMARY KEY (pizza_id)
);