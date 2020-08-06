<div class="postsList"><h2>이용 후기</h2></div>
	<div class="form-list-main">
		<form name="search_post" action="./posts" method="get" onsubmit="return searchPost();">		
				<input type="text" name="search_post" class="search_post" placeholder="검색어를 입력하세요"  size=40>
			<img src="/common/img/search1.svg" class="search_img" alt="">
		</form>	
	
		<div class="form-list">
			<div class="postsBtn">
				<ul class="posts-petition">
					<?php
					//게시물 출력
					
					foreach ($list AS $k=>$v) {
					?>
						
							<li>
								<div class="post-box">
									<a href="/postDetail/<?= $v['idx']?>" class="postsBtn-a">
										
										<?php if($v['image_ary']['file_path']) { ?>	
											<div class="posts-image"><img src="<?=$v['image_ary']['file_path']?>"></div>		
										<?php } else { ?>	
											<div class="posts-image"><img src="/common/assets/images/img-03.jpg"></div>				
										<?php }?>
										<div class="posts-title"><?= $v['title'] ?></div>	
							
										<!-- <div class="posts-content"><?=$v['content']?></div>		 -->		
										<div class="posts-writer"><?=$v['writer']?></div>					
										
										<div class="posts-date"><?=$v['reg_date']?></div>
										<img src="/common/assets/images/eye.svg" class="cntSvg"><?=$v['view_cnt']?>
										<img src="/common/assets/images/comment-img.svg" class="com_cntSvg"><?=$v['comment_cnt']?>
									</a>
								</div>
							</li>						
							
					<?php }?>
				</ul>		
			</div>
				<!-- <div class="post-box"> 
					<tr>
						<td>글 번호</td>
						<td>제목</td>
						<td>작성자</td>
						<td>작성일</td>
						<td>조회수</td>
					</tr>
					<?php
					//게시물 출력
					foreach ($list AS $k=>$v) {
					?>
						<tr>
							<td><?=$v['idx']?></td>
							<td><a href="/postDetail/<?= $v['idx']?>"> <?= $v['title'] ?></a></td>
							<td><?=$v['writer']?></td>
							<td><?=$v['reg_date']?></td>
							<td><?=$v['view_cnt']?></td>
						</tr>
				<?php }?>
			</div> -->	
		</div>
	</div>
	<div class="pagingBtn">		

			<?php if($paging['s_page'] > 1){ ?>				
					<a href="/posts?page=1&search_post=<?=$search_post?>">&lt;&lt;</a>
					<a href="/posts?page=<?=$paging['s_page']-5?>&search_post=<?=$search_post?>">&lt;</a>
			<?php } ?>			

			<?php for($i=$paging['s_page']; $i<=$paging['e_page']; $i++) {?>	

				<?php if($i == $paging['n_page']) {?>
					<a class="on"><?=$i?></a> 
				<?php } else { ?>
					<a href="/posts?page=<?=$i?>&search_post=<?=$search_post?>" class="pagingBtn-a"><?=$i?></a>
				<?php } ?>			
				
			<?php }?>

			<?php if($paging['e_page'] < $paging['total_page']) { ?>			
					<a href="/posts?page=<?=$paging['e_page']+1?>&search_post=<?=$search_post?>">&gt;</a>
					<a href="/posts?page=<?=$paging['total_page']?>&search_post=<?=$search_post?>">&gt;&gt;</a>
			<?php } ?>			
	</div>
	<div class="writeBtn">		
		<?php if(@$mb['idx']) { ?>
				<a href="./writePosts" class="btn btn-primary">글쓰기</a>
		<?php } ?>
	</div>	