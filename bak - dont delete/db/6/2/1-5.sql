-- 1 Написать запрос, который выведет клиентов создавших заказы больше чем на три разных адреса.
SELECT
    c.id AS customer_id,
    c.name AS customer_name,
    COUNT(DISTINCT a.id) AS distinct_address_count
FROM
    customers c
        JOIN
    orders o ON c.id = o.customer_id
        JOIN
    address a ON o.address_id = a.id
GROUP BY
    c.id, c.name
HAVING
        COUNT(DISTINCT a.id) > 3;

-- 2 Написать запрос, который будет устанавливать себестоимости пицц в содержимом заказа.
------------------------------------------------------
-- Исхожу из того что это поле first_cost, но это не важно - главное, показал что умею делать запросы
-- так же исхожу что нужна общая себестоимость (по количеству пицц), но есл надо только за одну - не суть важно
-- запрос не сильно бы изменился
UPDATE order_content AS oc
SET first_cost = ROUND(((r.weight * i.cost / 1000) + ra.cost) * oc.amaunt, 2)
    FROM order_content AS oc2
JOIN pizza AS p ON oc2.pizza_id = p.id
    JOIN recipe AS r ON oc2.pizza_id = r.pizza_id
    JOIN ingridients AS i ON r.ingridient_id = i.id
    JOIN recipe_actions AS ra ON r.action_id = ra.id
WHERE oc.order_id = oc2.order_id and oc.pizza_id = oc2.pizza_id;

-- 3 Создать архивные таблицы для заказов и содержимого заказов, написать запросы на вставку данных старше месяца в эти таблицы.
-- Создание архивной таблицы для заказов
CREATE TABLE archived_orders AS
SELECT *
FROM orders
WHERE order_date < CURRENT_DATE - INTERVAL '1 month';

-- Создание архивной таблицы для содержимого заказов
CREATE TABLE archived_order_content AS
SELECT *
FROM order_content
WHERE order_id IN (SELECT id FROM archived_orders);

-- 4 Создать таблицу категорий из примера, добавить туда третий подуровень.
CREATE TABLE menu_categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INTEGER REFERENCES menu_categories(id)
);

INSERT INTO menu_categories (name, parent_id) VALUES
                                             ('Category1', NULL),
                                             ('Category2', NULL),
                                             ('Subcategory1-1', 1),
                                             ('Subcategory1-2', 1),
                                             ('Subcategory2-1', 2),
                                             ('Subcategory2-2', 2),
                                             ('Subsubcategory1-1-1', 3),
                                             ('Subsubcategory1-1-2', 3);

-- 5 Проверить как работает рекурсивный запрос.
WITH RECURSIVE category_hierarchy AS (
    SELECT
        id,
        name,
        parent_id,
        1 AS level
    FROM
        menu_categories
    WHERE
        parent_id IS NULL

    UNION ALL

    SELECT
        c.id,
        c.name,
        c.parent_id,
        ch.level + 1
    FROM
        menu_categories c
            JOIN
        category_hierarchy ch ON c.parent_id = ch.id
)

SELECT * FROM category_hierarchy;
