<div align="center">
  <br>
	<a href="https://nfactory.school"><img src="assets/img/logo/logo-black-bg-none.png" height="160"></a>
  <br>
  <p>
    <a href="/../../"><img src="https://img.shields.io/github/last-commit/AntoineKM/nfactory-bookination" alt="GitHub last-commit" /></a>
  </p>
</div>

# NFactory - Bookination 
Bookination est un projet dans le cadre d'une formation [NFactory School](https://nfactory.school) qui consiste à développer une solution web qui permet aux patients de renseigner leur carnet de vaccinations.

## Installation
* [Installer Composer](https://getcomposer.org/download).

* Ensuite executer les commandes suivantes:
```
# Cloner le projet pour télécharger son contenu
> cd projects/
> git clone https://github.com/AntoineKM/nfactory-bookination.git

# Faire en sorte que Composer installe les dépendances du projet dans le dossier vendor/
> cd nfactory-bookination/
> composer install
```

* Pour finir, configurez votre ``.env`` comme le [.env.example](.env.example)

## Usage
Notes:

* Lorsque vous commitez ne surtout pas inclure les fichiers/dossiers suivants:
```
- .env
- .git
- .vscode
- vendor
```

* Faites vos tests dans un dossier ``tests``.

### Base de données

**Utilisateurs**
| bn_users   	|                      	|
|------------	|----------------------	|
| id         	| int(11)              	|
| mail       	| varchar(160)         	|
| password   	| varchar(250)         	|
| token      	| varchar(255)         	|
| firstname  	| varchar(100)         	|
| lastname   	| varchar(100)         	|
| birthdate  	| date                 	|
| gender     	| varchar(20)         	|
| created_at 	| datetime             	|
| updated_at 	| datetime             	|
| role       	| varchar(20)         	|

**Vaccins**
| bn_vaccines 	|              	|
|-------------	|--------------	|
| id          	| int(11)      	|
| name        	| varchar(100) 	|
| mandatory   	| boolean      	|
| frequency   	| varchar(255) 	|
| created_at  	| datetime     	|
| updated_at  	| datetime     	|

**Rappels**
| bn_reminders   	|          	|
|----------------	|----------	|
| id             	| int(11)  	|
| user_id        	| int(11)  	|
| vaccine_id     	| int(11)  	|
| last_injection 	| date     	|
| reminder       	| date     	|
| created_at     	| datetime 	|
| updated_at     	| datetime 	|

**Contact**
| bn_contact 	|              	|
|------------	|--------------	|
| id         	| int(11)      	|
| mail       	| varchar(160)  |
| firstname  	| varchar(100) 	|
| lastname   	| varchar(100) 	|
| subject    	| varchar(255) 	|
| message    	| text         	|
| created_at 	| datetime     	|

## Credits
Ce projet contient les éléments open source suivants:
* [unDraw](https://undraw.co)
* [Remix Icon](https://remixicon.com)
* [Font Awesome](https://fontawesome.com)
* [Flat Icon](https://www.flaticon.com)
* [AdminLTE](https://adminlte.io)

## Links
* [NFactory](https://nfactory.io)
* [NFactory School](https://nfactory.school)
* [Campus Saint Marc](https://campus-saint-marc.com)