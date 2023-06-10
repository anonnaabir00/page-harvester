import{n as i,S as r,b as s,V as c}from"./assets/plugin-vue2_normalizer-4be652fc.js";const m={name:"Header",data(){return{name:null,email:null,phone:null,zip:null,projecttype:"Project Type"}},mounted(){},methods:{sendEmail(){if(this.name===null||this.email===null||this.phone===null||this.zip===null||this.projecttype===null){r.fire({title:"Error!",text:"Please fill out all fields",icon:"error",confirmButtonText:"OK"});return}s({method:"post",url:"/wp-json/ph/v1/email",data:{name:this.name,email:this.email,phone:this.phone,zip:this.zip,projecttype:this.projecttype}}).then(l=>{r.fire({title:"Success!",text:"Your request has been sent. We will contact you shortly",icon:"success",confirmButtonText:"OK"})}).catch(function(l){console.log(l)})}}};var u=function(){var e=this,a=e._self._c;return a("div",[a("div",{staticClass:"w-full sm:hidden md:flex justify-center"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"name"}],staticClass:"phlf-field m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase",attrs:{type:"text",name:"name",id:"name",placeholder:"Name"},domProps:{value:e.name},on:{input:function(t){t.target.composing||(e.name=t.target.value)}}}),a("input",{directives:[{name:"model",rawName:"v-model",value:e.email,expression:"email"}],staticClass:"phlf-field m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase",attrs:{type:"email",name:"email",id:"email",placeholder:"Email"},domProps:{value:e.email},on:{input:function(t){t.target.composing||(e.email=t.target.value)}}}),a("input",{directives:[{name:"model",rawName:"v-model",value:e.phone,expression:"phone"}],staticClass:"phlf-field m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase",attrs:{type:"text",name:"phone",id:"phone",placeholder:"Phone"},domProps:{value:e.phone},on:{input:function(t){t.target.composing||(e.phone=t.target.value)}}}),a("input",{directives:[{name:"model",rawName:"v-model",value:e.zip,expression:"zip"}],staticClass:"phlf-field w-30 m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase",attrs:{type:"text",name:"zip",id:"zip",placeholder:"ZIP"},domProps:{value:e.zip},on:{input:function(t){t.target.composing||(e.zip=t.target.value)}}}),a("select",{directives:[{name:"model",rawName:"v-model",value:e.projecttype,expression:"projecttype"}],staticClass:"phlf-field w-48 m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase",attrs:{name:"project-type",id:"project-type",placeholder:"PROJECT TYPE"},on:{change:function(t){var p=Array.prototype.filter.call(t.target.options,function(n){return n.selected}).map(function(n){var o="_value"in n?n._value:n.value;return o});e.projecttype=t.target.multiple?p:p[0]}}},[a("option",{attrs:{disabled:"",selected:""}},[e._v("Project Type")]),a("option",{attrs:{value:"Dumpster"}},[e._v("Dumpster")]),a("option",{attrs:{value:"Porta Potty"}},[e._v("Porta Potty")]),a("option",{attrs:{value:"Fencing"}},[e._v("Fencing")]),a("option",{attrs:{value:"Multiple"}},[e._v("Multiple")])]),a("button",{staticClass:"phlf-button m-2 pt-3 pb-3 pl-6 pr-6 bg-green-500 text-white text-sm",attrs:{type:"submit"},on:{click:function(t){return e.sendEmail()}}},[e._v("Get Estimate")])])])},d=[],h=i(m,u,d,!1,null,null,null,null);const f=h.exports;new c({el:"#ph-leadform",render:l=>l(f)});
