"use strict";(self["webpackChunkstudent"]=self["webpackChunkstudent"]||[]).push([[6472],{6472:(e,o,l)=>{l.r(o),l.d(o,{default:()=>f});var t=l(3673);function a(e,o,l,a,r,n){const s=(0,t.up)("q-icon"),i=(0,t.up)("q-td"),d=(0,t.up)("q-table"),c=(0,t.up)("q-dialog");return(0,t.wg)(),(0,t.j4)(c,{ref:"EditDialogRef",modelValue:l.show,"onUpdate:modelValue":o[0]||(o[0]=e=>l.show=e),onHide:n.dialogHid},{default:(0,t.w5)((()=>[(0,t.Wm)(d,{dark:"",color:"white",separator:"cell",rows:n.rows,columns:r.columns},{"body-cell-correct":(0,t.w5)((e=>[(0,t.Wm)(i,{props:e},{default:(0,t.w5)((()=>[e.row.correct?((0,t.wg)(),(0,t.j4)(s,{key:0,name:"check",color:"positive",size:"xs"})):0==e.row.correct?((0,t.wg)(),(0,t.j4)(s,{key:1,name:"close",color:"negative",size:"xs"})):(0,t.kq)("",!0)])),_:2},1032,["props"])])),_:1},8,["rows","columns"])])),_:1},8,["modelValue","onHide"])}l(52),l(4434);const r={props:["show","datum"],methods:{dialogHid(){this.$store.commit("config/dialogShow",{dialogShow:!1})}},data(){return{columns:[{name:"index",align:"left",label:"#",field:"index",sortable:!0},{name:"definition",align:"left",label:"Question",field:"definition",sortable:!0},{name:"answer",align:"left",label:"Your answer",field:e=>e.answer,sortable:!0},{name:"term",align:"left",label:"Correct answer",field:e=>e.term,sortable:!0},{name:"correct",align:"left",label:"Correct",field:e=>e.correct,sortable:!0}]}},computed:{rows(){let e=this.datum.data;return e.forEach(((e,o)=>{e.index=o+1})),e}}};var n=l(4260),s=l(6778),i=l(5161),d=l(3884),c=l(4554),u=l(7518),m=l.n(u);const w=(0,n.Z)(r,[["render",a]]),f=w;m()(r,"components",{QDialog:s.Z,QTable:i.Z,QTd:d.Z,QIcon:c.Z})}}]);