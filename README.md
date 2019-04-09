# API for PhoneBook CRUD Using Interactive Driven Design

## Installation
You need **Docker** and **Docker Compose**.

```
docker-compose up -d
```

## Create table in database
```
php database/PhoneBookMigration.php
```

## Execute Tests
```
./vendor/bin/phpunit --testsuite Functional
./vendor/bin/phpunit --testsuite Unit
```

## API

**Store Phone Book Item**
----

* **URL**

  /phonebooks/

* **Method:**

  `POST`

*  **URL Params**

   **Required:**

* **Data Params**

   **Required:**

   `firstName=[string]`
   `phoneNumber=[string]`
   `countryCode=[string]`
   `timeZoneName=[string]`

   **Optional:**

   `lastName=[string]`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ message : "Phone book item created successfully!" }`

* **Error Response:**

  * **Code:** 400 <br />
    **Content:** `{ message : "A phone book item requires: first name, phone number, country code and time zone!" }`

  * **Code:** 400 <br />
    **Content:** `{ message : "A phone book item requires a phone number valid!" }`

  * **Code:** 400 <br />
    **Content:** `{ message : "A phone book item requires a country code valid!" }`

  * **Code:** 400 <br />
    **Content:** `{ message : "A phone book item requires a time zone valid!" }`


**Retrieve Phone Book Item**
----

* **URL**

  /phonebooks/:id

* **Method:**

  `GET`

*  **URL Params**

   **Required:**

   `id=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ id : 1, firstName : "Tony", lastName: "Morella", phoneNumber: "+34623321434", countryCode: 'ES', timeZoneName: "Europe/Madrid", insertedOn: "2019-04-07 14:26:21", updatedOn: "2019-04-07 14:26:21" }`

* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
    **Content:** `{ message : "Phone book item not found!" }`

**Delete Phone Book Item**
----

* **URL**

  /phonebooks/:id

* **Method:**

  `DELETE`

*  **URL Params**

   **Required:**

   `id=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ message : "Phone book item delete successfully!" }`

* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
    **Content:** `{ message : "Phone book item not found!" }`