select car_models.title 
from cars
inner join car_models on car_models.id = cars.car_model_id 
inner join car_brands on car_brands.id = cars.car_brand_id 
where car_brands.title = 'Toyota';

select car_brands.title, car_model_id, price, colors.title 
from cars
inner join car_brands on car_brands.id = cars.car_brand_id 
inner join colors on colors.id = cars.color_id 
where car_brands.title = 'Toyota' and colors.title = 'Красный';

select car_brands.title, sum("price" * "count") as "sum"
from order_car
inner join cars on cars.id = order_car.car_id 
inner join car_brands on car_brands.id = cars.car_brand_id 
where car_brands.title = 'Toyota'
group by car_brands.title;