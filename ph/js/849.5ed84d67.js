"use strict";(self["webpackChunkstudent"]=self["webpackChunkstudent"]||[]).push([[849],{849:(e,o,l)=>{l.r(o),l.d(o,{default:()=>q});var i=l(3673),t=l(2323);const s={class:"text-h6 text-grey-8"};function n(e,o,l,n,a,r){const c=(0,i.up)("q-card-section"),d=(0,i.up)("q-btn"),m=(0,i.up)("q-icon"),p=(0,i.up)("q-input"),u=(0,i.up)("q-tooltip"),w=(0,i.up)("q-td"),f=(0,i.up)("q-table"),g=(0,i.up)("q-card"),h=(0,i.Q2)("close-popup");return(0,i.wg)(),(0,i.iD)(i.HY,null,[(0,i.Wm)(g,null,{default:(0,i.w5)((()=>[(0,i.Wm)(c,null,{default:(0,i.w5)((()=>[(0,i._)("div",s,(0,t.zw)(l.model.toUpperCase()),1)])),_:1}),(0,i.Wm)(c,{class:"q-pa-none"},{default:(0,i.w5)((()=>[(0,i.Wm)(f,{rows:l.data,columns:l.columns,filter:a.filter,pagination:a.pagination,"onUpdate:pagination":o[2]||(o[2]=e=>a.pagination=e)},(0,i.Nv)({"top-left":(0,i.w5)((()=>[(0,i.Wm)(d,{color:"positive","icon-right":"add",label:"Create","no-caps":"",onClick:o[0]||(o[0]=e=>r.showDialog("create",{}))})])),"top-right":(0,i.w5)((l=>[(0,i.Wm)(p,{borderless:"",dense:"",debounce:"300",modelValue:a.filter,"onUpdate:modelValue":o[1]||(o[1]=e=>a.filter=e),placeholder:"Search"},{append:(0,i.w5)((()=>[(0,i.Wm)(m,{name:"search"})])),_:1},8,["modelValue"]),"list"===a.mode?((0,i.wg)(),(0,i.j4)(d,{key:0,flat:"",round:"",dense:"",icon:l.inFullscreen?"fullscreen_exit":"fullscreen",onClick:l.toggleFullscreen,class:"q-px-sm"},{default:(0,i.w5)((()=>[(0,i.wy)((0,i.Wm)(u,{disable:e.$q.platform.is.mobile},{default:(0,i.w5)((()=>[(0,i.Uk)((0,t.zw)(l.inFullscreen?"Exit Fullscreen":"Toggle Fullscreen"),1)])),_:2},1032,["disable"]),[[h]])])),_:2},1032,["icon","onClick"])):(0,i.kq)("",!0),(0,i.Wm)(d,{color:"primary","icon-right":"archive",label:"Export to csv","no-caps":"",onClick:r.exportTable},null,8,["onClick"])])),"body-cell-action":(0,i.w5)((e=>[(0,i.Wm)(w,{props:e},{default:(0,i.w5)((()=>[(0,i.Wm)(d,{icon:"edit",size:"sm",flat:"",dense:"",onClick:o=>r.showDialog("update",e.row)},null,8,["onClick"]),(0,i.Wm)(d,{icon:"delete",size:"sm",class:"q-ml-sm",flat:"",dense:"",onClick:o=>r.confirmDestroy(e.row.id)},null,8,["onClick"])])),_:2},1032,["props"])])),_:2},["users"==l.model?{name:"body-cell-role",fn:(0,i.w5)((e=>[(0,i.Wm)(w,{props:e},{default:(0,i.w5)((()=>["admin"==e.row.role?((0,i.wg)(),(0,i.j4)(m,{key:0,name:"supervisor_account",color:"info",size:"xs"})):"user"==e.row.role?((0,i.wg)(),(0,i.j4)(m,{key:1,name:"person",color:"primary",size:"xs"})):(0,i.kq)("",!0)])),_:2},1032,["props"])]))}:void 0,"users"==l.model?{name:"body-cell-status",fn:(0,i.w5)((e=>[(0,i.Wm)(w,{props:e},{default:(0,i.w5)((()=>[e.row.status?((0,i.wg)(),(0,i.j4)(m,{key:0,name:"check",color:"positive",size:"xs"})):0==e.row.status?((0,i.wg)(),(0,i.j4)(m,{key:1,name:"close",color:"negative",size:"xs"})):(0,i.kq)("",!0)])),_:2},1032,["props"])]))}:void 0]),1032,["rows","columns","filter","pagination"])])),_:1})])),_:1}),((0,i.wg)(),(0,i.j4)((0,i.LL)(l.model+"-dialog-form"),{model:l.model,formAction:a.formAction,show:e.show,datum:a.selectedDatum},null,8,["model","formAction","show","datum"]))],64)}l(71),l(52);var a=l(3617),r=l(2841),c=l(4434);const d={props:["data","columns","model"],data(){return{formAction:"create",selectedDatum:{},filter:"",mode:"list",pagination:{rowsPerPage:10}}},computed:{...(0,a.Se)({show:"config/dialogShow"})},components:{UsersDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(7904)]).then(l.bind(l,7904)))),UniversitiesDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(126)]).then(l.bind(l,126)))),FacultiesDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(5920)]).then(l.bind(l,5920)))),YearsDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(1944)]).then(l.bind(l,1944)))),TopicsDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(8548)]).then(l.bind(l,8548)))),ChaptersDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(4069)]).then(l.bind(l,4069)))),DefinitionsDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(5948)]).then(l.bind(l,3955)))),FeedbacksDialogForm:(0,i.RC)((()=>Promise.all([l.e(4736),l.e(5731)]).then(l.bind(l,1430))))},methods:{showDialog(e,o){this.formAction=e,this.selectedDatum=o,this.$store.commit("config/dialogShow",{dialogShow:!0})},async destroy(e){await this.$store.dispatch(`${this.model}/destroy`,{id:e})},confirmDestroy(e){this.$q.dialog({dark:!0,title:"Confirm",message:"Would you like to delete this item?",cancel:!0,persistent:!0}).onOk((()=>{this.destroy(e)}))},wrapCsvValue(e,o){let l=void 0!==o?o(e):e;return l=void 0===l||null===l?"":String(l),l=l.split('"').join('""'),`"${l}"`},exportTable(){const e=[this.columns.map((e=>this.wrapCsvValue(e.label)))].concat(this.data.map((e=>this.columns.map((o=>this.wrapCsvValue("function"===typeof o.field?o.field(e):e[void 0===o.field?o.name:o.field],o.format))).join(",")))).join("\r\n"),o=(0,r.Z)("table-export.csv",e,"text/csv");!0!==o&&c.Z.create({message:"Browser denied file download...",color:"negative",icon:"warning"})}}};var m=l(4260),p=l(151),u=l(5589),w=l(5161),f=l(8240),g=l(4842),h=l(4554),C=l(8870),b=l(3884),k=l(677),v=l(7518),y=l.n(v);const D=(0,m.Z)(d,[["render",n]]),q=D;y()(d,"components",{QCard:p.Z,QCardSection:u.Z,QTable:w.Z,QBtn:f.Z,QInput:g.Z,QIcon:h.Z,QTooltip:C.Z,QTd:b.Z}),y()(d,"directives",{ClosePopup:k.Z})}}]);