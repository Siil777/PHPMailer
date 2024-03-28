CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       user_id INT,
                       email VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       name VARCHAR(255) NOT NULL,
                       reset_token_hash VARCHAR(64) NULL DEFAULT NULL,
                       reset_token_expires_at DATETIME NULL DEFAULT NULL,
                       UNIQUE (reset_token_hash),
                       password_hash VARCHAR(255) NOT NULL
);


