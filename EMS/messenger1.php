<?php session_start(); 
                ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@50&display=swap');

html{
  background-color:#f7f7ff !important;
}
.chat-user-panel, .p-3{
  overflow:auto !important;
}

body {
  color: rgb(58, 65, 111);
  background-image: linear-gradient(to right, rgba(238, 240, 248, 0.5), rgb(238, 240, 248), rgba(238, 240, 248, 0.5));
  margin: 0px;
}

html body a {
  color: rgb(0, 115, 152);
  cursor: pointer;
  transition: all 0.2s linear 0s;
}

.container {
  padding-right: 0;
  padding-left: 0;
}

@media (min-width: 1400px) {
  .container {
    max-width: 1320px !important;
  }
}

.card-stacked {
  display: flex;
  flex-flow: row wrap;
}

.chat {
  position: relative;
}

.chat .chat-user-detail {
  position: absolute;
  left: 0px;
  width: 0px;
  opacity: 0;
  z-index: -4;
}

.chat .chat-header {
  border-bottom: 1px solid rgb(225, 225, 227);
  background: rgb(255, 255, 255);
}

.margin-auto {
  margin-top: auto !important;
  margin-bottom: auto !important;
}

.btn.btn-light-light:not(:disabled):not(.disabled).active, .btn.btn-light-light:not(:disabled):not(.disabled):active, .btn.btn-light:not(:disabled):not(.disabled).active,
.btn.btn-light:not(:disabled):not(.disabled):active, .show>.btn.btn-light-light.dropdown-toggle, .show>.btn.btn-light.dropdown-toggle {
  color: rgb(126, 130, 153);
  background-color: rgb(238, 240, 249);
  border-color: rgb(238, 240, 249);
}

.feather {
  color: rgb(61, 81, 167);
  fill: rgba(108, 124, 195, 0.15);
}

.avatar-xxl {
  width: 110px;
  height: 110px;
}

.animate4 {
  animation: 3s cubic-bezier(0.1, 0.82, 0.25, 1) 0s 1 normal none running animate4;
}

.fw-300 {
  font-weight: 300 !important;
}

.h6, h6 {
  font-size: 1.175rem;
}

.btn.btn-icon.btn-sm {
  height: 30px;
  width: 30px;
}

.btn.btn-icon.btn-sm i {
  font-size: 1.2rem;
}

.btn.btn-icon i {
  font-size: 1.35rem;
}

a.btn i, button.btn i {
  font-size: 1rem;
  vertical-align: middle;
}

.btn.btn-light-skype {
  background-color: rgba(0, 175, 240, 0.125);
  color: rgb(0, 175, 240) !important;
}

.btn.btn-light-facebook {
  background-color: rgba(59, 89, 152, 0.125);
  color: rgb(59, 89, 152) !important;
}

.btn.btn-light-twitter {
  background-color: rgba(29, 161, 242, 0.125);
  color: rgb(29, 161, 242) !important;
}

.btn.btn-light-instagram {
  background-color: rgba(225, 48, 108, 0.125);
  color: rgb(225, 48, 108) !important;
}

.btn.btn-icon {
  height: calc(1.5em + 1.2rem);
  width: calc(1.5em + 1.2rem);
  color: rgb(255, 255, 255);
  display: inline-flex;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  cursor: pointer;
  padding: 0px;
}

.btn-circle, .flag-circle {
  border-radius: 50% !important;
}

.btn-shadow {
  box-shadow: rgba(50, 50, 93, 0.11) 0px 4px 6px, rgba(0, 0, 0, 0.08) 0px 1px 3px;
}

.btn-group-sm>.btn, .btn-sm {
  font-size: 0.725rem;
  line-height: 1.35;
  padding: 0.45rem 0.75rem;
  border-radius: 0.4rem;
}

.btn {
  font-size: 0.875rem;
  font-weight: 400 !important;
  border-radius: 0.4rem;
  border-width: 1px;
  border-style: solid;
  border-color: transparent;
  border-image: initial;
  padding: 0.5rem 1rem;
}

.chat .chat-profile-picture {
  cursor: pointer;
}

