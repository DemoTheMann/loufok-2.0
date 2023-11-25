"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[4031],{4161:(e,n,t)=>{t.r(n),t.d(n,{assets:()=>s,contentTitle:()=>o,default:()=>l,frontMatter:()=>a,metadata:()=>r,toc:()=>m});var i=t(5893),d=t(1151);const a={sidebar_position:2},o="getAdminName()",r={id:"model-admin/getAdminName",title:"getAdminName()",description:"La m\xe9thode getAdminName() de la classe AdminModel prend en param\xe8tre l'identifiant d'un administrateur et renvoie son adresse mail, ici utilis\xe9 comme son nom d'utilisateur.",source:"@site/docs/model-admin/getAdminName.md",sourceDirName:"model-admin",slug:"/model-admin/getAdminName",permalink:"/loufok/doc/docs/model-admin/getAdminName",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-admin/getAdminName.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"getInstance()",permalink:"/loufok/doc/docs/model-admin/getInstance"},next:{title:"Mod\xe8le Cadavre",permalink:"/loufok/doc/docs/category/mod\xe8le-cadavre"}},s={},m=[{value:"Code",id:"code",level:2}];function c(e){const n={code:"code",h1:"h1",h2:"h2",p:"p",pre:"pre",...(0,d.a)(),...e.components};return(0,i.jsxs)(i.Fragment,{children:[(0,i.jsx)(n.h1,{id:"getadminname",children:"getAdminName()"}),"\n",(0,i.jsx)(n.p,{children:"La m\xe9thode getAdminName() de la classe AdminModel prend en param\xe8tre l'identifiant d'un administrateur et renvoie son adresse mail, ici utilis\xe9 comme son nom d'utilisateur."}),"\n",(0,i.jsx)(n.h2,{id:"code",children:"Code"}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{className:"language-php",metastring:'title="AdminModel.php"',children:"public static function getAdminName(int $id_admin)\r\n    {\r\n        $userInfo = Admin::getInstance()->findBy(['id_administrateur' => $id_admin])[0];\r\n        return $userInfo['ad_mail_administrateur'];\r\n    }\n"})})]})}function l(e={}){const{wrapper:n}={...(0,d.a)(),...e.components};return n?(0,i.jsx)(n,{...e,children:(0,i.jsx)(c,{...e})}):c(e)}},1151:(e,n,t)=>{t.d(n,{Z:()=>r,a:()=>o});var i=t(7294);const d={},a=i.createContext(d);function o(e){const n=i.useContext(a);return i.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function r(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(d):e.components||d:o(e.components),i.createElement(a.Provider,{value:n},e.children)}}}]);