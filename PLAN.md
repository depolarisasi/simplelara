# Project Setup Plan

Based on the user's instructions and the current state of the project, here is a plan focusing on the remaining tasks, keeping KISS and DRY principles in mind:

**Plan:**

1.  **Define Eloquent Relationships:**
    *   Modify the existing model files (`app/Models/User.php`, `app/Models/Location.php`, `app/Models/LocationCategory.php`, `app/Models/LocationSubCategory.php`, `app/Models/City.php`, `app/Models/Province.php`, `app/Models/LocationPhotos.php`) to add the specified `hasMany` and `belongsTo` relationships.
2.  **Implement Default Owner ID:**
    *   Modify `app/Models/Location.php` to automatically set the `owner_id` to 1 when a new `Location` is created. This can be achieved cleanly using Eloquent model events (e.g., the `creating` event).
3.  **Create Seeders:**
    *   Generate `ProvinceSeeder.php` using `php artisan make:seeder ProvinceSeeder`.
    *   Generate `CitySeeder.php` using `php artisan make:seeder CitySeeder`.
    *   Implement the logic within `ProvinceSeeder.php` to read data from `csv/province.csv`, generate slugs using `Str::slug()`, and populate the `provinces` table.
    *   Implement the logic within `CitySeeder.php` to read data from `csv/city-regencies.csv`, generate slugs using `Str::slug()`, find the corresponding `province_id`, and populate the `cities` table.
    *   Modify `database/seeders/DatabaseSeeder.php` to call `ProvinceSeeder` and `CitySeeder`.
4.  **Run Migrations and Seeders:**
    *   Execute `php artisan migrate` to ensure all migrations are up-to-date.
    *   Execute `php artisan db:seed` to run the seeders (which will now include the Province and City data).

**Visual Plan (Mermaid Diagram):**

```mermaid
graph TD
    A[Start] --> B(Define Relationships in Models);
    B --> C(Implement Default owner_id in Location Model);
    C --> D(Generate ProvinceSeeder);
    D --> E(Implement ProvinceSeeder Logic);
    E -- Reads --> F[csv/province.csv];
    C --> G(Generate CitySeeder);
    G --> H(Implement CitySeeder Logic);
    H -- Reads --> I[csv/city-regencies.csv];
    E --> J(Update DatabaseSeeder);
    H --> J;
    J --> K(Run Migrations);
    K --> L(Run Seeders);
    L --> M[End];

    subgraph "Modify Existing Files"
        direction LR
        B --> Models[app/Models/*.php]
        C --> LocationModel[app/Models/Location.php]
        J --> DbSeeder[database/seeders/DatabaseSeeder.php]
    end

    subgraph "Create New Files"
        direction LR
        D --> ProvSeeder[database/seeders/ProvinceSeeder.php]
        G --> CitySeeder[database/seeders/CitySeeder.php]
    end

    subgraph "Execute Commands"
        direction LR
        K --> MigrateCmd[php artisan migrate]
        L --> SeedCmd[php artisan db:seed]
    end