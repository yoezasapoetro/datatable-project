# datatable-project
Datatable API Json

## Petunjuk Pemakaian

1. Buka terminal pada folder root project
    ```
    $ composer install
    ```
		
    Tunggu hingga proses install library selesai

2. Copy file .env.example dan rename menjadi .env

3. Database menggunakan SQLite

	Pada file .env ubah variabel DB_CONNECTION yang bernilai **mysql** menjadi **sqlite**
	
	Buat file baru pada folder **database** dengan nama file **datatable.sqlite**

4. Buka terminal 
    ```
    $ php artisan migrate
    $ php artisan db:seed
    $ php artisan serve
    ```
