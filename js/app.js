var app = angular.module('EASEDashboard',
['ui.router','backand','EASEDashboard.services','EASEDashboard.controllers','angular-cache']
);
app.config(function ($stateProvider, $urlRouterProvider) {

        $stateProvider

            .state('loading',{
              url: '/loading',
              templateUrl:'templates/loading-screen.php',
              controller: 'loadingCtrl as loadingCtrl'

            })

            .state('tasks', {
                url: '/tasks/:taskstatus',
                templateUrl: 'templates/task/view-task.php',
                controller: 'TaskCtrl as TaskCtrl'
           })

           .state('task', {
                url: '/task/:taskid',
                templateUrl: 'templates/task/info-task.php',
                controller: 'singleTaskCtrl as TaskCtrl'
           })

            .state('mytasks', {
                url: '/mytasks/:taskstatus',
                templateUrl: 'templates/task/my-task.php',
                controller: 'TaskCtrl as TaskCtrl'
           })

            .state('mytask', {
                url: '/mytask/:taskid',
                templateUrl: 'templates/task/myinfo-task.php',
                controller: 'singleTaskCtrl as TaskCtrl'
           })
           .state('dashboard', {
               url: '/dashboard',
               templateUrl: 'templates/dashboard.php',
               controller: 'dashboardCtrl as dashboardCtrl'
          })

           .state('employee-add', {
                url: '/employee/add',
                templateUrl: 'templates/employee/employee-add.php',
                controller: 'employeeCtrl as employeeCtrl'
           })
            .state('employee-list', {
                url: '/employee/list',
                templateUrl: 'templates/employee/employee-list.php',
                controller: 'employeeCtrl as employeeCtrl'

           })
           .state('invoicelist', {
               url: '/invoicelist/',
               templateUrl: 'templates/transactions/invoice-list.php',
               controller:'invoiceCtrl as invoiceCtrl'
          })

          .state('invoicecreate', {
              url: '/invoicecreate/:index',
              templateUrl: 'templates/transactions/invoice-create.php',
              controller:'invoiceCtrl as invoiceCtrl'

         })
         .state('invoiceedit', {
             url: '/invoiceedit',
             templateUrl: 'templates/transactions/invoice-edit.php',
             controller:'invoiceCtrl as invoiceCtrl'

        })
           .state('chatbox', {
               url: '/chatbox/:conv_id',
               templateUrl: 'templates/chat/try.php',
               controller: 'chatCtrl as chatCtrl'

          });
            /**
            .state('task', {
            url: "/task",
            abstract: true ,
            templateUrl: "templates/task/task.html"
             })
            .state('task.taskopen', {
                url: '/task-open',
                templateUrl: 'templates/task/open-task.html'
            })
            .state('task.taskoverdue', {
                url: '/task-overdue',
                templateUrl: 'templates/task/overdue-task.html'
                }
            )
            .state('task.taskclosed', {
                url: '/task-closed',
                templateUrl: 'templates/task/closed-task.html'
                })
            **/
        $urlRouterProvider.otherwise('/dashboard');


    });

//app.config(function ($locationProvider) {
     //      $locationProvider.html5Mode(true);
    //   })


app.config(function (BackandProvider) {
      BackandProvider.setAppName('easetechnologysolutionsapp');
      BackandProvider.setSignUpToken('bffe4f31-4066-4c49-9008-f967d436e3ce');
      BackandProvider.setAnonymousToken('ec74fd01-4e6c-4444-bec6-9627ea4b17db');
       BackandProvider.runSocket(true);
  });
