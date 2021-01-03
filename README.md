# BPJS KKETENAGAKERJAAN KANTOR CABANG BOGOR

<img src="https://user-images.githubusercontent.com/53459506/103473966-410ff300-4dd1-11eb-81b6-350e0af53a95.png"></img>


This website is used to manage all company assets in BPJS KETENAGAKERJAAN BOGOR


# Installation

```
# clone the repo
$ git clone https://github.com/Fahrul23/BPJSKetenagakerjaan.git

# go into app's directory
$ BPJSKetenagakerjaan

# Install Depedency
$ composer install

# Setup Environment Variable
$ cp .env.example .env
$ php artisan key:generate

# create database
1. go to phpmyadmin
2. create a database with the name bpjsketenagaerjaan

# Migrate & Seed
$ php artisan migrate --seed

```

# Basic usage

```
# Access the website with the url in a web browser
  http://localhost/bpjsketenagakerjaan/public/
	
```
