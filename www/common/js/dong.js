function loginCheck () {
	var f = document.login_form;

	if (f.id.value == '') {
		alert('아이디를 입력해 주세요.');
		f.id.focus();
		return false;
	}

	if (f.pw.value == '') {
		alert('비밀번호를 입력해 주세요.');
		f.pw.focus();
		return false;
	}

	return true;
}

function joinCheck () {
	var f = document.joinForm;
	if (f.id.value == "") {
		alert("아이디를 입력하세요.");
		f.id.focus();
		return false;
	}

	if (f.nickname.value == "") {
		alert("닉네임을 입력하세요.");
		f.nickname.focus();
		return false;
	}

	if (f.pw.value == "") {
		alert("비밀번호를 입력하세요.");
		f.pw.focus();
		return false;
	}

	if (f.re_pw.value == "") {
		alert("비밀번호를 입력하세요.");
		f.re_pw.focus();
		return false;
	}

	// var check = false;
	// var swal = swal({
	// 	title: "정말 가입하시겠습니까?",
	// 	icon: "info",
	// 	buttons: ["NO", "YES"]
	// }).then((YES) => {
	// 	check = (YES) ? true : false;
	// 	// if(YES) {

	// 	// 	check = true;
	// 	// } else {
	// 	// 	check = false;
	// 	// }
	// });

	// return check; 

	// if(check) {
	// 	return true;
	// } else {
	// 	return false;
	// }
	//console.log(check);
	if (confirm("정말 가입하시겠습니까?") === true) {
		return true;
	} else {
		return false;
	}
}

function idCheck() {
	var id = document.querySelector('#id').value;
	var xhr = new XMLHttpRequest(),
		form = new FormData();

	form.append('state', 'idcheck');
	form.append('id', id);

	xhr.open("POST", "./join_proc", true);
	xhr.send(form);

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			if (xhr.status == 200 || xhr.status == 201) {
				var data = JSON.parse(xhr.responseText);
				document.getElementById('idCheck').innerHTML = data.message;
			} else {
				var txt = "";
				document.getElementById('idCheck').innerHTML = txt;
			}
		}
	}	   
}


function nickCheck() {
	var nickname = document.querySelector('#nickname').value;
	var xhr = new XMLHttpRequest(),
		form = new FormData();

	form.append('state', 'nicknamecheck');
	form.append('nickname', nickname);

	xhr.open("POST", "./join_proc", true);
	xhr.send(form);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			if (xhr.status == 200 || xhr.status == 201) {
				var data = JSON.parse(xhr.responseText);
				document.getElementById('nickCheck').innerHTML = data.message;
			} else {
				var txt = "";
				document.getElementById('nickCheck').innerHTML = txt;
			}
		}
	}	   
}

function pwCheck(re_pw) {
	var pw = document.querySelector('#pw').value; //비교할 비밀번호

	var xhr = new XMLHttpRequest(),
		form = new FormData();
		form.append('state', 'pwCheck');
		form.append('pw', pw);
		form.append('re_pw', re_pw);
	xhr.open("POST", "./join_proc", true);
	xhr.send(form);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if (xhr.status == 200 || xhr.status == 201) {
				var data = JSON.parse(xhr.responseText); // json으로 보내기
				document.getElementById('pwCheck').innerHTML = data.message;
			} else {
				var txt = "";
				document.getElementById('pwCheck').innerHTML = data.txt;
			} 
		}
	}
	
}



//비밀번호 팝업창
if (document.querySelector('.confirmPw')) {
	document.querySelector('.confirmPw').addEventListener('click', function () {
		var html = '';

		html += '\
				<div class="modal">\
					<div class="modalCover"></div>\
					<div class="modalBody">\
						<div class="modalTitle">비밀번호 수정</div>\
						<div>기존 비밀번호</div>\
						<input type="password" id="origin-pw">\
						<div>변경 비밀번호</div>\
						<input type="password" id="pw">\
						<div>비밀번호 확인</div>\
						<input type="password" id="re-pw" onkeyup="pwCheck(this.value);">\
						<div id="pwCheck"></div>\
						<button class="pw-change-btn">비밀번호 변경</button>\
					</div>\
				</div>\
			';

		document.querySelector('body').insertAdjacentHTML('beforeend', html);

		document.querySelector('.modalCover').addEventListener('click', function () {
			var parent = this.parentNode;

			parent.parentNode.removeChild(parent);
		});

		document.querySelector('.pw-change-btn').addEventListener('click', function () {
			var originPw = document.querySelector('#origin-pw').value,
				pw = document.querySelector('#pw').value,
				rePw = document.querySelector('#re-pw').value;
			//js -> php 스네이크
			// php -> js 카멜
			var xhr = new XMLHttpRequest(),
				form = new FormData();

			form.append('state', 'pwchange');
			form.append('origin_pw', originPw);
			form.append('pw', pw);
			form.append('re_pw', rePw);

			xhr.open('POST', './mypage_proc');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);
						if (data.result == 'fail') {
							alert(data.message);
							return false;
						} else if (data.result == 'success') {
							alert(data.message);
							document.querySelector('.modalCover').click();
							return false;
						}
					}
				}
			}	
		});
	});
}


