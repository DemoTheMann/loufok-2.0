<?php

declare (strict_types = 1);
/*
-------------------------------------------------------------------------------
les routes
-------------------------------------------------------------------------------
 */

return [

  [['GET','POST'], '/loufok/login', 'login@login'],
  ['GET', '/loufok/logout', 'logout@logout'],
  ['GET', '/loufok', 'joueur@joueur'],
  [['GET','POST'], '/loufok/joueur', 'joueur@joueur'],
  ['GET', '/loufok/lastCadavre', 'joueur@last'],
  ['GET', '/loufok/admin', 'admin@admin'],
  ['POST', '/loufok/admin', 'admin@nouveauCadavre'],
  [['GET','POST'], '/loufok/contribution', 'contribution@contribution'],
  ['GET', '/loufok/admin/affichage', 'admin@affichageCadavre']
  
];
