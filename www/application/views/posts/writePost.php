<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>

<h2>후기 작성</h2>
<div class="postsList">
	<form name="write_form" action="./post_proc" method="POST" onsubmit="return writeForm();" enctype="multipart/form-data">
		<input type="hidden" name="state" value="postWrite">
		<input type="hidden" name="posts_cate" value="1">
		<div class="form-header">
			<div class="form-writer">작성자 <input type="text" name="writer" value="<?= $mb['nickname'] ?>" readonly size="10"></div>
			<div class="form-title">제목 <input type="text" name="title" size="50"></div>
		</div>
		<div class="form-content">
			내용
		</div>
		<textarea name="content" id="ckeditor"></textarea>
		<div class="form-file"><input type="file" name="files"></div>
		<button class="btn btn-primary">작성하기</button>
	</form>
</div>
<script type="text/javascript">
	ClassicEditor.create( document.querySelector( '#ckeditor' ) ).catch( error => {
		console.error( error );
	});
</script>
