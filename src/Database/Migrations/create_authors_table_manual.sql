-- Authors tábla létrehozása manuálisan
-- Ha a php artisan migrate nem működik, ezt futtathatod le közvetlenül

-- SQLite esetén:
CREATE TABLE IF NOT EXISTS authors (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    profile_url VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL
);

-- MySQL esetén használd ezt:
-- CREATE TABLE IF NOT EXISTS authors (
--     id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     profile_url VARCHAR(255) DEFAULT NULL,
--     created_at TIMESTAMP NULL DEFAULT NULL,
--     updated_at TIMESTAMP NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PostgreSQL esetén használd ezt:
-- CREATE TABLE IF NOT EXISTS authors (
--     id BIGSERIAL PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     profile_url VARCHAR(255) DEFAULT NULL,
--     created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
--     updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL
-- );

-- Ellenőrzés - tábla létrejött-e
-- SQLite:
-- .tables

-- MySQL:
-- SHOW TABLES;

-- PostgreSQL:
-- \dt

-- Tesztadat beszúrása
INSERT INTO authors (name, profile_url, created_at, updated_at)
VALUES ('Teszt Szerző', '/storage/media/test.jpg', datetime('now'), datetime('now'));

-- Ellenőrzés
SELECT * FROM authors;

