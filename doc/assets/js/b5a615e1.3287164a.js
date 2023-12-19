"use strict";(self.webpackChunkloufok=self.webpackChunkloufok||[]).push([[5574],{8249:(e,i,n)=>{n.r(i),n.d(i,{assets:()=>o,contentTitle:()=>r,default:()=>u,frontMatter:()=>t,metadata:()=>d,toc:()=>l});var s=n(5893),a=n(1151);const t={sidebar_position:2},r="API Loufok",d={id:"api-loufok",title:"API Loufok",description:"Une API Loufok est mise \xe0 disposition afin de r\xe9cup\xe9rer les donn\xe9es li\xe9es aux cadavre exquis sous format JSON afin d'\xeatre exploit\xe9es par d'autres applications.",source:"@site/docs/api-loufok.md",sourceDirName:".",slug:"/api-loufok",permalink:"/loufok/doc/docs/api-loufok",draft:!1,unlisted:!1,tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Introduction",permalink:"/loufok/doc/docs/introduction"},next:{title:"Model",permalink:"/loufok/doc/docs/category/model"}},o={},l=[{value:"getCadavres",id:"getcadavres",level:3},{value:"Cas d&#39;utilisation",id:"cas-dutilisation",level:4},{value:"getCadavreById",id:"getcadavrebyid",level:3},{value:"Cas d&#39;utilisation",id:"cas-dutilisation-1",level:4},{value:"likeCadavreById",id:"likecadavrebyid",level:3},{value:"Cas d&#39;utilisation",id:"cas-dutilisation-2",level:4}];function c(e){const i={code:"code",em:"em",h1:"h1",h3:"h3",h4:"h4",li:"li",p:"p",ul:"ul",...(0,a.a)(),...e.components};return(0,s.jsxs)(s.Fragment,{children:[(0,s.jsx)(i.h1,{id:"api-loufok",children:"API Loufok"}),"\n",(0,s.jsx)(i.p,{children:"Une API Loufok est mise \xe0 disposition afin de r\xe9cup\xe9rer les donn\xe9es li\xe9es aux cadavre exquis sous format JSON afin d'\xeatre exploit\xe9es par d'autres applications."}),"\n",(0,s.jsx)(i.h3,{id:"getcadavres",children:"getCadavres"}),"\n",(0,s.jsx)(i.p,{children:(0,s.jsx)(i.code,{children:"loufok/api/cadavres"})}),"\n",(0,s.jsxs)(i.p,{children:["Cette route d'API est appel\xe9e en m\xe9thode ",(0,s.jsx)(i.code,{children:"GET"})," et ne prend pas de param\xe8tres."]}),"\n",(0,s.jsxs)(i.p,{children:["Elle renvoie en format ",(0,s.jsx)(i.em,{children:"JSON"})," un tableau associatif contenant tous les cadavres exquis pr\xe9sents sur la base de donn\xe9es."]}),"\n",(0,s.jsxs)(i.p,{children:["Chaque cadavre exquis est pr\xe9sent\xe9 sous la forme d'un objet ",(0,s.jsx)(i.em,{children:"JSON"})," contenant toutes les informations li\xe9es \xe0 ce cadavre exquis, plus la premi\xe8re contribution du cadavre \xe9crite par l'administrateur."]}),"\n",(0,s.jsx)(i.h4,{id:"cas-dutilisation",children:"Cas d'utilisation"}),"\n",(0,s.jsxs)(i.ul,{children:["\n",(0,s.jsx)(i.li,{children:"Une application tierce cherche \xe0 r\xe9colter des informations sur les cadavres exquis de l'application Loufok."}),"\n"]}),"\n",(0,s.jsx)(i.h3,{id:"getcadavrebyid",children:"getCadavreById"}),"\n",(0,s.jsx)(i.p,{children:(0,s.jsx)(i.code,{children:"loufok/api/cadavre/{id}"})}),"\n",(0,s.jsxs)(i.p,{children:["Cette route d'API est appel\xe9e en m\xe9thode ",(0,s.jsx)(i.code,{children:"GET"})," prend en param\xe8tre un identifiant ( ",(0,s.jsx)(i.em,{children:"int"})," ) de cadavre exquis."]}),"\n",(0,s.jsxs)(i.p,{children:["Elle renvoie en format ",(0,s.jsx)(i.em,{children:"JSON"})," un objet contenant toutes les informations li\xe9es \xe0 ce cadavre exquis, mais il contient aussi deux autres tableaux :"]}),"\n",(0,s.jsxs)(i.ul,{children:["\n",(0,s.jsx)(i.li,{children:"L'un comportant la liste des contributions de ce cadavre exquis dans l'ordre de publication."}),"\n",(0,s.jsx)(i.li,{children:"L'autre comportant la liste des joueurs ayant particip\xe9s \xe0 ce cadavre exquis."}),"\n"]}),"\n",(0,s.jsx)(i.h4,{id:"cas-dutilisation-1",children:"Cas d'utilisation"}),"\n",(0,s.jsxs)(i.ul,{children:["\n",(0,s.jsx)(i.li,{children:"Une application tierce cherche \xe0 r\xe9colter des informations sur un cadavre exquis sp\xe9cifique de l'application Loufok."}),"\n",(0,s.jsx)(i.li,{children:"Une application tierce cherche \xe0 r\xe9cup\xe9rer l'enti\xe8ret\xe9 des contributions sur un cadavre exquis sp\xe9cifique dans l'application Loufok."}),"\n",(0,s.jsx)(i.li,{children:"Une application tierce cherche \xe0 r\xe9cup\xe9rer les utilisateurs ayant contribu\xe9 \xe0 un cadavre exquis sp\xe9cifique sur l'application Loufok."}),"\n"]}),"\n",(0,s.jsx)(i.h3,{id:"likecadavrebyid",children:"likeCadavreById"}),"\n",(0,s.jsx)(i.p,{children:(0,s.jsx)(i.code,{children:"loufok/api/cadavre/like"})}),"\n",(0,s.jsxs)(i.p,{children:["Cette route d'API est appel\xe9e en m\xe9thode ",(0,s.jsx)(i.code,{children:"POST"})," et prend en param\xe8tre un identifiant ( ",(0,s.jsx)(i.em,{children:"int"})," ) de cadavre exquis dans le body de la requ\xeate."]}),"\n",(0,s.jsx)(i.p,{children:(0,s.jsx)(i.code,{children:"{ 'idCadavre': {id} }"})}),"\n",(0,s.jsxs)(i.p,{children:["Cette m\xe9thode ne renvoie rien, elle s'occupe seulement d'incr\xe9menter le conteur de mentions ",(0,s.jsx)(i.code,{children:"j'aime"})," dans le tuple d'un cadavre exquis donn\xe9, identifi\xe9 par son id ( ",(0,s.jsx)(i.em,{children:"int"})," )."]}),"\n",(0,s.jsx)(i.h4,{id:"cas-dutilisation-2",children:"Cas d'utilisation"}),"\n",(0,s.jsxs)(i.ul,{children:["\n",(0,s.jsx)(i.li,{children:"Une application tierce int\xe8gre la possibilit\xe9 \xe0 l'utilisateur de laisser un j'aime pour un cadavre exquis qu'il a appr\xe9ci\xe9."}),"\n"]})]})}function u(e={}){const{wrapper:i}={...(0,a.a)(),...e.components};return i?(0,s.jsx)(i,{...e,children:(0,s.jsx)(c,{...e})}):c(e)}},1151:(e,i,n)=>{n.d(i,{Z:()=>d,a:()=>r});var s=n(7294);const a={},t=s.createContext(a);function r(e){const i=s.useContext(t);return s.useMemo((function(){return"function"==typeof e?e(i):{...i,...e}}),[i,e])}function d(e){let i;return i=e.disableParentContext?"function"==typeof e.components?e.components(a):e.components||a:r(e.components),s.createElement(t.Provider,{value:i},e.children)}}}]);