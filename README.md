<br/>
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://i.ibb.co/CB9kwmC/Drama-Quick.png" width="350"></a></p>
<br/>
<p align="center"> 
    <img src="https://img.shields.io/badge/Svelte-FF3E00?style=for-the-badge&logo=svelte&logoColor=white"/>
    <img src="https://img.shields.io/badge/Tailwind-06B6D4?style=for-the-badge&logo=tailwind css&logoColor=white"/>
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
    <img src="https://img.shields.io/badge/Socket.io-010101?style=for-the-badge&logo=socket.io&logoColor=white"/>
    <img src="https://img.shields.io/badge/PostgreSQL-4169E1?style=for-the-badge&logo=postgresql&logoColor=white"/>
    <img src="https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white"/>
</p>

<hr/>

<br/>

## ⚡️ À propos

DramaQuick est une version de DramaQuiz **accélérée** ; des questionnaires temporaires, des sessions de quiz... Tout cela a été créé avec une idée : **l’éphémérité** !

<br/>

> ❗ **Attention**<br/>
> **Ce README changera à l'avenir.** Vous en serez informé sur Discord.

<br/>

## ⚙ Mise en place du projet

### 🔨 Installation des outils

Tout d'abord, il vous est recommandé d'installer **Laragon**, un logiciel qui permet le développement de sites avec PHP en local sans avoir besoin d'installer autre chose.

C'est un environnement de développement portable, isolé et rapide qui possède déjà les technologies suivantes : PHP, Node.js, Python, Java, Go, Ruby, et même une base de données MySQL. Pas besoin d'installer quoi que ce soit de plus !

https://laragon.org/download/

Sinon, vous pouvez décider d'installer les technologies vous-même, auquel cas il vous faudra PHP, Composer, NodeJS et j'en oublie certainement.

Vous devez également installer **git** pour pouvoir travailler avec le repository.

https://git-scm.com/download/win

<br/>

### 🔐 Installation des dépendances

Tout d'abord, assurez-vous que Laragon soit **démarré**. Si c'est fait, ouvrez le **Terminal** de Laragon. Cela devrait vous ouvrir une fenêtre Cmder. Si vous êtes familié avec le shell Linux, c'est la même syntaxe.

Tout d'abord, rendez-vous dans le répertoire dans lequel vous avez **cloné** le repository. 

Si vous ne l'avez pas encore fait, rendez-vous dans n'importe quelle console, naviguez vers votre répertoire et exécutez la commande suivante :

```bash
git clone https://github.com/Dramaquick/DramaQuick.git
```

Une fois le repository cloné, retourez dans votre Cmder et exécutez les commandes suivantes :

```bash
composer install
```
Cela aura pour effet d'installer les dépendances **PHP** du projet.
Ensuite, exécutez la commande suivante :

```bash
npm install
```
Cela aura pour effet d'installer les dépendances **NodeJS** du projet.

<br/>

### 💻 Lancer le projet en mode développement

Vous aurez besoin de deux consoles. Pour cela, dans **Cmder**, faites <kbd>CTRL + T</kbd> (ou clic-droit sur le logo en haut à gauche, puis `New console dialog...`), puis faites "Start".

Vous aurez à présent deux consoles, et vous retrouverez les onglets en bas.
Assurez-vous également que vos deux consoles soient dans le répertoire du projet.

Dans la première, vous allez pouvoir lancer le **back-end** avec la commande suivante :

```bash
php artisan serve
```
Vous aurez alors un message "[INFO] Server running on http://127.0.0.1:8000" C'est à cet URL que vous devrez vous rendre pour voir le site.

Maintenant, vous allez devoir lancer le serveur de développement du **front-end**. Rendez-vous dans votre seconde console et faites la commande suivante :

```bash
npm run dev
```

Vous verrez alors la ligne "VITE v3.2.5 ready in ... ms". Cela signifie que le serveur **front-end** est s'est lancé avec succès.

Vous pouvez désormais vous rendre à l'adresse http://127.0.0.1:8000 et voir le site !

