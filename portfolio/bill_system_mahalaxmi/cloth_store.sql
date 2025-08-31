CREATE DATABASE cloth_store;

USE cloth_store;

CREATE TABLE cloths (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cloth_name VARCHAR(255) UNIQUE NOT NULL,
    price_per_meter DECIMAL(10, 2) NOT NULL
);

-- Insert sample cloth data
INSERT INTO cloths (cloth_name, price_per_meter) VALUES
('Cotton', 200.00),
('Silk', 500.00),
('Denim', 300.00),
('Wool', 400.00);
