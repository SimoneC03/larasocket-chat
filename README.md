# larasocket-chat

## Introduction 
Real-time chat application using Laravel 8.0, Vue and <a href="https://larasocket.com/">Larasocket</a>

## Installation
1. `git clone https://github.com/SimoneC03/larasocket-chat`
1. `cd larasocket-chat`
1. `composer install`
1. `cp .env.example .env`
1. `php artisan key:generate`
1. Update your `.env` file with your `LARASOCKET_TOKEN`. You can get one for free at [Larasocket](https://larasocket.com)
1. `npm install`
1. `npm run dev`
1. `php artisan migrate`
1. `php artisan serve`

## .ENV file
Copy .env.example and rename it to .env

## Configure .env file
Configure with your personal data and add Larasocket variables as below:
```bash
BROADCAST_DRIVER=larasocket
LARASOCKET_TOKEN=paste your token here
MIX_LARASOCKET_TOKEN="${LARASOCKET_TOKEN}"
```

## About Larasocket
<a href="https://larasocket.com/">Larasocket</a> is a hosted, no configuration package for handling your broadcast connections in your Laravel application.

