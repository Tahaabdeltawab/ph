"use strict";(self["webpackChunkstudent"]=self["webpackChunkstudent"]||[]).push([[6538],{6538:(t,e,a)=>{a.r(e),a.d(e,{default:()=>Q});var i=a(3673),o=a(2323);const l={class:"col-lg-12 col-sm-12 col-xs-12 col-md-12"},n={class:"row q-col-gutter-lg"},s={class:"col-lg-3 col-sm-12 col-xs-12 col-md-3"},m=(0,i._)("div",{class:"text-subtitle1 text-white"}," Loading... ",-1);function u(t,e,a,u,r,d){const c=(0,i.up)("q-space"),p=(0,i.up)("q-select"),g=(0,i.up)("q-card-section"),q=(0,i.up)("q-img"),h=(0,i.up)("q-separator"),x=(0,i.up)("q-btn"),b=(0,i.up)("q-card-actions"),w=(0,i.up)("q-card"),f=(0,i.up)("q-pagination"),_=(0,i.up)("q-page");return(0,i.wg)(),(0,i.j4)(_,null,{default:(0,i.w5)((()=>[(0,i.Wm)(w,{class:"bg-transparent no-shadow no-border"},{default:(0,i.w5)((()=>[(0,i.Wm)(g,{class:"row"},{default:(0,i.w5)((()=>[(0,i._)("div",l,[(0,i.Wm)(c),(0,i.Wm)(p,{dense:"",outlined:"",style:{"min-width":"200px"},modelValue:t.type,"onUpdate:modelValue":e[0]||(e[0]=e=>t.type=e),options:["All","Free","Paid"],class:"float-right",label:"Category"},null,8,["modelValue"])])])),_:1}),(0,i.Wm)(g,{class:"q-mx-sm"},{default:(0,i.w5)((()=>[(0,i._)("div",n,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(t.getData2,(t=>((0,i.wg)(),(0,i.iD)("div",s,[(0,i.Wm)(w,{style:{"background-color":"#292845"},class:"text-white"},{default:(0,i.w5)((()=>[(0,i.Wm)(q,{src:t.img},{loading:(0,i.w5)((()=>[m])),_:2},1032,["src"]),(0,i.Wm)(h),(0,i.Wm)(g,{class:"text-h5 text-center"},{default:(0,i.w5)((()=>[(0,i.Uk)((0,o.zw)(t.title),1)])),_:2},1024),(0,i.Wm)(g,{class:"text-justify"},{default:(0,i.w5)((()=>[(0,i._)("div",null,(0,o.zw)(t.text),1)])),_:2},1024),(0,i.Wm)(b,null,{default:(0,i.w5)((()=>[(0,i.Wm)(x,{color:"",icon:"remove_red_eye",class:"bg-transparent text-capitalize",flat:"",label:"200 Views"}),(0,i.Wm)(c),(0,i.Wm)(x,{color:"",icon:"chat_bubble",class:"bg-transparent",flat:"",label:"56"})])),_:1})])),_:2},1024)])))),256))])])),_:1}),(0,i.Wm)(b,{align:"center"},{default:(0,i.w5)((()=>[(0,i.Wm)(f,{modelValue:t.page,"onUpdate:modelValue":e[1]||(e[1]=e=>t.page=e),min:t.currentPage,max:Math.ceil(t.getData().length/t.totalPages),input:!0,"input-class":"text-orange-10"},null,8,["modelValue","min","max"])])),_:1})])),_:1})])),_:1})}var r=a(1959);const d=[{img:"https://placeimg.com/500/300/nature?t="+Math.random(),type:"free",text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",title:"Title 1"},{img:"https://placeimg.com/500/300/nature?t="+Math.random(),type:"paid",text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",title:"Title 2"},{img:"https://placeimg.com/500/300/nature?t="+Math.random(),type:"free",text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",title:"Title 3"},{img:"https://placeimg.com/500/300/nature?t="+Math.random(),type:"free",text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",title:"Title 4"},{img:"https://placeimg.com/500/300/nature?t="+Math.random(),type:"paid",text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",title:"Title 5"},{img:"https://placeimg.com/500/300/nature?t="+Math.random(),type:"free",text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",title:"Title 6"}],c=(0,i.aZ)({name:"CardPagination",setup(){return{cards_data:d,type:(0,r.iH)("All"),page:(0,r.iH)(1),currentPage:(0,r.iH)(1),nextPage:(0,r.iH)(null),totalPages:(0,r.iH)(4)}},methods:{getData(){if("All"==this.type)return d;{let t=this;return this.cards_data.filter((function(e){return e.type.toLowerCase()==t.type.toLowerCase()}))}}},computed:{getData2(){return this.getData().slice((this.page-1)*this.totalPages,(this.page-1)*this.totalPages+this.totalPages)}}});var p=a(4260),g=a(4379),q=a(151),h=a(5589),x=a(2025),b=a(3314),w=a(4027),f=a(5869),_=a(9367),y=a(8240),W=a(7300),v=a(7518),P=a.n(v);const Z=(0,p.Z)(c,[["render",u]]),Q=Z;P()(c,"components",{QPage:g.Z,QCard:q.Z,QCardSection:h.Z,QSpace:x.Z,QSelect:b.Z,QImg:w.Z,QSeparator:f.Z,QCardActions:_.Z,QBtn:y.Z,QPagination:W.Z})}}]);