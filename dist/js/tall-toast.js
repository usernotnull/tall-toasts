!function(factory){"function"==typeof define&&define.amd?define(factory):factory()}((function(){"use strict";document.addEventListener("alpine:initializing",(function(){window.Alpine.data("ToastComponent",(function($wire){return{duration:$wire.duration,wireToasts:$wire.entangle("toasts"),toasts:[],pendingToasts:[],pendingRemovals:[],count:0,loaded:!1,init:function(){var _this=this;window.Toast={component:this,make:function(message,title,type){return{title:title,message:message,type:type}},info:function(message){var title=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.component.add(this.make(message,title,"info"))},success:function(message){var title=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.component.add(this.make(message,title,"success"))},warning:function(message){var title=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.component.add(this.make(message,title,"warning"))},danger:function(message){var title=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.component.add(this.make(message,title,"danger"))}},addEventListener("toast",(function(event){_this.add(event.detail)})),this.fetchWireToasts(),this.$watch("wireToasts",(function(){_this.fetchWireToasts()})),setTimeout((function(){_this.loaded=!0,_this.pendingToasts.forEach((function(toast){_this.add(toast)})),_this.pendingToasts=null}),$wire.loadDelay)},fetchWireToasts:function(){var _this2=this;this.wireToasts.forEach((function(toast){_this2.add(window.Alpine.raw(toast))})),this.wireToasts.length>0&&$wire.set("toasts",[])},add:function(toast){var _toast$type;!0===this.loaded?(null!==(_toast$type=toast.type)&&void 0!==_toast$type||(toast.type="info"),toast.show=0,toast.index=this.count,this.toasts[this.count]=toast,this.scheduleRemoval(this.count),this.count++):this.pendingToasts.push(toast)},scheduleRemoval:function(toastIndex){var _this3=this;Object.keys(this.pendingRemovals).includes(toastIndex.toString())||(this.pendingRemovals[toastIndex]=setTimeout((function(){_this3.remove(toastIndex)}),this.duration))},scheduleRemovalWithOlder:function(){for(var toastIndex=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.count,i=0;i<=toastIndex;i++)this.scheduleRemoval(i)},cancelRemovalWithNewer:function(toastIndex){for(var i=this.count-1;i>=toastIndex;i--)clearTimeout(this.pendingRemovals[i]),delete this.pendingRemovals[i]},remove:function(index){var _this4=this;this.toasts[index]&&(this.toasts[index].show=0),setTimeout((function(){_this4.toasts[index]="",delete _this4.pendingRemovals[index]}),500)}}}))}))}));
//# sourceMappingURL=tall-toast.js.map
