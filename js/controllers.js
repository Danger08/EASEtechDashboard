var app = angular.module('EASEDashboard.controllers', ['angular-cache', 'ngAnimate', 'ui.bootstrap']);
app.controller('TaskCtrl', function (Backand, $state, $scope, $rootScope, TaskService, $stateParams, cacheService) {


  var TaskCtrl, SearchTask;
  TaskCtrl= $scope;
  TaskCtrl.selectedPriority = undefined;
  $rootScope.singletaskinfo= undefined;
  TaskCtrl.loading=undefined;



  function getAllTask()
  {
   TaskCtrl.taskstatus = $stateParams.taskstatus;

  //console.log($state.params.taskstatus);
   if($state.current.name === 'mytasks'){
        if(TaskCtrl.myinfo !== undefined){
            TaskService.getMyTask(TaskCtrl.myinfo.ease_id , $state.params.taskstatus)
             .then(function(response)
             {
              TaskCtrl.taskdata = response.data;

              TaskCtrl.loading='Daniel Gerald Gabriel';
            } ,function()
            {


            });

        }else {
            TaskService.getMyTask(TaskCtrl.userinfo.user_id)
         .then(function(response)
         {
          TaskCtrl.taskdata = response.data;
          TaskCtrl.loading='Daniel Gerald Gabriel';
        } ,function()
        {


        });
        }


   }
    else{
      TaskService.getAllTask(TaskCtrl.taskstatus)
         .then(function(response)
         {
          TaskCtrl.taskdata = response.data;
          TaskCtrl.loading='Daniel Gerald Gabriel';
        } ,function()
        {


        });
    }


 }
 if($state.current.name !== 'mytasks'){
   getAllTask();
 }

 //
 // if(!angular.isDefined($rootScope.startGetAllTask)){
 //   $rootScope.startGetAllTask = $interval (function(){
 //    getAllTask();
 //    console.log('getalltask');
 //  },5000);
 // }


 function cutString(length , string){
  return string.substring(0, length) + '...';
}

function parseStatus(status){
  if(status ==='onHold'){
    return 'On Hold';
  }else if (status === 'inProgress') {
    return 'In Progress';
  }
  else{
    return status;
  }

}
Backand.on('task_update', function (data) {
  //Get the 'items' object that have changed
  getAllTask();

});
function getInfo(userinfo){

  console.log('getInfo : ' + userinfo);
  TaskCtrl.myinfo = cacheService.getCachedInfo(userinfo);
  getAllTask();
}
TaskCtrl.getInfo = getInfo;
TaskCtrl.parseStatus = parseStatus;
TaskCtrl.getAllTask = getAllTask;
TaskCtrl.cutString = cutString;
})

