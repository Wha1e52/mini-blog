CREATE DATABASE IF NOT EXISTS mini_blog;

USE mini_blog;

CREATE TABLE IF NOT EXISTS posts
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(255) NOT NULL,
    subtitle   VARCHAR(255) NOT NULL,
    user_name  VARCHAR(255) NOT NULL,
    img_url    VARCHAR(255) NOT NULL,
    content    TEXT         NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);