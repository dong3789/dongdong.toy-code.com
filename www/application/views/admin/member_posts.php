<form name="memberPostsForm" action="./admin_proc" method="post" onsubmit="return checkPostForm();">
	<table> 
		<tr>
			<td><input type="checkbox" name="chkbox[]" class="chkbox"></td>
			<input type="hidden" name="state" value="memberPost">
			<td>글번호</td>
			<td>제목</td>
			<td>작성자</td>
			<td>작성일</td>
			<td>삭제여부</td>
		</tr>
		
		<?php foreach ($list AS $k=>$v) { ?>
			<tr>
				<td><input type="checkbox" class="memberPost" name="memberPost[]" value="<?=$v['idx']?>"></td>
				<td><?=$v['idx']?></td>
				<td><a href="./postDetail/<?= $v['idx']?>"><?=$v['title']?></a></td>
				<td><?=$v['writer']?></td>
				<td><?=$v['reg_date']?></td>						
				<td><?=$v['del']?></td>						
			</tr>

		<?php }?>
			<tr>
				<td colspan="7">	
					<ul>
						<?php for($i=1; $i<=$paging['total_page']; $i++) {?>
							<li><a href="./controlBoard/<?=$i?>"><?=$i?></li>
						<?php }?>	
					</ul>	
				</td>	 
			</tr>		
		<button>글 삭제</button>
		<button type="button" class="homeBtn">홈으로</button>
	</table>
</form>	
