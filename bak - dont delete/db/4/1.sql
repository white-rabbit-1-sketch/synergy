-- 1 Написать запросы для заполнения остальных таблиц базы данных.
--------------------------------------------------------------------------------
-- я не очень понял, почему в задании сказано заполнить "остальные" таблицы
-- ведь мы не заполняли их до этого
-- а то что было в презентации - там это было кусками, неполноценно и структура таблиц из
-- презентации не до конца совпадает
-- поэтому я заполню сам сразу все таблицы. Технически тут нет никакой разницы, так что
-- должно подойти

INSERT INTO countries (id, name)
VALUES (1, 'Country1'),
       (2, 'Country2'),
       (3, 'Country3'),
       (4, 'Country4'),
       (5, 'Country5');



INSERT INTO regions (id, name, country_id)
VALUES (1, 'North', 1),
       (2, 'South', 2),
       (3, 'East', 3),
       (4, 'West', 4),
       (5, 'Central', 5);

INSERT INTO cities (id, name, region_id)
VALUES (1, 'City1', 1),
       (2, 'City2', 2),
       (3, 'City3', 3),
       (4, 'City4', 1),
       (5, 'City5', 4);

INSERT INTO address (id, city_id, street, house, flat)
VALUES (1, 1, 'Street1', 'House1', 101),
       (2, 2, 'Street2', 'House2', 202),
       (3, 3, 'Street3', 'House3', 303),
       (4, 4, 'Street4', 'House4', 404),
       (5, 5, 'Street5', 'House5', 505);

INSERT INTO branches (id, name, city_id, street, house)
VALUES (1, 'Branch1', 1, 'Street1', 'House1'),
       (2, 'Branch2', 2, 'Street2', 'House2'),
       (3, 'Branch3', 3, 'Street3', 'House3'),
       (4, 'Branch4', 4, 'Street4', 'House4'),
       (5, 'Branch5', 5, 'Street5', 'House5');

INSERT INTO order_status (id, name)
VALUES (1, 'Pending'),
       (2, 'In Progress'),
       (3, 'Completed'),
       (4, 'Canceled'),
       (5, 'Delivered');

INSERT INTO customers (id, name, email, phone)
VALUES (1, 'Customer1', 'customer1@email.com', '123-456-7890'),
       (2, 'Customer2', 'customer2@email.com', '987-654-3210'),
       (3, 'Customer3', 'customer3@email.com', '555-123-4567'),
       (4, 'Customer4', 'customer4@email.com', '111-222-3333'),
       (5, 'Customer5', 'customer5@email.com', '999-888-7777');

INSERT INTO ingridients (id, name, cost)
VALUES (1, 'Ingredient1', 150.00),
       (2, 'Ingredient2', 200.00),
       (3, 'Ingredient3', 100.00),
       (4, 'Ingredient4', 250.00),
       (5, 'Ingredient5', 300.00);

INSERT INTO recipe_actions (id, name, cost)
VALUES (1, 'Action1', 50),
       (2, 'Action2', 75),
       (3, 'Action3', 100),
       (4, 'Action4', 125),
       (5, 'Action5', 150);

INSERT INTO pizza (id, name, recipe, cost, description, cooking_cost)
VALUES (1, 'Pizza1', 1, 500, 12345, 30),
       (2, 'Pizza2', 2, 600, 54321, 40),
       (3, 'Pizza3', 3, 700, 98765, 35),
       (4, 'Pizza4', 4, 800, 56789, 50),
       (5, 'Pizza5', 5, 900, 43210, 45);

INSERT INTO recipe (pizza_id, ingridient_id, weight, action_id)
VALUES (1, 1, 200, 1),
       (2, 2, 300, 2),
       (3, 3, 150, 3),
       (4, 4, 250, 4),
       (5, 5, 350, 5);

INSERT INTO orders (id, customer_id, address_id, order_date, comment, status_id, company_branch_id)
VALUES (1, 1, 1, '2023-01-01 12:00:00', 'Order Comment 1', 1, 1),
       (2, 2, 2, '2023-02-02 14:30:00', 'Order Comment 2', 2, 2),
       (3, 3, 3, '2023-03-03 16:45:00', 'Order Comment 3', 3, 3),
       (4, 4, 4, '2023-04-04 18:20:00', 'Order Comment 4', 4, 4),
       (5, 5, 5, '2023-05-05 20:10:00', 'Order Comment 5', 5, 5);

INSERT INTO order_content (order_id, pizza_id, amaunt, cost, first_cost)
VALUES (1, 1, 2, 1000.00, 1200.00),
       (2, 2, 1, 600.00, 600.00),
       (3, 3, 3, 2100.00, 2100.00),
       (4, 4, 1, 800.00, 800.00),
       (5, 5, 2, 1800.00, 1800.00);
