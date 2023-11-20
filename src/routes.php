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
  ['GET', '/loufok/joueur', 'joueur@joueur'],
  [['GET','POST'], '/loufok/contribution', 'contribution@contribution'],
  [['GET','POST'], '/loufok/admin', 'admin@admin'],
  [['GET','POST'], '/loufok/nouveau_cadavre', 'admin@nouveauCadavre'],
  ['GET', '/loufok/admin/affichage', 'admin@affichageCadavre']
  
];
