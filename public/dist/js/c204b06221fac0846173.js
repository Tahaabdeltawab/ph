"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[94],{5714:(e,t,s)=>{s.d(t,{ZP:()=>j});var r=s(9669),o=s.n(r),a=Object.defineProperty,n=Object.prototype.hasOwnProperty,i=Object.getOwnPropertySymbols,l=Object.prototype.propertyIsEnumerable,c=(e,t,s)=>t in e?a(e,t,{enumerable:!0,configurable:!0,writable:!0,value:s}):e[t]=s,u=(e,t)=>{for(var s in t||(t={}))n.call(t,s)&&c(e,s,t[s]);if(i)for(var s of i(t))l.call(t,s)&&c(e,s,t[s]);return e};const d=e=>void 0===e,m=e=>Array.isArray(e),h=e=>e&&"number"==typeof e.size&&"string"==typeof e.type&&"function"==typeof e.slice,f=(e,t,s,r)=>((t=t||{}).indices=!d(t.indices)&&t.indices,t.nullsAsUndefineds=!d(t.nullsAsUndefineds)&&t.nullsAsUndefineds,t.booleansAsIntegers=!d(t.booleansAsIntegers)&&t.booleansAsIntegers,t.allowEmptyArrays=!d(t.allowEmptyArrays)&&t.allowEmptyArrays,s=s||new FormData,d(e)||(null===e?t.nullsAsUndefineds||s.append(r,""):(e=>"boolean"==typeof e)(e)?t.booleansAsIntegers?s.append(r,e?1:0):s.append(r,e):m(e)?e.length?e.forEach(((e,o)=>{const a=r+"["+(t.indices?o:"")+"]";f(e,t,s,a)})):t.allowEmptyArrays&&s.append(r+"[]",""):(e=>e instanceof Date)(e)?s.append(r,e.toISOString()):!(e=>e===Object(e))(e)||(e=>h(e)&&"string"==typeof e.name&&("object"==typeof e.lastModifiedDate||"number"==typeof e.lastModified))(e)||h(e)?s.append(r,e):Object.keys(e).forEach((o=>{const a=e[o];if(m(a))for(;o.length>2&&o.lastIndexOf("[]")===o.length-2;)o=o.substring(0,o.length-2);f(a,t,s,r?r+"["+o+"]":o)}))),s);var p={serialize:f};function y(e){if(null===e||"object"!=typeof e)return e;const t=Array.isArray(e)?[]:{};return Object.keys(e).forEach((s=>{t[s]=y(e[s])})),t}function v(e){return Array.isArray(e)?e:[e]}function g(e){return e instanceof File||e instanceof Blob||e instanceof FileList||"object"==typeof e&&null!==e&&void 0!==Object.values(e).find((e=>g(e)))}class b{constructor(){this.errors={},this.errors={}}set(e,t){"object"==typeof e?this.errors=e:this.set(u(u({},this.errors),{[e]:v(t)}))}all(){return this.errors}has(e){return Object.prototype.hasOwnProperty.call(this.errors,e)}hasAny(...e){return e.some((e=>this.has(e)))}any(){return Object.keys(this.errors).length>0}get(e){if(this.has(e))return this.getAll(e)[0]}getAll(e){return v(this.errors[e]||[])}only(...e){const t=[];return e.forEach((e=>{const s=this.get(e);s&&t.push(s)})),t}flatten(){return Object.values(this.errors).reduce(((e,t)=>e.concat(t)),[])}clear(e){const t={};e&&Object.keys(this.errors).forEach((s=>{s!==e&&(t[s]=this.errors[s])})),this.set(t)}}class w{constructor(e={}){this.originalData={},this.busy=!1,this.successful=!1,this.recentlySuccessful=!1,this.recentlySuccessfulTimeoutId=void 0,this.errors=new b,this.progress=void 0,this.update(e)}static make(e){return new this(e)}update(e){this.originalData=Object.assign({},this.originalData,y(e)),Object.assign(this,e)}fill(e={}){this.keys().forEach((t=>{this[t]=e[t]}))}data(){return this.keys().reduce(((e,t)=>u(u({},e),{[t]:this[t]})),{})}keys(){return Object.keys(this).filter((e=>!w.ignore.includes(e)))}startProcessing(){this.errors.clear(),this.busy=!0,this.successful=!1,this.progress=void 0,this.recentlySuccessful=!1,clearTimeout(this.recentlySuccessfulTimeoutId)}finishProcessing(){this.busy=!1,this.successful=!0,this.progress=void 0,this.recentlySuccessful=!0,this.recentlySuccessfulTimeoutId=setTimeout((()=>{this.recentlySuccessful=!1}),w.recentlySuccessfulTimeout)}clear(){this.errors.clear(),this.successful=!1,this.recentlySuccessful=!1,this.progress=void 0,clearTimeout(this.recentlySuccessfulTimeoutId)}reset(){Object.keys(this).filter((e=>!w.ignore.includes(e))).forEach((e=>{this[e]=y(this.originalData[e])}))}get(e,t={}){return this.submit("get",e,t)}post(e,t={}){return this.submit("post",e,t)}patch(e,t={}){return this.submit("patch",e,t)}put(e,t={}){return this.submit("put",e,t)}delete(e,t={}){return this.submit("delete",e,t)}submit(e,t,s={}){return this.startProcessing(),s=u({data:{},params:{},url:this.route(t),method:e,onUploadProgress:this.handleUploadProgress.bind(this)},s),"get"===e.toLowerCase()?s.params=u(u({},this.data()),s.params):(s.data=u(u({},this.data()),s.data),g(s.data)&&(s.transformRequest=[e=>p.serialize(e)])),new Promise(((e,t)=>{(w.axios||o()).request(s).then((t=>{this.finishProcessing(),e(t)})).catch((e=>{this.handleErrors(e),t(e)}))}))}handleErrors(e){this.busy=!1,this.progress=void 0,e.response&&this.errors.set(this.extractErrors(e.response))}extractErrors(e){return e.data&&"object"==typeof e.data?e.data.errors?u({},e.data.errors):e.data.message?{error:e.data.message}:u({},e.data):{error:w.errorMessage}}handleUploadProgress(e){this.progress={total:e.total,loaded:e.loaded,percentage:Math.round(100*e.loaded/e.total)}}route(e,t={}){let s=e;return Object.prototype.hasOwnProperty.call(w.routes,e)&&(s=decodeURI(w.routes[e])),"object"!=typeof t&&(t={id:t}),Object.keys(t).forEach((e=>{s=s.replace(`{${e}}`,t[e])})),s}onKeydown(e){const t=e.target;t.name&&this.errors.clear(t.name)}}w.routes={},w.errorMessage="Something went wrong. Please try again.",w.recentlySuccessfulTimeout=2e3,w.ignore=["busy","successful","errors","progress","originalData","recentlySuccessful","recentlySuccessfulTimeoutId"];const j=w},6094:(e,t,s)=>{s.r(t),s.d(t,{default:()=>l});var r=s(7757),o=s.n(r),a=s(5714);function n(e,t,s,r,o,a,n){try{var i=e[a](n),l=i.value}catch(e){return void s(e)}i.done?t(l):Promise.resolve(l).then(r,o)}const i={scrollToTop:!1,metaInfo:function(){return{title:this.$t("settings")}},data:function(){return{form:new a.ZP({username:"",email:"",phone:""})}},computed:(0,s(629).Se)({user:"auth/user"}),created:function(){var e=this;this.form.keys().forEach((function(t){e.form[t]=e.user[t]}))},methods:{update:function(){var e,t=this;return(e=o().mark((function e(){var s,r;return o().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.form.post("/api/update_profile");case 2:s=e.sent,r=s.data,t.$store.dispatch("auth/updateUser",{user:r.data});case 5:case"end":return e.stop()}}),e)})),function(){var t=this,s=arguments;return new Promise((function(r,o){var a=e.apply(t,s);function i(e){n(a,r,o,i,l,"next",e)}function l(e){n(a,r,o,i,l,"throw",e)}i(void 0)}))})()}}};const l=(0,s(1900).Z)(i,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("card",{attrs:{title:e.$t("your_info")}},[s("form",{on:{submit:function(t){return t.preventDefault(),e.update.apply(null,arguments)},keydown:function(t){return e.form.onKeydown(t)}}},[s("alert-success",{attrs:{form:e.form,message:e.$t("info_updated")}}),e._v(" "),s("div",{staticClass:"mb-3 row"},[s("label",{staticClass:"col-md-3 col-form-label text-md-end"},[e._v(e._s(e.$t("name")))]),e._v(" "),s("div",{staticClass:"col-md-7"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.form.username,expression:"form.username"}],staticClass:"form-control",class:{"is-invalid":e.form.errors.has("username")},attrs:{type:"text",name:"username"},domProps:{value:e.form.username},on:{input:function(t){t.target.composing||e.$set(e.form,"username",t.target.value)}}}),e._v(" "),s("has-error",{attrs:{form:e.form,field:"username"}})],1)]),e._v(" "),s("div",{staticClass:"mb-3 row"},[s("label",{staticClass:"col-md-3 col-form-label text-md-end"},[e._v(e._s(e.$t("email")))]),e._v(" "),s("div",{staticClass:"col-md-7"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.form.email,expression:"form.email"}],staticClass:"form-control",class:{"is-invalid":e.form.errors.has("email")},attrs:{type:"email",name:"email"},domProps:{value:e.form.email},on:{input:function(t){t.target.composing||e.$set(e.form,"email",t.target.value)}}}),e._v(" "),s("has-error",{attrs:{form:e.form,field:"email"}})],1)]),e._v(" "),s("div",{staticClass:"mb-3 row"},[s("label",{staticClass:"col-md-3 col-form-label text-md-end"},[e._v(e._s(e.$t("Phone")))]),e._v(" "),s("div",{staticClass:"col-md-7"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.form.phone,expression:"form.phone"}],staticClass:"form-control",class:{"is-invalid":e.form.errors.has("phone")},attrs:{type:"number",name:"phone"},domProps:{value:e.form.phone},on:{input:function(t){t.target.composing||e.$set(e.form,"phone",t.target.value)}}}),e._v(" "),s("has-error",{attrs:{form:e.form,field:"phone"}})],1)]),e._v(" "),s("div",{staticClass:"mb-3 row"},[s("div",{staticClass:"col-md-9 ms-md-auto"},[s("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n          "+e._s(e.$t("update"))+"\n        ")])],1)])],1)])}),[],!1,null,null,null).exports}}]);