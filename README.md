
<a name="readme-top"></a>

<br />
<div align="center">

  <h3 align="center">Backend</h3>

</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
         <li><a href="#documentation-for-api-endpoints">Documentation for API Endpoints</a></li>
      </ul>
    </li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

This code test for Backend position
<p align="right">(<a href="#readme-top">back to top</a>)</p>



### Built With

This project built with : 

* [![Php][PHP 7 >= ][https://php.net]
* [![Composer][Composer]]
* [![Redis][Redis]]
* [![Oauth2-Server][Oauth2-Server]][https://github.com/bshaffer/oauth2-server-php]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Prerequisites

You will need the following software installed in your machine.
* PHP
  ```sh
  PHP 7.0 or Higher
  ```
### Installation 

1. Run composer install:
    ```composer
    composer install
    ```
2. Run docker-compose using this command:
    ```docker
    docker-compose build
    ```
    ```docker
    docker-compose up -d
    ```
3. Run Application:
     ```php
    php -S localhost:8080 -t .
    ```


<a name="documentation-for-api-endpoints"></a>
## Documentation for API Endpoints

All URIs are relative to *http://127.0.0.1:8000*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*cobaApi* | [**Local**](docs) | **POST** /v1/api/user | Call all function user [local]
*cobaApi* | [**Dev/Sandbox**](docs) | **POST** /sandbox/cobaApi/{id}/file/{fileName} | This example standard for sandbox/dev
*cobaApi* | [**Beta**](docs) | **PUT** /beta/cobaApi/{id | This example standard for beta
*cobaApi* | [**Prod**](docs) | **DELETE** /cobaApi/{id} | This example standard for Production


Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*tokenApi* | [ **POST** | /token | 
*sendMail* |  [ **POST** | /mail/send | param = email password 
*registerApi* | [ **POST** | /v1/api/register | param = email password name


## Flow System Design
```


                                              +------------+
                                              |   Database |
                                              |  PostgreSQL|
                                              |            |
                                              +------------+
                                                    |
                                                    |
+------------+          +------------+          +------------+
|            |          |            |          |            |
| API        |          | Worker     |          | OAuth2     |
|  Endpoint  |          |  Script    +----------+  Server    |
|            |          |            |          |            |
+------------+          +------------+          +------------+
    |                        |                        |
    |                        |                        |
    |                        |                        |
+------------+          +------------+          +------------+
|            |          |            |          |            |
| Client     |          | Redis      |          | PHPMailer  |
|            |----------|            |----------|            |
|            |          |            |          |            |
+------------+          +------------+          +------------+

```

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Hendra Darisman - [@Whatsapp](https://wa.me/6289656307984) - hendradarisman34@gmail.com

<p align="right">(<a href="#readme-top">back to top</a>)</p>