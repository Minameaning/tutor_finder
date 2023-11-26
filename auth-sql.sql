CREATE TABLE tutor_admin (
    user_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    PRIMARY KEY (user_id)
);

CREATE TABLE tutor_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    experience VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    subjects VARCHAR(255),
    rate DECIMAL(5,2),
	image VARCHAR(255),
    availability TEXT,
    created_by INT,
    FOREIGN KEY (user_id) REFERENCES tutor_admin(user_id), -- 
    FOREIGN KEY (created_by) REFERENCES tutor_admin(user_id)
);
