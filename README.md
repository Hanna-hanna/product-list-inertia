## Products App (Laravel, Vue, Inertia)

<div>
    <p>Clone project</p>
    <pre>git clone https://github.com/Hanna-hanna/product-list-inertia.git</pre>
    <pre>cd product-list-inertia</pre>
    <p>Install Requirements</p>
    <pre>composer install</pre>
    <pre>npm install</pre>
    <p>Create new database on the local database tool like TablePlus</p>
    <p>Create file .env from env.example (on the root) and add info</p>
    <pre>
    DB_DATABASE=name_your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    </pre>
    <p>Migrate Database and Seeders</p>
    <pre>php artisan migrate</pre>
    <pre>php artisan db:seed</pre>
    <p>Set key for application</p>
    <pre>php artisan key:generate</pre>
    <p>Start project from your server or use local</p>
    <pre>npm run build</pre>  
    <pre>php artisan serve</pre>
    <p>List Of Products</p>
    <pre>{your_host}/products</pre>
    <p>Add Product</p>
    <pre>{your_host}/add-product</pre>
</div>
