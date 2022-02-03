// // Import vendor jQuery plugin example
// import '~/app/libs/mmenu/dist/mmenu.js'

document.addEventListener('DOMContentLoaded', () => {

	let rellax = new Rellax('.rellax');
	let paralax = new Rellax('.paralax', {
    wrapper: '.advice'
  });

	function someHight(itemClass){
		let item = document.querySelectorAll(itemClass);
		let hightItem = 0;
		for (let i = 0; i < item.length; i++) {
			if (hightItem < item[i].offsetHeight) hightItem = item[i].offsetHeight;
		}
		for (let i = 0; i < item.length; i++) {
			item[i].style.height = hightItem + 'px';
		}
	}
	someHight('.product_summary');

	if(document.getElementById('closeOnMap')){
		document.getElementById('closeOnMap').addEventListener('click', function(event){
			event.preventDefault();
			document.querySelector('.map_info_wrap').style.display = 'none';
		});
	}


	//  for phone input: country - flags, mask, validation
  let input = document.querySelector("#phone");
	let errorMsg = document.querySelector("#error-msg");
  let validMsg = document.querySelector("#valid-msg");
	let errorMap = ["Не правльный номер", "Неверный код страны", "Слишком короткий", "Слишком длиный", "Не правльный номер"];
  //let errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
	let iti = window.intlTelInput(input, {
		onlyCountries: ["ru"],
		//preferredCountries: [ "ru", "by", "ua" ],
		utilsScript: "../js/intlTelInput/utils.js?<%= time %>"
    // any initialisation options go here
  });

	let reset = function() {
  	input.classList.remove("error");
  	errorMsg.innerHTML = "";
  	errorMsg.classList.add("hide");
  	validMsg.classList.add("hide");
	};

	// on blur: validate
	input.addEventListener('blur', function() {
  	reset();
  	if (input.value.trim()) {
    	if (iti.isValidNumber()) {
      	validMsg.classList.remove("hide");
    	} else {
      	input.classList.add("error");
      	let errorCode = iti.getValidationError();
      	errorMsg.innerHTML = errorMap[errorCode];
      	errorMsg.classList.remove("hide");
    	}
  	}
	});

	// on keyup / change flag: reset
	input.addEventListener('change', reset);
	input.addEventListener('keyup', reset);








	let cleave = new Cleave('#phone', {
    phone: true,
    phoneRegionCode: 'RU'
	});









})
