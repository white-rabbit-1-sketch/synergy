CREATE DATABASE car_sharing_chuloshnikov_m_b;

CREATE TABLE brands
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255) NOT NULL
);

CREATE TABLE models
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255) NOT NULL,
    brand_id integer NOT NULL,
    CONSTRAINT fk_brand_id FOREIGN KEY (brand_id) REFERENCES brands (id)
);

CREATE TABLE cars
(
    id serial NOT NULL PRIMARY KEY,
    vin_number varchar(100) NOT NULL,
    reg_number varchar(255) NOT NULL,
    class varchar(100) NOT NULL,
    model_id integer NOT NULL,
    price numeric(18,2) NOT NULL DEFAULT 0,
    CONSTRAINT fk_model_id FOREIGN KEY (model_id) REFERENCES models (id)
);

CREATE TABLE customers
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    patronymic varchar(100),
    passport_number varchar(30) NOT NULL,
    license_number varchar(100) NOT NULL,
    discount numeric(18,2) DEFAULT 0
);

CREATE TABLE orders
(
    id serial NOT NULL PRIMARY KEY,
    start_time timestamp DEFAULT NOW() NOT NULL,
    end_time timestamp,
    customer_id integer NOT NULL,
    total_amount numeric(18,2) NOT NULL DEFAULT 0,
    CONSTRAINT fk_customer_id FOREIGN KEY (customer_id) REFERENCES customers (id)
);

CREATE TABLE order_items
(
    id serial NOT NULL PRIMARY KEY,
    order_id integer NOT NULL,
    car_id integer NOT NULL,
    CONSTRAINT fk_order_id FOREIGN KEY (order_id) REFERENCES orders (id),
    CONSTRAINT fk_car_id_order_item FOREIGN KEY (car_id) REFERENCES cars (id)
);
