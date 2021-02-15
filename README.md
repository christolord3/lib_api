# base-slim-skeleton
Api de base avec le framework slim et une connexion MySQL.
Source : https://odan.github.io/2019/11/05/slim4-tutorial.html

### Installation
> composer update

### Setup de la BD
- Modifier les informations dans le fichier config/settings.php
- Rouler le script ressource/createUserTable.sql pour tester la création d'un usager.

### Routes disponibles
- GET / Hello World!
- POST /users Création d'un usager

Pour la création d'un usager, ajouter dans le body de la requête l'information en JSON : 
```
{
    "username" : "mathieu.frechette",
    "first_name" : "Mathieu",
    "last_name" : "Fréchette",
    "email" : "frechette.mathieu@cegepvicto.ca"
}
```
