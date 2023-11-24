---
sidebar_position: 1
---

# Introduction à l'application

**L'application Loufok** est une application web permettant la conception collaborative d'un récit à la manière d'un **[Cadavre Exquis](https://fr.wikipedia.org/wiki/Cadavre_exquis)**.

## Côté utilisateur

L'application permet à des utilisateurs de se connecter et de participer à la conception d'un récit sur une période donnée via une contribution unique qui comprennent entre 50 et 280 charactères.

Si l'utilisateur se connecte à l'application durant une période de création de Cadavre Exquis, il lui est donné la possibilitée de contribuer une seule fois à ce dernier. La majeure partie du récit lui sera masqué à part une contribution précédente du récit qui est choisit aléatoirement, il peut donc baser sa contribution au récit sur cette unique bribe du résultat final.

L'utilisateur est aussi offert l'option de consulter dans sa totalitée le dernier Cadavre Exquis en date au quel il à participer.

## Côté administrateur

Les administrateurs de l'application sont à l'origine des projets d'écritures.
Ils initient les Cadavre Exquis en définissant la période de création et le nombre de contributions max autorisées pour ce projet, et fournissent la première contribution du Cadavre Exquis pour diriger la direction du récit et les futures contributions des utilisateurs.

## Modèle MVC

L'application s'organise autour d'un fonctionnement Model Vue Controller.
Le modèle de MVC utilisé est celui fournit par Mr. Louet durant le semestre 5.

Le stockage des informations des utilisateurs, amdinistrateurs et cadavres exquis ce font sur une base de donnée MySQL.

## Entitées

Les connexions à la base de données s'organises dans des fichiers dédiés només entités, ces derniers comportes toutes les fonctions de requêtes SQL préparées permetant toutes les opérations de bases.
Ces fonctions proviennent du modèle d'organisation MVC fournit par Mr.Louet.

## Modèles

Les classes modèles de l'application permettent une communication entre l'interface front de l'application et les classes de communication à la base de données.
La documentation et l'explication des différentes méthodes de ces classes sont discponibles sur cette documentation.