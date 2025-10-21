INSERT INTO inspectors (name, specialization)
VALUES
    ('Inspector1', 'Specialty1'),
    ('Inspector2', 'Specialty2'),
    ('Inspector3', 'Specialty3'),
    ('Inspector4', 'Specialty4'),
    ('Inspector5', 'Specialty5'),
    ('Inspector6', 'Specialty6'),
    ('Inspector7', 'Specialty7'),
    ('Inspector8', 'Specialty8'),
    ('Inspector9', 'Specialty9'),
    ('Inspector10', 'Specialty10'),
    ('Inspector11', 'Specialty11'),
    ('Inspector12', 'Specialty12'),
    ('Inspector13', 'Specialty13'),
    ('Inspector14', 'Specialty14'),
    ('Inspector15', 'Specialty15'),
    ('Inspector16', 'Specialty16'),
    ('Inspector17', 'Specialty17'),
    ('Inspector18', 'Specialty18'),
    ('Inspector19', 'Specialty19'),
    ('Inspector20', 'Specialty20');

INSERT INTO inspections (inspection_date, comment, car_id, inspector_id)
SELECT
        NOW() - INTERVAL '1 day' * (random() * 30)::integer AS inspection_date,
    'Comment ' || id AS comment,
    (random() * 10 + 1)::integer AS car_id,
    (random() * 20 + 1)::integer AS inspector_id
FROM generate_series(1, 100) AS id;

INSERT INTO inspections (inspection_date, comment, car_id, inspector_id)
SELECT
        NOW() - INTERVAL '1 day' * (random() * 30)::integer AS inspection_date,
    'Comment ' || random() AS comment,
    m.id AS car_id,
    i.id AS inspector_id
FROM
    generate_series(1, 50) AS s
    JOIN
    (SELECT id FROM cars ORDER BY random() LIMIT 50) AS m
ON true
    JOIN
    (SELECT id FROM inspectors ORDER BY random() LIMIT 50) AS i
    ON true
    LIMIT 100;

INSERT INTO car_conditions (condition_name, can_use)
VALUES
    ('Без повреждений', true),
    ('Легкие повреждения (используемый)', true),
    ('Требует ремонта (нельзя использовать)', false),
    ('Аварийное (нельзя использовать)', false);

UPDATE cars
SET condition_id = floor(random() * 4) + 1;

