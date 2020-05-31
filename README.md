# Kiah Store

KiahStore Store is a SAAS e-commerce. This application was develop as the require of KJ to helping the small and medium business during and post COVID-19 pandemic. KiahStore Store allow business owner to register and operate an online store with too much hassle.


# Feature

## Users
- Visitor
- Customer
- Business owner
#### Visitor

Can visit the system front page, store front page, register as a customer and business owner.

#### Customer
Can purchase item, manage self data, manage purchases.

#### Business Owner
Can create store, manage store, manage product, Manager orders.

# Development

## How to contribute

KiahStore Store welcomes contributions to the project source code. 

## How to run locally

KiahStore store utilise docker and container technology to help the development and deployment of the project. To run locally, make sure to have `docker` and `docker-compose` install in your machine. And runt he follow code on the project root folder
```
docker-compose up
```
Once the container finish starting up, you can visit `http://localhost` to check the website.

### Change the hosts on the local computer

```
# KiahStore domain
127.0.0.1       www.localhost
127.0.0.1       admin.localhost
127.0.0.1       ks.localhost
127.0.0.1       ks.my
127.0.0.1       test.ks.my
127.0.0.1       test2.ks.my
127.0.0.1       ks2.my
127.0.0.1       test.ks2.my
127.0.0.1       test2.ks2.my
```
By changing the host, we can test multiple domain/subdomain locally.

### How to run Artisan

```
docker-compose exec kiahstore composer install

docker-compose exec kiahstore php artisan make:model attachment -m

docker-compose exec kiahstore php artisan migrate

docker-compose exec kiahstore php artisan route

docker-compose exec kiahstore $yourCommandHere
```

# How to Access PHPMYADMIN

PHPMYADMIN can be access at `http://localhost:3300`