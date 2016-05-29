<!-- The Right Sidebar -->
<aside class="control-sidebar control-sidebar-light" ng-controller="chatCtrl">
  <div class="user-block">
    <span class="username">Conversations</a></span>
  </div>
  <!-- Content of the sidebar goes here -->
  <ul class="nav nav-stacked" >

  <li  ng-repeat="item in conversations">
    <a ng-click="addChatBox(item)">

      <div class="easechat_user">
        <i class="fa fa-circle-o" aria-hidden="true" style="color:#82BB05" ng-show="userstatus[item.user_two].status===0"></i>
        <i class="fa fa-check-circle" aria-hidden="true" style="color:#7FBA00" ng-show="userstatus[item.user_two].status===1"></i>
        <i class="fa fa-clock-o" aria-hidden="true" style="color:#FCD116" ng-show="userstatus[item.user_two].status===2"></i>
        <i class="fa fa-minus-circle" aria-hidden="true" style="color:#E81123" ng-show="userstatus[item.user_two].status===3"></i>
        <i class="fa fa-circle-thin" aria-hidden="true" style="color:#C9DD9D" ng-show="userstatus[item.user_two].status===4"></i>

        {{getUserName(item.user_two,item.conv_id)}}</div>
    </a>
</li>

  </ul>
  <div ng-repeat="item in chatboxes" ng-init="getProfilePicture(item.user_two)">
  <div class="box box-danger direct-chat direct-chat-danger box-shadow" style="position:fixed;bottom:-5px;width:250px;background:white;border-radius:5px 5px 0px 0px;margin-bottom:0px;right:{{chatboxesspace[$index]}}px;z-index:1000;" >
        <div class="box-header with-border">
          <h3 class="box-title">{{userNames[item.conv_id]}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" ng-click="removeChatBox(item.conv_id)"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" ng-init="chatMessages[item.conv_id]=undefined;loadChatMessages(item.conv_id,item)">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages" >
            <div  class="direct-chat-msg " ng-repeat="message in chatMessages[item.conv_id]" ng-class="{right: message.userid === 1}">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-right"><strong ng-show="message.userid === 1">EASE Tech.</strong><strong ng-show="message.userid !== 1">{{userNames[item.conv_id]}}</strong></span>
                      <span class="direct-chat-timestamp pull-left">{{message.time}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="uploads/avatars/{{getProfilePicture(item.user_two)}}" alt="Message User Image" ng-show="message.userid !== 1"><!-- /.direct-chat-img -->
                    <img class="direct-chat-img" src="img/logo.png" alt="Message User Image" ng-show="message.userid === 1">
                    <div class="direct-chat-text">
                    {{message.reply}}
                    </div>
                    <!-- /.direct-chat-text -->
            </div>
            <div  class="direct-chat-msg right" ng-hide="sendingreply[item.conv_id]===undefined">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-right"><strong>EASE Tech.</strong></span>
                      <span class="direct-chat-timestamp pull-left">{{message.time}}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="img/logo.png" alt="Message User Image"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    {{sendingreply[item.conv_id]}}
                    <!-- <i class="fa fa-spinner fa-pulse" style="align:right;"></i> -->
                    </div>
                    <!-- /.direct-chat-text -->
            </div>
            <a id="bottom{{item.conv_id}}"></a>
              <!-- <div ng-class="item.userid === 1 ? 'direct-chat-info' : 'direct-chat-text'"  ng-repeat="message in chatMessages[item.conv_id]">
                {{message.reply}}
                <span class="direct-chat-timestamp pull-right">{{message.time}}</span>
              </div> -->

          </div>
          <!--/.direct-chat-messages-->
          <!-- /.direct-chat-pane -->
        </div>
        <div class="overlay" ng-show="chatMessages[item.conv_id]==indefined">

                <i class="fa fa-spinner fa-pulse"></i>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <form >
            <div class="input-group">
              <input name="message" placeholder="Type Message ..." class="form-control" type="text" ng-model="chat.replyMessage" ng-keypress="key($event,item.conv_id)">
                  <span class="input-group-btn">
                    <a class="btn btn-danger btn-flat" ng-click="sendReply(item.conv_id,chat.replyMessage);chat.replyMessage=''" id='SubmitChat{{item.conv_id}}'>Send</a>
                  </span>
            </div>
          </form>
        </div>
        <!-- /.box-footer-->
      </div>
  </div>
  <style media="screen">
    .box-shadow{
      -webkit-box-shadow: 0px 5px 9px 0px rgba(0,0,0,0.52);
  -moz-box-shadow: 0px 5px 9px 0px rgba(0,0,0,0.52);
  box-shadow: 0px 5px 9px 0px rgba(0,0,0,0.52);
    }
  </style>
</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg"></div>
