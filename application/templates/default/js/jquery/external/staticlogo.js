function getBaseURL(){var url=location.href;var baseURL=url.substring(0,url.indexOf('/',14));if(baseURL.indexOf('http://localhost')!=-1){var url=location.href;var pathname=location.pathname;var index1=url.indexOf(pathname);var index2=url.indexOf("/",index1+1);var baseLocalUrl=url.substr(0,index2);return baseLocalUrl+"/";}
else{return baseURL+"/";}}
var baseUrl=getBaseURL();var ddsitelogo={setting:{orientation:4,visibleduration:0,fadeduration:[1000,500]},offsets:{x:1240,y:520},logoHTML:'<a href="'+baseUrl+'" title=""><img src="'+baseUrl+'application/templates/default/images/demo.png" style="width:40px; height: 140px; border:0" /></a>',coord:{},keepfixed:function(){if(!this.cssfixedsupport){var $window=jQuery(window)
var is1or3=/^[13]$/.test(this.setting.orientation)
var is1or2=/^[12]$/.test(this.setting.orientation)
var x=$window.scrollLeft()+(is1or3?this.offsets.x:$window.width()-this.$control.width()-this.offsets.x)
var y=$window.scrollTop()+(is1or2?this.offsets.y:$window.height()-this.$control.height()-this.offsets.y)
this.$control.css({left:x+'px',top:y+'px'})}},showlogo:function(){var mainobj=ddsitelogo
this.$control.animate({opacity:1},this.setting.fadeduration[0])
if(this.setting.visibleduration>0){setTimeout(function(){mainobj.$control.stop().animate({opacity:0},mainobj.setting.fadeduration[1],function(){jQuery(window).unbind('scroll.fixed resize.fixed')})},this.setting.visibleduration+this.setting.fadeduration[0])}},init:function(){jQuery(document).ready(function($){var mainobj=ddsitelogo
var iebrws=document.all
mainobj.cssfixedsupport=!iebrws||iebrws&&document.compatMode=="CSS1Compat"&&window.XMLHttpRequest
if(mainobj.cssfixedsupport){mainobj.coord[(/^[13]$/.test(mainobj.setting.orientation))?'left':'right']=mainobj.offsets.x
mainobj.coord[(/^[12]$/.test(mainobj.setting.orientation))?'top':'bottom']=mainobj.offsets.y}
mainobj.$control=$('<div id="mysitelogo">'+mainobj.logoHTML+'</div>').css({position:mainobj.cssfixedsupport?'fixed':'absolute',opacity:0}).css(mainobj.coord).appendTo('body')
if(document.all&&!window.XMLHttpRequest&&mainobj.$control.text()!='')
mainobj.$control.css({width:mainobj.$control.width()})
mainobj.keepfixed()
mainobj.showlogo()
$(window).bind('scroll.fixed resize.fixed',function(){mainobj.keepfixed()})})}}
ddsitelogo.init()