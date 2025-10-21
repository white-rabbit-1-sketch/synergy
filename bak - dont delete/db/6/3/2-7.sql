-- 2 Написать запрос выводящий все заказы, с данными клиента и автомобиля
SELECT
    o.id AS order_id,
    o.start_time,
    o.end_time,
    c.id AS customer_id,
    c.name AS customer_name,
    c.last_name AS customer_last_name,
    c.patronymic AS customer_patronymic,
    c.passport_number,
    c.license_number,
    c.discount AS customer_discount,
    car.id AS car_id,
    car.vin_number,
    car.reg_number,
    car.class AS car_class,
    m.name AS model_name,
    b.name AS brand_name,
    car.price
FROM
    orders o
        JOIN
    customers c ON o.customer_id = c.id
        JOIN
    order_items oi ON o.id = oi.order_id
        JOIN
    cars car ON oi.car_id = car.id
        JOIN
    models m ON car.model_id = m.id
        JOIN
    brands b ON m.brand_id = b.id;



-- 3 Написать запрос подсчитывающий прибыль по месяцам
SELECT
    EXTRACT(YEAR FROM start_time) AS year,
    EXTRACT(MONTH FROM start_time) AS month,
    SUM(total_amount) AS total_profit
FROM
    orders
WHERE
    start_time IS NOT NULL
GROUP BY
    EXTRACT(YEAR FROM start_time),
    EXTRACT(MONTH FROM start_time)
ORDER BY
    year, month;


-- 4 Написать запрос подсчитывающий среднее количество заказов в месяц за весь период
SELECT monthly_orders.month AS month,
   AVG(monthly_orders.orders_count) AS average_orders_per_month
FROM (
    SELECT
        EXTRACT (MONTH FROM o.start_time) AS month, EXTRACT (YEAR FROM o.start_time) AS year, COUNT (o.id) AS orders_count
    FROM
        orders o
    WHERE
        o.start_time IS NOT NULL
    GROUP BY
        year, month
    ORDER BY
        year, month
    ) AS monthly_orders
GROUP BY
    month
ORDER BY
    month
;

-- 5 Написать запрос который проставит клиентам чья сумма заказов за последний месяц больше 5000 в размере 10%
UPDATE customers
SET discount = 10
WHERE id IN (
    SELECT customer_id
    FROM orders
    WHERE start_time BETWEEN NOW() - INTERVAL '1 month' AND NOW()
GROUP BY customer_id
HAVING SUM(total_amount) > 5000
    );

-- 6 В запрос выводящий заказы добавить условие фильтрации по фамилии клиента
SELECT
    o.id AS order_id,
    o.start_time,
    o.end_time,
    c.id AS customer_id,
    c.name AS customer_name,
    c.last_name AS customer_last_name,
    c.patronymic AS customer_patronymic,
    c.passport_number,
    c.license_number,
    c.discount AS customer_discount,
    car.id AS car_id,
    car.vin_number,
    car.reg_number,
    car.class AS car_class,
    m.name AS model_name,
    b.name AS brand_name,
    car.price
FROM
    orders o
        JOIN
    customers c ON o.customer_id = c.id
        JOIN
    order_items oi ON o.id = oi.order_id
        JOIN
    cars car ON oi.car_id = car.id
        JOIN
    models m ON car.model_id = m.id
        JOIN
    brands b ON m.brand_id = b.id
WHERE
        c.last_name = 'Williams';


-- 7 В запрос выводящий заказы добавить условие фильтрации по дате окончания заказа:
SELECT
    o.id AS order_id,
    o.start_time,
    o.end_time,
    c.id AS customer_id,
    c.name AS customer_name,
    c.last_name AS customer_last_name,
    c.patronymic AS customer_patronymic,
    c.passport_number,
    c.license_number,
    c.discount AS customer_discount,
    car.id AS car_id,
    car.vin_number,
    car.reg_number,
    car.class AS car_class,
    m.name AS model_name,
    b.name AS brand_name,
    car.price
FROM
    orders o
        JOIN
    customers c ON o.customer_id = c.id
        JOIN
    order_items oi ON o.id = oi.order_id
        JOIN
    cars car ON oi.car_id = car.id
        JOIN
    models m ON car.model_id = m.id
        JOIN
    brands b ON m.brand_id = b.id
WHERE
        c.last_name = 'Williams' AND o.end_time > '2023-01-01';



