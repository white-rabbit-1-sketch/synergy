-- 1 Обернуть в транзакцию запросы которые переносят заказы в архивные таблицы, и чистят рабочие
BEGIN;

INSERT INTO archived_orders
SELECT *
FROM orders
WHERE order_date < CURRENT_DATE - INTERVAL '1 month';

INSERT INTO archived_order_content
SELECT *
FROM order_content
WHERE order_id IN (SELECT id FROM archived_orders);

DELETE FROM order_content
WHERE order_id IN (SELECT id FROM archived_orders);

DELETE FROM orders
WHERE id IN (SELECT id FROM archived_orders);

COMMIT;

-- 2 Создать индексы на поля телефон и электронная почта клиента.
CREATE INDEX idx_customers_phone ON customers (phone);
CREATE INDEX idx_customers_email ON customers (email);

-- 3 Посмотреть планы запросов которые мы писали ранее.
-- Хочу отметить, что мы не писали запросов с выборкой по телефону и емаилу, поэтому я напишу свои.
-- Единственное, я уже создал индексы и не сделал скриншот ДО, но думаю это не проблема -
-- и так понятно, что без индекса будет фулл скан таблицы, а с индексом он пройдет по той ветви дерева,
-- которая подходит под условия (в базовом варианте). Вообще индексы гораздо более глубокая и обширная тема
-- чем у нас в лекциях, но оставим это за скобками. Скриншоты профилирования приложу уже с индексами,
-- надеюсь это не будет проблемой