.controller('chatCtrl', function(Backand,$state,$scope,$rootScope,chatService,$stateParams,$location,$anchorScroll,$timeout,$interval,updateUserStatus){
  $scope.sending = true;
  $scope.notificationSound = new Audio('audio/CoolNotification.mp3');
  $scope.notificationMessage = [{},'',false];
  //------notification Message functions------

  $interval(function () {
    console.log('getting user status info');
getUserStatus();
  }, 10000);
getUserStatus();
  function getUserStatus(){
    updateUserStatus.getUserStatus()
    .then(function(data){
      console.log(angular.fromJson(angular.toJson(data.data)));
      $rootScope.userstatus = angular.fromJson(angular.toJson(data.data));

    },function(){
      console.log('failed');
    });
  }


  requestPermissions();
  function requestPermissions() {
  notify.requestPermission(function() {
  $scope.$apply($scope.permissionLevel = permissionLevels[notify.permissionLevel()]);
  });
  }

  //------notification Message end -----
  $scope.key = function($event,conv_id,message){

    $scope.event = $event;
     if($scope.event.keyCode === 13 && !$scope.event.shiftKey){
       console.log('enter key detected');
       $location.hash('bottom' + conv_id);
       $anchorScroll();
       //$scope.sendReply(conv_id,message);
       $timeout(function() {
         angular.element('#SubmitChat' + conv_id).triggerHandler('click');
      }, 100);

     }
     if ($scope.event.shiftKey && $scope.event.keyCode === 13) {
       console.log('shift enter key detected');
     }
  };
  var chatCtrl = $scope;
  $scope.chatboxes = [];
  $scope.chatboxesspace = [235,495,760,1055];
  getConversation();
  function getConversation(){
    chatService.getConversation()
    .then(function(response){
      $scope.conversations = response.data.data;
      console.log(response.data.data);
      //console.log($scope.conversations);
    },function(){

    });
    chatService.getUserInfoForChat()
    .then(function(response){
    $scope.userInfoForChat = response.data;
    console.log($scope.userInfoForChat);
    });
  }
  $scope.getUserName = getUserName;
  $scope.userNames=[];
  function getUserName(id,conv_id){
    for (var i = 0; i < $scope.userInfoForChat.length; i++) {
      $scope.userNames[conv_id] = $scope.userInfoForChat[i].firstname + ' ' + $scope.userInfoForChat[i].lastname;
      if($scope.userInfoForChat[i].ease_userid===id){
        return $scope.userInfoForChat[i].firstname + ' ' + $scope.userInfoForChat[i].lastname;
      }
    }
  }
  $scope.getProfilePicture = function(id){
    for(i=0;i<$scope.userInfoForChat.length;i++){
    if($scope.userInfoForChat[i].ease_userid == id){
      return $scope.userInfoForChat[i].avatar;
    }
    }
  };
  $scope.addChatBox = addChatBox;
  function addChatBox(chatboxinfo){
    if($scope.chatboxes.indexOf(chatboxinfo)===-1){
      console.log('not found. adding');
      $scope.chatboxes.push(chatboxinfo);
    }else {
      console.log('found . prevent dupes');
    }
  }
  $scope.loadChatMessages = loadChatMessages;
  $scope.chatMessages=[];
  $scope.sendingreply = [];
  function loadChatMessages (conv_id , item){
    console.log(angular.toJson(item));
  chatService.getConversationMessages(conv_id)
  .then(function(response){
    $scope.sendingreply[conv_id] = undefined;
    $scope.chatMessages[conv_id] = response.data.data;
    if($scope.notificationMessage[2]===true){
      notify.createNotification('New Message from : '  + $scope.notificationMessage[1], $scope.notificationMessage[0]);
      $scope.notificationSound.play();
      $scope.notificationMessage[2] = false;
    }
    $timeout(function () {
      $location.hash('bottom' + conv_id);
      $anchorScroll();
    }, 500);


  },function(error){
    console.log(error);
  });

  }
  $scope.removeChatBox = removeChatBox;
  function removeChatBox(id){
    for (var i = 0; i < $scope.chatboxes.length; i++) {
      if($scope.chatboxes[i].conv_id===id){
        $scope.chatMessages[id] = undefined;
        console.log($scope.chatboxes[i].conv_id);
        $scope.chatboxes.splice(i,1);
      }
  }}

  $scope.sendReply = sendReply;
  function sendReply(id,reply){

      $scope.sendingreply[id]= reply;
      $timeout(function () {
        $location.hash('bottom' + id);
        $anchorScroll();
      }, 500);
    console.log('sendReply clicked : id = '+ id +'reply :'  +  reply);
    console.log($state.params.conv_id);
    chatService.addReply(id,reply)
    .then(function(){


      console.log('Successfull');
      $timeout(function () {
        $location.hash('bottom' + id);
        $anchorScroll();
      }, 1000);
    },function(){

    });

  }

  Backand.on('conversation_updated', function (data) {

    console.log('conversation_updated');
    getConversation();
  });
  Backand.on('chat_updated', function (data) {
  console.log(data[4].Value);
    loadChatMessages(data[4].Value);
      requestPermissions();
      function requestPermissions() {
          notify.requestPermission(function() {
              $scope.$apply($scope.permissionLevel = permissionLevels[notify.permissionLevel()]);
          });
      }
      notify.config({pageVisibility: false, autoClose: 15000});

      $scope.notificationMessage[0] = {body: data[0].Value , icon: "img/icon.ico"};
      $scope.notificationMessage[1]  = $scope.userNames[data[4].Value];

      if(data[1].Value != 1){
        $scope.notificationMessage[2] = true;
      }


  });
  Backand.on('chat_deleted', function (data) {
                    //Get the 'items' object that have changed
                    loadChatMessages(parseInt(data[5].Value));
                  });
})

