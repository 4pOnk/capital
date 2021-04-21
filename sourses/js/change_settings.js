	let form = document.getElementById("settings_change");
	let avatar_preview = document.getElementById("avatar_preview");
	let alert_user_update = document.getElementById('alert_user_update');
	let avatar = document.getElementById('avatar');
	let used_alert = document.getElementById('used_alert');
	let login = document.getElementById('login');
	let username = document.getElementById('username');

	let settingsBtn = document.getElementById('settings');

	let changeWin = new ModalWin(form,settingsBtn);

	avatar.onchange = () => {
		let db = new Ajax("POST", "includes/update_user.php?preview=1");
		db.uploadForm(form);
		db.send((e)=>{
			avatar_preview.src = e;
		})
	}

	form.onsubmit = (e)=>{
		e.preventDefault();
		let db = new Ajax("POST", "includes/update_user.php");
		db.uploadForm(form);
		db.send((e)=>{
			let res = JSON.parse(e);
			//console.log(e);
			if(res.status){
				changeWin.closeWin();
				user_logo.src = res.image;
				username.innerHTML = res.login;
			}else{
				if(res.message !== undefined){
					alert_user_update.innerHTML = res.message;
				}
			}
		})
	}

	document.addEventListener('keyup',()=>{
		let db = new Ajax("POST", "includes/check_update_name.php");
		let fd = new FormData();
		fd.append('name',login.value);
		db.writeData(fd);
		db.send((e)=>{
			if(+e >= 1){
				used_alert.innerHTML = 'Такой юзер уже есть';
			}else{
				used_alert.innerHTML = '';
			}
		})
	})