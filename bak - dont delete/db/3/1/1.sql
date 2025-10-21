-- 1 Создать базу данных по реляционной модели.

CREATE TABLE cities
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255) NOT NULL
);

CREATE TABLE address
(
    id serial NOT NULL PRIMARY KEY,
    city_id integer NOT NULL,
    street varchar(100) NOT NULL,
    house varchar(100) NOT NULL,
    flat smallint,
    CONSTRAINT fk_city_id FOREIGN KEY (city_id) REFERENCES cities (id)
);

CREATE TABLE branches
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255) NOT NULL,
    city_id integer NOT NULL,
    street varchar(100) NOT NULL,
    house varchar(100) NOT NULL,
    CONSTRAINT fk_branches_city_id FOREIGN KEY (city_id) REFERENCES cities (id)
);

CREATE TABLE customers
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(100) NOT NULL
);

CREATE TABLE order_status
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(50)
);

CREATE TABLE orders
(
    id serial NOT NULL PRIMARY KEY,
    customer_id integer,
    address_id integer,
    order_date timestamp DEFAULT NOW() NOT NULL,
    comment text,
    status_id integer NOT NULL,
    company_branch_id integer NOT NULL,
    CONSTRAINT fk_address_id FOREIGN KEY (address_id) REFERENCES address (id),
    CONSTRAINT fk_company_branch_id FOREIGN KEY (company_branch_id) REFERENCES branches (id),
    CONSTRAINT fk_customer_id FOREIGN KEY (customer_id) REFERENCES customers (id),
    CONSTRAINT fk_order_id FOREIGN KEY (status_id) REFERENCES order_status (id)
);

CREATE TABLE ingridients
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(100) NOT NULL,
    cost numeric(10,2) NOT NULL
);

CREATE TABLE pizza
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(100) NOT NULL,
    recipe integer,
    cost smallint,
    description bigint,
    cooking_cost smallint
);

CREATE TABLE order_content
(
    order_id integer NOT NULL,
    pizza_id integer NOT NULL,
    amaunt smallint DEFAULT 1 NOT NULL,
    cost numeric(10,2) NOT NULL,
    first_cost numeric(10,2),
    PRIMARY KEY (order_id, pizza_id),
    CONSTRAINT fk_order_content_id FOREIGN KEY (order_id) REFERENCES orders (id),
    CONSTRAINT fk_pizza_content_id FOREIGN KEY (pizza_id) REFERENCES pizza (id)
);

CREATE TABLE recipe_actions
(
    id serial NOT NULL PRIMARY KEY,
    name varchar(255),
    cost smallint
);

CREATE TABLE recipe
(
    pizza_id integer NOT NULL,
    ingridient_id integer NOT NULL,
    weight smallint NOT NULL,
    action_id integer NOT NULL,
    PRIMARY KEY (pizza_id, ingridient_id),
    CONSTRAINT fk_action_id FOREIGN KEY (action_id) REFERENCES recipe_actions (id),
    CONSTRAINT fk_ingridient_id FOREIGN KEY (ingridient_id) REFERENCES ingridients (id),
    CONSTRAINT fk_pizza_id FOREIGN KEY (pizza_id) REFERENCES pizza (id)
);