.controller('singleTaskCtrl',
function (Backand, $state, $scope ,$rootScope, singleTaskService,
          employeeService ,$stateParams,CacheFactory,cacheService,$timeout) {
 var TaskCtrl = $scope;

 $rootScope.taskdataloading = undefined;
 var singleTaskCache;

  // Check to make sure the cache doesn't already exist

  function setTaskPriority(taskPriority){

    switch(taskPriority)
    {

      case 'Low':
      TaskCtrl.taskPriority = TaskCtrl.prioritySelectValue[0];
      break;
      case 'Medium':
      TaskCtrl.taskPriority = TaskCtrl.prioritySelectValue[1];
      break;
      case 'High':
      TaskCtrl.taskPriority = TaskCtrl.prioritySelectValue[2];
      break;

    }
  }
  function setTaskStatus(taskStatus){

    switch(taskStatus)
    {

      case 'Created':
      TaskCtrl.taskStatus = TaskCtrl.statusSelectValue[0];
      break;
      case 'inProgress':
      TaskCtrl.taskStatus = TaskCtrl.statusSelectValue[1];
      break;
      case 'Completed':
      TaskCtrl.taskStatus = TaskCtrl.statusSelectValue[2];
      break;
      case 'onHold':
      TaskCtrl.taskStatus = TaskCtrl.statusSelectValue[3];
      break;
      case 'Cancelled':
      TaskCtrl.taskStatus = TaskCtrl.statusSelectValue[4];
      break;
    }
  }

  function setTaskTags(taskTags){


    switch(taskTags){
      case 'Web Design and Development':
      TaskCtrl.taskTags  = TaskCtrl.tagsSelectValue[0];
      break;
      case 'Graphic Design':
      TaskCtrl.taskTags  = TaskCtrl.tagsSelectValue[1];
      break;
      case 'Content Writing':
      TaskCtrl.taskTags  = TaskCtrl.tagsSelectValue[2];
      break;
      case 'SEO':
      TaskCtrl.taskTags  = TaskCtrl.tagsSelectValue[3];
      break;
      case 'Back Office Support':
      TaskCtrl.taskTags  = TaskCtrl.tagsSelectValue[4];
      break;
      case 'Help Desk Services':
      TaskCtrl.taskTags  = TaskCtrl.tagsSelectValue[5];
      break;

    }
  }
  function getSingleTaskinfo () {


   singleTaskService.getTaskinfo($state.params.taskid)
   .then(function(response)
   {
    $rootScope.taskdataloading = 'Daniel Gerald Gabriel';
    $rootScope.singletaskinfo = response.data[0];
    //console.log($rootScope.singletaskinfo);

    setTaskPriority($rootScope.singletaskinfo.task_priority);
    setTaskStatus($rootScope.singletaskinfo.task_status);
    setTaskTags($rootScope.singletaskinfo.task_tags);
    TaskCtrl.taskName  =  $rootScope.singletaskinfo.task_name;
    TaskCtrl.taskDescription = $rootScope.singletaskinfo.task_description;
    TaskCtrl.taskStart  = new Date($rootScope.singletaskinfo.task_start);
    TaskCtrl.taskDue = new Date($rootScope.singletaskinfo.task_due);
  employeeService.getAll()
  .then(function(response){
    var empData= response.data;
    TaskCtrl.empData = empData.data;
    for (var i = 0; i < TaskCtrl.empData.length; i++) {
     if(parseInt(TaskCtrl.empData[i].ease_id) === parseInt($rootScope.singletaskinfo.task_assignee)){
      console.log('match');
      TaskCtrl.taskAssignee = TaskCtrl.empData[i];
      TaskCtrl.taskAssigneeName = TaskCtrl.empData[i].ease_name;
     }
    }
  }, function(error){

  });


  } ,function()
  {


  });



}

function getInfo(userinfo){

  console.log('getInfo : ' + userinfo);
  TaskCtrl.myinfo = cacheService.getCachedInfo(userinfo);
}
TaskCtrl.getInfo = getInfo;

getSingleTaskinfo();

function parseStatus(status){
  if(status ==='onHold'){
    return 'On Hold';
  }else if (status === 'inProgress') {
    return 'In Progress';
  }
  else{
    return status;
  }

}

function parseDate(string)
{

var d = new Date(string);
d.setDate( d.getDate() + 1);


  if(string!==undefined)
  {
    var parsedString = d.toISOString().split('T');

    return parsedString[0];
  }

}

function parseAssignee(Assignee)
{
  if(Assignee === null){
    return 'None';
  }else {
    return TaskCtrl.taskAssigneeName;
  }

}

function updateTaskInfo (){
  $rootScope.taskdataloading=undefined;

  singleTaskService.updateTaskInfo($state.params.taskid , TaskCtrl.taskName , TaskCtrl.taskDescription , TaskCtrl.taskStart ,  TaskCtrl.taskDue , TaskCtrl.taskTags.name , TaskCtrl.taskAssignee.ease_id ,  TaskCtrl.taskPriority.name ,TaskCtrl.taskStatus.value)
   .then(function(){
    setTimeout(function(){$rootScope.taskdataloading = 'Daniel Gerald Gabriel';},3000);
    console.log('success');
    getSingleTaskinfo();
  },function(error){
    console.log(error);
  });
}
 TaskCtrl.open1 = function() {
    $scope.popup1.opened = true;
    console.log(angular.toJson($scope.popup1));
  };
   TaskCtrl.open2 = function() {
    $scope.popup2.opened = true;
  };
TaskCtrl.popup1 = {
    opened: false
  };
TaskCtrl.popup2 = {
    opened: false
  };
TaskCtrl.prioritySelectValue = [{name:'Low'},{name:'Medium'},{name:'High'}];

TaskCtrl.statusSelectValue = [{value:'Created',name:'Created'},{value:'inProgress',name:'In Progress'},
                              {value:'Completed',name:'Completed'},{value:'onHold',name:'On Hold'},
                              {value:'Cancelled',name:'Cancelled'}];

TaskCtrl.tagsSelectValue = [{name:'Web Design and Development'},{name:'Graphic Design'},
                            {name:'Content Writing'},{name:'SEO'},{name:'Back Office Support'},
                            {name:'Help Desk Services'}];
TaskCtrl.updateTaskInfo = updateTaskInfo;
TaskCtrl.parseAssignee = parseAssignee;
TaskCtrl.parseDate = parseDate;
TaskCtrl.parseStatus = parseStatus;
})

