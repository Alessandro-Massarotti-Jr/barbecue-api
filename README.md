# Barbecue-Api


<p>
  <img src="https://img.shields.io/badge/made%20by-Alessandro%20Massarotti%20Jr-ffd836?style=flat-square">
  <img src="https://img.shields.io/badge/PHP-8.2.4-ffd836?style=flat-square">
  <img src="https://img.shields.io/badge/Composer-2.6.3-ffd836?style=flat-square">
  <img src="https://img.shields.io/badge/Laravel-10.28.0-ffd836?style=flat-square">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/alessandro-massarotti-Jr/barbecue-api?color=ffd836&style=flat-square">
  <img alt="GitHub Top Language" src="https://img.shields.io/github/languages/top/alessandro-massarotti-Jr/barbecue-api?color=ffd836&style=flat-square">
</p>

This API was developed with the aim of registering and controlling barbecues.  
In this API must be possible:

- Create, Read, Update and Delete Users
- Create, Read, Update and Delete Barbecues
- Authenticate registered Users
    
That API must serve [This](https://trinca-frontend-test.vercel.app/) FrontEnd application from [Icaro Apolo](https://github.com/IcaroApoloBR)

Link for [Api Documentation](https://documenter.getpostman.com/view/28170394/2s9YRCXrdA)

## Sumary

- [Barbecue-Api](#barbecue-api)
  - [Sumary](#sumary)
  - [Database](#database)
  - [config](#config)
  - [Tools](#tools)

## Database

 <img src="./barbecue-api-diagram.png" alt="diagrama">

## config

Create the `.env` file based on `.env.example` file.

```bash
 composer install #to install project dependencies
```

```bash
 php artisan migrate --seed #to run database migrations and seed the database with fake data
```
```bash
 php artisan storage:link #to create a symlink to storage folder
```

```bash
 php artisan serve #to start development server
```



## Tools

 - [PHP](https://www.php.net/docs.php)
 - [Composer](https://getcomposer.org/)
 - [Laravel](https://laravel.com/)


<br>

---

Developed By [Alessandro Massarotti Jr](https://github.com/alessandro-massarotti-jr) 🤖