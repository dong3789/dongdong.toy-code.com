
<!-- Add your site or app content here -->
  <div class="hero-full-container background-image-container white-text-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1>THE WIN STUDY CAFE</h1>
          <?php if(@$mb['idx']) { ?>
            <p><?= $mb['nickname']?>님 환영합니다.</p>
          <?php }?>
          <br>
          <a href="./posts" class="btn btn-default btn-lg" title="">이용 후기</a>
        </div>
      </div>
    </div>
  </div>

  <div class="section-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
          <div class="text-center">
            <h2>공부엔 왕도 없다.</h2>
            <p>최고의 학습은 최적의 장소에서 이뤄집니다.
            </p>
          </div>
       </div>
      </div>
    </div>
  </div>

  <div class="section-container">
    <div class="container">
      <div class="row">      
          <div class="col-xs-12">


            <div id="carousel-example-generic" class="carousel carousel-fade slide" data-ride="carousel">
                
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img class="img-responsive" src="/common/assets/images/img-09.jpg" alt="First slide">
                        <div class="carousel-caption card-shadow reveal">
                          
                          <h3>별도의 노트북 사용 공간</h3>
                          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                          </a>
                          <p>
                            노트북 사용을 위한 최적의 공간을 별도로 마련하였습니다. 이제 옆사람 눈치 보지 마세요. 
                          </p>
                          
                          
                         <a href="./posts" class="btn btn-primary" title="">
                            이용후기
                          </a>
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="/common/assets/images/img-10.jpg" alt="First slide">
                        <div class="carousel-caption card-shadow reveal">

                          <h3>집중 학습을 위한 최고의 선택</h3>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                              <i class="fa fa-chevron-left" aria-hidden="true"></i>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                              <i class="fa fa-chevron-right" aria-hidden="true"></i>
                              <span class="sr-only">Next</span>
                            </a>
                          <p>
                            
                          </p>
                          
                          <p>
                            최고의 학습을 위학 지름길은 집중력! 
                          </p>
                          <p>
                            THE WIN STUDY CAFE는 당신의 집중력을 위해 최상의 환경을 제공합니다.
                          </p>
                          <a href="./posts" class="btn btn-primary" title="">
                            이용후기
                          </a>
                        </div>
                    </div>
                </div>
               
            </div>

           
          </div>
          
        </div>  
      
    </div>
  </div>

  <div class="section-container">
    <div class="container text-center">
      <div class="row section-container-spacer">
        <div class="col-xs-12 col-md-12">
          <h2>성공을 위한 잠깐의 쉼</h2>
          <p>천리 길도 한 걸음부터. 
            잠시 머리를 식히는 공간도 마음에 드실 겁니다.</p>
        </div>  
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <img src="/common/assets/images/img-cafe-01.jpg" alt="" class="reveal img-responsive reveal-content image-center">
        
        </div>
       
        <div class="col-xs-12 col-md-4">
          <img src="/common/assets/images/img-cafe-03.jpg" alt="" class="reveal img-responsive reveal-content image-center">
          
        </div>
        <div class="col-xs-12 col-md-4">
          <img src="/common/assets/images/img-cafe-04.jpg" alt="" class="reveal img-responsive reveal-content image-center">         
        </div>
      </div>
    </div>
  </div>
 
  <div class="section-container contact-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="section-container-spacer">
            <h2 class="text-center">문의하기</h2>
            <p class="text-center">궁금하신 사항이 있다면 언제든 연락주세요. 언제나 여러분의 의견을 듣습니다.
            </p>
          </div>
          <div class="card-container">
            <div class="card card-shadow col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 reveal">
              <form action="" class="reveal-content">
                <div class="row">
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="subject" placeholder="제목">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" rows="3" placeholder="내용"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">전송하기</button>
                  </div>
                  <div class="col-md-5">
                    <ul class="list-unstyled address-container">
                      <li>
                        <span class="fa-icon">
                          <i class="fa fa-phone" aria-hidden="true"></i>
                        </span>
                        + 010 - 1234 - 5644
                      </li>
                      <li>
                        <span class="fa-icon">
                          <i class="fa fa fa-map-o" aria-hidden="true"></i>
                        </span>
                        경기도 부천시 신흥로 163, 5층
                        <p>THE WIN STUDY CAFE</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-image col-xs-12" style="background-image: url(/common/assets/images/img-01.jpg')">
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>