CREATE TABLE IF NOT EXISTS dealers (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    agency_name VARCHAR(255),
    location VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE IF NOT EXISTS ads (
                                   id INT AUTO_INCREMENT PRIMARY KEY,
                                   dealer_id INT NOT NULL,
                                   title VARCHAR(255) NOT NULL,
    description TEXT,
    price VARCHAR(50),
    type VARCHAR(50),
    category VARCHAR(50),
    location VARCHAR(255),
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (dealer_id) REFERENCES dealers(id) ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS interests (
                                         id INT AUTO_INCREMENT PRIMARY KEY,
                                         ad_id INT NOT NULL,
                                         dealer_id INT NOT NULL,
                                         created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                                         FOREIGN KEY (ad_id) REFERENCES ads(id) ON DELETE CASCADE,
    FOREIGN KEY (dealer_id) REFERENCES dealers(id) ON DELETE CASCADE
    );
