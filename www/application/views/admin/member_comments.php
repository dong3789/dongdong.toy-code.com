<form name="memberComForm" action="./admin_proc" method="post" onsubmit="return checkComForm();">
	<table class="admin-del-com"> 
		<tr>
			<td><input type="checkbox" name="chkbox[]" class="chkbox"></td>
			<input type="hidden" name="state" value="memberCom">
			<td>댓글번호</td>
			<td>글번호</td>			
			<td>작성자</td>
			<td>내용</td>
			<td>작성일</td>
			<td>삭제여부</td>
		</tr>
		<div>댓글을 누르면 해당 글로 이동합니다.</div>
		<?php foreach ($list AS $k=>$v) { ?>
			<tr>
				<td><input type="checkbox" class="memberCom" name="memberCom[]" value="<?=$v['idx']?>"></td>
				<td><?=$v['idx']?></td>
				<td><?=$v['posts_idx']?></td>				
				<td><?=$v['writer']?></td>
				<td><a href="./postDetail/<?=$v['posts_idx']?>"><?=$v['comment']?></a></td>
				<td><?=$v['reg_date']?></td>						
				<td><?=$v['del_comment']?></td>						
			</tr>

		<?php }?>
		
		<button class="btn ">글 삭제</button>		
	</table>
	<div class="pagingBtn">		

			<?php if($paging['s_page'] > 1){ ?>				
					<a href="/controlComments?page=1">&lt;&lt;</a>
					<a href="/controlComments?page=<?=$paging['s_page']-5?>">&lt;</a>
			<?php } ?>			

			<?php for($i=$paging['s_page']; $i<=$paging['e_page']; $i++) {?>	

				<?php if($i == $paging['n_page']) {?>
					<a class="on"><?=$i?></a> 
				<?php } else { ?>
					<a href="/controlComments?page=<?=$i?>" class="pagingBtn-a"><?=$i?></a>
				<?php } ?>			
				
			<?php }?>

			<?php if($paging['e_page'] < $paging['total_page']) { ?>			
					<a href="/controlComments?page=<?=$paging['e_page']+1?>">&gt;</a>
					<a href="/controlComments?page=<?=$paging['total_page']?>">&gt;&gt;</a>
			<?php } ?>			
		</div>
</form>	