//닉네임 팝업창
if (document.querySelector('.confirmMy')) {
	document.querySelector('.confirmMy').addEventListener('click', function () {		
		var html = '';

		html += '\
				<div class="modal">\
					<div class="modalCover"></div>\
					<div class="modalBody">\
						<div class="modalTitle">닉네임 수정</div>\
						<input type="text" id="nickname" onkeyup="nickCheck(this.value);">\
						<div id="nickCheck"></div>\
						<button class="nick-change-btn">닉네임 변경</button>\
					</div>\
				</div>\
			';

		document.querySelector('body').insertAdjacentHTML('beforeend', html);

		document.querySelector('.modalCover').addEventListener('click', function () {
			var parent = this.parentNode;

			parent.parentNode.removeChild(parent);
		});

		document.querySelector('.nick-change-btn').addEventListener('click', function () {
			var reNick = document.querySelector('#nickname').value;
			//js -> php 스네이크
			// php -> js 카멜
			var xhr = new XMLHttpRequest(),
				form = new FormData();

			form.append('state', 'nickchange');
			form.append('re_nick', reNick);

			xhr.open('POST', './mypage_proc');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);
						if (data.result == 'fail') {
							alert(data.message);
							return false;
						} else if (data.result == 'success') {
							alert(data.message);
							document.querySelector('.modalCover').click();	
							location.href='./logout';						
							return false;
						}
					}
				}
			}	
		});
	});
}



//내 글보기 팝업창
if (document.querySelector('.confirmPost')) {
	document.querySelector('.confirmPost').addEventListener('click', function () {
		var xhr = new XMLHttpRequest(),
			form = new FormData();

			form.append('state', 'getMyPost');

			xhr.open('POST', './myPosts');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);	
						console.log(data);									
						var html = '';								
							html += '\
									<div class="modal">\
										<div class="modalCover"></div>\
										<div class="modalBody">\
											<div class="modalTitle">내 글 보기</div>\
												<table style="overflow:auto;" >\
													<tr>\
														<td>글 번호</td>\
														<td>제목</td>\
														<td>작성자</td>\
														<td>작성일</td>\
														<td>조회수</td>\
														\
													</tr>';
										for(var i in data.list) {
											html+= '\
													<tr><td>' + data.list[i].idx + '</td>\
														<td>' + data.list[i].title + '</td>\
														<td>' + data.list[i].writer + '</td>\
														<td>' + data.list[i].reg_date + '</td>\
														<td>' + data.list[i].view_cnt + '</td></tr>';
										}				
											html+= '\
													<tr>\
														<td colspan="5">\
															<ul>';
														for(var i=1; i<=data.paging['total_page']; i++) {
															console.log(i);
											html+= '\
														<li><a href="/posts/' + i + '">' + i + '</a></li>';											
														}
											html+='\
															</ul>\
														</td>\
													</tr>\
												</table>\
											</div>\
										</div>\
									</div>\
									';	
							
						
						document.querySelector('body').insertAdjacentHTML('beforeend', html);

						document.querySelector('.modalCover').addEventListener('click', function () {
							var parent = this.parentNode;

							parent.parentNode.removeChild(parent);
							});
						if (data.result == 'l_fail') {
							alert(data.message);
							document.querySelector('.modalCover').click();	
							return false;
						}
				}	
			}
		}	
	});
}



