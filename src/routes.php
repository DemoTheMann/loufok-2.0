<?php

declare (strict_types = 1);
/*
-------------------------------------------------------------------------------
les routes
-------------------------------------------------------------------------------
 */

return [

  [['GET' , 'POST'], '/', 'login@login'],
  [['GET','POST'], '/login', 'login@login'],
  ['GET', '/logout', 'logout@logout'],
  [['GET','POST'], '/joueur', 'joueur@joueur'],
  ['GET', '/lastCadavre', 'joueur@last'],
  ['GET', '/admin', 'admin@admin'],
  ['POST', '/admin', 'admin@nouveauCadavre'],
  [['GET','POST'], '/contribution', 'contribution@contribution'],
  ['GET', '/admin/affichage', 'admin@affichageCadavre'],
  ['GET', '/API/cadavres', 'API@getCadavres'],
  ['GET', '/API/cadavres/{id:\d+}', 'API@getCadavreById'],
  ['GET', '/API/cadavres/{id:\d+}/like', 'API@likeCadavreById'],

  
];
