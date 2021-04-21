	
document.getElementById('submit').addEventListener('click',()=>{
	let form = document.getElementById('form');

	let alert = document.getElementById('alert');
	let win = document.getElementsByClassName('form')[0];

	let query = new Ajax('POST','includes/login.php');

	query.uploadForm(form);

	query.send((res)=>{
		if(res == ''){
			win.style.display = 'none';
			document.getElementById('logout_win').style.display = 'block';			
		}else{
			alert.innerHTML = res;
		}
	});
})

