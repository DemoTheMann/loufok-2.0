"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[4400],{3830:(e,n,i)=>{i.r(n),i.d(n,{assets:()=>d,contentTitle:()=>a,default:()=>c,frontMatter:()=>r,metadata:()=>s,toc:()=>l});var t=i(5893),o=i(1151);const r={sidebar_position:2},a="authAdmin()",s={id:"model-login/authAdmin",title:"authAdmin()",description:"La m\xe9thode authAdmin() de la classe LoginModel prend en param\xe8tre les informations renseign\xe9s dans le formulaire de connexion et v\xe9rifie si il est possible r\xe9aliser une connexion administrateur.",source:"@site/docs/model-login/authAdmin.md",sourceDirName:"model-login",slug:"/model-login/authAdmin",permalink:"/docs/model-login/authAdmin",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-login/authAdmin.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"getInstance()",permalink:"/docs/model-login/getInstance"},next:{title:"authJoueur()",permalink:"/docs/model-login/authJoueur"}},d={},l=[{value:"Code",id:"code",level:2}];function u(e){const n={code:"code",h1:"h1",h2:"h2",li:"li",p:"p",pre:"pre",ul:"ul",...(0,o.a)(),...e.components};return(0,t.jsxs)(t.Fragment,{children:[(0,t.jsx)(n.h1,{id:"authadmin",children:"authAdmin()"}),"\n",(0,t.jsx)(n.p,{children:"La m\xe9thode authAdmin() de la classe LoginModel prend en param\xe8tre les informations renseign\xe9s dans le formulaire de connexion et v\xe9rifie si il est possible r\xe9aliser une connexion administrateur."}),"\n",(0,t.jsx)(n.p,{children:"Cette m\xe9thode fait appel a l'entit\xe9e :"}),"\n",(0,t.jsxs)(n.ul,{children:["\n",(0,t.jsx)(n.li,{children:(0,t.jsx)(n.code,{children:"Admin"})}),"\n"]}),"\n",(0,t.jsx)(n.h2,{id:"code",children:"Code"}),"\n",(0,t.jsx)(n.pre,{children:(0,t.jsx)(n.code,{className:"language-php",metastring:'title="LoginModel.php"',children:"public function authAdmin(string $email, string $password):void\r\n    {\r\n        $admin = Admin::getInstance()->findBy(['ad_mail_administrateur' => $email]);\r\n\r\n        if ($admin && $password === $admin[0]['mot_de_passe_administrateur']) {\r\n            $_SESSION['auth'] = true;\r\n            $_SESSION['role'] = 'administrateur';\r\n            $_SESSION['user_id'] = $admin[0]['id_administrateur'];\r\n        }\r\n    }\n"})})]})}function c(e={}){const{wrapper:n}={...(0,o.a)(),...e.components};return n?(0,t.jsx)(n,{...e,children:(0,t.jsx)(u,{...e})}):u(e)}},1151:(e,n,i)=>{i.d(n,{Z:()=>s,a:()=>a});var t=i(7294);const o={},r=t.createContext(o);function a(e){const n=t.useContext(r);return t.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function s(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(o):e.components||o:a(e.components),t.createElement(r.Provider,{value:n},e.children)}}}]);