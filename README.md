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


### How to run Artisan

```
docker-compose exec php composer install

docker-compose exec php php artisan key:generate

docker-compose exec php php artisan migrate

docker-compose exec php $yourCommandHere
```