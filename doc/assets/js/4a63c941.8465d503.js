"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[8909],{8267:(e,a,r)=>{r.r(a),r.d(a,{assets:()=>i,contentTitle:()=>o,default:()=>u,frontMatter:()=>t,metadata:()=>c,toc:()=>s});var d=r(5893),n=r(1151);const t={sidebar_position:6},o="dateProchainCadavre()",c={id:"model-cadavre/dateProchainCadavre",title:"dateProchainCadavre()",description:"La m\xe9thode DateProchainCadavre() de la classe CadavreModel ne prend pas de param\xe8tres et renvoie la date de d\xe9but du prochain cadavre.",source:"@site/docs/model-cadavre/dateProchainCadavre.md",sourceDirName:"model-cadavre",slug:"/model-cadavre/dateProchainCadavre",permalink:"/loufok/doc/docs/model-cadavre/dateProchainCadavre",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-cadavre/dateProchainCadavre.md",tags:[],version:"current",sidebarPosition:6,frontMatter:{sidebar_position:6},sidebar:"tutorialSidebar",previous:{title:"isCadavreOn()",permalink:"/loufok/doc/docs/model-cadavre/isCadavreOn"},next:{title:"titreUnique()",permalink:"/loufok/doc/docs/model-cadavre/titreUnique"}},i={},s=[{value:"Code",id:"code",level:2}];function l(e){const a={code:"code",h1:"h1",h2:"h2",li:"li",p:"p",pre:"pre",ul:"ul",...(0,n.a)(),...e.components};return(0,d.jsxs)(d.Fragment,{children:[(0,d.jsx)(a.h1,{id:"dateprochaincadavre",children:"dateProchainCadavre()"}),"\n",(0,d.jsx)(a.p,{children:"La m\xe9thode DateProchainCadavre() de la classe CadavreModel ne prend pas de param\xe8tres et renvoie la date de d\xe9but du prochain cadavre."}),"\n",(0,d.jsx)(a.p,{children:"Cette m\xe9thode fait appel aux entit\xe9es :"}),"\n",(0,d.jsxs)(a.ul,{children:["\n",(0,d.jsx)(a.li,{children:(0,d.jsx)(a.code,{children:"Cadavre"})}),"\n"]}),"\n",(0,d.jsx)(a.h2,{id:"code",children:"Code"}),"\n",(0,d.jsx)(a.pre,{children:(0,d.jsx)(a.code,{className:"language-php",metastring:'title="CadavreModel"',children:"/**\r\n     * R\xe9cup\xe8re la date du prochain cadavre exquis. La m\xe9thode ne v\xe9rifie pas si \r\n     * un cadavre exquis est en cours, la v\xe9rification est \xe0 faire au pr\xe9alable.\r\n     */\r\n    public static function dateProchainCadavre()\r\n    {\r\n        $cadavres = Cadavre::getInstance()->findAll();\r\n        //Si le prochain cadavre exquis commence dans + d'1 an, date de r\xe9f\xe9rence\r\n        $future_date = date('Y-m-d', strtotime('+1 year'));\r\n        $min_date = $future_date;\r\n        //r\xe9cup\xe9rer les dates de chaque cadavre\r\n        foreach ($cadavres as $cadavre => $c) {   \r\n            //si la date de d\xe9but est plus r\xe9cente que la date de r\xe9f, on attribue sa valeur \xe0 min_date\r\n            if($c['date_debut_cadavre']< $min_date){\r\n                $min_date = $c['date_debut_cadavre'];\r\n            }\r\n        }\r\n        //si la valeur de r\xe9f est tjrs l\xe0, alors le prochain cadavre exquis commence au minima\r\n        //dans plus d'un an OU s'il n'y a pas de cadavre exquis pr\xe9vu pour le moment.\r\n        if($min_date===$future_date){\r\n            $min_date = \"Plus d'un an\";\r\n            return $min_date;\r\n        }\r\n        $date = date(\"d/m/Y\", strtotime($min_date));\r\n        return $date;\r\n    }\n"})})]})}function u(e={}){const{wrapper:a}={...(0,n.a)(),...e.components};return a?(0,d.jsx)(a,{...e,children:(0,d.jsx)(l,{...e})}):l(e)}},1151:(e,a,r)=>{r.d(a,{Z:()=>c,a:()=>o});var d=r(7294);const n={},t=d.createContext(n);function o(e){const a=d.useContext(t);return d.useMemo((function(){return"function"==typeof e?e(a):{...a,...e}}),[a,e])}function c(e){let a;return a=e.disableParentContext?"function"==typeof e.components?e.components(n):e.components||n:o(e.components),d.createElement(t.Provider,{value:a},e.children)}}}]);