# Integrate OpenAPI in Symfony projects

---
title: OpenAPI lightning talk @PHPUGDD Meetup V/2022
author: Jan Männig (move:elevator)
date: 2022-12-07
---

## Topics

1. OpenAPI short overview
   * https://www.openapis.org/
   * https://redocly.github.io/redoc/
2. Why open api schemas in projects
3. Integrate for validation
    * https://github.com/thephpleague/openapi-psr7-validator
    * validate request against schema
    * custom validator
4. Create api documentation
    * generate api doc
    * example what's possible -> https://redocly.github.io/redoc/
5. Import in postman
6. Todos next level
    * validate response
    * extend document with additional information
7. Alternatives
   NelmioApiDocBundle https://symfony.com/bundles/NelmioApiDocBundle/current/index.html

## Try project
1. run ```composer install``` in folder ./application
2. start docker
3. run ```../vm/sh/server_start.sh``` in folder ./application

## Dependencies

* league/openapi-psr7-validator
* nyholm/psr7
* symfony/psr-http-message-bridge

