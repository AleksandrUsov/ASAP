create table "car_brands" (
"id" serial not null,
"title" varchar(255) not null,
constraint PK_Car_brands primary key ("id")
);

create table "car_models" (
"id" serial not null,
"title" varchar(255) not null,
constraint PK_Car_models primary key ("id")
);

create table "colors" (
"id" serial not null,
"title" varchar(255) not null,
constraint PK_colors primary key ("id")
);

create table "cars" (
"id" serial not null,
"price" int not null,
"car_brand_id" bigint not null,
"car_model_id" bigint not null,
"color_id" bigint not null,
constraint PK_Cars primary key ("id"),
constraint FK_Cars_Car_brands foreign key ("car_brand_id") references "car_brands"("id")
on update restrict on delete restrict,
constraint FK_Cars_Car_models foreign key ("car_model_id") references "car_models"("id")
on update restrict on delete restrict,
constraint FK_Cars_Colors foreign key ("color_id") references "colors"("id")
on update restrict on delete restrict
);

create table "clients" (
"id" serial not null,
"firstname" varchar(255) not null,
"patronymic" varchar(255),
"surname" varchar(255) not null,
constraint PK_Clients primary key ("id")
);

create table "orders" (
"id" serial not null,
"client_id" bigint not null,
"status" varchar(255) not null default 'NEW',
constraint PK_Orders primary key ("id"),
constraint FK_Orders_Clients foreign key ("client_id") references "clients"("id") 
on update restrict on delete restrict
);

create table "order_car" (
"order_id" bigint not null,
"car_id" bigint not null,
"count" bigint not null,
constraint PK_Order_car primary key ("order_id", "car_id"),
constraint FK_Order_car_Orders foreign key ("order_id") references "orders"("id")
on update restrict on delete restrict,
constraint FK_Order_car_Cars foreign key ("car_id") references "cars"("id")
on update restrict on delete restrict
);