
 let login= require('../components/auth/login.vue').default;
 let register= require('../components/auth/register.vue').default;
 let forgetPas= require('../components/auth/forgetPas.vue').default;
 let logout= require('../components/auth/logout.vue').default;
//
 let home= require('../components/home.vue').default;
//
 let addEmployee= require('../components/employee/addEmployee.vue').default;
 let viewAllEmployee= require('../components/employee/viewAllEmployee.vue').default;               
 let editEmployee= require('../components/employee/editEmployee.vue').default;
//
let addSupplier= require('../components/supplier/addSupplier.vue').default;
let viewAllSupplier= require('../components/supplier/viewAllSupplier.vue').default;               
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
    { path: '/viewAllEmployee', component:viewAllEmployee,name:'viewAllEmployee' },
    { path: '/editEmployee/:id', component:editEmployee,name:'editEmployee' },
 
    //
    { path: '/addSupplier', component:addSupplier,name:'addSupplier' },
    { path: '/viewAllSupplier', component:viewAllSupplier,name:'viewAllSupplier' },
    { path: '/editSupplier/:id', component:editSupplier,name:'editSupplier' },




  ]