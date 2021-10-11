<h1>İstifadə üçün təlimat</h1>
<hr>
ENV faylından bazanı quraşdırdıqdan sonra atılacaq addımlar:
<ul>
    <li>composer update</li>
    <li>php artisan migrate</li>
    <li>php artisan db:seed --class=Products</li>
    <li>php artisan serve</li>
</ul>
<hr>

```yml
-----------------
GET: 127.0.0.1:8000/api/products?page=1
Bütün SB-ların siyahısı
-----------------

-----------------
GET: 127.0.0.1:8000/api/products/1
SB-un özəlliklərini gətirir
-----------------

-----------------
POST: 127.0.0.1:8000/api/order
{
    "product_id": 1,
    "color_id": color_id colors cədvəlindən daxil edin,
    "amount": 4,
    "custom_print_photo": image125.jpg, //type=file
    "email": null,
    "phone": "+994993338823",
    "address": "Sumgayit, Azerbaijan"
}
-----------------

-----------------
PUT: 127.0.0.1:8000/api/order/1
{
    "delivery_date": "2021-10-15 23:22:02",
    "preparation_date": "2021-10-15 20:22:02"
}
-----------------
