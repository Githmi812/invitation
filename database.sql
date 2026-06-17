-- ============================================
--  Nuthara & Chamila Wedding – Database Setup
-- ============================================

CREATE DATABASE IF NOT EXISTS wedding_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE wedding_db;

CREATE TABLE IF NOT EXISTS rsvp (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(120)  NOT NULL,
  phone       VARCHAR(30)   NOT NULL,
  guests      TINYINT       NOT NULL DEFAULT 1,   -- total people coming (incl. themselves)
  message     TEXT,
  created_at  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ip          VARCHAR(45)   DEFAULT NULL
) ENGINE=InnoDB;

-- Quick view: total confirmed guests
CREATE OR REPLACE VIEW rsvp_summary AS
SELECT
  COUNT(*)        AS total_rsvps,
  SUM(guests)     AS total_guests,
  MAX(created_at) AS last_rsvp_at
FROM rsvp;
