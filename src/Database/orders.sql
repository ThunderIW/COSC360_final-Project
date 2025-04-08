use iwiessle;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    dino_id INT,
    quantity INT,
    date DATE
);

--sample input
--INSERT INTO orders (user_id, dino_id, quantity, date) VALUES
--(1, 101, 3, '2025-03-29'),
--(2, 202, 5, '2025-03-28');
