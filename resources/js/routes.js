
 let login= require('../components/auth/login.vue').default;
 let register= require('../components/auth/register.vue').default;
 let forgetPas= require('../components/auth/forgetPas.vue').default;
 let logout= require('../components/auth/logout.vue').default;
//
 let home= require('../components/home.vue').default;
 let pos= require('../components/pos/pointofsale.vue').default;


 let stock= require('../components/product/stock.vue').default;
 let editStock= require('../components/product/editStock.vue').default;


//
 let addEmployee= require('../components/employee/addEmployee.vue').default;
 let viewAllEmployee= require('../components/employee/viewAllEmployee.vue').default;               
 let editEmployee= require('../components/employee/editEmployee.vue').default;
//
let addSupplier= require('../components/supplier/addSupplier.vue').default;
let viewAllSupplier= require('../components/supplier/viewAllSupplier.vue').default;               
let editSupplier= require('../components/supplier/editSupplier.vue').default;

//
let addCustomer= require('../components/customer/addCustomer.vue').default;
let viewAllCustomer= require('../components/customer/viewAllCustomer.vue').default;               
let editCustomer= require('../components/customer/editCustomer.vue').default;

//
let addCategory= require('../components/category/addCategory.vue').default;
let viewAllCategory= require('../components/category/viewAllCategory.vue').default;               
let editCategory= require('../components/category/editCategory.vue').default;                      

//
let addProduct= require('../components/product/addProduct.vue').default;
let viewAllProduct= require('../components/product/viewAllProduct.vue').default;               
let editProduct= require('../components/product/editProduct.vue').default; 

//
let addExpense= require('../components/expense/addExpense.vue').default;
let TodayExpense= require('../components/expense/TodayExpense.vue').default;               
let editExpense= require('../components/expense/editExpense.vue').default; 

//
let addSalary= require('../components/salary/addSalary.vue').default;
let createSalary= require('../components/salary/create.vue').default;
let allSalary= require('../components/salary/allSalary.vue').default;               
 let monthSalary = require('../components/salary/monthSalary.vue').default;
 let editSalary= require('../components/salary/editSalary.vue').default; 

 //
 let orders= require('../components/order/order.vue').default;
 let vieworder = require('../components/order/vieworder.vue').default;
let searchorder  = require('../components/order/search.vue').default;



export const routes = [
    { path: '/', component:login,name:'/' },
    { path: '/register', component:register,name:'register' },
    { path: '/forgetPas', component:forgetPas,name:'forgetPas' },  
    { path: '/logout', component:logout,name:'logout' },
     //
    { path: '/home', component:home,name:'home' },  

    // pos
    { path: '/pos', component:pos,name:'pos' },  


    //
    { path: '/stock', component:stock,name:'stock' },
    { path: '/editStock/:id', component:editStock,name:'editStock' },


     //
    { path: '/addEmployee', component:addEmployee,name:'addEmployee' },
    { path: '/viewAllEmployee', component:viewAllEmployee,name:'viewAllEmployee' },
    { path: '/editEmployee/:id', component:editEmployee,name:'editEmployee' },
 
    //
    { path: '/addSupplier', component:addSupplier,name:'addSupplier' },
    { path: '/viewAllSupplier', component:viewAllSupplier,name:'viewAllSupplier' },
    { path: '/editSupplier/:id', component:editSupplier,name:'editSupplier' },

    //
    { path: '/addCustomer', component:addCustomer,name:'addCustomer' },
    { path: '/viewAllCustomer', component:viewAllCustomer,name:'viewAllCustomer' },
    { path: '/editCustomer/:id', component:editCustomer,name:'editCustomer' },

    //
    { path: '/addCategory', component:addCategory,name:'addCategory' },
    { path: '/viewAllCategory', component:viewAllCategory,name:'viewAllCategory' },
    { path: '/editCategory/:id', component:editCategory,name:'editCategory' },

     //
     { path: '/addProduct', component:addProduct,name:'addProduct' },
     { path: '/viewAllProduct', component:viewAllProduct,name:'viewAllProduct' },
     { path: '/editProduct/:id', component:editProduct,name:'editProduct' },
     
      //
      { path: '/addExpense', component:addExpense,name:'addExpense' },
      { path: '/TodayExpense', component:TodayExpense,name:'TodayExpense' },
      { path: '/editExpense/:id', component:editExpense,name:'editExpense' },

      //salary  ,props:true --
      { path: '/addSalary', component:addSalary,name:'addSalary' },
      { path: '/createSalary/:id', component: createSalary, name:'createSalary'},
      { path: '/allSalary', component:allSalary,name:'allSalary' },
      { path: '/view-monthSalary/:id', component: monthSalary, name:'monthSalary' },
      { path: '/editSalary/:id', component:editSalary,name:'editSalary' }, 
  
     // Orders 
     { path: '/orders', component:orders,name:'orders' },
     { path: '/viewOrder/:id', component: vieworder, name:'viewOrder' },
     { path: '/searchOrder', component: searchorder, name:'searchOrder' },



  ]