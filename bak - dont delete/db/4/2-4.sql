-- 2 Написать запросы для выборки ингредиентов дешевле 350.
SELECT * FROM ingridients WHERE cost < 350;
-- 3 Изменить их цену на стоимость на равную 350.
UPDATE ingridients SET cost = 350 WHERE cost < 350;
-- 4 Удалить несколько произвольных записей из таблицы характеризующих заказ.
-- тут конечно стоило бы делать это в транзакции, но такой задачи не стояло
DELETE FROM order_content WHERE order_id IN (1, 2);
DELETE FROM orders WHERE id IN (1, 2);