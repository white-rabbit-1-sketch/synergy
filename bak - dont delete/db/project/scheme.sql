CREATE TABLE inspectors
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(100) NOT NULL,
    specialization varchar(100)
);

CREATE TABLE inspections
(
    id serial NOT NULL PRIMARY KEY,
    inspection_date timestamp DEFAULT NOW() NOT NULL,
    comment text,
    car_id integer NOT NULL,
    inspector_id integer NOT NULL,
    CONSTRAINT fk_car_id FOREIGN KEY (car_id) REFERENCES cars (id),
    CONSTRAINT fk_inspector_id FOREIGN KEY (inspector_id) REFERENCES inspectors (id)
);

CREATE TABLE car_conditions
(
    id serial NOT NULL PRIMARY KEY,
    condition_name varchar(100) NOT NULL,
    can_use boolean NOT NULL DEFAULT true
);

ALTER TABLE cars
    ADD COLUMN condition_id integer,
ADD CONSTRAINT fk_condition_id FOREIGN KEY (condition_id) REFERENCES car_conditions (id);

CREATE INDEX idx_condition_id ON cars (condition_id);

CREATE TABLE maintenance_costs
(
    id serial NOT NULL PRIMARY KEY,
    car_id integer NOT NULL,
    maintenance_date timestamp DEFAULT NOW() NOT NULL,
    comment varchar(255),
    cost numeric(18,2) NOT NULL,
    CONSTRAINT fk_car_id_maintenance_costs FOREIGN KEY (car_id) REFERENCES cars (id)
);

CREATE TABLE parking_lots
(
    id serial NOT NULL PRIMARY KEY,
    address varchar(255) NOT NULL
);

CREATE TABLE parking_entries
(
    id serial NOT NULL PRIMARY KEY,
    car_id integer NOT NULL,
    parking_lot_id integer NOT NULL,
    entry_time timestamp DEFAULT NOW() NOT NULL,
    CONSTRAINT fk_car_id_parking_entries FOREIGN KEY (car_id) REFERENCES cars (id),
    CONSTRAINT fk_parking_lot_id FOREIGN KEY (parking_lot_id) REFERENCES parking_lots (id)
);

CREATE TABLE car_classes
(
    id serial NOT NULL PRIMARY KEY,
    class_name varchar(100) NOT NULL
);

ALTER TABLE cars
    ADD COLUMN class_id integer;

ALTER TABLE cars
    DROP COLUMN class;

ALTER TABLE cars
    ADD CONSTRAINT fk_class_id FOREIGN KEY (class_id) REFERENCES car_classes (id);

CREATE TABLE rental_rates
(
    id serial NOT NULL PRIMARY KEY,
    car_class_id integer NOT NULL,
    day_of_week varchar(20) NOT NULL,
    start_time time NOT NULL,
    end_time time NOT NULL,
    rate_per_hour numeric(18,2) NOT NULL,
    CONSTRAINT fk_car_class_id FOREIGN KEY (car_class_id) REFERENCES car_classes (id)
);

CREATE OR REPLACE FUNCTION calculate_rental_cost(
    p_start_time timestamp,
    p_end_time timestamp,
    p_car_class_id integer
) RETURNS numeric AS $$
DECLARE
v_total_cost numeric;
    v_day_of_week VARCHAR;
BEGIN
SELECT TRIM(TO_CHAR(p_start_time, 'Day'))
INTO v_day_of_week;

SELECT rate_per_hour * EXTRACT(EPOCH FROM (
        LEAST(
                p_end_time,
                p_end_time::date + end_time
            ) -
        GREATEST(
                p_start_time,
                p_start_time::date + start_time
            )
    )::interval) / 3600
INTO v_total_cost
FROM rental_rates
WHERE car_class_id = p_car_class_id
  AND day_of_week = v_day_of_week
  AND p_start_time::time BETWEEN start_time AND end_time
        AND p_end_time::time BETWEEN start_time AND end_time
ORDER BY start_time
    LIMIT 1;

RETURN COALESCE(v_total_cost, 0);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_order_cost()
RETURNS TRIGGER AS $$
DECLARE
v_total_cost numeric := 0;
  item_row order_items%ROWTYPE;
  v_car_class_id integer;
BEGIN
  -- Проверяем, есть ли дата завершения заказа
  IF NEW.end_time IS NOT NULL THEN
    -- Выбираем все айтемы заказа для данного заказа
    FOR item_row IN SELECT * FROM order_items WHERE order_id = NEW.id LOOP
SELECT class_id INTO v_car_class_id FROM cars WHERE id = item_row.car_id;

-- Добавляем стоимость каждой машины к общей стоимости заказа
v_total_cost := v_total_cost + calculate_rental_cost(
      	NEW.start_time,
      	NEW.end_time,
      	v_car_class_id
      	);
END LOOP;

    -- Присваиваем общую стоимость заказа
    NEW.total_amount := v_total_cost;
END IF;

RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER before_insert_update_order_cost
    BEFORE INSERT OR UPDATE
                         ON orders
                         FOR EACH ROW
                         EXECUTE FUNCTION update_order_cost();

CREATE TABLE archived_orders
(
    id serial NOT NULL PRIMARY KEY,
    start_time timestamp DEFAULT NOW() NOT NULL,
    end_time timestamp,
    customer_id integer NOT NULL,
    total_amount numeric(18,2) NOT NULL DEFAULT 0,
    CONSTRAINT fk_customer_id_archived_orders FOREIGN KEY (customer_id) REFERENCES customers (id)
);

CREATE TABLE archived_order_items
(
    id serial NOT NULL PRIMARY KEY,
    order_id integer NOT NULL,
    car_id integer NOT NULL,
    CONSTRAINT fk_order_id_archived_order_item FOREIGN KEY (order_id) REFERENCES archived_orders (id),
    CONSTRAINT fk_car_id_archived_order_item FOREIGN KEY (car_id) REFERENCES cars (id)
);