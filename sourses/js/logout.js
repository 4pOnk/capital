
let logout = document.getElementById('logout');
if(logout){
	logout.addEventListener('click',()=>{

		let query = new Ajax('GET','includes/logout.php');

		query.send((res)=>{
			if(res == ''){
				let win = document.getElementsByClassName('form')[0];
				win.style.display = 'none';
				win.style.display = 'block';
				document.getElementById('logout').style.display = 'none';
			}
		});
	})
}
