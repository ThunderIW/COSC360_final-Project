create table cart(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    dino_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT current_timestamp() not null,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(dino_id) REFERENCES dino_catalogue(id) ON DELETE CASCADE
);