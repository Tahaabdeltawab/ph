"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[510],{2104:(t,e,a)=>{a.d(e,{Z:()=>n});const s={computed:(0,a(629).Se)({locale:"lang/locale"}),props:["infos","title"]};const n=(0,a(1900).Z)(s,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"container"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-xl-12 col-lg-12"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-lg-12 restaurent-meal-head mb-md-40"},[a("div",{staticClass:"card"},[a("div",{staticClass:"card-header"},[a("div",{staticClass:"section-header-left"},[a("h3",{staticClass:"text-light-black header-title"},[t._v("\n                    "+t._s(t.title)+"\n                  ")])])]),t._v(" "),a("div",{staticClass:"card-body no-padding"},[a("div",{staticClass:"row"},[t.infos.length?a("div",{staticClass:"col-lg-12"},[a("div",{staticClass:"restaurent-product-list"},[a("div",{staticClass:"restaurent-product-detail"},[a("div",{staticClass:"restaurent-product-left"},[a("div",{staticClass:"restaurent-product-title-box"},[a("div",{staticClass:"restaurent-product-box"},[a("div",{staticClass:"restaurent-product-title"},t._l(t.infos,(function(e){return a("h6",{key:e.id,staticClass:"mb-2"},[a("p",{staticClass:"text-light-black fw-600"},[t._v("\n                                   "+t._s(("ar"==t.locale?e.details_ar:e.details_en)||("ar"==t.locale?e.description_ar:e.description_en))+"\n                                  ")])])})),0)])])])])])]):t._e()])])])])])])])])}),[],!1,null,"6424f604",null).exports},8510:(t,e,a)=>{a.r(e),a.d(e,{default:()=>l});var s=a(7757),n=a.n(s),r=a(629);function i(t,e,a,s,n,r,i){try{var c=t[r](i),o=c.value}catch(t){return void a(t)}c.done?e(o):Promise.resolve(o).then(s,n)}function c(t){return function(){var e=this,a=arguments;return new Promise((function(s,n){var r=t.apply(e,a);function c(t){i(r,s,n,c,o,"next",t)}function o(t){i(r,s,n,c,o,"throw",t)}c(void 0)}))}}const o={components:{About:a(2104).Z},name:"agreement",waitForMe:!0,middleware:"auth",methods:{fetchAgreement:function(){var t=this;return c(n().mark((function e(){return n().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!t.info.agreement.length){e.next=6;break}return t.$store.dispatch("general/changeWait",{wait:!1}),e.next=4,t.$store.dispatch("home/fetchAgreement");case 4:e.next=9;break;case 6:return e.next=8,t.$store.dispatch("home/fetchAgreement");case 8:t.$store.dispatch("general/changeWait",{wait:!1});case 9:case"end":return e.stop()}}),e)})))()}},created:function(){var t=this;return c(n().mark((function e(){return n().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.fetchAgreement();case 2:case"end":return e.stop()}}),e)})))()},metaInfo:function(){return{title:this.$t("Usage Agreement")}},data:function(){return{title:window.config.appName}},computed:(0,r.Se)({info:"home/info"})};const l=(0,a(1900).Z)(o,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("section",{staticClass:"active show tab-pane fade section-padding restaurent-meals bg-light-theme"},[a("about",{attrs:{infos:t.info.agreement,title:t.$t("Usage Agreement")}})],1)}),[],!1,null,"79c9b2d8",null).exports}}]);