-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION pg_database_owner;

-- DROP SEQUENCE public.car_brands_id_seq;

CREATE SEQUENCE public.car_brands_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.car_models_id_seq;

CREATE SEQUENCE public.car_models_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.cars_id_seq;

CREATE SEQUENCE public.cars_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.clients_id_seq;

CREATE SEQUENCE public.clients_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.colors_id_seq;

CREATE SEQUENCE public.colors_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.orders_id_seq;

CREATE SEQUENCE public.orders_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;-- public.car_brands definition

-- Drop table

-- DROP TABLE public.car_brands;

CREATE TABLE public.car_brands (
	id serial4 NOT NULL,
	title varchar(255) NOT NULL,
	CONSTRAINT pk_car_brands PRIMARY KEY (id)
);


-- public.car_models definition

-- Drop table

-- DROP TABLE public.car_models;

CREATE TABLE public.car_models (
	id serial4 NOT NULL,
	title varchar(255) NOT NULL,
	CONSTRAINT pk_car_models PRIMARY KEY (id)
);


-- public.clients definition

-- Drop table

-- DROP TABLE public.clients;

CREATE TABLE public.clients (
	id serial4 NOT NULL,
	firstname varchar(255) NOT NULL,
	patronymic varchar(255) NULL,
	surname varchar(255) NOT NULL,
	CONSTRAINT pk_clients PRIMARY KEY (id)
);


-- public.colors definition

-- Drop table

-- DROP TABLE public.colors;

CREATE TABLE public.colors (
	id serial4 NOT NULL,
	title varchar(255) NOT NULL,
	CONSTRAINT pk_colors PRIMARY KEY (id)
);


-- public.cars definition

-- Drop table

-- DROP TABLE public.cars;

CREATE TABLE public.cars (
	id serial4 NOT NULL,
	price int4 NOT NULL,
	car_brand_id int8 NOT NULL,
	car_model_id int8 NOT NULL,
	color_id int8 NOT NULL,
	CONSTRAINT pk_cars PRIMARY KEY (id),
	CONSTRAINT fk_cars_car_brands FOREIGN KEY (car_brand_id) REFERENCES public.car_brands(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_cars_car_models FOREIGN KEY (car_model_id) REFERENCES public.car_models(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_cars_colors FOREIGN KEY (color_id) REFERENCES public.colors(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


-- public.orders definition

-- Drop table

-- DROP TABLE public.orders;

CREATE TABLE public.orders (
	id serial4 NOT NULL,
	client_id int8 NOT NULL,
	status varchar(255) NOT NULL DEFAULT 'NEW'::character varying,
	CONSTRAINT pk_orders PRIMARY KEY (id),
	CONSTRAINT fk_orders_clients FOREIGN KEY (client_id) REFERENCES public.clients(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);


-- public.order_car definition

-- Drop table

-- DROP TABLE public.order_car;

CREATE TABLE public.order_car (
	order_id int8 NOT NULL,
	car_id int8 NOT NULL,
	count int8 NOT NULL,
	CONSTRAINT pk_order_car PRIMARY KEY (order_id, car_id),
	CONSTRAINT fk_order_car_cars FOREIGN KEY (car_id) REFERENCES public.cars(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT fk_order_car_orders FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
