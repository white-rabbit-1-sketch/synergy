--
-- PostgreSQL database dump
--

-- Dumped from database version 12.17 (Ubuntu 12.17-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.17 (Ubuntu 12.17-0ubuntu0.20.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: calcpizzacost(integer, integer); Type: FUNCTION; Schema: public; Owner: root
--

CREATE FUNCTION public.calcpizzacost(p_id integer, percent integer) RETURNS real
    LANGUAGE plpgsql
    AS $$
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
END; $$;


ALTER FUNCTION public.calcpizzacost(p_id integer, percent integer) OWNER TO root;

--
-- Name: update_order_content_costs(); Type: FUNCTION; Schema: public; Owner: root
--

CREATE FUNCTION public.update_order_content_costs() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN

    NEW.cost := (SELECT p.cost
                 FROM pizza p
                 WHERE p.id = NEW.pizza_id);
    NEW.first_cost := (SELECT p.cooking_cost
                 FROM pizza p
                 WHERE p.id = NEW.pizza_id);

RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_order_content_costs() OWNER TO root;

--
-- Name: update_pizza_cost_on_cooking_cost_change(); Type: FUNCTION; Schema: public; Owner: root
--

CREATE FUNCTION public.update_pizza_cost_on_cooking_cost_change() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    RAISE NOTICE 'Updating pizza cost for pizza_id %, new cooking_cost: %', NEW.id, NEW.cooking_cost;

    NEW.cost := calcPizzaCost(NEW.id, 10);

    RAISE NOTICE 'Updated pizza cost to %', NEW.cost;

RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_pizza_cost_on_cooking_cost_change() OWNER TO root;

--
-- Name: update_pizza_cost_on_ingredient_change(); Type: FUNCTION; Schema: public; Owner: root
--

CREATE FUNCTION public.update_pizza_cost_on_ingredient_change() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN

UPDATE pizza SET cost = calcPizzaCost(NEW.pizza_id, 10);
UPDATE pizza SET cooking_cost = calcPizzaCost(NEW.pizza_id, 0);

RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_pizza_cost_on_ingredient_change() OWNER TO root;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: address; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.address (
    id integer NOT NULL,
    city_id integer NOT NULL,
    street character varying(100) NOT NULL,
    house character varying(100) NOT NULL,
    flat smallint
);


ALTER TABLE public.address OWNER TO root;

--
-- Name: address_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.address_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.address_id_seq OWNER TO root;

--
-- Name: address_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.address_id_seq OWNED BY public.address.id;


--
-- Name: archived_order_content; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.archived_order_content (
    order_id integer,
    pizza_id integer,
    amaunt smallint,
    cost numeric(10,2),
    first_cost numeric(10,2)
);


ALTER TABLE public.archived_order_content OWNER TO root;

--
-- Name: archived_orders; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.archived_orders (
    id integer,
    customer_id integer,
    address_id integer,
    order_date timestamp without time zone,
    comment text,
    status_id integer,
    company_branch_id integer
);


ALTER TABLE public.archived_orders OWNER TO root;

--
-- Name: branches; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.branches (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    city_id integer NOT NULL,
    street character varying(100) NOT NULL,
    house character varying(100) NOT NULL
);


ALTER TABLE public.branches OWNER TO root;

--
-- Name: branches_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.branches_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.branches_id_seq OWNER TO root;

--
-- Name: branches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.branches_id_seq OWNED BY public.branches.id;


--
-- Name: cities; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.cities (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    region_id integer NOT NULL
);


ALTER TABLE public.cities OWNER TO root;

--
-- Name: cities_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.cities_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cities_id_seq OWNER TO root;

--
-- Name: cities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.cities_id_seq OWNED BY public.cities.id;


--
-- Name: countries; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.countries (
    id integer NOT NULL,
    name character varying(255)
);


ALTER TABLE public.countries OWNER TO root;

--
-- Name: countries_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.countries_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.countries_id_seq OWNER TO root;

--
-- Name: countries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.countries_id_seq OWNED BY public.countries.id;


--
-- Name: customers; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.customers (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(100) NOT NULL,
    discount integer DEFAULT 0
);


ALTER TABLE public.customers OWNER TO root;

--
-- Name: customers_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.customers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.customers_id_seq OWNER TO root;

--
-- Name: customers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.customers_id_seq OWNED BY public.customers.id;


--
-- Name: ingridients; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.ingridients (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    cost numeric(10,2) NOT NULL
);


ALTER TABLE public.ingridients OWNER TO root;

--
-- Name: ingridients_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.ingridients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ingridients_id_seq OWNER TO root;

--
-- Name: ingridients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.ingridients_id_seq OWNED BY public.ingridients.id;


--
-- Name: menu_categories; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.menu_categories (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    parent_id integer
);


ALTER TABLE public.menu_categories OWNER TO root;

--
-- Name: menu_categories_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.menu_categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menu_categories_id_seq OWNER TO root;

--
-- Name: menu_categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.menu_categories_id_seq OWNED BY public.menu_categories.id;


--
-- Name: order_content; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.order_content (
    order_id integer NOT NULL,
    pizza_id integer NOT NULL,
    amaunt smallint DEFAULT 1 NOT NULL,
    cost numeric(10,2) NOT NULL,
    first_cost numeric(10,2)
);


ALTER TABLE public.order_content OWNER TO root;

--
-- Name: order_status; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.order_status (
    id integer NOT NULL,
    name character varying(50)
);


ALTER TABLE public.order_status OWNER TO root;

--
-- Name: order_status_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.order_status_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_status_id_seq OWNER TO root;

--
-- Name: order_status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.order_status_id_seq OWNED BY public.order_status.id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.orders (
    id integer NOT NULL,
    customer_id integer,
    address_id integer,
    order_date timestamp without time zone DEFAULT now() NOT NULL,
    comment text,
    status_id integer NOT NULL,
    company_branch_id integer NOT NULL
);


ALTER TABLE public.orders OWNER TO root;

--
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.orders_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_id_seq OWNER TO root;

--
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- Name: pizza; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.pizza (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    recipe integer,
    cost smallint,
    description bigint,
    cooking_cost smallint
);


ALTER TABLE public.pizza OWNER TO root;

--
-- Name: pizza_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.pizza_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pizza_id_seq OWNER TO root;

--
-- Name: pizza_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.pizza_id_seq OWNED BY public.pizza.id;


--
-- Name: recipe; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.recipe (
    pizza_id integer NOT NULL,
    ingridient_id integer NOT NULL,
    weight smallint NOT NULL,
    action_id integer NOT NULL
);


ALTER TABLE public.recipe OWNER TO root;

--
-- Name: recipe_actions; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.recipe_actions (
    id integer NOT NULL,
    name character varying(255),
    cost smallint
);


ALTER TABLE public.recipe_actions OWNER TO root;

--
-- Name: recipe_actions_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.recipe_actions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipe_actions_id_seq OWNER TO root;

--
-- Name: recipe_actions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.recipe_actions_id_seq OWNED BY public.recipe_actions.id;


--
-- Name: regions; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.regions (
    id integer NOT NULL,
    name character varying(255),
    country_id integer NOT NULL
);


ALTER TABLE public.regions OWNER TO root;

--
-- Name: regions_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.regions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.regions_id_seq OWNER TO root;

--
-- Name: regions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.regions_id_seq OWNED BY public.regions.id;


--
-- Name: address id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.address ALTER COLUMN id SET DEFAULT nextval('public.address_id_seq'::regclass);


--
-- Name: branches id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.branches ALTER COLUMN id SET DEFAULT nextval('public.branches_id_seq'::regclass);


--
-- Name: cities id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.cities ALTER COLUMN id SET DEFAULT nextval('public.cities_id_seq'::regclass);


--
-- Name: countries id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.countries ALTER COLUMN id SET DEFAULT nextval('public.countries_id_seq'::regclass);


--
-- Name: customers id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.customers ALTER COLUMN id SET DEFAULT nextval('public.customers_id_seq'::regclass);


--
-- Name: ingridients id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.ingridients ALTER COLUMN id SET DEFAULT nextval('public.ingridients_id_seq'::regclass);


--
-- Name: menu_categories id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.menu_categories ALTER COLUMN id SET DEFAULT nextval('public.menu_categories_id_seq'::regclass);


--
-- Name: order_status id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.order_status ALTER COLUMN id SET DEFAULT nextval('public.order_status_id_seq'::regclass);


--
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- Name: pizza id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.pizza ALTER COLUMN id SET DEFAULT nextval('public.pizza_id_seq'::regclass);


--
-- Name: recipe_actions id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.recipe_actions ALTER COLUMN id SET DEFAULT nextval('public.recipe_actions_id_seq'::regclass);


--
-- Name: regions id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.regions ALTER COLUMN id SET DEFAULT nextval('public.regions_id_seq'::regclass);


--
-- Data for Name: address; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.address (id, city_id, street, house, flat) FROM stdin;
1	1	Street1	House1	101
2	2	Street2	House2	202
3	3	Street3	House3	303
4	4	Street4	House4	404
5	5	Street5	House5	505
\.


--
-- Data for Name: archived_order_content; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.archived_order_content (order_id, pizza_id, amaunt, cost, first_cost) FROM stdin;
3	3	3	2100.00	457.50
4	4	1	800.00	212.50
5	5	2	1800.00	545.00
\.


--
-- Data for Name: archived_orders; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.archived_orders (id, customer_id, address_id, order_date, comment, status_id, company_branch_id) FROM stdin;
3	3	3	2023-03-03 16:45:00	Order Comment 3	3	3
4	4	4	2023-04-04 18:20:00	Order Comment 4	4	4
5	5	5	2023-05-05 20:10:00	Order Comment 5	5	5
\.


--
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.branches (id, name, city_id, street, house) FROM stdin;
1	Branch1	1	Street1	House1
2	Branch2	2	Street2	House2
3	Branch3	3	Street3	House3
4	Branch4	4	Street4	House4
5	Branch5	5	Street5	House5
\.


--
-- Data for Name: cities; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.cities (id, name, region_id) FROM stdin;
1	City1	1
2	City2	2
3	City3	3
4	City4	1
5	City5	4
\.


--
-- Data for Name: countries; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.countries (id, name) FROM stdin;
1	Country1
2	Country2
3	Country3
4	Country4
5	Country5
\.


--
-- Data for Name: customers; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.customers (id, name, email, phone, discount) FROM stdin;
3	Customer3	customer3@email.com	555-123-4567	0
4	Customer4	customer4@email.com	111-222-3333	0
5	Customer5	customer5@email.com	999-888-7777	0
2	Customer2	customer2@email.com	987-654-3210	10
1	Customer1	customer1@email.com	123-456-7890	10
\.


--
-- Data for Name: ingridients; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.ingridients (id, name, cost) FROM stdin;
1	Ingredient1	350.00
2	Ingredient2	350.00
3	Ingredient3	350.00
4	Ingredient4	350.00
5	Ingredient5	350.00
\.


--
-- Data for Name: menu_categories; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.menu_categories (id, name, parent_id) FROM stdin;
1	Category1	\N
2	Category2	\N
3	Subcategory1-1	1
4	Subcategory1-2	1
5	Subcategory2-1	2
6	Subcategory2-2	2
7	Subsubcategory1-1-1	3
8	Subsubcategory1-1-2	3
\.


--
-- Data for Name: order_content; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.order_content (order_id, pizza_id, amaunt, cost, first_cost) FROM stdin;
3	3	3	2100.00	457.50
4	4	1	800.00	212.50
5	5	2	1800.00	545.00
5	4	2	263.00	50.00
\.


--
-- Data for Name: order_status; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.order_status (id, name) FROM stdin;
1	Pending
2	In Progress
3	Completed
4	Canceled
5	Delivered
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.orders (id, customer_id, address_id, order_date, comment, status_id, company_branch_id) FROM stdin;
3	3	3	2023-03-03 16:45:00	Order Comment 3	3	3
4	4	4	2023-04-04 18:20:00	Order Comment 4	4	4
5	5	5	2023-05-05 20:10:00	Order Comment 5	5	5
\.


--
-- Data for Name: pizza; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.pizza (id, name, recipe, cost, description, cooking_cost) FROM stdin;
2	Pizza2	2	3010	54321	2736
4	Pizza4	4	3045	56789	2768
5	Pizza5	5	4011	43210	3646
1	Pizza1	1	4143	12345	3766
3	Pizza3	3	4178	98765	3798
\.


--
-- Data for Name: recipe; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.recipe (pizza_id, ingridient_id, weight, action_id) FROM stdin;
1	1	200	1
2	2	300	2
3	3	150	3
4	4	250	4
5	5	350	5
5	4	350	5
5	3	350	5
5	2	350	5
\.


--
-- Data for Name: recipe_actions; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.recipe_actions (id, name, cost) FROM stdin;
1	Action1	50
2	Action2	75
3	Action3	100
4	Action4	125
5	Action5	150
\.


--
-- Data for Name: regions; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.regions (id, name, country_id) FROM stdin;
1	North	1
2	South	2
3	East	3
4	West	4
5	Central	5
\.


--
-- Name: address_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.address_id_seq', 1, false);


--
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.branches_id_seq', 1, false);


--
-- Name: cities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.cities_id_seq', 1, false);


--
-- Name: countries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.countries_id_seq', 1, false);


--
-- Name: customers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.customers_id_seq', 1, false);


--
-- Name: ingridients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.ingridients_id_seq', 1, false);


--
-- Name: menu_categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.menu_categories_id_seq', 8, true);


--
-- Name: order_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.order_status_id_seq', 1, false);


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.orders_id_seq', 1, false);


--
-- Name: pizza_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.pizza_id_seq', 1, false);


--
-- Name: recipe_actions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.recipe_actions_id_seq', 1, false);


--
-- Name: regions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.regions_id_seq', 1, false);


--
-- Name: address address_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.address
    ADD CONSTRAINT address_pkey PRIMARY KEY (id);


--
-- Name: branches branches_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.branches
    ADD CONSTRAINT branches_pkey PRIMARY KEY (id);


--
-- Name: cities cities_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);


--
-- Name: countries countries_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.countries
    ADD CONSTRAINT countries_pkey PRIMARY KEY (id);


--
-- Name: customers customers_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers_pkey PRIMARY KEY (id);


--
-- Name: ingridients ingridients_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.ingridients
    ADD CONSTRAINT ingridients_pkey PRIMARY KEY (id);


--
-- Name: menu_categories menu_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.menu_categories
    ADD CONSTRAINT menu_categories_pkey PRIMARY KEY (id);


--
-- Name: order_content order_content_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.order_content
    ADD CONSTRAINT order_content_pkey PRIMARY KEY (order_id, pizza_id);


--
-- Name: order_status order_status_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.order_status
    ADD CONSTRAINT order_status_pkey PRIMARY KEY (id);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: pizza pizza_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.pizza
    ADD CONSTRAINT pizza_pkey PRIMARY KEY (id);


--
-- Name: recipe_actions recipe_actions_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.recipe_actions
    ADD CONSTRAINT recipe_actions_pkey PRIMARY KEY (id);


--
-- Name: recipe recipe_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.recipe
    ADD CONSTRAINT recipe_pkey PRIMARY KEY (pizza_id, ingridient_id);


--
-- Name: regions regions_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.regions
    ADD CONSTRAINT regions_pkey PRIMARY KEY (id);


--
-- Name: idx_customers_email; Type: INDEX; Schema: public; Owner: root
--

CREATE INDEX idx_customers_email ON public.customers USING btree (email);


--
-- Name: idx_customers_phone; Type: INDEX; Schema: public; Owner: root
--

CREATE INDEX idx_customers_phone ON public.customers USING btree (phone);


--
-- Name: pizza on_cooking_cost_change; Type: TRIGGER; Schema: public; Owner: root
--

CREATE TRIGGER on_cooking_cost_change BEFORE UPDATE OF cooking_cost ON public.pizza FOR EACH ROW EXECUTE FUNCTION public.update_pizza_cost_on_cooking_cost_change();


--
-- Name: order_content on_order_content_insert; Type: TRIGGER; Schema: public; Owner: root
--

CREATE TRIGGER on_order_content_insert BEFORE INSERT ON public.order_content FOR EACH ROW EXECUTE FUNCTION public.update_order_content_costs();


--
-- Name: recipe on_recipe_delete; Type: TRIGGER; Schema: public; Owner: root
--

CREATE TRIGGER on_recipe_delete AFTER DELETE ON public.recipe FOR EACH ROW EXECUTE FUNCTION public.update_pizza_cost_on_ingredient_change();


--
-- Name: recipe on_recipe_insert; Type: TRIGGER; Schema: public; Owner: root
--

CREATE TRIGGER on_recipe_insert AFTER INSERT ON public.recipe FOR EACH ROW EXECUTE FUNCTION public.update_pizza_cost_on_ingredient_change();


--
-- Name: recipe fk_action_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.recipe
    ADD CONSTRAINT fk_action_id FOREIGN KEY (action_id) REFERENCES public.recipe_actions(id);


--
-- Name: orders fk_address_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT fk_address_id FOREIGN KEY (address_id) REFERENCES public.address(id);


--
-- Name: branches fk_branches_city_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.branches
    ADD CONSTRAINT fk_branches_city_id FOREIGN KEY (city_id) REFERENCES public.cities(id);


--
-- Name: address fk_city_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.address
    ADD CONSTRAINT fk_city_id FOREIGN KEY (city_id) REFERENCES public.cities(id);


--
-- Name: orders fk_company_branch_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT fk_company_branch_id FOREIGN KEY (company_branch_id) REFERENCES public.branches(id);


--
-- Name: regions fk_country_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.regions
    ADD CONSTRAINT fk_country_id FOREIGN KEY (country_id) REFERENCES public.countries(id);


--
-- Name: orders fk_customer_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT fk_customer_id FOREIGN KEY (customer_id) REFERENCES public.customers(id);


--
-- Name: recipe fk_ingridient_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.recipe
    ADD CONSTRAINT fk_ingridient_id FOREIGN KEY (ingridient_id) REFERENCES public.ingridients(id);


--
-- Name: order_content fk_order_content_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.order_content
    ADD CONSTRAINT fk_order_content_id FOREIGN KEY (order_id) REFERENCES public.orders(id);


--
-- Name: orders fk_order_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT fk_order_id FOREIGN KEY (status_id) REFERENCES public.order_status(id);


--
-- Name: order_content fk_pizza_content_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.order_content
    ADD CONSTRAINT fk_pizza_content_id FOREIGN KEY (pizza_id) REFERENCES public.pizza(id);


--
-- Name: recipe fk_pizza_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.recipe
    ADD CONSTRAINT fk_pizza_id FOREIGN KEY (pizza_id) REFERENCES public.pizza(id);


--
-- Name: cities fk_region_id; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.cities
    ADD CONSTRAINT fk_region_id FOREIGN KEY (region_id) REFERENCES public.regions(id);


--
-- Name: menu_categories menu_categories_parent_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.menu_categories
    ADD CONSTRAINT menu_categories_parent_id_fkey FOREIGN KEY (parent_id) REFERENCES public.menu_categories(id);


--
-- PostgreSQL database dump complete
--

