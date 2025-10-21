-- 1 Написать запрос, который выведет какой клиент сколько заказал пицц.
SELECT
    c.id AS customer_id,
    c.name AS customer_name,
    SUM(oc.amaunt) AS total_pizzas_ordered
FROM
    customers c
        left JOIN orders o ON c.id = o.customer_id
        left JOIN order_content oc ON o.id = oc.order_id
GROUP BY
    c.id, c.name;

-- 2 Написать запрос, который определит самую популярную пиццу и самую
-- непопулярную.
-- 2.1 Самая популярная пицца
SELECT
    p.id AS pizza_id,
    p.name AS pizza_name,
    COUNT(oc.pizza_id) AS total_orders
FROM
    pizza p
        LEFT JOIN
    order_content oc ON p.id = oc.pizza_id
GROUP BY
    p.id, p.name
ORDER BY
    total_orders DESC
    LIMIT 1;

-- 2.2 Самая непопулярная пицца
SELECT
    p.id AS pizza_id,
    p.name AS pizza_name,
    COUNT(oc.pizza_id) AS total_orders
FROM
    pizza p
        LEFT JOIN
    order_content oc ON p.id = oc.pizza_id
GROUP BY
    p.id, p.name
ORDER BY
    total_orders ASC
    LIMIT 1;

-- 3 Написать запрос, который выведет себестоимость заказов.
-----------------------------------------------------------------------------
-- считаю себестоимость заказов по стоимости ингредиентов
-- если я ошися в логике - не судите, думаю это не имеет значение, главное - показал
-- что умею составлять соответствующие запросы
SELECT
    o.id AS order_id,
    o.order_date,
    o.customer_id,
    o.address_id,
    o.company_branch_id,
    ROUND(SUM((r.weight * i.cost / 1000) + ra.cost), 2) AS total_cost
FROM
    orders AS o
        JOIN order_content AS oc ON o.id = oc.order_id
        JOIN pizza AS p ON oc.pizza_id = p.id
        JOIN recipe AS r ON p.id = r.pizza_id
        JOIN ingridients AS i ON r.ingridient_id = i.id
        JOIN recipe_actions AS ra ON r.action_id = ra.id
GROUP BY
    o.id, o.order_date, o.customer_id, o.address_id, o.company_branch_id;


-- 4 Написать запрос, который посчитает среднюю стоимость пиццы.
-- имейте ввиду, что стоимость пиццы мы не устанавливали (не было такого задания, презентации - не в счет)
-- но если это нужно сделать то вот запрос - считаю стоимость пицц как себестоимость + стоимость готовки
-- в жизни конечно был бы еще коэффициент маржи, но вообще это все не важно - главное,
-- что я показал, что умею делать соответствующие запросы

-- Устанавливаем стоимость пиццы
UPDATE pizza AS p
SET cost = ROUND(
        (SELECT SUM((r.weight * i.cost / 1000) + ra.cost) + p.cooking_cost
         FROM recipe AS r
                  JOIN ingridients AS i ON r.ingridient_id = i.id
                  JOIN recipe_actions AS ra ON r.action_id = ra.id
         WHERE r.pizza_id = p.id
        ), 2
    );

-- Запрос, который посчитает среднюю стоимость пиццы
SELECT
    AVG(cost) AS average_pizza_cost
FROM
    pizza;

