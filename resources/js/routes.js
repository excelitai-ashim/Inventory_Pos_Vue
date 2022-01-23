
 let login= require('../components/auth/login.vue').default;
 let register= require('../components/auth/register.vue').default;
 let forgetPas= require('../components/auth/forgetPas.vue').default;
 let logout= require('../components/auth/logout.vue').default;
//
 let home= require('../components/home.vue').default;
//
 let addEmployee= require('../components/employee/addEmployee.vue').default;
 let vewAllEmployee= require('../components/employee/vewAllEmployee.vue').default;               
 let editEmployee= require('../components/employee/editEmployee.vue').default;
//
let addSupplier= require('../components/supplier/addSupplier.vue').default;
let vewAllSupplier= require('../components/supplier/vewAllSupplier.vue').default;               
let editSupplier= require('../components/supplier/editSupplier.vue').default;





export const routes = [
    { path: '/', component:login,name:'/' },
    { path: '/register', component:register,name:'register' },
    { path: '/forgetPas', component:forgetPas,name:'forgetPas' },
    { path: '/logout', component:logout,name:'logout' },
     //
    { path: '/home', component:home,name:'home' },
     //
    { path: '/addEmployee', component:addEmployee,name:'addEmployee' },
    { path: '/vewAllEmployee', component:vewAllEmployee,name:'vewAllEmployee' },
    { path: '/editEmployee/:id', component:editEmployee,name:'editEmployee' },
 
    //
    { path: '/addSupplier', component:addSupplier,name:'addSupplier' },
    { path: '/vewAllSupplier', component:vewAllSupplier,name:'vewAllSupplier' },
    { path: '/editSupplier/:id', component:editSupplier,name:'editSupplier' },




  ]