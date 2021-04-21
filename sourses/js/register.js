let form = document.getElementsByClassName('form')[0];
let login = document.getElementById('login');
let used_alert = document.getElementById('used_alert');


document.getElementById('submit').addEventListener('click',()=>{

	let alert = document.getElementById('alert');

	let query = new Ajax('POST','includes/register.php');

	query.uploadForm(form);

	query.send((res)=>{
		if(res == ''){
			window.location.href = '/';
		}else{
			alert.innerHTML = res;
		}
	});
})

document.addEventListener('keyup',()=>{
	let db = new Ajax("POST", "includes/check_uniqueness.php");

	let data = new FormData();
	data.append('login', login.value);
	data.append('field','login');
	data.append('table','users');
	data.append('key', 'login');

	db.writeData(data);


	db.send((e)=>{
		console.log(e);
		if(+e >= 1){
			used_alert.innerHTML = 'Такой юзер уже есть';
		}else{
			used_alert.innerHTML = '';
		}
	})
})