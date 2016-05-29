angular.module('EASEDashboard.services', ['angular-cache'])
    .service('chatService', function($http, Backand) {
      var chatService = this;
      chatService.getConversation = function(){
            return $http ({
        method: 'GET',
        url: Backand.getApiUrl() + '/1/objects/wp_conv',
        params: {
          pageSize: 500,
          pageNumber: 1,
          filter: null,
          sort: ''
        }
      });
      };
      chatService.getConversationMessages = function(id){
        return $http ({
        method: 'GET',
        url: Backand.getApiUrl() + '/1/objects/wp_conv_reply',
        params: {
          pageSize: 500,
          pageNumber: 1,
          filter: [
            {
              fieldName: 'conv_id',
              operator: 'equals',
              value: id
            }
          ],
          sort: ''
        }
        });
      };
      chatService.getUserInfoForChat = function(){
          return $http ({
            method: 'GET',
            url: Backand.getApiUrl() + '/1/query/data/getUserNamesForChat',
            params: {
              parameters: {}
            }
          });
      };

      chatService.updateClient = function(){
        return $http ({
  method: 'GET',
  url: Backand.getApiUrl() + '/1/objects/action/backandUsers/1',
  params: {
    name: 'updateChatInfo',
    parameters: {
      example: ''
    }
  }
});
      };
      chatService.addReply = function(conv_id,reply){
        var d = new Date();
        d = d.toLocaleTimeString().replace(/:\d+ /, ' ');
              return $http ({
        method: 'POST',
        url: Backand.getApiUrl() + '/1/objects/wp_conv_reply?returnObject=true',
        data: {
          reply: reply,
          userid: '1',
          ip: '192.168.254.254',
          time: d,
          conv_id: conv_id
        }
      });
      };

    })
  .service('dashboardService' , function($http){
    var dashboardService = this;
    dashboardService.getDashboardData = function(){

      return $http({
        method: 'POST',
        url: 'class/dashboard-data.php',
        data: {},
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    });
  };
  })
  .service('InvoiceService', function($http,Backand){
    var InvoiceService = this;
    InvoiceService.addNewInvoice = function(date,due,userdata,invoiceitem,paymentmethodlist,user_id){
      console.log(userdata);
      console.log(invoiceitem);
      console.log(paymentmethodlist);
      return $http ({
      method: 'POST',
      url: Backand.getApiUrl() + '/1/objects/wp_easeinvoice?returnObject=true',
      data: {
        date: date,
        due: due,
        user_id: user_id,
        userdata: angular.toJson(userdata),
        invoiceitem: angular.toJson(invoiceitem),
        paymentmethodlist: angular.toJson(paymentmethodlist)
      }
    });
  };
  InvoiceService.deleteInvoice = function (id){
    return $http ({
  method: 'DELETE',
  url: Backand.getApiUrl() + '/1/objects/wp_easeinvoice/' + id
  });
  };
  InvoiceService.updateInvoice = function(user_id,invoice_id,date,due,userdata,invoiceitem,paymentmethodlist,status){
    console.log(userdata);
    console.log(invoiceitem);
    console.log(paymentmethodlist);
    return $http ({
  method: 'PUT',
  url: Backand.getApiUrl() + '/1/objects/wp_easeinvoice/'+ invoice_id +'?returnObject=true',
  data: {
    date: date,
    due: due,
    user_id: user_id,
    userdata: angular.toJson(userdata),
    invoiceitem: angular.toJson(invoiceitem),
    paymentmethodlist: angular.toJson(paymentmethodlist),
    status: status
  }
});
};
    InvoiceService.previewInvoice = function(date,due,userdata,invoiceitem,paymentmethodlist){

      return $http({
        method: 'POST',
        url: 'templates/transactions/invoice-preview.php',
        data: {date:date,
              due:due,
              userdata:userdata,
              invoiceitem:invoiceitem,
              paymentmethodlist:paymentmethodlist},
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    });
  };
    InvoiceService.getAppUsersTasks = function(id){
        return $http ({
          method: 'GET',
          url: Backand.getApiUrl() + '/1/objects/wp_easetasks',
          params: {
            pageSize: 2000,
            pageNumber: 1,
            filter: [
              {
                fieldName: 'task_ownerid',
                operator: 'equals',
                value: id
              }
            ],
            sort: ''
          }
        });
    };
    InvoiceService.getInvoicelist = function(){
      return $http ({
        method: 'GET',
        url: Backand.getApiUrl() + '/1/objects/wp_easeinvoice',
        params: {
          pageSize: 2000,
          pageNumber: 1,
          filter: [],
          sort: ''
        }
      });
    };

    InvoiceService.getAppUsers = function(){
      return $http ({
      method: 'GET',
      url: Backand.getApiUrl() + '/1/objects/wp_easeappuser',
      params: {
        pageSize: 2000,
        pageNumber: 1,
        filter: null,
        sort: ''
      }
    });
  };
  })
   .service('TaskService', function ($http, Backand) {
        var TaskService = this;

        TaskService.getAllTask = function (taskcategory) {


        if(taskcategory==='All'){
                    return $http ({
        			  method: 'GET',
        			  url: Backand.getApiUrl() + '/1/query/data/getTaskAdmin',
        			  params: {
        			    parameters: {}
        			  }
        		});}
        else {
        	return $http ({
		  method: 'GET',
		  url: Backand.getApiUrl() + '/1/query/data/getTaskWithFilter',
		  params: {
		    parameters: {
		      status: taskcategory
		    }
		  }
		});
        }

    };

      TaskService.getMyTask = function (ease_assignee , task_status){
        console.log('task_status : ' + task_status);
        if(task_status === 'All'){
         return $http ({
            method: 'GET',
            url: Backand.getApiUrl() + '/1/query/data/getMyTaskWithFilter',
            params: {
              parameters: {
                task_assignee: ease_assignee
              }
            }
          });
        }else {
         return $http ({
            method: 'GET',
            url: Backand.getApiUrl() + '/1/query/data/getMyTask',
            params: {
              parameters: {
                task_status: task_status,
                task_assignee: ease_assignee
              }
            }
          });
        }

      };
  })

    .service('singleTaskService', function ($http, Backand) {
        var singleTaskService = this;

        singleTaskService.getTaskinfo = function (id) {


        return $http ({
  method: 'GET',
  url: Backand.getApiUrl() + '/1/query/data/getTaskInfo',
  params: {
    parameters: {
      id: id
    }
  }
});

    };

    singleTaskService.updateTaskInfo = function (task_id , task_name , task_description , task_start , task_due , task_tags , task_assignee , task_priority ,task_status){

        return $http ({
      method: 'PUT',
      url: Backand.getApiUrl() + '/1/objects/wp_easetasks/'+task_id+'?returnObject=true',
      data: {
        task_name: task_name,
        task_description: task_description,
        task_start: task_start,
        task_due: task_due,
        task_tags: task_tags,
        task_assignee: task_assignee,
        task_priority: task_priority,
        task_status: task_status,
      }
    });
    };
    })

    .service('cacheService', function (CacheFactory) {
      var cacheService = this;

       cacheService.getCachedInfo = function (userinfo){

          return userinfo;
          };


    })
    .service('updateUserStatus',function($http){
      var updateUserStatus = this;
      updateUserStatus.getUserStatus = function(){
        return $http.get('https://dgabriel.azurewebsites.net/app/userstatus.php');
      };

    })
    .service('employeeService', function ($http, Backand) {
      var employeeService = this ;

        employeeService.add = function (nickname,firstname,middlename, lastname,address,email,mobile,username,password){

                  return $http ({
          method: 'GET',
          url: Backand.getApiUrl() + '/1/query/data/addEmployee',
          params: {
            parameters: {
              nickname: nickname,
              firstname: firstname,
              middlename: middlename,
              lastname: lastname,
              address: address,
              email: email,
              mobile: mobile,
              username: username,
              password: password
            }
          }
        });
        };

        employeeService.getAll = function (){

          return $http ({
  method: 'GET',
  url: Backand.getApiUrl() + '/1/objects/wp_easewebuser',
  params: {
    pageSize: 20,
    pageNumber: 1,
    filter: [
      {
        fieldName: 'ease_role',
        operator: 'greaterThan',
        value: '0'
      }
    ],
    sort: ''
  }
});
        };


    });
