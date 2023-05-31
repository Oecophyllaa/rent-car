## Run Locally

Clone the project

```bash
  git clone https://github.com/Oecophyllaa/cms-kitsvne.git
```

Go to the project directory

```bash
  cd cms-kitsvne
```

Install dependencies

```bash
  composer install
  npm install
  npm run dev
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