.chat-search {
  padding-top: 9px;
  padding-bottom: 9px;
  background: rgb(241, 242, 250);
  border-bottom: 1px solid rgb(225, 225, 227);
}

.chat-search .input-group {
  position: relative;
  box-shadow: rgb(242, 242, 246) 0px 0px 0px 2px !important;
  border-radius: 8px;
  background: rgb(238, 240, 249);
}

.form-control input, .form-group input, input {
  box-shadow: none !important;
  font-size: 0.9rem;
  font-weight: 300 !important;
  border-radius: 5px;
  border-width: 1px;
  border-style: solid;
  border-color: rgb(222, 226, 230);
  border-image: initial;
}

.avatar-sm {
  height: calc(1.5em + 1.2rem) !important;
  width: calc(1.5em + 1.2rem) !important;
}

.btn.btn-light:hover {
 text-decoration:none !important;

  color: rgb(63, 66, 84);
  background-color: rgb(228, 230, 239);
}

.btn.focus, .btn:focus, .form-control:focus, .form-group input:focus, .form-group:focus, input:focus {
  box-shadow: rgba(101, 118, 255, 0.1) 0px 0px 0px 3px;
  border-color: rgba(101, 118, 255, 0);
  outline: 0px;
}

.card {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, .125);
  border-radius: 0.25rem;
}

.chat-search .input-group-text i {
  -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  cursor: pointer;
}

.drop-shadow {
  filter: drop-shadow(0 0 1px #504c4c54);
}

.fs-17 {
  font-size: 17px !important;
}

.chat-search .input-group-text {
  border-top-left-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
  position: relative;
  padding-top: 0;
  padding-bottom: 0;
}

.input-group>.input-group-append>.btn, .input-group>.input-group-append>.input-group-text, .input-group>.input-group-prepend:first-child>.btn:not(:first-child), .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child), .input-group>.input-group-prepend:not(:first-child)>.btn, .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.chat-search .input-group-text, .chat-search input {
  font-size: 14px;
  box-shadow: unset !important;
  border-width: initial;
  border-style: initial;
  border-color: transparent;
  border-image: initial;
  background: rgb(255, 255, 255);
  border-radius: 8px;
}
.chat-item:hover{
  text-decoration:none !important;
}
.chat-search input {
  width:90%;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
}

.prepend-white .input-group-text {
  background-color: #fff;
}

.input-group-text {
  font-size: unset;
  font-weight: unset;
  background-color: #eef0fc;
}

.pr-2, .px-2 {
  padding-right: 0.5rem !important;
}

