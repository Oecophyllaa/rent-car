## Run Locally

Clone the project

```bash
  git clone https://github.com/Oecophyllaa/rent-car.git
```

Go to the project directory

```bash
  cd rent-car
```

Install dependencies

```bash
  composer install
  npm install
  npm run build
```

Setup environment

```bash
  cp .env.example .env
  php artisan key:generate
  php artisan migrate
```

Start the server

```bash
  php artisan serve
```
