
<div><h2>회원가입</h2></div>
<div class="join_form_box">
	<div class="join-form-list">
		<form method="post" name="joinForm" action="./join_proc" onsubmit="return joinCheck();">
			<input type="hidden" name="state" value="joinMember">
			<div class="join_row_title">
				아이디 입력
				<span class="join_red">*</span>
			</div> 
			<div class="join_input_box">
				<input type="text" id="id" name="id" onkeyup="idCheck();"> 
				<!-- onblur onfocusout : ie에서 대응 안될수도?  -->
				<span id="idCheck"></span>
			</div>		
			<div class="join_row_title">
				닉네임
				<span class="join_red">*</span>
			</div>
			<div class="join_input_box">	
				<input type="text" id="nickname" name="nickname" onkeyup="nickCheck();">
				<span id="nickCheck"></span>
			</div>		
			<div class="join_row_title">
				비밀번호
				<span class="join_red">*</span>
			</div>
			<div class="join_input_box">				
				<input class="information success" type="password" id="pw" name="pw">
			</div>	
			<div class="join_row_title">
				비밀번호 확인
				<span class="join_red">*</span>
			</div>
			<div class="join_input_box">				
				<input type="password" name="re_pw" id="re_pw" onkeyup="pwCheck(this.value);">
				<span id="pwCheck"></span>
			</div>			
			<button class="joinBtn">회원가입</button>		
		</form>
	</div>
	<a href="./login">이미 가입된 계정 정보가 있으시다면 로그인하세요.</a>	
</div>