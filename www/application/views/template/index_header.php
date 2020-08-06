<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width,initial-scale=1" name="viewport">
  <meta content="description" name="description">
  <meta name="google" content="notranslate" />
  <meta content="Mashup templates have been developped by Orson.io team" name="author">

  <!-- Disable tap highlight on IE -->
  <meta name="msapplication-tap-highlight" content="no">
  
  
  <link rel="apple-touch-icon" sizes="180x180" href="/common/assets/apple-icon-180x180.png">

  <link href="" rel="stylesheet">


  <title>THE WIN STUDY CAFE</title>

<link href="/common/css/main.550dcf66.css" rel="stylesheet"></head>
<link href="/common/css/dong.css" rel="stylesheet"></head>

<body> 
<!-- Add your content of header -->
<header>
  <nav class="navbar navbar-default active">    
    <div class="container">
      
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/main" title="">
          <img src="/common/assets/images/mashup-icon.svg" class="navbar-logo-img" alt="">
          THE WIN STUDY CAFE
        </a>
      </div>

      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/main" title="">Home</a></li>
          <li><a href="/posts" title="">이용 후기</a></li>
          <?php if(@$mb['idx']) { ?>
            <li><a href="/mypage" title="">마이페이지</a></li>
            <li><a href="/logout" title="">로그아웃</a></li>            
            <?php if(@$mb['idx'] == 1) { ?>
              <li><a href="/admin" title="">ADMIN</a></li>
            <?php } ?>
          <?php } else { ?>
            <li>
              <p>
                <a href="/join" class="btn btn-default navbar-btn" title="">가입하기</a>
              </p>
            </li>
            <li><a href="/login" title="">로그인</a></li>
          <?php } ?>
        </ul>
      </div> 
    </div>
  </nav>
</header>