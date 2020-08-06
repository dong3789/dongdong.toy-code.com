<form name="allSelectForm" action="./admin_proc" method="post" onsubmit="return checkForm();">
	<table> 
		<tr>
			<td><input type="checkbox" name="chkbox[]" class="chkbox"></td>
			<input type="hidden" name="state" value="allSelectMember">
			<td>회원번호</td>
			<td>아이디</td>
			<td>닉네임</td>
			<td>가입일</td>
			<td>탈퇴여부</td>
		</tr>

		<?php foreach ($list AS $k=>$v) { ?>
			<tr>
				<td><input type="checkbox" class="selectMember" name="selectMember[]" value="<?=$v['idx']?>"></td>
				<td><?=$v['idx']?></td>
				<td><?=$v['id']?></td>
				<td><?=$v['nickname']?></td>
				<td><?=$v['reg_date']?></td>						
				<td><?=$v['del_member']?></td>						
			</tr>

		<?php }?>
			<tr>
				<td colspan="6">	
					<ul>
						<?php for($i=1; $i<=$paging['total_page']; $i++) {?>
							<li><a href="/secessionList/<?=$i?>"><?=$i?></li>
						<?php }?>	
					</ul>	
				</td>	 
			</tr>

		<button>회원 탈퇴</button>
		<button type="button" class="homeBtn">홈으로</button>
	</table>
</form>

