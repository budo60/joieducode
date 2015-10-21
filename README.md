Les Joies Du Code
=============

#### *** DESCRIPTION *** ####

Les Joies Du Code version VDM

#### *** CONSEILS *** ####

``Tous les templates html sont fournis``

``Conseil : `` *Think [DRY](https://fr.wikipedia.org/wiki/Ne_vous_r%C3%A9p%C3%A9tez_pas)*

#### *** CONSIGNES *** ####

1. ``Faire la découpe des templates HTML``

2. ``Créer la base de données "joiesducode" avec un encodage "utf8_general_ci"
Créer la table "articles" avec les champs : id, name, content, creation_date``

3. ``Créer un fichier qui contient une connexion PDO à la base de données, et l'inclure``

4. ``Sur la page d'accueil faire une requête qui va chercher les 10 derniers articles
   Puis les afficher``

5. ``Dans random.php, faire une requête qui va chercher un article au hasard
Puis l'afficher``

6. ``Dans search.php, faire une requête qui va chercher un article qui contient ce qu'on a tapé dans le champ de recherche
Puis afficher le nombre et la liste des résultats``

7. ``Dans send.php, faire une requête qui insert un article en base de données
   Puis afficher un message de confirmation``

8. ``Partout où on affiche un article, si l'article est plus long que 100 caractères, ne garder que les 100 premiers caractères et afficher un lien qui pointe vers l'article au complet``

9. ``Créer une page qui affiche l'article au complet`` ([DRY](https://fr.wikipedia.org/wiki/Ne_vous_r%C3%A9p%C3%A9tez_pas))

10. ``Dans send.php, ajouter au message de confirmation un lien vers l'article nouvellement créé``

#### *** BONUS *** ####

- ``Formatter l'affichage des infos d'articles (date en français, conversion des sauts de ligne en balises <br>, première lettre en majuscule sur les noms des auteurs), de l'année en cours dans le footer``

- ``Faire un script qui insert automatiquement des articles avec du contenu``

- ``Dans send.php, faire en sorte de se prémunir des failles/injections XSS``

- ``Dans send.php, autoriser les balises : <b> <strong> <i> <em>``


