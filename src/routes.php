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
  [['GET','POST'], '/loufok/admin', 'admin@admin']

];
