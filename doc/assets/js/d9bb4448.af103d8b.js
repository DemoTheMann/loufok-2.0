"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[8898],{8791:(e,r,n)=>{n.r(r),n.d(r,{assets:()=>d,contentTitle:()=>i,default:()=>l,frontMatter:()=>o,metadata:()=>s,toc:()=>c});var a=n(5893),t=n(1151);const o={sidebar_position:4},i="cadavreEnCours()",s={id:"model-cadavre/cadavreEnCours",title:"cadavreEnCours()",description:"La m\xe9thode cadavreEnCours() de la classe CadavreModel ne prend pas de param\xe8tres et effectue des v\xe9rifications de p\xe9riodes et de contributions max pour renvoyer les informations du Cadavre Exquis en cours ou alors rien si il n'y en \xe0 pas.",source:"@site/docs/model-cadavre/cadavreEnCours.md",sourceDirName:"model-cadavre",slug:"/model-cadavre/cadavreEnCours",permalink:"/docs/model-cadavre/cadavreEnCours",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/model-cadavre/cadavreEnCours.md",tags:[],version:"current",sidebarPosition:4,frontMatter:{sidebar_position:4},sidebar:"tutorialSidebar",previous:{title:"titres()",permalink:"/docs/model-cadavre/titres"},next:{title:"isCadavreOn()",permalink:"/docs/model-cadavre/isCadavreOn"}},d={},c=[{value:"Code",id:"code",level:2}];function u(e){const r={code:"code",h1:"h1",h2:"h2",li:"li",p:"p",pre:"pre",ul:"ul",...(0,t.a)(),...e.components};return(0,a.jsxs)(a.Fragment,{children:[(0,a.jsx)(r.h1,{id:"cadavreencours",children:"cadavreEnCours()"}),"\n",(0,a.jsx)(r.p,{children:"La m\xe9thode cadavreEnCours() de la classe CadavreModel ne prend pas de param\xe8tres et effectue des v\xe9rifications de p\xe9riodes et de contributions max pour renvoyer les informations du Cadavre Exquis en cours ou alors rien si il n'y en \xe0 pas."}),"\n",(0,a.jsx)(r.p,{children:"Cette m\xe9thode fait appel aux entit\xe9es :"}),"\n",(0,a.jsxs)(r.ul,{children:["\n",(0,a.jsx)(r.li,{children:(0,a.jsx)(r.code,{children:"Cadavre"})}),"\n",(0,a.jsx)(r.li,{children:(0,a.jsx)(r.code,{children:"Contribution"})}),"\n"]}),"\n",(0,a.jsx)(r.h2,{id:"code",children:"Code"}),"\n",(0,a.jsx)(r.pre,{children:(0,a.jsx)(r.code,{className:"language-php",metastring:'title="CadavreModel"',children:"    /**\r\n     * Renvoie le cadavre exquis en cours ou rien\r\n     */\r\npublic static function cadavreEnCours()\r\n    {\r\n        //renvoie le cadavre (array) en cours\r\n        $ajd = date('Y-m-d');\r\n        $cadavres = Cadavre::getInstance()->findAll();\r\n        foreach ($cadavres as $cadavre => $c) {\r\n\r\n            //si un cadavre exquis est en cours aujourd'hui\r\n            if($c['date_debut_cadavre']<= $ajd && $c['date_fin_cadavre']>=$ajd){\r\n            \r\n                //r\xe9cup\xe9rer les contributions du cadavre en cours pour v\xe9rif si le max n'a pas \xe9t\xe9 atteint\r\n                $contributions = Contribution::getInstance()->findBy(['id_'.$_SESSION['role'] => $_SESSION['user_id'], 'id_cadavre'=> $c['id_cadavre']]);\r\n                $max_contribution = 0;\r\n                foreach ($contributions as $contribution) {\r\n                    $max_contribution = $max_contribution + 1; \r\n                }\r\n\r\n                //si le max de contributions a \xe9t\xe9 atteint : renvoie null\r\n                if ($max_contribution >=$c['nb_contributions']) {\r\n                    return null;\r\n                }else{\r\n                    //si le max de contributions n'a pas \xe9t\xe9 atteint : affichage du cadavre en cours\r\n                    return $c;\r\n                }\r\n            }\r\n        }\n"})})]})}function l(e={}){const{wrapper:r}={...(0,t.a)(),...e.components};return r?(0,a.jsx)(r,{...e,children:(0,a.jsx)(u,{...e})}):u(e)}},1151:(e,r,n)=>{n.d(r,{Z:()=>s,a:()=>i});var a=n(7294);const t={},o=a.createContext(t);function i(e){const r=a.useContext(o);return a.useMemo((function(){return"function"==typeof e?e(r):{...r,...e}}),[r,e])}function s(e){let r;return r=e.disableParentContext?"function"==typeof e.components?e.components(t):e.components||t:i(e.components),a.createElement(o.Provider,{value:r},e.children)}}}]);