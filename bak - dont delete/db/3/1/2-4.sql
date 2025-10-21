-- 2 Создать таблицу регионы, добавить внешний ключ на регионы для города.
CREATE TABLE regions
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255)
);

ALTER TABLE cities ADD COLUMN region_id integer NOT NULL;
ALTER TABLE cities ADD CONSTRAINT fk_region_id
    FOREIGN KEY (region_id) REFERENCES regions (id);

-- 3 Создать таблицу страны и и связать ее с регионами.
CREATE TABLE countries
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255)
);

ALTER TABLE regions ADD COLUMN country_id integer NOT NULL;
ALTER TABLE regions ADD CONSTRAINT fk_country_id
    FOREIGN KEY (country_id) REFERENCES countries (id);