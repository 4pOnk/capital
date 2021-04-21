
class ModalWin
{
	constructor(win,open,close){
		this.openBtn = open;
		this.closBtn = close;
		this.todoWin = win;

		this.todoWin.style.transition = '.2s';

		this.openBtn.addEventListener('click',()=>{
			this.openWin();
		})
		if(this.closBtn){
			this.closBtn.addEventListener('click',()=>{
				this.closeWin();
			});
		}
		document.addEventListener('click',(e)=>{
			if(this.todoWin.style.display == 'block'){
				let x = e.clientX;
				let y = e.clientY;
				if((e.path.indexOf(this.todoWin) == -1) &&
					e.target != this.openBtn){
					this.closeWin();
				}
			}
		})
	}

	openWin = () => {
		this.todoWin.style.display = 'block';
		this.todoWin.style.opacity = '1';
	}

	closeWin = () => {
		this.todoWin.style.transition = '.2s';
		this.todoWin.style.opacity = '0';
		setTimeout(()=>{
			this.todoWin.style.display = 'none';
		},200)
	}
}