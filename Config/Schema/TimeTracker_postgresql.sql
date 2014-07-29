DROP TABLE IF EXISTS time_tracker_categories CASCADE;
DROP TABLE IF EXISTS time_tracker_customers CASCADE;
DROP TABLE IF EXISTS time_tracker_activities CASCADE;


CREATE TABLE time_tracker_categories (
    id bigserial NOT NULL,
    name character varying(255) NOT NULL,
    comment text,
    parent_id int,
    lft int,
    rght int,
    created timestamp without time zone,
    modified timestamp without time zone
);

ALTER TABLE time_tracker_categories
    ADD CONSTRAINT time_tracker_categories_pkey PRIMARY KEY(id),
    ADD CONSTRAINT time_tracker_categories_name UNIQUE (name);


CREATE TABLE time_tracker_customers (
    id bigserial NOT NULL,
    name character varying(255) NOT NULL,
    comment text,
    created timestamp without time zone,
    modified timestamp without time zone
);

ALTER TABLE time_tracker_customers
    ADD CONSTRAINT time_tracker_customers_pkey PRIMARY KEY(id),
    ADD CONSTRAINT time_tracker_customers_name UNIQUE (name);


CREATE TABLE time_tracker_activities (
    id bigserial NOT NULL,
    "date" date NOT NULL,
    user_id bigint NOT NULL,
    time_tracker_customer_id bigint NOT NULL,
    time_tracker_category_id bigint NOT NULL,
    duration interval NOT NULL,
    comment text,
    created timestamp without time zone,
    modified timestamp without time zone
);

ALTER TABLE time_tracker_activities
    ADD CONSTRAINT time_tracker_activities_pkey PRIMARY KEY(id);

