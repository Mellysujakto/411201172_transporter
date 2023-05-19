<p align="center"><img src="http://s3.amazonaws.com/gt7sp-prod/decal/16/28/76/4827877505209762816_1.png"></p>


# Transporter

This is the base code of Transporter Website.


## About Transporter

Transporter is a goods delivery service company, either in the form of documents or packages. J&T Express is a new company that also uses IT in offering its services, they offer benefits in picking up goods.


## Getting Started

### Pre-requisites
1. laravel version 5.8.0

2. mysql


### How to run
1. Do `composer install` to install all dependencies.

2. Import `transporter.sql` as this project's DB.

3. Run project `php artisan serve`.


### How to use
#### Before execute another endpoints, please create a kurir account first by this endpoint:

`POST /api/kurir/register` 


#### After that, get the `api_token` by this endpoint: 

`POST /api/kurir/authentication`

and put it in each request as `Bearer Token`.


#### Finally, you could execute these endpoints below:

##### CRUD for table kurir:

`GET /api/kurir`
    
`GET /api/kurir/{id}`

`POST /api/kurir`
    
`PUT /api/kurir`
    
`DELETE /api/kurir/{id}`


##### CRUD for table barang:
    
`GET /api/barang`
    
`GET /api/barang/{id}`    
    
`POST /api/barang`
    
`PUT /api/barang`
    
`DELETE /api/barang/{id}`


##### CRUD for table lokasi

`GET /api/lokasi`
    
`GET /api/lokasi/{id}`    
    
`POST /api/lokasi`
    
`PUT /api/lokasi`
    
`DELETE /api/lokasi/{id}`


##### Input/submit pengiriman:

`POST /api/pengiriman/input`
   

##### Approve pengiriman: 

`POST /api/pengiriman/approve`


##### Check status of pengiriman: 

`GET /api/pengiriman/status/{id}`
