"use strict";(self["webpackChunkstudent"]=self["webpackChunkstudent"]||[]).push([[3408],{3408:(e,t,l)=>{l.r(t),l.d(t,{default:()=>m});var a=l(3673);function s(e,t,l,s,n,c){const o=(0,a.up)("table-mcq-results"),i=(0,a.up)("q-page");return(0,a.wg)(),(0,a.j4)(i,{class:"q-pa-sm"},{default:(0,a.w5)((()=>[(0,a.Wm)(o,{data:c.rows,columns:n.columns,model:n.model},null,8,["data","columns","model"])])),_:1})}l(71);var n=l(3617);const c={middleware:["auth"],name:"MCQ Results",components:{TableMcqResults:(0,a.RC)((()=>Promise.all([l.e(4736),l.e(7513)]).then(l.bind(l,7513))))},methods:{async fetch(){await this.$store.dispatch("definitions/mcqResults")}},async created(){await this.fetch()},data(){return{model:"mcqResults",columns:[{name:"index",align:"left",label:"#",field:"index",sortable:!0},{name:"topic",required:!0,label:"Topic",align:"left",field:e=>e.topic,sortable:!0},{name:"chapter",required:!0,label:"Chapter",align:"left",field:e=>e.chapter,sortable:!0},{name:"score",align:"left",label:"Score",field:e=>e.score,sortable:!0},{name:"action",label:"",field:"Action",sortable:!1,align:"center"}]}},computed:{...(0,n.Se)({mcqResults:"definitions/mcqResults"}),rows(){let e=this.mcqResults;return e.forEach(((e,t)=>{e.index=t+1})),e}}};var o=l(4260),i=l(4379),r=l(7518),d=l.n(r);const u=(0,o.Z)(c,[["render",s]]),m=u;d()(c,"components",{QPage:i.Z})}}]);