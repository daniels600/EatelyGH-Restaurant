drop database if exists restaurant;

create database restaurant;

use restaurant;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT KEY,
    user_email VARCHAR(30) NOT NULL,
    user_name VARCHAR(60) NOT NULL,
    user_password VARCHAR(265) NOT NULL,
    user_phone VARCHAR(15) NOT NULL,
    user_location VARCHAR(120) DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- insert into users(user_email, user_name, user_password, user_phone) 
-- values ('euge@gmail.com', "Donh", "mom4all", "0903909309");

CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT KEY,
    admin_email VARCHAR(30) NOT NULL,
    admin_password VARCHAR(265) NOT NULL
);
 
CREATE TABLE Restaurants (
    restaurant_id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_email VARCHAR(30) NOT NULL,
    restaurant_password VARCHAR(265) NOT NULL,
    restaurant_address VARCHAR(120) DEFAULT NULL,
    restaurant_latitude VARCHAR(60) NOT NULL,
    restaurant_longitude VARCHAR(60) NOT NULL,
    restaurant_name VARCHAR(60) NOT NULL,
    restaurant_telephone VARCHAR(13) NOT NULL,
    restaurant_opening_time TIME NOT NULL,
    restaurant_closing_time TIME NOT NULL,
    restaurant_description VARCHAR(250) NOT NULL
);

CREATE TABLE menu (
    menu_id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT,
    meal_name VARCHAR(30) NOT NULL,
    meal_price INT NOT NULL,
    meal_image BLOB,
    meal_type VARCHAR(12),
    FOREIGN KEY (restaurant_id)
        REFERENCES Restaurants (restaurant_id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT NOT NULL,
    order_amount INT NOT NULL,
    menu_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    FOREIGN KEY (restaurant_id)
        REFERENCES Restaurants (restaurant_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (menu_id)
        REFERENCES menu (menu_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES users (user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE tables (
    table_id INT AUTO_INCREMENT PRIMARY KEY,
    table_name INT NOT NULL,
    restaurant_id INT,
    capacity INT,
    table_status ENUM('Available', 'Occupied'),
    FOREIGN KEY (restaurant_id)
        REFERENCES Restaurants (restaurant_id)
);
       
CREATE TABLE Reservation (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT NOT NULL,
    user_id INT NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    party_size INT NOT NULL,
    request VARCHAR(200) DEFAULT NULL,
    reservation_status ENUM('Pending', 'Accepted', 'Ended'),
    FOREIGN KEY (restaurant_id)
        REFERENCES Restaurants (restaurant_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES users (user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

        
CREATE TABLE Seating_Arrangement (
    table_id INT,
    reservation_id INT,
    FOREIGN KEY (reservation_id)
        REFERENCES Reservation (reservation_id),
    FOREIGN KEY (table_id)
        REFERENCES tables (table_id)
);

-- insert into Reservation(restaurant_id, user_id, start_time, end_time,party_size, reservation_status) values(1, 1, "18:20",  "18:20", 9, 'Pending');


-- UPDATE Reservation SET reservation_status = 'Pending'  WHERE reservation_id = 1;

-- select * from orders where restaurant_id =1;

-- delete from tables where restaurant_id =1;

-- select * from Restaurants;
-- SELECT * FROM tables WHERE restaurant_id = 1;

-- select * from users;

-- SELECT * FROM menu WHERE restaurant_id = 1 LIMIT 1;
-- INSERT INTO admin(admin_email, admin_password) VALUES
-- ("admin@gmail.com","$2y$10$3th3i5qQ1uKlNOsad5kuFOdQ5zgl.ez/4ojVOdBRlxSsqvDH0jz4m");

-- select * from menu;
-- select * from users;
-- SELECT user_id, user_name, user_password FROM users where user_email = 'user100@gmail.com';

-- INSERT INTO users(user_email, user_name, user_password, user_phone, user_location) VALUES 
-- ('user1@gmail.com','user1','mom4all','0202781133','Adabraka 893 North'),
-- ('user2@gmail.com','user2','mom4all','0202781133','Adabraka 893 North'),
-- ('user3@gmail.com','user3','mom4all','0202781133','Adabraka 893 North'),
-- ('user4@gmail.com','user4','mom4all','0202781133','Adabraka 893 North');

-- SELECT * FROM users;