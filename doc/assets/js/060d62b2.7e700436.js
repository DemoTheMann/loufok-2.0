"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[3306],{8220:(e,n,t)=>{t.r(n),t.d(n,{assets:()=>c,contentTitle:()=>a,default:()=>l,frontMatter:()=>i,metadata:()=>d,toc:()=>u});var o=t(5893),r=t(1151);const i={sidebar_position:5},a="newContrib()",d={id:"model-contribution/newContrib",title:"newContrib()",description:"La m\xe9thode newContrib() de la classe ContributionModel prend en param\xe8tre l'identifiant d'un utilisateur qui souhaite ajouter sa contribution \xe0 un cadavre, les informations du Cadavre Exquis en cours, le contenu textuel de la contribution \xe0 ajouter et l'ordre \xe0 attribu\xe9 \xe0 la nouvelle contribution, calcul\xe9 en ammont dans le controller.",source:"@site/docs/model-contribution/newContrib.md",sourceDirName:"model-contribution",slug:"/model-contribution/newContrib",permalink:"/loufok/doc/docs/model-contribution/newContrib",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-contribution/newContrib.md",tags:[],version:"current",sidebarPosition:5,frontMatter:{sidebar_position:5},sidebar:"tutorialSidebar",previous:{title:"countContrib()",permalink:"/loufok/doc/docs/model-contribution/countContrib"},next:{title:"getUserContrib()",permalink:"/loufok/doc/docs/model-contribution/getUserContrib"}},c={},u=[{value:"Code",id:"code",level:2}];function s(e){const n={code:"code",h1:"h1",h2:"h2",li:"li",p:"p",pre:"pre",ul:"ul",...(0,r.a)(),...e.components};return(0,o.jsxs)(o.Fragment,{children:[(0,o.jsx)(n.h1,{id:"newcontrib",children:"newContrib()"}),"\n",(0,o.jsx)(n.p,{children:"La m\xe9thode newContrib() de la classe ContributionModel prend en param\xe8tre l'identifiant d'un utilisateur qui souhaite ajouter sa contribution \xe0 un cadavre, les informations du Cadavre Exquis en cours, le contenu textuel de la contribution \xe0 ajouter et l'ordre \xe0 attribu\xe9 \xe0 la nouvelle contribution, calcul\xe9 en ammont dans le controller."}),"\n",(0,o.jsx)(n.p,{children:"Cette m\xe9thode ne renvoit rien, elle s'occupe seulement de l'insertion dans la base de donn\xe9es de la nouvelle contribution."}),"\n",(0,o.jsx)(n.p,{children:"Cette m\xe9thode fait appel aux entit\xe9es :"}),"\n",(0,o.jsxs)(n.ul,{children:["\n",(0,o.jsx)(n.li,{children:(0,o.jsx)(n.code,{children:"Contribution"})}),"\n",(0,o.jsx)(n.li,{children:(0,o.jsx)(n.code,{children:"Cadavre"})}),"\n"]}),"\n",(0,o.jsx)(n.h2,{id:"code",children:"Code"}),"\n",(0,o.jsx)(n.pre,{children:(0,o.jsx)(n.code,{className:"language-php",metastring:'title="ContributionModel.php"',children:"public static function newContrib($user_id, $cadavre, $text, $ordre){\r\n        \r\n        $textContrib = $text;\r\n        $id_cadavre = $cadavre['id_cadavre'];\r\n        $now = date('Y-m-d');\r\n        Contribution::getInstance()->create(\r\n            [\r\n                'texte_contribution' => $textContrib,\r\n                'date_soumission' => $now,\r\n                'ordre_soumission' => $ordre,\r\n                'id_joueur' => $user_id,\r\n                'id_administrateur' => null,\r\n                'id_cadavre' => $id_cadavre\r\n            ]);\r\n        if($ordre+1 >= $cadavre['nb_contributions']){\r\n            Cadavre::getInstance()->update($id_cadavre,['date_fin_cadavre'=>$now]);\r\n        }\r\n    }\n"})})]})}function l(e={}){const{wrapper:n}={...(0,r.a)(),...e.components};return n?(0,o.jsx)(n,{...e,children:(0,o.jsx)(s,{...e})}):s(e)}},1151:(e,n,t)=>{t.d(n,{Z:()=>d,a:()=>a});var o=t(7294);const r={},i=o.createContext(r);function a(e){const n=o.useContext(i);return o.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function d(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(r):e.components||r:a(e.components),o.createElement(i.Provider,{value:n},e.children)}}}]);