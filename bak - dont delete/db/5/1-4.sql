-- 1 Написать запрос, который будет выдавать рецепты для пицц.
SELECT
    p.name AS pizza_name,
    i.name AS ingredient_name,
    r.weight,
    ra.name AS action_name
FROM
    recipe r
        JOIN
    pizza p ON r.pizza_id = p.id
        JOIN
    ingridients i ON r.ingridient_id = i.id
        JOIN
    recipe_actions ra ON r.action_id = ra.id
ORDER BY p.id, i.id;

-- 2 Написать запрос, который выведет клиентов без заказов.
SELECT *
FROM customers c
         LEFT JOIN orders o ON c.id = o.customer_id
WHERE o.id IS NULL;

-- 3 По примерам провести чистку таблицы заказов (из презентации, удаляем "пустые" заказы)
delete from orders as od
    using orders as o
    left join order_content oc on o.id = oc.order_id
where oc.order_id is null and od.id = o.id;


-- 4 Написать запрос, для установки скидки 10% для клиентов еще не сделавших
-- заказ.
--------------------------------------------------------------------------------------------------------
-- - тут ошибка в ДЗ - у нас нет поля со скидкой тк если следовать строго инструкциям - оно не создается
-- (см схему в первом задании на 51 странице, там этого поля нет)
-- поэтому я добавлю его тут а потом обновлю

ALTER TABLE customers ADD COLUMN discount INT DEFAULT 0;

UPDATE customers as c
SET discount = 10
    FROM customers as cu
LEFT JOIN orders o ON cu.id = o.customer_id
WHERE o.id IS NULL and c.id = cu.id;
