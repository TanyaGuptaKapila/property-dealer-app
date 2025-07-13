CREATE TABLE
    IF NOT EXISTS dealers(id INT AUTO_INCREMENT PRIMARY KEY, NAME VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, phone VARCHAR(20), agency_name VARCHAR(255), location VARCHAR(255), created_at DATETIME DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE
    IF NOT EXISTS ads(id INT AUTO_INCREMENT PRIMARY KEY, dealer_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT, price VARCHAR(50), type VARCHAR(50), category VARCHAR(50), location VARCHAR(255), IMAGE VARCHAR(255), created_at DATETIME DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (dealer_id) REFERENCES dealers(id) ON DELETE CASCADE);

CREATE TABLE
    IF NOT EXISTS interests(id INT AUTO_INCREMENT PRIMARY KEY, ad_id INT NOT NULL, dealer_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (ad_id) REFERENCES ads(id) ON DELETE CASCADE, FOREIGN KEY (dealer_id) REFERENCES dealers(id) ON DELETE CASCADE);

ALTER TABLE dealers
    ADD COLUMN IF NOT EXISTS profile_picture VARCHAR(255) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS STATE VARCHAR(100) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS country VARCHAR(100) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS office_address VARCHAR(255) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS instagram_link VARCHAR(255) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS facebook_link VARCHAR(255) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS youtube_link VARCHAR(255) DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS whatsapp_number VARCHAR(20) DEFAULT NULL;

CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,dealer_id INT NOT NULL
    ,transaction_type ENUM('Sell', 'Rent/Lease', 'PG') NOT NULL
    ,property_type VARCHAR(255) NOT NULL
    ,availability ENUM('Ready to move', 'Under construction') NOT NULL
    ,ownership ENUM('Freehold', 'Leasehold', 'Co-operative society', 'Power of Attorney') NOT NULL
    ,transaction_status ENUM('Resale', 'New') DEFAULT 'Resale'
    ,title VARCHAR(255)
    ,description TEXT
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (dealer_id) REFERENCES dealers(id)
);

CREATE TABLE property_location (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,city VARCHAR(255)
    ,locality VARCHAR(255)
    ,sub_locality VARCHAR(255)
    ,apartment_society VARCHAR(255)
    ,house_no VARCHAR(255)
    ,latitude DECIMAL(10, 7)
    ,longitude DECIMAL(10, 7)
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_area_details (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,carpet_area DECIMAL(10, 2)
    ,builtup_area DECIMAL(10, 2)
    ,super_builtup_area DECIMAL(10, 2)
    ,area_unit ENUM('sq.ft.', 'sq.m.')
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_room_details (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,bedrooms INT
    ,bathrooms INT
    ,balconies INT
    ,furnishing ENUM('Fully Furnished', 'Semi Furnished', 'Unfurnished')
    ,parking ENUM('Covered', 'Open', 'None')
    ,facing VARCHAR(255)
    ,open_sides INT
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_floor_details (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,total_floors INT
    ,property_on_floor INT
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_pricing_details (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,expected_price DECIMAL(15, 2)
    ,price_per_sqft DECIMAL(15, 2)
    ,price_in_words VARCHAR(255)
    ,is_inclusive_price BOOLEAN DEFAULT 0
    ,tax_excluded BOOLEAN DEFAULT 0
    ,price_negotiable BOOLEAN DEFAULT 1
    ,additional_pricing JSON
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_features (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,feature VARCHAR(255)
    ,authority_approved ENUM('Yes', 'No') DEFAULT 'No'
    ,possession VARCHAR(255)
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_media (
    id INT AUTO_INCREMENT PRIMARY KEY
    ,property_id INT NOT NULL
    ,media_type ENUM('image', 'video')
    ,file_path VARCHAR(255)
    ,sort_order INT DEFAULT 0
    ,FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);