//내 댓글보기 팝업창
if (document.querySelector('.confirmComment')) {
	document.querySelector('.confirmComment').addEventListener('click', function () {
		var xhr = new XMLHttpRequest(),
			form = new FormData();

			form.append('state', 'getMyComment');

			xhr.open('POST', './myPosts');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);
						console.log("댓글", data);												
						var html = '';
						html += '\
							<div class="modal">\
								<div class="modalCover"></div>\
								<div class="modalBody">\
									<table>\
										<tr>\
											<td>글 번호</td>\
											<td>작성자</td>\
											<td>댓글</td>\
											<td>작성일</td>\
										</tr>';
						for(var i in data) {
							html += '\
									<tr>\
										<td>' + data[i].idx + '</td>\
										<td>' + data[i].writer + '</td>\
										<td>' + data[i].comment + '</td>\
										<td>' + data[i].reg_date + '</td>\
									</tr>\
									';
						}
						html += '\
								</table>\
							</div>\
						</div>';
						document.querySelector('body').insertAdjacentHTML('beforeend', html);

						document.querySelector('.modalCover').addEventListener('click', function () {
							var parent = this.parentNode;

							parent.parentNode.removeChild(parent);
							});
						if (data.result == 'l_fail') {
							alert(data.message);
							document.querySelector('.modalCover').click();	
							return false;
						}
				}	
			}
		}	
	});
}

//비밀번호 찾기 
if (document.querySelector('.searchPw')) {
	document.querySelector('.searchPw').addEventListener('click', function () {		
		var html = '';

		html += '\
				<div class="modal">\
					<div class="modalCover"></div>\
					<div class="modalBody">\
						<div class="modalTitle">비밀번호 찾기</div>\
						<div>비밀번호를 변경하려는 아이디를 입력하세요.</div>\
						<input type="text" id="id" onkeyup="idCheck(this.value);">\
						<div id="idCheck"></div>\
						<button class="pw-change-btn">비밀번호 찾기</button>\
					</div>\
				</div>\
			';

		document.querySelector('body').insertAdjacentHTML('beforeend', html);

		document.querySelector('.modalCover').addEventListener('click', function () {
			var parent = this.parentNode;

			parent.parentNode.removeChild(parent);
		});

		document.querySelector('.pw-change-btn').addEventListener('click', function () {
			var id = document.querySelector('#id').value;
			var xhr = new XMLHttpRequest(),
				form = new FormData();

			form.append('state', 'searchPw');
			form.append('id', id);

			xhr.open('POST', './mypage_proc');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);
						if (data.result == 'fail') {
							alert(data.message);
							return false;
						} else if (data.result == 'success') {
							alert(data.message);
							document.querySelector('.modalCover').click();	
							location.href='./login';						
							return false;
						}
					}
				}
			}	
		});
	});
}



//탈퇴하기
if (document.querySelector('.secession')) {
	document.querySelector('.secession').addEventListener('click', function () {		
		var html = '';

		html += '\
				<div class="modal">\
					<div class="modalCover"></div>\
					<div class="modalBody">\
						<div class="modalTitle">회원 탈퇴하기</div>\
						<div>탈퇴하시려면 비밀번호를 입력하세요.</div>\
						<input type="password" id="password">\
						<button class="secession-btn">탈퇴하기</button>\
					</div>\
				</div>\
			';

		document.querySelector('body').insertAdjacentHTML('beforeend', html);

		document.querySelector('.modalCover').addEventListener('click', function () {
			var parent = this.parentNode;

			parent.parentNode.removeChild(parent);
		});

		document.querySelector('.secession-btn').addEventListener('click', function () {
			var pw = document.querySelector('#password').value;
			var xhr = new XMLHttpRequest(),
				form = new FormData();

			form.append('state', 'secession');
			form.append('pw', pw);

			xhr.open('POST', './mypage_proc');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);
						if (data.result == 'fail') {
							alert(data.message);
							return false;
						} else if (data.result == 'success') {
							alert(data.message);
							document.querySelector('.modalCover').click();	
							location.href='./login';						
							return false;
						}
					}
				}
			}	
		});
	});
}

function commentDelete() {
	if(confirm("해당 글을 삭제하시겠습니까?")) {
			return true;
	} else {
		return false;
	}
}


if (document.querySelector('.chkbox')) {
	document.querySelector('.chkbox').addEventListener('click', function () {
	if(document.querySelector('.chkbox').checked == true) {			
		
		document.querySelectorAll('.selectMember').forEach(function(value) {
			value.checked = true;
		});		
		document.querySelectorAll('.commentList').forEach(function(value) {
			value.checked = true;
		});	
		document.querySelectorAll('.memberPost').forEach(function(value) {
			value.checked = true;
		});	
		document.querySelectorAll('.memberCom').forEach(function(value) {
			value.checked = true;
		});		
		} else {
			document.querySelectorAll('.selectMember').forEach(function(value) {
			value.checked = false;
			});
			document.querySelectorAll('.commentList').forEach(function(value) {
			value.checked = false;
			});
			document.querySelectorAll('.memberPost').forEach(function(value) {
			value.checked = false;
			});
			document.querySelectorAll('.memberCom').forEach(function(value) {
			value.checked = false;
		});	
		}			
	});
}

