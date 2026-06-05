-- Esquema de base de datos para el panel de administración de Marple
-- Compatible con MySQL 8 / MariaDB 10.4+
SET NAMES utf8mb4;

-- Administradores del panel
CREATE TABLE IF NOT EXISTS admins (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  username      VARCHAR(60)  NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Vacantes (Trabaja con nosotros)
CREATE TABLE IF NOT EXISTS jobs (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(160) NOT NULL,
  type        VARCHAR(80)  NOT NULL DEFAULT '',
  place       VARCHAR(120) NOT NULL DEFAULT '',
  description TEXT         NOT NULL,
  sort_order  INT          NOT NULL DEFAULT 0,
  is_active   TINYINT(1)   NOT NULL DEFAULT 1,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Artículos del blog
CREATE TABLE IF NOT EXISTS posts (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  title        VARCHAR(200) NOT NULL,
  category     VARCHAR(80)  NOT NULL DEFAULT '',
  excerpt      VARCHAR(400) NOT NULL DEFAULT '',
  content      MEDIUMTEXT   NOT NULL DEFAULT '',
  image        VARCHAR(255) NOT NULL DEFAULT '',
  published_at DATE         NULL,
  is_active    TINYINT(1)   NOT NULL DEFAULT 1,
  created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Productos de la galería
CREATE TABLE IF NOT EXISTS products (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(160) NOT NULL,
  image      VARCHAR(255) NOT NULL DEFAULT '',
  sort_order INT          NOT NULL DEFAULT 0,
  is_active  TINYINT(1)   NOT NULL DEFAULT 1,
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ajustes clave/valor (contacto, horario, etc.)
CREATE TABLE IF NOT EXISTS settings (
  name  VARCHAR(80) PRIMARY KEY,
  value TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------------
-- Datos semilla (contenido actual del sitio)
-- ---------------------------------------------------------------------------
INSERT INTO jobs (title, type, place, description, sort_order) VALUES
  ('Operario/a de Producción', 'Jornada completa', 'Maipú, RM', 'Operación de líneas de termoformado e inyección, cumpliendo estándares de calidad e inocuidad.', 1),
  ('Técnico/a de Mantención', 'Jornada completa', 'Maipú, RM', 'Mantención preventiva y correctiva de maquinaria industrial de la planta.', 2),
  ('Analista de Calidad e Inocuidad', 'Jornada completa', 'Maipú, RM', 'Control de procesos y aseguramiento de los estándares de seguridad alimentaria.', 3);

INSERT INTO posts (title, category, excerpt, content, image, published_at) VALUES
  ('Termoformado vs. inyección: ¿qué proceso conviene a tu producto?', 'Procesos', 'Comparamos ambos procesos para ayudarte a elegir la solución más eficiente según tu tipo de envase.', 'Contenido del artículo…', 'assets/img/BLOG-1-600x572.jpg', '2026-05-20'),
  ('Estándares de inocuidad alimentaria en envases plásticos', 'Inocuidad', 'Cómo aseguramos seguridad, calidad y legalidad en cada lote que producimos.', 'Contenido del artículo…', 'assets/img/BLOG-2-600x572.jpg', '2026-04-12'),
  ('Hacia un packaging con menor impacto ambiental', 'Sostenibilidad', 'Nuestras prácticas para minimizar el impacto en cada etapa del proceso productivo.', 'Contenido del artículo…', 'assets/img/BLOG-3-600x572.jpg', '2026-03-03');

INSERT INTO products (name, image, sort_order) VALUES
  ('Potes transparentes', 'assets/img/Pote-transparente-1080x725.jpg', 1),
  ('Potes con etiqueta IML', 'assets/img/Pote-Mantequilla-Margarina_-1-1024x1024.jpg', 2),
  ('Bolsas Doypack flexibles', 'assets/img/Bolsa-Doypack-Flexible_-1080x725.jpg', 3),
  ('Bolsas Pouch', 'assets/img/Bolsa-Pouch-1-1080x725.jpg', 4),
  ('Cucharas dosificadoras', 'assets/img/Cucharas-Dosificadora-25g_roja-1080x725.jpg', 5),
  ('Tapas a medida', 'assets/img/Tapa-Vinagre_-1-1080x725.jpg', 6),
  ('Bandejas termoformadas', 'assets/img/bandeja_galletas_-1080x725.jpg', 7),
  ('Rollos y film flexible', 'assets/img/rollo-1080x725.jpg', 8);

INSERT INTO settings (name, value) VALUES
  ('contact_email',   'contacto@marplechile.cl'),
  ('contact_phone',   '+56 9 9504 2803'),
  ('contact_phone_raw','56995042803'),
  ('contact_address', 'Sta. Marta 1051, Maipú, Región Metropolitana'),
  ('hours_weekday',   '8:00 — 18:00'),
  ('hours_friday',    '8:00 — 16:00'),
  ('hours_weekend',   'Cerrado'),
  ('instagram_url',   'https://www.instagram.com/marpleplasticsolutiongroup/'),
  ('instagram_label', '@marpleplasticsolutiongroup')
ON DUPLICATE KEY UPDATE value = VALUES(value);
