CREATE DATABASE frozenfooddb;
USE frozenfooddb;

CREATE TABLE category (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB;

CREATE TABLE product (
  product_id INT AUTO_INCREMENT PRIMARY KEY,
  sku VARCHAR(64) NOT NULL UNIQUE,
  name VARCHAR(200) NOT NULL,
  category_id INT NOT NULL,
  description TEXT,
  unit VARCHAR(50) NOT NULL DEFAULT 'pc', -- pc/box/kg
  default_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  active BOOLEAN NOT NULL DEFAULT TRUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES category(category_id) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB;

CREATE TABLE product_variant (
  variant_id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  variant_name VARCHAR(150), -- e.g. "30g (mini)", "500g (pack)"
  barcode VARCHAR(128),
  price DECIMAL(10,2) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (product_id) REFERENCES product(product_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE supplier (
  supplier_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  contact_name VARCHAR(150),
  phone VARCHAR(50),
  email VARCHAR(150),
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE storage_location (
  location_id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(50) UNIQUE,
  name VARCHAR(150),
  temp_range VARCHAR(50), -- e.g. "-18C"
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE stock_batch (
  batch_id INT AUTO_INCREMENT PRIMARY KEY,
  variant_id INT NOT NULL,
  supplier_id INT NULL,
  batch_code VARCHAR(100) NOT NULL,
  quantity INT NOT NULL DEFAULT 0, -- jumlah unit dalam batch
  quantity_available INT NOT NULL DEFAULT 0,
  received_date DATE,
  freeze_date DATE,
  expiry_date DATE,
  storage_location_id INT,
  cost_price DECIMAL(10,2) DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (variant_id) REFERENCES product_variant(variant_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (storage_location_id) REFERENCES storage_location(location_id) ON UPDATE CASCADE ON DELETE SET NULL,
  INDEX (variant_id),
  INDEX (batch_code)
) ENGINE=InnoDB;

CREATE TABLE stock_movement (
  movement_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  batch_id INT,
  variant_id INT NOT NULL,
  movement_type ENUM('IN','OUT','ADJUST','TRANSFER') NOT NULL,
  qty INT NOT NULL,
  reference VARCHAR(200), -- e.g. purchase_no / order_no / adjust reason
  note TEXT,
  created_by VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (batch_id) REFERENCES stock_batch(batch_id) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (variant_id) REFERENCES product_variant(variant_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE customer (
  customer_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  phone VARCHAR(50),
  email VARCHAR(150),
  default_address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE customer_address (
  address_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  address_label VARCHAR(100),
  address TEXT,
  phone VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Sales (
  order_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  order_no VARCHAR(50) NOT NULL UNIQUE,
  customer_id INT,
  order_status ENUM('PENDING','CONFIRMED','PACKED','SHIPPED','DELIVERED','CANCELLED','REFUNDED') DEFAULT 'PENDING',
  total_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  shipping_fee DECIMAL(10,2) DEFAULT 0.00,
  payment_status ENUM('UNPAID','PAID','REFUNDED') DEFAULT 'UNPAID',
  placed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  notes TEXT,
  shipping_address TEXT,
  created_by VARCHAR(100),
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON UPDATE CASCADE ON DELETE SET NULL,
  INDEX (order_status, placed_at)
) ENGINE=InnoDB;

CREATE TABLE order_item (
  order_item_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  order_id BIGINT NOT NULL,
  variant_id INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  qty INT NOT NULL,
  subtotal DECIMAL(12,2) NOT NULL,
  batch_id INT DEFAULT NULL,
  FOREIGN KEY (order_id) REFERENCES Sales(order_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (variant_id) REFERENCES product_variant(variant_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (batch_id) REFERENCES stock_batch(batch_id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE purchase (
  purchase_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  purchase_no VARCHAR(50) NOT NULL UNIQUE,
  supplier_id INT,
  total_amount DECIMAL(12,2) DEFAULT 0.00,
  received_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_by VARCHAR(100),
  status ENUM('DRAFT','RECEIVED','CANCELLED') DEFAULT 'DRAFT',
  note TEXT,
  FOREIGN KEY (supplier_id) REFERENCES supplier(supplier_id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;


CREATE TABLE purchase_item (
  purchase_item_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  purchase_id BIGINT NOT NULL,
  variant_id INT NOT NULL,
  batch_code VARCHAR(100),
  qty INT NOT NULL,
  cost_price DECIMAL(10,2) DEFAULT 0.00,
  expiry_date DATE,
  received_date DATE,
  FOREIGN KEY (purchase_id) REFERENCES purchase(purchase_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (variant_id) REFERENCES product_variant(variant_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE payment (
  payment_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  order_id BIGINT,
  amount DECIMAL(12,2) NOT NULL,
  method ENUM('CASH','BANK_TRANSFER','CARD','E-WALLET') DEFAULT 'BANK_TRANSFER',
  paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  note TEXT,
  FOREIGN KEY (order_id) REFERENCES Sales(order_id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;


CREATE TABLE employee (
  employee_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  full_name VARCHAR(200),
  role ENUM('ADMIN','WAREHOUSE','SALES','ACCOUNT','MANAGER') DEFAULT 'WAREHOUSE',
  phone VARCHAR(50),
  email VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE audit_log (
  log_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  entity VARCHAR(100),
  entity_id VARCHAR(100),
  action VARCHAR(100),
  summary TEXT,
  created_by VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

