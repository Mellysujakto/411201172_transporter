<p align="center"><img src="http://s3.amazonaws.com/gt7sp-prod/decal/16/28/76/4827877505209762816_1.png"></p>


# Transporter

This is the base code of Transporter Website.


## About Transporter

Transporter is a goods delivery service company, either in the form of documents or packages. J&T Express is a new company that also uses IT in offering its services, they offer benefits in picking up goods.


## Getting Started

### Pre-requisites
laravel version 5.8.0

mysql


### How to run
Do `composer install` to install all dependencies.

Import `transporter.sql` as this project's DB.

Run project `php artisan serve`.


### How to use
Before execute another endpoints, please create a kurir account first by this endpoint:

`POST /kurir/register` 


After that, get the `api_token` by this endpoint: 

`POST /kurir/authentication`

and put it in each request as `Bearer Token`.


Finally, you could execute these endpoints below:

CRUD for table kurir:

`GET /kurir`
    
`GET /kurir/{id}`

`POST /kurir`
    
`PUT /kurir`
    
`DELETE /kurir/{id}`


CRUD for table barang:
    
`GET /barang`
    
`GET /barang/{id}`    
    
`POST /barang`
    
`PUT /barang`
    
`DELETE /barang/{id}`


CRUD for table lokasi

`GET /lokasi`
    
`GET /lokasi/{id}`    
    
`POST /lokasi`
    
`PUT /lokasi`
    
`DELETE /lokasi/{id}`


Input/submit pengiriman:

`POST /pengiriman/input`
   

Approve pengiriman: 

`POST /pengiriman/approve`


Check status of pengiriman: 

`GET /pengiriman/status/{id}`
