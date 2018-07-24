!function(e){"use strict";var t,n,a,s,i,r;e.matchMedia=e.matchMedia||(t=e.document,a=t.documentElement,s=a.firstElementChild||a.firstChild,i=t.createElement("body"),(r=t.createElement("div")).id="mq-test-1",r.style.cssText="position:absolute;top:-100em",i.style.background="none",i.appendChild(r),function(e){return r.innerHTML='&shy;<style media="'+e+'"> #mq-test-1 { width: 42px; }</style>',a.insertBefore(i,s),n=42===r.offsetWidth,a.removeChild(i),{matches:n,media:e}})}(this),function(e){"use strict";function t(){E(!0)}var n={};e.respond=n,n.update=function(){};var a=[],s=function(){var t=!1;try{t=new e.XMLHttpRequest}catch(n){t=new e.ActiveXObject("Microsoft.XMLHTTP")}return function(){return t}}(),i=function(e,t){var n=s();n&&(n.open("GET",e,!0),n.onreadystatechange=function(){4!==n.readyState||200!==n.status&&304!==n.status||t(n.responseText)},4!==n.readyState&&n.send(null))},r=function(e){return e.replace(n.regex.minmaxwh,"").match(n.regex.other)};if(n.ajax=i,n.queue=a,n.unsupportedmq=r,n.regex={media:/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi,keyframes:/@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi,comments:/\/\*[^*]*\*+([^/][^*]*\*+)*\//gi,urls:/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,findStyles:/@media *([^\{]+)\{([\S\s]+?)$/,only:/(only\s+)?([a-zA-Z]+)\s?/,minw:/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,maxw:/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,minmaxwh:/\(\s*m(in|ax)\-(height|width)\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/gi,other:/\([^\)]*\)/g},n.mediaQueriesSupported=e.matchMedia&&null!==e.matchMedia("only all")&&e.matchMedia("only all").matches,!n.mediaQueriesSupported){var o,l,m,d=e.document,h=d.documentElement,u=[],c=[],f=[],p={},g=d.getElementsByTagName("head")[0]||h,y=d.getElementsByTagName("base")[0],x=g.getElementsByTagName("link"),v=function(){var e,t=d.createElement("div"),n=d.body,a=h.style.fontSize,s=n&&n.style.fontSize,i=!1;return t.style.cssText="position:absolute;font-size:1em;width:1em",n||((n=i=d.createElement("body")).style.background="none"),h.style.fontSize="100%",n.style.fontSize="100%",n.appendChild(t),i&&h.insertBefore(n,h.firstChild),e=t.offsetWidth,i?h.removeChild(n):n.removeChild(t),h.style.fontSize=a,s&&(n.style.fontSize=s),m=parseFloat(e)},E=function(t){var n="clientWidth",a=h[n],s="CSS1Compat"===d.compatMode&&a||d.body[n]||a,i={},r=x[x.length-1],p=(new Date).getTime();if(t&&o&&30>p-o)return e.clearTimeout(l),void(l=e.setTimeout(E,30));for(var y in o=p,u)if(u.hasOwnProperty(y)){var w=u[y],S=w.minw,T=w.maxw,C=null===S,b=null===T;S&&(S=parseFloat(S)*(S.indexOf("em")>-1?m||v():1)),T&&(T=parseFloat(T)*(T.indexOf("em")>-1?m||v():1)),w.hasquery&&(C&&b||!(C||s>=S)||!(b||T>=s))||(i[w.media]||(i[w.media]=[]),i[w.media].push(c[w.rules]))}for(var $ in f)f.hasOwnProperty($)&&f[$]&&f[$].parentNode===g&&g.removeChild(f[$]);for(var z in f.length=0,i)if(i.hasOwnProperty(z)){var M=d.createElement("style"),R=i[z].join("\n");M.type="text/css",M.media=z,g.insertBefore(M,r.nextSibling),M.styleSheet?M.styleSheet.cssText=R:M.appendChild(d.createTextNode(R)),f.push(M)}},w=function(e,t,a){var s=e.replace(n.regex.comments,"").replace(n.regex.keyframes,"").match(n.regex.media),i=s&&s.length||0;t=t.substring(0,t.lastIndexOf("/"));var o=function(e){return e.replace(n.regex.urls,"$1"+t+"$2$3")},l=!i&&a;t.length&&(t+="/"),l&&(i=1);for(var m=0;i>m;m++){var d,h,f,p;l?(d=a,c.push(o(e))):(d=s[m].match(n.regex.findStyles)&&RegExp.$1,c.push(RegExp.$2&&o(RegExp.$2))),p=(f=d.split(",")).length;for(var g=0;p>g;g++)h=f[g],r(h)||u.push({media:h.split("(")[0].match(n.regex.only)&&RegExp.$2||"all",rules:c.length-1,hasquery:h.indexOf("(")>-1,minw:h.match(n.regex.minw)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:h.match(n.regex.maxw)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}E()},S=function(){if(a.length){var t=a.shift();i(t.href,function(n){w(n,t.href,t.media),p[t.href]=!0,e.setTimeout(function(){S()},0)})}},T=function(){for(var t=0;t<x.length;t++){var n=x[t],s=n.href,i=n.media,r=n.rel&&"stylesheet"===n.rel.toLowerCase();s&&r&&!p[s]&&(n.styleSheet&&n.styleSheet.rawCssText?(w(n.styleSheet.rawCssText,s,i),p[s]=!0):(!/^([a-zA-Z:]*\/\/)/.test(s)&&!y||s.replace(RegExp.$1,"").split("/")[0]===e.location.host)&&("//"===s.substring(0,2)&&(s=e.location.protocol+s),a.push({href:s,media:i})))}S()};T(),n.update=T,n.getEmValue=v,e.addEventListener?e.addEventListener("resize",t,!1):e.attachEvent&&e.attachEvent("onresize",t)}}(this);