if(typeof jqcc==="undefined"){jqcc=jQuery}jqcc.ui||function(e){function a(t,n,r,i){function s(r){var i=e[t][n][r]||[];return typeof i=="string"?i.split(/,?\s+/):i}var o=s("getter");if(i.length==1&&typeof i[0]=="string"){o=o.concat(s("getterSetter"))}return e.inArray(r,o)!=-1}var t=e.fn.remove,n=e.browser.mozilla&&parseFloat(e.browser.version)<1.9;e.ui={version:"1.7.1",plugin:{add:function(t,n,r){var i=e.ui[t].prototype;for(var s in r){i.plugins[s]=i.plugins[s]||[];i.plugins[s].push([n,r[s]])}},call:function(e,t,n){var r=e.plugins[t];if(!r||!e.element[0].parentNode){return}for(var i=0;i<r.length;i++){if(e.options[r[i][0]]){r[i][1].apply(e.element,n)}}}},contains:function(e,t){return document.compareDocumentPosition?e.compareDocumentPosition(t)&16:e!==t&&e.contains(t)},hasScroll:function(t,n){if(e(t).css("overflow")=="hidden"){return false}var r=n&&n=="left"?"scrollLeft":"scrollTop",i=false;if(t[r]>0){return true}t[r]=1;i=t[r]>0;t[r]=0;return i},isOverAxis:function(e,t,n){return e>t&&e<t+n},isOver:function(t,n,r,i,s,o){return e.ui.isOverAxis(t,r,s)&&e.ui.isOverAxis(n,i,o)},keyCode:{BACKSPACE:8,CAPS_LOCK:20,COMMA:188,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38}};if(n){var r=e.attr,i=e.fn.removeAttr,s="http://www.w3.org/2005/07/aaa",o=/^aria-/,u=/^wairole:/;e.attr=function(e,t,n){var i=n!==undefined;return t=="role"?i?r.call(this,e,t,"wairole:"+n):(r.apply(this,arguments)||"").replace(u,""):o.test(t)?i?e.setAttributeNS(s,t.replace(o,"aaa:"),n):r.call(this,e,t.replace(o,"aaa:")):r.apply(this,arguments)};e.fn.removeAttr=function(e){return o.test(e)?this.each(function(){this.removeAttributeNS(s,e.replace(o,""))}):i.call(this,e)}}e.fn.extend({remove:function(){e("*",this).add(this).each(function(){e(this).triggerHandler("remove")});return t.apply(this,arguments)},enableSelection:function(){return this.attr("unselectable","off").css("MozUserSelect","").unbind("selectstart.ui")},disableSelection:function(){return this.attr("unselectable","on").css("MozUserSelect","none").bind("selectstart.ui",function(){return false})},scrollParent:function(){var t;if(e.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))){t=this.parents().filter(function(){return/(relative|absolute|fixed)/.test(e.curCSS(this,"position",1))&&/(auto|scroll)/.test(e.curCSS(this,"overflow",1)+e.curCSS(this,"overflow-y",1)+e.curCSS(this,"overflow-x",1))}).eq(0)}else{t=this.parents().filter(function(){return/(auto|scroll)/.test(e.curCSS(this,"overflow",1)+e.curCSS(this,"overflow-y",1)+e.curCSS(this,"overflow-x",1))}).eq(0)}return/fixed/.test(this.css("position"))||!t.length?e(document):t}});e.extend(e.expr[":"],{data:function(t,n,r){return!!e.data(t,r[3])},focusable:function(t){var n=t.nodeName.toLowerCase(),r=e.attr(t,"tabindex");return(/input|select|textarea|button|object/.test(n)?!t.disabled:"a"==n||"area"==n?t.href||!isNaN(r):!isNaN(r))&&!e(t)["area"==n?"parents":"closest"](":hidden").length},tabbable:function(t){var n=e.attr(t,"tabindex");return(isNaN(n)||n>=0)&&e(t).is(":focusable")}});e.widget=function(t,n){var r=t.split(".")[0];t=t.split(".")[1];e.fn[t]=function(n){var i=typeof n=="string",s=Array.prototype.slice.call(arguments,1);if(i&&n.substring(0,1)=="_"){return this}if(i&&a(r,t,n,s)){var o=e.data(this[0],t);return o?o[n].apply(o,s):undefined}return this.each(function(){var o=e.data(this,t);!o&&!i&&e.data(this,t,new e[r][t](this,n))._init();o&&i&&e.isFunction(o[n])&&o[n].apply(o,s)})};e[r]=e[r]||{};e[r][t]=function(n,i){var s=this;this.namespace=r;this.widgetName=t;this.widgetEventPrefix=e[r][t].eventPrefix||t;this.widgetBaseClass=r+"-"+t;this.options=e.extend({},e.widget.defaults,e[r][t].defaults,e.metadata&&e.metadata.get(n)[t],i);this.element=e(n).bind("setData."+t,function(e,t,r){if(e.target==n){return s._setData(t,r)}}).bind("getData."+t,function(e,t){if(e.target==n){return s._getData(t)}}).bind("remove",function(){return s.destroy()})};e[r][t].prototype=e.extend({},e.widget.prototype,n);e[r][t].getterSetter="option"};e.widget.prototype={_init:function(){},destroy:function(){this.element.removeData(this.widgetName).removeClass(this.widgetBaseClass+"-disabled"+" "+this.namespace+"-state-disabled").removeAttr("aria-disabled")},option:function(t,n){var r=t,i=this;if(typeof t=="string"){if(n===undefined){return this._getData(t)}r={};r[t]=n}e.each(r,function(e,t){i._setData(e,t)})},_getData:function(e){return this.options[e]},_setData:function(e,t){this.options[e]=t;if(e=="disabled"){this.element[t?"addClass":"removeClass"](this.widgetBaseClass+"-disabled"+" "+this.namespace+"-state-disabled").attr("aria-disabled",t)}},enable:function(){this._setData("disabled",false)},disable:function(){this._setData("disabled",true)},_trigger:function(t,n,r){var i=this.options[t],s=t==this.widgetEventPrefix?t:this.widgetEventPrefix+t;n=e.Event(n);n.type=s;if(n.originalEvent){for(var o=e.event.props.length,u;o;){u=e.event.props[--o];n[u]=n.originalEvent[u]}}this.element.trigger(n,r);return!(e.isFunction(i)&&i.call(this.element[0],n,r)===false||n.isDefaultPrevented())}};e.widget.defaults={disabled:false};e.ui.mouse={_mouseInit:function(){var t=this;this.element.bind("mousedown."+this.widgetName,function(e){return t._mouseDown(e)}).bind("click."+this.widgetName,function(e){if(t._preventClickEvent){t._preventClickEvent=false;e.stopImmediatePropagation();return false}});if(e.browser.msie){this._mouseUnselectable=this.element.attr("unselectable");this.element.attr("unselectable","on")}this.started=false},_mouseDestroy:function(){this.element.unbind("."+this.widgetName);e.browser.msie&&this.element.attr("unselectable",this._mouseUnselectable)},_mouseDown:function(t){t.originalEvent=t.originalEvent||{};if(t.originalEvent.mouseHandled){return}this._mouseStarted&&this._mouseUp(t);this._mouseDownEvent=t;var n=this,r=t.which==1,i=typeof this.options.cancel=="string"?e(t.target).parents().add(t.target).filter(this.options.cancel).length:false;if(!r||i||!this._mouseCapture(t)){return true}this.mouseDelayMet=!this.options.delay;if(!this.mouseDelayMet){this._mouseDelayTimer=setTimeout(function(){n.mouseDelayMet=true},this.options.delay)}if(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)){this._mouseStarted=this._mouseStart(t)!==false;if(!this._mouseStarted){t.preventDefault();return true}}this._mouseMoveDelegate=function(e){return n._mouseMove(e)};this._mouseUpDelegate=function(e){return n._mouseUp(e)};e(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate);e.browser.safari||t.preventDefault();t.originalEvent.mouseHandled=true;return true},_mouseMove:function(t){if(e.browser.msie&&!t.button){return this._mouseUp(t)}if(this._mouseStarted){this._mouseDrag(t);return t.preventDefault()}if(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)){this._mouseStarted=this._mouseStart(this._mouseDownEvent,t)!==false;this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)}return!this._mouseStarted},_mouseUp:function(t){e(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate);if(this._mouseStarted){this._mouseStarted=false;this._preventClickEvent=t.target==this._mouseDownEvent.target;this._mouseStop(t)}return false},_mouseDistanceMet:function(e){return Math.max(Math.abs(this._mouseDownEvent.pageX-e.pageX),Math.abs(this._mouseDownEvent.pageY-e.pageY))>=this.options.distance},_mouseDelayMet:function(e){return this.mouseDelayMet},_mouseStart:function(e){},_mouseDrag:function(e){},_mouseStop:function(e){},_mouseCapture:function(e){return true}};e.ui.mouse.defaults={cancel:null,distance:1,delay:0}}(jqcc);(function(e){e.widget("ui.draggable",e.extend({},e.ui.mouse,{_init:function(){if(this.options.helper=="original"&&!/^(?:r|a|f)/.test(this.element.css("position")))this.element[0].style.position="relative";this.options.addClasses&&this.element.addClass("ui-draggable");this.options.disabled&&this.element.addClass("ui-draggable-disabled");this._mouseInit()},destroy:function(){if(!this.element.data("draggable"))return;this.element.removeData("draggable").unbind(".draggable").removeClass("ui-draggable"+" ui-draggable-dragging"+" ui-draggable-disabled");this._mouseDestroy()},_mouseCapture:function(t){var n=this.options;if(this.helper||n.disabled||e(t.target).is(".ui-resizable-handle"))return false;this.handle=this._getHandle(t);if(!this.handle)return false;return true},_mouseStart:function(t){var n=this.options;this.helper=this._createHelper(t);this._cacheHelperProportions();if(e.ui.ddmanager)e.ui.ddmanager.current=this;this._cacheMargins();this.cssPosition=this.helper.css("position");this.scrollParent=this.helper.scrollParent();this.offset=this.element.offset();this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left};e.extend(this.offset,{click:{left:t.pageX-this.offset.left,top:t.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()});this.originalPosition=this._generatePosition(t);this.originalPageX=t.pageX;this.originalPageY=t.pageY;if(n.cursorAt)this._adjustOffsetFromHelper(n.cursorAt);if(n.containment)this._setContainment();this._trigger("start",t);this._cacheHelperProportions();if(e.ui.ddmanager&&!n.dropBehaviour)e.ui.ddmanager.prepareOffsets(this,t);this.helper.addClass("ui-draggable-dragging");this._mouseDrag(t,true);return true},_mouseDrag:function(t,n){this.position=this._generatePosition(t);this.positionAbs=this._convertPositionTo("absolute");if(!n){var r=this._uiHash();this._trigger("drag",t,r);this.position=r.position}if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";if(e.ui.ddmanager)e.ui.ddmanager.drag(this,t);return false},_mouseStop:function(t){var n=false;if(e.ui.ddmanager&&!this.options.dropBehaviour)n=e.ui.ddmanager.drop(this,t);if(this.dropped){n=this.dropped;this.dropped=false}if(this.options.revert=="invalid"&&!n||this.options.revert=="valid"&&n||this.options.revert===true||e.isFunction(this.options.revert)&&this.options.revert.call(this.element,n)){var r=this;e(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){r._trigger("stop",t);r._clear()})}else{this._trigger("stop",t);this._clear()}return false},_getHandle:function(t){var n=!this.options.handle||!e(this.options.handle,this.element).length?true:false;e(this.options.handle,this.element).find("*").andSelf().each(function(){if(this==t.target)n=true});return n},_createHelper:function(t){var n=this.options;var r=e.isFunction(n.helper)?e(n.helper.apply(this.element[0],[t])):n.helper=="clone"?this.element.clone():this.element;if(!r.parents("body").length)r.appendTo(n.appendTo=="parent"?this.element[0].parentNode:n.appendTo);if(r[0]!=this.element[0]&&!/(fixed|absolute)/.test(r.css("position")))r.css("position","absolute");return r},_adjustOffsetFromHelper:function(e){if(e.left!=undefined)this.offset.click.left=e.left+this.margins.left;if(e.right!=undefined)this.offset.click.left=this.helperProportions.width-e.right+this.margins.left;if(e.top!=undefined)this.offset.click.top=e.top+this.margins.top;if(e.bottom!=undefined)this.offset.click.top=this.helperProportions.height-e.bottom+this.margins.top},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var t=this.offsetParent.offset();if(this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&e.ui.contains(this.scrollParent[0],this.offsetParent[0])){t.left+=this.scrollParent.scrollLeft();t.top+=this.scrollParent.scrollTop()}if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&e.browser.msie)t={top:0,left:0};return{top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var e=this.element.position();return{top:e.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:e.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}else{return{top:0,left:0}}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t=this.options;if(t.containment=="parent")t.containment=this.helper[0].parentNode;if(t.containment=="document"||t.containment=="window")this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,e(t.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(e(t.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(t.containment)&&t.containment.constructor!=Array){var n=e(t.containment)[0];if(!n)return;var r=e(t.containment).offset();var i=e(n).css("overflow")!="hidden";this.containment=[r.left+(parseInt(e(n).css("borderLeftWidth"),10)||0)+(parseInt(e(n).css("paddingLeft"),10)||0)-this.margins.left,r.top+(parseInt(e(n).css("borderTopWidth"),10)||0)+(parseInt(e(n).css("paddingTop"),10)||0)-this.margins.top,r.left+(i?Math.max(n.scrollWidth,n.offsetWidth):n.offsetWidth)-(parseInt(e(n).css("borderLeftWidth"),10)||0)-(parseInt(e(n).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,r.top+(i?Math.max(n.scrollHeight,n.offsetHeight):n.offsetHeight)-(parseInt(e(n).css("borderTopWidth"),10)||0)-(parseInt(e(n).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]}else if(t.containment.constructor==Array){this.containment=t.containment}},_convertPositionTo:function(t,n){if(!n)n=this.position;var r=t=="absolute"?1:-1;var i=this.options,s=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&e.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,o=/(html|body)/i.test(s[0].tagName);return{top:n.top+this.offset.relative.top*r+this.offset.parent.top*r-(e.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():o?0:s.scrollTop())*r),left:n.left+this.offset.relative.left*r+this.offset.parent.left*r-(e.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():o?0:s.scrollLeft())*r)}},_generatePosition:function(t){var n=this.options,r=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&e.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,i=/(html|body)/i.test(r[0].tagName);if(this.cssPosition=="relative"&&!(this.scrollParent[0]!=document&&this.scrollParent[0]!=this.offsetParent[0])){this.offset.relative=this._getRelativeOffset()}var s=t.pageX;var o=t.pageY;if(this.originalPosition){if(this.containment){if(t.pageX-this.offset.click.left<this.containment[0])s=this.containment[0]+this.offset.click.left;if(t.pageY-this.offset.click.top<this.containment[1])o=this.containment[1]+this.offset.click.top;if(t.pageX-this.offset.click.left>this.containment[2])s=this.containment[2]+this.offset.click.left;if(t.pageY-this.offset.click.top>this.containment[3])o=this.containment[3]+this.offset.click.top}if(n.grid){var u=this.originalPageY+Math.round((o-this.originalPageY)/n.grid[1])*n.grid[1];o=this.containment?!(u-this.offset.click.top<this.containment[1]||u-this.offset.click.top>this.containment[3])?u:!(u-this.offset.click.top<this.containment[1])?u-n.grid[1]:u+n.grid[1]:u;var a=this.originalPageX+Math.round((s-this.originalPageX)/n.grid[0])*n.grid[0];s=this.containment?!(a-this.offset.click.left<this.containment[0]||a-this.offset.click.left>this.containment[2])?a:!(a-this.offset.click.left<this.containment[0])?a-n.grid[0]:a+n.grid[0]:a}}return{top:o-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(e.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():i?0:r.scrollTop()),left:s-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(e.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():i?0:r.scrollLeft())}},_clear:function(){this.helper.removeClass("ui-draggable-dragging");if(this.helper[0]!=this.element[0]&&!this.cancelHelperRemoval)this.helper.remove();this.helper=null;this.cancelHelperRemoval=false},_trigger:function(t,n,r){r=r||this._uiHash();e.ui.plugin.call(this,t,[n,r]);if(t=="drag")this.positionAbs=this._convertPositionTo("absolute");return e.widget.prototype._trigger.call(this,t,n,r)},plugins:{},_uiHash:function(e){return{helper:this.helper,position:this.position,absolutePosition:this.positionAbs,offset:this.positionAbs}}}));e.extend(e.ui.draggable,{version:"1.7.1",eventPrefix:"drag",defaults:{addClasses:true,appendTo:"parent",axis:false,cancel:":input,option",connectToSortable:false,containment:false,cursor:"auto",cursorAt:false,delay:0,distance:1,grid:false,handle:false,helper:"original",iframeFix:false,opacity:false,refreshPositions:false,revert:false,revertDuration:500,scope:"default",scroll:true,scrollSensitivity:20,scrollSpeed:20,snap:false,snapMode:"both",snapTolerance:20,stack:false,zIndex:false}});e.ui.plugin.add("draggable","connectToSortable",{start:function(t,n){var r=e(this).data("draggable"),i=r.options,s=e.extend({},n,{item:r.element});r.sortables=[];e(i.connectToSortable).each(function(){var n=e.data(this,"sortable");if(n&&!n.options.disabled){r.sortables.push({instance:n,shouldRevert:n.options.revert});n._refreshItems();n._trigger("activate",t,s)}})},stop:function(t,n){var r=e(this).data("draggable"),i=e.extend({},n,{item:r.element});e.each(r.sortables,function(){if(this.instance.isOver){this.instance.isOver=0;r.cancelHelperRemoval=true;this.instance.cancelHelperRemoval=false;if(this.shouldRevert)this.instance.options.revert=true;this.instance._mouseStop(t);this.instance.options.helper=this.instance.options._helper;if(r.options.helper=="original")this.instance.currentItem.css({top:"auto",left:"auto"})}else{this.instance.cancelHelperRemoval=false;this.instance._trigger("deactivate",t,i)}})},drag:function(t,n){var r=e(this).data("draggable"),i=this;var s=function(t){var n=this.offset.click.top,r=this.offset.click.left;var i=this.positionAbs.top,s=this.positionAbs.left;var o=t.height,u=t.width;var a=t.top,f=t.left;return e.ui.isOver(i+n,s+r,a,f,o,u)};e.each(r.sortables,function(s){this.instance.positionAbs=r.positionAbs;this.instance.helperProportions=r.helperProportions;this.instance.offset.click=r.offset.click;if(this.instance._intersectsWith(this.instance.containerCache)){if(!this.instance.isOver){this.instance.isOver=1;this.instance.currentItem=e(i).clone().appendTo(this.instance.element).data("sortable-item",true);this.instance.options._helper=this.instance.options.helper;this.instance.options.helper=function(){return n.helper[0]};t.target=this.instance.currentItem[0];this.instance._mouseCapture(t,true);this.instance._mouseStart(t,true,true);this.instance.offset.click.top=r.offset.click.top;this.instance.offset.click.left=r.offset.click.left;this.instance.offset.parent.left-=r.offset.parent.left-this.instance.offset.parent.left;this.instance.offset.parent.top-=r.offset.parent.top-this.instance.offset.parent.top;r._trigger("toSortable",t);r.dropped=this.instance.element;r.currentItem=r.element;this.instance.fromOutside=r}if(this.instance.currentItem)this.instance._mouseDrag(t)}else{if(this.instance.isOver){this.instance.isOver=0;this.instance.cancelHelperRemoval=true;this.instance.options.revert=false;this.instance._trigger("out",t,this.instance._uiHash(this.instance));this.instance._mouseStop(t,true);this.instance.options.helper=this.instance.options._helper;this.instance.currentItem.remove();if(this.instance.placeholder)this.instance.placeholder.remove();r._trigger("fromSortable",t);r.dropped=false}}})}});e.ui.plugin.add("draggable","cursor",{start:function(t,n){var r=e("body"),i=e(this).data("draggable").options;if(r.css("cursor"))i._cursor=r.css("cursor");r.css("cursor",i.cursor)},stop:function(t,n){var r=e(this).data("draggable").options;if(r._cursor)e("body").css("cursor",r._cursor)}});e.ui.plugin.add("draggable","iframeFix",{start:function(t,n){var r=e(this).data("draggable").options;e(r.iframeFix===true?"iframe":r.iframeFix).each(function(){e('<div class="ui-draggable-iframeFix" style="background: #fff;"></div>').css({width:this.offsetWidth+"px",height:this.offsetHeight+"px",position:"absolute",opacity:"0.001",zIndex:1e3}).css(e(this).offset()).appendTo("body")})},stop:function(t,n){e("div.ui-draggable-iframeFix").each(function(){this.parentNode.removeChild(this)})}});e.ui.plugin.add("draggable","opacity",{start:function(t,n){var r=e(n.helper),i=e(this).data("draggable").options;if(r.css("opacity"))i._opacity=r.css("opacity");r.css("opacity",i.opacity)},stop:function(t,n){var r=e(this).data("draggable").options;if(r._opacity)e(n.helper).css("opacity",r._opacity)}});e.ui.plugin.add("draggable","scroll",{start:function(t,n){var r=e(this).data("draggable");if(r.scrollParent[0]!=document&&r.scrollParent[0].tagName!="HTML")r.overflowOffset=r.scrollParent.offset()},drag:function(t,n){var r=e(this).data("draggable"),i=r.options,s=false;if(r.scrollParent[0]!=document&&r.scrollParent[0].tagName!="HTML"){if(!i.axis||i.axis!="x"){if(r.overflowOffset.top+r.scrollParent[0].offsetHeight-t.pageY<i.scrollSensitivity)r.scrollParent[0].scrollTop=s=r.scrollParent[0].scrollTop+i.scrollSpeed;else if(t.pageY-r.overflowOffset.top<i.scrollSensitivity)r.scrollParent[0].scrollTop=s=r.scrollParent[0].scrollTop-i.scrollSpeed}if(!i.axis||i.axis!="y"){if(r.overflowOffset.left+r.scrollParent[0].offsetWidth-t.pageX<i.scrollSensitivity)r.scrollParent[0].scrollLeft=s=r.scrollParent[0].scrollLeft+i.scrollSpeed;else if(t.pageX-r.overflowOffset.left<i.scrollSensitivity)r.scrollParent[0].scrollLeft=s=r.scrollParent[0].scrollLeft-i.scrollSpeed}}else{if(!i.axis||i.axis!="x"){if(t.pageY-e(document).scrollTop()<i.scrollSensitivity)s=e(document).scrollTop(e(document).scrollTop()-i.scrollSpeed);else if(e(window).height()-(t.pageY-e(document).scrollTop())<i.scrollSensitivity)s=e(document).scrollTop(e(document).scrollTop()+i.scrollSpeed)}if(!i.axis||i.axis!="y"){if(t.pageX-e(document).scrollLeft()<i.scrollSensitivity)s=e(document).scrollLeft(e(document).scrollLeft()-i.scrollSpeed);else if(e(window).width()-(t.pageX-e(document).scrollLeft())<i.scrollSensitivity)s=e(document).scrollLeft(e(document).scrollLeft()+i.scrollSpeed)}}if(s!==false&&e.ui.ddmanager&&!i.dropBehaviour)e.ui.ddmanager.prepareOffsets(r,t)}});e.ui.plugin.add("draggable","snap",{start:function(t,n){var r=e(this).data("draggable"),i=r.options;r.snapElements=[];e(i.snap.constructor!=String?i.snap.items||":data(draggable)":i.snap).each(function(){var t=e(this);var n=t.offset();if(this!=r.element[0])r.snapElements.push({item:this,width:t.outerWidth(),height:t.outerHeight(),top:n.top,left:n.left})})},drag:function(t,n){var r=e(this).data("draggable"),i=r.options;var s=i.snapTolerance;var o=n.offset.left,u=o+r.helperProportions.width,a=n.offset.top,f=a+r.helperProportions.height;for(var l=r.snapElements.length-1;l>=0;l--){var c=r.snapElements[l].left,h=c+r.snapElements[l].width,p=r.snapElements[l].top,d=p+r.snapElements[l].height;if(!(c-s<o&&o<h+s&&p-s<a&&a<d+s||c-s<o&&o<h+s&&p-s<f&&f<d+s||c-s<u&&u<h+s&&p-s<a&&a<d+s||c-s<u&&u<h+s&&p-s<f&&f<d+s)){if(r.snapElements[l].snapping)r.options.snap.release&&r.options.snap.release.call(r.element,t,e.extend(r._uiHash(),{snapItem:r.snapElements[l].item}));r.snapElements[l].snapping=false;continue}if(i.snapMode!="inner"){var v=Math.abs(p-f)<=s;var m=Math.abs(d-a)<=s;var g=Math.abs(c-u)<=s;var y=Math.abs(h-o)<=s;if(v)n.position.top=r._convertPositionTo("relative",{top:p-r.helperProportions.height,left:0}).top-r.margins.top;if(m)n.position.top=r._convertPositionTo("relative",{top:d,left:0}).top-r.margins.top;if(g)n.position.left=r._convertPositionTo("relative",{top:0,left:c-r.helperProportions.width}).left-r.margins.left;if(y)n.position.left=r._convertPositionTo("relative",{top:0,left:h}).left-r.margins.left}var b=v||m||g||y;if(i.snapMode!="outer"){var v=Math.abs(p-a)<=s;var m=Math.abs(d-f)<=s;var g=Math.abs(c-o)<=s;var y=Math.abs(h-u)<=s;if(v)n.position.top=r._convertPositionTo("relative",{top:p,left:0}).top-r.margins.top;if(m)n.position.top=r._convertPositionTo("relative",{top:d-r.helperProportions.height,left:0}).top-r.margins.top;if(g)n.position.left=r._convertPositionTo("relative",{top:0,left:c}).left-r.margins.left;if(y)n.position.left=r._convertPositionTo("relative",{top:0,left:h-r.helperProportions.width}).left-r.margins.left}if(!r.snapElements[l].snapping&&(v||m||g||y||b))r.options.snap.snap&&r.options.snap.snap.call(r.element,t,e.extend(r._uiHash(),{snapItem:r.snapElements[l].item}));r.snapElements[l].snapping=v||m||g||y||b}}});e.ui.plugin.add("draggable","stack",{start:function(t,n){var r=e(this).data("draggable").options;var i=e.makeArray(e(r.stack.group)).sort(function(t,n){return(parseInt(e(t).css("zIndex"),10)||r.stack.min)-(parseInt(e(n).css("zIndex"),10)||r.stack.min)});e(i).each(function(e){this.style.zIndex=r.stack.min+e});this[0].style.zIndex=r.stack.min+i.length}});e.ui.plugin.add("draggable","zIndex",{start:function(t,n){var r=e(n.helper),i=e(this).data("draggable").options;if(r.css("zIndex"))i._zIndex=r.css("zIndex");r.css("zIndex",i.zIndex)},stop:function(t,n){var r=e(this).data("draggable").options;if(r._zIndex)e(n.helper).css("zIndex",r._zIndex)}})})(jqcc);(function(e){e.widget("ui.droppable",{_init:function(){var t=this.options,n=t.accept;this.isover=0;this.isout=1;this.options.accept=this.options.accept&&e.isFunction(this.options.accept)?this.options.accept:function(e){return e.is(n)};this.proportions={width:this.element[0].offsetWidth,height:this.element[0].offsetHeight};e.ui.ddmanager.droppables[this.options.scope]=e.ui.ddmanager.droppables[this.options.scope]||[];e.ui.ddmanager.droppables[this.options.scope].push(this);this.options.addClasses&&this.element.addClass("ui-droppable")},destroy:function(){var t=e.ui.ddmanager.droppables[this.options.scope];for(var n=0;n<t.length;n++)if(t[n]==this)t.splice(n,1);this.element.removeClass("ui-droppable ui-droppable-disabled").removeData("droppable").unbind(".droppable")},_setData:function(t,n){if(t=="accept"){this.options.accept=n&&e.isFunction(n)?n:function(e){return e.is(n)}}else{e.widget.prototype._setData.apply(this,arguments)}},_activate:function(t){var n=e.ui.ddmanager.current;if(this.options.activeClass)this.element.addClass(this.options.activeClass);n&&this._trigger("activate",t,this.ui(n))},_deactivate:function(t){var n=e.ui.ddmanager.current;if(this.options.activeClass)this.element.removeClass(this.options.activeClass);n&&this._trigger("deactivate",t,this.ui(n))},_over:function(t){var n=e.ui.ddmanager.current;if(!n||(n.currentItem||n.element)[0]==this.element[0])return;if(this.options.accept.call(this.element[0],n.currentItem||n.element)){if(this.options.hoverClass)this.element.addClass(this.options.hoverClass);this._trigger("over",t,this.ui(n))}},_out:function(t){var n=e.ui.ddmanager.current;if(!n||(n.currentItem||n.element)[0]==this.element[0])return;if(this.options.accept.call(this.element[0],n.currentItem||n.element)){if(this.options.hoverClass)this.element.removeClass(this.options.hoverClass);this._trigger("out",t,this.ui(n))}},_drop:function(t,n){var r=n||e.ui.ddmanager.current;if(!r||(r.currentItem||r.element)[0]==this.element[0])return false;var i=false;this.element.find(":data(droppable)").not(".ui-draggable-dragging").each(function(){var t=e.data(this,"droppable");if(t.options.greedy&&e.ui.intersect(r,e.extend(t,{offset:t.element.offset()}),t.options.tolerance)){i=true;return false}});if(i)return false;if(this.options.accept.call(this.element[0],r.currentItem||r.element)){if(this.options.activeClass)this.element.removeClass(this.options.activeClass);if(this.options.hoverClass)this.element.removeClass(this.options.hoverClass);this._trigger("drop",t,this.ui(r));return this.element}return false},ui:function(e){return{draggable:e.currentItem||e.element,helper:e.helper,position:e.position,absolutePosition:e.positionAbs,offset:e.positionAbs}}});e.extend(e.ui.droppable,{version:"1.7.1",eventPrefix:"drop",defaults:{accept:"*",activeClass:false,addClasses:true,greedy:false,hoverClass:false,scope:"default",tolerance:"intersect"}});e.ui.intersect=function(t,n,r){if(!n.offset)return false;var i=(t.positionAbs||t.position.absolute).left,s=i+t.helperProportions.width,o=(t.positionAbs||t.position.absolute).top,u=o+t.helperProportions.height;var a=n.offset.left,f=a+n.proportions.width,l=n.offset.top,c=l+n.proportions.height;switch(r){case"fit":return a<i&&s<f&&l<o&&u<c;break;case"intersect":return a<i+t.helperProportions.width/2&&s-t.helperProportions.width/2<f&&l<o+t.helperProportions.height/2&&u-t.helperProportions.height/2<c;break;case"pointer":var h=(t.positionAbs||t.position.absolute).left+(t.clickOffset||t.offset.click).left,p=(t.positionAbs||t.position.absolute).top+(t.clickOffset||t.offset.click).top,d=e.ui.isOver(p,h,l,a,n.proportions.height,n.proportions.width);return d;break;case"touch":return(o>=l&&o<=c||u>=l&&u<=c||o<l&&u>c)&&(i>=a&&i<=f||s>=a&&s<=f||i<a&&s>f);break;default:return false;break}};e.ui.ddmanager={current:null,droppables:{"default":[]},prepareOffsets:function(t,n){var r=e.ui.ddmanager.droppables[t.options.scope];var i=n?n.type:null;var s=(t.currentItem||t.element).find(":data(droppable)").andSelf();e:for(var o=0;o<r.length;o++){if(r[o].options.disabled||t&&!r[o].options.accept.call(r[o].element[0],t.currentItem||t.element))continue;for(var u=0;u<s.length;u++){if(s[u]==r[o].element[0]){r[o].proportions.height=0;continue e}}r[o].visible=r[o].element.css("display")!="none";if(!r[o].visible)continue;r[o].offset=r[o].element.offset();r[o].proportions={width:r[o].element[0].offsetWidth,height:r[o].element[0].offsetHeight};if(i=="mousedown")r[o]._activate.call(r[o],n)}},drop:function(t,n){var r=false;e.each(e.ui.ddmanager.droppables[t.options.scope],function(){if(!this.options)return;if(!this.options.disabled&&this.visible&&e.ui.intersect(t,this,this.options.tolerance))r=this._drop.call(this,n);if(!this.options.disabled&&this.visible&&this.options.accept.call(this.element[0],t.currentItem||t.element)){this.isout=1;this.isover=0;this._deactivate.call(this,n)}});return r},drag:function(t,n){if(t.options.refreshPositions)e.ui.ddmanager.prepareOffsets(t,n);e.each(e.ui.ddmanager.droppables[t.options.scope],function(){if(this.options.disabled||this.greedyChild||!this.visible)return;var r=e.ui.intersect(t,this,this.options.tolerance);var i=!r&&this.isover==1?"isout":r&&this.isover==0?"isover":null;if(!i)return;var s;if(this.options.greedy){var o=this.element.parents(":data(droppable):eq(0)");if(o.length){s=e.data(o[0],"droppable");s.greedyChild=i=="isover"?1:0}}if(s&&i=="isover"){s["isover"]=0;s["isout"]=1;s._out.call(s,n)}this[i]=1;this[i=="isout"?"isover":"isout"]=0;this[i=="isover"?"_over":"_out"].call(this,n);if(s&&i=="isout"){s["isout"]=0;s["isover"]=1;s._over.call(s,n)}})}}})(jqcc);(function(e){e.widget("ui.resizable",e.extend({},e.ui.mouse,{_init:function(){var t=this,n=this.options;this.element.addClass("ui-resizable");e.extend(this,{_aspectRatio:!!n.aspectRatio,aspectRatio:n.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:n.helper||n.ghost||n.animate?n.helper||"ui-resizable-helper":null});if(this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)){if(/relative/.test(this.element.css("position"))&&e.browser.opera)this.element.css({position:"relative",top:"auto",left:"auto"});this.element.wrap(e('<div class="ui-wrapper" style="overflow: hidden;"></div>').css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")}));this.element=this.element.parent().data("resizable",this.element.data("resizable"));this.elementIsWrapper=true;this.element.css({marginLeft:this.originalElement.css("marginLeft"),marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom")});this.originalElement.css({marginLeft:0,marginTop:0,marginRight:0,marginBottom:0});this.originalResizeStyle=this.originalElement.css("resize");this.originalElement.css("resize","none");this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"}));this.originalElement.css({margin:this.originalElement.css("margin")});this._proportionallyResize()}this.handles=n.handles||(!e(".ui-resizable-handle",this.element).length?"e,s,se":{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"});if(this.handles.constructor==String){if(this.handles=="all")this.handles="n,e,s,w,se,sw,ne,nw";var r=this.handles.split(",");this.handles={};for(var i=0;i<r.length;i++){var s=e.trim(r[i]),o="ui-resizable-"+s;var u=e('<div class="ui-resizable-handle '+o+'"></div>');if(/sw|se|ne|nw/.test(s))u.css({zIndex:++n.zIndex});if("se"==s){u.addClass("ui-icon ui-icon-gripsmall-diagonal-se")}this.handles[s]=".ui-resizable-"+s;this.element.append(u)}}this._renderAxis=function(t){t=t||this.element;for(var n in this.handles){if(this.handles[n].constructor==String)this.handles[n]=e(this.handles[n],this.element).show();if(this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)){var r=e(this.handles[n],this.element),i=0;i=/sw|ne|nw|se|n|s/.test(n)?r.outerHeight():r.outerWidth();var s=["padding",/ne|nw|n/.test(n)?"Top":/se|sw|s/.test(n)?"Bottom":/^e$/.test(n)?"Right":"Left"].join("");t.css(s,i);this._proportionallyResize()}if(!e(this.handles[n]).length)continue}};this._renderAxis(this.element);this._handles=e(".ui-resizable-handle",this.element).disableSelection();this._handles.mouseover(function(){if(!t.resizing){if(this.className)var e=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i);t.axis=e&&e[1]?e[1]:"se"}});if(n.autoHide){this._handles.hide();e(this.element).addClass("ui-resizable-autohide").hover(function(){e(this).removeClass("ui-resizable-autohide");t._handles.show()},function(){if(!t.resizing){e(this).addClass("ui-resizable-autohide");t._handles.hide()}})}this._mouseInit()},destroy:function(){this._mouseDestroy();var t=function(t){e(t).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").unbind(".resizable").find(".ui-resizable-handle").remove()};if(this.elementIsWrapper){t(this.element);var n=this.element;n.parent().append(this.originalElement.css({position:n.css("position"),width:n.outerWidth(),height:n.outerHeight(),top:n.css("top"),left:n.css("left")})).end().remove()}this.originalElement.css("resize",this.originalResizeStyle);t(this.originalElement)},_mouseCapture:function(t){var n=false;for(var r in this.handles){if(e(this.handles[r])[0]==t.target)n=true}return this.options.disabled||!!n},_mouseStart:function(n){var r=this.options,i=this.element.position(),s=this.element;this.resizing=true;this.documentScroll={top:e(document).scrollTop(),left:e(document).scrollLeft()};if(s.is(".ui-draggable")||/absolute/.test(s.css("position"))){s.css({position:"absolute",top:i.top,left:i.left})}if(e.browser.opera&&/relative/.test(s.css("position")))s.css({position:"relative",top:"auto",left:"auto"});this._renderProxy();var o=t(this.helper.css("left")),u=t(this.helper.css("top"));if(r.containment){o+=e(r.containment).scrollLeft()||0;u+=e(r.containment).scrollTop()||0}this.offset=this.helper.offset();this.position={left:o,top:u};this.size=this._helper?{width:s.outerWidth(),height:s.outerHeight()}:{width:s.width(),height:s.height()};this.originalSize=this._helper?{width:s.outerWidth(),height:s.outerHeight()}:{width:s.width(),height:s.height()};this.originalPosition={left:o,top:u};this.sizeDiff={width:s.outerWidth()-s.width(),height:s.outerHeight()-s.height()};this.originalMousePosition={left:n.pageX,top:n.pageY};this.aspectRatio=typeof r.aspectRatio=="number"?r.aspectRatio:this.originalSize.width/this.originalSize.height||1;var a=e(".ui-resizable-"+this.axis).css("cursor");e("body").css("cursor",a=="auto"?this.axis+"-resize":a);s.addClass("ui-resizable-resizing");this._propagate("start",n);return true},_mouseDrag:function(t){var n=this.helper,r=this.options,i={},s=this,o=this.originalMousePosition,u=this.axis;var a=t.pageX-o.left||0,f=t.pageY-o.top||0;var l=this._change[u];if(!l)return false;var c=l.apply(this,[t,a,f]),h=e.browser.msie&&e.browser.version<7,p=this.sizeDiff;if(this._aspectRatio||t.shiftKey)c=this._updateRatio(c,t);c=this._respectSize(c,t);this._propagate("resize",t);n.css({top:this.position.top+"px",left:this.position.left+"px",width:this.size.width+"px",height:this.size.height+"px"});if(!this._helper&&this._proportionallyResizeElements.length)this._proportionallyResize();this._updateCache(c);this._trigger("resize",t,this.ui());return false},_mouseStop:function(t){this.resizing=false;var n=this.options,r=this;if(this._helper){var i=this._proportionallyResizeElements,s=i.length&&/textarea/i.test(i[0].nodeName),o=s&&e.ui.hasScroll(i[0],"left")?0:r.sizeDiff.height,u=s?0:r.sizeDiff.width;var a={width:r.size.width-u,height:r.size.height-o},f=parseInt(r.element.css("left"),10)+(r.position.left-r.originalPosition.left)||null,l=parseInt(r.element.css("top"),10)+(r.position.top-r.originalPosition.top)||null;if(!n.animate)this.element.css(e.extend(a,{top:l,left:f}));r.helper.height(r.size.height);r.helper.width(r.size.width);if(this._helper&&!n.animate)this._proportionallyResize()}e("body").css("cursor","auto");this.element.removeClass("ui-resizable-resizing");this._propagate("stop",t);if(this._helper)this.helper.remove();return false},_updateCache:function(e){var t=this.options;this.offset=this.helper.offset();if(n(e.left))this.position.left=e.left;if(n(e.top))this.position.top=e.top;if(n(e.height))this.size.height=e.height;if(n(e.width))this.size.width=e.width},_updateRatio:function(e,t){var n=this.options,r=this.position,i=this.size,s=this.axis;if(e.height)e.width=i.height*this.aspectRatio;else if(e.width)e.height=i.width/this.aspectRatio;if(s=="sw"){e.left=r.left+(i.width-e.width);e.top=null}if(s=="nw"){e.top=r.top+(i.height-e.height);e.left=r.left+(i.width-e.width)}return e},_respectSize:function(e,t){var r=this.helper,i=this.options,s=this._aspectRatio||t.shiftKey,o=this.axis,u=n(e.width)&&i.maxWidth&&i.maxWidth<e.width,a=n(e.height)&&i.maxHeight&&i.maxHeight<e.height,f=n(e.width)&&i.minWidth&&i.minWidth>e.width,l=n(e.height)&&i.minHeight&&i.minHeight>e.height;if(f)e.width=i.minWidth;if(l)e.height=i.minHeight;if(u)e.width=i.maxWidth;if(a)e.height=i.maxHeight;var c=this.originalPosition.left+this.originalSize.width,h=this.position.top+this.size.height;var p=/sw|nw|w/.test(o),d=/nw|ne|n/.test(o);if(f&&p)e.left=c-i.minWidth;if(u&&p)e.left=c-i.maxWidth;if(l&&d)e.top=h-i.minHeight;if(a&&d)e.top=h-i.maxHeight;var v=!e.width&&!e.height;if(v&&!e.left&&e.top)e.top=null;else if(v&&!e.top&&e.left)e.left=null;return e},_proportionallyResize:function(){var t=this.options;if(!this._proportionallyResizeElements.length)return;var n=this.helper||this.element;for(var r=0;r<this._proportionallyResizeElements.length;r++){var i=this._proportionallyResizeElements[r];if(!this.borderDif){var s=[i.css("borderTopWidth"),i.css("borderRightWidth"),i.css("borderBottomWidth"),i.css("borderLeftWidth")],o=[i.css("paddingTop"),i.css("paddingRight"),i.css("paddingBottom"),i.css("paddingLeft")];this.borderDif=e.map(s,function(e,t){var n=parseInt(e,10)||0,r=parseInt(o[t],10)||0;return n+r})}if(e.browser.msie&&!!(e(n).is(":hidden")||e(n).parents(":hidden").length))continue;i.css({height:n.height()-this.borderDif[0]-this.borderDif[2]||0,width:n.width()-this.borderDif[1]-this.borderDif[3]||0})}},_renderProxy:function(){var t=this.element,n=this.options;this.elementOffset=t.offset();if(this._helper){this.helper=this.helper||e('<div style="overflow:hidden;"></div>');var r=e.browser.msie&&e.browser.version<7,i=r?1:0,s=r?2:-1;this.helper.addClass(this._helper).css({width:this.element.outerWidth()+s,height:this.element.outerHeight()+s,position:"absolute",left:this.elementOffset.left-i+"px",top:this.elementOffset.top-i+"px",zIndex:++n.zIndex});this.helper.appendTo("body").disableSelection()}else{this.helper=this.element}},_change:{e:function(e,t,n){return{width:this.originalSize.width+t}},w:function(e,t,n){var r=this.options,i=this.originalSize,s=this.originalPosition;return{left:s.left+t,width:i.width-t}},n:function(e,t,n){var r=this.options,i=this.originalSize,s=this.originalPosition;return{top:s.top+n,height:i.height-n}},s:function(e,t,n){return{height:this.originalSize.height+n}},se:function(t,n,r){return e.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[t,n,r]))},sw:function(t,n,r){return e.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[t,n,r]))},ne:function(t,n,r){return e.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[t,n,r]))},nw:function(t,n,r){return e.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[t,n,r]))}},_propagate:function(t,n){e.ui.plugin.call(this,t,[n,this.ui()]);t!="resize"&&this._trigger(t,n,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}));e.extend(e.ui.resizable,{version:"1.7.1",eventPrefix:"resize",defaults:{alsoResize:false,animate:false,animateDuration:"slow",animateEasing:"swing",aspectRatio:false,autoHide:false,cancel:":input,option",containment:false,delay:0,distance:1,ghost:false,grid:false,handles:"e,s,se",helper:false,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:1e3}});e.ui.plugin.add("resizable","alsoResize",{start:function(t,n){var r=e(this).data("resizable"),i=r.options;_store=function(t){e(t).each(function(){e(this).data("resizable-alsoresize",{width:parseInt(e(this).width(),10),height:parseInt(e(this).height(),10),left:parseInt(e(this).css("left"),10),top:parseInt(e(this).css("top"),10)})})};if(typeof i.alsoResize=="object"&&!i.alsoResize.parentNode){if(i.alsoResize.length){i.alsoResize=i.alsoResize[0];_store(i.alsoResize)}else{e.each(i.alsoResize,function(e,t){_store(e)})}}else{_store(i.alsoResize)}},resize:function(t,n){var r=e(this).data("resizable"),i=r.options,s=r.originalSize,o=r.originalPosition;var u={height:r.size.height-s.height||0,width:r.size.width-s.width||0,top:r.position.top-o.top||0,left:r.position.left-o.left||0},a=function(t,n){e(t).each(function(){var t=e(this),i=e(this).data("resizable-alsoresize"),s={},o=n&&n.length?n:["width","height","top","left"];e.each(o||["width","height","top","left"],function(e,t){var n=(i[t]||0)+(u[t]||0);if(n&&n>=0)s[t]=n||null});if(/relative/.test(t.css("position"))&&e.browser.opera){r._revertToRelativePosition=true;t.css({position:"absolute",top:"auto",left:"auto"})}t.css(s)})};if(typeof i.alsoResize=="object"&&!i.alsoResize.nodeType){e.each(i.alsoResize,function(e,t){a(e,t)})}else{a(i.alsoResize)}},stop:function(t,n){var r=e(this).data("resizable");if(r._revertToRelativePosition&&e.browser.opera){r._revertToRelativePosition=false;el.css({position:"relative"})}e(this).removeData("resizable-alsoresize-start")}});e.ui.plugin.add("resizable","animate",{stop:function(t,n){var r=e(this).data("resizable"),i=r.options;var s=r._proportionallyResizeElements,o=s.length&&/textarea/i.test(s[0].nodeName),u=o&&e.ui.hasScroll(s[0],"left")?0:r.sizeDiff.height,a=o?0:r.sizeDiff.width;var f={width:r.size.width-a,height:r.size.height-u},l=parseInt(r.element.css("left"),10)+(r.position.left-r.originalPosition.left)||null,c=parseInt(r.element.css("top"),10)+(r.position.top-r.originalPosition.top)||null;r.element.animate(e.extend(f,c&&l?{top:c,left:l}:{}),{duration:i.animateDuration,easing:i.animateEasing,step:function(){var n={width:parseInt(r.element.css("width"),10),height:parseInt(r.element.css("height"),10),top:parseInt(r.element.css("top"),10),left:parseInt(r.element.css("left"),10)};if(s&&s.length)e(s[0]).css({width:n.width,height:n.height});r._updateCache(n);r._propagate("resize",t)}})}});e.ui.plugin.add("resizable","containment",{start:function(n,r){var i=e(this).data("resizable"),s=i.options,o=i.element;var u=s.containment,a=u instanceof e?u.get(0):/parent/.test(u)?o.parent().get(0):u;if(!a)return;i.containerElement=e(a);if(/document/.test(u)||u==document){i.containerOffset={left:0,top:0};i.containerPosition={left:0,top:0};i.parentData={element:e(document),left:0,top:0,width:e(document).width(),height:e(document).height()||document.body.parentNode.scrollHeight}}else{var f=e(a),l=[];e(["Top","Right","Left","Bottom"]).each(function(e,n){l[e]=t(f.css("padding"+n))});i.containerOffset=f.offset();i.containerPosition=f.position();i.containerSize={height:f.innerHeight()-l[3],width:f.innerWidth()-l[1]};var c=i.containerOffset,h=i.containerSize.height,p=i.containerSize.width,d=e.ui.hasScroll(a,"left")?a.scrollWidth:p,v=e.ui.hasScroll(a)?a.scrollHeight:h;i.parentData={element:a,left:c.left,top:c.top,width:d,height:v}}},resize:function(t,n){var r=e(this).data("resizable"),i=r.options,s=r.containerSize,o=r.containerOffset,u=r.size,a=r.position,f=r._aspectRatio||t.shiftKey,l={top:0,left:0},c=r.containerElement;if(c[0]!=document&&/static/.test(c.css("position")))l=o;if(a.left<(r._helper?o.left:0)){r.size.width=r.size.width+(r._helper?r.position.left-o.left:r.position.left-l.left);if(f)r.size.height=r.size.width/i.aspectRatio;r.position.left=i.helper?o.left:0}if(a.top<(r._helper?o.top:0)){r.size.height=r.size.height+(r._helper?r.position.top-o.top:r.position.top);if(f)r.size.width=r.size.height*i.aspectRatio;r.position.top=r._helper?o.top:0}r.offset.left=r.parentData.left+r.position.left;r.offset.top=r.parentData.top+r.position.top;var h=Math.abs((r._helper?r.offset.left-l.left:r.offset.left-l.left)+r.sizeDiff.width),p=Math.abs((r._helper?r.offset.top-l.top:r.offset.top-o.top)+r.sizeDiff.height);var d=r.containerElement.get(0)==r.element.parent().get(0),v=/relative|absolute/.test(r.containerElement.css("position"));if(d&&v)h-=r.parentData.left;if(h+r.size.width>=r.parentData.width){r.size.width=r.parentData.width-h;if(f)r.size.height=r.size.width/r.aspectRatio}if(p+r.size.height>=r.parentData.height){r.size.height=r.parentData.height-p;if(f)r.size.width=r.size.height*r.aspectRatio}},stop:function(t,n){var r=e(this).data("resizable"),i=r.options,s=r.position,o=r.containerOffset,u=r.containerPosition,a=r.containerElement;var f=e(r.helper),l=f.offset(),c=f.outerWidth()-r.sizeDiff.width,h=f.outerHeight()-r.sizeDiff.height;if(r._helper&&!i.animate&&/relative/.test(a.css("position")))e(this).css({left:l.left-u.left-o.left,width:c,height:h});if(r._helper&&!i.animate&&/static/.test(a.css("position")))e(this).css({left:l.left-u.left-o.left,width:c,height:h})}});e.ui.plugin.add("resizable","ghost",{start:function(t,n){var r=e(this).data("resizable"),i=r.options,s=r.size;r.ghost=r.originalElement.clone();r.ghost.css({opacity:.25,display:"block",position:"relative",height:s.height,width:s.width,margin:0,left:0,top:0}).addClass("ui-resizable-ghost").addClass(typeof i.ghost=="string"?i.ghost:"");r.ghost.appendTo(r.helper)},resize:function(t,n){var r=e(this).data("resizable"),i=r.options;if(r.ghost)r.ghost.css({position:"relative",height:r.size.height,width:r.size.width})},stop:function(t,n){var r=e(this).data("resizable"),i=r.options;if(r.ghost&&r.helper)r.helper.get(0).removeChild(r.ghost.get(0))}});e.ui.plugin.add("resizable","grid",{resize:function(t,n){var r=e(this).data("resizable"),i=r.options,s=r.size,o=r.originalSize,u=r.originalPosition,a=r.axis,f=i._aspectRatio||t.shiftKey;i.grid=typeof i.grid=="number"?[i.grid,i.grid]:i.grid;var l=Math.round((s.width-o.width)/(i.grid[0]||1))*(i.grid[0]||1),c=Math.round((s.height-o.height)/(i.grid[1]||1))*(i.grid[1]||1);if(/^(se|s|e)$/.test(a)){r.size.width=o.width+l;r.size.height=o.height+c}else if(/^(ne)$/.test(a)){r.size.width=o.width+l;r.size.height=o.height+c;r.position.top=u.top-c}else if(/^(sw)$/.test(a)){r.size.width=o.width+l;r.size.height=o.height+c;r.position.left=u.left-l}else{r.size.width=o.width+l;r.size.height=o.height+c;r.position.top=u.top-c;r.position.left=u.left-l}}});var t=function(e){return parseInt(e,10)||0};var n=function(e){return!isNaN(parseInt(e,10))}})(jqcc);(function(e){e.widget("ui.selectable",e.extend({},e.ui.mouse,{_init:function(){var t=this;this.element.addClass("ui-selectable");this.dragged=false;var n;this.refresh=function(){n=e(t.options.filter,t.element[0]);n.each(function(){var t=e(this);var n=t.offset();e.data(this,"selectable-item",{element:this,$element:t,left:n.left,top:n.top,right:n.left+t.outerWidth(),bottom:n.top+t.outerHeight(),startselected:false,selected:t.hasClass("ui-selected"),selecting:t.hasClass("ui-selecting"),unselecting:t.hasClass("ui-unselecting")})})};this.refresh();this.selectees=n.addClass("ui-selectee");this._mouseInit();this.helper=e(document.createElement("div")).css({border:"1px dotted black"}).addClass("ui-selectable-helper")},destroy:function(){this.element.removeClass("ui-selectable ui-selectable-disabled").removeData("selectable").unbind(".selectable");this._mouseDestroy()},_mouseStart:function(t){var n=this;this.opos=[t.pageX,t.pageY];if(this.options.disabled)return;var r=this.options;this.selectees=e(r.filter,this.element[0]);this._trigger("start",t);e(r.appendTo).append(this.helper);this.helper.css({"z-index":100,position:"absolute",left:t.clientX,top:t.clientY,width:0,height:0});if(r.autoRefresh){this.refresh()}this.selectees.filter(".ui-selected").each(function(){var r=e.data(this,"selectable-item");r.startselected=true;if(!t.metaKey){r.$element.removeClass("ui-selected");r.selected=false;r.$element.addClass("ui-unselecting");r.unselecting=true;n._trigger("unselecting",t,{unselecting:r.element})}});e(t.target).parents().andSelf().each(function(){var r=e.data(this,"selectable-item");if(r){r.$element.removeClass("ui-unselecting").addClass("ui-selecting");r.unselecting=false;r.selecting=true;r.selected=true;n._trigger("selecting",t,{selecting:r.element});return false}})},_mouseDrag:function(t){var n=this;this.dragged=true;if(this.options.disabled)return;var r=this.options;var i=this.opos[0],s=this.opos[1],o=t.pageX,u=t.pageY;if(i>o){var a=o;o=i;i=a}if(s>u){var a=u;u=s;s=a}this.helper.css({left:i,top:s,width:o-i,height:u-s});this.selectees.each(function(){var a=e.data(this,"selectable-item");if(!a||a.element==n.element[0])return;var f=false;if(r.tolerance=="touch"){f=!(a.left>o||a.right<i||a.top>u||a.bottom<s)}else if(r.tolerance=="fit"){f=a.left>i&&a.right<o&&a.top>s&&a.bottom<u}if(f){if(a.selected){a.$element.removeClass("ui-selected");a.selected=false}if(a.unselecting){a.$element.removeClass("ui-unselecting");a.unselecting=false}if(!a.selecting){a.$element.addClass("ui-selecting");a.selecting=true;n._trigger("selecting",t,{selecting:a.element})}}else{if(a.selecting){if(t.metaKey&&a.startselected){a.$element.removeClass("ui-selecting");a.selecting=false;a.$element.addClass("ui-selected");a.selected=true}else{a.$element.removeClass("ui-selecting");a.selecting=false;if(a.startselected){a.$element.addClass("ui-unselecting");a.unselecting=true}n._trigger("unselecting",t,{unselecting:a.element})}}if(a.selected){if(!t.metaKey&&!a.startselected){a.$element.removeClass("ui-selected");a.selected=false;a.$element.addClass("ui-unselecting");a.unselecting=true;n._trigger("unselecting",t,{unselecting:a.element})}}}});return false},_mouseStop:function(t){var n=this;this.dragged=false;var r=this.options;e(".ui-unselecting",this.element[0]).each(function(){var r=e.data(this,"selectable-item");r.$element.removeClass("ui-unselecting");r.unselecting=false;r.startselected=false;n._trigger("unselected",t,{unselected:r.element})});e(".ui-selecting",this.element[0]).each(function(){var r=e.data(this,"selectable-item");r.$element.removeClass("ui-selecting").addClass("ui-selected");r.selecting=false;r.selected=true;r.startselected=true;n._trigger("selected",t,{selected:r.element})});this._trigger("stop",t);this.helper.remove();return false}}));e.extend(e.ui.selectable,{version:"1.7.1",defaults:{appendTo:"body",autoRefresh:true,cancel:":input,option",delay:0,distance:0,filter:"*",tolerance:"touch"}})})(jqcc);(function(e){e.widget("ui.sortable",e.extend({},e.ui.mouse,{_init:function(){var e=this.options;this.containerCache={};this.element.addClass("ui-sortable");this.refresh();this.floating=this.items.length?/left|right/.test(this.items[0].item.css("float")):false;this.offset=this.element.offset();this._mouseInit()},destroy:function(){this.element.removeClass("ui-sortable ui-sortable-disabled").removeData("sortable").unbind(".sortable");this._mouseDestroy();for(var e=this.items.length-1;e>=0;e--)this.items[e].item.removeData("sortable-item")},_mouseCapture:function(t,n){if(this.reverting){return false}if(this.options.disabled||this.options.type=="static")return false;this._refreshItems(t);var r=null,i=this,s=e(t.target).parents().each(function(){if(e.data(this,"sortable-item")==i){r=e(this);return false}});if(e.data(t.target,"sortable-item")==i)r=e(t.target);if(!r)return false;if(this.options.handle&&!n){var o=false;e(this.options.handle,r).find("*").andSelf().each(function(){if(this==t.target)o=true});if(!o)return false}this.currentItem=r;this._removeCurrentsFromItems();return true},_mouseStart:function(t,n,r){var i=this.options,s=this;this.currentContainer=this;this.refreshPositions();this.helper=this._createHelper(t);this._cacheHelperProportions();this._cacheMargins();this.scrollParent=this.helper.scrollParent();this.offset=this.currentItem.offset();this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left};this.helper.css("position","absolute");this.cssPosition=this.helper.css("position");e.extend(this.offset,{click:{left:t.pageX-this.offset.left,top:t.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()});this.originalPosition=this._generatePosition(t);this.originalPageX=t.pageX;this.originalPageY=t.pageY;if(i.cursorAt)this._adjustOffsetFromHelper(i.cursorAt);this.domPosition={prev:this.currentItem.prev()[0],parent:this.currentItem.parent()[0]};if(this.helper[0]!=this.currentItem[0]){this.currentItem.hide()}this._createPlaceholder();if(i.containment)this._setContainment();if(i.cursor){if(e("body").css("cursor"))this._storedCursor=e("body").css("cursor");e("body").css("cursor",i.cursor)}if(i.opacity){if(this.helper.css("opacity"))this._storedOpacity=this.helper.css("opacity");this.helper.css("opacity",i.opacity)}if(i.zIndex){if(this.helper.css("zIndex"))this._storedZIndex=this.helper.css("zIndex");this.helper.css("zIndex",i.zIndex)}if(this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML")this.overflowOffset=this.scrollParent.offset();this._trigger("start",t,this._uiHash());if(!this._preserveHelperProportions)this._cacheHelperProportions();if(!r){for(var o=this.containers.length-1;o>=0;o--){this.containers[o]._trigger("activate",t,s._uiHash(this))}}if(e.ui.ddmanager)e.ui.ddmanager.current=this;if(e.ui.ddmanager&&!i.dropBehaviour)e.ui.ddmanager.prepareOffsets(this,t);this.dragging=true;this.helper.addClass("ui-sortable-helper");this._mouseDrag(t);return true},_mouseDrag:function(t){this.position=this._generatePosition(t);this.positionAbs=this._convertPositionTo("absolute");if(!this.lastPositionAbs){this.lastPositionAbs=this.positionAbs}if(this.options.scroll){var n=this.options,r=false;if(this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML"){if(this.overflowOffset.top+this.scrollParent[0].offsetHeight-t.pageY<n.scrollSensitivity)this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop+n.scrollSpeed;else if(t.pageY-this.overflowOffset.top<n.scrollSensitivity)this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop-n.scrollSpeed;if(this.overflowOffset.left+this.scrollParent[0].offsetWidth-t.pageX<n.scrollSensitivity)this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft+n.scrollSpeed;else if(t.pageX-this.overflowOffset.left<n.scrollSensitivity)this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft-n.scrollSpeed}else{if(t.pageY-e(document).scrollTop()<n.scrollSensitivity)r=e(document).scrollTop(e(document).scrollTop()-n.scrollSpeed);else if(e(window).height()-(t.pageY-e(document).scrollTop())<n.scrollSensitivity)r=e(document).scrollTop(e(document).scrollTop()+n.scrollSpeed);if(t.pageX-e(document).scrollLeft()<n.scrollSensitivity)r=e(document).scrollLeft(e(document).scrollLeft()-n.scrollSpeed);else if(e(window).width()-(t.pageX-e(document).scrollLeft())<n.scrollSensitivity)r=e(document).scrollLeft(e(document).scrollLeft()+n.scrollSpeed)}if(r!==false&&e.ui.ddmanager&&!n.dropBehaviour)e.ui.ddmanager.prepareOffsets(this,t)}this.positionAbs=this._convertPositionTo("absolute");if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";for(var i=this.items.length-1;i>=0;i--){var s=this.items[i],o=s.item[0],u=this._intersectsWithPointer(s);if(!u)continue;if(o!=this.currentItem[0]&&this.placeholder[u==1?"next":"prev"]()[0]!=o&&!e.ui.contains(this.placeholder[0],o)&&(this.options.type=="semi-dynamic"?!e.ui.contains(this.element[0],o):true)){this.direction=u==1?"down":"up";if(this.options.tolerance=="pointer"||this._intersectsWithSides(s)){this._rearrange(t,s)}else{break}this._trigger("change",t,this._uiHash());break}}this._contactContainers(t);if(e.ui.ddmanager)e.ui.ddmanager.drag(this,t);this._trigger("sort",t,this._uiHash());this.lastPositionAbs=this.positionAbs;return false},_mouseStop:function(t,n){if(!t)return;if(e.ui.ddmanager&&!this.options.dropBehaviour)e.ui.ddmanager.drop(this,t);if(this.options.revert){var r=this;var i=r.placeholder.offset();r.reverting=true;e(this.helper).animate({left:i.left-this.offset.parent.left-r.margins.left+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollLeft),top:i.top-this.offset.parent.top-r.margins.top+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollTop)},parseInt(this.options.revert,10)||500,function(){r._clear(t)})}else{this._clear(t,n)}return false},cancel:function(){var t=this;if(this.dragging){this._mouseUp();if(this.options.helper=="original")this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper");else this.currentItem.show();for(var n=this.containers.length-1;n>=0;n--){this.containers[n]._trigger("deactivate",null,t._uiHash(this));if(this.containers[n].containerCache.over){this.containers[n]._trigger("out",null,t._uiHash(this));this.containers[n].containerCache.over=0}}}if(this.placeholder[0].parentNode)this.placeholder[0].parentNode.removeChild(this.placeholder[0]);if(this.options.helper!="original"&&this.helper&&this.helper[0].parentNode)this.helper.remove();e.extend(this,{helper:null,dragging:false,reverting:false,_noFinalSort:null});if(this.domPosition.prev){e(this.domPosition.prev).after(this.currentItem)}else{e(this.domPosition.parent).prepend(this.currentItem)}return true},serialize:function(t){var n=this._getItemsAsjqcc(t&&t.connected);var r=[];t=t||{};e(n).each(function(){var n=(e(t.item||this).attr(t.attribute||"id")||"").match(t.expression||/(.+)[-=_](.+)/);if(n)r.push((t.key||n[1]+"[]")+"="+(t.key&&t.expression?n[1]:n[2]))});return r.join("&")},toArray:function(t){var n=this._getItemsAsjqcc(t&&t.connected);var r=[];t=t||{};n.each(function(){r.push(e(t.item||this).attr(t.attribute||"id")||"")});return r},_intersectsWith:function(e){var t=this.positionAbs.left,n=t+this.helperProportions.width,r=this.positionAbs.top,i=r+this.helperProportions.height;var s=e.left,o=s+e.width,u=e.top,a=u+e.height;var f=this.offset.click.top,l=this.offset.click.left;var c=r+f>u&&r+f<a&&t+l>s&&t+l<o;if(this.options.tolerance=="pointer"||this.options.forcePointerForContainers||this.options.tolerance!="pointer"&&this.helperProportions[this.floating?"width":"height"]>e[this.floating?"width":"height"]){return c}else{return s<t+this.helperProportions.width/2&&n-this.helperProportions.width/2<o&&u<r+this.helperProportions.height/2&&i-this.helperProportions.height/2<a}},_intersectsWithPointer:function(t){var n=e.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,t.top,t.height),r=e.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,t.left,t.width),i=n&&r,s=this._getDragVerticalDirection(),o=this._getDragHorizontalDirection();if(!i)return false;return this.floating?o&&o=="right"||s=="down"?2:1:s&&(s=="down"?2:1)},_intersectsWithSides:function(t){var n=e.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,t.top+t.height/2,t.height),r=e.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,t.left+t.width/2,t.width),i=this._getDragVerticalDirection(),s=this._getDragHorizontalDirection();if(this.floating&&s){return s=="right"&&r||s=="left"&&!r}else{return i&&(i=="down"&&n||i=="up"&&!n)}},_getDragVerticalDirection:function(){var e=this.positionAbs.top-this.lastPositionAbs.top;return e!=0&&(e>0?"down":"up")},_getDragHorizontalDirection:function(){var e=this.positionAbs.left-this.lastPositionAbs.left;return e!=0&&(e>0?"right":"left")},refresh:function(e){this._refreshItems(e);this.refreshPositions()},_connectWith:function(){var e=this.options;return e.connectWith.constructor==String?[e.connectWith]:e.connectWith},_getItemsAsjqcc:function(t){var n=this;var r=[];var i=[];var s=this._connectWith();if(s&&t){for(var o=s.length-1;o>=0;o--){var u=e(s[o]);for(var a=u.length-1;a>=0;a--){var f=e.data(u[a],"sortable");if(f&&f!=this&&!f.options.disabled){i.push([e.isFunction(f.options.items)?f.options.items.call(f.element):e(f.options.items,f.element).not(".ui-sortable-helper"),f])}}}}i.push([e.isFunction(this.options.items)?this.options.items.call(this.element,null,{options:this.options,item:this.currentItem}):e(this.options.items,this.element).not(".ui-sortable-helper"),this]);for(var o=i.length-1;o>=0;o--){i[o][0].each(function(){r.push(this)})}return e(r)},_removeCurrentsFromItems:function(){var e=this.currentItem.find(":data(sortable-item)");for(var t=0;t<this.items.length;t++){for(var n=0;n<e.length;n++){if(e[n]==this.items[t].item[0])this.items.splice(t,1)}}},_refreshItems:function(t){this.items=[];this.containers=[this];var n=this.items;var r=this;var i=[[e.isFunction(this.options.items)?this.options.items.call(this.element[0],t,{item:this.currentItem}):e(this.options.items,this.element),this]];var s=this._connectWith();if(s){for(var o=s.length-1;o>=0;o--){var u=e(s[o]);for(var a=u.length-1;a>=0;a--){var f=e.data(u[a],"sortable");if(f&&f!=this&&!f.options.disabled){i.push([e.isFunction(f.options.items)?f.options.items.call(f.element[0],t,{item:this.currentItem}):e(f.options.items,f.element),f]);this.containers.push(f)}}}}for(var o=i.length-1;o>=0;o--){var l=i[o][1];var c=i[o][0];for(var a=0,h=c.length;a<h;a++){var p=e(c[a]);p.data("sortable-item",l);n.push({item:p,instance:l,width:0,height:0,left:0,top:0})}}},refreshPositions:function(t){if(this.offsetParent&&this.helper){this.offset.parent=this._getParentOffset()}for(var n=this.items.length-1;n>=0;n--){var r=this.items[n];if(r.instance!=this.currentContainer&&this.currentContainer&&r.item[0]!=this.currentItem[0])continue;var i=this.options.toleranceElement?e(this.options.toleranceElement,r.item):r.item;if(!t){r.width=i.outerWidth();r.height=i.outerHeight()}var s=i.offset();r.left=s.left;r.top=s.top}if(this.options.custom&&this.options.custom.refreshContainers){this.options.custom.refreshContainers.call(this)}else{for(var n=this.containers.length-1;n>=0;n--){var s=this.containers[n].element.offset();this.containers[n].containerCache.left=s.left;this.containers[n].containerCache.top=s.top;this.containers[n].containerCache.width=this.containers[n].element.outerWidth();this.containers[n].containerCache.height=this.containers[n].element.outerHeight()}}},_createPlaceholder:function(t){var n=t||this,r=n.options;if(!r.placeholder||r.placeholder.constructor==String){var i=r.placeholder;r.placeholder={element:function(){var t=e(document.createElement(n.currentItem[0].nodeName)).addClass(i||n.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper")[0];if(!i)t.style.visibility="hidden";return t},update:function(e,t){if(i&&!r.forcePlaceholderSize)return;if(!t.height()){t.height(n.currentItem.innerHeight()-parseInt(n.currentItem.css("paddingTop")||0,10)-parseInt(n.currentItem.css("paddingBottom")||0,10))}if(!t.width()){t.width(n.currentItem.innerWidth()-parseInt(n.currentItem.css("paddingLeft")||0,10)-parseInt(n.currentItem.css("paddingRight")||0,10))}}}}n.placeholder=e(r.placeholder.element.call(n.element,n.currentItem));n.currentItem.after(n.placeholder);r.placeholder.update(n,n.placeholder)},_contactContainers:function(t){for(var n=this.containers.length-1;n>=0;n--){if(this._intersectsWith(this.containers[n].containerCache)){if(!this.containers[n].containerCache.over){if(this.currentContainer!=this.containers[n]){var r=1e4;var i=null;var s=this.positionAbs[this.containers[n].floating?"left":"top"];for(var o=this.items.length-1;o>=0;o--){if(!e.ui.contains(this.containers[n].element[0],this.items[o].item[0]))continue;var u=this.items[o][this.containers[n].floating?"left":"top"];if(Math.abs(u-s)<r){r=Math.abs(u-s);i=this.items[o]}}if(!i&&!this.options.dropOnEmpty)continue;this.currentContainer=this.containers[n];i?this._rearrange(t,i,null,true):this._rearrange(t,null,this.containers[n].element,true);this._trigger("change",t,this._uiHash());this.containers[n]._trigger("change",t,this._uiHash(this));this.options.placeholder.update(this.currentContainer,this.placeholder)}this.containers[n]._trigger("over",t,this._uiHash(this));this.containers[n].containerCache.over=1}}else{if(this.containers[n].containerCache.over){this.containers[n]._trigger("out",t,this._uiHash(this));this.containers[n].containerCache.over=0}}}},_createHelper:function(t){var n=this.options;var r=e.isFunction(n.helper)?e(n.helper.apply(this.element[0],[t,this.currentItem])):n.helper=="clone"?this.currentItem.clone():this.currentItem;if(!r.parents("body").length)e(n.appendTo!="parent"?n.appendTo:this.currentItem[0].parentNode)[0].appendChild(r[0]);if(r[0]==this.currentItem[0])this._storedCSS={width:this.currentItem[0].style.width,height:this.currentItem[0].style.height,position:this.currentItem.css("position"),top:this.currentItem.css("top"),left:this.currentItem.css("left")};if(r[0].style.width==""||n.forceHelperSize)r.width(this.currentItem.width());if(r[0].style.height==""||n.forceHelperSize)r.height(this.currentItem.height());return r},_adjustOffsetFromHelper:function(e){if(e.left!=undefined)this.offset.click.left=e.left+this.margins.left;if(e.right!=undefined)this.offset.click.left=this.helperProportions.width-e.right+this.margins.left;if(e.top!=undefined)this.offset.click.top=e.top+this.margins.top;if(e.bottom!=undefined)this.offset.click.top=this.helperProportions.height-e.bottom+this.margins.top},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var t=this.offsetParent.offset();if(this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&e.ui.contains(this.scrollParent[0],this.offsetParent[0])){t.left+=this.scrollParent.scrollLeft();t.top+=this.scrollParent.scrollTop()}if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&e.browser.msie)t={top:0,left:0};return{top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var e=this.currentItem.position();return{top:e.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:e.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}else{return{top:0,left:0}}},_cacheMargins:function(){this.margins={left:parseInt(this.currentItem.css("marginLeft"),10)||0,top:parseInt(this.currentItem.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t=this.options;if(t.containment=="parent")t.containment=this.helper[0].parentNode;if(t.containment=="document"||t.containment=="window")this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,e(t.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(e(t.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(t.containment)){var n=e(t.containment)[0];var r=e(t.containment).offset();var i=e(n).css("overflow")!="hidden";this.containment=[r.left+(parseInt(e(n).css("borderLeftWidth"),10)||0)+(parseInt(e(n).css("paddingLeft"),10)||0)-this.margins.left,r.top+(parseInt(e(n).css("borderTopWidth"),10)||0)+(parseInt(e(n).css("paddingTop"),10)||0)-this.margins.top,r.left+(i?Math.max(n.scrollWidth,n.offsetWidth):n.offsetWidth)-(parseInt(e(n).css("borderLeftWidth"),10)||0)-(parseInt(e(n).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,r.top+(i?Math.max(n.scrollHeight,n.offsetHeight):n.offsetHeight)-(parseInt(e(n).css("borderTopWidth"),10)||0)-(parseInt(e(n).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]}},_convertPositionTo:function(t,n){if(!n)n=this.position;var r=t=="absolute"?1:-1;var i=this.options,s=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&e.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,o=/(html|body)/i.test(s[0].tagName);return{top:n.top+this.offset.relative.top*r+this.offset.parent.top*r-(e.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():o?0:s.scrollTop())*r),left:n.left+this.offset.relative.left*r+this.offset.parent.left*r-(e.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():o?0:s.scrollLeft())*r)}},_generatePosition:function(t){var n=this.options,r=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&e.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,i=/(html|body)/i.test(r[0].tagName);if(this.cssPosition=="relative"&&!(this.scrollParent[0]!=document&&this.scrollParent[0]!=this.offsetParent[0])){this.offset.relative=this._getRelativeOffset()}var s=t.pageX;var o=t.pageY;if(this.originalPosition){if(this.containment){if(t.pageX-this.offset.click.left<this.containment[0])s=this.containment[0]+this.offset.click.left;if(t.pageY-this.offset.click.top<this.containment[1])o=this.containment[1]+this.offset.click.top;if(t.pageX-this.offset.click.left>this.containment[2])s=this.containment[2]+this.offset.click.left;if(t.pageY-this.offset.click.top>this.containment[3])o=this.containment[3]+this.offset.click.top}if(n.grid){var u=this.originalPageY+Math.round((o-this.originalPageY)/n.grid[1])*n.grid[1];o=this.containment?!(u-this.offset.click.top<this.containment[1]||u-this.offset.click.top>this.containment[3])?u:!(u-this.offset.click.top<this.containment[1])?u-n.grid[1]:u+n.grid[1]:u;var a=this.originalPageX+Math.round((s-this.originalPageX)/n.grid[0])*n.grid[0];s=this.containment?!(a-this.offset.click.left<this.containment[0]||a-this.offset.click.left>this.containment[2])?a:!(a-this.offset.click.left<this.containment[0])?a-n.grid[0]:a+n.grid[0]:a}}return{top:o-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(e.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():i?0:r.scrollTop()),left:s-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(e.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():i?0:r.scrollLeft())}},_rearrange:function(e,t,n,r){n?n[0].appendChild(this.placeholder[0]):t.item[0].parentNode.insertBefore(this.placeholder[0],this.direction=="down"?t.item[0]:t.item[0].nextSibling);this.counter=this.counter?++this.counter:1;var i=this,s=this.counter;window.setTimeout(function(){if(s==i.counter)i.refreshPositions(!r)},0)},_clear:function(t,n){this.reverting=false;var r=[],i=this;if(!this._noFinalSort&&this.currentItem[0].parentNode)this.placeholder.before(this.currentItem);this._noFinalSort=null;if(this.helper[0]==this.currentItem[0]){for(var s in this._storedCSS){if(this._storedCSS[s]=="auto"||this._storedCSS[s]=="static")this._storedCSS[s]=""}this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")}else{this.currentItem.show()}if(this.fromOutside&&!n)r.push(function(e){this._trigger("receive",e,this._uiHash(this.fromOutside))});if((this.fromOutside||this.domPosition.prev!=this.currentItem.prev().not(".ui-sortable-helper")[0]||this.domPosition.parent!=this.currentItem.parent()[0])&&!n)r.push(function(e){this._trigger("update",e,this._uiHash())});if(!e.ui.contains(this.element[0],this.currentItem[0])){if(!n)r.push(function(e){this._trigger("remove",e,this._uiHash())});for(var s=this.containers.length-1;s>=0;s--){if(e.ui.contains(this.containers[s].element[0],this.currentItem[0])&&!n){r.push(function(e){return function(t){e._trigger("receive",t,this._uiHash(this))}}.call(this,this.containers[s]));r.push(function(e){return function(t){e._trigger("update",t,this._uiHash(this))}}.call(this,this.containers[s]))}}}for(var s=this.containers.length-1;s>=0;s--){if(!n)r.push(function(e){return function(t){e._trigger("deactivate",t,this._uiHash(this))}}.call(this,this.containers[s]));if(this.containers[s].containerCache.over){r.push(function(e){return function(t){e._trigger("out",t,this._uiHash(this))}}.call(this,this.containers[s]));this.containers[s].containerCache.over=0}}if(this._storedCursor)e("body").css("cursor",this._storedCursor);if(this._storedOpacity)this.helper.css("opacity",this._storedOpacity);if(this._storedZIndex)this.helper.css("zIndex",this._storedZIndex=="auto"?"":this._storedZIndex);this.dragging=false;if(this.cancelHelperRemoval){if(!n){this._trigger("beforeStop",t,this._uiHash());for(var s=0;s<r.length;s++){r[s].call(this,t)}this._trigger("stop",t,this._uiHash())}return false}if(!n)this._trigger("beforeStop",t,this._uiHash());this.placeholder[0].parentNode.removeChild(this.placeholder[0]);if(this.helper[0]!=this.currentItem[0])this.helper.remove();this.helper=null;if(!n){for(var s=0;s<r.length;s++){r[s].call(this,t)}this._trigger("stop",t,this._uiHash())}this.fromOutside=false;return true},_trigger:function(){if(e.widget.prototype._trigger.apply(this,arguments)===false){this.cancel()}},_uiHash:function(t){var n=t||this;return{helper:n.helper,placeholder:n.placeholder||e([]),position:n.position,absolutePosition:n.positionAbs,offset:n.positionAbs,item:n.currentItem,sender:t?t.element:null}}}));e.extend(e.ui.sortable,{getter:"serialize toArray",version:"1.7.1",eventPrefix:"sort",defaults:{appendTo:"parent",axis:false,cancel:":input,option",connectWith:false,containment:false,cursor:"auto",cursorAt:false,delay:0,distance:1,dropOnEmpty:true,forcePlaceholderSize:false,forceHelperSize:false,grid:false,handle:false,helper:"original",items:"> *",opacity:false,placeholder:false,revert:false,scroll:true,scrollSensitivity:20,scrollSpeed:20,scope:"default",tolerance:"intersect",zIndex:1e3}})})(jqcc);jqcc.effects||function(e){function t(t,n){var r=t[1]&&t[1].constructor==Object?t[1]:{};if(n)r.mode=n;var i=t[1]&&t[1].constructor!=Object?t[1]:r.duration?r.duration:t[2];i=e.fx.off?0:typeof i==="number"?i:e.fx.speeds[i]||e.fx.speeds._default;var s=r.callback||e.isFunction(t[1])&&t[1]||e.isFunction(t[2])&&t[2]||e.isFunction(t[3])&&t[3];return[t[0],r,i,s]}function n(t){var n;if(t&&t.constructor==Array&&t.length==3)return t;if(n=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(t))return[parseInt(n[1],10),parseInt(n[2],10),parseInt(n[3],10)];if(n=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(t))return[parseFloat(n[1])*2.55,parseFloat(n[2])*2.55,parseFloat(n[3])*2.55];if(n=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(t))return[parseInt(n[1],16),parseInt(n[2],16),parseInt(n[3],16)];if(n=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(t))return[parseInt(n[1]+n[1],16),parseInt(n[2]+n[2],16),parseInt(n[3]+n[3],16)];if(n=/rgba\(0, 0, 0, 0\)/.exec(t))return i["transparent"];return i[e.trim(t).toLowerCase()]}function r(t,r){var i;do{i=e.curCSS(t,r);if(i!=""&&i!="transparent"||e.nodeName(t,"body"))break;r="backgroundColor"}while(t=t.parentNode);return n(i)}e.effects={version:"1.7.1",save:function(e,t){for(var n=0;n<t.length;n++){if(t[n]!==null)e.data("ec.storage."+t[n],e[0].style[t[n]])}},restore:function(e,t){for(var n=0;n<t.length;n++){if(t[n]!==null)e.css(t[n],e.data("ec.storage."+t[n]))}},setMode:function(e,t){if(t=="toggle")t=e.is(":hidden")?"show":"hide";return t},getBaseline:function(e,t){var n,r;switch(e[0]){case"top":n=0;break;case"middle":n=.5;break;case"bottom":n=1;break;default:n=e[0]/t.height}switch(e[1]){case"left":r=0;break;case"center":r=.5;break;case"right":r=1;break;default:r=e[1]/t.width}return{x:r,y:n}},createWrapper:function(e){if(e.parent().is(".ui-effects-wrapper"))return e.parent();var t={width:e.outerWidth(true),height:e.outerHeight(true),"float":e.css("float")};e.wrap('<div class="ui-effects-wrapper" style="font-size:100%;background:transparent;border:none;margin:0;padding:0"></div>');var n=e.parent();if(e.css("position")=="static"){n.css({position:"relative"});e.css({position:"relative"})}else{var r=e.css("top");if(isNaN(parseInt(r,10)))r="auto";var i=e.css("left");if(isNaN(parseInt(i,10)))i="auto";n.css({position:e.css("position"),top:r,left:i,zIndex:e.css("z-index")}).show();e.css({position:"relative",top:0,left:0})}n.css(t);return n},removeWrapper:function(e){if(e.parent().is(".ui-effects-wrapper"))return e.parent().replaceWith(e);return e},setTransition:function(t,n,r,i){i=i||{};e.each(n,function(e,n){unit=t.cssUnit(n);if(unit[0]>0)i[n]=unit[0]*r+unit[1]});return i},animateClass:function(t,n,r,i){var s=typeof r=="function"?r:i?i:null;var o=typeof r=="string"?r:null;return this.each(function(){var r={};var i=e(this);var u=i.attr("style")||"";if(typeof u=="object")u=u["cssText"];if(t.toggle){i.hasClass(t.toggle)?t.remove=t.toggle:t.add=t.toggle}var a=e.extend({},document.defaultView?document.defaultView.getComputedStyle(this,null):this.currentStyle);if(t.add)i.addClass(t.add);if(t.remove)i.removeClass(t.remove);var f=e.extend({},document.defaultView?document.defaultView.getComputedStyle(this,null):this.currentStyle);if(t.add)i.removeClass(t.add);if(t.remove)i.addClass(t.remove);for(var l in f){if(typeof f[l]!="function"&&f[l]&&l.indexOf("Moz")==-1&&l.indexOf("length")==-1&&f[l]!=a[l]&&(l.match(/color/i)||!l.match(/color/i)&&!isNaN(parseInt(f[l],10)))&&(a.position!="static"||a.position=="static"&&!l.match(/left|top|bottom|right/)))r[l]=f[l]}i.animate(r,n,o,function(){if(typeof e(this).attr("style")=="object"){e(this).attr("style")["cssText"]="";e(this).attr("style")["cssText"]=u}else e(this).attr("style",u);if(t.add)e(this).addClass(t.add);if(t.remove)e(this).removeClass(t.remove);if(s)s.apply(this,arguments)})})}};e.fn.extend({_show:e.fn.show,_hide:e.fn.hide,__toggle:e.fn.toggle,_addClass:e.fn.addClass,_removeClass:e.fn.removeClass,_toggleClass:e.fn.toggleClass,effect:function(t,n,r,i){return e.effects[t]?e.effects[t].call(this,{method:t,options:n||{},duration:r,callback:i}):null},show:function(){if(!arguments[0]||arguments[0].constructor==Number||/(slow|normal|fast)/.test(arguments[0]))return this._show.apply(this,arguments);else{return this.effect.apply(this,t(arguments,"show"))}},hide:function(){if(!arguments[0]||arguments[0].constructor==Number||/(slow|normal|fast)/.test(arguments[0]))return this._hide.apply(this,arguments);else{return this.effect.apply(this,t(arguments,"hide"))}},toggle:function(){if(!arguments[0]||arguments[0].constructor==Number||/(slow|normal|fast)/.test(arguments[0])||arguments[0].constructor==Function)return this.__toggle.apply(this,arguments);else{return this.effect.apply(this,t(arguments,"toggle"))}},addClass:function(t,n,r,i){return n?e.effects.animateClass.apply(this,[{add:t},n,r,i]):this._addClass(t)},removeClass:function(t,n,r,i){return n?e.effects.animateClass.apply(this,[{remove:t},n,r,i]):this._removeClass(t)},toggleClass:function(t,n,r,i){return typeof n!=="boolean"&&n?e.effects.animateClass.apply(this,[{toggle:t},n,r,i]):this._toggleClass(t,n)},morph:function(t,n,r,i,s){return e.effects.animateClass.apply(this,[{add:n,remove:t},r,i,s])},switchClass:function(){return this.morph.apply(this,arguments)},cssUnit:function(t){var n=this.css(t),r=[];e.each(["em","px","%","pt"],function(e,t){if(n.indexOf(t)>0)r=[parseFloat(n),t]});return r}});e.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(t,i){e.fx.step[i]=function(e){if(e.state==0){e.start=r(e.elem,i);e.end=n(e.end)}e.elem.style[i]="rgb("+[Math.max(Math.min(parseInt(e.pos*(e.end[0]-e.start[0])+e.start[0],10),255),0),Math.max(Math.min(parseInt(e.pos*(e.end[1]-e.start[1])+e.start[1],10),255),0),Math.max(Math.min(parseInt(e.pos*(e.end[2]-e.start[2])+e.start[2],10),255),0)].join(",")+")"}});var i={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]};e.easing.jswing=e.easing.swing;e.extend(e.easing,{def:"easeOutQuad",swing:function(t,n,r,i,s){return e.easing[e.easing.def](t,n,r,i,s)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(t,n,r,i,s){return i-e.easing.easeOutBounce(t,s-n,0,i,s)+r},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(t,n,r,i,s){if(n<s/2)return e.easing.easeInBounce(t,n*2,0,i,s)*.5+r;return e.easing.easeOutBounce(t,n*2-s,0,i,s)*.5+i*.5+r}})}(jqcc);(function(e){e.effects.blind=function(t){return this.queue(function(){var n=e(this),r=["position","top","left"];var i=e.effects.setMode(n,t.options.mode||"hide");var s=t.options.direction||"vertical";e.effects.save(n,r);n.show();var u=e.effects.createWrapper(n).css({overflow:"hidden"});var a=s=="vertical"?"height":"width";var f=s=="vertical"?u.height():u.width();if(i=="show")u.css(a,0);var l={};l[a]=i=="show"?f:0;u.animate(l,t.duration,t.options.easing,function(){if(i=="hide")n.hide();e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(n[0],arguments);n.dequeue()})})}})(jqcc);(function(e){e.effects.bounce=function(t){return this.queue(function(){var n=e(this),r=["position","top","left"];var i=e.effects.setMode(n,t.options.mode||"effect");var s=t.options.direction||"up";var u=t.options.distance||20;var a=t.options.times||5;var f=t.duration||250;if(/show|hide/.test(i))r.push("opacity");e.effects.save(n,r);n.show();e.effects.createWrapper(n);var l=s=="up"||s=="down"?"top":"left";var c=s=="up"||s=="left"?"pos":"neg";var u=t.options.distance||(l=="top"?n.outerHeight({margin:true})/3:n.outerWidth({margin:true})/3);if(i=="show")n.css("opacity",0).css(l,c=="pos"?-u:u);if(i=="hide")u=u/(a*2);if(i!="hide")a--;if(i=="show"){var h={opacity:1};h[l]=(c=="pos"?"+=":"-=")+u;n.animate(h,f/2,t.options.easing);u=u/2;a--}for(var p=0;p<a;p++){var d={},v={};d[l]=(c=="pos"?"-=":"+=")+u;v[l]=(c=="pos"?"+=":"-=")+u;n.animate(d,f/2,t.options.easing).animate(v,f/2,t.options.easing);u=i=="hide"?u*2:u/2}if(i=="hide"){var h={opacity:0};h[l]=(c=="pos"?"-=":"+=")+u;n.animate(h,f/2,t.options.easing,function(){n.hide();e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(this,arguments)})}else{var d={},v={};d[l]=(c=="pos"?"-=":"+=")+u;v[l]=(c=="pos"?"+=":"-=")+u;n.animate(d,f/2,t.options.easing).animate(v,f/2,t.options.easing,function(){e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(this,arguments)})}n.queue("fx",function(){n.dequeue()});n.dequeue()})}})(jqcc);(function(e){e.effects.clip=function(t){return this.queue(function(){var n=e(this),r=["position","top","left","height","width"];var i=e.effects.setMode(n,t.options.mode||"hide");var s=t.options.direction||"vertical";e.effects.save(n,r);n.show();var u=e.effects.createWrapper(n).css({overflow:"hidden"});var a=n[0].tagName=="IMG"?u:n;var f={size:s=="vertical"?"height":"width",position:s=="vertical"?"top":"left"};var l=s=="vertical"?a.height():a.width();if(i=="show"){a.css(f.size,0);a.css(f.position,l/2)}var c={};c[f.size]=i=="show"?l:0;c[f.position]=i=="show"?0:l/2;a.animate(c,{queue:false,duration:t.duration,easing:t.options.easing,complete:function(){if(i=="hide")n.hide();e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(n[0],arguments);n.dequeue()}})})}})(jqcc);(function(e){e.effects.drop=function(t){return this.queue(function(){var n=e(this),r=["position","top","left","opacity"];var i=e.effects.setMode(n,t.options.mode||"hide");var s=t.options.direction||"left";e.effects.save(n,r);n.show();e.effects.createWrapper(n);var u=s=="up"||s=="down"?"top":"left";var a=s=="up"||s=="left"?"pos":"neg";var f=t.options.distance||(u=="top"?n.outerHeight({margin:true})/2:n.outerWidth({margin:true})/2);if(i=="show")n.css("opacity",0).css(u,a=="pos"?-f:f);var l={opacity:i=="show"?1:0};l[u]=(i=="show"?a=="pos"?"+=":"-=":a=="pos"?"-=":"+=")+f;n.animate(l,{queue:false,duration:t.duration,easing:t.options.easing,complete:function(){if(i=="hide")n.hide();e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(this,arguments);n.dequeue()}})})}})(jqcc);(function(e){e.effects.explode=function(t){return this.queue(function(){var n=t.options.pieces?Math.round(Math.sqrt(t.options.pieces)):3;var r=t.options.pieces?Math.round(Math.sqrt(t.options.pieces)):3;t.options.mode=t.options.mode=="toggle"?e(this).is(":visible")?"hide":"show":t.options.mode;var i=e(this).show().css("visibility","hidden");var s=i.offset();s.top-=parseInt(i.css("marginTop"),10)||0;s.left-=parseInt(i.css("marginLeft"),10)||0;var u=i.outerWidth(true);var a=i.outerHeight(true);for(var f=0;f<n;f++){for(var l=0;l<r;l++){i.clone().appendTo("body").wrap("<div></div>").css({position:"absolute",visibility:"visible",left:-l*(u/r),top:-f*(a/n)}).parent().addClass("ui-effects-explode").css({position:"absolute",overflow:"hidden",width:u/r,height:a/n,left:s.left+l*(u/r)+(t.options.mode=="show"?(l-Math.floor(r/2))*(u/r):0),top:s.top+f*(a/n)+(t.options.mode=="show"?(f-Math.floor(n/2))*(a/n):0),opacity:t.options.mode=="show"?0:1}).animate({left:s.left+l*(u/r)+(t.options.mode=="show"?0:(l-Math.floor(r/2))*(u/r)),top:s.top+f*(a/n)+(t.options.mode=="show"?0:(f-Math.floor(n/2))*(a/n)),opacity:t.options.mode=="show"?1:0},t.duration||500)}}setTimeout(function(){t.options.mode=="show"?i.css({visibility:"visible"}):i.css({visibility:"visible"}).hide();if(t.callback)t.callback.apply(i[0]);i.dequeue();e("div.ui-effects-explode").remove()},t.duration||500)})}})(jqcc);(function(e){e.effects.fold=function(t){return this.queue(function(){var n=e(this),r=["position","top","left"];var i=e.effects.setMode(n,t.options.mode||"hide");var s=t.options.size||15;var u=!!t.options.horizFirst;var a=t.duration?t.duration/2:e.fx.speeds._default/2;e.effects.save(n,r);n.show();var f=e.effects.createWrapper(n).css({overflow:"hidden"});var l=i=="show"!=u;var c=l?["width","height"]:["height","width"];var h=l?[f.width(),f.height()]:[f.height(),f.width()];var p=/([0-9]+)%/.exec(s);if(p)s=parseInt(p[1],10)/100*h[i=="hide"?0:1];if(i=="show")f.css(u?{height:0,width:s}:{height:s,width:0});var d={},v={};d[c[0]]=i=="show"?h[0]:s;v[c[1]]=i=="show"?h[1]:0;f.animate(d,a,t.options.easing).animate(v,a,t.options.easing,function(){if(i=="hide")n.hide();e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(n[0],arguments);n.dequeue()})})}})(jqcc);(function(e){e.effects.highlight=function(t){return this.queue(function(){var n=e(this),r=["backgroundImage","backgroundColor","opacity"];var i=e.effects.setMode(n,t.options.mode||"show");var s=t.options.color||"#ffff99";var u=n.css("backgroundColor");e.effects.save(n,r);n.show();n.css({backgroundImage:"none",backgroundColor:s});var a={backgroundColor:u};if(i=="hide")a["opacity"]=0;n.animate(a,{queue:false,duration:t.duration,easing:t.options.easing,complete:function(){if(i=="hide")n.hide();e.effects.restore(n,r);if(i=="show"&&e.browser.msie)this.style.removeAttribute("filter");if(t.callback)t.callback.apply(this,arguments);n.dequeue()}})})}})(jqcc);(function(e){e.effects.pulsate=function(t){return this.queue(function(){var n=e(this);var r=e.effects.setMode(n,t.options.mode||"show");var i=t.options.times||5;var s=t.duration?t.duration/2:e.fx.speeds._default/2;if(r=="hide")i--;if(n.is(":hidden")){n.css("opacity",0);n.show();n.animate({opacity:1},s,t.options.easing);i=i-2}for(var u=0;u<i;u++){n.animate({opacity:0},s,t.options.easing).animate({opacity:1},s,t.options.easing)}if(r=="hide"){n.animate({opacity:0},s,t.options.easing,function(){n.hide();if(t.callback)t.callback.apply(this,arguments)})}else{n.animate({opacity:0},s,t.options.easing).animate({opacity:1},s,t.options.easing,function(){if(t.callback)t.callback.apply(this,arguments)})}n.queue("fx",function(){n.dequeue()});n.dequeue()})}})(jqcc);(function(e){e.effects.puff=function(t){return this.queue(function(){var n=e(this);var r=e.extend(true,{},t.options);var i=e.effects.setMode(n,t.options.mode||"hide");var s=parseInt(t.options.percent,10)||150;r.fade=true;var u={height:n.height(),width:n.width()};var a=s/100;n.from=i=="hide"?u:{height:u.height*a,width:u.width*a};r.from=n.from;r.percent=i=="hide"?s:100;r.mode=i;n.effect("scale",r,t.duration,t.callback);n.dequeue()})};e.effects.scale=function(t){return this.queue(function(){var n=e(this);var r=e.extend(true,{},t.options);var i=e.effects.setMode(n,t.options.mode||"effect");var s=parseInt(t.options.percent,10)||(parseInt(t.options.percent,10)==0?0:i=="hide"?0:100);var u=t.options.direction||"both";var a=t.options.origin;if(i!="effect"){r.origin=a||["middle","center"];r.restore=true}var f={height:n.height(),width:n.width()};n.from=t.options.from||(i=="show"?{height:0,width:0}:f);var l={y:u!="horizontal"?s/100:1,x:u!="vertical"?s/100:1};n.to={height:f.height*l.y,width:f.width*l.x};if(t.options.fade){if(i=="show"){n.from.opacity=0;n.to.opacity=1}if(i=="hide"){n.from.opacity=1;n.to.opacity=0}}r.from=n.from;r.to=n.to;r.mode=i;n.effect("size",r,t.duration,t.callback);n.dequeue()})};e.effects.size=function(t){return this.queue(function(){var n=e(this),r=["position","top","left","width","height","overflow","opacity"];var i=["position","top","left","overflow","opacity"];var s=["width","height","overflow"];var u=["fontSize"];var a=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"];var f=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"];var l=e.effects.setMode(n,t.options.mode||"effect");var c=t.options.restore||false;var h=t.options.scale||"both";var p=t.options.origin;var d={height:n.height(),width:n.width()};n.from=t.options.from||d;n.to=t.options.to||d;if(p){var v=e.effects.getBaseline(p,d);n.from.top=(d.height-n.from.height)*v.y;n.from.left=(d.width-n.from.width)*v.x;n.to.top=(d.height-n.to.height)*v.y;n.to.left=(d.width-n.to.width)*v.x}var m={from:{y:n.from.height/d.height,x:n.from.width/d.width},to:{y:n.to.height/d.height,x:n.to.width/d.width}};if(h=="box"||h=="both"){if(m.from.y!=m.to.y){r=r.concat(a);n.from=e.effects.setTransition(n,a,m.from.y,n.from);n.to=e.effects.setTransition(n,a,m.to.y,n.to)}if(m.from.x!=m.to.x){r=r.concat(f);n.from=e.effects.setTransition(n,f,m.from.x,n.from);n.to=e.effects.setTransition(n,f,m.to.x,n.to)}}if(h=="content"||h=="both"){if(m.from.y!=m.to.y){r=r.concat(u);n.from=e.effects.setTransition(n,u,m.from.y,n.from);n.to=e.effects.setTransition(n,u,m.to.y,n.to)}}e.effects.save(n,c?r:i);n.show();e.effects.createWrapper(n);n.css("overflow","hidden").css(n.from);if(h=="content"||h=="both"){a=a.concat(["marginTop","marginBottom"]).concat(u);f=f.concat(["marginLeft","marginRight"]);s=r.concat(a).concat(f);n.find("*[width]").each(function(){child=e(this);if(c)e.effects.save(child,s);var n={height:child.height(),width:child.width()};child.from={height:n.height*m.from.y,width:n.width*m.from.x};child.to={height:n.height*m.to.y,width:n.width*m.to.x};if(m.from.y!=m.to.y){child.from=e.effects.setTransition(child,a,m.from.y,child.from);child.to=e.effects.setTransition(child,a,m.to.y,child.to)}if(m.from.x!=m.to.x){child.from=e.effects.setTransition(child,f,m.from.x,child.from);child.to=e.effects.setTransition(child,f,m.to.x,child.to)}child.css(child.from);child.animate(child.to,t.duration,t.options.easing,function(){if(c)e.effects.restore(child,s)})})}n.animate(n.to,{queue:false,duration:t.duration,easing:t.options.easing,complete:function(){if(l=="hide")n.hide();e.effects.restore(n,c?r:i);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(this,arguments);n.dequeue()}})})}})(jqcc);(function(e){e.effects.shake=function(t){return this.queue(function(){var n=e(this),r=["position","top","left"];var i=e.effects.setMode(n,t.options.mode||"effect");var s=t.options.direction||"left";var u=t.options.distance||20;var a=t.options.times||3;var f=t.duration||t.options.duration||140;e.effects.save(n,r);n.show();e.effects.createWrapper(n);var l=s=="up"||s=="down"?"top":"left";var c=s=="up"||s=="left"?"pos":"neg";var h={},p={},d={};h[l]=(c=="pos"?"-=":"+=")+u;p[l]=(c=="pos"?"+=":"-=")+u*2;d[l]=(c=="pos"?"-=":"+=")+u*2;n.animate(h,f,t.options.easing);for(var v=1;v<a;v++){n.animate(p,f,t.options.easing).animate(d,f,t.options.easing)}n.animate(p,f,t.options.easing).animate(h,f/2,t.options.easing,function(){e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(this,arguments)});n.queue("fx",function(){n.dequeue()});n.dequeue()})}})(jqcc);(function(e){e.effects.slide=function(t){return this.queue(function(){var n=e(this),r=["position","top","left"];var i=e.effects.setMode(n,t.options.mode||"show");var s=t.options.direction||"left";e.effects.save(n,r);n.show();e.effects.createWrapper(n).css({overflow:"hidden"});var u=s=="up"||s=="down"?"top":"left";var a=s=="up"||s=="left"?"pos":"neg";var f=t.options.distance||(u=="top"?n.outerHeight({margin:true}):n.outerWidth({margin:true}));if(i=="show")n.css(u,a=="pos"?-f:f);var l={};l[u]=(i=="show"?a=="pos"?"+=":"-=":a=="pos"?"-=":"+=")+f;n.animate(l,{queue:false,duration:t.duration,easing:t.options.easing,complete:function(){if(i=="hide")n.hide();e.effects.restore(n,r);e.effects.removeWrapper(n);if(t.callback)t.callback.apply(this,arguments);n.dequeue()}})})}})(jqcc);(function(e){e.effects.transfer=function(t){return this.queue(function(){var n=e(this),r=e(t.options.to),i=r.offset(),s={top:i.top,left:i.left,height:r.innerHeight(),width:r.innerWidth()},u=n.offset(),a=e('<div class="ui-effects-transfer"></div>').appendTo(document.body).addClass(t.options.className).css({top:u.top,left:u.left,height:n.innerHeight(),width:n.innerWidth(),position:"absolute"}).animate(s,t.duration,t.options.easing,function(){a.remove();t.callback&&t.callback.apply(n[0],arguments);n.dequeue()})})}})(jqcc);(function(e){e.widget("ui.accordion",{_init:function(){var t=this.options,n=this;this.running=0;if(t.collapsible==e.ui.accordion.defaults.collapsible&&t.alwaysOpen!=e.ui.accordion.defaults.alwaysOpen){t.collapsible=!t.alwaysOpen}if(t.navigation){var r=this.element.find("a").filter(t.navigationFilter);if(r.length){if(r.filter(t.header).length){this.active=r}else{this.active=r.parent().parent().prev();r.addClass("ui-accordion-content-active")}}}this.element.addClass("ui-accordion ui-widget ui-helper-reset");if(this.element[0].nodeName=="UL"){this.element.children("li").addClass("ui-accordion-li-fix")}this.headers=this.element.find(t.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion",function(){e(this).addClass("ui-state-hover")}).bind("mouseleave.accordion",function(){e(this).removeClass("ui-state-hover")}).bind("focus.accordion",function(){e(this).addClass("ui-state-focus")}).bind("blur.accordion",function(){e(this).removeClass("ui-state-focus")});this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");this.active=this._findActive(this.active||t.active).toggleClass("ui-state-default").toggleClass("ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top");this.active.next().addClass("ui-accordion-content-active");e("<span/>").addClass("ui-icon "+t.icons.header).prependTo(this.headers);this.active.find(".ui-icon").toggleClass(t.icons.header).toggleClass(t.icons.headerSelected);if(e.browser.msie){this.element.find("a").css("zoom","1")}this.resize();this.element.attr("role","tablist");this.headers.attr("role","tab").bind("keydown",function(e){return n._keydown(e)}).next().attr("role","tabpanel");this.headers.not(this.active||"").attr("aria-expanded","false").attr("tabIndex","-1").next().hide();if(!this.active.length){this.headers.eq(0).attr("tabIndex","0")}else{this.active.attr("aria-expanded","true").attr("tabIndex","0")}if(!e.browser.safari)this.headers.find("a").attr("tabIndex","-1");if(t.event){this.headers.bind(t.event+".accordion",function(e){return n._clickHandler.call(n,e,this)})}},destroy:function(){var e=this.options;this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role").unbind(".accordion").removeData("accordion");this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("tabindex");this.headers.find("a").removeAttr("tabindex");this.headers.children(".ui-icon").remove();var t=this.headers.next().css("display","").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active");if(e.autoHeight||e.fillHeight){t.css("height","")}},_setData:function(t,n){if(t=="alwaysOpen"){t="collapsible";n=!n}e.widget.prototype._setData.apply(this,arguments)},_keydown:function(t){var n=this.options,r=e.ui.keyCode;if(n.disabled||t.altKey||t.ctrlKey)return;var i=this.headers.length;var s=this.headers.index(t.target);var o=false;switch(t.keyCode){case r.RIGHT:case r.DOWN:o=this.headers[(s+1)%i];break;case r.LEFT:case r.UP:o=this.headers[(s-1+i)%i];break;case r.SPACE:case r.ENTER:return this._clickHandler({target:t.target},t.target)}if(o){e(t.target).attr("tabIndex","-1");e(o).attr("tabIndex","0");o.focus();return false}return true},resize:function(){var t=this.options,n;if(t.fillSpace){if(e.browser.msie){var r=this.element.parent().css("overflow");this.element.parent().css("overflow","hidden")}n=this.element.parent().height();if(e.browser.msie){this.element.parent().css("overflow",r)}this.headers.each(function(){n-=e(this).outerHeight()});var i=0;this.headers.next().each(function(){i=Math.max(i,e(this).innerHeight()-e(this).height())}).height(Math.max(0,n-i)).css("overflow","auto")}else if(t.autoHeight){n=0;this.headers.next().each(function(){n=Math.max(n,e(this).outerHeight())}).height(n)}},activate:function(e){var t=this._findActive(e)[0];this._clickHandler({target:t},t)},_findActive:function(t){return t?typeof t=="number"?this.headers.filter(":eq("+t+")"):this.headers.not(this.headers.not(t)):t===false?e([]):this.headers.filter(":eq(0)")},_clickHandler:function(t,n){var r=this.options;if(r.disabled)return false;if(!t.target&&r.collapsible){this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").find(".ui-icon").removeClass(r.icons.headerSelected).addClass(r.icons.header);this.active.next().addClass("ui-accordion-content-active");var i=this.active.next(),s={options:r,newHeader:e([]),oldHeader:r.active,newContent:e([]),oldContent:i},o=this.active=e([]);this._toggle(o,i,s);return false}var u=e(t.currentTarget||n);var a=u[0]==this.active[0];if(this.running||!r.collapsible&&a){return false}this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").find(".ui-icon").removeClass(r.icons.headerSelected).addClass(r.icons.header);this.active.next().addClass("ui-accordion-content-active");if(!a){u.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").find(".ui-icon").removeClass(r.icons.header).addClass(r.icons.headerSelected);u.next().addClass("ui-accordion-content-active")}var o=u.next(),i=this.active.next(),s={options:r,newHeader:a&&r.collapsible?e([]):u,oldHeader:this.active,newContent:a&&r.collapsible?e([]):o.find("> *"),oldContent:i.find("> *")},f=this.headers.index(this.active[0])>this.headers.index(u[0]);this.active=a?e([]):u;this._toggle(o,i,s,a,f);return false},_toggle:function(t,n,r,i,s){var o=this.options,u=this;this.toShow=t;this.toHide=n;this.data=r;var a=function(){if(!u)return;return u._completed.apply(u,arguments)};this._trigger("changestart",null,this.data);this.running=n.size()===0?t.size():n.size();if(o.animated){var f={};if(o.collapsible&&i){f={toShow:e([]),toHide:n,complete:a,down:s,autoHeight:o.autoHeight||o.fillSpace}}else{f={toShow:t,toHide:n,complete:a,down:s,autoHeight:o.autoHeight||o.fillSpace}}if(!o.proxied){o.proxied=o.animated}if(!o.proxiedDuration){o.proxiedDuration=o.duration}o.animated=e.isFunction(o.proxied)?o.proxied(f):o.proxied;o.duration=e.isFunction(o.proxiedDuration)?o.proxiedDuration(f):o.proxiedDuration;var l=e.ui.accordion.animations,c=o.duration,h=o.animated;if(!l[h]){l[h]=function(e){this.slide(e,{easing:h,duration:c||700})}}l[h](f)}else{if(o.collapsible&&i){t.toggle()}else{n.hide();t.show()}a(true)}n.prev().attr("aria-expanded","false").attr("tabIndex","-1").blur();t.prev().attr("aria-expanded","true").attr("tabIndex","0").focus()},_completed:function(e){var t=this.options;this.running=e?0:--this.running;if(this.running)return;if(t.clearStyle){this.toShow.add(this.toHide).css({height:"",overflow:""})}this._trigger("change",null,this.data)}});e.extend(e.ui.accordion,{version:"1.7.1",defaults:{active:null,alwaysOpen:true,animated:"slide",autoHeight:true,clearStyle:false,collapsible:false,event:"click",fillSpace:false,header:"> li > :first-child,> :not(li):even",icons:{header:"ui-icon-triangle-1-e",headerSelected:"ui-icon-triangle-1-s"},navigation:false,navigationFilter:function(){return this.href.toLowerCase()==location.href.toLowerCase()}},animations:{slide:function(t,n){t=e.extend({easing:"swing",duration:300},t,n);if(!t.toHide.size()){t.toShow.animate({height:"show"},t);return}if(!t.toShow.size()){t.toHide.animate({height:"hide"},t);return}var r=t.toShow.css("overflow"),i,s={},o={},u=["height","paddingTop","paddingBottom"],a;var f=t.toShow;a=f[0].style.width;f.width(parseInt(f.parent().width(),10)-parseInt(f.css("paddingLeft"),10)-parseInt(f.css("paddingRight"),10)-(parseInt(f.css("borderLeftWidth"),10)||0)-(parseInt(f.css("borderRightWidth"),10)||0));e.each(u,function(n,r){o[r]="hide";var i=(""+e.css(t.toShow[0],r)).match(/^([\d+-.]+)(.*)$/);s[r]={value:i[1],unit:i[2]||"px"}});t.toShow.css({height:0,overflow:"hidden"}).show();t.toHide.filter(":hidden").each(t.complete).end().filter(":visible").animate(o,{step:function(e,n){if(n.prop=="height"){i=(n.now-n.start)/(n.end-n.start)}t.toShow[0].style[n.prop]=i*s[n.prop].value+s[n.prop].unit},duration:t.duration,easing:t.easing,complete:function(){if(!t.autoHeight){t.toShow.css("height","")}t.toShow.css("width",a);t.toShow.css({overflow:r});t.complete()}})},bounceslide:function(e){this.slide(e,{easing:e.down?"easeOutBounce":"swing",duration:e.down?1e3:200})},easeslide:function(e){this.slide(e,{easing:"easeinout",duration:700})}}})})(jqcc);(function($){function Datepicker(){this.debug=false;this._curInst=null;this._keyEvent=false;this._disabledInputs=[];this._datepickerShowing=false;this._inDialog=false;this._mainDivId="ui-datepicker-div";this._inlineClass="ui-datepicker-inline";this._appendClass="ui-datepicker-append";this._triggerClass="ui-datepicker-trigger";this._dialogClass="ui-datepicker-dialog";this._disableClass="ui-datepicker-disabled";this._unselectableClass="ui-datepicker-unselectable";this._currentClass="ui-datepicker-current-day";this._dayOverClass="ui-datepicker-days-cell-over";this.regional=[];this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],dateFormat:"mm/dd/yy",firstDay:0,isRTL:false};this._defaults={showOn:"focus",showAnim:"show",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:false,hideIfNoPrevNext:false,navigationAsDateFormat:false,gotoCurrent:false,changeMonth:false,changeYear:false,showMonthAfterYear:false,yearRange:"-10:+10",showOtherMonths:false,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"normal",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:true,showButtonPanel:false};$.extend(this._defaults,this.regional[""]);this.dpDiv=$('<div id="'+this._mainDivId+'" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all ui-helper-hidden-accessible"></div>')}function extendRemove(e,t){$.extend(e,t);for(var n in t)if(t[n]==null||t[n]==undefined)e[n]=t[n];return e}function isArray(e){return e&&($.browser.safari&&typeof e=="object"&&e.length||e.constructor&&e.constructor.toString().match(/\Array\(\)/))}$.extend($.ui,{datepicker:{version:"1.7.1"}});var PROP_NAME="datepicker";$.extend(Datepicker.prototype,{markerClassName:"hasDatepicker",log:function(){if(this.debug)console.log.apply("",arguments)},setDefaults:function(e){extendRemove(this._defaults,e||{});return this},_attachDatepicker:function(target,settings){var inlineSettings=null;for(var attrName in this._defaults){var attrValue=target.getAttribute("date:"+attrName);if(attrValue){inlineSettings=inlineSettings||{};try{inlineSettings[attrName]=eval(attrValue)}catch(err){inlineSettings[attrName]=attrValue}}}var nodeName=target.nodeName.toLowerCase();var inline=nodeName=="div"||nodeName=="span";if(!target.id)target.id="dp"+ ++this.uuid;var inst=this._newInst($(target),inline);inst.settings=$.extend({},settings||{},inlineSettings||{});if(nodeName=="input"){this._connectDatepicker(target,inst)}else if(inline){this._inlineDatepicker(target,inst)}},_newInst:function(e,t){var n=e[0].id.replace(/([:\[\]\.])/g,"\\\\$1");return{id:n,input:e,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:t,dpDiv:!t?this.dpDiv:$('<div class="'+this._inlineClass+' ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>')}},_connectDatepicker:function(e,t){var n=$(e);t.trigger=$([]);if(n.hasClass(this.markerClassName))return;var r=this._get(t,"appendText");var i=this._get(t,"isRTL");if(r)n[i?"before":"after"]('<span class="'+this._appendClass+'">'+r+"</span>");var s=this._get(t,"showOn");if(s=="focus"||s=="both")n.focus(this._showDatepicker);if(s=="button"||s=="both"){var o=this._get(t,"buttonText");var u=this._get(t,"buttonImage");t.trigger=$(this._get(t,"buttonImageOnly")?$("<img/>").addClass(this._triggerClass).attr({src:u,alt:o,title:o}):$('<button type="button"></button>').addClass(this._triggerClass).html(u==""?o:$("<img/>").attr({src:u,alt:o,title:o})));n[i?"before":"after"](t.trigger);t.trigger.click(function(){if($.datepicker._datepickerShowing&&$.datepicker._lastInput==e)$.datepicker._hideDatepicker();else $.datepicker._showDatepicker(e);return false})}n.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).bind("setData.datepicker",function(e,n,r){t.settings[n]=r}).bind("getData.datepicker",function(e,n){return this._get(t,n)});$.data(e,PROP_NAME,t)},_inlineDatepicker:function(e,t){var n=$(e);if(n.hasClass(this.markerClassName))return;n.addClass(this.markerClassName).append(t.dpDiv).bind("setData.datepicker",function(e,n,r){t.settings[n]=r}).bind("getData.datepicker",function(e,n){return this._get(t,n)});$.data(e,PROP_NAME,t);this._setDate(t,this._getDefaultDate(t));this._updateDatepicker(t);this._updateAlternate(t)},_dialogDatepicker:function(e,t,n,r,i){var s=this._dialogInst;if(!s){var o="dp"+ ++this.uuid;this._dialogInput=$('<input type="text" id="'+o+'" size="1" style="position: absolute; top: -100px;"/>');this._dialogInput.keydown(this._doKeyDown);$("body").append(this._dialogInput);s=this._dialogInst=this._newInst(this._dialogInput,false);s.settings={};$.data(this._dialogInput[0],PROP_NAME,s)}extendRemove(s.settings,r||{});this._dialogInput.val(t);this._pos=i?i.length?i:[i.pageX,i.pageY]:null;if(!this._pos){var u=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth;var a=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight;var f=document.documentElement.scrollLeft||document.body.scrollLeft;var l=document.documentElement.scrollTop||document.body.scrollTop;this._pos=[u/2-100+f,a/2-150+l]}this._dialogInput.css("left",this._pos[0]+"px").css("top",this._pos[1]+"px");s.settings.onSelect=n;this._inDialog=true;this.dpDiv.addClass(this._dialogClass);this._showDatepicker(this._dialogInput[0]);if($.blockUI)$.blockUI(this.dpDiv);$.data(this._dialogInput[0],PROP_NAME,s);return this},_destroyDatepicker:function(e){var t=$(e);var n=$.data(e,PROP_NAME);if(!t.hasClass(this.markerClassName)){return}var r=e.nodeName.toLowerCase();$.removeData(e,PROP_NAME);if(r=="input"){n.trigger.remove();t.siblings("."+this._appendClass).remove().end().removeClass(this.markerClassName).unbind("focus",this._showDatepicker).unbind("keydown",this._doKeyDown).unbind("keypress",this._doKeyPress)}else if(r=="div"||r=="span")t.removeClass(this.markerClassName).empty()},_enableDatepicker:function(e){var t=$(e);var n=$.data(e,PROP_NAME);if(!t.hasClass(this.markerClassName)){return}var r=e.nodeName.toLowerCase();if(r=="input"){e.disabled=false;n.trigger.filter("button").each(function(){this.disabled=false}).end().filter("img").css({opacity:"1.0",cursor:""})}else if(r=="div"||r=="span"){var i=t.children("."+this._inlineClass);i.children().removeClass("ui-state-disabled")}this._disabledInputs=$.map(this._disabledInputs,function(t){return t==e?null:t})},_disableDatepicker:function(e){var t=$(e);var n=$.data(e,PROP_NAME);if(!t.hasClass(this.markerClassName)){return}var r=e.nodeName.toLowerCase();if(r=="input"){e.disabled=true;n.trigger.filter("button").each(function(){this.disabled=true}).end().filter("img").css({opacity:"0.5",cursor:"default"})}else if(r=="div"||r=="span"){var i=t.children("."+this._inlineClass);i.children().addClass("ui-state-disabled")}this._disabledInputs=$.map(this._disabledInputs,function(t){return t==e?null:t});this._disabledInputs[this._disabledInputs.length]=e},_isDisabledDatepicker:function(e){if(!e){return false}for(var t=0;t<this._disabledInputs.length;t++){if(this._disabledInputs[t]==e)return true}return false},_getInst:function(e){try{return $.data(e,PROP_NAME)}catch(t){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(e,t,n){var r=t||{};if(typeof t=="string"){r={};r[t]=n}var i=this._getInst(e);if(i){if(this._curInst==i){this._hideDatepicker(null)}extendRemove(i.settings,r);var s=new Date;extendRemove(i,{rangeStart:null,endDay:null,endMonth:null,endYear:null,selectedDay:s.getDate(),selectedMonth:s.getMonth(),selectedYear:s.getFullYear(),currentDay:s.getDate(),currentMonth:s.getMonth(),currentYear:s.getFullYear(),drawMonth:s.getMonth(),drawYear:s.getFullYear()});this._updateDatepicker(i)}},_changeDatepicker:function(e,t,n){this._optionDatepicker(e,t,n)},_refreshDatepicker:function(e){var t=this._getInst(e);if(t){this._updateDatepicker(t)}},_setDateDatepicker:function(e,t,n){var r=this._getInst(e);if(r){this._setDate(r,t,n);this._updateDatepicker(r);this._updateAlternate(r)}},_getDateDatepicker:function(e){var t=this._getInst(e);if(t&&!t.inline)this._setDateFromField(t);return t?this._getDate(t):null},_doKeyDown:function(e){var t=$.datepicker._getInst(e.target);var n=true;var r=t.dpDiv.is(".ui-datepicker-rtl");t._keyEvent=true;if($.datepicker._datepickerShowing)switch(e.keyCode){case 9:$.datepicker._hideDatepicker(null,"");break;case 13:var i=$("td."+$.datepicker._dayOverClass+", td."+$.datepicker._currentClass,t.dpDiv);if(i[0])$.datepicker._selectDay(e.target,t.selectedMonth,t.selectedYear,i[0]);else $.datepicker._hideDatepicker(null,$.datepicker._get(t,"duration"));return false;break;case 27:$.datepicker._hideDatepicker(null,$.datepicker._get(t,"duration"));break;case 33:$.datepicker._adjustDate(e.target,e.ctrlKey?-$.datepicker._get(t,"stepBigMonths"):-$.datepicker._get(t,"stepMonths"),"M");break;case 34:$.datepicker._adjustDate(e.target,e.ctrlKey?+$.datepicker._get(t,"stepBigMonths"):+$.datepicker._get(t,"stepMonths"),"M");break;case 35:if(e.ctrlKey||e.metaKey)$.datepicker._clearDate(e.target);n=e.ctrlKey||e.metaKey;break;case 36:if(e.ctrlKey||e.metaKey)$.datepicker._gotoToday(e.target);n=e.ctrlKey||e.metaKey;break;case 37:if(e.ctrlKey||e.metaKey)$.datepicker._adjustDate(e.target,r?+1:-1,"D");n=e.ctrlKey||e.metaKey;if(e.originalEvent.altKey)$.datepicker._adjustDate(e.target,e.ctrlKey?-$.datepicker._get(t,"stepBigMonths"):-$.datepicker._get(t,"stepMonths"),"M");break;case 38:if(e.ctrlKey||e.metaKey)$.datepicker._adjustDate(e.target,-7,"D");n=e.ctrlKey||e.metaKey;break;case 39:if(e.ctrlKey||e.metaKey)$.datepicker._adjustDate(e.target,r?-1:+1,"D");n=e.ctrlKey||e.metaKey;if(e.originalEvent.altKey)$.datepicker._adjustDate(e.target,e.ctrlKey?+$.datepicker._get(t,"stepBigMonths"):+$.datepicker._get(t,"stepMonths"),"M");break;case 40:if(e.ctrlKey||e.metaKey)$.datepicker._adjustDate(e.target,+7,"D");n=e.ctrlKey||e.metaKey;break;default:n=false}else if(e.keyCode==36&&e.ctrlKey)$.datepicker._showDatepicker(this);else{n=false}if(n){e.preventDefault();e.stopPropagation()}},_doKeyPress:function(e){var t=$.datepicker._getInst(e.target);if($.datepicker._get(t,"constrainInput")){var n=$.datepicker._possibleChars($.datepicker._get(t,"dateFormat"));var r=String.fromCharCode(e.charCode==undefined?e.keyCode:e.charCode);return e.ctrlKey||r<" "||!n||n.indexOf(r)>-1}},_showDatepicker:function(e){e=e.target||e;if(e.nodeName.toLowerCase()!="input")e=$("input",e.parentNode)[0];if($.datepicker._isDisabledDatepicker(e)||$.datepicker._lastInput==e)return;var t=$.datepicker._getInst(e);var n=$.datepicker._get(t,"beforeShow");extendRemove(t.settings,n?n.apply(e,[e,t]):{});$.datepicker._hideDatepicker(null,"");$.datepicker._lastInput=e;$.datepicker._setDateFromField(t);if($.datepicker._inDialog)e.value="";if(!$.datepicker._pos){$.datepicker._pos=$.datepicker._findPos(e);$.datepicker._pos[1]+=e.offsetHeight}var r=false;$(e).parents().each(function(){r|=$(this).css("position")=="fixed";return!r});if(r&&$.browser.opera){$.datepicker._pos[0]-=document.documentElement.scrollLeft;$.datepicker._pos[1]-=document.documentElement.scrollTop}var i={left:$.datepicker._pos[0],top:$.datepicker._pos[1]};$.datepicker._pos=null;t.rangeStart=null;t.dpDiv.css({position:"absolute",display:"block",top:"-1000px"});$.datepicker._updateDatepicker(t);i=$.datepicker._checkOffset(t,i,r);t.dpDiv.css({position:$.datepicker._inDialog&&$.blockUI?"static":r?"fixed":"absolute",display:"none",left:i.left+"px",top:i.top+"px"});if(!t.inline){var s=$.datepicker._get(t,"showAnim")||"show";var o=$.datepicker._get(t,"duration");var u=function(){$.datepicker._datepickerShowing=true;if($.browser.msie&&parseInt($.browser.version,10)<7)$("iframe.ui-datepicker-cover").css({width:t.dpDiv.width()+4,height:t.dpDiv.height()+4})};if($.effects&&$.effects[s])t.dpDiv.show(s,$.datepicker._get(t,"showOptions"),o,u);else t.dpDiv[s](o,u);if(o=="")u();if(t.input[0].type!="hidden")t.input[0].focus();$.datepicker._curInst=t}},_updateDatepicker:function(e){var t={width:e.dpDiv.width()+4,height:e.dpDiv.height()+4};var n=this;e.dpDiv.empty().append(this._generateHTML(e)).find("iframe.ui-datepicker-cover").css({width:t.width,height:t.height}).end().find("button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a").bind("mouseout",function(){$(this).removeClass("ui-state-hover");if(this.className.indexOf("ui-datepicker-prev")!=-1)$(this).removeClass("ui-datepicker-prev-hover");if(this.className.indexOf("ui-datepicker-next")!=-1)$(this).removeClass("ui-datepicker-next-hover")}).bind("mouseover",function(){if(!n._isDisabledDatepicker(e.inline?e.dpDiv.parent()[0]:e.input[0])){$(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover");$(this).addClass("ui-state-hover");if(this.className.indexOf("ui-datepicker-prev")!=-1)$(this).addClass("ui-datepicker-prev-hover");if(this.className.indexOf("ui-datepicker-next")!=-1)$(this).addClass("ui-datepicker-next-hover")}}).end().find("."+this._dayOverClass+" a").trigger("mouseover").end();var r=this._getNumberOfMonths(e);var i=r[1];var s=17;if(i>1){e.dpDiv.addClass("ui-datepicker-multi-"+i).css("width",s*i+"em")}else{e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width("")}e.dpDiv[(r[0]!=1||r[1]!=1?"add":"remove")+"Class"]("ui-datepicker-multi");e.dpDiv[(this._get(e,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl");if(e.input&&e.input[0].type!="hidden"&&e==$.datepicker._curInst)$(e.input[0]).focus()},_checkOffset:function(e,t,n){var r=e.dpDiv.outerWidth();var i=e.dpDiv.outerHeight();var s=e.input?e.input.outerWidth():0;var o=e.input?e.input.outerHeight():0;var u=(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)+$(document).scrollLeft();var a=(window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight)+$(document).scrollTop();t.left-=this._get(e,"isRTL")?r-s:0;t.left-=n&&t.left==e.input.offset().left?$(document).scrollLeft():0;t.top-=n&&t.top==e.input.offset().top+o?$(document).scrollTop():0;t.left-=t.left+r>u&&u>r?Math.abs(t.left+r-u):0;t.top-=t.top+i>a&&a>i?Math.abs(t.top+i+o*2-a):0;return t},_findPos:function(e){while(e&&(e.type=="hidden"||e.nodeType!=1)){e=e.nextSibling}var t=$(e).offset();return[t.left,t.top]},_hideDatepicker:function(e,t){var n=this._curInst;if(!n||e&&n!=$.data(e,PROP_NAME))return;if(n.stayOpen)this._selectDate("#"+n.id,this._formatDate(n,n.currentDay,n.currentMonth,n.currentYear));n.stayOpen=false;if(this._datepickerShowing){t=t!=null?t:this._get(n,"duration");var r=this._get(n,"showAnim");var i=function(){$.datepicker._tidyDialog(n)};if(t!=""&&$.effects&&$.effects[r])n.dpDiv.hide(r,$.datepicker._get(n,"showOptions"),t,i);else n.dpDiv[t==""?"hide":r=="slideDown"?"slideUp":r=="fadeIn"?"fadeOut":"hide"](t,i);if(t=="")this._tidyDialog(n);var s=this._get(n,"onClose");if(s)s.apply(n.input?n.input[0]:null,[n.input?n.input.val():"",n]);this._datepickerShowing=false;this._lastInput=null;if(this._inDialog){this._dialogInput.css({position:"absolute",left:"0",top:"-100px"});if($.blockUI){$.unblockUI();$("body").append(this.dpDiv)}}this._inDialog=false}this._curInst=null},_tidyDialog:function(e){e.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")},_checkExternalClick:function(e){if(!$.datepicker._curInst)return;var t=$(e.target);if(t.parents("#"+$.datepicker._mainDivId).length==0&&!t.hasClass($.datepicker.markerClassName)&&!t.hasClass($.datepicker._triggerClass)&&$.datepicker._datepickerShowing&&!($.datepicker._inDialog&&$.blockUI))$.datepicker._hideDatepicker(null,"")},_adjustDate:function(e,t,n){var r=$(e);var i=this._getInst(r[0]);if(this._isDisabledDatepicker(r[0])){return}this._adjustInstDate(i,t+(n=="M"?this._get(i,"showCurrentAtPos"):0),n);this._updateDatepicker(i)},_gotoToday:function(e){var t=$(e);var n=this._getInst(t[0]);if(this._get(n,"gotoCurrent")&&n.currentDay){n.selectedDay=n.currentDay;n.drawMonth=n.selectedMonth=n.currentMonth;n.drawYear=n.selectedYear=n.currentYear}else{var r=new Date;n.selectedDay=r.getDate();n.drawMonth=n.selectedMonth=r.getMonth();n.drawYear=n.selectedYear=r.getFullYear()}this._notifyChange(n);this._adjustDate(t)},_selectMonthYear:function(e,t,n){var r=$(e);var i=this._getInst(r[0]);i._selectingMonthYear=false;i["selected"+(n=="M"?"Month":"Year")]=i["draw"+(n=="M"?"Month":"Year")]=parseInt(t.options[t.selectedIndex].value,10);this._notifyChange(i);this._adjustDate(r)},_clickMonthYear:function(e){var t=$(e);var n=this._getInst(t[0]);if(n.input&&n._selectingMonthYear&&!$.browser.msie)n.input[0].focus();n._selectingMonthYear=!n._selectingMonthYear},_selectDay:function(e,t,n,r){var i=$(e);if($(r).hasClass(this._unselectableClass)||this._isDisabledDatepicker(i[0])){return}var s=this._getInst(i[0]);s.selectedDay=s.currentDay=$("a",r).html();s.selectedMonth=s.currentMonth=t;s.selectedYear=s.currentYear=n;if(s.stayOpen){s.endDay=s.endMonth=s.endYear=null}this._selectDate(e,this._formatDate(s,s.currentDay,s.currentMonth,s.currentYear));if(s.stayOpen){s.rangeStart=this._daylightSavingAdjust(new Date(s.currentYear,s.currentMonth,s.currentDay));this._updateDatepicker(s)}},_clearDate:function(e){var t=$(e);var n=this._getInst(t[0]);n.stayOpen=false;n.endDay=n.endMonth=n.endYear=n.rangeStart=null;this._selectDate(t,"")},_selectDate:function(e,t){var n=$(e);var r=this._getInst(n[0]);t=t!=null?t:this._formatDate(r);if(r.input)r.input.val(t);this._updateAlternate(r);var i=this._get(r,"onSelect");if(i)i.apply(r.input?r.input[0]:null,[t,r]);else if(r.input)r.input.trigger("change");if(r.inline)this._updateDatepicker(r);else if(!r.stayOpen){this._hideDatepicker(null,this._get(r,"duration"));this._lastInput=r.input[0];if(typeof r.input[0]!="object")r.input[0].focus();this._lastInput=null}},_updateAlternate:function(e){var t=this._get(e,"altField");if(t){var n=this._get(e,"altFormat")||this._get(e,"dateFormat");var r=this._getDate(e);dateStr=this.formatDate(n,r,this._getFormatConfig(e));$(t).each(function(){$(this).val(dateStr)})}},noWeekends:function(e){var t=e.getDay();return[t>0&&t<6,""]},iso8601Week:function(e){var t=new Date(e.getFullYear(),e.getMonth(),e.getDate());var n=new Date(t.getFullYear(),1-1,4);var r=n.getDay()||7;n.setDate(n.getDate()+1-r);if(r<4&&t<n){t.setDate(t.getDate()-3);return $.datepicker.iso8601Week(t)}else if(t>new Date(t.getFullYear(),12-1,28)){r=(new Date(t.getFullYear()+1,1-1,4)).getDay()||7;if(r>4&&(t.getDay()||7)<r-3){return 1}}return Math.floor((t-n)/864e5/7)+1},parseDate:function(e,t,n){if(e==null||t==null)throw"Invalid arguments";t=typeof t=="object"?t.toString():t+"";if(t=="")return null;var r=(n?n.shortYearCutoff:null)||this._defaults.shortYearCutoff;var i=(n?n.dayNamesShort:null)||this._defaults.dayNamesShort;var s=(n?n.dayNames:null)||this._defaults.dayNames;var o=(n?n.monthNamesShort:null)||this._defaults.monthNamesShort;var u=(n?n.monthNames:null)||this._defaults.monthNames;var a=-1;var f=-1;var l=-1;var c=-1;var h=false;var p=function(t){var n=y+1<e.length&&e.charAt(y+1)==t;if(n)y++;return n};var d=function(e){p(e);var n=e=="@"?14:e=="y"?4:e=="o"?3:2;var r=n;var i=0;while(r>0&&g<t.length&&t.charAt(g)>="0"&&t.charAt(g)<="9"){i=i*10+parseInt(t.charAt(g++),10);r--}if(r==n)throw"Missing number at position "+g;return i};var v=function(e,n,r){var i=p(e)?r:n;var s=0;for(var o=0;o<i.length;o++)s=Math.max(s,i[o].length);var u="";var a=g;while(s>0&&g<t.length){u+=t.charAt(g++);for(var f=0;f<i.length;f++)if(u==i[f])return f+1;s--}throw"Unknown name at position "+a};var m=function(){if(t.charAt(g)!=e.charAt(y))throw"Unexpected literal at position "+g;g++};var g=0;for(var y=0;y<e.length;y++){if(h)if(e.charAt(y)=="'"&&!p("'"))h=false;else m();else switch(e.charAt(y)){case"d":l=d("d");break;case"D":v("D",i,s);break;case"o":c=d("o");break;case"m":f=d("m");break;case"M":f=v("M",o,u);break;case"y":a=d("y");break;case"@":var b=new Date(d("@"));a=b.getFullYear();f=b.getMonth()+1;l=b.getDate();break;case"'":if(p("'"))m();else h=true;break;default:m()}}if(a==-1)a=(new Date).getFullYear();else if(a<100)a+=(new Date).getFullYear()-(new Date).getFullYear()%100+(a<=r?0:-100);if(c>-1){f=1;l=c;do{var w=this._getDaysInMonth(a,f-1);if(l<=w)break;f++;l-=w}while(true)}var b=this._daylightSavingAdjust(new Date(a,f-1,l));if(b.getFullYear()!=a||b.getMonth()+1!=f||b.getDate()!=l)throw"Invalid date";return b},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TIMESTAMP:"@",W3C:"yy-mm-dd",formatDate:function(e,t,n){if(!t)return"";var r=(n?n.dayNamesShort:null)||this._defaults.dayNamesShort;var i=(n?n.dayNames:null)||this._defaults.dayNames;var s=(n?n.monthNamesShort:null)||this._defaults.monthNamesShort;var o=(n?n.monthNames:null)||this._defaults.monthNames;var u=function(t){var n=h+1<e.length&&e.charAt(h+1)==t;if(n)h++;return n};var a=function(e,t,n){var r=""+t;if(u(e))while(r.length<n)r="0"+r;return r};var f=function(e,t,n,r){return u(e)?r[t]:n[t]};var l="";var c=false;if(t)for(var h=0;h<e.length;h++){if(c)if(e.charAt(h)=="'"&&!u("'"))c=false;else l+=e.charAt(h);else switch(e.charAt(h)){case"d":l+=a("d",t.getDate(),2);break;case"D":l+=f("D",t.getDay(),r,i);break;case"o":var p=t.getDate();for(var d=t.getMonth()-1;d>=0;d--)p+=this._getDaysInMonth(t.getFullYear(),d);l+=a("o",p,3);break;case"m":l+=a("m",t.getMonth()+1,2);break;case"M":l+=f("M",t.getMonth(),s,o);break;case"y":l+=u("y")?t.getFullYear():(t.getYear()%100<10?"0":"")+t.getYear()%100;break;case"@":l+=t.getTime();break;case"'":if(u("'"))l+="'";else c=true;break;default:l+=e.charAt(h)}}return l},_possibleChars:function(e){var t="";var n=false;for(var r=0;r<e.length;r++)if(n)if(e.charAt(r)=="'"&&!lookAhead("'"))n=false;else t+=e.charAt(r);else switch(e.charAt(r)){case"d":case"m":case"y":case"@":t+="0123456789";break;case"D":case"M":return null;case"'":if(lookAhead("'"))t+="'";else n=true;break;default:t+=e.charAt(r)}return t},_get:function(e,t){return e.settings[t]!==undefined?e.settings[t]:this._defaults[t]},_setDateFromField:function(e){var t=this._get(e,"dateFormat");var n=e.input?e.input.val():null;e.endDay=e.endMonth=e.endYear=null;var r=defaultDate=this._getDefaultDate(e);var i=this._getFormatConfig(e);try{r=this.parseDate(t,n,i)||defaultDate}catch(s){this.log(s);r=defaultDate}e.selectedDay=r.getDate();e.drawMonth=e.selectedMonth=r.getMonth();e.drawYear=e.selectedYear=r.getFullYear();e.currentDay=n?r.getDate():0;e.currentMonth=n?r.getMonth():0;e.currentYear=n?r.getFullYear():0;this._adjustInstDate(e)},_getDefaultDate:function(e){var t=this._determineDate(this._get(e,"defaultDate"),new Date);var n=this._getMinMaxDate(e,"min",true);var r=this._getMinMaxDate(e,"max");t=n&&t<n?n:t;t=r&&t>r?r:t;return t},_determineDate:function(e,t){var n=function(e){var t=new Date;t.setDate(t.getDate()+e);return t};var r=function(e,t){var n=new Date;var r=n.getFullYear();var i=n.getMonth();var s=n.getDate();var o=/([+-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g;var u=o.exec(e);while(u){switch(u[2]||"d"){case"d":case"D":s+=parseInt(u[1],10);break;case"w":case"W":s+=parseInt(u[1],10)*7;break;case"m":case"M":i+=parseInt(u[1],10);s=Math.min(s,t(r,i));break;case"y":case"Y":r+=parseInt(u[1],10);s=Math.min(s,t(r,i));break}u=o.exec(e)}return new Date(r,i,s)};e=e==null?t:typeof e=="string"?r(e,this._getDaysInMonth):typeof e=="number"?isNaN(e)?t:n(e):e;e=e&&e.toString()=="Invalid Date"?t:e;if(e){e.setHours(0);e.setMinutes(0);e.setSeconds(0);e.setMilliseconds(0)}return this._daylightSavingAdjust(e)},_daylightSavingAdjust:function(e){if(!e)return null;e.setHours(e.getHours()>12?e.getHours()+2:0);return e},_setDate:function(e,t,n){var r=!t;var i=e.selectedMonth;var s=e.selectedYear;t=this._determineDate(t,new Date);e.selectedDay=e.currentDay=t.getDate();e.drawMonth=e.selectedMonth=e.currentMonth=t.getMonth();e.drawYear=e.selectedYear=e.currentYear=t.getFullYear();if(i!=e.selectedMonth||s!=e.selectedYear)this._notifyChange(e);this._adjustInstDate(e);if(e.input){e.input.val(r?"":this._formatDate(e))}},_getDate:function(e){var t=!e.currentYear||e.input&&e.input.val()==""?null:this._daylightSavingAdjust(new Date(e.currentYear,e.currentMonth,e.currentDay));return t},_generateHTML:function(e){var t=new Date;t=this._daylightSavingAdjust(new Date(t.getFullYear(),t.getMonth(),t.getDate()));var n=this._get(e,"isRTL");var r=this._get(e,"showButtonPanel");var i=this._get(e,"hideIfNoPrevNext");var s=this._get(e,"navigationAsDateFormat");var o=this._getNumberOfMonths(e);var u=this._get(e,"showCurrentAtPos");var a=this._get(e,"stepMonths");var f=this._get(e,"stepBigMonths");var l=o[0]!=1||o[1]!=1;var c=this._daylightSavingAdjust(!e.currentDay?new Date(9999,9,9):new Date(e.currentYear,e.currentMonth,e.currentDay));var h=this._getMinMaxDate(e,"min",true);var p=this._getMinMaxDate(e,"max");var d=e.drawMonth-u;var v=e.drawYear;if(d<0){d+=12;v--}if(p){var m=this._daylightSavingAdjust(new Date(p.getFullYear(),p.getMonth()-o[1]+1,p.getDate()));m=h&&m<h?h:m;while(this._daylightSavingAdjust(new Date(v,d,1))>m){d--;if(d<0){d=11;v--}}}e.drawMonth=d;e.drawYear=v;var g=this._get(e,"prevText");g=!s?g:this.formatDate(g,this._daylightSavingAdjust(new Date(v,d-a,1)),this._getFormatConfig(e));var y=this._canAdjustMonth(e,-1,v,d)?'<a class="ui-datepicker-prev ui-corner-all" onclick="DP_jqcc.datepicker._adjustDate(\'#'+e.id+"', -"+a+", 'M');\""+' title="'+g+'"><span class="ui-icon ui-icon-circle-triangle-'+(n?"e":"w")+'">'+g+"</span></a>":i?"":'<a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="'+g+'"><span class="ui-icon ui-icon-circle-triangle-'+(n?"e":"w")+'">'+g+"</span></a>";var b=this._get(e,"nextText");b=!s?b:this.formatDate(b,this._daylightSavingAdjust(new Date(v,d+a,1)),this._getFormatConfig(e));var w=this._canAdjustMonth(e,+1,v,d)?'<a class="ui-datepicker-next ui-corner-all" onclick="DP_jqcc.datepicker._adjustDate(\'#'+e.id+"', +"+a+", 'M');\""+' title="'+b+'"><span class="ui-icon ui-icon-circle-triangle-'+(n?"w":"e")+'">'+b+"</span></a>":i?"":'<a class="ui-datepicker-next ui-corner-all ui-state-disabled" title="'+b+'"><span class="ui-icon ui-icon-circle-triangle-'+(n?"w":"e")+'">'+b+"</span></a>";var E=this._get(e,"currentText");var S=this._get(e,"gotoCurrent")&&e.currentDay?c:t;E=!s?E:this.formatDate(E,S,this._getFormatConfig(e));var x=!e.inline?'<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" onclick="DP_jqcc.datepicker._hideDatepicker();">'+this._get(e,"closeText")+"</button>":"";var T=r?'<div class="ui-datepicker-buttonpane ui-widget-content">'+(n?x:"")+(this._isInRange(e,S)?'<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all" onclick="DP_jqcc.datepicker._gotoToday(\'#'+e.id+"');\""+">"+E+"</button>":"")+(n?"":x)+"</div>":"";var N=parseInt(this._get(e,"firstDay"),10);N=isNaN(N)?0:N;var C=this._get(e,"dayNames");var k=this._get(e,"dayNamesShort");var L=this._get(e,"dayNamesMin");var A=this._get(e,"monthNames");var O=this._get(e,"monthNamesShort");var M=this._get(e,"beforeShowDay");var _=this._get(e,"showOtherMonths");var D=this._get(e,"calculateWeek")||this.iso8601Week;var P=e.endDay?this._daylightSavingAdjust(new Date(e.endYear,e.endMonth,e.endDay)):c;var H=this._getDefaultDate(e);var B="";for(var j=0;j<o[0];j++){var F="";for(var I=0;I<o[1];I++){var q=this._daylightSavingAdjust(new Date(v,d,e.selectedDay));var R=" ui-corner-all";var U="";if(l){U+='<div class="ui-datepicker-group ui-datepicker-group-';switch(I){case 0:U+="first";R=" ui-corner-"+(n?"right":"left");break;case o[1]-1:U+="last";R=" ui-corner-"+(n?"left":"right");break;default:U+="middle";R="";break}U+='">'}U+='<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix'+R+'">'+(/all|left/.test(R)&&j==0?n?w:y:"")+(/all|right/.test(R)&&j==0?n?y:w:"")+this._generateMonthYearHeader(e,d,v,h,p,q,j>0||I>0,A,O)+'</div><table class="ui-datepicker-calendar"><thead>'+"<tr>";var z="";for(var W=0;W<7;W++){var X=(W+N)%7;z+="<th"+((W+N+6)%7>=5?' class="ui-datepicker-week-end"':"")+">"+'<span title="'+C[X]+'">'+L[X]+"</span></th>"}U+=z+"</tr></thead><tbody>";var V=this._getDaysInMonth(v,d);if(v==e.selectedYear&&d==e.selectedMonth)e.selectedDay=Math.min(e.selectedDay,V);var J=(this._getFirstDayOfMonth(v,d)-N+7)%7;var K=l?6:Math.ceil((J+V)/7);var Q=this._daylightSavingAdjust(new Date(v,d,1-J));for(var G=0;G<K;G++){U+="<tr>";var Y="";for(var W=0;W<7;W++){var Z=M?M.apply(e.input?e.input[0]:null,[Q]):[true,""];var et=Q.getMonth()!=d;var tt=et||!Z[0]||h&&Q<h||p&&Q>p;Y+='<td class="'+((W+N+6)%7>=5?" ui-datepicker-week-end":"")+(et?" ui-datepicker-other-month":"")+(Q.getTime()==q.getTime()&&d==e.selectedMonth&&e._keyEvent||H.getTime()==Q.getTime()&&H.getTime()==q.getTime()?" "+this._dayOverClass:"")+(tt?" "+this._unselectableClass+" ui-state-disabled":"")+(et&&!_?"":" "+Z[1]+(Q.getTime()>=c.getTime()&&Q.getTime()<=P.getTime()?" "+this._currentClass:"")+(Q.getTime()==t.getTime()?" ui-datepicker-today":""))+'"'+((!et||_)&&Z[2]?' title="'+Z[2]+'"':"")+(tt?"":" onclick=\"DP_jqcc.datepicker._selectDay('#"+e.id+"',"+d+","+v+', this);return false;"')+">"+(et?_?Q.getDate():"&#xa0;":tt?'<span class="ui-state-default">'+Q.getDate()+"</span>":'<a class="ui-state-default'+(Q.getTime()==t.getTime()?" ui-state-highlight":"")+(Q.getTime()>=c.getTime()&&Q.getTime()<=P.getTime()?" ui-state-active":"")+'" href="#">'+Q.getDate()+"</a>")+"</td>";Q.setDate(Q.getDate()+1);Q=this._daylightSavingAdjust(Q)}U+=Y+"</tr>"}d++;if(d>11){d=0;v++}U+="</tbody></table>"+(l?"</div>"+(o[0]>0&&I==o[1]-1?'<div class="ui-datepicker-row-break"></div>':""):"");F+=U}B+=F}B+=T+($.browser.msie&&parseInt($.browser.version,10)<7&&!e.inline?'<iframe src="javascript:false;" class="ui-datepicker-cover" frameborder="0"></iframe>':"");e._keyEvent=false;return B},_generateMonthYearHeader:function(e,t,n,r,i,s,o,u,a){r=e.rangeStart&&r&&s<r?s:r;var f=this._get(e,"changeMonth");var l=this._get(e,"changeYear");var c=this._get(e,"showMonthAfterYear");var h='<div class="ui-datepicker-title">';var p="";if(o||!f)p+='<span class="ui-datepicker-month">'+u[t]+"</span> ";else{var d=r&&r.getFullYear()==n;var v=i&&i.getFullYear()==n;p+='<select class="ui-datepicker-month" '+"onchange=\"DP_jqcc.datepicker._selectMonthYear('#"+e.id+"', this, 'M');\" "+"onclick=\"DP_jqcc.datepicker._clickMonthYear('#"+e.id+"');\""+">";for(var m=0;m<12;m++){if((!d||m>=r.getMonth())&&(!v||m<=i.getMonth()))p+='<option value="'+m+'"'+(m==t?' selected="selected"':"")+">"+a[m]+"</option>"}p+="</select>"}if(!c)h+=p+((o||f||l)&&!(f&&l)?"&#xa0;":"");if(o||!l)h+='<span class="ui-datepicker-year">'+n+"</span>";else{var g=this._get(e,"yearRange").split(":");var y=0;var b=0;if(g.length!=2){y=n-10;b=n+10}else if(g[0].charAt(0)=="+"||g[0].charAt(0)=="-"){y=n+parseInt(g[0],10);b=n+parseInt(g[1],10)}else{y=parseInt(g[0],10);b=parseInt(g[1],10)}y=r?Math.max(y,r.getFullYear()):y;b=i?Math.min(b,i.getFullYear()):b;h+='<select class="ui-datepicker-year" '+"onchange=\"DP_jqcc.datepicker._selectMonthYear('#"+e.id+"', this, 'Y');\" "+"onclick=\"DP_jqcc.datepicker._clickMonthYear('#"+e.id+"');\""+">";for(;y<=b;y++){h+='<option value="'+y+'"'+(y==n?' selected="selected"':"")+">"+y+"</option>"}h+="</select>"}if(c)h+=(o||f||l?"&#xa0;":"")+p;h+="</div>";return h},_adjustInstDate:function(e,t,n){var r=e.drawYear+(n=="Y"?t:0);var i=e.drawMonth+(n=="M"?t:0);var s=Math.min(e.selectedDay,this._getDaysInMonth(r,i))+(n=="D"?t:0);var o=this._daylightSavingAdjust(new Date(r,i,s));var u=this._getMinMaxDate(e,"min",true);var a=this._getMinMaxDate(e,"max");o=u&&o<u?u:o;o=a&&o>a?a:o;e.selectedDay=o.getDate();e.drawMonth=e.selectedMonth=o.getMonth();e.drawYear=e.selectedYear=o.getFullYear();if(n=="M"||n=="Y")this._notifyChange(e)},_notifyChange:function(e){var t=this._get(e,"onChangeMonthYear");if(t)t.apply(e.input?e.input[0]:null,[e.selectedYear,e.selectedMonth+1,e])},_getNumberOfMonths:function(e){var t=this._get(e,"numberOfMonths");return t==null?[1,1]:typeof t=="number"?[1,t]:t},_getMinMaxDate:function(e,t,n){var r=this._determineDate(this._get(e,t+"Date"),null);return!n||!e.rangeStart?r:!r||e.rangeStart>r?e.rangeStart:r},_getDaysInMonth:function(e,t){return 32-(new Date(e,t,32)).getDate()},_getFirstDayOfMonth:function(e,t){return(new Date(e,t,1)).getDay()},_canAdjustMonth:function(e,t,n,r){var i=this._getNumberOfMonths(e);var s=this._daylightSavingAdjust(new Date(n,r+(t<0?t:i[1]),1));if(t<0)s.setDate(this._getDaysInMonth(s.getFullYear(),s.getMonth()));return this._isInRange(e,s)},_isInRange:function(e,t){var n=!e.rangeStart?null:this._daylightSavingAdjust(new Date(e.selectedYear,e.selectedMonth,e.selectedDay));n=n&&e.rangeStart<n?e.rangeStart:n;var r=n||this._getMinMaxDate(e,"min");var i=this._getMinMaxDate(e,"max");return(!r||t>=r)&&(!i||t<=i)},_getFormatConfig:function(e){var t=this._get(e,"shortYearCutoff");t=typeof t!="string"?t:(new Date).getFullYear()%100+parseInt(t,10);return{shortYearCutoff:t,dayNamesShort:this._get(e,"dayNamesShort"),dayNames:this._get(e,"dayNames"),monthNamesShort:this._get(e,"monthNamesShort"),monthNames:this._get(e,"monthNames")}},_formatDate:function(e,t,n,r){if(!t){e.currentDay=e.selectedDay;e.currentMonth=e.selectedMonth;e.currentYear=e.selectedYear}var i=t?typeof t=="object"?t:this._daylightSavingAdjust(new Date(r,n,t)):this._daylightSavingAdjust(new Date(e.currentYear,e.currentMonth,e.currentDay));return this.formatDate(this._get(e,"dateFormat"),i,this._getFormatConfig(e))}});$.fn.datepicker=function(e){if(!$.datepicker.initialized){$(document).mousedown($.datepicker._checkExternalClick).find("body").append($.datepicker.dpDiv);$.datepicker.initialized=true}var t=Array.prototype.slice.call(arguments,1);if(typeof e=="string"&&(e=="isDisabled"||e=="getDate"))return $.datepicker["_"+e+"Datepicker"].apply($.datepicker,[this[0]].concat(t));return this.each(function(){typeof e=="string"?$.datepicker["_"+e+"Datepicker"].apply($.datepicker,[this].concat(t)):$.datepicker._attachDatepicker(this,e)})};$.datepicker=new Datepicker;$.datepicker.initialized=false;$.datepicker.uuid=(new Date).getTime();$.datepicker.version="1.7.1";window.DP_jqcc=$})(jqcc);(function(e){var t={dragStart:"start.draggable",drag:"drag.draggable",dragStop:"stop.draggable",maxHeight:"maxHeight.resizable",minHeight:"minHeight.resizable",maxWidth:"maxWidth.resizable",minWidth:"minWidth.resizable",resizeStart:"start.resizable",resize:"drag.resizable",resizeStop:"stop.resizable"},n="ui-dialog "+"ui-widget "+"ui-widget-content "+"ui-corner-all ";e.widget("ui.dialog",{_init:function(){this.originalTitle=this.element.attr("title");var t=this,r=this.options,i=r.title||this.originalTitle||"&nbsp;",s=e.ui.dialog.getTitleId(this.element),o=(this.uiDialog=e("<div/>")).appendTo(document.body).hide().addClass(n+r.dialogClass).css({position:"absolute",overflow:"hidden",zIndex:r.zIndex}).attr("tabIndex",-1).css("outline",0).keydown(function(n){r.closeOnEscape&&n.keyCode&&n.keyCode==e.ui.keyCode.ESCAPE&&t.close(n)}).attr({role:"dialog","aria-labelledby":s}).mousedown(function(e){t.moveToTop(false,e)}),u=this.element.show().removeAttr("title").addClass("ui-dialog-content "+"ui-widget-content").appendTo(o),a=(this.uiDialogTitlebar=e("<div></div>")).addClass("ui-dialog-titlebar "+"ui-widget-header "+"ui-corner-all "+"ui-helper-clearfix").prependTo(o),f=e('<a href="#"/>').addClass("ui-dialog-titlebar-close "+"ui-corner-all").attr("role","button").hover(function(){f.addClass("ui-state-hover")},function(){f.removeClass("ui-state-hover")}).focus(function(){f.addClass("ui-state-focus")}).blur(function(){f.removeClass("ui-state-focus")}).mousedown(function(e){e.stopPropagation()}).click(function(e){t.close(e);return false}).appendTo(a),l=(this.uiDialogTitlebarCloseText=e("<span/>")).addClass("ui-icon "+"ui-icon-closethick").text(r.closeText).appendTo(f),c=e("<span/>").addClass("ui-dialog-title").attr("id",s).html(i).prependTo(a);a.find("*").add(a).disableSelection();r.draggable&&e.fn.draggable&&this._makeDraggable();r.resizable&&e.fn.resizable&&this._makeResizable();this._createButtons(r.buttons);this._isOpen=false;r.bgiframe&&e.fn.bgiframe&&o.bgiframe();r.autoOpen&&this.open()},destroy:function(){this.overlay&&this.overlay.destroy();this.uiDialog.hide();this.element.unbind(".dialog").removeData("dialog").removeClass("ui-dialog-content ui-widget-content").hide().appendTo("body");this.uiDialog.remove();this.originalTitle&&this.element.attr("title",this.originalTitle)},close:function(t){var n=this;if(false===n._trigger("beforeclose",t)){return}n.overlay&&n.overlay.destroy();n.uiDialog.unbind("keypress.ui-dialog");n.options.hide?n.uiDialog.hide(n.options.hide,function(){n._trigger("close",t)}):n.uiDialog.hide()&&n._trigger("close",t);e.ui.dialog.overlay.resize();n._isOpen=false},isOpen:function(){return this._isOpen},moveToTop:function(t,n){if(this.options.modal&&!t||!this.options.stack&&!this.options.modal){return this._trigger("focus",n)}if(this.options.zIndex>e.ui.dialog.maxZ){e.ui.dialog.maxZ=this.options.zIndex}this.overlay&&this.overlay.$el.css("z-index",e.ui.dialog.overlay.maxZ=++e.ui.dialog.maxZ);var r={scrollTop:this.element.attr("scrollTop"),scrollLeft:this.element.attr("scrollLeft")};this.uiDialog.css("z-index",++e.ui.dialog.maxZ);this.element.attr(r);this._trigger("focus",n)},open:function(){if(this._isOpen){return}var t=this.options,n=this.uiDialog;this.overlay=t.modal?new e.ui.dialog.overlay(this):null;n.next().length&&n.appendTo("body");this._size();this._position(t.position);n.show(t.show);this.moveToTop(true);t.modal&&n.bind("keypress.ui-dialog",function(t){if(t.keyCode!=e.ui.keyCode.TAB){return}var n=e(":tabbable",this),r=n.filter(":first")[0],i=n.filter(":last")[0];if(t.target==i&&!t.shiftKey){setTimeout(function(){r.focus()},1)}else if(t.target==r&&t.shiftKey){setTimeout(function(){i.focus()},1)}});e([]).add(n.find(".ui-dialog-content :tabbable:first")).add(n.find(".ui-dialog-buttonpane :tabbable:first")).add(n).filter(":first").focus();this._trigger("open");this._isOpen=true},_createButtons:function(t){var n=this,r=false,i=e("<div></div>").addClass("ui-dialog-buttonpane "+"ui-widget-content "+"ui-helper-clearfix");this.uiDialog.find(".ui-dialog-buttonpane").remove();typeof t=="object"&&t!==null&&e.each(t,function(){return!(r=true)});if(r){e.each(t,function(t,r){e('<button type="button"></button>').addClass("ui-state-default "+"ui-corner-all").text(t).click(function(){r.apply(n.element[0],arguments)}).hover(function(){e(this).addClass("ui-state-hover")},function(){e(this).removeClass("ui-state-hover")}).focus(function(){e(this).addClass("ui-state-focus")}).blur(function(){e(this).removeClass("ui-state-focus")}).appendTo(i)});i.appendTo(this.uiDialog)}},_makeDraggable:function(){var t=this,n=this.options,r;this.uiDialog.draggable({cancel:".ui-dialog-content",handle:".ui-dialog-titlebar",containment:"document",start:function(){r=n.height;e(this).height(e(this).height()).addClass("ui-dialog-dragging");n.dragStart&&n.dragStart.apply(t.element[0],arguments)},drag:function(){n.drag&&n.drag.apply(t.element[0],arguments)},stop:function(){e(this).removeClass("ui-dialog-dragging").height(r);n.dragStop&&n.dragStop.apply(t.element[0],arguments);e.ui.dialog.overlay.resize()}})},_makeResizable:function(t){t=t===undefined?this.options.resizable:t;var n=this,r=this.options,i=typeof t=="string"?t:"n,e,s,w,se,sw,ne,nw";this.uiDialog.resizable({cancel:".ui-dialog-content",alsoResize:this.element,maxWidth:r.maxWidth,maxHeight:r.maxHeight,minWidth:r.minWidth,minHeight:r.minHeight,start:function(){e(this).addClass("ui-dialog-resizing");r.resizeStart&&r.resizeStart.apply(n.element[0],arguments)},resize:function(){r.resize&&r.resize.apply(n.element[0],arguments)},handles:i,stop:function(){e(this).removeClass("ui-dialog-resizing");r.height=e(this).height();r.width=e(this).width();r.resizeStop&&r.resizeStop.apply(n.element[0],arguments);e.ui.dialog.overlay.resize()}}).find(".ui-resizable-se").addClass("ui-icon ui-icon-grip-diagonal-se")},_position:function(t){var n=e(window),r=e(document),i=r.scrollTop(),s=r.scrollLeft(),o=i;if(e.inArray(t,["center","top","right","bottom","left"])>=0){t=[t=="right"||t=="left"?t:"center",t=="top"||t=="bottom"?t:"middle"]}if(t.constructor!=Array){t=["center","middle"]}if(t[0].constructor==Number){s+=t[0]}else{switch(t[0]){case"left":s+=0;break;case"right":s+=n.width()-this.uiDialog.outerWidth();break;default:case"center":s+=(n.width()-this.uiDialog.outerWidth())/2}}if(t[1].constructor==Number){i+=t[1]}else{switch(t[1]){case"top":i+=0;break;case"bottom":i+=n.height()-this.uiDialog.outerHeight();break;default:case"middle":i+=(n.height()-this.uiDialog.outerHeight())/2}}i=Math.max(i,o);this.uiDialog.css({top:i,left:s})},_setData:function(r,i){t[r]&&this.uiDialog.data(t[r],i);switch(r){case"buttons":this._createButtons(i);break;case"closeText":this.uiDialogTitlebarCloseText.text(i);break;case"dialogClass":this.uiDialog.removeClass(this.options.dialogClass).addClass(n+i);break;case"draggable":i?this._makeDraggable():this.uiDialog.draggable("destroy");break;case"height":this.uiDialog.height(i);break;case"position":this._position(i);break;case"resizable":var s=this.uiDialog,o=this.uiDialog.is(":data(resizable)");o&&!i&&s.resizable("destroy");o&&typeof i=="string"&&s.resizable("option","handles",i);o||this._makeResizable(i);break;case"title":e(".ui-dialog-title",this.uiDialogTitlebar).html(i||"&nbsp;");break;case"width":this.uiDialog.width(i);break}e.widget.prototype._setData.apply(this,arguments)},_size:function(){var e=this.options;this.element.css({height:0,minHeight:0,width:"auto"});var t=this.uiDialog.css({height:"auto",width:e.width}).height();this.element.css({minHeight:Math.max(e.minHeight-t,0),height:e.height=="auto"?"auto":Math.max(e.height-t,0)})}});e.extend(e.ui.dialog,{version:"1.7.1",defaults:{autoOpen:true,bgiframe:false,buttons:{},closeOnEscape:true,closeText:"close",dialogClass:"",draggable:true,hide:null,height:"auto",maxHeight:false,maxWidth:false,minHeight:150,minWidth:150,modal:false,position:"center",resizable:true,show:null,stack:true,title:"",width:300,zIndex:1e3},getter:"isOpen",uuid:0,maxZ:0,getTitleId:function(e){return"ui-dialog-title-"+(e.attr("id")||++this.uuid)},overlay:function(t){this.$el=e.ui.dialog.overlay.create(t)}});e.extend(e.ui.dialog.overlay,{instances:[],maxZ:0,events:e.map("focus,mousedown,mouseup,keydown,keypress,click".split(","),function(e){return e+".dialog-overlay"}).join(" "),create:function(t){if(this.instances.length===0){setTimeout(function(){e(document).bind(e.ui.dialog.overlay.events,function(t){var n=e(t.target).parents(".ui-dialog").css("zIndex")||0;return n>e.ui.dialog.overlay.maxZ})},1);e(document).bind("keydown.dialog-overlay",function(n){t.options.closeOnEscape&&n.keyCode&&n.keyCode==e.ui.keyCode.ESCAPE&&t.close(n)});e(window).bind("resize.dialog-overlay",e.ui.dialog.overlay.resize)}var n=e("<div></div>").appendTo(document.body).addClass("ui-widget-overlay").css({width:this.width(),height:this.height()});t.options.bgiframe&&e.fn.bgiframe&&n.bgiframe();this.instances.push(n);return n},destroy:function(t){this.instances.splice(e.inArray(this.instances,t),1);if(this.instances.length===0){e([document,window]).unbind(".dialog-overlay")}t.remove()},height:function(){if(e.browser.msie&&e.browser.version<7){var t=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight);var n=Math.max(document.documentElement.offsetHeight,document.body.offsetHeight);if(t<n){return e(window).height()+"px"}else{return t+"px"}}else{return e(document).height()+"px"}},width:function(){if(e.browser.msie&&e.browser.version<7){var t=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth);var n=Math.max(document.documentElement.offsetWidth,document.body.offsetWidth);if(t<n){return e(window).width()+"px"}else{return t+"px"}}else{return e(document).width()+"px"}},resize:function(){var t=e([]);e.each(e.ui.dialog.overlay.instances,function(){t=t.add(this)});t.css({width:0,height:0}).css({width:e.ui.dialog.overlay.width(),height:e.ui.dialog.overlay.height()})}});e.extend(e.ui.dialog.overlay.prototype,{destroy:function(){e.ui.dialog.overlay.destroy(this.$el)}})})(jqcc);(function(e){e.widget("ui.progressbar",{_init:function(){this.element.addClass("ui-progressbar"+" ui-widget"+" ui-widget-content"+" ui-corner-all").attr({role:"progressbar","aria-valuemin":this._valueMin(),"aria-valuemax":this._valueMax(),"aria-valuenow":this._value()});this.valueDiv=e('<div class="ui-progressbar-value ui-widget-header ui-corner-left"></div>').appendTo(this.element);this._refreshValue()},destroy:function(){this.element.removeClass("ui-progressbar"+" ui-widget"+" ui-widget-content"+" ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow").removeData("progressbar").unbind(".progressbar");this.valueDiv.remove();e.widget.prototype.destroy.apply(this,arguments)},value:function(e){arguments.length&&this._setData("value",e);return this._value()},_setData:function(t,n){switch(t){case"value":this.options.value=n;this._refreshValue();this._trigger("change",null,{});break}e.widget.prototype._setData.apply(this,arguments)},_value:function(){var e=this.options.value;if(e<this._valueMin())e=this._valueMin();if(e>this._valueMax())e=this._valueMax();return e},_valueMin:function(){var e=0;return e},_valueMax:function(){var e=100;return e},_refreshValue:function(){var e=this.value();this.valueDiv[e==this._valueMax()?"addClass":"removeClass"]("ui-corner-right");this.valueDiv.width(e+"%");this.element.attr("aria-valuenow",e)}});e.extend(e.ui.progressbar,{version:"1.7.1",defaults:{value:0}})})(jqcc);(function(e){e.widget("ui.slider",e.extend({},e.ui.mouse,{_init:function(){var t=this,n=this.options;this._keySliding=false;this._handleIndex=null;this._detectOrientation();this._mouseInit();this.element.addClass("ui-slider"+" ui-slider-"+this.orientation+" ui-widget"+" ui-widget-content"+" ui-corner-all");this.range=e([]);if(n.range){if(n.range===true){this.range=e("<div></div>");if(!n.values)n.values=[this._valueMin(),this._valueMin()];if(n.values.length&&n.values.length!=2){n.values=[n.values[0],n.values[0]]}}else{this.range=e("<div></div>")}this.range.appendTo(this.element).addClass("ui-slider-range");if(n.range=="min"||n.range=="max"){this.range.addClass("ui-slider-range-"+n.range)}this.range.addClass("ui-widget-header")}if(e(".ui-slider-handle",this.element).length==0)e('<a href="#"></a>').appendTo(this.element).addClass("ui-slider-handle");if(n.values&&n.values.length){while(e(".ui-slider-handle",this.element).length<n.values.length)e('<a href="#"></a>').appendTo(this.element).addClass("ui-slider-handle")}this.handles=e(".ui-slider-handle",this.element).addClass("ui-state-default"+" ui-corner-all");this.handle=this.handles.eq(0);this.handles.add(this.range).filter("a").click(function(e){e.preventDefault()}).hover(function(){e(this).addClass("ui-state-hover")},function(){e(this).removeClass("ui-state-hover")}).focus(function(){e(".ui-slider .ui-state-focus").removeClass("ui-state-focus");e(this).addClass("ui-state-focus")}).blur(function(){e(this).removeClass("ui-state-focus")});this.handles.each(function(t){e(this).data("index.ui-slider-handle",t)});this.handles.keydown(function(n){var r=true;var i=e(this).data("index.ui-slider-handle");if(t.options.disabled)return;switch(n.keyCode){case e.ui.keyCode.HOME:case e.ui.keyCode.END:case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:r=false;if(!t._keySliding){t._keySliding=true;e(this).addClass("ui-state-active");t._start(n,i)}break}var s,o,u=t._step();if(t.options.values&&t.options.values.length){s=o=t.values(i)}else{s=o=t.value()}switch(n.keyCode){case e.ui.keyCode.HOME:o=t._valueMin();break;case e.ui.keyCode.END:o=t._valueMax();break;case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:if(s==t._valueMax())return;o=s+u;break;case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:if(s==t._valueMin())return;o=s-u;break}t._slide(n,i,o);return r}).keyup(function(n){var r=e(this).data("index.ui-slider-handle");if(t._keySliding){t._stop(n,r);t._change(n,r);t._keySliding=false;e(this).removeClass("ui-state-active")}});this._refreshValue()},destroy:function(){this.handles.remove();this.range.remove();this.element.removeClass("ui-slider"+" ui-slider-horizontal"+" ui-slider-vertical"+" ui-slider-disabled"+" ui-widget"+" ui-widget-content"+" ui-corner-all").removeData("slider").unbind(".slider");this._mouseDestroy()},_mouseCapture:function(t){var n=this.options;if(n.disabled)return false;this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()};this.elementOffset=this.element.offset();var r={x:t.pageX,y:t.pageY};var i=this._normValueFromMouse(r);var s=this._valueMax()-this._valueMin()+1,o;var u=this,a;this.handles.each(function(t){var n=Math.abs(i-u.values(t));if(s>n){s=n;o=e(this);a=t}});if(n.range==true&&this.values(1)==n.min){o=e(this.handles[++a])}this._start(t,a);u._handleIndex=a;o.addClass("ui-state-active").focus();var f=o.offset();var l=!e(t.target).parents().andSelf().is(".ui-slider-handle");this._clickOffset=l?{left:0,top:0}:{left:t.pageX-f.left-o.width()/2,top:t.pageY-f.top-o.height()/2-(parseInt(o.css("borderTopWidth"),10)||0)-(parseInt(o.css("borderBottomWidth"),10)||0)+(parseInt(o.css("marginTop"),10)||0)};i=this._normValueFromMouse(r);this._slide(t,a,i);return true},_mouseStart:function(e){return true},_mouseDrag:function(e){var t={x:e.pageX,y:e.pageY};var n=this._normValueFromMouse(t);this._slide(e,this._handleIndex,n);return false},_mouseStop:function(e){this.handles.removeClass("ui-state-active");this._stop(e,this._handleIndex);this._change(e,this._handleIndex);this._handleIndex=null;this._clickOffset=null;return false},_detectOrientation:function(){this.orientation=this.options.orientation=="vertical"?"vertical":"horizontal"},_normValueFromMouse:function(e){var t,n;if("horizontal"==this.orientation){t=this.elementSize.width;n=e.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)}else{t=this.elementSize.height;n=e.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)}var r=n/t;if(r>1)r=1;if(r<0)r=0;if("vertical"==this.orientation)r=1-r;var i=this._valueMax()-this._valueMin(),s=r*i,o=s%this.options.step,u=this._valueMin()+s-o;if(o>this.options.step/2)u+=this.options.step;return parseFloat(u.toFixed(5))},_start:function(e,t){var n={handle:this.handles[t],value:this.value()};if(this.options.values&&this.options.values.length){n.value=this.values(t);n.values=this.values()}this._trigger("start",e,n)},_slide:function(e,t,n){var r=this.handles[t];if(this.options.values&&this.options.values.length){var i=this.values(t?0:1);if(t==0&&n>=i||t==1&&n<=i)n=i;if(n!=this.values(t)){var s=this.values();s[t]=n;var o=this._trigger("slide",e,{handle:this.handles[t],value:n,values:s});var i=this.values(t?0:1);if(o!==false){this.values(t,n,e.type=="mousedown"&&this.options.animate,true)}}}else{if(n!=this.value()){var o=this._trigger("slide",e,{handle:this.handles[t],value:n});if(o!==false){this._setData("value",n,e.type=="mousedown"&&this.options.animate)}}}},_stop:function(e,t){var n={handle:this.handles[t],value:this.value()};if(this.options.values&&this.options.values.length){n.value=this.values(t);n.values=this.values()}this._trigger("stop",e,n)},_change:function(e,t){var n={handle:this.handles[t],value:this.value()};if(this.options.values&&this.options.values.length){n.value=this.values(t);n.values=this.values()}this._trigger("change",e,n)},value:function(e){if(arguments.length){this._setData("value",e);this._change(null,0)}return this._value()},values:function(e,t,n,r){if(arguments.length>1){this.options.values[e]=t;this._refreshValue(n);if(!r)this._change(null,e)}if(arguments.length){if(this.options.values&&this.options.values.length){return this._values(e)}else{return this.value()}}else{return this._values()}},_setData:function(t,n,r){e.widget.prototype._setData.apply(this,arguments);switch(t){case"orientation":this._detectOrientation();this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation);this._refreshValue(r);break;case"value":this._refreshValue(r);break}},_step:function(){var e=this.options.step;return e},_value:function(){var e=this.options.value;if(e<this._valueMin())e=this._valueMin();if(e>this._valueMax())e=this._valueMax();return e},_values:function(e){if(arguments.length){var t=this.options.values[e];if(t<this._valueMin())t=this._valueMin();if(t>this._valueMax())t=this._valueMax();return t}else{return this.options.values}},_valueMin:function(){var e=this.options.min;return e},_valueMax:function(){var e=this.options.max;return e},_refreshValue:function(t){var n=this.options.range,r=this.options,i=this;if(this.options.values&&this.options.values.length){var s,o;this.handles.each(function(n,s){var o=(i.values(n)-i._valueMin())/(i._valueMax()-i._valueMin())*100;var u={};u[i.orientation=="horizontal"?"left":"bottom"]=o+"%";e(this).stop(1,1)[t?"animate":"css"](u,r.animate);if(i.options.range===true){if(i.orientation=="horizontal"){n==0&&i.range.stop(1,1)[t?"animate":"css"]({left:o+"%"},r.animate);n==1&&i.range[t?"animate":"css"]({width:o-lastValPercent+"%"},{queue:false,duration:r.animate})}else{n==0&&i.range.stop(1,1)[t?"animate":"css"]({bottom:o+"%"},r.animate);n==1&&i.range[t?"animate":"css"]({height:o-lastValPercent+"%"},{queue:false,duration:r.animate})}}lastValPercent=o})}else{var u=this.value(),a=this._valueMin(),f=this._valueMax(),l=f!=a?(u-a)/(f-a)*100:0;var c={};c[i.orientation=="horizontal"?"left":"bottom"]=l+"%";this.handle.stop(1,1)[t?"animate":"css"](c,r.animate);n=="min"&&this.orientation=="horizontal"&&this.range.stop(1,1)[t?"animate":"css"]({width:l+"%"},r.animate);n=="max"&&this.orientation=="horizontal"&&this.range[t?"animate":"css"]({width:100-l+"%"},{queue:false,duration:r.animate});n=="min"&&this.orientation=="vertical"&&this.range.stop(1,1)[t?"animate":"css"]({height:l+"%"},r.animate);n=="max"&&this.orientation=="vertical"&&this.range[t?"animate":"css"]({height:100-l+"%"},{queue:false,duration:r.animate})}}}));e.extend(e.ui.slider,{getter:"value values",version:"1.7.1",eventPrefix:"slide",defaults:{animate:false,delay:0,distance:0,max:100,min:0,orientation:"horizontal",range:false,step:1,value:0,values:null}})})(jqcc);(function(e){e.widget("ui.tabs",{_init:function(){if(this.options.deselectable!==undefined){this.options.collapsible=this.options.deselectable}this._tabify(true)},_setData:function(e,t){if(e=="selected"){if(this.options.collapsible&&t==this.options.selected){return}this.select(t)}else{this.options[e]=t;if(e=="deselectable"){this.options.collapsible=t}this._tabify()}},_tabId:function(t){return t.title&&t.title.replace(/\s/g,"_").replace(/[^A-Za-z0-9\-_:\.]/g,"")||this.options.idPrefix+e.data(t)},_sanitizeSelector:function(e){return e.replace(/:/g,"\\:")},_cookie:function(){var t=this.cookie||(this.cookie=this.options.cookie.name||"ui-tabs-"+e.data(this.list[0]));return e.cookie.apply(null,[t].concat(e.makeArray(arguments)))},_ui:function(e,t){return{tab:e,panel:t,index:this.anchors.index(e)}},_cleanup:function(){this.lis.filter(".ui-state-processing").removeClass("ui-state-processing").find("span:data(label.tabs)").each(function(){var t=e(this);t.html(t.data("label.tabs")).removeData("label.tabs")})},_tabify:function(t){function c(t,n){t.css({display:""});if(e.browser.msie&&n.opacity){t[0].style.removeAttribute("filter")}}this.list=this.element.children("ul:first");this.lis=e("li:has(a[href])",this.list);this.anchors=this.lis.map(function(){return e("a",this)[0]});this.panels=e([]);var n=this,r=this.options;var i=/^#.+/;this.anchors.each(function(t,s){var o=e(s).attr("href");var u=o.split("#")[0],a;if(u&&(u===location.toString().split("#")[0]||(a=e("base")[0])&&u===a.href)){o=s.hash;s.href=o}if(i.test(o)){n.panels=n.panels.add(n._sanitizeSelector(o))}else if(o!="#"){e.data(s,"href.tabs",o);e.data(s,"load.tabs",o.replace(/#.*$/,""));var f=n._tabId(s);s.href="#"+f;var l=e("#"+f);if(!l.length){l=e(r.panelTemplate).attr("id",f).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").insertAfter(n.panels[t-1]||n.list);l.data("destroy.tabs",true)}n.panels=n.panels.add(l)}else{r.disabled.push(t)}});if(t){this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all");this.list.addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all");this.lis.addClass("ui-state-default ui-corner-top");this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom");if(r.selected===undefined){if(location.hash){this.anchors.each(function(e,t){if(t.hash==location.hash){r.selected=e;return false}})}if(typeof r.selected!="number"&&r.cookie){r.selected=parseInt(n._cookie(),10)}if(typeof r.selected!="number"&&this.lis.filter(".ui-tabs-selected").length){r.selected=this.lis.index(this.lis.filter(".ui-tabs-selected"))}r.selected=r.selected||0}else if(r.selected===null){r.selected=-1}r.selected=r.selected>=0&&this.anchors[r.selected]||r.selected<0?r.selected:0;r.disabled=e.unique(r.disabled.concat(e.map(this.lis.filter(".ui-state-disabled"),function(e,t){return n.lis.index(e)}))).sort();if(e.inArray(r.selected,r.disabled)!=-1){r.disabled.splice(e.inArray(r.selected,r.disabled),1)}this.panels.addClass("ui-tabs-hide");this.lis.removeClass("ui-tabs-selected ui-state-active");if(r.selected>=0&&this.anchors.length){this.panels.eq(r.selected).removeClass("ui-tabs-hide");this.lis.eq(r.selected).addClass("ui-tabs-selected ui-state-active");n.element.queue("tabs",function(){n._trigger("show",null,n._ui(n.anchors[r.selected],n.panels[r.selected]))});this.load(r.selected)}e(window).bind("unload",function(){n.lis.add(n.anchors).unbind(".tabs");n.lis=n.anchors=n.panels=null})}else{r.selected=this.lis.index(this.lis.filter(".ui-tabs-selected"))}this.element[r.collapsible?"addClass":"removeClass"]("ui-tabs-collapsible");if(r.cookie){this._cookie(r.selected,r.cookie)}for(var s=0,o;o=this.lis[s];s++){e(o)[e.inArray(s,r.disabled)!=-1&&!e(o).hasClass("ui-tabs-selected")?"addClass":"removeClass"]("ui-state-disabled")}if(r.cache===false){this.anchors.removeData("cache.tabs")}this.lis.add(this.anchors).unbind(".tabs");if(r.event!="mouseover"){var u=function(e,t){if(t.is(":not(.ui-state-disabled)")){t.addClass("ui-state-"+e)}};var a=function(e,t){t.removeClass("ui-state-"+e)};this.lis.bind("mouseover.tabs",function(){u("hover",e(this))});this.lis.bind("mouseout.tabs",function(){a("hover",e(this))});this.anchors.bind("focus.tabs",function(){u("focus",e(this).closest("li"))});this.anchors.bind("blur.tabs",function(){a("focus",e(this).closest("li"))})}var f,l;if(r.fx){if(e.isArray(r.fx)){f=r.fx[0];l=r.fx[1]}else{f=l=r.fx}}var h=l?function(t,r){e(t).closest("li").removeClass("ui-state-default").addClass("ui-tabs-selected ui-state-active");r.hide().removeClass("ui-tabs-hide").animate(l,l.duration||"normal",function(){c(r,l);n._trigger("show",null,n._ui(t,r[0]))})}:function(t,r){e(t).closest("li").removeClass("ui-state-default").addClass("ui-tabs-selected ui-state-active");r.removeClass("ui-tabs-hide");n._trigger("show",null,n._ui(t,r[0]))};var p=f?function(e,t){t.animate(f,f.duration||"normal",function(){n.lis.removeClass("ui-tabs-selected ui-state-active").addClass("ui-state-default");t.addClass("ui-tabs-hide");c(t,f);n.element.dequeue("tabs")})}:function(e,t,r){n.lis.removeClass("ui-tabs-selected ui-state-active").addClass("ui-state-default");t.addClass("ui-tabs-hide");n.element.dequeue("tabs")};this.anchors.bind(r.event+".tabs",function(){var t=this,i=e(this).closest("li"),s=n.panels.filter(":not(.ui-tabs-hide)"),o=e(n._sanitizeSelector(this.hash));if(i.hasClass("ui-tabs-selected")&&!r.collapsible||i.hasClass("ui-state-disabled")||i.hasClass("ui-state-processing")||n._trigger("select",null,n._ui(this,o[0]))===false){this.blur();return false}r.selected=n.anchors.index(this);n.abort();if(r.collapsible){if(i.hasClass("ui-tabs-selected")){r.selected=-1;if(r.cookie){n._cookie(r.selected,r.cookie)}n.element.queue("tabs",function(){p(t,s)}).dequeue("tabs");this.blur();return false}else if(!s.length){if(r.cookie){n._cookie(r.selected,r.cookie)}n.element.queue("tabs",function(){h(t,o)});n.load(n.anchors.index(this));this.blur();return false}}if(r.cookie){n._cookie(r.selected,r.cookie)}if(o.length){if(s.length){n.element.queue("tabs",function(){p(t,s)})}n.element.queue("tabs",function(){h(t,o)});n.load(n.anchors.index(this))}else{throw"jqcc UI Tabs: Mismatching fragment identifier."}if(e.browser.msie){this.blur()}});this.anchors.bind("click.tabs",function(){return false})},destroy:function(){var t=this.options;this.abort();this.element.unbind(".tabs").removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible").removeData("tabs");this.list.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all");this.anchors.each(function(){var t=e.data(this,"href.tabs");if(t){this.href=t}var n=e(this).unbind(".tabs");e.each(["href","load","cache"],function(e,t){n.removeData(t+".tabs")})});this.lis.unbind(".tabs").add(this.panels).each(function(){if(e.data(this,"destroy.tabs")){e(this).remove()}else{e(this).removeClass(["ui-state-default","ui-corner-top","ui-tabs-selected","ui-state-active","ui-state-hover","ui-state-focus","ui-state-disabled","ui-tabs-panel","ui-widget-content","ui-corner-bottom","ui-tabs-hide"].join(" "))}});if(t.cookie){this._cookie(null,t.cookie)}},add:function(t,n,r){if(r===undefined){r=this.anchors.length}var i=this,s=this.options,o=e(s.tabTemplate.replace(/#\{href\}/g,t).replace(/#\{label\}/g,n)),u=!t.indexOf("#")?t.replace("#",""):this._tabId(e("a",o)[0]);o.addClass("ui-state-default ui-corner-top").data("destroy.tabs",true);var a=e("#"+u);if(!a.length){a=e(s.panelTemplate).attr("id",u).data("destroy.tabs",true)}a.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide");if(r>=this.lis.length){o.appendTo(this.list);a.appendTo(this.list[0].parentNode)}else{o.insertBefore(this.lis[r]);a.insertBefore(this.panels[r])}s.disabled=e.map(s.disabled,function(e,t){return e>=r?++e:e});this._tabify();if(this.anchors.length==1){o.addClass("ui-tabs-selected ui-state-active");a.removeClass("ui-tabs-hide");this.element.queue("tabs",function(){i._trigger("show",null,i._ui(i.anchors[0],i.panels[0]))});this.load(0)}this._trigger("add",null,this._ui(this.anchors[r],this.panels[r]))},remove:function(t){var n=this.options,r=this.lis.eq(t).remove(),i=this.panels.eq(t).remove();if(r.hasClass("ui-tabs-selected")&&this.anchors.length>1){this.select(t+(t+1<this.anchors.length?1:-1))}n.disabled=e.map(e.grep(n.disabled,function(e,n){return e!=t}),function(e,n){return e>=t?--e:e});this._tabify();this._trigger("remove",null,this._ui(r.find("a")[0],i[0]))},enable:function(t){var n=this.options;if(e.inArray(t,n.disabled)==-1){return}this.lis.eq(t).removeClass("ui-state-disabled");n.disabled=e.grep(n.disabled,function(e,n){return e!=t});this._trigger("enable",null,this._ui(this.anchors[t],this.panels[t]))},disable:function(e){var t=this,n=this.options;if(e!=n.selected){this.lis.eq(e).addClass("ui-state-disabled");n.disabled.push(e);n.disabled.sort();this._trigger("disable",null,this._ui(this.anchors[e],this.panels[e]))}},select:function(e){if(typeof e=="string"){e=this.anchors.index(this.anchors.filter("[href$="+e+"]"))}else if(e===null){e=-1}if(e==-1&&this.options.collapsible){e=this.options.selected}this.anchors.eq(e).trigger(this.options.event+".tabs")},load:function(t){var n=this,r=this.options,i=this.anchors.eq(t)[0],s=e.data(i,"load.tabs");this.abort();if(!s||this.element.queue("tabs").length!==0&&e.data(i,"cache.tabs")){this.element.dequeue("tabs");return}this.lis.eq(t).addClass("ui-state-processing");if(r.spinner){var o=e("span",i);o.data("label.tabs",o.html()).html(r.spinner)}this.xhr=e.ajax(e.extend({},r.ajaxOptions,{url:s,success:function(s,o){e(n._sanitizeSelector(i.hash)).html(s);n._cleanup();if(r.cache){e.data(i,"cache.tabs",true)}n._trigger("load",null,n._ui(n.anchors[t],n.panels[t]));try{r.ajaxOptions.success(s,o)}catch(u){}n.element.dequeue("tabs")}}))},abort:function(){this.element.queue([]);this.panels.stop(false,true);if(this.xhr){this.xhr.abort();delete this.xhr}this._cleanup()},url:function(e,t){this.anchors.eq(e).removeData("cache.tabs").data("load.tabs",t)},length:function(){return this.anchors.length}});e.extend(e.ui.tabs,{version:"1.7.1",getter:"length",defaults:{ajaxOptions:null,cache:false,cookie:null,collapsible:false,disabled:[],event:"click",fx:null,idPrefix:"ui-tabs-",panelTemplate:"<div></div>",spinner:"<em>Loading&#8230;</em>",tabTemplate:'<li><a href="#{href}"><span>#{label}</span></a></li>'}});e.extend(e.ui.tabs.prototype,{rotation:null,rotate:function(e,n){var r=this,i=this.options;var s=r._rotate||(r._rotate=function(t){clearTimeout(r.rotation);r.rotation=setTimeout(function(){var e=i.selected;r.select(++e<r.anchors.length?e:0)},e);if(t){t.stopPropagation()}});var o=r._unrotate||(r._unrotate=!n?function(e){if(e.clientX){r.rotate(null)}}:function(e){t=i.selected;s()});if(e){this.element.bind("tabsshow",s);this.anchors.bind(i.event+".tabs",o);s()}else{clearTimeout(r.rotation);this.element.unbind("tabsshow",s);this.anchors.unbind(i.event+".tabs",o);delete this._rotate;delete this._unrotate}}})})(jqcc);
/*
 * CometChat 
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/


if (typeof(jqcc) === 'undefined') {
	jqcc = jQuery;
}

jqcc.ajaxSetup({scriptCharset: "utf-8", cache: "false"});

if (typeof(jqcc.cometchat)==='undefined') {
    var mode = 1;
    jqcc.cometchat = function() {};
}

jqcc.extend(jqcc.cometchat, {
    crvariables : {themename: 'standard',
                timestamp: '0',
                currentroom: '0',
                currentp: '',
                currentroomcode: '',
                myid: '0',
                owner: '0',
                isModerator: 0,
                cu_uids: [],
                heartbeatTimer: '',
                baseUrl: '/include/addons/cometchat/',
                minHeartbeat: '3000',
                maxHeartbeat: '12000',
                fullName: '1',
                hideEnterExit: '0',
                messageBeep: '1',
                heartbeatTime: this.minHeartbeat,
                heartbeatCount: 1,
                todaysDate: new Date(),
                todaysDay: new Date().getDate(),
                clh: '',
                ulh: '',
                prepend: 0,
                users: {},
                usersName: {},
                initializeRoom: 0,
                password: '',
                currentroomname: '',
                armyTime: '0',
                specialChars: /([^\x00-\x80]+)|([&][#])+/,
                apiAccess: 0,
                lightboxWindows: '1',
                newMessages: 0,
                plugins: ['colors', 'smilies'],
                cookie_prefix: 'cc_',
                basedata: getURLParameter('basedata'),
                allowDelete: '1',
                lastmessagetime : Math.floor(new Date().getTime()),
                floodControl: '100',
                calleeAPI: 'standard',
                moderators: [''],
                windowCount: 0,
                windows: [],
		cookiePrefix: 'cc_'
            },
            getcrAllVariables: function() {
                return this.crvariables;
            },
            getChatroomVars: function(key) {
                if (typeof(this.crvariables[key])!=='undefined')
                    return this.crvariables[key];
            },
            setChatroomVars: function(key, value) {
                this.crvariables[key] = value;
            },
            chatroommessageBeep: function() {
                return this.crvariables.messageBeep;
            },
            getFlashMovie: function(movieName) {
                var isIE = navigator.appName.indexOf("Microsoft") != -1;
                return (isIE) ? window[movieName] : document[movieName];
            },

            getBaseUrl: function() {
                return this.crvariables.baseUrl;
            },

            getBaseData: function() {
				if ($.cookie(this.crvariables.cookiePrefix + 'data') !== null) {
					return $.cookie(this.crvariables.cookiePrefix + 'data');
				}
                return this.crvariables.basedata;
            },
            popoutChatroom: function() {
                jqcc.cometchat.leaveChatroom();
                myRef = window.open(self.location,'popoutchat','left=20,top=20,status=0,toolbar=0,menubar=0,directories=0,location=0,status=0,scrollbars=0,resizable=1,width=800,height=600');
                if (typeof(parent.jqcc.cometchat.closeModule) == "function")
                    parent.jqcc.cometchat.closeModule('chatrooms');
                setTimeout('window.location.reload()',3000);
            },
            chatroomBoxKeydown: function(event,chatboxtextarea,force) {
                var condition = 1;
                if ((event.keyCode == 13 && event.shiftKey == 0) || force == 1) {
                    
                    var message = jqcc(chatboxtextarea).val();
                    message = message.replace(/^\s+|\s+$/g,"");
                    if (this.crvariables.floodControl != 0) {
                        condition = ((Math.floor(new Date().getTime())) - this.crvariables.lastmessagetime > 2000);
                    }
                    if (condition) {
                        var messageLength = message.length;
                        this.crvariables.lastmessagetime = Math.floor(new Date().getTime());
                        if (this.crvariables.currentroom != 0) {
                            if(typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].sendChatroomMessage) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].sendChatroomMessage(chatboxtextarea);
                            if (message != '') {
                                jqcc.cometchat.sendmessageProcess(message, this.crvariables.currentroom, this.crvariables.basedata, this.crvariables.currentroomname);
                            }
                        }
                        return false;
                    } else {
                        alert('Please do not spam in chatroom');
                    }
                } 
            },
            sendmessageProcess: function(message, currentroom, basedata, currentroomname) {

                if (message != '') {
					if (message.length > 1000){
						if (message.charAt(1000) == ' ') {
							messagecurrent = message.substring(0,1000);
						} else {
							messagecurrent = message.substring(0,1000);
							var spacePos = messagecurrent.length;
							while (messagecurrent.charAt(spacePos) != ' ') {
								  spacePos--;
							}
							messagecurrent = message.substring(0,spacePos);
						}
						messagenext = message.substring(messagecurrent.length);
						if (messagenext.length > 0) {
							messagecurrent = messagecurrent + "...";
						}
					} else {
							messagecurrent = message;
							messagenext = '';
					}
					message = messagecurrent;
                    jqcc.post(this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?action=sendmessage", {message: message , currentroom: currentroom, basedata:basedata, currentroomname: currentroomname} , function(data) {
                        if (data) {
                                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].addChatroomMessage) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].addChatroomMessage('1', message,data,1,Math.floor(new Date().getTime()),'0');
                                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomScrollDown) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomScrollDown();
                        } else if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].crscrollToBottom) == "function") {
                            jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].crscrollToBottom();
                        }
                        if (messagenext.length > 0) {
                                jqcc.cometchat.sendmessageProcess('...'+messagenext, currentroom, basedata, currentroomname);
                        }
                    });
					
                }
            },
            confirmDelete: function(delid) {
                var confirmed = confirm('Are you want to sure you want to delete this message?');
                if (confirmed==true) {
                    jqcc.cometchat.deleteMessage(delid);
                }
            },
            deleteMessage: function(delid) {
                jqcc.ajax({
                    url: "chatrooms.php?action=deleteChatroomMessage",
                    type: "POST",
                    data: {delid:delid,currentroom:this.crvariables.currentroom, basedata:this.crvariables.basedata},
                    success: function(s) {
                        if (s == 1) {	
                            $("#cometchat_message_"+delid).remove();
                        }
                    }
                });
            },
            leaveChatroom: function(id, banflag) {
                var flag=0;
                var params = "action=leavechatroom";
                if (typeof(id) != 'undefined') {
                    flag=1;
                }
                if (typeof(banflag) != 'undefined') {
                    params = params + "&banflag=1";
                }
                                if (typeof(jqcc[this.crvariables.calleeAPI].leaveRoomClass) == "function")
                    jqcc[this.crvariables.calleeAPI].leaveRoomClass(this.crvariables.currentroom);
                jqcc.post(this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?"+params, {currentroom: this.crvariables.currentroom, flag:flag, basedata:this.crvariables.basedata}, function(data) {	
                    if (data) {
                        jqcc.cometchat.setChatroomVars('currentp','');
                        jqcc.cometchat.setChatroomVars('currentroomname','');
                        jqcc.cometchat.setChatroomVars('currentroom',0);
                        if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].removeCurrentRoomTab) == "function")
                            jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].removeCurrentRoomTab();
                        document.cookie = 'cc_chatroom=';
                        if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadLobby) == "function")
                            jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadLobby();
                        clearTimeout(jqcc.cometchat.getChatroomVars('heartbeatTimer'));
                        jqcc.cometchat.chatroomHeartbeat(1);
                    }
                });
            },
			
			webappLeaveChatroom: function(id) {
				var flag=0;
                                if (typeof(jqcc[this.crvariables.calleeAPI].leaveRoomClass) == "function")
                    jqcc[this.crvariables.calleeAPI].leaveRoomClass(this.crvariables.currentroom);
                jqcc.post(this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?"+params, {currentroom: this.crvariables.currentroom, flag:flag, basedata:this.crvariables.basedata}, function(data) {	
                    if (data) {
                        jqcc.cometchat.setChatroomVars('currentp','');
                        jqcc.cometchat.setChatroomVars('currentroomname','');
                        jqcc.cometchat.setChatroomVars('currentroom',0);
                        document.cookie = 'cc_chatroom=';
                        clearTimeout(jqcc.cometchat.getChatroomVars('heartbeatTimer'));
                        jqcc.cometchat.chatroomHeartbeat(1);
                    }
                });
			},
			
            createChatroomSubmit: function() {
                var room = jqcc[this.crvariables.calleeAPI].createChatroomSubmitStruct(); 
                if (room.name != '' && typeof(room.name) != 'undefined') {
                    jqcc.post(this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?action=createchatroom", {name: room.name, type:room.type, password: room.password, basedata:this.crvariables.basedata} , function(data) {
                        if (parseInt(data)!=0) {
                            jqcc.cometchat.setChatroomVars('currentp',SHA1(room.password))
                            room.name = urlencode(room.name);
                            jqcc.cometchat.chatroom(data,room.name,room.type,jqcc.cometchat.getChatroomVars('currentp'),1);
                        } else {
                            alert('This room name is not available.');
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].createChatroom) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].createChatroom();
                        }
                    });
                } else {
                    alert('Please enter the room name.');
                }
                return false;
            },
            inviteChatroomUser: function() {
                jqcc[this.crvariables.calleeAPI].loadCCPopup(this.crvariables.baseUrl+'modules/chatrooms/chatrooms.php?action=invite&roomid='+this.crvariables.currentroom+'&inviteid='+this.crvariables.currentp+'&basedata='+this.crvariables.basedata+'&roomname='+urlencode(this.crvariables.currentroomname), 'invite',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=1, width=400,height=200",400,200,'Please select users');
            },
            unbanChatroomUser: function() {
                jqcc[this.crvariables.calleeAPI].loadCCPopup(this.crvariables.baseUrl+'modules/chatrooms/chatrooms.php?action=unban&roomid='+this.crvariables.currentroom+'&inviteid='+this.crvariables.currentp+'&basedata='+this.crvariables.basedata+'&roomname='+urlencode(this.crvariables.currentroomname)+'&time='+Math.random(), 'invite',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=1, width=400,height=200",400,200,'Please select users');
            },
            loadChatroomPro: function(uid,owner,longname) {
                jqcc[this.crvariables.calleeAPI].loadCCPopup(this.crvariables.baseUrl+'modules/chatrooms/chatrooms.php?action=loadChatroomPro&apiAccess='+this.crvariables.apiAccess+'&owner='+owner+'&roomid='+this.crvariables.currentroom+'&basedata='+this.crvariables.basedata+'&inviteid='+uid+'&roomname='+urlencode(this.crvariables.currentroomname), 'loadChatroomPro',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=1, width=365,height=100",365,75,longname);
            },
            silentroom: function(roomid, inviteid, roomname) {
                jqcc.cometchat.chatroom(roomid,roomname,1,inviteid,1);
            },
            checkChatroomPass: function(id,name,silent,password) {
                if (silent != 1) {
                    password=SHA1(password);
                }
                jqcc.post(this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?action=checkpassword", {password: password, id: id, basedata:this.crvariables.basedata} , function(data) {
                    if (data) {
                        if (data != '0' && data != '2' ) {
                            var splitdata=data.split('^');
                                                        jqcc.cometchat.setChatroomVars('owner',parseInt(splitdata[1]));
                            jqcc.cometchat.setChatroomVars('myid',parseInt(splitdata[2]));
                            jqcc.cometchat.setChatroomVars('isModerator',parseInt(splitdata[3]));
                            jqcc.cometchat.setChatroomVars('currentp',password);
                            jqcc.cometchat.setChatroomVars('initializeRoom',1);
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].hidetabs) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].hidetabs();
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].selectChatroom) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].selectChatroom(jqcc.cometchat.getChatroomVars('currentroom'),id);
                            jqcc.cometchat.setChatroomVars('currentroom',id);
                            jqcc.cometchat.setChatroomVars('ulh','');
                            jqcc.cometchat.setChatroomVars('timestamp',0);
                            jqcc.cometchat.setChatroomVars('currentroomname',name);
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].checkOwnership) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].checkOwnership(jqcc.cometchat.getChatroomVars('owner'),jqcc.cometchat.getChatroomVars('isModerator'),name);
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].setRoomName) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].setRoomName(name);
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadRoom) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadRoom();
                            clearTimeout(jqcc.cometchat.getChatroomVars('heartbeatTimer'));
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadMobileChatroom) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadMobileChatroom();
                            jqcc.cometchat.setChatroomVars('cu_uids',''); 
                            jqcc.cometchat.chatroomHeartbeat(1);
                        } else {
                            if (data==2) {
                                if (silent != 1) {
                                    alert ('Sorry, you are banned from this chatroom.');
                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadMobileLobbyReverse) == "function")
                                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadMobileLobbyReverse();
                                }
                            } else {
                                alert ('Incorrect password. Please try again.');
                            }
                        }
                    }
                });
            },
            chatroom: function(id,name,type,invite,silent) {
                name = urldecode(name);
                if (this.crvariables.currentroom != id) {
                    this.crvariables.password = '';
                    if (invite != '') {
                        this.crvariables.password = invite;
                    }
                    if (type == 1 || type == 2) {
                        if (silent != 1) {
                            if (typeof(jqcc[this.crvariables.calleeAPI].silentRoom) == "function")
                                jqcc[this.crvariables.calleeAPI].silentRoom(id, name, silent);
                        } else {
                            jqcc.cometchat.checkChatroomPass(id,name,silent,this.crvariables.password);
                        }
                    } else {
                        jqcc.cometchat.checkChatroomPass(id,name,silent,this.crvariables.password);
                    }
                } else {
                    if (typeof(jqcc[this.crvariables.calleeAPI].loadRoom) == "function")
                        jqcc[this.crvariables.calleeAPI].loadRoom();
                    clearTimeout(this.crvariables.heartbeatTimer);
                    jqcc.cometchat.chatroomHeartbeat(1);
                }
            },
            chatroomHeartbeat: function(forceUpdate) {
                jqcc.ajax({
                    url: this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?action=heartbeat",
                    data: {timestamp: this.crvariables.timestamp, currentroom: this.crvariables.currentroom, clh: this.crvariables.clh, ulh: this.crvariables.ulh, currentp: this.crvariables.currentp, popout:this.crvariables.apiAccess, force: forceUpdate ,basedata:this.crvariables.basedata},
                    type: 'post',
                    cache: false,
                    timeout: 10000,
                    error: function() {
                        clearTimeout(jqcc.cometchat.getChatroomVars('heartbeatTimer'));
                        jqcc.cometchat.setChatroomVars('heartbeatTime', jqcc.cometchat.getChatroomVars('minHeartbeat'));
                        jqcc.cometchat.setChatroomVars('heartbeatTimer', setTimeout( function() { jqcc.cometchat.chatroomHeartbeat(); },jqcc.cometchat.getChatroomVars('heartbeatTime')));
                    },
                    success: function(data) {
                        if (data) {
                            var fetchedUsers = 0;
                            $.each(data, function(type,item) {
                                if (type == 'logout') {
                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomLogout) == "function")
                                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomLogout();
                                }   
                                if (type == 'chatrooms') {
                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadChatroomList) == "function")
                                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].loadChatroomList(item);
                                }
                                if (type == 'clh') { 
                                    jqcc.cometchat.setChatroomVars('clh',item);
                                }
                                if (type == 'prepend') { 
                                    jqcc.cometchat.setChatroomVars('prepend',item); 
                                }
                                if (type == 'ulh') { 
                                    jqcc.cometchat.setChatroomVars('ulh',item);
                                }
                                if (type == 'messages') {
                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].displayChatroomMessage) == "function")
                                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].displayChatroomMessage(item,fetchedUsers);
                                }
                                if (type == 'users') {
                                    if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].updateChatroomUsers) == "function")
                                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].updateChatroomUsers(item,fetchedUsers);
                                }
                            });
                        }
                        jqcc.cometchat.setChatroomVars('heartbeatCount',jqcc.cometchat.getChatroomVars('heartbeatCount')+1);
                        if (jqcc.cometchat.getChatroomVars('heartbeatCount') > 4) {
                            jqcc.cometchat.setChatroomVars('heartbeatTime',jqcc.cometchat.getChatroomVars('heartbeatTime') * 2);
                            jqcc.cometchat.setChatroomVars('heartbeatCount',1);
                        }
                        if (jqcc.cometchat.getChatroomVars('heartbeatTime') > jqcc.cometchat.getChatroomVars('maxHeartbeat')) {
                            jqcc.cometchat.setChatroomVars('heartbeatTime', jqcc.cometchat.getChatroomVars('maxHeartbeat'));
                        }
                        clearTimeout(jqcc.cometchat.getChatroomVars('heartbeatTimer'));
                        jqcc.cometchat.setChatroomVars('heartbeatTime', jqcc.cometchat.getChatroomVars('minHeartbeat'));
                        jqcc.cometchat.setChatroomVars('heartbeatTimer', setTimeout( function() { jqcc.cometchat.chatroomHeartbeat(); },jqcc.cometchat.getChatroomVars('heartbeatTime')));
                    }
                });
            },
            kickChatroomUser: function(kickid,kick){	
                jqcc.ajax({
                    url: this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?action=kickUser",
                    type: "POST",
                    data: {kickid:kickid,currentroom:this.crvariables.currentroom,kick:kick, basedata:this.crvariables.basedata},
                    success: function(s) {
                        if (s == 1) {
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].kickid) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].kickid(kickid);	
                            jqcc.cometchat.setChatroomVars('ulh','');
                        }
                    }
                });
            },
            banChatroomUser: function(banid,ban){
                jqcc.ajax({
                    url: this.crvariables.baseUrl+"modules/chatrooms/chatrooms.php?action=banUser",
                    type: "POST",
                    data: {banid:banid,currentroom:this.crvariables.currentroom,ban:ban, basedata:this.crvariables.basedata},
                    success: function(s) {
                        if (s == 1) {
                            if (typeof(jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].banid) == "function")
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].banid(banid);
                        }
                    }
                });
            },
            cometchatroomready: function() {
                jqcc(document).ready(function() {
                    if(jqcc.cometchat.getChatroomVars('calleeAPI') != 'mobilewebapp') {
                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].cometchatroomready();
                   }
                });
            },
            chatroomready: function() {
                jqcc(document).ready(function() {
                    if(jqcc.cometchat.getChatroomVars('calleeAPI') != 'mobilewebapp') {
                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomready();
                    }
                });
            }
        }
    );

    jqcc.cometchat.chatroomready();
     


    function SHA1(e){function rotate_left(n,s){var a=(n<<s)|(n>>>(32-s));return a};function lsb_hex(a){var b="";var i;var c;var d;for(i=0;i<=6;i+=2){c=(a>>>(i*4+4))&0x0f;d=(a>>>(i*4))&0x0f;b+=c.toString(16)+d.toString(16)}return b};function cvt_hex(a){var b="";var i;var v;for(i=7;i>=0;i--){v=(a>>>(i*4))&0x0f;b+=v.toString(16)}return b};function Utf8Encode(a){a=a.replace(/\r\n/g,"\n");var b="";for(var n=0;n<a.length;n++){var c=a.charCodeAt(n);if(c<128){b+=String.fromCharCode(c)}else if((c>127)&&(c<2048)){b+=String.fromCharCode((c>>6)|192);b+=String.fromCharCode((c&63)|128)}else{b+=String.fromCharCode((c>>12)|224);b+=String.fromCharCode(((c>>6)&63)|128);b+=String.fromCharCode((c&63)|128)}}return b};var f;var i,j;var W=new Array(80);var g=0x67452301;var h=0xEFCDAB89;var k=0x98BADCFE;var l=0x10325476;var m=0xC3D2E1F0;var A,B,C,D,E;var o;e=Utf8Encode(e);var p=e.length;var q=new Array();for(i=0;i<p-3;i+=4){j=e.charCodeAt(i)<<24|e.charCodeAt(i+1)<<16|e.charCodeAt(i+2)<<8|e.charCodeAt(i+3);q.push(j)}switch(p%4){case 0:i=0x080000000;break;case 1:i=e.charCodeAt(p-1)<<24|0x0800000;break;case 2:i=e.charCodeAt(p-2)<<24|e.charCodeAt(p-1)<<16|0x08000;break;case 3:i=e.charCodeAt(p-3)<<24|e.charCodeAt(p-2)<<16|e.charCodeAt(p-1)<<8|0x80;break}q.push(i);while((q.length%16)!=14)q.push(0);q.push(p>>>29);q.push((p<<3)&0x0ffffffff);for(f=0;f<q.length;f+=16){for(i=0;i<16;i++)W[i]=q[f+i];for(i=16;i<=79;i++)W[i]=rotate_left(W[i-3]^W[i-8]^W[i-14]^W[i-16],1);A=g;B=h;C=k;D=l;E=m;for(i=0;i<=19;i++){o=(rotate_left(A,5)+((B&C)|(~B&D))+E+W[i]+0x5A827999)&0x0ffffffff;E=D;D=C;C=rotate_left(B,30);B=A;A=o}for(i=20;i<=39;i++){o=(rotate_left(A,5)+(B^C^D)+E+W[i]+0x6ED9EBA1)&0x0ffffffff;E=D;D=C;C=rotate_left(B,30);B=A;A=o}for(i=40;i<=59;i++){o=(rotate_left(A,5)+((B&C)|(B&D)|(C&D))+E+W[i]+0x8F1BBCDC)&0x0ffffffff;E=D;D=C;C=rotate_left(B,30);B=A;A=o}for(i=60;i<=79;i++){o=(rotate_left(A,5)+(B^C^D)+E+W[i]+0xCA62C1D6)&0x0ffffffff;E=D;D=C;C=rotate_left(B,30);B=A;A=o}g=(g+A)&0x0ffffffff;h=(h+B)&0x0ffffffff;k=(k+C)&0x0ffffffff;l=(l+D)&0x0ffffffff;m=(m+E)&0x0ffffffff}var o=cvt_hex(g)+cvt_hex(h)+cvt_hex(k)+cvt_hex(l)+cvt_hex(m);return o.toLowerCase()}

    function MD5(j){function RotateLeft(a,b){return(a<<b)|(a>>>(32-b))}function AddUnsigned(a,b){var c,lY4,lX8,lY8,lResult;lX8=(a&0x80000000);lY8=(b&0x80000000);c=(a&0x40000000);lY4=(b&0x40000000);lResult=(a&0x3FFFFFFF)+(b&0x3FFFFFFF);if(c&lY4){return(lResult^0x80000000^lX8^lY8)}if(c|lY4){if(lResult&0x40000000){return(lResult^0xC0000000^lX8^lY8)}else{return(lResult^0x40000000^lX8^lY8)}}else{return(lResult^lX8^lY8)}}function F(x,y,z){return(x&y)|((~x)&z)}function G(x,y,z){return(x&z)|(y&(~z))}function H(x,y,z){return(x^y^z)}function I(x,y,z){return(y^(x|(~z)))}function FF(a,b,c,d,x,s,e){a=AddUnsigned(a,AddUnsigned(AddUnsigned(F(b,c,d),x),e));return AddUnsigned(RotateLeft(a,s),b)};function GG(a,b,c,d,x,s,e){a=AddUnsigned(a,AddUnsigned(AddUnsigned(G(b,c,d),x),e));return AddUnsigned(RotateLeft(a,s),b)};function HH(a,b,c,d,x,s,e){a=AddUnsigned(a,AddUnsigned(AddUnsigned(H(b,c,d),x),e));return AddUnsigned(RotateLeft(a,s),b)};function II(a,b,c,d,x,s,e){a=AddUnsigned(a,AddUnsigned(AddUnsigned(I(b,c,d),x),e));return AddUnsigned(RotateLeft(a,s),b)};function ConvertToWordArray(a){var b;var c=a.length;var d=c+8;var e=(d-(d%64))/64;var f=(e+1)*16;var g=Array(f-1);var h=0;var i=0;while(i<c){b=(i-(i%4))/4;h=(i%4)*8;g[b]=(g[b]|(a.charCodeAt(i)<<h));i++}b=(i-(i%4))/4;h=(i%4)*8;g[b]=g[b]|(0x80<<h);g[f-2]=c<<3;g[f-1]=c>>>29;return g};function WordToHex(a){var b="",WordToHexValue_temp="",lByte,lCount;for(lCount=0;lCount<=3;lCount++){lByte=(a>>>(lCount*8))&255;WordToHexValue_temp="0"+lByte.toString(16);b=b+WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2)}return b};function Utf8Encode(a){a=a.replace(/\r\n/g,"\n");var b="";for(var n=0;n<a.length;n++){var c=a.charCodeAt(n);if(c<128){b+=String.fromCharCode(c)}else if((c>127)&&(c<2048)){b+=String.fromCharCode((c>>6)|192);b+=String.fromCharCode((c&63)|128)}else{b+=String.fromCharCode((c>>12)|224);b+=String.fromCharCode(((c>>6)&63)|128);b+=String.fromCharCode((c&63)|128)}}return b};var x=Array();var k,AA,BB,CC,DD,a,b,c,d;var l=7,S12=12,S13=17,S14=22;var m=5,S22=9,S23=14,S24=20;var o=4,S32=11,S33=16,S34=23;var p=6,S42=10,S43=15,S44=21;j=Utf8Encode(j);x=ConvertToWordArray(j);a=0x67452301;b=0xEFCDAB89;c=0x98BADCFE;d=0x10325476;for(k=0;k<x.length;k+=16){AA=a;BB=b;CC=c;DD=d;a=FF(a,b,c,d,x[k+0],l,0xD76AA478);d=FF(d,a,b,c,x[k+1],S12,0xE8C7B756);c=FF(c,d,a,b,x[k+2],S13,0x242070DB);b=FF(b,c,d,a,x[k+3],S14,0xC1BDCEEE);a=FF(a,b,c,d,x[k+4],l,0xF57C0FAF);d=FF(d,a,b,c,x[k+5],S12,0x4787C62A);c=FF(c,d,a,b,x[k+6],S13,0xA8304613);b=FF(b,c,d,a,x[k+7],S14,0xFD469501);a=FF(a,b,c,d,x[k+8],l,0x698098D8);d=FF(d,a,b,c,x[k+9],S12,0x8B44F7AF);c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);a=FF(a,b,c,d,x[k+12],l,0x6B901122);d=FF(d,a,b,c,x[k+13],S12,0xFD987193);c=FF(c,d,a,b,x[k+14],S13,0xA679438E);b=FF(b,c,d,a,x[k+15],S14,0x49B40821);a=GG(a,b,c,d,x[k+1],m,0xF61E2562);d=GG(d,a,b,c,x[k+6],S22,0xC040B340);c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);b=GG(b,c,d,a,x[k+0],S24,0xE9B6C7AA);a=GG(a,b,c,d,x[k+5],m,0xD62F105D);d=GG(d,a,b,c,x[k+10],S22,0x2441453);c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);b=GG(b,c,d,a,x[k+4],S24,0xE7D3FBC8);a=GG(a,b,c,d,x[k+9],m,0x21E1CDE6);d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);c=GG(c,d,a,b,x[k+3],S23,0xF4D50D87);b=GG(b,c,d,a,x[k+8],S24,0x455A14ED);a=GG(a,b,c,d,x[k+13],m,0xA9E3E905);d=GG(d,a,b,c,x[k+2],S22,0xFCEFA3F8);c=GG(c,d,a,b,x[k+7],S23,0x676F02D9);b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);a=HH(a,b,c,d,x[k+5],o,0xFFFA3942);d=HH(d,a,b,c,x[k+8],S32,0x8771F681);c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);a=HH(a,b,c,d,x[k+1],o,0xA4BEEA44);d=HH(d,a,b,c,x[k+4],S32,0x4BDECFA9);c=HH(c,d,a,b,x[k+7],S33,0xF6BB4B60);b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);a=HH(a,b,c,d,x[k+13],o,0x289B7EC6);d=HH(d,a,b,c,x[k+0],S32,0xEAA127FA);c=HH(c,d,a,b,x[k+3],S33,0xD4EF3085);b=HH(b,c,d,a,x[k+6],S34,0x4881D05);a=HH(a,b,c,d,x[k+9],o,0xD9D4D039);d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);b=HH(b,c,d,a,x[k+2],S34,0xC4AC5665);a=II(a,b,c,d,x[k+0],p,0xF4292244);d=II(d,a,b,c,x[k+7],S42,0x432AFF97);c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);b=II(b,c,d,a,x[k+5],S44,0xFC93A039);a=II(a,b,c,d,x[k+12],p,0x655B59C3);d=II(d,a,b,c,x[k+3],S42,0x8F0CCC92);c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);b=II(b,c,d,a,x[k+1],S44,0x85845DD1);a=II(a,b,c,d,x[k+8],p,0x6FA87E4F);d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);c=II(c,d,a,b,x[k+6],S43,0xA3014314);b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);a=II(a,b,c,d,x[k+4],p,0xF7537E82);d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);c=II(c,d,a,b,x[k+2],S43,0x2AD7D2BB);b=II(b,c,d,a,x[k+9],S44,0xEB86D391);a=AddUnsigned(a,AA);b=AddUnsigned(b,BB);c=AddUnsigned(c,CC);d=AddUnsigned(d,DD)}var q=WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);return q.toLowerCase()}
	
    function base64_encode(a){var b="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";var c,o2,o3,h1,h2,h3,h4,bits,i=0,ac=0,enc="",tmp_arr=[];if(!a){return a}a=this.utf8_encode(a+'');do{c=a.charCodeAt(i++);o2=a.charCodeAt(i++);o3=a.charCodeAt(i++);bits=c<<16|o2<<8|o3;h1=bits>>18&0x3f;h2=bits>>12&0x3f;h3=bits>>6&0x3f;h4=bits&0x3f;tmp_arr[ac++]=b.charAt(h1)+b.charAt(h2)+b.charAt(h3)+b.charAt(h4)}while(i<a.length);enc=tmp_arr.join('');switch(a.length%3){case 1:enc=enc.slice(0,-2)+'==';break;case 2:enc=enc.slice(0,-1)+'=';break}return enc}
	
    function base64_decode(a){var b="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";var c,o2,o3,h1,h2,h3,h4,bits,i=0,ac=0,dec="",tmp_arr=[];if(!a){return a}a+='';do{h1=b.indexOf(a.charAt(i++));h2=b.indexOf(a.charAt(i++));h3=b.indexOf(a.charAt(i++));h4=b.indexOf(a.charAt(i++));bits=h1<<18|h2<<12|h3<<6|h4;c=bits>>16&0xff;o2=bits>>8&0xff;o3=bits&0xff;if(h3==64){tmp_arr[ac++]=String.fromCharCode(c)}else if(h4==64){tmp_arr[ac++]=String.fromCharCode(c,o2)}else{tmp_arr[ac++]=String.fromCharCode(c,o2,o3)}}while(i<a.length);dec=tmp_arr.join('');dec=this.utf8_decode(dec);return dec}
	
    function utf8_decode(a){var b=[],i=0,ac=0,c1=0,c2=0,c3=0;a+='';while(i<a.length){c1=a.charCodeAt(i);if(c1<128){b[ac++]=String.fromCharCode(c1);i++}else if((c1>191)&&(c1<224)){c2=a.charCodeAt(i+1);b[ac++]=String.fromCharCode(((c1&31)<<6)|(c2&63));i+=2}else{c2=a.charCodeAt(i+1);c3=a.charCodeAt(i+2);b[ac++]=String.fromCharCode(((c1&15)<<12)|((c2&63)<<6)|(c3&63));i+=3}}return b.join('')}
	
    function utf8_encode(a){var b=(a+'');var c="";var d,end;var e=0;d=end=0;e=b.length;for(var n=0;n<e;n++){var f=b.charCodeAt(n);var g=null;if(f<128){end++}else if(f>127&&f<2048){g=String.fromCharCode((f>>6)|192)+String.fromCharCode((f&63)|128)}else{g=String.fromCharCode((f>>12)|224)+String.fromCharCode(((f>>6)&63)|128)+String.fromCharCode((f&63)|128)}if(g!==null){if(end>d){c+=b.substring(d,end)}c+=g;d=end=n+1}}if(end>d){c+=b.substring(d,b.length)}return c}

    function urlencode (string) {
            return base64_encode(string);
    }

    function urldecode (string) {
            return base64_decode(string);
    }

    function getURLParameter (name) {
            return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]);
    }

    /* Copyright (c) 2006 Klaus Hartl (stilbuero.de)
     http://www.opensource.org/licenses/mit-license.php*/

    jqcc.cookie=function(a,b,c){if(typeof b!='undefined'){c=c||{};if(b===null){b='';c.expires=-1}var d='';if(c.expires&&(typeof c.expires=='number'||c.expires.toUTCString)){var e;if(typeof c.expires=='number'){e=new Date();e.setTime(e.getTime()+(c.expires*24*60*60*1000))}else{e=c.expires}d='; expires='+e.toUTCString()}var f=c.path?'; path='+(c.path):'';var g=c.domain?'; domain='+(c.domain):'';var h=c.secure?'; secure':'';document.cookie=[a,'=',encodeURIComponent(b),d,f,g,h].join('')}else{var j=null;if(document.cookie&&document.cookie!=''){var k=document.cookie.split(';');for(var i=0;i<k.length;i++){var l=jqcc.trim(k[i]);if(l.substring(0,a.length+1)==(a+'=')){j=decodeURIComponent(l.substring(a.length+1));break}}}return j}};

    /* SWFObject is (c) 2007 Geoff Stearns and is released under the MIT License
     http://www.opensource.org/licenses/mit-license.php */

    if(typeof deconcept=="undefined"){var deconcept=new Object();}if(typeof deconcept.util=="undefined"){deconcept.util=new Object();}if(typeof deconcept.SWFObjectCCUtil=="undefined"){deconcept.SWFObjectCCUtil=new Object();}deconcept.SWFObjectCC=function(_1,id,w,h,_5,c,_7,_8,_9,_a){if(!document.getElementById){return;}this.DETECT_KEY=_a?_a:"detectflash";this.skipDetect=deconcept.util.getRequestParameter(this.DETECT_KEY);this.params=new Object();this.variables=new Object();this.attributes=new Array();if(_1){this.setAttribute("swf",_1);}if(id){this.setAttribute("id",id);}if(w){this.setAttribute("width",w);}if(h){this.setAttribute("height",h);}if(_5){this.setAttribute("version",new deconcept.PlayerVersion(_5.toString().split(".")));}this.installedVer=deconcept.SWFObjectCCUtil.getPlayerVersion();if(!window.opera&&document.all&&this.installedVer.major>7){deconcept.SWFObjectCC.doPrepUnload=true;}if(c){this.addParam("bgcolor",c);}var q=_7?_7:"high";this.addParam("quality",q);this.setAttribute("useExpressInstall",false);this.setAttribute("doExpressInstall",false);var _c=(_8)?_8:window.location;this.setAttribute("xiRedirectUrl",_c);this.setAttribute("redirectUrl","");if(_9){this.setAttribute("redirectUrl",_9);}};deconcept.SWFObjectCC.prototype={useExpressInstall:function(_d){this.xiSWFPath=!_d?"expressinstall.swf":_d;this.setAttribute("useExpressInstall",true);},setAttribute:function(_e,_f){this.attributes[_e]=_f;},getAttribute:function(_10){return this.attributes[_10];},addParam:function(_11,_12){this.params[_11]=_12;},getParams:function(){return this.params;},addVariable:function(_13,_14){this.variables[_13]=_14;},getVariable:function(_15){return this.variables[_15];},getVariables:function(){return this.variables;},getVariablePairs:function(){var _16=new Array();var key;var _18=this.getVariables();for(key in _18){_16[_16.length]=key+"="+_18[key];}return _16;},getSWFHTML:function(){var _19="";if(navigator.plugins&&navigator.mimeTypes&&navigator.mimeTypes.length){if(this.getAttribute("doExpressInstall")){this.addVariable("MMplayerType","PlugIn");this.setAttribute("swf",this.xiSWFPath);}_19="<embed type=\"application/x-shockwave-flash\" src=\""+this.getAttribute("swf")+"\" width=\""+this.getAttribute("width")+"\" height=\""+this.getAttribute("height")+"\" style=\""+this.getAttribute("style")+"\"";_19+=" id=\""+this.getAttribute("id")+"\" name=\""+this.getAttribute("id")+"\" ";var _1a=this.getParams();for(var key in _1a){_19+=[key]+"=\""+_1a[key]+"\" ";}var _1c=this.getVariablePairs().join("&");if(_1c.length>0){_19+="flashvars=\""+_1c+"\"";}_19+="/>";}else{if(this.getAttribute("doExpressInstall")){this.addVariable("MMplayerType","ActiveX");this.setAttribute("swf",this.xiSWFPath);}_19="<object id=\""+this.getAttribute("id")+"\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\""+this.getAttribute("width")+"\" height=\""+this.getAttribute("height")+"\" style=\""+this.getAttribute("style")+"\">";_19+="<param name=\"movie\" value=\""+this.getAttribute("swf")+"\" />";var _1d=this.getParams();for(var key in _1d){_19+="<param name=\""+key+"\" value=\""+_1d[key]+"\" />";}var _1f=this.getVariablePairs().join("&");if(_1f.length>0){_19+="<param name=\"flashvars\" value=\""+_1f+"\" />";}_19+="</object>";}return _19;},write:function(_20){if(this.getAttribute("useExpressInstall")){var _21=new deconcept.PlayerVersion([6,0,65]);if(this.installedVer.versionIsValid(_21)&&!this.installedVer.versionIsValid(this.getAttribute("version"))){this.setAttribute("doExpressInstall",true);this.addVariable("MMredirectURL",escape(this.getAttribute("xiRedirectUrl")));document.title=document.title.slice(0,47)+" - Flash Player Installation";this.addVariable("MMdoctitle",document.title);}}if(this.skipDetect||this.getAttribute("doExpressInstall")||this.installedVer.versionIsValid(this.getAttribute("version"))){var n=(typeof _20=="string")?document.getElementById(_20):_20;n.innerHTML=this.getSWFHTML();return true;}else{if(this.getAttribute("redirectUrl")!=""){document.location.replace(this.getAttribute("redirectUrl"));}}return false;}};deconcept.SWFObjectCCUtil.getPlayerVersion=function(){var _23=new deconcept.PlayerVersion([0,0,0]);if(navigator.plugins&&navigator.mimeTypes.length){var x=navigator.plugins["Shockwave Flash"];if(x&&x.description){_23=new deconcept.PlayerVersion(x.description.replace(/([a-zA-Z]|\s)+/,"").replace(/(\s+r|\s+b[0-9]+)/,".").split("."));}}else{if(navigator.userAgent&&navigator.userAgent.indexOf("Windows CE")>=0){var axo=1;var _26=3;while(axo){try{_26++;axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash."+_26);_23=new deconcept.PlayerVersion([_26,0,0]);}catch(e){axo=null;}}}else{try{var axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");}catch(e){try{var axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");_23=new deconcept.PlayerVersion([6,0,21]);axo.AllowScriptAccess="always";}catch(e){if(_23.major==6){return _23;}}try{axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");}catch(e){}}if(axo!=null){_23=new deconcept.PlayerVersion(axo.GetVariable("$version").split(" ")[1].split(","));}}}return _23;};deconcept.PlayerVersion=function(_29){this.major=_29[0]!=null?parseInt(_29[0]):0;this.minor=_29[1]!=null?parseInt(_29[1]):0;this.rev=_29[2]!=null?parseInt(_29[2]):0;};deconcept.PlayerVersion.prototype.versionIsValid=function(fv){if(this.major<fv.major){return false;}if(this.major>fv.major){return true;}if(this.minor<fv.minor){return false;}if(this.minor>fv.minor){return true;}if(this.rev<fv.rev){return false;}return true;};deconcept.util={getRequestParameter:function(_2b){var q=document.location.search||document.location.hash;if(_2b==null){return q;}if(q){var _2d=q.substring(1).split("&");for(var i=0;i<_2d.length;i++){if(_2d[i].substring(0,_2d[i].indexOf("="))==_2b){return _2d[i].substring((_2d[i].indexOf("=")+1));}}}return "";}};deconcept.SWFObjectCCUtil.cleanupSWFs=function(){var _2f=document.getElementsByTagName("OBJECT");for(var i=_2f.length-1;i>=0;i--){_2f[i].style.display="none";for(var x in _2f[i]){if(typeof _2f[i][x]=="function"){_2f[i][x]=function(){};}}}};if(deconcept.SWFObjectCC.doPrepUnload){if(!deconcept.unloadSet){deconcept.SWFObjectCCUtil.prepUnload=function(){__flash_unloadHandler=function(){};__flash_savedUnloadHandler=function(){};window.attachEvent("onunload",deconcept.SWFObjectCCUtil.cleanupSWFs);};window.attachEvent("onbeforeunload",deconcept.SWFObjectCCUtil.prepUnload);deconcept.unloadSet=true;}}if(!document.getElementById&&document.all){document.getElementById=function(id){return document.all[id];};}var getQueryParamValue=deconcept.util.getRequestParameter;var FlashObject=deconcept.SWFObjectCC;var SWFObjectCC=deconcept.SWFObjectCC;


/*
 * CometChat
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.cccolors = (function () {

		var title = 'Color your text';
		var chatroommode = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id,mode) {
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}

				baseUrl = $.cometchat.getBaseUrl();
				basedata = $.cometchat.getBaseData();
				$[$.cometchat.getChatroomVars('calleeAPI')].loadCCPopup(baseUrl+'plugins/colors/index.php?id='+id+'&basedata='+basedata, 'colors',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width=260,height=130",260,80,'Which color would you like to use?'); 
			},

			updatecolor: function (text) {

				if (text != '' && text != null) {
					document.cookie = 'cc_chatroomcolor='+text;
				}

				$('#currentroom .cometchat_textarea').focus();
				
			}

        };
    })();
 
})(jqcc);
/*
 * CometChat
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccsmilies = (function () {
	
		var title = 'Add a smiley';
		var height = 285;
		var width = 420;
		var chatroommode = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id,mode) {
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}

				if (chatroommode != 0) {
					baseUrl = $.cometchat.getBaseUrl();
					basedata = $.cometchat.getBaseData();
					$[$.cometchat.getChatroomVars('calleeAPI')].loadCCPopup(baseUrl+'plugins/smilies/index.php?chatroommode=1&id='+id+'&basedata='+basedata, 'smilies',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width=420,height=285",width,height-50,'Which smiley would you like?');  

				} else {
					baseUrl = $.cometchat.getBaseUrl();
					baseData = $.cometchat.getBaseData();
					loadCCPopup(baseUrl+'plugins/smilies/index.php?id='+id+'&basedata='+baseData, 'smilies',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width="+width+",height="+height,width,height-50,'Which smiley would you like?'); 
				}
			},

			addtext: function (id,text,mode) {
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}
				var string = '';

				if (chatroommode != 0) {

					string = $('#currentroom .cometchat_textarea').val();
					if (string.charAt(string.length-1) == ' ') {
						$('#currentroom .cometchat_textarea').val($('#currentroom .cometchat_textarea').val()+text);
					} else {
						if (string.length == 0) {
							$('#currentroom .cometchat_textarea').val(text);
						} else {
							$('#currentroom .cometchat_textarea').val($('#currentroom .cometchat_textarea').val()+' '+text);
						}
					}
					
					$('#currentroom .cometchat_textarea').focus();
				
				} else {
			
					jqcc.cometchat.chatWith(id);
					var activeId = $.cometchat.getActiveId();
					if (parseInt(activeId) > 0) {
						id = activeId;
					}
									
					string = $('#cometchat_user_'+id+'_popup .cometchat_textarea').val();
					
					if (string.charAt(string.length-1) == ' ') {
						$('#cometchat_user_'+id+'_popup .cometchat_textarea').val(string+text);
					} else {
						if (string.length == 0) {
							$('#cometchat_user_'+id+'_popup .cometchat_textarea').val(text);
						} else {
							$('#cometchat_user_'+id+'_popup .cometchat_textarea').val(string+' '+text);
						}
					}
					
					$('#cometchat_user_'+id+'_popup .cometchat_textarea').focus();

				}
				
			}

        };
    })();
 
})(jqcc);
/*
 * CometChat
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
        var pushNotifications = '1';
        
	$.ccmobilenativeapp = (function () {
			return {
				sendnotification: function (message, channel, displayname, chatroommode) {
					if (typeof chatroommode == 'undefined' && pushNotifications == '1') { 
						baseUrl = $.cometchat.getBaseUrl();
						$.getJSON(baseUrl+'extensions/mobileapp/sendnotification.php', {channel: channel, message: message, displayname: displayname});
					} else if (pushNotifications == '1') {
						baseUrl = $.cometchat.getBaseUrl();
						$.getJSON(baseUrl+'extensions/mobileapp/sendnotification.php?chatroommode=1', {channel: channel, message: message, displayname: displayname});
					}
				}
			};
    })();
 
})(jqcc);        
/*! jQuery UI 1.8.18 */

(function(a,b){function d(b){return!a(b).parents().andSelf().filter(function(){return a.curCSS(this,"visibility")==="hidden"||a.expr.filters.hidden(this)}).length}function c(b,c){var e=b.nodeName.toLowerCase();if("area"===e){var f=b.parentNode,g=f.name,h;if(!b.href||!g||f.nodeName.toLowerCase()!=="map")return!1;h=a("img[usemap=#"+g+"]")[0];return!!h&&d(h)}return(/input|select|textarea|button|object/.test(e)?!b.disabled:"a"==e?b.href||c:c)&&d(b)}a.ui=a.ui||{};a.ui.version||(a.extend(a.ui,{version:"1.8.18",keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91}}),a.fn.extend({propAttr:a.fn.prop||a.fn.attr,_focus:a.fn.focus,focus:function(b,c){return typeof b=="number"?this.each(function(){var d=this;setTimeout(function(){a(d).focus(),c&&c.call(d)},b)}):this._focus.apply(this,arguments)},scrollParent:function(){var b;a.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?b=this.parents().filter(function(){return/(relative|absolute|fixed)/.test(a.curCSS(this,"position",1))&&/(auto|scroll)/.test(a.curCSS(this,"overflow",1)+a.curCSS(this,"overflow-y",1)+a.curCSS(this,"overflow-x",1))}).eq(0):b=this.parents().filter(function(){return/(auto|scroll)/.test(a.curCSS(this,"overflow",1)+a.curCSS(this,"overflow-y",1)+a.curCSS(this,"overflow-x",1))}).eq(0);return/fixed/.test(this.css("position"))||!b.length?a(document):b},zIndex:function(c){if(c!==b)return this.css("zIndex",c);if(this.length){var d=a(this[0]),e,f;while(d.length&&d[0]!==document){e=d.css("position");if(e==="absolute"||e==="relative"||e==="fixed"){f=parseInt(d.css("zIndex"),10);if(!isNaN(f)&&f!==0)return f}d=d.parent()}}return 0},disableSelection:function(){return this.bind((a.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(a){a.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}}),a.each(["Width","Height"],function(c,d){function h(b,c,d,f){a.each(e,function(){c-=parseFloat(a.curCSS(b,"padding"+this,!0))||0,d&&(c-=parseFloat(a.curCSS(b,"border"+this+"Width",!0))||0),f&&(c-=parseFloat(a.curCSS(b,"margin"+this,!0))||0)});return c}var e=d==="Width"?["Left","Right"]:["Top","Bottom"],f=d.toLowerCase(),g={innerWidth:a.fn.innerWidth,innerHeight:a.fn.innerHeight,outerWidth:a.fn.outerWidth,outerHeight:a.fn.outerHeight};a.fn["inner"+d]=function(c){if(c===b)return g["inner"+d].call(this);return this.each(function(){a(this).css(f,h(this,c)+"px")})},a.fn["outer"+d]=function(b,c){if(typeof b!="number")return g["outer"+d].call(this,b);return this.each(function(){a(this).css(f,h(this,b,!0,c)+"px")})}}),a.extend(a.expr[":"],{data:function(b,c,d){return!!a.data(b,d[3])},focusable:function(b){return c(b,!isNaN(a.attr(b,"tabindex")))},tabbable:function(b){var d=a.attr(b,"tabindex"),e=isNaN(d);return(e||d>=0)&&c(b,!e)}}),a(function(){var b=document.body,c=b.appendChild(c=document.createElement("div"));c.offsetHeight,a.extend(c.style,{minHeight:"100px",height:"auto",padding:0,borderWidth:0}),a.support.minHeight=c.offsetHeight===100,a.support.selectstart="onselectstart"in c,b.removeChild(c).style.display="none"}),a.extend(a.ui,{plugin:{add:function(b,c,d){var e=a.ui[b].prototype;for(var f in d)e.plugins[f]=e.plugins[f]||[],e.plugins[f].push([c,d[f]])},call:function(a,b,c){var d=a.plugins[b];if(!!d&&!!a.element[0].parentNode)for(var e=0;e<d.length;e++)a.options[d[e][0]]&&d[e][1].apply(a.element,c)}},contains:function(a,b){return document.compareDocumentPosition?a.compareDocumentPosition(b)&16:a!==b&&a.contains(b)},hasScroll:function(b,c){if(a(b).css("overflow")==="hidden")return!1;var d=c&&c==="left"?"scrollLeft":"scrollTop",e=!1;if(b[d]>0)return!0;b[d]=1,e=b[d]>0,b[d]=0;return e},isOverAxis:function(a,b,c){return a>b&&a<b+c},isOver:function(b,c,d,e,f,g){return a.ui.isOverAxis(b,d,f)&&a.ui.isOverAxis(c,e,g)}}))})(jqcc); 
(function(a,b){if(a.cleanData){var c=a.cleanData;a.cleanData=function(b){for(var d=0,e;(e=b[d])!=null;d++)try{a(e).triggerHandler("remove")}catch(f){}c(b)}}else{var d=a.fn.remove;a.fn.remove=function(b,c){return this.each(function(){c||(!b||a.filter(b,[this]).length)&&a("*",this).add([this]).each(function(){try{a(this).triggerHandler("remove")}catch(b){}});return d.call(a(this),b,c)})}}a.widget=function(b,c,d){var e=b.split(".")[0],f;b=b.split(".")[1],f=e+"-"+b,d||(d=c,c=a.Widget),a.expr[":"][f]=function(c){return!!a.data(c,b)},a[e]=a[e]||{},a[e][b]=function(a,b){arguments.length&&this._createWidget(a,b)};var g=new c;g.options=a.extend(!0,{},g.options),a[e][b].prototype=a.extend(!0,g,{namespace:e,widgetName:b,widgetEventPrefix:a[e][b].prototype.widgetEventPrefix||b,widgetBaseClass:f},d),a.widget.bridge(b,a[e][b])},a.widget.bridge=function(c,d){a.fn[c]=function(e){var f=typeof e=="string",g=Array.prototype.slice.call(arguments,1),h=this;e=!f&&g.length?a.extend.apply(null,[!0,e].concat(g)):e;if(f&&e.charAt(0)==="_")return h;f?this.each(function(){var d=a.data(this,c),f=d&&a.isFunction(d[e])?d[e].apply(d,g):d;if(f!==d&&f!==b){h=f;return!1}}):this.each(function(){var b=a.data(this,c);b?b.option(e||{})._init():a.data(this,c,new d(e,this))});return h}},a.Widget=function(a,b){arguments.length&&this._createWidget(a,b)},a.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:!1},_createWidget:function(b,c){a.data(c,this.widgetName,this),this.element=a(c),this.options=a.extend(!0,{},this.options,this._getCreateOptions(),b);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()}),this._create(),this._trigger("create"),this._init()},_getCreateOptions:function(){return a.metadata&&a.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName),this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled "+"ui-state-disabled")},widget:function(){return this.element},option:function(c,d){var e=c;if(arguments.length===0)return a.extend({},this.options);if(typeof c=="string"){if(d===b)return this.options[c];e={},e[c]=d}this._setOptions(e);return this},_setOptions:function(b){var c=this;a.each(b,function(a,b){c._setOption(a,b)});return this},_setOption:function(a,b){this.options[a]=b,a==="disabled"&&this.widget()[b?"addClass":"removeClass"](this.widgetBaseClass+"-disabled"+" "+"ui-state-disabled").attr("aria-disabled",b);return this},enable:function(){return this._setOption("disabled",!1)},disable:function(){return this._setOption("disabled",!0)},_trigger:function(b,c,d){var e,f,g=this.options[b];d=d||{},c=a.Event(c),c.type=(b===this.widgetEventPrefix?b:this.widgetEventPrefix+b).toLowerCase(),c.target=this.element[0],f=c.originalEvent;if(f)for(e in f)e in c||(c[e]=f[e]);this.element.trigger(c,d);return!(a.isFunction(g)&&g.call(this.element[0],c,d)===!1||c.isDefaultPrevented())}}})(jqcc);
(function(a,b){var c=!1;a(document).mouseup(function(a){c=!1}),a.widget("ui.mouse",{options:{cancel:":input,option",distance:1,delay:0},_mouseInit:function(){var b=this;this.element.bind("mousedown."+this.widgetName,function(a){return b._mouseDown(a)}).bind("click."+this.widgetName,function(c){if(!0===a.data(c.target,b.widgetName+".preventClickEvent")){a.removeData(c.target,b.widgetName+".preventClickEvent"),c.stopImmediatePropagation();return!1}}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName)},_mouseDown:function(b){if(!c){this._mouseStarted&&this._mouseUp(b),this._mouseDownEvent=b;var d=this,e=b.which==1,f=typeof this.options.cancel=="string"&&b.target.nodeName?a(b.target).closest(this.options.cancel).length:!1;if(!e||f||!this._mouseCapture(b))return!0;this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){d.mouseDelayMet=!0},this.options.delay));if(this._mouseDistanceMet(b)&&this._mouseDelayMet(b)){this._mouseStarted=this._mouseStart(b)!==!1;if(!this._mouseStarted){b.preventDefault();return!0}}!0===a.data(b.target,this.widgetName+".preventClickEvent")&&a.removeData(b.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(a){return d._mouseMove(a)},this._mouseUpDelegate=function(a){return d._mouseUp(a)},a(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),b.preventDefault(),c=!0;return!0}},_mouseMove:function(b){if(a.browser.msie&&!(document.documentMode>=9)&&!b.button)return this._mouseUp(b);if(this._mouseStarted){this._mouseDrag(b);return b.preventDefault()}this._mouseDistanceMet(b)&&this._mouseDelayMet(b)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,b)!==!1,this._mouseStarted?this._mouseDrag(b):this._mouseUp(b));return!this._mouseStarted},_mouseUp:function(b){a(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,b.target==this._mouseDownEvent.target&&a.data(b.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(b));return!1},_mouseDistanceMet:function(a){return Math.max(Math.abs(this._mouseDownEvent.pageX-a.pageX),Math.abs(this._mouseDownEvent.pageY-a.pageY))>=this.options.distance},_mouseDelayMet:function(a){return this.mouseDelayMet},_mouseStart:function(a){},_mouseDrag:function(a){},_mouseStop:function(a){},_mouseCapture:function(a){return!0}})})(jqcc);
(function(a,b){a.widget("ui.draggable",a.ui.mouse,{widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1},_create:function(){this.options.helper=="original"&&!/^(?:r|a|f)/.test(this.element.css("position"))&&(this.element[0].style.position="relative"),this.options.addClasses&&this.element.addClass("ui-draggable"),this.options.disabled&&this.element.addClass("ui-draggable-disabled"),this._mouseInit()},destroy:function(){if(!!this.element.data("draggable")){this.element.removeData("draggable").unbind(".draggable").removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"),this._mouseDestroy();return this}},_mouseCapture:function(b){var c=this.options;if(this.helper||c.disabled||a(b.target).is(".ui-resizable-handle"))return!1;this.handle=this._getHandle(b);if(!this.handle)return!1;c.iframeFix&&a(c.iframeFix===!0?"iframe":c.iframeFix).each(function(){a('<div class="ui-draggable-iframeFix" style="background: #fff;"></div>').css({width:this.offsetWidth+"px",height:this.offsetHeight+"px",position:"absolute",opacity:"0.001",zIndex:1e3}).css(a(this).offset()).appendTo("body")});return!0},_mouseStart:function(b){var c=this.options;this.helper=this._createHelper(b),this._cacheHelperProportions(),a.ui.ddmanager&&(a.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(),this.offset=this.positionAbs=this.element.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},a.extend(this.offset,{click:{left:b.pageX-this.offset.left,top:b.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.originalPosition=this.position=this._generatePosition(b),this.originalPageX=b.pageX,this.originalPageY=b.pageY,c.cursorAt&&this._adjustOffsetFromHelper(c.cursorAt),c.containment&&this._setContainment();if(this._trigger("start",b)===!1){this._clear();return!1}this._cacheHelperProportions(),a.ui.ddmanager&&!c.dropBehaviour&&a.ui.ddmanager.prepareOffsets(this,b),this.helper.addClass("ui-draggable-dragging"),this._mouseDrag(b,!0),a.ui.ddmanager&&a.ui.ddmanager.dragStart(this,b);return!0},_mouseDrag:function(b,c){this.position=this._generatePosition(b),this.positionAbs=this._convertPositionTo("absolute");if(!c){var d=this._uiHash();if(this._trigger("drag",b,d)===!1){this._mouseUp({});return!1}this.position=d.position}if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";a.ui.ddmanager&&a.ui.ddmanager.drag(this,b);return!1},_mouseStop:function(b){var c=!1;a.ui.ddmanager&&!this.options.dropBehaviour&&(c=a.ui.ddmanager.drop(this,b)),this.dropped&&(c=this.dropped,this.dropped=!1);if((!this.element[0]||!this.element[0].parentNode)&&this.options.helper=="original")return!1;if(this.options.revert=="invalid"&&!c||this.options.revert=="valid"&&c||this.options.revert===!0||a.isFunction(this.options.revert)&&this.options.revert.call(this.element,c)){var d=this;a(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){d._trigger("stop",b)!==!1&&d._clear()})}else this._trigger("stop",b)!==!1&&this._clear();return!1},_mouseUp:function(b){this.options.iframeFix===!0&&a("div.ui-draggable-iframeFix").each(function(){this.parentNode.removeChild(this)}),a.ui.ddmanager&&a.ui.ddmanager.dragStop(this,b);return a.ui.mouse.prototype._mouseUp.call(this,b)},cancel:function(){this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear();return this},_getHandle:function(b){var c=!this.options.handle||!a(this.options.handle,this.element).length?!0:!1;a(this.options.handle,this.element).find("*").andSelf().each(function(){this==b.target&&(c=!0)});return c},_createHelper:function(b){var c=this.options,d=a.isFunction(c.helper)?a(c.helper.apply(this.element[0],[b])):c.helper=="clone"?this.element.clone().removeAttr("id"):this.element;d.parents("body").length||d.appendTo(c.appendTo=="parent"?this.element[0].parentNode:c.appendTo),d[0]!=this.element[0]&&!/(fixed|absolute)/.test(d.css("position"))&&d.css("position","absolute");return d},_adjustOffsetFromHelper:function(b){typeof b=="string"&&(b=b.split(" ")),a.isArray(b)&&(b={left:+b[0],top:+b[1]||0}),"left"in b&&(this.offset.click.left=b.left+this.margins.left),"right"in b&&(this.offset.click.left=this.helperProportions.width-b.right+this.margins.left),"top"in b&&(this.offset.click.top=b.top+this.margins.top),"bottom"in b&&(this.offset.click.top=this.helperProportions.height-b.bottom+this.margins.top)},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var b=this.offsetParent.offset();this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&a.ui.contains(this.scrollParent[0],this.offsetParent[0])&&(b.left+=this.scrollParent.scrollLeft(),b.top+=this.scrollParent.scrollTop());if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&a.browser.msie)b={top:0,left:0};return{top:b.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:b.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var a=this.element.position();return{top:a.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:a.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var b=this.options;b.containment=="parent"&&(b.containment=this.helper[0].parentNode);if(b.containment=="document"||b.containment=="window")this.containment=[b.containment=="document"?0:a(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,b.containment=="document"?0:a(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,(b.containment=="document"?0:a(window).scrollLeft())+a(b.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(b.containment=="document"?0:a(window).scrollTop())+(a(b.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(b.containment)&&b.containment.constructor!=Array){var c=a(b.containment),d=c[0];if(!d)return;var e=c.offset(),f=a(d).css("overflow")!="hidden";this.containment=[(parseInt(a(d).css("borderLeftWidth"),10)||0)+(parseInt(a(d).css("paddingLeft"),10)||0),(parseInt(a(d).css("borderTopWidth"),10)||0)+(parseInt(a(d).css("paddingTop"),10)||0),(f?Math.max(d.scrollWidth,d.offsetWidth):d.offsetWidth)-(parseInt(a(d).css("borderLeftWidth"),10)||0)-(parseInt(a(d).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(f?Math.max(d.scrollHeight,d.offsetHeight):d.offsetHeight)-(parseInt(a(d).css("borderTopWidth"),10)||0)-(parseInt(a(d).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relative_container=c}else b.containment.constructor==Array&&(this.containment=b.containment)},_convertPositionTo:function(b,c){c||(c=this.position);var d=b=="absolute"?1:-1,e=this.options,f=this.cssPosition=="absolute"&&(this.scrollParent[0]==document||!a.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,g=/(html|body)/i.test(f[0].tagName);return{top:c.top+this.offset.relative.top*d+this.offset.parent.top*d-(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():g?0:f.scrollTop())*d),left:c.left+this.offset.relative.left*d+this.offset.parent.left*d-(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():g?0:f.scrollLeft())*d)}},_generatePosition:function(b){var c=this.options,d=this.cssPosition=="absolute"&&(this.scrollParent[0]==document||!a.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(d[0].tagName),f=b.pageX,g=b.pageY;if(this.originalPosition){var h;if(this.containment){if(this.relative_container){var i=this.relative_container.offset();h=[this.containment[0]+i.left,this.containment[1]+i.top,this.containment[2]+i.left,this.containment[3]+i.top]}else h=this.containment;b.pageX-this.offset.click.left<h[0]&&(f=h[0]+this.offset.click.left),b.pageY-this.offset.click.top<h[1]&&(g=h[1]+this.offset.click.top),b.pageX-this.offset.click.left>h[2]&&(f=h[2]+this.offset.click.left),b.pageY-this.offset.click.top>h[3]&&(g=h[3]+this.offset.click.top)}if(c.grid){var j=c.grid[1]?this.originalPageY+Math.round((g-this.originalPageY)/c.grid[1])*c.grid[1]:this.originalPageY;g=h?j-this.offset.click.top<h[1]||j-this.offset.click.top>h[3]?j-this.offset.click.top<h[1]?j+c.grid[1]:j-c.grid[1]:j:j;var k=c.grid[0]?this.originalPageX+Math.round((f-this.originalPageX)/c.grid[0])*c.grid[0]:this.originalPageX;f=h?k-this.offset.click.left<h[0]||k-this.offset.click.left>h[2]?k-this.offset.click.left<h[0]?k+c.grid[0]:k-c.grid[0]:k:k}}return{top:g-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:d.scrollTop()),left:f-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:d.scrollLeft())}},_clear:function(){this.helper.removeClass("ui-draggable-dragging"),this.helper[0]!=this.element[0]&&!this.cancelHelperRemoval&&this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1},_trigger:function(b,c,d){d=d||this._uiHash(),a.ui.plugin.call(this,b,[c,d]),b=="drag"&&(this.positionAbs=this._convertPositionTo("absolute"));return a.Widget.prototype._trigger.call(this,b,c,d)},plugins:{},_uiHash:function(a){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),a.extend(a.ui.draggable,{version:"1.8.18"}),a.ui.plugin.add("draggable","connectToSortable",{start:function(b,c){var d=a(this).data("draggable"),e=d.options,f=a.extend({},c,{item:d.element});d.sortables=[],a(e.connectToSortable).each(function(){var c=a.data(this,"sortable");c&&!c.options.disabled&&(d.sortables.push({instance:c,shouldRevert:c.options.revert}),c.refreshPositions(),c._trigger("activate",b,f))})},stop:function(b,c){var d=a(this).data("draggable"),e=a.extend({},c,{item:d.element});a.each(d.sortables,function(){this.instance.isOver?(this.instance.isOver=0,d.cancelHelperRemoval=!0,this.instance.cancelHelperRemoval=!1,this.shouldRevert&&(this.instance.options.revert=!0),this.instance._mouseStop(b),this.instance.options.helper=this.instance.options._helper,d.options.helper=="original"&&this.instance.currentItem.css({top:"auto",left:"auto"})):(this.instance.cancelHelperRemoval=!1,this.instance._trigger("deactivate",b,e))})},drag:function(b,c){var d=a(this).data("draggable"),e=this,f=function(b){var c=this.offset.click.top,d=this.offset.click.left,e=this.positionAbs.top,f=this.positionAbs.left,g=b.height,h=b.width,i=b.top,j=b.left;return a.ui.isOver(e+c,f+d,i,j,g,h)};a.each(d.sortables,function(f){this.instance.positionAbs=d.positionAbs,this.instance.helperProportions=d.helperProportions,this.instance.offset.click=d.offset.click,this.instance._intersectsWith(this.instance.containerCache)?(this.instance.isOver||(this.instance.isOver=1,this.instance.currentItem=a(e).clone().removeAttr("id").appendTo(this.instance.element).data("sortable-item",!0),this.instance.options._helper=this.instance.options.helper,this.instance.options.helper=function(){return c.helper[0]},b.target=this.instance.currentItem[0],this.instance._mouseCapture(b,!0),this.instance._mouseStart(b,!0,!0),this.instance.offset.click.top=d.offset.click.top,this.instance.offset.click.left=d.offset.click.left,this.instance.offset.parent.left-=d.offset.parent.left-this.instance.offset.parent.left,this.instance.offset.parent.top-=d.offset.parent.top-this.instance.offset.parent.top,d._trigger("toSortable",b),d.dropped=this.instance.element,d.currentItem=d.element,this.instance.fromOutside=d),this.instance.currentItem&&this.instance._mouseDrag(b)):this.instance.isOver&&(this.instance.isOver=0,this.instance.cancelHelperRemoval=!0,this.instance.options.revert=!1,this.instance._trigger("out",b,this.instance._uiHash(this.instance)),this.instance._mouseStop(b,!0),this.instance.options.helper=this.instance.options._helper,this.instance.currentItem.remove(),this.instance.placeholder&&this.instance.placeholder.remove(),d._trigger("fromSortable",b),d.dropped=!1)})}}),a.ui.plugin.add("draggable","cursor",{start:function(b,c){var d=a("body"),e=a(this).data("draggable").options;d.css("cursor")&&(e._cursor=d.css("cursor")),d.css("cursor",e.cursor)},stop:function(b,c){var d=a(this).data("draggable").options;d._cursor&&a("body").css("cursor",d._cursor)}}),a.ui.plugin.add("draggable","opacity",{start:function(b,c){var d=a(c.helper),e=a(this).data("draggable").options;d.css("opacity")&&(e._opacity=d.css("opacity")),d.css("opacity",e.opacity)},stop:function(b,c){var d=a(this).data("draggable").options;d._opacity&&a(c.helper).css("opacity",d._opacity)}}),a.ui.plugin.add("draggable","scroll",{start:function(b,c){var d=a(this).data("draggable");d.scrollParent[0]!=document&&d.scrollParent[0].tagName!="HTML"&&(d.overflowOffset=d.scrollParent.offset())},drag:function(b,c){var d=a(this).data("draggable"),e=d.options,f=!1;if(d.scrollParent[0]!=document&&d.scrollParent[0].tagName!="HTML"){if(!e.axis||e.axis!="x")d.overflowOffset.top+d.scrollParent[0].offsetHeight-b.pageY<e.scrollSensitivity?d.scrollParent[0].scrollTop=f=d.scrollParent[0].scrollTop+e.scrollSpeed:b.pageY-d.overflowOffset.top<e.scrollSensitivity&&(d.scrollParent[0].scrollTop=f=d.scrollParent[0].scrollTop-e.scrollSpeed);if(!e.axis||e.axis!="y")d.overflowOffset.left+d.scrollParent[0].offsetWidth-b.pageX<e.scrollSensitivity?d.scrollParent[0].scrollLeft=f=d.scrollParent[0].scrollLeft+e.scrollSpeed:b.pageX-d.overflowOffset.left<e.scrollSensitivity&&(d.scrollParent[0].scrollLeft=f=d.scrollParent[0].scrollLeft-e.scrollSpeed)}else{if(!e.axis||e.axis!="x")b.pageY-a(document).scrollTop()<e.scrollSensitivity?f=a(document).scrollTop(a(document).scrollTop()-e.scrollSpeed):a(window).height()-(b.pageY-a(document).scrollTop())<e.scrollSensitivity&&(f=a(document).scrollTop(a(document).scrollTop()+e.scrollSpeed));if(!e.axis||e.axis!="y")b.pageX-a(document).scrollLeft()<e.scrollSensitivity?f=a(document).scrollLeft(a(document).scrollLeft()-e.scrollSpeed):a(window).width()-(b.pageX-a(document).scrollLeft())<e.scrollSensitivity&&(f=a(document).scrollLeft(a(document).scrollLeft()+e.scrollSpeed))}f!==!1&&a.ui.ddmanager&&!e.dropBehaviour&&a.ui.ddmanager.prepareOffsets(d,b)}}),a.ui.plugin.add("draggable","snap",{start:function(b,c){var d=a(this).data("draggable"),e=d.options;d.snapElements=[],a(e.snap.constructor!=String?e.snap.items||":data(draggable)":e.snap).each(function(){var b=a(this),c=b.offset();this!=d.element[0]&&d.snapElements.push({item:this,width:b.outerWidth(),height:b.outerHeight(),top:c.top,left:c.left})})},drag:function(b,c){var d=a(this).data("draggable"),e=d.options,f=e.snapTolerance,g=c.offset.left,h=g+d.helperProportions.width,i=c.offset.top,j=i+d.helperProportions.height;for(var k=d.snapElements.length-1;k>=0;k--){var l=d.snapElements[k].left,m=l+d.snapElements[k].width,n=d.snapElements[k].top,o=n+d.snapElements[k].height;if(!(l-f<g&&g<m+f&&n-f<i&&i<o+f||l-f<g&&g<m+f&&n-f<j&&j<o+f||l-f<h&&h<m+f&&n-f<i&&i<o+f||l-f<h&&h<m+f&&n-f<j&&j<o+f)){d.snapElements[k].snapping&&d.options.snap.release&&d.options.snap.release.call(d.element,b,a.extend(d._uiHash(),{snapItem:d.snapElements[k].item})),d.snapElements[k].snapping=!1;continue}if(e.snapMode!="inner"){var p=Math.abs(n-j)<=f,q=Math.abs(o-i)<=f,r=Math.abs(l-h)<=f,s=Math.abs(m-g)<=f;p&&(c.position.top=d._convertPositionTo("relative",{top:n-d.helperProportions.height,left:0}).top-d.margins.top),q&&(c.position.top=d._convertPositionTo("relative",{top:o,left:0}).top-d.margins.top),r&&(c.position.left=d._convertPositionTo("relative",{top:0,left:l-d.helperProportions.width}).left-d.margins.left),s&&(c.position.left=d._convertPositionTo("relative",{top:0,left:m}).left-d.margins.left)}var t=p||q||r||s;if(e.snapMode!="outer"){var p=Math.abs(n-i)<=f,q=Math.abs(o-j)<=f,r=Math.abs(l-g)<=f,s=Math.abs(m-h)<=f;p&&(c.position.top=d._convertPositionTo("relative",{top:n,left:0}).top-d.margins.top),q&&(c.position.top=d._convertPositionTo("relative",{top:o-d.helperProportions.height,left:0}).top-d.margins.top),r&&(c.position.left=d._convertPositionTo("relative",{top:0,left:l}).left-d.margins.left),s&&(c.position.left=d._convertPositionTo("relative",{top:0,left:m-d.helperProportions.width}).left-d.margins.left)}!d.snapElements[k].snapping&&(p||q||r||s||t)&&d.options.snap.snap&&d.options.snap.snap.call(d.element,b,a.extend(d._uiHash(),{snapItem:d.snapElements[k].item})),d.snapElements[k].snapping=p||q||r||s||t}}}),a.ui.plugin.add("draggable","stack",{start:function(b,c){var d=a(this).data("draggable").options,e=a.makeArray(a(d.stack)).sort(function(b,c){return(parseInt(a(b).css("zIndex"),10)||0)-(parseInt(a(c).css("zIndex"),10)||0)});if(!!e.length){var f=parseInt(e[0].style.zIndex)||0;a(e).each(function(a){this.style.zIndex=f+a}),this[0].style.zIndex=f+e.length}}}),a.ui.plugin.add("draggable","zIndex",{start:function(b,c){var d=a(c.helper),e=a(this).data("draggable").options;d.css("zIndex")&&(e._zIndex=d.css("zIndex")),d.css("zIndex",e.zIndex)},stop:function(b,c){var d=a(this).data("draggable").options;d._zIndex&&a(c.helper).css("zIndex",d._zIndex)}})})(jqcc);

/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la) */
(function($) {

  jqcc.fn.extend({
    slimScroll: function(options) {

      var defaults = {
        wheelStep : 20,
        width : 'auto',
        height : 'auto',
        size : '7px',
        color: '#000',
        position : 'right',
        distance : '1px',
        start : 'top',
        opacity : .4,
        alwaysVisible : false,
        railVisible : false,
        railColor : '#333',
        railOpacity : '0.2',
        railClass : 'slimScrollRail',
        barClass : 'slimScrollBar',
        wrapperClass : 'slimScrollDiv',
        allowPageScroll: false,
        scroll: 0,
		resize: 0
      };

      var o = ops = $.extend( defaults , options );

      this.each(function(){

      var isOverPanel, isOverBar, isDragg, queueHide, barHeight, percentScroll,
        divS = '<div></div>',
        minBarHeight = 30,
        releaseScroll = false,
        wheelStep = parseInt(o.wheelStep),
        cwidth = o.width,
        cheight = o.height,
        size = o.size,
        color = o.color,
        position = o.position,
        distance = o.distance,
        start = o.start,
        opacity = o.opacity,
        alwaysVisible = o.alwaysVisible,
        railVisible = o.railVisible,
        railColor = o.railColor,
        railOpacity = o.railOpacity,
        allowPageScroll = o.allowPageScroll,
        scroll = o.scroll;
		resize = o.resize;
      
        var me = $(this);

        if (me.parent().hasClass('slimScrollDiv')) {
            if (scroll) {
				bar = me.parent().find('.slimScrollBar');
				rail = me.parent().find('.slimScrollRail');
				getBarHeight();
				loc = me.outerHeight() - bar.outerHeight();
				bar.css({ top: loc });
		        scrollContent(0, true);
            }

			 if (resize) {
				bar = me.parent().find('.slimScrollBar');
	            rail = me.parent().find('.slimScrollRail');
	   			getBarHeight();
			 }

            return;
        }

        var wrapper = $(divS)
          .addClass( o.wrapperClass )
          .css({
            position: 'relative',
            overflow: 'hidden',
            width: cwidth,
            height: cheight
          });

		var cw = me;

		while (parseInt(cw.css('width')) <= 0) {
			cw = cw.parent();
		}

		if (typeof cw == 'undefined' || typeof cw.css('width') == 'undefined' || cw.css('width') == 'auto') {
		} else { 
			newwidth = (cw.css('width').replace('px','')-10 + 8 )+'px';
			me.css({ width: newwidth });
		}

		me.css({
          overflow: 'hidden'
		});	

		/*if (position == 'right') {
			me.css({'padding-right':'0px'});
		} else {
			me.css({'padding-left':'0px'});
		}*/

        var rail  = $(divS)
          .addClass( o.railClass )
          .css({
            width: size,
            height: '100%',
            position: 'absolute',
            top: 0,
            display: (alwaysVisible && railVisible) ? 'block' : 'none',
            'border-radius': size,
            background: railColor,
            opacity: railOpacity,
            zIndex: 90
          });

        var bar = $(divS)
          .addClass( o.barClass )
          .css({
            background: color,
            width: size,
            position: 'absolute',
            top: 0,
            opacity: opacity,
            display: alwaysVisible ? 'block' : 'none',
            'border-radius' : size,
            BorderRadius: size,
            MozBorderRadius: size,
            WebkitBorderRadius: size,
            zIndex: 99
          });

        var posCss = (position == 'right') ? { right: distance } : { left: distance };
        rail.css(posCss);
        bar.css(posCss);

        me.wrap(wrapper);
        me.parent().append(bar);
        me.parent().append(rail);

        bar.draggable({ 
          axis: 'y', 
          containment: 'parent',
          start: function() { isDragg = true; },
          stop: function() { isDragg = false; hideBar(); },
          drag: function(e) 
          { 
            scrollContent(0, $(this).position().top, false);
          }
        });

        rail.hover(function(){
          showBar();
        }, function(){
          hideBar();
        });

        bar.hover(function(){
          isOverBar = true;
        }, function(){
          isOverBar = false;
        });

        me.hover(function(){
          isOverPanel = true;
          showBar();
          hideBar();
        }, function(){
          isOverPanel = false;
          hideBar();
        });

        var _onWheel = function(e)
        {
          if (!isOverPanel) { return; }

          var e = e || window.event;

          var delta = 0;
          if (e.wheelDelta) { delta = -e.wheelDelta/120; }
          if (e.detail) { delta = e.detail / 3; }

          scrollContent(delta, true);

          if (e.preventDefault && !releaseScroll) { e.preventDefault(); }
          if (!releaseScroll) { e.returnValue = false; }
        }

        function scrollContent(y, isWheel, isJump)
        {

          var delta = y;

          if (isWheel)
          {
            delta = parseInt(bar.css('top')) + y * wheelStep / 100 * bar.outerHeight();

            var maxTop = me.outerHeight() - bar.outerHeight();
            delta = Math.min(Math.max(delta, 0), maxTop);

            bar.css({ top: delta + 'px' });
          }

          percentScroll = parseInt(bar.css('top')) / (me.outerHeight() - bar.outerHeight());
          delta = percentScroll * (me[0].scrollHeight - me.outerHeight());

          if (isJump)
          {
            delta = y;
            var offsetTop = delta / me[0].scrollHeight * me.outerHeight();
            bar.css({ top: offsetTop + 'px' });
          }

          me.scrollTop(delta);
          showBar();
          hideBar();
        }

        var attachWheel = function()
        {
          if (window.addEventListener)
          {
            this.addEventListener('DOMMouseScroll', _onWheel, false );
            this.addEventListener('mousewheel', _onWheel, false );
          } 
          else
          {
            document.attachEvent("onmousewheel", _onWheel)
          }
        }

		attachWheel();

        function getBarHeight() {
			barHeight = 0;

			if (me[0].scrollHeight != 0) {
				barHeight = Math.max((me.outerHeight() / me[0].scrollHeight) * me.outerHeight(), minBarHeight);	
			}
			
			bar.css({ height: barHeight + 'px' });
        }

        getBarHeight();

        function showBar()
        {
          getBarHeight();
          clearTimeout(queueHide);

          releaseScroll = allowPageScroll && percentScroll == ~~ percentScroll;
          if(barHeight >= me.outerHeight()) {
            releaseScroll = true;
            return;
          }
          bar.stop(true,true).fadeIn('fast');
          if (railVisible) { rail.stop(true,true).fadeIn('fast'); }
        }

        function hideBar()
        {
          if (!alwaysVisible)
          {
            queueHide = setTimeout(function(){
              if (!isOverBar && !isDragg) 
              { 
                bar.fadeOut('slow');
                rail.fadeOut('slow');
              }
            }, 1000);
          }
        }

        if (start == 'bottom') 
        {
          bar.css({ top: me.outerHeight() - bar.outerHeight() });
          scrollContent(0, true);
        }
        else if (typeof start == 'object')
        {
          scrollContent($(start).position().top, null, true);

          if (!alwaysVisible) { bar.hide(); }
        }
      });
      
      return this;
    }
  });

  jqcc.fn.extend({
    slimscroll: jqcc.fn.slimScroll
  });

})(jqcc);
if (typeof(jqcc) === 'undefined') {
	jqcc = jQuery;
}
(function($) {
    var settings = {};
    settings = jqcc.cometchat.getcrAllVariables();
    var calleeAPI = jqcc.cometchat.getChatroomVars('calleeAPI');
    
    $.standard = (function() {
            return {
                playsound: function() {
                        try	{
                            jqcc.cometchat.getFlashMovie("cometchatbeep").beep();
                        } catch (error) {
                            jqcc.cometchat.setChatroomVars('messageBeep',0);
                        }
                },
                sendChatroomMessage: function(chatboxtextarea) {
                    $(chatboxtextarea).val('');
                    $(chatboxtextarea).css('height','18px');
                    var height = $[calleeAPI].crgetWindowHeight();
                    $("#currentroom_convo").css('height',height-58-parseInt($('.cometchat_textarea').css('height'))-8-3);
                    $("#currentroom_left .slimScrollDiv").css('height',$("#currentroom_convo").css('height'));
                    $(chatboxtextarea).css('overflow-y','hidden');
                    $(chatboxtextarea).focus();
                },
                createChatroom: function() {
                    $[calleeAPI].hidetabs();
                    $('#createtab').addClass('tab_selected');
                    $('#create').css('display','block');
                    $('.welcomemessage').html('Invitation only rooms will not be displayed in the lobby');
                },
                getTimeDisplay: function(ts,id) {
                    var style ="style=\"display:none;\"";

                    if (typeof(jqcc.ccchattime)!='undefined' && jqcc.ccchattime.getEnabled(id,0)) {
                            style="style=\"display:inline;\"";
                    }
                    var ap = "";
                    var hour = ts.getHours();
                    var minute = ts.getMinutes();		
                    var date = ts.getDate();
                    var month = ts.getMonth();
                    var armyTime = jqcc.cometchat.getChatroomVars('armyTime');

                    if (armyTime != 1) {
                            if (hour > 11) { ap = "pm"; } else { ap = "am"; }
                            if (hour > 12) { hour = hour - 12; }
                            if (hour == 0) { hour = 12; }
                    } else {
                            if (hour < 10) { hour = "0" + hour; }
                    }

                    if (minute < 10) { minute = "0" + minute; }

                    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                    var type = 'th';
                    if (date == 1 || date == 21 || date == 31) { type = 'st'; }
                    else if (date == 2 || date == 22) { type = 'nd'; }
                    else if (date == 3 || date == 23) { type = 'rd'; }

                    if (date != jqcc.cometchat.getChatroomVars('todaysDay')) {
                            return "<span class=\"cometchat_ts\" "+style+">("+hour+":"+minute+ap+" "+date+type+" "+months[month]+")</span>";
                    } else {
                            return "<span class=\"cometchat_ts\" "+style+">("+hour+":"+minute+ap+")</span>";
                    }
                },
                addChatroomMessage: function(id,incomingmessage,incomingid,selfadded,sent,cometservice,fromname) {
                    if(typeof(fromname) === 'undefined'){
                        fromname = 'Me';
                    }
                    if (cometservice == '0') {
                        separator = ':  ';
                        if ($("#cometchat_message_"+incomingid).length > 0) {
                            $("#cometchat_message_"+incomingid+' .cometchat_chatboxmessagecontent').html(incomingmessage);
                        } else {
                            sentdata = '';
                            if (sent != null) {
                                var ts = new Date(parseInt(sent));
                                sentdata = $[calleeAPI].getTimeDisplay(ts,id);
                            }
                            if (!jqcc.cometchat.getChatroomVars('fullName') && fromname.indexOf(" ") != -1) {
                                fromname = fromname.slice(0,fromname.indexOf(" "));
                            }
                            if (parseInt(selfadded) == 1) {
                                incomingmessage = incomingmessage.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br>").replace(/\"/g,"&quot;");
                                if ($.cookie(jqcc.cometchat.getChatroomVars('cookie_prefix')+"chatroomcolor") != '') {
                                    incomingmessage = '<span style="color:#'+$.cookie(jqcc.cometchat.getChatroomVars('cookie_prefix')+"chatroomcolor")+'">'+incomingmessage+'</span>';
                                }
                            }
                            if (jqcc.cometchat.getChatroomVars('allowDelete') == 1) {
                                $("#currentroom_convotext").append('<div class="cometchat_chatboxmessage" id="cometchat_message_'+incomingid+'"><span class="cometchat_chatboxmessagefrom"><strong>'+fromname+'</strong>'+separator+'</span><span class="cometchat_chatboxmessagecontent">'+incomingmessage+'</span>'+sentdata+'<span class="delete_msg" onclick="javascript:jqcc.cometchat.confirmDelete(\''+incomingid+'\');">(<span class="hoverbraces">delete</span>)</span></div>');
                                $(".cometchat_chatboxmessage").mouseover(function() {
                                    $(this).find(".delete_msg").css('display','inline');
                                });
                                $(".cometchat_chatboxmessage").mouseout(function() {
                                    $(this).find(".delete_msg").css('display','none');
                                });
                                $(".delete_msg").mouseover(function() {
                                    $(this).css('display','inline');
                                    $(this).find(".hoverbraces").css('text-decoration','underline');
                                });
                                $(".delete_msg").mouseout(function() {
                                    $(this).find(".hoverbraces").css('text-decoration','none');
                                });
                            }
                        }
                    } else {
                        var temp = '';
                        settings.timestamp=id;
                        separator = ':  ';  
                        var bannedKicked = incomingmessage;
                        var bannedOrKicked=bannedKicked.split('_');
                        if (bannedOrKicked[1]=='kicked' || bannedOrKicked[1]=='banned') {
                            if (settings.myid==bannedOrKicked[2]) {
                                if (bannedOrKicked[1]=='kicked') {
                                    jqcc.cometchat.kickChatroomUser(bannedOrKicked[1],id);
                                    alert ('You have been kicked from this chatroom.');
                                    jqcc.cometchat.leaveChatroom();
                                }
                                if (bannedOrKicked[1]=='banned') {
                                    jqcc.cometchat.banChatroomUser(bannedOrKicked[1],id);
                                    alert ('Sorry, you are banned from this chatroom.');
                                    jqcc.cometchat.leaveChatroom(bannedOrKicked[2], 1);
                                }
                            }
                            $("#cometchat_userlist_"+bannedOrKicked[2]).remove();
                        }  else if(bannedOrKicked[1] == "deletemessage") {
                            $("#cometchat_message_"+bannedOrKicked[2]).remove();
                        } else {
                            if ($("#cometchat_message_"+id).length > 0) { 
                                $("#cometchat_message_"+id+' .cometchat_chatboxmessagecontent').html(incomingmessage);
                            } else {
                                if (incomingmessage.indexOf('CC^CONTROL_deletemessage_') <= -1) {
                                    sentdata = '';
                                    if (sent != null) {
                                        var ts = new Date(parseInt(sent));
                                        sentdata = $[calleeAPI].getTimeDisplay(ts,id);
                                    }
                                    if (!settings.fullName && fromname.indexOf(" ") != -1) {
                                        fromname = fromname.slice(0,fromname.indexOf(" "));
                                    }
                                    if (incomingid != settings.myid) {
                                        temp += ('<div class="cometchat_chatboxmessage" id="cometchat_message_'+id+'"><span class="cometchat_chatboxmessagefrom"><strong>');
                                        if (settings.apiAccess && incomingid != 0) {
                                            temp += ('<a href="javascript:void(0)" onclick="javascript:parent.jqcc.cometchat.chatWith(\''+incomingid+'\');">');
                                        }
                                        temp += fromname;
                                        if (settings.apiAccess && incomingid != 0) {
                                            temp += ('</a>');
                                        }
                                        temp += ('</strong>'+separator+'</span><span class="cometchat_chatboxmessagecontent">'+incomingmessage+'</span>'+sentdata+'</div>');
                                    } else {
                                        temp += ('<div class="cometchat_chatboxmessage" id="cometchat_message_'+id+'"><span class="cometchat_chatboxmessagefrom"><strong>'+fromname+'</strong>'+separator+'</span><span class="cometchat_chatboxmessagecontent">'+incomingmessage+'</span>'+sentdata+'</div>');
                                    }
                                    $("#currentroom_convotext").append(temp);
                                    if ($.cookie(jqcc.cometchat.getChatroomVars('cookie_prefix')+"sound") && $.cookie(jqcc.cometchat.getChatroomVars('cookie_prefix')+"sound") == 'true') { } else {
                                        $[calleeAPI].playsound();
                                    }
                                }
                            }
                        }
                        if(jqcc.cometchat.getChatroomVars('owner')|| jqcc.cometchat.getChatroomVars('isModerator') || (jqcc.cometchat.getChatroomVars('allowDelete') == 1 && incomingid == settings.myid)) {
                            if ($("#cometchat_message_"+id+" .delete_msg").length < 1) {
                                jqcc('#cometchat_message_'+id+' .cometchat_ts').after('<span class="delete_msg" onclick="javascript:jqcc.cometchat.confirmDelete(\''+id+'\');">(<span class="hoverbraces">delete</span>)</span>');
                            }
                            $(".cometchat_chatboxmessage").mouseover(function() {
                                $(this).find(".delete_msg").css('display','inline');
                            });
                            $(".cometchat_chatboxmessage").mouseout(function() {
                                $(this).find(".delete_msg").css('display','none');
                            });
                            $(".delete_msg").mouseover(function() {
                                $(this).css('display','inline');
                            });
                        }
                        $[calleeAPI].chatroomScrollDown();
                        if (settings.apiAccess == 1 && typeof (parent.jqcc.cometchat.setAlert) != 'undefined') {
                            parent.jqcc.cometchat.setAlert('chatrooms',jqcc.cometchat.getChatroomVars('newMessages'));
                        }
                    }
                },
                chatroomBoxKeyup: function(event,chatboxtextarea) {
                    if (event.keyCode == 13 && event.shiftKey == 0)  {
                        $(chatboxtextarea).val('');
                    }
                    var adjustedHeight = chatboxtextarea.clientHeight;
                    var maxHeight = 94;
                    var height = $[calleeAPI].crgetWindowHeight();

                    if (maxHeight > adjustedHeight) {
                        adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
                        if (maxHeight)
                            adjustedHeight = Math.min(maxHeight, adjustedHeight);
                        if (adjustedHeight > chatboxtextarea.clientHeight) {
                            $(chatboxtextarea).css('height',adjustedHeight+6 +'px');
                            $("#currentroom_convo").css('height',height-58-parseInt($('.cometchat_textarea').css('height'))-6-3);
                            $("#currentroom_left .slimScrollDiv").css('height',$("#currentroom_convo").css('height'));
                            $[calleeAPI].chatroomScrollDown();
                        }
                    } else {
                        $(chatboxtextarea).css('overflow-y','auto');
                    }
                },
                hidetabs: function() {
                    $('li').removeClass('tab_selected');
                    $('#lobby').css('display','none');
                    $('#currentroom').css('display','none');
                    $('#create').css('display','none');
                    $('#plugins').css('display','none');
                },
                loadLobby: function() {
                    $[calleeAPI].hidetabs();
                    $('#lobbytab').addClass('tab_selected');
                    $('#lobby').css('display','block');
                    $('.welcomemessage').html('Please select a public/private chatroom you would like to join');
                    clearTimeout(jqcc.cometchat.getChatroomVars('heartbeatTimer'));
                    jqcc.cometchat.chatroomHeartbeat(1);
                },
                crcheckDropDown: function(dropdown) {
                    var id = $('#type').attr("selectedIndex");
                    if (id == 1) {
                        $('.password_hide').css('display','block');
                    } else {
                        $('.password_hide').css('display','none');
                    }
                },
                loadRoom: function() {
                    var roomname = jqcc.cometchat.getChatroomVars('currentroomname');
                    var roomno = jqcc.cometchat.getChatroomVars('currentroom');

                    $[calleeAPI].hidetabs();
                    $('#plugins').css('display','block');
                    $('#currentroom').css('display','block');
                    $('#currentroomtab').css('display','block');
                    $('#currentroomtab').addClass('tab_selected');
                    $('.welcomemessage').html('<a href="javascript:void(0);" onclick="javascript:jqcc.cometchat.leaveChatroom()">Leave room</a>'+'<span> | </span>'+'<a href="javascript:void(0);" onclick="javascript:jqcc.cometchat.inviteChatroomUser()">Invite users</a>'+'<span id="unbanuser"> | <a  href="javascript:void(0);" onclick="javascript:jqcc.cometchat.unbanChatroomUser()">Unban users</a></span>');
                    document.cookie = 'cc_chatroom='+urlencode(roomno+':'+jqcc.cometchat.getChatroomVars('currentp')+':'+urlencode(roomname));
                    if ($('#currentroomtab a').attr('show')==0) {
                        $('#unbanuser').remove();
                    }
                    var pluginshtml = '';
                    var plugins = jqcc.cometchat.getChatroomVars('plugins');
                    if (plugins.length > 0) {
                        pluginshtml += '<div class="cometchat_plugins">';
                        for (var i = 0;i < plugins.length;i++) {
                            var name = 'cc'+plugins[i];
                            if (typeof($[name]) == 'object') {
                                pluginshtml += '<div class="cometchat_pluginsicon cometchat_'+ settings.plugins[i] + '" title="' + $[name].getTitle() + '" onclick="javascript:jqcc.'+name+'.init('+roomno+',1);"></div>';
                            }
                        }
                        pluginshtml += '</div>';
                    }
                    $('#plugins').html(pluginshtml);
                    $[calleeAPI].chatroomWindowResize();
                },
                chatroomWindowResize: function() {
                    var height = $[calleeAPI].crgetWindowHeight();
                    $(".content_div").css('height',height-58-3);
                    $("#currentroom_convo").css('height',height-58-parseInt($('.cometchat_textarea').css('height'))-4-3-3);

                    var width = $[calleeAPI].crgetWindowWidth();
                    $('#currentroom_left').css('width',width-144-48);
                    $('.cometchat_textarea').css('width',width-174-48);

                    if (jqcc().slimScroll) {	
                        $("#currentroom_left .slimScrollDiv").css('height',$("#currentroom_convo").css('height'));
                        $("#currentroom_right .slimScrollDiv").css('height',$("#currentroom_right").css('height'));
                    }
                },
                kickid: function(kickid) {
                    $("#chatroom_userlist_"+kickid).remove();
                },
                banid: function(banid) {
                    $("#chatroom_userlist_"+banid).remove();
                },
                chatroomScrollDown: function() {
                    if (jqcc().slimScroll) {
                        $('#currentroom_convo').slimScroll({scroll: '1'});
                    } else {
                        setTimeout(function() {
                            $("#currentroom_convo").scrollTop(50000);
                        },100);
                    }
                },
                createChatroomSubmitStruct: function() {
                    var string = $('.create_input').val();
                    var room={};
                    if (($.trim( string )).length == 0) {
                        return false;
                    }
                    var name = document.getElementById('name').value;
                    var type = document.getElementById('type').value;
                    var password = document.getElementById('password').value;
                    if (name != '' && name != null) {
                        name = name.replace(/^\s+|\s+$/g,"");
                        if (type == 1 && password == '') {
                            alert ('Please enter a password');
                            return false;
                        }
                        if (type == 2) {
                            password = 'i'+(Math.round(new Date().getTime()));
                        }
                        if (type == 0) {
                            password = '';
                        }
                    }
                    room['name'] = name;
                    room['password'] = password;
                    room['type'] = type;
                    return room;
                },
                crgetWindowHeight: function() {
                    var windowHeight = 0;
                    if (typeof(window.innerHeight) == 'number') {
                        windowHeight = window.innerHeight; 
                    } else { 
                        if (document.documentElement && document.documentElement.clientHeight) {
                            windowHeight = document.documentElement.clientHeight;
                        } else { 
                            if (document.body && document.body.clientHeight) { 
                                windowHeight = document.body.clientHeight; 
                            } 
                        } 
                    } 
                    return windowHeight; 
                },
                crgetWindowWidth: function() { 
                    var windowWidth = 0;
                    if (typeof(window.innerWidth) == 'number') {
                        windowWidth = window.innerWidth;
                    } else { 
                        if (document.documentElement && document.documentElement.clientWidth) {
                            windowWidth = document.documentElement.clientWidth; 
                        } else { 
                            if (document.body && document.body.clientWidth) { 
                                windowWidth = document.body.clientWidth; 
                            } 
                        } 
                    } 
                    return windowWidth; 
                },
                selectChatroom: function(currentroom,id) {
                    jqcc("#cometchat_userlist_"+currentroom).removeClass("cometchat_chatroomselected");
                    jqcc("#cometchat_userlist_"+id).addClass("cometchat_chatroomselected");
                },
                checkOwnership: function(owner,isModerator,name) {
                    var loadroom = 'javascript:jqcc["'+calleeAPI+'"].loadRoom()';
                    if (owner || isModerator) {
                        jqcc('#currentroomtab').html('<a href="javascript:void(0);" show=1 onclick='+loadroom+'>'+name+'</a>');
                    } else {
                        jqcc('#currentroomtab').html('<a href="javascript:void(0);" show=0 onclick='+loadroom+'>'+name+'</a>');
                    }
                    jqcc('#currentroom_convotext').html('');
                    jqcc("#currentroom_users").html('');					
                },
                leaveRoomClass : function(currentroom) {
                    jqcc("#cometchat_userlist_"+currentroom).removeClass("cometchat_chatroomselected");
                },
                removeCurrentRoomTab : function() {
                    jqcc('#currentroomtab').css('display','none');
                },
                chatroomLogout : function() {
                    window.location.reload();
                },
                loadChatroomList : function(item) {
                    var temp = '';
                    var onlineNumber = 0;
                    $.each(item, function(i,room) {
                        longname = room.name;
                        shortname = room.name;

                        if (room.status == 'available') {
                            onlineNumber++;
                        }
                        var selected = '';

                        if (jqcc.cometchat.getChatroomVars('currentroom') == room.id) {
                            selected = ' cometchat_chatroomselected';
                        }
                        roomtype = '';
                        roomowner = '';

                        if (room.type != 0) {
                            roomtype = '<img src="lock.png" />';
                        }

                        if (room.s == 1) {
                            roomowner = '<img src="user.png" />';
                        }

                        if (room.s == 2) {
                            room.s = 1;
                        }

                        temp += '<div id="cometchat_userlist_'+room.id+'" class="lobby_room'+selected+'" onmouseover="jQuery(this).addClass(\'cometchat_userlist_hover\');" onmouseout="jQuery(this).removeClass(\'cometchat_userlist_hover\');" onclick="javascript:jqcc.cometchat.chatroom(\''+room.id+'\',\''+urlencode(shortname)+'\',\''+room.type+'\',\''+room.i+'\',\''+room.s+'\');" ><span class="lobby_room_1">'+longname+'</span><span class="lobby_room_2">'+room.online+' online</span><span class="lobby_room_3">'+roomtype+'</span><span class="lobby_room_4">'+roomowner+'</span><div style="clear:both"></div></div>';
                    });
                    if (temp != '') {
                        jqcc('#lobby_rooms').html(temp);
                    }
                },
                displayChatroomMessage: function(item,fetchedUsers) {
                    var beepNewMessages = 0;
                    $.each(item, function(i,incoming) {
                        jqcc.cometchat.setChatroomVars('timestamp',incoming.id);

                        if (incoming.message != '') {
                                var temp = '';
                                var fromname = incoming.from;
                                var bannedKicked = incoming.message;																	
                                var bannedOrKicked=bannedKicked.split('_');
                                if (bannedOrKicked[0]=='CC^CONTROL') {
                                    if (bannedOrKicked[1]=='kicked' || bannedOrKicked[1]=='banned') {
                                        if (settings.myid==bannedOrKicked[2]) {
                                            if (bannedOrKicked[1]=='kicked') {
                                                jqcc.cometchat.kickChatroomUser(bannedOrKicked[1],incoming.id);
                                                alert ('You have been kicked from this chatroom.');
                                                jqcc.cometchat.leaveChatroom();
                                            }
                                            if (bannedOrKicked[1]=='banned') {
                                                jqcc.cometchat.banChatroomUser(bannedOrKicked[1],incoming.id);
                                                alert ('Sorry, you are banned from this chatroom.');
                                                jqcc.cometchat.leaveChatroom(bannedOrKicked[2], 1);
                                            }
                                        } 
                                        $("#cometchat_userlist_"+bannedOrKicked[2]).remove();
                                    } else if (bannedOrKicked[1] == "deletemessage") {
                                        $("#cometchat_message_"+bannedOrKicked[2]).remove();
                                    }
                                } else {
                                    if ($("#cometchat_message_"+incoming.id).length > 0) { 
                                        $("#cometchat_message_"+incoming.id+' .cometchat_chatboxmessagecontent').html(incoming.message);
                                    } else {
                                        var ts = new Date(parseInt(incoming.sent)*1000);
                                        if (!settings.fullName && fromname.indexOf(" ") != -1) {
                                            fromname = fromname.slice(0,fromname.indexOf(" "));
                                        }
                                        if (incoming.fromid != settings.myid) {
                                            temp += ('<div class="cometchat_chatboxmessage" id="cometchat_message_'+incoming.id+'"><span class="cometchat_chatboxmessagefrom"><strong>');
                                            if (settings.apiAccess && incoming.fromid != 0) {
                                                temp += ('<a href="javascript:void(0)" onclick="javascript:parent.jqcc.cometchat.chatWith(\''+incoming.fromid+'\');">');
                                            }
                                            temp += fromname;
                                            if (settings.apiAccess && incoming.fromid != 0) {
                                                temp += ('</a>');
                                            }
                                            temp += ('</strong>:&nbsp;&nbsp;</span><span class="cometchat_chatboxmessagecontent">'+incoming.message+'</span>'+$[calleeAPI].getTimeDisplay(ts,incoming.from)+'</div>');
                                            jqcc.cometchat.setChatroomVars('newMessages',jqcc.cometchat.getChatroomVars('newMessages')+1);
                                            beepNewMessages++;
                                        } else {
                                            temp += ('<div class="cometchat_chatboxmessage" id="cometchat_message_'+incoming.id+'"><span class="cometchat_chatboxmessagefrom"><strong>'+fromname+'</strong>:&nbsp;&nbsp;</span><span class="cometchat_chatboxmessagecontent">'+incoming.message+'</span>'+$[calleeAPI].getTimeDisplay(ts,incoming.from)+'</div>');
                                        }
                                    }
                                }
                                $('#currentroom_convotext').append(temp);
                                if (jqcc.cometchat.getChatroomVars('owner') || jqcc.cometchat.getChatroomVars('isModerator') || (incoming.fromid == settings.myid && jqcc.cometchat.getChatroomVars('allowDelete') == 1)) {
                                    if ($("#cometchat_message_"+incoming.id+" .delete_msg").length < 1) {
                                        jqcc('#cometchat_message_'+incoming.id+' .cometchat_ts').after('<span class="delete_msg" onclick="javascript:jqcc.cometchat.confirmDelete(\''+incoming.id+'\');">(<span class="hoverbraces">delete</span>)</span>');
                                    }
                                    $(".cometchat_chatboxmessage").mouseover(function() {
                                        $(this).find(".delete_msg").css('display','inline');
                                    });
                                    $(".cometchat_chatboxmessage").mouseout(function() {
                                        $(this).find(".delete_msg").css('display','none');
                                    });
                                    $(".delete_msg").mouseover(function() {
                                        $(this).css('display','inline');
                                        $(this).find(".hoverbraces").css('text-decoration','underline');
                                    });
                                    $(".delete_msg").mouseout(function() {
                                        $(this).find(".hoverbraces").css('text-decoration','none');
                                    });
                                }
                                $[calleeAPI].chatroomScrollDown();
                            }
                        });
                        jqcc.cometchat.setChatroomVars('heartbeatCount',1);
                        jqcc.cometchat.setChatroomVars('heartbeatTime',settings.minHeartbeat);
                        if (settings.apiAccess == 1 && fetchedUsers == 0 && typeof (parent.jqcc.cometchat.setAlert) != 'undefined') {
                            parent.jqcc.cometchat.setAlert('chatrooms',jqcc.cometchat.getChatroomVars('newMessages'));
                        }
                        if ($.cookie(settings.cookie_prefix+"sound") && $.cookie(settings.cookie_prefix+"sound") == 'true') { } else {
                            if (beepNewMessages > 0 && fetchedUsers == 0) {
                                $[calleeAPI].playsound();
                            }
                        }
                    },
                    silentRoom: function(id, name, silent) {
                        if (settings.lightboxWindows == 1) {
                            jqcc[settings.calleeAPI].loadCCPopup(settings.baseUrl+'modules/chatrooms/chatrooms.php?id='+id+'&basedata='+settings.basedata+'&name='+name+'&silent='+silent+'&action=passwordBox', 'passwordBox',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=1, width=320,height=110",320,110,name); 
                        } else {
                            var temp = prompt('Please enter the chatroom password :','');
                            if (temp) {	
                                jqcc.cometchat.checkChatroomPass(id,name,silent,temp);
                            } else {
                                return;
                            }
                        }
                    },
                    updateChatroomUsers: function(item,fetchedUsers) {
                        var temp = '';
                        var temp1 = '';
                        var newUsers = {};
                        var newUsersName = {};
                        fetchedUsers = 1;
                        $.each(item, function(i,user) {
							if (user.id != jqcc.cometchat.getChatroomVars('kick_ban_id')) {
								longname = user.n;
								if (settings.users[user.id] != 1 && settings.initializeRoom == 0 && settings.hideEnterExit == 0) {
									var ts = new Date();
									$("#currentroom_convotext").append('<div class="cometchat_chatboxalert" id="cometchat_message_0">'+user.n+' has joined the chatroom'+$[calleeAPI].getTimeDisplay(ts,user.id)+'</div>');
									$[calleeAPI].chatroomScrollDown();
								}
								if (parseInt(user.b)!=1) {
									var avatar = '';
									if (user.a != '') {
										avatar = '<span class="cometchat_userscontentavatar"><img class="cometchat_userscontentavatarimage" src='+user.a+'></span>';
									}
									newUsers[user.id] = 1;
									newUsersName[user.id] = user.n;
									userhtml='<div class="cometchat_subsubtitleusers"><hr class="hrleft">Users<hr class="hrright"></div>';
									moderatorhtml='<div class="cometchat_subsubtitle"><hr class="hrleft">Moderators<hr class="hrright"></div>';
									if (jQuery.inArray(user.id ,jqcc.cometchat.getChatroomVars('moderators') ) != -1 ) {
										if (user.id == settings.myid) {
											temp1 += '<div id="chatroom_userlist_'+user.id+'" class="cometchat_userlist" style="cursor:default !important;">'+avatar+'<span class="cometchat_userscontentname">'+longname+'</span></div>';
										} else {
											temp1 += '<div id="chatroom_userlist_'+user.id+'" class="cometchat_userlist" onmouseover="jqcc(this).addClass(\'cometchat_userlist_hover\');" onmouseout="jqcc(this).removeClass(\'cometchat_userlist_hover\');" onClick="jqcc.cometchat.loadChatroomPro('+user.id+','+settings.owner+',\''+user.n+'\')">'+avatar+'<span class="cometchat_userscontentname">'+longname+'</span></div>';
										}
									} else {
										if (user.id == settings.myid) {
											temp += '<div id="chatroom_userlist_'+user.id+'" class="cometchat_userlist" style="cursor:default !important;">'+avatar+'<span class="cometchat_userscontentname">'+longname+'</span></div>';
										} else {
											temp += '<div id="chatroom_userlist_'+user.id+'" class="cometchat_userlist" onmouseover="jqcc(this).addClass(\'cometchat_userlist_hover\');" onmouseout="jqcc(this).removeClass(\'cometchat_userlist_hover\');" onClick="jqcc.cometchat.loadChatroomPro('+user.id+','+settings.owner+',\''+user.n+'\')">'+avatar+'<span class="cometchat_userscontentname">'+longname+'</span></div>';
										}
									}
								}
							}
                        });
                        for (user in settings.users) {
                            if (settings.users.hasOwnProperty(user)) {
                                if (newUsers[user] != 1 && settings.initializeRoom == 0 && settings.hideEnterExit == 0) {
                                    var ts = new Date();
                                    $("#currentroom_convotext").append('<div class="cometchat_chatboxalert" id="cometchat_message_0">'+settings.usersName[user]+' has left the chatroom'+$[calleeAPI].getTimeDisplay(ts,user.id)+'</div>');
                                    $[calleeAPI].chatroomScrollDown();
                                }
                            }
                        }
                        if(temp1 != "" && temp !="")
                            jqcc('#currentroom_users').html(moderatorhtml+temp1+userhtml+temp);
                        else if(temp == "")
                            jqcc('#currentroom_users').html(moderatorhtml+temp1);
                        else
                            jqcc('#currentroom_users').html(userhtml+temp);
                        jqcc.cometchat.setChatroomVars('users',newUsers);
                        jqcc.cometchat.setChatroomVars('usersName',newUsersName);
                        jqcc.cometchat.setChatroomVars('initializeRoom',0);
                    },
                    loadCCPopup: function(url,name,properties,width,height,title,force,allowmaximize,allowresize,allowpopout){
                        if (jqcc.cometchat.getChatroomVars('apiAccess') == 1 && jqcc.cometchat.getChatroomVars('lightboxWindows') == 1) {
                            parent.loadCCPopup(url,name,properties,width,height,title,force,allowmaximize,allowresize,allowpopout);
                        } else {
                            var w = window.open(url,name,properties);
                            w.focus();
                        }
                    },
                    cometchatroomready: function () {                      
                        if (jqcc.cometchat.messageBeep == 1) {
                            $('<div id="cometchat_flashcontent"></div>').appendTo(jqcc("body"));
                            so = new SWFObjectCC(jqcc.cometchat.getChatroomVars('baseUrl')+'swf/sound.swf?2.5', "cometchatbeep", "1", "1", "8", '#000');
                            so.addParam("allowscriptaccess","always");
                            so.addParam('flashvars','base='+jqcc.cometchat.getChatroomVars('baseUrl'));
                            so.write("cometchat_flashcontent");
                        }
                        try {
                            if (parent.jqcc.cometchat.ping() == 1) {
                                jqcc.cometchat.setChatroomVars('apiAccess',1);
                                jqcc("#popouttab").css('display','block');
                            }
                        } catch (e) {}
                        if(jqcc.cometchat.getChatroomVars('calleeAPI') !== 'mobilewebapp') {
                            jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomWindowResize();
                        }	
                        if (jqcc().slimScroll) {
                            jqcc("#currentroom_convo").slimScroll({height: jqcc("#currentroom_convo").css('height')});
                        }
                        window.onresize = function(event) {
                            if(jqcc.cometchat.getChatroomVars('calleeAPI') !== 'mobilewebapp') {
                                jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomWindowResize();
                            }	
                        }
                        jqcc('#currentroom').mouseover(function() {
                            jqcc.cometchat.setChatroomVars('newMessages',0);
                        });
                        jqcc.cometchat.chatroomHeartbeat(1);
                        jqcc(".cometchat_textarea").keydown(function(event) {
                            return jqcc.cometchat.chatroomBoxKeydown(event,this);
                        });
                        jqcc(".cometchat_tabcontentsubmit").click(function(event) {
                            return jqcc.cometchat.chatroomBoxKeydown(event,jqcc(".cometchat_textarea"),1);
                        });
                        jqcc(".cometchat_textarea").keyup(function(event) {
                            return jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomBoxKeyup(event,this);
                        });
                    },
                    chatroomready: function() { 
                        if (jqcc.cometchat.messageBeep == 1) {
                            $('<div id="cometchat_flashcontent"></div>').appendTo(jqcc("body"));
                            so = new SWFObjectCC(jqcc.cometchat.getChatroomVars('baseUrl')+'swf/sound.swf?2.5', "cometchatbeep", "1", "1", "8", '#000');
                            so.addParam("allowscriptaccess","always");
                            so.addParam('flashvars','base='+jqcc.cometchat.getChatroomVars('baseUrl'));
                            so.write("cometchat_flashcontent");
                        }
                        try {
                            if (parent.jqcc.cometchat.ping() == 1) {
                                jqcc.cometchat.setChatroomVars('apiAccess',1);
                                jqcc("#popouttab").css('display','block');
                            }
                        } catch (e) {}
                                if(jqcc.cometchat.getChatroomVars('calleeAPI') !== 'mobilewebapp') {
                                        jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomWindowResize();
                                }	
                        if (jqcc().slimScroll) {
                            jqcc("#currentroom_convo").slimScroll({height: jqcc("#currentroom_convo").css('height')});
                            jqcc("#currentroom_users").slimScroll({height: jqcc("#currentroom_users").css('height')});
                        }
                        window.onresize = function(event) {
                            if(jqcc.cometchat.getChatroomVars('calleeAPI') !== 'mobilewebapp') {
                                    jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomWindowResize();
                            }	
                        }
                        jqcc('#currentroom').mouseover(function() {
                            jqcc.cometchat.setChatroomVars('newMessages',0);
                        });
                        jqcc.cometchat.chatroomHeartbeat(1);
                        jqcc(".cometchat_textarea").keydown(function(event) {
                            return jqcc.cometchat.chatroomBoxKeydown(event,this);
                        });
                        jqcc(".cometchat_tabcontentsubmit").click(function(event) {
                            return jqcc.cometchat.chatroomBoxKeydown(event,jqcc(".cometchat_textarea"),1);
                        });
                        jqcc(".cometchat_textarea").keyup(function(event) {
                            return jqcc[jqcc.cometchat.getChatroomVars('calleeAPI')].chatroomBoxKeyup(event,this);
                        });
                    }
                };
        })();
})(jqcc);