INSERT INTO brands (name)
VALUES ('Brand1'),
       ('Brand2'),
       ('Brand3'),
       ('Brand4'),
       ('Brand5'),
       ('Brand6'),
       ('Brand7'),
       ('Brand8'),
       ('Brand9'),
       ('Brand10');

INSERT INTO models (name, brand_id)
VALUES ('Model1', 1),
       ('Model2', 1),
       ('Model3', 2),
       ('Model4', 2),
       ('Model5', 3),
       ('Model6', 4),
       ('Model7', 4),
       ('Model8', 5),
       ('Model9', 5),
       ('Model10', 1);

INSERT INTO cars (vin_number, reg_number, class, model_id, price)
VALUES ('VIN111', 'Reg111', 'Class1', 1, 20000),
       ('VIN222', 'Reg222', 'Class2', 2, 25000),
       ('VIN333', 'Reg333', 'Class3', 3, 18000),
       ('VIN444', 'Reg444', 'Class1', 4, 22000),
       ('VIN555', 'Reg555', 'Class2', 5, 27000),
       ('VIN666', 'Reg666', 'Class3', 6, 21000),
       ('VIN777', 'Reg777', 'Class1', 7, 24000),
       ('VIN888', 'Reg888', 'Class2', 8, 26000),
       ('VIN999', 'Reg999', 'Class3', 9, 19000),
       ('VIN000', 'Reg000', 'Class1', 10, 23000);

INSERT INTO customers (name, last_name, patronymic, passport_number, license_number, discount)
VALUES ('John', 'Doe', 'Pat', 'Passport123', 'LicenseABC', 5),
       ('Jane', 'Smith', 'Pat', 'Passport456', 'LicenseDEF', 10),
       ('Mike', 'Johnson', 'Pat', 'Passport789', 'LicenseGHI', 0),
       ('Emily', 'Brown', 'Pat', 'Passport012', 'LicenseJKL', 15),
       ('David', 'Williams', 'Pat', 'Passport345', 'LicenseMNO', 8),
       ('Anna', 'Davis', 'Pat', 'Passport678', 'LicensePQR', 12),
       ('Daniel', 'Moore', 'Pat', 'Passport901', 'LicenseSTU', 3),
       ('Olivia', 'Anderson', 'Pat', 'Passport234', 'LicenseVWX', 7),
       ('James', 'Taylor', 'Pat', 'Passport567', 'LicenseYZA', 9),
       ('Sophia', 'Thomas', 'Pat', 'Passport890', 'LicenseBCD', 6);

INSERT INTO orders (start_time, end_time, customer_id, total_amount)
SELECT
        NOW() - INTERVAL '1 day' * (random() * 30)::integer AS start_time,
    NOW() + INTERVAL '1 day' * (random() * 30)::integer AS end_time,
    c.id AS customer_id,
    (random() * 5000 + 500)::numeric(18,2) AS total_amount
FROM
    generate_series(1, 100) AS s
    JOIN
    (SELECT id FROM customers ORDER BY random() LIMIT 100) AS c
ON true;


INSERT INTO order_items (order_id, car_id)
SELECT o.id AS order_id,
       (random() * 5 + 1) ::integer AS car_id
FROM orders o,
     generate_series(1, 2) AS s;


