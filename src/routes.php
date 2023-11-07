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
  ['GET', '/loufok/index', 'index@index'],
  ['GET', '/loufok', 'index@index'],
  ['GET', '/loufok/admin', 'admin@admin'],
  [['GET','POST'], '/loufok/nouveau_cadavre', 'admin@nouveauCadavre']

];
