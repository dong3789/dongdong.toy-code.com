<h2>"<?=$row['title']?>"</h2>
<!-- 게시글 상세보기 --> 			
<form method="post" name="controlPost" action="../post_edit/<?=$row['idx']?>">
	<div class="detail-content">
				<?=$row['content']?>				
	</div>
	<img src="<?=$row['image_ary']['file_path']?>">
	<table class="post-detail-table">
		<div class="post-detail-form">
			<tr class="space">
				<th>작성자</th>
				<th>작성일</th>
				<th>조회수</th>				
			</tr>
			<tr class="space">	
				<input type="hidden" class="posts_idx" value="<?=$row['idx']?>">
				<td><?=$row['writer']?></td>
				<td><?=$row['reg_date']?></td>
				<td><?=$view_cnt?></td>
			</tr>			
		</div>
		<tr class="space">
				<td colspan="3">
					<button type="button" id="likePost"class="btn btn-primary likePost"><span class="cnt_like"><?=$cnt_like?></span>좋아요</button>
				</td>
		</tr>			
		<tr class="space">
			<td colspan="3">
				<div class="control-detail">
					<?php if($nickname == $row['writer'] || $nickname == '관리자'){ ?>
						<button class="btn btn-primary editPost" onclick>수정</button>
						<button type="button" class="btn btn-primary delPost">삭제</button>
					<?php }?>
				</div>
			</td>
		</tr>
	</table>		
		


		<!-- <tr>
			<td>제목</td>		
			<td>작성일</td>
			<td>내용</td>
			<td>이미지</td>
			<td>작성자</td>
			<td>조회수</td>
		</tr>
		<tr>			
			<input type="hidden" class="posts_idx" value="<?=$row['idx']?>">
			<td class="title"><?=$row['title']?></td>
			<td class="reg-date"><?=$row['reg_date']?></td>
			<td class="content"><?=$row['content']?></td>
			<td class="content"><img src="<?=$row['image_ary']['file_path']?>"></td>
			<td class="writer"><?=$row['writer']?></td>
			<td class="view_cnt"><?= $view_cnt ?></td>
		</tr>		
		<tr>
			<td colspan="6">
				<ul>
					<li><button type="button" class="likePost"><span class="cnt_like"><?=$cnt_like?></span>좋아요</button></li>
					<li><button class="editPost" onclick>수정</button></li>
					<li><button type="button" class="delPost">삭제</button></li>
				</ul>
			</td>
		</tr>
 -->
</form>
<div class="line-div"></div>
<div class="comment-area">
	<form method="post" name="deleteCommentForm" action="../post_proc" onsubmit="return commentDelete();">
		<!-- 댓글보기 -->
		<table class="comment-table">
			<tr>
				<?php if($mb['nickname'] == '관리자') { ?>
					<input type="hidden" name="state" class="commentDel" value="commentDel">
					<td><input type="checkbox" name="chkbox[]" class="chkbox"></td>
					<td><button>삭제</button></td>	
				<?php } ?>
					
			</tr>
			<?php foreach ($comment AS $key=>$val) {?>
				<tr>
					<?php if($mb['nickname'] == '관리자') { ?>
						<input type="hidden" value="<?=$val['idx']?>">
						<td><input type="checkbox" class="commentList" name="commentList[]" value="<?=$val['idx']?>"></td>
					<?php } ?>
					<th><?=$val['writer']?>&nbsp;&nbsp; </th>
					<td class="comment-pre"><?=$val['comment']?></td>				
					<td><?=$val['reg_date']?></td>		
					<?php if($nickname == $val['writer'] || $nickname == 'admin') { ?>
				</tr>	
					<?php } ?>
			<?php } ?>
		</table>
	</form>	
</div>

<div class="posts-comment">
	<div class="posts-comment-container">
		<form name="commentForm" method="post" action="../posts_comment" onsubmit="return postsCommentCheck();">	
			<input type="hidden" name="idx" value="<?=$row['idx']?>">
			<textarea placeholder="댓글을 입력해 주세요." class="comment-textarea" name="comment" rows="5"></textarea>
			<div></div>
			<button class="btn btn-primary">등록</button>			
		</form>
	</div>
</div>
<div class="line-div"></div>

<div class="posts-list-div">
	<a href="../posts" class="btn btn-primary">목록</a>
</div>   


<script>
	function postsCommentCheck () {
		console.log("체크");
		var	f = document.commentForm;
		if(f.comment.length < 5) {
			alert('댓글은 5자이상 입력하여 주세요.');
			f.comment.focus();
			return false;
		}
		return true;
	}	
</script>