.controller('employeeCtrl', function (Backand, $state, $scope ,$rootScope,
                                      employeeService ,$stateParams ,$uibModal,$timeout) {
  console.log($state);
  var employeeCtrl = $scope;
  console.log('empController loaded');
  employeeCtrl.loading = undefined;

  function addEmployee(){
    employeeCtrl.loading = 'Daniel';
    employeeService.add(employeeCtrl.emp.nickname,employeeCtrl.emp.firstname,employeeCtrl.emp.middlename,
                        employeeCtrl.emp.lastname,employeeCtrl.emp.address,employeeCtrl.emp.email,
                        employeeCtrl.emp.mobile,employeeCtrl.emp.username,employeeCtrl.emp.password
      ).then(function(){

        console.log('Registration Success');
        $timeout(function(){
          employeeCtrl.loading = undefined;
        },3000);
        $scope.message = 'Registration Successfull';

        modalOpen('sm','modal-success');
      },
      function(error){
        $scope.message = 'Registration Failed : Check network then try again';
        $timeout(function(){
          employeeCtrl.loading = undefined;
        },3000);
        modalOpen('sm','modal-danger');
      });
      console.log('addemployee');
      console.log(employeeCtrl.emp.firstname);

    }
    if($state.current.name  === 'employee-list'){
      listAllEmployee();
      console.log('ListAll function');
    }

    function listAllEmployee (){
      employeeService.getAll()
      .then(function(response){
        console.log('success');
        employeeCtrl.allEmployees = response.data;
        console.log(employeeCtrl.allEmployees);
        employeeCtrl.loading ='Daniel Gerald Gabriel';
      },function(error){
        console.log(error);
      });
    }

    $scope.message = '<strong>Test</strong>';

    function modalOpen(size,mclass) {

      var modalInstance = $uibModal.open({
        animation: true,
        windowClass: mclass,
        templateUrl: 'myModalContent.html',
        controller: 'ModalInstanceCtrl',
        size: size,
        resolve: {
          items: function () {
            return $scope.message;
          }
        }
      });
    }
    employeeCtrl.listAllEmployee = listAllEmployee;
    employeeCtrl.addEmployee = addEmployee;
    employeeCtrl.modalOpen = modalOpen;

  })

