 
CREATE TABLE houses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    location VARCHAR(100),
    availability VARCHAR(100),
    price DECIMAL(10,2)
);

 
CREATE TABLE house_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    house_id INT,
    image_url TEXT,
    FOREIGN KEY (house_id) REFERENCES houses(id) ON DELETE CASCADE
);

 
CREATE TABLE amenities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE
);

 
CREATE TABLE house_amenities (
    house_id INT,
    amenity_id INT,
    FOREIGN KEY (house_id) REFERENCES houses(id) ON DELETE CASCADE,
    FOREIGN KEY (amenity_id) REFERENCES amenities(id) ON DELETE CASCADE,
    PRIMARY KEY (house_id, amenity_id)
);

 
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

 
INSERT INTO users (username, password)
VALUES ('admin', 'test123');


INSERT INTO amenities (name) VALUES
('3 Schlafzimmer'),
('4 Schlafzimmer'),
('Eigener Steg'),
('Sauna'),
('WLAN'),
('Kamin'),
('Klimaanlage'),
('Whirlpool'),
('Parkplatz'),
('Fitnessraum');

INSERT INTO houses (name, location, availability, price)
VALUES ('Ferienhaus am See', 'Bodensee, Deutschland', '15.07. - 30.08.2023', 120.00);

SET @haus1 := LAST_INSERT_ID();

INSERT INTO house_images (house_id, image_url) VALUES
(@haus1, 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'),
(@haus1, 'https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');

INSERT INTO house_amenities (house_id, amenity_id)
SELECT @haus1, id FROM amenities WHERE name IN ('3 Schlafzimmer', 'Eigener Steg', 'WLAN', 'Klimaanlage', 'Parkplatz');

INSERT INTO houses (name, location, availability, price)
VALUES ('Moderne Waldvilla', 'Schwarzwald, Deutschland', '01.08. - 15.09.2023', 180.00);

SET @haus2 := LAST_INSERT_ID();

INSERT INTO house_images (house_id, image_url) VALUES
(@haus2, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'),
(@haus2, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');

INSERT INTO house_amenities (house_id, amenity_id)
SELECT @haus2, id FROM amenities WHERE name IN ('4 Schlafzimmer', 'Sauna', 'Kamin', 'Whirlpool', 'Fitnessraum');


INSERT INTO houses (name, location, availability, price)
VALUES ('Haus am Ufer', 'Bodensee, Deutschland', '15.07. - 30.08.2023', 120.00);

SET @haus3 := LAST_INSERT_ID();

INSERT INTO house_images (house_id, image_url) VALUES
(@haus3, 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'),
(@haus3, 'https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');

INSERT INTO house_amenities (house_id, amenity_id)
SELECT @haus3, id FROM amenities WHERE name IN ('3 Schlafzimmer', 'Eigener Steg', 'WLAN', 'Klimaanlage', 'Parkplatz');
