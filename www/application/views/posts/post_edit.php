<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>

<h2>수정하기</h2>
<!-- 게시글 수정하기 --> 			
<form method="post" name="editPost" action="../post_proc">
	<table>		
		<tr>			
			<input type="hidden" class="state" value="editPost">
			<input type="hidden" class="posts_idx" value="<?=$row['idx']?>">			
			작성자<input type="text" name="writer" value="<?= $mb['nickname'] ?>" readonly>
			제목<input type="text" name="title" value="<?=$row['title']?>">
			내용<textarea name="content" id="ckeditor"><?=$row['content']?></textarea>
			파일<input type="file" name="files"><img src="<?=$row['file_path']?>">
		</tr>		
	</table>

</form>
<script type="text/javascript">
	ClassicEditor.create( document.querySelector( '#ckeditor' ) ).catch( error => {
		console.error( error );
	});
</script>
