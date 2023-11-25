"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[8353],{3554:(n,t,e)=>{e.r(t),e.d(t,{assets:()=>a,contentTitle:()=>c,default:()=>l,frontMatter:()=>r,metadata:()=>d,toc:()=>s});var o=e(5893),i=e(1151);const r={sidebar_position:4},c="countContrib()",d={id:"model-contribution/countContrib",title:"countContrib()",description:"La m\xe9thode countContrib() de la classe ContributionModel prend en param\xe8tre l'identifiant d'un cadavre et renvoit le nombre de contributions qui lui sont attribu\xe9.",source:"@site/docs/model-contribution/countContrib.md",sourceDirName:"model-contribution",slug:"/model-contribution/countContrib",permalink:"/loufok/doc/docs/model-contribution/countContrib",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-contribution/countContrib.md",tags:[],version:"current",sidebarPosition:4,frontMatter:{sidebar_position:4},sidebar:"tutorialSidebar",previous:{title:"setRandom()",permalink:"/loufok/doc/docs/model-contribution/setRandom"},next:{title:"newContrib()",permalink:"/loufok/doc/docs/model-contribution/newContrib"}},a={},s=[{value:"Code",id:"code",level:2}];function u(n){const t={code:"code",h1:"h1",h2:"h2",li:"li",p:"p",pre:"pre",ul:"ul",...(0,i.a)(),...n.components};return(0,o.jsxs)(o.Fragment,{children:[(0,o.jsx)(t.h1,{id:"countcontrib",children:"countContrib()"}),"\n",(0,o.jsx)(t.p,{children:"La m\xe9thode countContrib() de la classe ContributionModel prend en param\xe8tre l'identifiant d'un cadavre et renvoit le nombre de contributions qui lui sont attribu\xe9."}),"\n",(0,o.jsx)(t.p,{children:"Cette m\xe9thode fait appel aux entit\xe9es :"}),"\n",(0,o.jsxs)(t.ul,{children:["\n",(0,o.jsx)(t.li,{children:(0,o.jsx)(t.code,{children:"Contribution"})}),"\n"]}),"\n",(0,o.jsx)(t.p,{children:"Cette m\xe9thode fait aussi appel au mod\xe8le :"}),"\n",(0,o.jsxs)(t.ul,{children:["\n",(0,o.jsxs)(t.li,{children:[(0,o.jsx)(t.code,{children:"CadavreModel"})," -> pour utiliser la m\xe9thode ",(0,o.jsx)(t.code,{children:"cadavreEnCours()"})]}),"\n"]}),"\n",(0,o.jsx)(t.h2,{id:"code",children:"Code"}),"\n",(0,o.jsx)(t.pre,{children:(0,o.jsx)(t.code,{className:"language-php",metastring:'title="ContributionModel.php"',children:"public static function countContrib(int $id_cadavre)\r\n    {\r\n        $activeCadavre = Cadavre::getInstance()->findBy(['id_cadavre'=>$id_cadavre])[0];\r\n        $cadavreCountContrib = count(Contribution::getInstance()->findBy(['id_cadavre' => $activeCadavre['id_cadavre']]));\r\n        return $cadavreCountContrib;\r\n    }\n"})})]})}function l(n={}){const{wrapper:t}={...(0,i.a)(),...n.components};return t?(0,o.jsx)(t,{...n,children:(0,o.jsx)(u,{...n})}):u(n)}},1151:(n,t,e)=>{e.d(t,{Z:()=>d,a:()=>c});var o=e(7294);const i={},r=o.createContext(i);function c(n){const t=o.useContext(r);return o.useMemo((function(){return"function"==typeof n?n(t):{...t,...n}}),[t,n])}function d(n){let t;return t=n.disableParentContext?"function"==typeof n.components?n.components(i):n.components||i:c(n.components),o.createElement(r.Provider,{value:t},n.children)}}}]);