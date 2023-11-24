"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[5193],{1063:(e,r,a)=>{a.r(r),a.d(r,{assets:()=>o,contentTitle:()=>i,default:()=>l,frontMatter:()=>n,metadata:()=>c,toc:()=>s});var t=a(5893),d=a(1151);const n={sidebar_position:7},i="verificationPeriode()",c={id:"model-cadavre/verificationPeriode",title:"verificationPeriode()",description:"La m\xe9thode verificationPerdiode() de la classe CadavreModel prend en param\xe8tre la date de d\xe9but et de fin d'un nouveau cadavre et v\xe9rifie si elle ne chevauche pas sur la p\xe9riode d'un Cadavre Exquis d\xe9j\xe0 existant.",source:"@site/docs/model-cadavre/verificationPeriode.md",sourceDirName:"model-cadavre",slug:"/model-cadavre/verificationPeriode",permalink:"/docs/model-cadavre/verificationPeriode",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-cadavre/verificationPeriode.md",tags:[],version:"current",sidebarPosition:7,frontMatter:{sidebar_position:7},sidebar:"tutorialSidebar",previous:{title:"titreUnique()",permalink:"/docs/model-cadavre/titreUnique"},next:{title:"nouvelleContribution()",permalink:"/docs/model-cadavre/nouvelleContribution"}},o={},s=[{value:"Code",id:"code",level:2}];function u(e){const r={code:"code",h1:"h1",h2:"h2",li:"li",p:"p",pre:"pre",ul:"ul",...(0,d.a)(),...e.components};return(0,t.jsxs)(t.Fragment,{children:[(0,t.jsx)(r.h1,{id:"verificationperiode",children:"verificationPeriode()"}),"\n",(0,t.jsx)(r.p,{children:"La m\xe9thode verificationPerdiode() de la classe CadavreModel prend en param\xe8tre la date de d\xe9but et de fin d'un nouveau cadavre et v\xe9rifie si elle ne chevauche pas sur la p\xe9riode d'un Cadavre Exquis d\xe9j\xe0 existant."}),"\n",(0,t.jsx)(r.p,{children:"Si le test ne trouve pas de chevauchement, la m\xe9thode ne renvoie rien.\r\nSi un chevauchement est identifi\xe9, alors la m\xe9thode renvera un string en tant que message d'erreur."}),"\n",(0,t.jsx)(r.p,{children:"Cette m\xe9thode fait appel \xe0 l'entit\xe9e :"}),"\n",(0,t.jsxs)(r.ul,{children:["\n",(0,t.jsx)(r.li,{children:(0,t.jsx)(r.code,{children:"Cadavre"})}),"\n"]}),"\n",(0,t.jsx)(r.h2,{id:"code",children:"Code"}),"\n",(0,t.jsx)(r.pre,{children:(0,t.jsx)(r.code,{className:"language-php",metastring:'title="CadavreModel"',children:'/**\r\n    * Ne renvoie rien si aucune p\xe9riode ne se chevauche, renvoie un string de l\'erreur si chevauchement\r\n    */\r\n    public static function verificationPeriode($debut, $fin){\r\n        $debut_cadavre = $debut;\r\n        $fin_cadavre = $fin;\r\n        $errors = 0;\r\n        $cadavres_existants = Cadavre::getInstance()->findAll();\r\n        foreach ($cadavres_existants as $cadavre => $c) {\r\n            if ($debut_cadavre>=$c[\'date_debut_cadavre\'] && $debut_cadavre<=$c[\'date_fin_cadavre\']) {\r\n                $errors = "Un cadavre exquis existe d\xe9j\xe0 pour la p\xe9riode du " . date("d/m/Y", strtotime($c[\'date_debut_cadavre\'])) . " au " . date("d/m/Y", strtotime($c[\'date_fin_cadavre\'])) . ". Le chevauchement de cadavre exquis n\'est pas possible." ;\r\n            }\r\n            \r\n            if ($fin_cadavre>=$c[\'date_debut_cadavre\'] && $fin_cadavre<=$c[\'date_fin_cadavre\']) {\r\n                $errors = "Un cadavre exquis existe d\xe9j\xe0 pour la p\xe9riode du " . date("d/m/Y", strtotime($c[\'date_debut_cadavre\'])) . " au " . date("d/m/Y", strtotime($c[\'date_fin_cadavre\'])) . ". Le chevauchement de cadavre exquis n\'est pas possible." ;\r\n            }\r\n            \r\n            if ($debut_cadavre<=$c[\'date_debut_cadavre\'] && $fin_cadavre>=$c[\'date_fin_cadavre\']) {\r\n                $errors = "Un cadavre exquis existe d\xe9j\xe0 pour la p\xe9riode du " . date("d/m/Y", strtotime($c[\'date_debut_cadavre\'])) . " au " . date("d/m/Y", strtotime($c[\'date_fin_cadavre\'])) . ". Le chevauchement de cadavre exquis n\'est pas possible." ;\r\n            }\r\n        }\r\n        if($errors){\r\n            return $errors;\r\n        }\r\n    }\n'})})]})}function l(e={}){const{wrapper:r}={...(0,d.a)(),...e.components};return r?(0,t.jsx)(r,{...e,children:(0,t.jsx)(u,{...e})}):u(e)}},1151:(e,r,a)=>{a.d(r,{Z:()=>c,a:()=>i});var t=a(7294);const d={},n=t.createContext(d);function i(e){const r=t.useContext(n);return t.useMemo((function(){return"function"==typeof e?e(r):{...r,...e}}),[r,e])}function c(e){let r;return r=e.disableParentContext?"function"==typeof e.components?e.components(d):e.components||d:i(e.components),t.createElement(n.Provider,{value:r},e.children)}}}]);