> 📝 **À noter**<br/>
> Tout le front-end se situe dans `/resources/js/`. Grâce au *🔥 hot reload 🔥*, toute modification appliquée se verra en direct sur votre page, il n'y a pas besoin de relancer le serveur front-end.

## 💾 Base de données

A terme, nous utiliserons une base de données PostgreSQL. Sur votre serveur de développement, vous allez utiliser la base de données MySQL fournie par Laragon. 

Assurez-vous également que la partie DB de votre fichier .env est identique à la suivante :

```dosini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dramaquick
DB_USERNAME=root
DB_PASSWORD=
```

*Libre à vous de modifier les paramètres, mais faites attention à les prendre en compte pour la suite.* 

Tout d'abord, **si vous ne l'avez pas déjà mis en place**, rendez vous dans Laragon et cliquez sur "Base de données". Cela vous ouvrira une fenêtre **HeidiSQL** qui vous permettra de gérer la base de données.

Si vous avez une autre préférence en ce qui concerne le logiciel (JetBrains DataGrip, etc...), vous pouvez l'utiliser. Les identifiants par défaut de **Laragon** sont alors les suivants :
- Host : `127.0.0.1`
- Port : `3306`
- Username : `root`
- Password : *Il n'y en a pas*
  
Vous aurez besoin d'exécuter **une seule commande** pour la mise en place. Pour cela, dans **HeidiSQL**, rendez-vous dans l'onglet `▶ Requête` et exécutez la requête suivante :

```sql
CREATE DATABASE dramaquick;
```

Cliquez ensuite sur `🐬 Laragon.MySQL`, à gauche, et faites F5. Vous verrez ensuite votre base de données "dramaquick" apparaître si tout s'est bien passé.

<br/>

### 🛠️ Migrations de la base de données

On appelle une migration toute modification appliquée sur la structure de la base de données. 

#### ⚡ Appliquer des migrations

Par défaut, si vous venez de créer la base de données, vous devrez faire la commande suivante dans votre **Cmder** :

```bash
php artisan migrate
```
Cela aura pour effet de mettre en place la première structure de la base de données.

#### ⏳ Status des migrations 

Pour voir les migrations réalisées jusqu'à présent, vous pouvez faire la commande suivante :

```bash
php artisan migrate:status
```
Si vous voyez "Ran" sous status, cela veut dire que la migration a bien été appliquée sur la base de données. Si vous voyez "Pending", c'est que ce n'est pas le cas, auquel cas faites la première commande ci-dessus.

#### 🧩 Créer une migration

Si vous venez à modifier la structure de la base de données, vous devrez exécuter la commande suivante pour créer une migration :

```bash
php artisan make:migration nom_de_la_migration
```
Si Laravel parvient à déterminer les migrations automatiquement, le nouveau fichier créé dans `/database/migrations/` sera pré-rempli. Sinon, vous devrez le remplir vous-même.

> 📝 **À noter**<br/>
> Les migrations créées ne sont pas appliquées par défaut. Vous devrez les appliquer vous-même.

<br/>

## 🎯 Code de conduite

Pour garder un maximum d'organisation, vous êtes priés de respecter une certaine nomenclature sur toute modification que vous apporterez au projet.

- 🚨 Commits compréhensibles, vrais noms de commit
- ❗❗ **Aucun push** sur la branche principale. Pour une nouvelle fonctionnalité, créez une nouvelle branche et nommez la de la façon suivante : `features/authentication` ou `features/dessin_quiz`, par exemple. Si la fonctionnalité existe déjà, libre à vous de push sur cette branche-ci. Une fois les features finies, un **dev senior** s'occupera de merge sur la branche principale.
- 🛠️ Vrais noms de migrations compréhensibles

<br/>

> ***Optionnel*** : si vous pouvez préciser les modifications/ajouts que vous faites ailleurs (Figma, Notion), faites-le, cela permet de tenir l'équipe entière au courant et de ne pas faire de travail en double ! 😀