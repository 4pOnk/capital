let options = document.querySelectorAll('option');
let shares_control_win = document.getElementById('shares_control_win');
let shares_control_form = document.getElementById('shares_control_form');
let shares_count_alert = document.getElementById('shares_count_alert');
let send_shares = document.getElementById('send_shares');
let shares_op = document.getElementById('shares_op');

let share = document.getElementsByName('share')[0];
let action_inp = document.getElementsByName('action')[0];
let getter_login_div = document.getElementById('getter_login');
let price = document.getElementById('price');
let count = document.getElementsByName('count')[0];
let getter_login_inp = document.getElementById('getter_login_inp');
let geter_login_alert = document.getElementById('geter_login_alert');
let share_submit_alert = document.getElementById('share_submit_alert');

let sharesName = document.getElementsByClassName('shareName');
let sharesCount = document.getElementsByClassName('sharesCount');

let share_win = new ModalWin(shares_control_win,shares_op);

shares_control_win.addEventListener('click',()=>{
	if(action_inp.value == 'Продать'){
		getter_login_div.style.display = 'none';
		price.style.display = 'inline';
	}else{
		getter_login_div.style.display = 'inline';
		price.style.display = 'none';	
	}
})


send_shares.addEventListener('click', () => {
	let db = new Ajax('POST','../../includes/shares_control.php');

	event.preventDefault();

	db.uploadForm(shares_control_form);

	db.send((e) => {
		console.log(e);
		let res = JSON.parse(e);
		if(!res.status){
			if(res.message !== undefined)
				share_submit_alert.innerHTML = res.message;
		}else{
			share_submit_alert.innerHTML = '';
			for(let i = 0; i < sharesName.length; i++){
				if(sharesName[i].innerHTML == share.value){
					sharesCount[i].innerHTML = +sharesCount[i].innerHTML - +Math.abs(count.value);
				}
			}
		}
	});
})

document.addEventListener('keyup', ()=>{
	let db = new Ajax('POST','../../includes/check_count_of_shares.php');

	let fd = new FormData();
	fd.append('share',share.value);

	db.writeData(fd);

	db.send((e) => {
		let res = Math.abs(+e);

		if(res < Math.abs(count.value)){
			shares_count_alert.innerHTML = 'У вас недостаточно акций';
		}else{
			shares_count_alert.innerHTML = '';
		}
	});
})
document.addEventListener('keyup', ()=>{
	if(getter_login_inp.value !== ''){
		let db = new Ajax('POST','../../includes/check_user_gift.php');

		let fd = new FormData();
		fd.append('login',getter_login_inp.value);

		db.writeData(fd);

		db.send((e) => {
			let res = JSON.parse(e);
			if(!res.status){
				geter_login_alert.innerHTML = res.message;
			}else{
				geter_login_alert.innerHTML = '';
			}
		});
	}
})