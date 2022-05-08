import 'jquery';

class Search
{
	constructor() {
		this.searchDivResult = $( '#search-overlay__results' );
		this.searchBtn = $('.js-search-trigger');
		this.searchOverlay = $('.search-overlay');
		this.searchBtnClose = $('.search-overlay__close');
		this.typeInput = $('.search-term');
		this.scannerVal;
		this.isSpinnerVisible = false;
		this.typingLogic;
		this.events();
	}

	events() {
		this.searchBtn.on('click', this.openOverlay.bind(this));
		this.searchBtnClose.on('click', this.closeOverlay.bind(this));
		$(document).on('keyup', this.determiningKeyPress.bind(this));
		this.typeInput.on('keyup', this.getResult.bind(this));
	}

	determiningKeyPress(e){
		if(e.keyCode==83){
			this.openOverlay();
		}
		if(e.keyCode==27){
			this.closeOverlay();
		}
	}

	getResult(){
		if ($.trim(this.typeInput.val())=='') {
			this.searchDivResult.html('');
		} else{
			if(this.scannerVal != this.typeInput.val()){
				if(!this.isSpinnerVisible){
					clearTimeout(this.typingLogic);
					this.searchDivResult.html('<div class="spinner-loader"></div>')
					this.typingLogic = setTimeout( this.test.bind(this), 2000 );
					this.isSpinnerVisible = true;
				}
			}
			this.scannerVal = this.typeInput.val();
		}
	}

	test(){
		this.searchDivResult.html( 'hello' );
		this.isSpinnerVisible = false;
	}

	openOverlay() {
		this.searchOverlay.addClass('search-overlay--active');
	}

	closeOverlay(){
		this.searchOverlay.removeClass('search-overlay--active');
	}
}

export default Search;