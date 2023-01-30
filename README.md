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

## ⚡️ À propos

DramaQuick est une version de DramaQuiz **accélérée** ; des questionnaires temporaires, des sessions de quiz... Tout cela a été créé avec une idée : **l’éphémérité** !

<br/>

> ❗ **Attention, ce README changera à l'avenir.**

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