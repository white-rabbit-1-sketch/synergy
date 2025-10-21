-- 1 повторить функцию из примера для расчета стоимости пицц,
-- применить ее для установки себестоимости и стоимости пиццы а заказе

create or replace function calcPizzaCost(p_id int, percent int) returns real as $$
declare
firstCost real;
begin
SELECT SUM((r.weight * i.cost / 1000) + ra.cost) + p.cooking_cost into firstCost
FROM recipe AS r
         inner JOIN ingridients AS i ON r.ingridient_id = i.id
         inner JOIN recipe_actions AS ra ON r.action_id = ra.id
         inner JOIN pizza AS p ON p.id = r.pizza_id
where r.pizza_id = p_id
group by r.pizza_id, p.cooking_cost;
firstCost := firstCost * (cast(percent as real) /100 + 1);
return firstCost;
END; $$ LANGUAGE plpgsql;

UPDATE pizza set cost = calcpizzacost(id, 10);
UPDATE pizza set cooking_cost = calcpizzacost(id, 0);

-- 2 написать триггерную функцию и триггер, которые будут менять себестоимость стоимость пиццы, при изменении стоимости выпекания.
CREATE OR REPLACE FUNCTION update_pizza_cost_on_cooking_cost_change()
RETURNS TRIGGER AS $$
BEGIN
    RAISE NOTICE 'Updating pizza cost for pizza_id %, new cooking_cost: %', NEW.id, NEW.cooking_cost;

    NEW.cost := calcPizzaCost(NEW.id, 10);

    RAISE NOTICE 'Updated pizza cost to %', NEW.cost;

RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER on_cooking_cost_change
    BEFORE UPDATE OF cooking_cost ON pizza
    FOR EACH ROW
    EXECUTE FUNCTION update_pizza_cost_on_cooking_cost_change();

-- 3 написать триггерную функцию и триггер, которые при добавлении записи в содержимое заказа,
-- будут автоматически проставлять стоимость и себестоимость пиццы

CREATE OR REPLACE FUNCTION update_order_content_costs()
RETURNS TRIGGER AS $$
BEGIN

    NEW.cost := (SELECT p.cost
                 FROM pizza p
                 WHERE p.id = NEW.pizza_id);
    NEW.first_cost := (SELECT p.cooking_cost
                 FROM pizza p
                 WHERE p.id = NEW.pizza_id);

RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER on_order_content_insert
    BEFORE INSERT ON order_content
    FOR EACH ROW
    EXECUTE FUNCTION update_order_content_costs();


-- 4 написать триггерную функцию и триггер, которые после добавления или удаления ингредиента из пиццы будут обновлять ее стоимость.

CREATE OR REPLACE FUNCTION update_pizza_cost_on_ingredient_change()
RETURNS TRIGGER AS $$
BEGIN

UPDATE pizza SET cost = calcPizzaCost(NEW.pizza_id, 10);
UPDATE pizza SET cooking_cost = calcPizzaCost(NEW.pizza_id, 0);

RETURN NEW;
END;
$$
LANGUAGE plpgsql;

-- Создание триггера для добавления ингредиента
CREATE TRIGGER on_recipe_insert
    AFTER INSERT ON recipe
    FOR EACH ROW
    EXECUTE FUNCTION update_pizza_cost_on_ingredient_change();

-- Создание триггера для удаления ингредиента
CREATE TRIGGER on_recipe_delete
    AFTER DELETE ON recipe
    FOR EACH ROW
    EXECUTE FUNCTION update_pizza_cost_on_ingredient_change();
