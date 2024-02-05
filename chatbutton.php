<?php
$currentContact = getCurrentContact();
?>
<style>
    .shortcut-contact-container {
        position: fixed;
        z-index: 9;
        right: 27px;
        bottom: 50px;
    }

    .btn-chat-container .btn.btn-chat {
        line-height: 60px;
        position: relative;
        z-index: 201000000;
        width: 60px;
        height: 60px;
        margin: 0;
        padding: 0;
        cursor: pointer;
        text-align: center;
        border-radius: 50%;
        background-color: #85cf2f;
        box-shadow: rgba(0,0,0,.15) 0 4px 12px 0;
    }

    .btn-chat-container .btn.btn-chat .close-icon {
        position: absolute;
        z-index: 1;
        left: 0;
        display: inline-block;
        width: 60px;
        height: 60px;
        margin: 0;
        -webkit-transition: all 0.6s ease;
        transition: all 0.6s ease;
        opacity: 0;
        border-radius: 50%;
        background-color: transparent;
        background-image: url(./images/close.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 30px;
    }

    .btn-chat-container .btn.btn-chat .icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        margin: 15px;
        -webkit-transition: transform 0.3s ease;
        transition: transform 0.3s ease;
        background-image: url(./images/chat_with_owner_white.png);
        background-size: 30px;
    }

    .btn-chat-container .btn.btn-chat .text {
        -webkit-animation: fade-out 5s;
        animation: fade-out 5s;
        pointer-events: none;
        opacity: 0;
    }
  
    .btn-chat-container .btn.btn-chat .text {
        right: 70px;
    }

    .btn-chat-container .btn.btn-chat .text, .btn-chat-container .social-button .btn .text {
        font-size: 14px;
        position: absolute;
        right: 60px;
        display: inline-block;
        padding: 5px 10px;
        color: white !important;
        border-radius: 10px;
        background: rgba(0,0,0,.5);
        box-shadow: 2px 2px 3px rgba(0,0,0,.1);
    }

    .btn-chat-container .btn.btn-chat .text {
        display: block;
        margin-left: 30px;
        color: #fff;
    }

    .btn-chat-container .btn .text {
        line-height: 24px;
        top: 10px;
        text-align: center;
        vertical-align: top;
        white-space: nowrap;
    }

    @keyframes fade-out{
        0% {
        opacity: 0;
        display: none;
        }
        10% {
        opacity: 1;
        }
        90% {
        opacity: 1;
        }
        100% {
        opacity: 0;
        display: none;
        }
    }

    .btn-chat-container .social-button {
        position: absolute;
        top: 0;
        margin: 0 5px;
        padding: 0;
        list-style: none;
        pointer-events: none;
    }

    .btn-chat-container .btn.btn-chat.selected {
        background-color: #ccc;
    }

    .btn-chat-container .btn.btn-chat.selected .close-icon {
        transform: rotate(360deg);
        opacity: 1;
        background-color: #ccc;
    }

    .btn-chat-container .btn.btn-chat.selected .icon {
        transform: rotate(540deg);
    }

    .shortcut-contact-container .social-button.show {
        pointer-events: all;
    }

    .shortcut-contact-container .social-button.show .btn:nth-child(1) {
        top: -120px;
    }

    .shortcut-contact-container .social-button.show .btn:nth-child(2) {
        top: -180px;
    }

    .shortcut-contact-container .social-button.show .btn {
        opacity: 1;
    }

    .btn-chat-container .social-button .btn-line {
        background-color: #00B900;
    }

    .btn-chat-container .social-button .btn-mobile {
        background-color: #00a2ff;
    }

    .btn-chat-container .social-button .btn-box {
        background-color: #0A7CFF;
    }

    .btn-chat-container .social-button .btn {
        position: absolute;
        z-index: 1;
        top: 0;
        float: none;
        width: 55px;
        height: 55px;
        padding: 0;
        -webkit-transition: all 0.6s ease;
        transition: top 0.5s ease,opacity 0.2s ease;
        opacity: 0;
        border-radius: 60px;
        box-shadow: 2px 2px 6px rgba(0,0,0,.4);
    }

    .btn-chat-container .social-button .btn a {
        line-height: 0;
        display: block;
        padding: 10px;
    }

    .btn-chat-container .social-button .btn-mobile .icon {
        background: transparent url(./images/telephone.png) no-repeat center;
    }

    .btn-chat-container .social-button .btn .icon {
        width: 28px;
        height: 28px;
        -webkit-mask-repeat: no-repeat;
        -webkit-mask-position: center;
        margin-right: auto;
        margin-left: auto;
    }
    
    p{
        font-size: 16px;
    }

    .img-responsive{
        display:block; 
        margin-left:auto; 
        margin-right:auto; 
        width: 250px; 
        height: 250px;
    }
    
    .modal-body p a{
        color:#00AACE;
    }

    .text-1 {
        font-size: .9em !important;
    }

    #ModalTel .modal-body {
        margin-left: auto;
        margin-right: auto;
        font-size: 40px;
    }

    #ModalTel .modal-header .modal-title{
        margin-left: 85px;
    }
</style>
  <div class="shortcut-contact-container btn-chat-container">
    <div class="btn btn-chat">
      <div class="close-icon" onclick="goto_chat();"></div>
        <div class="icon"></div>
          <div class="text">พูดคุย-สอบถาม คลิก</div>
    </div>
    <ul class="social-button">
      <button type="button" class="btn btn-line" data-toggle="modal" data-target="#ModalLine">
        <img src="./images/LINE_SOCIAL_Circle.png" width="45px">
      </button>
      <button type="button" class="btn btn-mobile" data-toggle="modal" data-target="#ModalTel">
        <div class="icon"></div>
      </button>
      <button type="button" class="btn btn-box">
        <div id="fb-root"></div>
        <div id="fb-customer-chat" class="fb-customerchat"></div>
      </button>
    </ul>
  </div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "111930948550416");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v16.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

  <div class="modal fade" id="ModalLine" tabindex="-1" role="dialog" aria-labelledby="ModalLineTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title" id="exampleModalLongTitle" style="color:green">Line Chat</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>
                      <img class="img-responsive" style="display:block; margin-left:auto; margin-right:auto; width: 250px; height: 250px;" src="https://qr-official.line.me/gs/M_083gbuff_BW.png">
                      line ID : 
                      <span style="color:green">@083GBUFF</span>
                      <br>
                      Scan QR code หรือกด Add friend ได้ที่ 
                      <a href="https://lin.ee/uW4QqDJv" target="_blank">
                          <span class="text-1">https://lin.ee/uW4QqDJv</span>
                      </a>
                  </p>
              </div>
            </div>
        </div>
    </div>

  <div class="modal fade" id="ModalTel" tabindex="-1" role="dialog" aria-labelledby="ModalTelTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLongTitle">เบอร์ติดต่อ</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style=""><?php echo $currentContact["phone"];?></div>
                </div>
          </div>
      </div>
  </div>

  <script>
    function goto_chat(livechat_enabled){
      if($('.btn-chat-container .btn-chat').hasClass('selected')){
        $('.btn-chat-container .btn-chat').removeClass('selected');
        $('.btn-chat-container .social-button').removeClass('show');
      }else{
        $('.btn-chat-container .btn-chat').addClass('selected');
        $('.btn-chat-container .btn-chat .text').remove();
        $('.btn-chat-container .social-button').addClass('show');
      }
    }
  </script>