INSERT INTO maintenance_costs (car_id, maintenance_date, comment, cost)
VALUES
    (1, NOW() - INTERVAL '7 days', 'Замена масла', 50.00),
    (1, NOW() - INTERVAL '5 days', 'Ремонт тормозов', 120.00),
    (1, NOW() - INTERVAL '3 days', 'Покраска', 200.00),
    (1, NOW() - INTERVAL '2 days', 'Замена фильтра воздуха', 30.00),
    (1, NOW() - INTERVAL '1 day', 'Регулировка двигателя', 80.00),
    (2, NOW() - INTERVAL '10 days', 'Замена тормозных колодок', 100.00),
    (2, NOW() - INTERVAL '8 days', 'Замена аккумулятора', 90.00),
    (2, NOW() - INTERVAL '6 days', 'Полная замена масла и фильтров', 120.00),
    (2, NOW() - INTERVAL '4 days', 'Ремонт выхлопной системы', 150.00),
    (2, NOW() - INTERVAL '2 days', 'Замена свечей зажигания', 40.00),
    (3, NOW() - INTERVAL '6 days', 'Полировка кузова', 60.00),
    (3, NOW() - INTERVAL '4 days', 'Замена передних амортизаторов', 180.00),
    (3, NOW() - INTERVAL '2 days', 'Замена трансмиссионного масла', 70.00),
    (3, NOW() - INTERVAL '1 day', 'Ремонт системы кондиционирования', 120.00),
    (3, NOW() - INTERVAL '8 days', 'Замена ремня ГРМ', 110.00),
    (4, NOW() - INTERVAL '7 days', 'Плановое ТО', 200.00),
    (4, NOW() - INTERVAL '5 days', 'Ремонт электрики', 130.00),
    (4, NOW() - INTERVAL '3 days', 'Замена тормозных дисков', 160.00),
    (4, NOW() - INTERVAL '1 day', 'Диагностика двигателя', 50.00),
    (4, NOW(), 'Проверка и обслуживание топливной системы', 90.00),
    (5, NOW() - INTERVAL '10 days', 'Замена масла', 50.00),
    (5, NOW() - INTERVAL '8 days', 'Ремонт тормозов', 120.00),
    (5, NOW() - INTERVAL '6 days', 'Покраска', 200.00),
    (5, NOW() - INTERVAL '4 days', 'Замена фильтра воздуха', 30.00),
    (5, NOW() - INTERVAL '2 days', 'Регулировка двигателя', 80.00),
    (6, NOW() - INTERVAL '6 days', 'Замена тормозных колодок', 100.00),
    (6, NOW() - INTERVAL '4 days', 'Замена аккумулятора', 90.00),
    (6, NOW() - INTERVAL '2 days', 'Полная замена масла и фильтров', 120.00),
    (6, NOW() - INTERVAL '1 day', 'Ремонт выхлопной системы', 150.00),
    (6, NOW() - INTERVAL '8 days', 'Замена свечей зажигания', 40.00),
    (7, NOW() - INTERVAL '7 days', 'Полировка кузова', 60.00),
    (7, NOW() - INTERVAL '5 days', 'Замена передних амортизаторов', 180.00),
    (7, NOW() - INTERVAL '3 days', 'Замена трансмиссионного масла', 70.00),
    (7, NOW() - INTERVAL '1 day', 'Ремонт системы кондиционирования', 120.00),
    (7, NOW() - INTERVAL '8 days', 'Замена ремня ГРМ', 110.00),
    (8, NOW() - INTERVAL '6 days', 'Плановое ТО', 200.00),
    (8, NOW() - INTERVAL '4 days', 'Ремонт электрики', 130.00),
    (8, NOW() - INTERVAL '2 days', 'Замена тормозных дисков', 160.00),
    (8, NOW() - INTERVAL '1 day', 'Диагностика двигателя', 50.00),
    (8, NOW(), 'Проверка и обслуживание топливной системы', 90.00),
    (9, NOW() - INTERVAL '10 days', 'Замена масла', 50.00),
    (9, NOW() - INTERVAL '8 days', 'Ремонт тормозов', 120.00),
    (9, NOW() - INTERVAL '6 days', 'Покраска', 200.00),
    (9, NOW() - INTERVAL '4 days', 'Замена фильтра воздуха', 30.00),
    (9, NOW() - INTERVAL '2 days', 'Регулировка двигателя', 80.00),
    (10, NOW() - INTERVAL '6 days', 'Замена тормозных колодок', 100.00),
    (10, NOW() - INTERVAL '4 days', 'Замена аккумулятора', 90.00),
    (10, NOW() - INTERVAL '2 days', 'Полная замена масла и фильтров', 120.00),
    (10, NOW() - INTERVAL '1 day', 'Ремонт выхлопной системы', 150.00),
    (10, NOW() - INTERVAL '8 days', 'Замена свечей зажигания', 40.00);

INSERT INTO parking_lots (address)
VALUES
    ('Улица Парковая, 1'),
    ('Площадь Автостоянки, 5'),
    ('Аллея Гаражей, 10'),
    ('Проезд Паркинговый, 3');

INSERT INTO parking_entries (car_id, parking_lot_id, entry_time)
VALUES
    (1, 1, NOW() - INTERVAL '1 day'),
    (2, 2, NOW() - INTERVAL '2 days'),
    (3, 3, NOW() - INTERVAL '3 days'),
    (4, 4, NOW() - INTERVAL '4 days'),
    (5, 1, NOW() - INTERVAL '5 days');

INSERT INTO car_classes (class_name)
VALUES
    ('Class1'),
    ('Class2'),
    ('Class3'),
    ('Class4'),
    ('Class5');

UPDATE cars
SET class_id = floor(random() * 5) + 1;

DO $$
DECLARE
car_classes INTEGER[] := ARRAY[1, 2, 3, 4, 5];
    days_of_week VARCHAR[] := ARRAY['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    class_id INTEGER;
day VARCHAR;
BEGIN
FOR class_id IN SELECT unnest(car_classes)
                           LOOP
                        FOR day IN SELECT unnest(days_of_week)
                    LOOP
                INSERT INTO rental_rates (car_class_id, day_of_week, start_time, end_time, rate_per_hour)
                VALUES
                    (class_id, day, '00:00:00', '06:00:00', ROUND(CAST(RANDOM() * 10 + 10 AS NUMERIC), 2)),
                    (class_id, day, '06:00:01', '18:00:00', ROUND(CAST(RANDOM() * 15 + 15 AS NUMERIC), 2)),
                    (class_id, day, '18:00:01', '23:59:59', ROUND(CAST(RANDOM() * 12 + 12 AS NUMERIC), 2));
END LOOP;
END LOOP;
END $$;


