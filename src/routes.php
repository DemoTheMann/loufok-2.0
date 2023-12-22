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
  ['GET', '/api/cadavres', 'API@getCadavres'],
  ['GET', '/api/cadavre/{id:\d+}', 'API@getCadavreById'],
  [['POST', 'GET'], '/api/cadavre/like', 'API@likeCadavre'],
  [['POST', 'GET'], '/api/cadavre/dislike', 'API@dislikeCadavre'],


  
];
