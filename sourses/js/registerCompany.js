let form_comp = document.getElementById('reg_company');

let comp_name = document.getElementById('comp_name');
let comp_about = document.getElementById('comp_about');

let company_alert = document.getElementById('company_alert');
let submit_company = document.getElementById('submit_company');
let company_submit_alert = document.getElementById('company_submit_alert');
let balance = document.getElementById('balance');
let my_companies = document.getElementById('my_companies');
let my_shares = document.getElementById('my_shares');

let company_create_display = document.getElementById('company_create_display');
let registerCompany = document.getElementById('registerCompany');

let toggleCompanyWin = (e) => {
	e.style.display == 'block'?e.style.display = 'none':e.style.display = 'block';
}

let companyModal = new ModalWin(registerCompany,company_create_display);

document.addEventListener('keyup',()=>{
	let db = new Ajax("POST", "includes/check_uniqueness.php");

	let data = new FormData();
	data.append('name', comp_name.value);
	data.append('field','name');
	data.append('table','companies');
	data.append('key', 'name');

	db.writeData(data);


	db.send((e)=>{
		if(+e >= 1){
			company_alert.innerHTML = 'Компания с таким названием уже зарегистрирована';
		}else{
			company_alert.innerHTML = '';
		}
	})
})

submit_company.addEventListener('click',()=>{
	let db = new Ajax("POST", "includes/create_company.php");
	db.uploadForm(form_comp);

	db.send((e)=>{
		//console.log(e);
		let res = JSON.parse(e);

		if(!res.status){
			company_submit_alert.innerHTML = res.message;
		}else{
			my_companies.innerHTML += "<p><a href='company.php'>" + comp_name.value + "</a></p>";
			my_shares.innerHTML += "<p><b>" + comp_name.value + "</b> - " + res.shares + "шт</p>"
			company_submit_alert.innerHTML = '';
			balance.innerHTML = res.balance;
			comp_name.value = '';
			comp_about.innerHTML = '';
			comp_about.value = '';
			companyModal.closeWin();
		}
	})
})