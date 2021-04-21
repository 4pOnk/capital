//AJAX class
class Ajax{

	constructor(method,url) {
    	this.method = method;
    	this.url = url;
  	}

  	uploadForm(form) {
  		let fd = new FormData(form);
  		this.data = fd;
  	}

  	writeData(data) {
  		this.data = data;
  	}

  	send(cb) {
	  	let xhr = new XMLHttpRequest();

		xhr.open(this.method, this.url);

		this.method.toLowerCase() == 'post' ? xhr.send(this.data) : xhr.send();

		xhr.onload = function() {
		  if (xhr.status != 200) {
		    console.log('Ошибка: ' + xhr.status);
		  }else{
		  	cb(xhr.response);
		  }
		};

		xhr.onprogress = function(event) {
		  console.log(`Загружено ${event.loaded} из ${event.total}`);
		};

		xhr.onerror = function() {
		  console.log("Oшибкa, не связаннaя с HTTP (например, нет соединения)")
		};
	}

}