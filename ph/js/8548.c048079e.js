"use strict";(self["webpackChunkstudent"]=self["webpackChunkstudent"]||[]).push([[8548],{8548:(e,t,a)=>{a.r(t),a.d(t,{default:()=>W});var o=a(3673);const s=(0,o.Uk)(" No results ");function i(e,t,a,i,l,r){const d=(0,o.up)("q-input"),n=(0,o.up)("q-item-section"),u=(0,o.up)("q-item"),m=(0,o.up)("q-select"),c=(0,o.up)("q-form"),p=(0,o.up)("q-separator"),f=(0,o.up)("q-btn"),h=(0,o.up)("q-card-actions"),w=(0,o.up)("q-card"),y=(0,o.up)("q-dialog"),b=(0,o.Q2)("close-popup");return(0,o.wg)(),(0,o.j4)(y,{ref:"EditDialogRef",modelValue:a.show,"onUpdate:modelValue":t[3]||(t[3]=e=>a.show=e),onHide:r.dialogHid},{default:(0,o.w5)((()=>[(0,o.Wm)(w,{class:"my-card q-pa-lg"},{default:(0,o.w5)((()=>[(0,o.Wm)(c,{onReset:r.onReset,class:"q-gutter-md"},{default:(0,o.w5)((()=>[(0,o.Wm)(d,{modelValue:l.form.title,"onUpdate:modelValue":t[0]||(t[0]=e=>l.form.title=e),label:"Title *",autofocus:""},null,8,["modelValue"]),(0,o.Wm)(m,{label:"Year",modelValue:l.form.year,"onUpdate:modelValue":t[1]||(t[1]=e=>l.form.year=e),"use-input":"","hide-selected":"","fill-input":"","input-debounce":"0",options:l.filtered,onFilter:r.filterFn},{"no-option":(0,o.w5)((()=>[(0,o.Wm)(u,null,{default:(0,o.w5)((()=>[(0,o.Wm)(n,{class:"text-grey"},{default:(0,o.w5)((()=>[s])),_:1})])),_:1})])),_:1},8,["modelValue","options","onFilter"])])),_:1},8,["onReset"]),(0,o.Wm)(p),(0,o.Wm)(h,{align:"right"},{default:(0,o.w5)((()=>[(0,o.Wm)(f,{type:"submit",color:"primary",label:"Submit",onClick:t[2]||(t[2]=e=>"create"==a.formAction?r.create():r.update())}),(0,o.wy)((0,o.Wm)(f,{flat:"",color:"primary",label:"Cancel"},null,512),[[b]])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])}a(52);var l=a(3617);a(4434);const r={props:["show","datum","formAction","model"],methods:{dialogHid(){this.$store.commit("config/dialogShow",{dialogShow:!1})},async create(){await this.$store.dispatch(`${this.model}/create`,{new:this.form})},async update(){await this.$store.dispatch(`${this.model}/update`,{id:this.datum.id,new:this.form})},async fetchYears(){await this.$store.dispatch("years/years")},onReset(){Object.keys(this.form).forEach((e=>{this.form[e]=""}))},fillForm(){Object.keys(this.form).forEach((e=>{this.form[e]=this.datum[e]})),this.form["year"]={label:this.datum["year"],value:this.datum["year_id"]}},filterFn(e,t,a){t((()=>{this.filtered=this.yearsOptions.filter((t=>t.label.toLowerCase().indexOf(e.toLowerCase())>-1))}))}},async created(){await this.fetchYears()},updated(){this.show&&this.fillForm()},data(){return{filtered:[],form:{title:"",code:"",year:""}}},computed:{...(0,l.Se)({yearsOptions:"years/yearsOptions"})}};var d=a(4260),n=a(6778),u=a(151),m=a(5269),c=a(4842),p=a(3314),f=a(3414),h=a(2035),w=a(5869),y=a(9367),b=a(8240),g=a(677),q=a(7518),Z=a.n(q);const Q=(0,d.Z)(r,[["render",i],["__scopeId","data-v-ecec21b6"]]),W=Q;Z()(r,"components",{QDialog:n.Z,QCard:u.Z,QForm:m.Z,QInput:c.Z,QSelect:p.Z,QItem:f.Z,QItemSection:h.Z,QSeparator:w.Z,QCardActions:y.Z,QBtn:b.Z}),Z()(r,"directives",{ClosePopup:g.Z})}}]);