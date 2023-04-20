insert into "colors"("title") values 
('Красный'),
('Синий'),
('Чёрный'),
('Белый'),
('Жёлтый');

insert into "clients"("firstname", "patronymic", "surname") values 
('Александр', 'Александрович', 'Александров'),
('Сергей', 'Сергеевич', 'Сергеев'),
('Антон', 'Антонович', 'Антонов'),
('Мария', 'Сергеевна', 'Марьянова');

insert into "car_brands"("title") values
('Toyota'),
('Nissan'),
('Honda'),
('Hyundai');

insert into "car_models"("title") values 
('Camry'), --Toyota
('Corolla'),
('RAV4'),
('Land Cruiser'), 
('Note'), --Nissan
('Juke'),
('Teana'),
('Qashqai'),
('Fit'), --Honda
('Freed'),
('Accord'),
('Vezel'),
('Solaris'), --Hyundai
('Tucson'),
('Creta'),
('Accent');

insert into "cars"("price", "car_brand_id", "car_model_id", "color_id") values
(560000, 1, 1, 1),
(900000, 1, 2, 2),
(800000, 1, 3, 3),
(567000, 1, 4, 4),
(457867, 2, 5, 5),
(200000, 2, 6, 1),
(3000000, 2, 7, 2),
(348936, 2, 8, 3),
(235525, 3, 9, 4),
(235356, 3, 10, 5),
(523523, 3, 11, 1),
(4634636, 3, 12, 2),
(346363, 4, 13, 3),
(4363622, 4, 14, 4),
(232653, 4, 15, 5),
(6346326, 4, 16, 1);

insert into "orders"("client_id") values
(1),
(2),
(3),
(4);

insert into "order_car"("order_id", "car_id", "count") values 
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(2, 1, 4),
(2, 5, 1),
(3, 9, 1),
(3, 10, 1),
(4, 12, 1);