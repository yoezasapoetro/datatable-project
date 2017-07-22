# datatable-project
Datatable API Json

## Petunjuk Pemakaian

1. Buka terminal pada folder root project
    ```
    $ composer install
    ```
		
    Tunggu hingga proses install library selesai

2. Database menggunakan SQLite

    Buat file baru pada folder **database** dengan nama file **datatable.sqlite**

3. Buka terminal 
    ```
    $ php artisan migrate
    $ php artisan db:seed
    $ php artisan serve
    ```
