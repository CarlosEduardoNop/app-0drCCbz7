<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tecnologias usadas

- [PHP 8.0.13].
- [Laravel 8.75].


## Como utilizar a API

## Puxar os produtos

Para puxar os produtos basta utilizar o metodo GET na url abaixo utilizando o content-type "application/json".
> http://127.0.0.1:8000/api/produtos

## Cadastrar um produto

Para cadastrar um usuário é necessário passar por meio do body a string "nome" e a quantidade de produtos pela string "quantidade"(O valor quantidade só suporta o tipo number). O SKU é gerado automaticamente pelo sistema.
> http://127.0.0.1:8000/api/produto/store
Exemplo de como pode ser passado:
> {
    > "nome": "Produto1234",
    > "quantidade": 5
> }

## Alterar um produto

Para alterar o produto é necessário passar o que quer que seja alterado, podendo escolher apenas alterar SKU(tome muito cuidado antes de alterar) ou quantidade. Para alterar a quantidade é possível utilizar as operações de adição e subtração, onde pode ser passado como string "+" ou "-", caso não passe este valor será então "+". Sempre utilizando o content-type "application/json"
Exemplo de como podem ser passados:
###### Alterar o SKU
> {
    > "sku": true
> }

###### Adicionar estoque ao produto
> {
    > "quantidade": 2,
    > "operacao": "+"
> }

> {
    > "quantidade": 4
> }

###### Remover estoque ao produto

> {
    > "quantidade": 1,
    > "operacao": "-"
> }

###### Adicionar estoque ao produto e alterar SKU

> {
    > "quantidade": 10,
    > "operacao": "+",
    > "sku": true
> }