.controller('loadingCtrl', function ($scope, $rootScope,$state,CacheFactory,cacheService) {
  var loadingCtrl = $scope;

  function getInfo(userinfo){

  var userinfos = cacheService.getCachedInfo(userinfo);
  console.log(userinfos.ease_id);
      switch (parseInt(userinfos.ease_role)) {
      case 0:
        $state.go('tasks',{taskstatus : 'All'});
        break;
      case 1:
         $state.go('tasks',{taskstatus : 'All'});
        break;
      case 2:
         $state.go('tasks',{taskstatus : 'All'});
        break;
      case 3:
        $state.go('mytasks',{taskstatus : 'All'});
        break;

    }
   }


  loadingCtrl.getInfo = getInfo;
})
.controller('dashboardCtrl' , function($scope,$rootScope,$state,dashboardService){
  $scope.loading = true;
    dashboardService.getDashboardData()
    .then(function(response){
      console.log(angular.fromJson(response.data.numberofitems));
      $scope.loading =false;
      $scope.appuser = response.data.numberofitems.appuser;
      $scope.employees = response.data.numberofitems.employee;
      $scope.invoice= response.data.numberofitems.invoice;
      $scope.tasks = response.data.numberofitems.task;
    },function(){

    });
})
.controller('invoiceCtrl',function($scope,$rootScope,$state,InvoiceService,Backand){
var invoiceCtrl = $scope;
Backand.on('invoice_update', function (data) {
  //Get the 'items' object that have changed
  console.log('Invoice Update detected');
getInvoicelist();
});
$scope.invoiceitem = [];
$scope.paymentmethodlist =[];
$scope.getAppUsersTasks = getAppUsersTasks;
$scope.addtoinvoiceitem = addtoinvoiceitem;
$scope.removeInvoiceitem = removeInvoiceitem;
$scope.addtoinvoiceitemmanual = addtoinvoiceitemmanual;
$scope.addpaymentMethod = addpaymentMethod;
$scope.removePaymentMethod = removePaymentMethod;
$scope.previewInvoice = previewInvoice;
$scope.addNewInvoice = addNewInvoice;
$scope.getInvoicelist = getInvoicelist;
$scope.fixInvoiceNumber = fixInvoiceNumber;
$scope.getInvoiceUserName = getInvoiceUserName;
$scope.previewInvoiceFromList = previewInvoiceFromList;
$scope.editInvoice = editInvoice;
$scope.loadEditData = loadEditData;
$scope.updateInvoice = updateInvoice;
$scope.setInvoiceIDforDelete = setInvoiceIDforDelete;
$scope.deleteInvoice = deleteInvoice;
$scope.setCategoryFilter = setCategoryFilter;

function updateInvoice(id,a,b,c,d,e,f,g){
  $scope.updatinginvoice = 1;
  console.log(id);
  InvoiceService.updateInvoice(id,a,b,c,d,e,f,g)
  .then(function(){
    $scope.updatinginvoice = undefined;
    console.log('Update Completed');
  },function(){
    console.log('Update Failed');
  });
}
$scope.statusOptions = [{value:0 , name : 'Open'},{value:1 , name : 'Closed'},{value:2 , name : 'Pending'},{value:3 , name : 'Paid'}];
function setCategoryFilter (category){
  switch (parseInt(category)) {
    case 0:
      $scope.categoryfilter = {'status':  0};
    break;
    case 1:
      $scope.categoryfilter = {'status':  1};
    break;
    case 2:
      $scope.categoryfilter = {'status':  2};
    break;
    case 3:
      $scope.categoryfilter = {'status':  3};
    break;
    case undefined:
      $scope.categoryfilter = {};
    break;

  }

}

function setInvoiceIDforDelete(id){
  $scope.invoiceIDforDelete = id;
  console.log($scope.invoiceIDforDelete);
}
function deleteInvoice(id){
  InvoiceService.deleteInvoice(id)
  .then(function(){
    console.log('Deleted');
  },function(){
    console.log('Delete Failed');
  });
}
function getInvoicelist (){
  InvoiceService.getInvoicelist()
  .then(function(response){
    console.log(response.data.data);
    $scope.invoicelist = response.data.data;
  },function(error){
    console.log(error.data);
  });
}
function getInvoiceUserName(data){
var a = angular.fromJson(data);
  return a.firstname + " " + a.lastname;
}
function editInvoice(invoicedata){
  console.log('invoicedata');
  $rootScope.invoicetobeEdited = angular.fromJson(invoicedata);
  $rootScope.invoicetobeEdited.date = new Date($rootScope.invoicetobeEdited.date);
  $rootScope.invoicetobeEdited.due = new Date($rootScope.invoicetobeEdited.due);
  $rootScope.invoicetobeEdited.invoice_item = angular.fromJson($rootScope.invoicetobeEdited.invoice_item);
  $rootScope.invoicetobeEdited.payment_methodlist = angular.fromJson($rootScope.invoicetobeEdited.payment_methodlist);
  $rootScope.invoicetobeEdited.userdata = angular.fromJson($rootScope.invoicetobeEdited.userdata);
  console.log($rootScope.invoicetobeEdited);
  $state.go('invoiceedit');
}
function loadEditData(){
  console.log('loading data...');
  $scope.invoice={};
  $scope.invoice.date = $rootScope.invoicetobeEdited.date;
  $scope.invoice.due = $rootScope.invoicetobeEdited.due;
  $scope.invoice.selecteduserdata  = $rootScope.invoicetobeEdited.userdata;
  $scope.invoiceitem = $rootScope.invoicetobeEdited.invoice_item;
  $scope.paymentmethodlist = $rootScope.invoicetobeEdited.payment_methodlist;
  $scope.invoice.invoicestatus = setSelectedinvoiceStatus($rootScope.invoicetobeEdited.status);
}

function setSelectedinvoiceStatus (a){
  var b;
  switch (a) {
    case 0:
    b = {"value":0,"name":"Open"};
    break;
    case 1:
    b = {"value":1,"name":"Closed"};
    break;
    case 2:
    b = {"value":2,"name":"Pending"};
    break;
    case 3:
    b = {"value":3,"name":"Paid"};
    break;

  }
  return  b;
}
function addNewInvoice (a,b,c,d,e){
  $scope.creatinginvoice = 1;
  console.log('addNewInvoice');
  var f = $scope.invoice.selecteduserdata.ease_userid;
  InvoiceService.addNewInvoice(a,b,c,d,e,f)
  .then(function(response){
    $scope.creatinginvoice = undefined;
    console.log('success');
    console.log(response.data);
    var g = response.data.invoice_id;
    $scope.currentinvoicenumber = fixInvoiceNumber(g);
    $state.go('invoicelist');
  },function(){
    console.log('failed');
  });
}
function fixInvoiceNumber(a){
var b ="";
if(a!== undefined){
  switch (a.toString().length) {
    case 1:
      b = "00000" + a.toString();
    break;
    case 2:
      b = "0000" + a.toString();
    break;
    case 3:
      b = "000" + a.toString();
    break;
    case 4:
      b = "00" + a.toString();
    break;
    case 5:
      b = "0" + a.toString();
    break;
    case 6:
      b = a.toString();
    break;

  }
  return b;
}

}
function previewInvoice (a,b,c,d,e,f){

  InvoiceService.previewInvoice(a,b,c,d,e)
  .then(function(r){
    console.log('success');
    console.log(r);


      if(f==='print'){
          window.open('user.php?page=printinvoice&input=true&username='+ $scope.invoice.selecteduserdata.username);
      }else if (f==='preview') {
          window.open('user.php?page=invoicepreview&input=true&username='+ angular.fromJson(c).username);
      }else if (f==='pdf') {
        window.open('user.php?page=pdfinvoice&input=true&username='+ angular.fromJson(c).username);

      }

  },function(){
    console.log('failed');
  });
}
function previewInvoiceFromList(a,b,c,d,e,f,g){
  console.log(g);
  InvoiceService.previewInvoice(a,b,angular.fromJson(c),angular.fromJson(d),angular.fromJson(e))
  .then(function(r){
    console.log('success');

      if(f==='print'){
        window.open('user.php?page=printinvoice&input=true&username='+ angular.fromJson(c).username + "&invoiceid=" + g);
      }else if (f==='preview') {
          window.open('user.php?page=invoicepreview&input=true&username='+ angular.fromJson(c).username + "&invoiceid=" + g);
      }else if (f==='pdf') {
        window.open('user.php?page=pdfinvoice&input=true&username='+ angular.fromJson(c).username + "&invoiceid=" + g);

      }

  },function(){
    console.log('failed');
  });
}
function addpaymentMethod(gateway,link){
    $scope.paymentmethodlist.push({gateway:gateway , link:link});
}
function addtoinvoiceitem(name,description,price,object){
  var a = $scope.taskoptions.indexOf(object);
  $scope.taskoptions.splice(a,1);

    $scope.invoiceitem.push({name:name,description:description,price:price,object:object});

    computeTotal($scope.invoiceitem);
}
function addtoinvoiceitemmanual(name,description,price){
    $scope.invoiceitem.push({name:name,description:description,price:price});
    computeTotal($scope.invoiceitem);
}
function removeInvoiceitem(index,object){
  if(angular.isDefined(object)){
    $scope.taskoptions.push(object);
  }
  $scope.invoiceitem.splice(index,1);
    computeTotal($scope.invoiceitem);
}
function removePaymentMethod(index){
    $scope.paymentmethodlist.splice(index,1);
}
function computeTotal(object){
  $scope.invoiceitemtotal = 0;
  for(i=0;i<object.length;i++){
    $scope.invoiceitemtotal  += parseInt(object[i].price);
  }
}
function getAppUsersTasks(id){
InvoiceService.getAppUsersTasks(id)
.then(function(response){
  console.log(response.data);
  $scope.taskoptions = response.data.data;
},function(error){

});
}
getAppUsers();
function getAppUsers(){
  InvoiceService.getAppUsers()
  .then(function(response){
    console.log(response.data.data);
      $scope.useroptions = response.data.data;
  },function(error){
    console.log(angular.toJson(error));
  });
}
$scope.ceateInvoice = function(info){

  $state.go('invoicecreate');
};
$scope.today = function() {
   $scope.dt = new Date();
 };
 $scope.today();

 $scope.clear = function() {
   $scope.dt = null;
 };

 // Disable weekend selection
 function disabled(data) {
   var date = data.date,
     mode = data.mode;
   return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
 }


 $scope.open1 = function() {
   $scope.popup1.opened = true;
 };

 $scope.open2 = function() {
   $scope.popup2.opened = true;
 };

 $scope.setDate = function(year, month, day) {
   $scope.dt = new Date(year, month, day);
 };

 $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
 $scope.format = $scope.formats[0];
 $scope.altInputFormats = ['M!/d!/yyyy'];

 $scope.popup1 = {
   opened: false
 };

 $scope.popup2 = {
   opened: false
 };


})
.controller('myTaskCtrl', function ($scope,$rootScope,$state){
      function getInfo(userinfo){

   }
});



angular.module('EASEDashboard.controllers')
.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items) {

  $scope.message = items;
  console.log($scope.message);
  $scope.ok = function () {
    $uibModalInstance.close();
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});
