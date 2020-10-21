// Routes auth
let Login = require('./components/auth/login.vue').default;
let Register = require('./components/auth/register.vue').default;
let Forget = require('./components/auth/forget.vue').default;
let Logout = require('./components/auth/logout.vue').default;


let Home = require('./components/home.vue').default;

//Employee Routes
let ShowEmployees = require('./components/employees/index.vue').default;
let StoreEmployees = require('./components/employees/create.vue').default;
let EditEmployees = require('./components/employees/edit.vue').default;

//Suppliers Routes
let ShowSuppliers = require('./components/suppliers/index.vue').default;
let StoreSuppliers = require('./components/suppliers/create.vue').default;
let EditSuppliers = require('./components/suppliers/edit.vue').default;

//Categories Routes
let ShowCategories = require('./components/categories/index.vue').default;
let StoreCategories = require('./components/categories/create.vue').default;
let EditCategories = require('./components/categories/edit.vue').default;

//Items Routes
let ShowItems = require('./components/items/index.vue').default;
let StoreItems = require('./components/items/create.vue').default;
let EditItems = require('./components/items/edit.vue').default;

//Expenses Routes
let ShowExpenses = require('./components/expenses/index.vue').default;
let StoreExpenses = require('./components/expenses/create.vue').default;
let EditExpenses = require('./components/expenses/edit.vue').default;

//Sallaries Routes
let GivenSallaries = require('./components/sallaries/allEmployees.vue').default;
let PaySallaries = require('./components/sallaries/create.vue').default;
let AllSallaries = require('./components/sallaries/index.vue').default;
let ShowSallaries = require('./components/sallaries/view.vue').default;
let EditSallaries = require('./components/sallaries/edit.vue').default;

//Stocks Routes
let ShowStocks = require('./components/items/stock.vue').default;
let AddStocks = require('./components/items/addstock.vue').default;

//Customers Routes
let ShowCustomers = require('./components/customers/index.vue').default;
let StoreCustomers = require('./components/customers/create.vue').default;
let EditCustomers = require('./components/customers/edit.vue').default;

//Pos Routes
let Pos = require('./components/pos/pos.vue').default;

//sales Routes
let TodaySales = require('./components/sales/index.vue').default;
let ViewSales = require('./components/sales/view.vue').default;
let SearchSales = require('./components/sales/search.vue').default;

export const routes = [
  { path: '/', component: Login, name: 'login' },
  { path: '/register', component: Register, name: 'register' },
  { path: '/forget', component: Forget, name: 'forget' },
  { path: '/logout', component: Logout, name: 'logout' },
  
  { path: '/home', component: Home, name: 'home' },

  { path: '/employees', component: ShowEmployees, name: 'show-employees' },
  { path: '/employees/create', component: StoreEmployees, name: 'store-employees' },
  { path: '/employees/:id', component: EditEmployees, name: 'edit-employees' },

  { path: '/suppliers', component: ShowSuppliers, name: 'show-suppliers' },
  { path: '/suppliers/create', component: StoreSuppliers, name: 'store-suppliers' },
  { path: '/suppliers/:id', component: EditSuppliers, name: 'edit-suppliers' },

  { path: '/categories', component: ShowCategories, name: 'show-categories' },
  { path: '/categories/create', component: StoreCategories, name: 'store-categories' },
  { path: '/categories/:id', component: EditCategories, name: 'edit-categories' },

  { path: '/items', component: ShowItems, name: 'show-items' },
  { path: '/items/create', component: StoreItems, name: 'store-items' },
  { path: '/items/:id', component: EditItems, name: 'edit-items' },

  { path: '/expenses', component: ShowExpenses, name: 'show-expenses' },
  { path: '/expenses/create', component: StoreExpenses, name: 'store-expenses' },
  { path: '/expenses/:id', component: EditExpenses, name: 'edit-expenses' },

  { path: '/sallaries/given', component: GivenSallaries, name: 'given-sallaries'},
  { path: '/sallaries/pay/:id', component: PaySallaries, name: 'pay-sallaries' },
  { path: '/sallaries', component: AllSallaries, name: 'all-sallaries' },
  { path: '/sallaries/:id', component: ShowSallaries, name: 'view-sallaries' },
  { path: '/sallaries/edit/:id', component: EditSallaries, name: 'edit-sallaries' },

  { path: '/stocks', component: ShowStocks, name: 'show-stocks' },
  { path: '/stocks/:id', component: AddStocks, name: 'add-stocks' },

  { path: '/customer', component: ShowCustomers, name: 'show-customers' },
  { path: '/customer/create', component: StoreCustomers, name: 'store-customers'},
  { path: '/customer/:id', component: EditCustomers, name: 'edit-customers'},

  { path: '/pos', component: Pos, name: 'pos' },

  { path: '/sales', component: TodaySales, name: 'today-sales' },
  { path: '/sales/:id', component: ViewSales, name: 'view-sales' },
  { path: '/sale/cari', component: SearchSales, name: 'search-sales' },





]