//체크박스 값이 비었는지 확인
function checkForm() {
	var checkMem = document.querySelectorAll('.selectMember');
	var checkMem_length = checkMem.length;
	var checked = 0;
	document.querySelectorAll('.selectMember').forEach(function(value) {
		if(value.checked == true) {
			checked++;
		} 			
	});		
	if(checked < 1) {
		alert("탈퇴시킬 회원을 선택해주세요.");
		return false;
	}	
	if(checked > 0) {
		if(confirm("선택한 회원을 탈퇴하시겠습니까?")) {
			return true;
		} else {
			return false;
		}
	}
}


function commentDelete() {
	var checkCom = document.querySelectorAll('.commentList');
	var checkCom_length = checkCom.length;
	var checked = 0;
	document.querySelectorAll('.commentList').forEach(function(value) {
		if(value.checked == true) {
			checked++;
		} 			
	});		
	if(checked < 1) {
		alert("삭제할 글을 선택해주세요.");
		return false;
	}	
	if(checked > 0) {
		if(confirm("선택한 글을 삭제시겠습니까?")) {
			return true;
		} else {
			return false;
		}
	}
}


//관리자 글삭제
function checkPostForm() {
	var checkPost = document.querySelectorAll('.memberPost');
	var checkPost_length = checkPost.length;
	var checked = 0;
	document.querySelectorAll('.memberPost').forEach(function(value) {
		if(value.checked == true) {
			checked++;
		} 			
	});		
	if(checked < 1) {
		alert("삭제할 글을 선택해주세요.");
		return false;
	}	
	if(checked > 0) {
		if(confirm("선택한 글을 삭제시겠습니까?")) {
			return true;
		} else {
			return false;
		}
	}
}

//관리자 글삭제
function checkComForm() {
	var checkPost = document.querySelectorAll('.memberCom');
	var checkPost_length = checkPost.length;
	var checked = 0;
	document.querySelectorAll('.memberCom').forEach(function(value) {
		if(value.checked == true) {
			checked++;
		} 			
	});		
	if(checked < 1) {
		alert("삭제할 댓글을 선택해주세요.");
		return false;
	}	
	if(checked > 0) {
		if(confirm("선택한 댓글을 삭제시겠습니까?")) {
			return true;
		} else {
			return false;
		}
	}
}

// 게시글 수정
function editForm() {
	
}


// 좋아요 기능
if (document.querySelector('#likePost')) {
	document.querySelector('#likePost').addEventListener('click', function () {		
		
		var posts_idx = document.querySelector('.posts_idx').value; //좋아요할 게시판
		//console.log(posts_idx);		
		
			var xhr = new XMLHttpRequest(),
				form = new FormData();

			form.append('state', 'likePost');
			form.append('posts_idx', posts_idx);

			xhr.open('POST', '../post_proc');
			xhr.send(form);

			xhr.onreadystatechange  = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200 || xhr.status == 201) {
						var data = JSON.parse(xhr.responseText);
						
						//console.log("몇개? ", data);
						document.querySelector('.cnt_like').innerHTML = data;

					}
				}
			}	
		
	});
}

//검색기능
function searchPost () {
	var sp = document.querySelector('.search_post').value;
	if(!sp) {
		alert("검색할 내용을 입력하세요.");
		return false;
	}
	return true;
}

if (document.querySelector('.search_img')) {
	document.querySelector('.search_img').addEventListener('click', function () {	
		searchPost();
	});
}	


if(document.querySelector('.postsList')) {
	document.querySelector('.postsList').addEventListener('click', function (){
		location.href='/posts';
	});
}

if(document.querySelector('.delPost')) {
	document.querySelector('.delPost').addEventListener('click', function (){
		var idx = document.querySelector('.posts_idx').value;
		confirm('글을 삭제하시겠습니까?') ? location.href='../posts_del/'+idx : false;
	});
}


// function writeForm() {
// 	var f = document.write_form;
// 	if (f.title.value == '') {
// 		alert('제목을 입력하세요.');
// 		f.title.focus();
// 		return false;
// 	}

// 	if (f.content.value == '') {
// 		alert('내용을 입력하세요.');
// 		f.content.focus();
// 		return false;
// 	}	
// 	return true;
// }