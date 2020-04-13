# API REST PHP
This is an PHP API REST it is the result of taking a API REST course

## Prerequisites
Install PHP, do it as root or write ```sudo``` before the commands

```
apt update
apt upgrade
apt install php
```

## Getting started

Clone or download the repository

To run this projet use the "visual" branch and inside the project folder run

```
php -S localhost:8000 router.php
```

Then open localhost:8000 in a web browser, the interface implemented allow GET and POST HTTPS methods.


To use DELETE method

```
curl -X 'DELETE' http://localhost:8000/books/1
```

To use PUT mehod

```
curl -X 'PUT' http://localhost:8000/books/1 -d '{"titulo":"nuevo Libro","id_autor":1,"id_genero":2}'
```

## Build With
- PHP 7
- JS
- AJAX
- Boostrap 4