.input-group-text {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  padding: 0.375rem 0.75rem;
  margin-bottom: 0;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  text-align: center;
  white-space: nowrap;
  background-color: #e9ecef;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}

.archived-messages {
  cursor: pointer;
}

.archived {
  background-image: url(https://user-images.githubusercontent.com/35243461/168796895-2fc5e22b-06db-46b5-9854-d517778cfe57.svg);
}

.svg15 {
  height: 15px;
  width: 15px;
}

.fw-400 {
  font-weight: 400 !important;
}

.text-dark-75 {
  color: #3f4254 !important;
}

.chat-user-panel {
  border-top: 1px solid #eef0f9;
  cursor: pointer;
}

.chat-user-scroll {
  max-height: 620px;
  position: relative;
}

.chat .chat-item {
  border-bottom-width: 1px;
  border-bottom-style: dashed;
  border-bottom-color: #e4e6ef;
}

img.shadow {
  box-shadow: 0 15px 35px rgba(50, 50, 93, .15), 0 5px 15px rgba(0, 0, 0, .15) !important;
}

.double-check {
  background-image: url(https://user-images.githubusercontent.com/35243461/168796897-1db3c9e8-c8e4-47b5-8399-9ee230bcd35f.svg);
}

.chat .chat-item .message-shortcut {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
}

.fs-13 {
  font-size: 13px !important;
}

.fs-15 {
  font-size: 15px !important;
}

.pinned {
  background-image: url(https://user-images.githubusercontent.com/35243461/168796901-94490a54-e25d-4094-a91d-38f357898ad6.svg);
}

.svg18 {
  height: 18px;
  width: 18px;
}

.chat .chat-item.active, .chat .chat-item:hover {
  text-decoration:none !important;
  background-color: #f5f8fa;
}

.badge.round {
  border-radius: 1.5rem;
}

.badge-light-success {
  background-color: rgba(10, 187, 135, .1);
  color: #0abb87;
}

.badge {
  font-weight: 500;
  display: inline-block;
  padding: 0.4em 1.2em;
  font-size: 80% !important;
  text-align: center;
  vertical-align: baseline;
  border-radius: 0.25rem;
  transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.single-check {
  background-image: url(https://user-images.githubusercontent.com/35243461/168796902-03e56437-61b1-48a5-a55e-3dcc41a09deb.svg);
}

.double-check-blue {
  background-image: url(https://user-images.githubusercontent.com/35243461/168796899-499f66ce-ed05-404d-8f37-063165788b31.svg);
}

::-webkit-input-placeholder {
  font-size: .8rem
}

::-moz-placeholder {
  font-size: .8rem
}

:-ms-input-placeholder {
  font-size: .8rem
}

.shadow-line {
  box-shadow: rgba(62, 57, 107, 0.07) 0px 1px 15px 1px;
  border-width: 1px;
  border-style: solid;
  border-color: rgba(211, 218, 230, 0.43);
  border-image: initial;
}

.text-small {
  font-size: 12px !important;
}

.chat-panel-scroll {
  max-height: 680px;
  position: relative;
}

.horizontal-margin-auto {
  margin-right: auto !important;
  margin-left: auto !important;
}

.loader-animate3 {
  background-image: url(https://user-images.githubusercontent.com/35243461/168796900-207c2e2a-4a21-4ef0-9dc7-fd82e3e20073.svg);
}

.svg36 {
  height: 36px;
  width: 36px;
}

.letter-space {
  letter-spacing: 1.5px;
}

.fs-12 {
  font-size: 12px !important;
}

.chat.chat-panel .left-chat-message, .chat.chat-panel .right-chat-message {
  padding: 0.5rem 1rem;
  max-width: 47%;
}

.left-chat-message {
  position: relative;
  margin: 0 0 0 10px;
  background: #fff;
  width: fit-content;
  max-width: 60%;
  padding: 0.7rem 1rem;
  border-radius: 0.357rem;
  -webkit-box-shadow: 0 4px 8px 0 rgb(34 41 47 / 3%);
  box-shadow: 0 4px 8px 0 rgb(34 41 47 / 3%);
}

.chat.chat-panel .message-arrow, .chat.chat-panel .message-time {
  position: absolute;
  right: 5px;
  bottom: 5px;
  padding: 2px 6px;
  font-size: 11px;
  color: #6c757d;
  cursor: pointer;
}

.chat.chat-panel .message-arrow, .chat.chat-panel .message-time {
  position: absolute;
  right: 5px;
  bottom: 5px;
  padding: 2px 6px;
  font-size: 11px;
  color: #6c757d;
  cursor: pointer;
}

.chat.chat-panel .message-arrow {
  transform: scale(0);
}

.chat.chat-panel {
  background: linear-gradient(to bottom, #e9e4f07d, #d3cce34f);
}

.chat {
  position: relative;
}

.chat.chat-panel .left-chat-message, .chat.chat-panel .right-chat-message {
  padding: 0.5rem 1rem;
  max-width: 47%;
}

.chat.chat-panel .left-chat-message, .chat.chat-panel .right-chat-message {
  padding: 0.5rem 1rem;
  max-width: 47%;
}
.users-list{
  overflow:auto !important;
  height:686px
}
.right-chat-message {
  position: relative;
  margin: 0 10px 0 0;
  background: linear-gradient(to right, #348ac7, #7474bf);
  color: #fff;
  width: fit-content;
  max-width: 60%;
  padding: 0.7rem 1rem;
  border-radius: 0.357rem;
  -webkit-box-shadow: 0 4px 8px 0 rgb(34 41 47 / 12%);
  box-shadow: 0 4px 8px 0 rgb(34 41 47 / 12%);
}

.chat.chat-panel .message-options.dark .message-arrow i, .chat.chat-panel .message-options.dark .message-time {
  color: #fff !important;
}

.chat.chat-panel .chat-upload-trigger {
  position: relative;
}

.chat.chat-panel .chat-upload.active {
  -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  transform: scale(1);
  bottom: 50px;
}

.chat.chat-panel .chat-upload {
  -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  transform: scale(0);
  position: absolute;
  left: -5px;
  bottom: -50px;
}

.btn.btn-light-secondary.btn-blushing, .btn.btn-secondary.btn-blushing {
  box-shadow: 1px 1px 1px 1px rgb(117 106 208 / 40%);
}

.btn.btn-secondary {
  color: #fff;
  background-color: #8950fc;
  border: 0;
}

.btn.btn-danger.btn-blushing, .btn.btn-light-danger.btn-blushing {
  box-shadow: 1px 1px 1px 1px #fd397a5c;
}

.btn.btn-light-warning.btn-blushing, .btn.btn-warning.btn-blushing {
  box-shadow: 1px 1px 1px 1px rgb(255 184 34 / 40%);
}

.btn.btn-light-success.btn-blushing, .btn.btn-success.btn-blushing {
  box-shadow: 1px 1px 1px 1px rgb(10 187 135 / 40%);
}

.btn.btn-light-secondary.btn-blushing, .btn.btn-secondary.btn-blushing {
  box-shadow: 1px 1px 1px 1px rgb(117 106 208 / 40%);
}

.chat-search .input-group-text i {
  -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  cursor: pointer;
}

.chat-search .input-group-text i:hover {
  text-decoration:none !important;
  -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  -webkit-transform: translateY(-2px) scale(1);
  transform: translateY(-2px) scale(1);
}

.fs-19 {
  font-size: 19px !important;
}

.chat.chat-panel .left-chat-message, .chat.chat-panel .right-chat-message {
  padding: .5rem 1rem;
  max-width: 47%
}

.chat.chat-panel .message-arrow {
  transform: scale(0);
}

.chat.chat-panel .left-chat-message:hover .message-time, .chat.chat-panel .right-chat-message:hover .message-time {
 text-decoration:none !important;
  -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  transform: scale(0);
}

.chat.chat-panel .left-chat-message:hover .message-arrow, .chat.chat-panel .right-chat-message:hover .message-arrow {
 text-decoration:none !important;
  
 -webkit-transition: all .25s ease 0s;
  transition: all .25s ease 0s;
  transform: scale(1);
}

.chat .chat-user-detail {
  position: absolute;
  left: 0;
  width: 0;
  opacity: 0;
  z-index: -4;
}

.chat .chat-user-detail.active {
  -webkit-transition: all .25s ease 0s;
  transition: all .4s cubic-bezier(1, .04, 0, .93) 0s;
  height: 100%;
  width: 100%;
  background: #f1f2fa;
  z-index: 1;
  opacity: 1;
}

.card {
  margin-bottom: 1.875rem;
  border: none !important;
  box-shadow: 0 1px 2px #00000030;
  border-radius: 0.45rem;
  width: 100%;
}

.btn.btn-light-skype.focus, .btn.btn-light-skype:focus, .btn.btn-light-skype:hover:not(:disabled):not(.disabled) {
 text-decoration:none !important;
  
  color: #fff !important;
  background-color: #00aff0;
  border-color: #00aff0;
}

.btn.btn-light-facebook.focus, .btn.btn-light-facebook:focus, .btn.btn-light-facebook:hover:not(:disabled):not(.disabled) {
  text-decoration:none !important;
  color: #fff !important;
  background-color: #3b5998;
  border-color: #3b5998;
}

.btn.btn-light-twitter.focus, .btn.btn-light-twitter:focus, .btn.btn-light-twitter:hover:not(:disabled):not(.disabled) {
 text-decoration:none !important;
  color: #fff !important;
  background-color: #1da1f2;
  border-color: #1da1f2;
}

.btn.btn-light-instagram.focus, .btn.btn-light-instagram:focus, .btn.btn-light-instagram:hover:not(:disabled):not(.disabled) {
 text-decoration:none !important;
  color: #fff !important;
  background-color: #e1306c;
  border-color: #e1306c;
}

/*perfect scrollbar*/
.ps-container {
  -ms-touch-action: none !important;
  touch-action: none !important;
  overflow: hidden !important;
  -ms-overflow-style: none !important
}

@supports (-ms-overflow-style:none) {
  .ps-container {
    overflow: auto !important
  }
}

@media screen and (-ms-high-contrast:active), (-ms-high-contrast:none) {
  .ps-container {
    overflow: auto !important
  }
}

.ps-container.ps-active-x>.ps-scrollbar-x-rail, .ps-container.ps-active-y>.ps-scrollbar-y-rail {
  display: block;
  background-color: transparent
}

.ps-container.ps-in-scrolling {
  pointer-events: none
}

.ps-container.ps-in-scrolling.ps-x>.ps-scrollbar-x-rail {
  background-color: #eee;
  opacity: .9
}

.ps-container.ps-in-scrolling.ps-x>.ps-scrollbar-x-rail>.ps-scrollbar-x {
  background-color: #999
}

.ps-container.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail {
  background-color: #eee;
  opacity: .9
}

.ps-container.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail>.ps-scrollbar-y {
  background-color: #999
}

.ps-container>.ps-scrollbar-x-rail {
  display: none !important;
  position: absolute;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  opacity: 0;
  bottom: 3px;
  height: 8px
}

.ps-container>.ps-scrollbar-x-rail>.ps-scrollbar-x {
  position: absolute;
  background-color: #aaa;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  bottom: 0;
  height: 4px
}

.ps-container>.ps-scrollbar-y-rail {
  display: none !important;
  position: absolute;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  opacity: 0;
  right: 3px;
  width: 4px
}

.ps-container>.ps-scrollbar-y-rail>.ps-scrollbar-y {
  position: absolute;
  background-color: #a2adb7;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  right: 0;
  width: 4px
}

.ps-container:hover.ps-in-scrolling {
  pointer-events: none
}

.ps-container:hover.ps-in-scrolling.ps-x>.ps-scrollbar-x-rail {
  background-color: #eee;
  opacity: .9
}

.ps-container:hover.ps-in-scrolling.ps-x>.ps-scrollbar-x-rail>.ps-scrollbar-x {
  background-color: #a2adb7
}

.ps-container:hover.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail {
  background-color: #eee;
  opacity: .9
}

.ps-container:hover.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail>.ps-scrollbar-y {
  background-color: #a2adb7
}

.ps-container:hover>.ps-scrollbar-x-rail, .ps-container:hover>.ps-scrollbar-y-rail {
  opacity: .6
}

.ps-container:hover>.ps-scrollbar-x-rail:hover {
  background-color: #eee;
  opacity: .9
}

.ps-container:hover>.ps-scrollbar-x-rail:hover>.ps-scrollbar-x {
  background-color: #a2adb7
}

.ps-container:hover>.ps-scrollbar-y-rail:hover {
  background-color: #eee;
  opacity: .9
}

.ps-container:hover>.ps-scrollbar-y-rail:hover>.ps-scrollbar-y {
  background-color: #a2adb7
}
#chatPanel {
    height: 700px; /* Adjust the height as needed */
    overflow-y: scroll;
}
.posts-section-pro{
  margin-top:-5px;
  background-color:white;
  margin-left:20px;
  margin-right:10px;
  padding:10px;
  margin-bottom:-20px
}
.posts-section-pro h1{
  font-size:20px;

}
.card-stacked{
  height:810px !important;
}
    </style>
    
</head>
<body>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Organizer Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/core/css/main.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />
</head>
<link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">

                <?php 
  include_once "connection.php";
  if(!isset($_SESSION['unique_id'])){
echo'user not found';  }

?>
<body>
<iframe src="orgframe.php" frameborder="0" width="100%" height="350px"style="z-index:999"></iframe>
<div class="container"><div class="posts-section-pro
                                ">
                                    <div class="section">
                                        <h1>Messages</h1>
                                    </div></div></div>
<div class="main-wrapper">
<div class="container">
<div class="page-content">
<div class="container mt-5">
<div class="row">
<div class="col-md-4 col-12 card-stacked">
<div class="card shadow-line mb-3 chat">
<div class="chat-user-detail">
<div class="p-3 chat-header">
<div class="w-100">
<div class="d-flex pl-0">
<div class="d-flex flex-row mt-1 mb-1">
<span class="margin-auto mr-2">
<svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
<polyline points="15 18 9 12 15 6"></polyline>
</svg>
</a>
</span>
<p class="margin-auto fw-400 text-dark-75">Profile</p>
</div>
<div>
</div>
</div>
</div>
</div>
<div class="p-3 chat-user-info">
<div class="card-body text-center">
<a href="#!">
</a>


</div>
</div>
</div>
<div class="p-3 chat-header">
<div class="d-flex">
<div class="w-100 d-flex pl-0">
<?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
<img class="user-detail-trigger rounded-circle shadow avatar-sm mr-3 chat-profile-picture" src="<?php echo $_SESSION["picture"]  ?>" />
<?php echo $_SESSION["organizer_name"]  ?></div>
<div class="flex-shrink-0 margin-auto">

</svg>
</a>
</div>
</div>
</div>

<div class="archived-messages d-flex p-3">
<div class="w-100">
<div class="d-flex pl-0">
<div class="d-flex flex-row mt-1">
<span class="margin-auto mr-2">
</span>
<p class="margin-auto fw-400 text-dark-75">All Users</p>
</div>
<div>
</div>
</div>
</div>
</div>
<div class="user3-list">
     
     </div>



</div>
</div>
<?php 
  include_once "connection.php";
  if(!isset($_SESSION['unique_id'])){
echo'error';  }
?>
<div class="col-md-8 col-12 card-stacked">
<div class="card shadow-line mb-3 chat chat-panel">
<div class="p-3 chat-header">
<div class="d-flex">
<div class="w-100 d-flex pl-0">
<?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
<img class="rounded-circle shadow avatar-sm mr-3 chat-profile-picture" src="<?php echo $row['picture']; ?>">
<div class="mr-3">
<a href="!#">
<p class="fw-400 mb-0 text-dark-75"><?php echo $row['name'] ?></p>
</a>
</div>
</div>


</div>
</div>

<div class="d-flex flex-row mb-3 navigation-mobile scrollable-chat-panel chat-panel-scroll">
<div class="w-100 p-3" id="chatPanel"><div class="chat-box">

      </div>

</div>
</div><form action="#" class="typing-area">
<div class="chat-search pl-3 pr-3">
<div class="input-group">
<input type="text" class="form-control incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
<input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off"><div class="input-group-append prepend-white">
<span class="input-group-text pl-2 pr-2">
<button style="background-color:white; border:none"><i class="  fs-19 bi bi-cursor ml-2 mr-"></i></button>
<div class="chat-upload">
<div class="d-flex flex-column">





</div>
</div>
</div>
</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
  <script src="javascript/user3.js"></script>
  <script src="javascript/chat.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
</body>
</html>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

  // Function to scroll the chat panel to the bottom
function scrollToBottom() {
    var chatPanel = document.getElementById("chatPanel");
    chatPanel.scrollTop = chatPanel.scrollHeight;
}

// Scroll to the bottom when the page loads
window.onload = scrollToBottom;

// Example: Add a new message to the chat panel
function addNewMessage(message) {
    var chatBox = document.querySelector(".chat-box");
    var newMessage = document.createElement("div");
    newMessage.textContent = message;
    chatBox.appendChild(newMessage);
    
    // Scroll to the bottom after adding the new message
    scrollToBottom();
}

// Usage example: addNewMessage("Hello, world!");

	
</script>	<script type="text/javascript" src="assets/admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/admin/js/popper.js"></script>
	<script type="text/javascript" src="assets/admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/admin/js/jquery.mCustomScrollbar.js"></script>
	<script type="text/javascript" src="assets/admin/js/slick.min.js"></script>
	<script type="text/javascript" src="assets/admin/js/scrollbar.js"></script>
	<script type="text/javascript" src="assets/admin/js/script.js"></script>

</body>
</html>