-- AWRMS sample SQL schema
CREATE DATABASE IF NOT EXISTS awrms CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE awrms;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'DJ',
  must_change_password TINYINT(1) DEFAULT 1
);

CREATE TABLE IF NOT EXISTS media_files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  filename VARCHAR(255) NOT NULL,
  path VARCHAR(512) NOT NULL,
  duration INT DEFAULT 0,
  artist VARCHAR(255),
  title VARCHAR(255),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS playlists (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS playlist_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  playlist_id INT NOT NULL,
  media_id INT NOT NULL,
  pos INT DEFAULT 0,
  FOREIGN KEY (playlist_id) REFERENCES playlists(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS schedule (
  id INT AUTO_INCREMENT PRIMARY KEY,
  playlist_id INT NOT NULL,
  start_time DATETIME NOT NULL,
  recurrence VARCHAR(50) DEFAULT 'none'
);

CREATE TABLE IF NOT EXISTS analytics (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  listeners INT DEFAULT 0,
  track_id INT
);

-- default admin user (password 'admin' hashed by PHP's password_hash; we'll insert plaintext marker)
INSERT INTO users (username, password, role, must_change_password) VALUES ('admin', 'admin', 'Admin', 1);
