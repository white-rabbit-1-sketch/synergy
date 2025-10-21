-- Архивирование
INSERT INTO archived_orders (id, start_time, end_time, customer_id, total_amount)
SELECT id, start_time, end_time, customer_id, total_amount
FROM orders
WHERE end_time IS NOT NULL AND end_time < NOW() - INTERVAL '1 month';

INSERT INTO archived_order_items (id, order_id, car_id)
SELECT oi.id, oi.order_id, oi.car_id
FROM order_items oi
         JOIN orders o ON oi.order_id = o.id
WHERE o.end_time IS NOT NULL AND o.end_time < NOW() - INTERVAL '1 month';

DELETE FROM order_items
    USING orders o
WHERE order_items.order_id = o.id AND o.end_time IS NOT NULL AND o.end_time < NOW() - INTERVAL '1 month';

DELETE FROM orders
WHERE end_time IS NOT NULL AND end_time < NOW() - INTERVAL '1 month';

-- Средняя стоимость поездки
SELECT AVG(total_amount) AS average_trip_cost
FROM orders
WHERE end_time IS NOT NULL;

-- Прибыль с разбивкой по месяцам (доходы с аренды - расходы на обслуживание  автомобилей)
SELECT
    TO_CHAR(o.end_time, 'YYYY-MM') AS month,
    SUM(o.total_amount) AS total_rental_income,
    COALESCE(SUM(m.cost), 0) AS total_maintenance_cost,
    SUM(o.total_amount) - COALESCE(SUM(m.cost), 0) AS profit
FROM
    orders o
    LEFT JOIN
    order_items oi ON o.id = oi.order_id
    LEFT JOIN
    maintenance_costs m ON oi.car_id = m.car_id AND EXTRACT(MONTH FROM o.end_time) = EXTRACT(MONTH FROM m.maintenance_date)
    AND EXTRACT(YEAR FROM o.end_time) = EXTRACT(YEAR FROM m.maintenance_date)
WHERE
    o.end_time IS NOT NULL
GROUP by
    month
ORDER BY
    month;

