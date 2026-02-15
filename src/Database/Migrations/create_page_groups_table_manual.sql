-- Page Groups tábla létrehozása manuálisan
-- Ha a php artisan migrate nem működik, ezt futtathatod le közvetlenül

-- SQLite esetén:
CREATE TABLE IF NOT EXISTS page_groups (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL
);

-- MySQL esetén használd ezt:
-- CREATE TABLE IF NOT EXISTS page_groups (
--     id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     slug VARCHAR(255) NOT NULL UNIQUE,
--     created_at TIMESTAMP NULL DEFAULT NULL,
--     updated_at TIMESTAMP NULL DEFAULT NULL,
--     KEY page_groups_slug_index (slug)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PostgreSQL esetén használd ezt:
-- CREATE TABLE IF NOT EXISTS page_groups (
--     id BIGSERIAL PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     slug VARCHAR(255) NOT NULL UNIQUE,
--     created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
--     updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL
-- );
-- CREATE INDEX IF NOT EXISTS page_groups_slug_index ON page_groups(slug);

-- Tesztadat beszúrása
INSERT INTO page_groups (name, slug, created_at, updated_at)
VALUES ('Főoldal csoport', 'fooldal-csoport', datetime('now'), datetime('now'));

-- Ellenőrzés
SELECT * FROM page_groups;

