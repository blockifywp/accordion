(()=>{"use strict";var e,r={1498:()=>{document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll("details");e.forEach((r=>{r.addEventListener("click",(()=>{e.forEach((e=>{e!==r&&e.removeAttribute("open")}))}))}));const r=document.getElementsByTagName("summary");if(r){const e=e=>e&&e.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g).map((e=>e.toLowerCase())).join("-");[...r].forEach((function(r){r.id=e(r.innerText)}))}}))}},t={};function o(e){var n=t[e];if(void 0!==n)return n.exports;var a=t[e]={exports:{}};return r[e](a,a.exports,o),a.exports}o.m=r,e=[],o.O=(r,t,n,a)=>{if(!t){var i=1/0;for(l=0;l<e.length;l++){t=e[l][0],n=e[l][1],a=e[l][2];for(var c=!0,s=0;s<t.length;s++)(!1&a||i>=a)&&Object.keys(o.O).every((e=>o.O[e](t[s])))?t.splice(s--,1):(c=!1,a<i&&(i=a));if(c){e.splice(l--,1);var f=n();void 0!==f&&(r=f)}}return r}a=a||0;for(var l=e.length;l>0&&e[l-1][2]>a;l--)e[l]=e[l-1];e[l]=[t,n,a]},o.o=(e,r)=>Object.prototype.hasOwnProperty.call(e,r),(()=>{var e={748:0,995:0};o.O.j=r=>0===e[r];var r=(r,t)=>{var n,a,i=t[0],c=t[1],s=t[2],f=0;if(i.some((r=>0!==e[r]))){for(n in c)o.o(c,n)&&(o.m[n]=c[n]);if(s)var l=s(o)}for(r&&r(t);f<i.length;f++)a=i[f],o.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return o.O(l)},t=self.webpackChunkblockify_theme=self.webpackChunkblockify_theme||[];t.forEach(r.bind(null,0)),t.push=r.bind(null,t.push.bind(t))})();var n=o.O(void 0,[995],(()=>o(1498)));n=o.O(n)})();