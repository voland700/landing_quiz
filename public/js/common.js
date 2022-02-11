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

/*
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

*/


    document.querySelectorAll('.elem').forEach((item) => {
        item.addEventListener('click', getItem);
    });

    async function getProduct(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST',

            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json'
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *client
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return await response.text(); // parses JSON response into native JavaScript objects
    }

    function getItem(e){
        e.preventDefault();
        let detail = document.getElementById('detail');

        getProduct('/product_detail', {
            _token: document.querySelector('meta[name=csrf-token]').content,
            id: e.target.dataset.id
        }) .then((data) => {
            detail.insertAdjacentHTML('beforeend', data);
            detail.classList.toggle("show");
        });

        document.querySelector('.detail_closet_back').addEventListener('click', function (e){
            e.preventDefault();
            document.querySelector('.detail_container').remove();
            detail.classList.toggle("show");
        });
        document.querySelector('.detail_closet_btn').addEventListener('click', function (e){
            e.preventDefault();
            document.querySelector('.detail_container').remove();
            detail.classList.toggle("show");
        });
    }

    //QUIZ - модальное окно, обмен данными
    const modal = document.getElementById('modal');
    const stepBody = document.getElementById('stepBody');

    document.querySelector('.quest_btn_close').addEventListener('click', function (e) {
        e.preventDefault();
        modal.classList.toggle("show");
    });

    document.querySelectorAll('.start').forEach((item) => {
        item.addEventListener('click', function (e) {
            getProduct('/start', {
                _method: "POST",
                _token: document.querySelector('meta[name=csrf-token]').content
            }) .then((data) => {
                stepBody.innerHTML = '';
                stepBody.insertAdjacentHTML('beforeend', data);
                modal.classList.toggle("show");
                console.log(data);
                choiceExtra();
                activeBtn();
                nextQuiz();
                prevQuiz();
            });
        })
    })

    function nextQuiz(){
        if(document.getElementById('btnNext')){
            btnNext.onclick = function(e) {
                e.preventDefault();
                if(!btnNext.disabled){
                    getProduct('/next', {
                        _method: "POST",
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        data:  serializeForm(formBody)
                    }) .then((data) => {
                        stepBody.innerHTML = '';
                        stepBody.insertAdjacentHTML('beforeend', data);
                        console.log(data);
                        choiceExtra();
                        activeBtn();
                        nextQuiz();
                        prevQuiz();

                        //lastQuiz();
                    });
                }
            }
        }
    }

    function prevQuiz(){
        if(document.getElementById('btnPrev')){
            btnPrev.onclick = function(e) {
                e.preventDefault();
                    getProduct('/prev', {
                        _method: "POST",
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        data:  serializeForm(formBody)
                    }) .then((data) => {
                        stepBody.innerHTML = '';
                        stepBody.insertAdjacentHTML('beforeend', data);
                        console.log(data);
                        choiceExtra();
                        activeBtn();
                        nextQuiz();
                        prevQuiz();

                        //lastQuiz();
                    });
            }
        }
    }






















    /*
        document.querySelectorAll('.start').forEach((item) => {
            item.addEventListener('click', function (e) {

                getProduct('/quiz', {
                    _token: document.querySelector('meta[name=csrf-token]').content,
                    option: 'start'
                }) .then((data) => {
                    stepBody.innerHTML = '';
                    stepBody.insertAdjacentHTML('beforeend', data);
                    modal.classList.toggle("show");

                    //console.log(data);
                    choiceExtra();
                    activeBtn();
                    nextQuiz();
                    prevQuiz();


                    //lastQuiz();
                });
            })
        })

        function nextQuiz(){
            if(document.getElementById('btnNext')){
                btnNext.addEventListener('click', function (e){
                    e.preventDefault();
                    if(!btnNext.disabled){
                        getProduct('/quiz', {
                            //method: 'POST',
                            _method: "POST",
                            _token: document.querySelector('meta[name=csrf-token]').content,
                            option: 'next',
                            data:  serializeForm(formBody)
                        }) .then((data) => {
                            stepBody.innerHTML = '';
                            stepBody.insertAdjacentHTML('beforeend', data);
                            //console.log(data);
                            choiceExtra();
                            activeBtn();
                            nextQuiz();
                            prevQuiz();

                            //lastQuiz();
                        });
                    }
                });
            }
        }

        function prevQuiz() {
            if (document.getElementById('btnPrev')) {
                btnPrev.onclick = function(e){
                    e.preventDefault();
                    getProduct('/quiz', {
                        _method: "POST",
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        option: 'prev',
                        data: serializeForm(formBody)
                    }).then((data) => {
                        stepBody.innerHTML = '';
                        stepBody.insertAdjacentHTML('beforeend', data);
                        console.log(data);
                        choiceExtra();
                        activeBtn();
                        nextQuiz();
                        prevQuiz();

                        //lastQuiz();
                    });
                }
            }
        }

        /*
        function lastQuiz(){

            if(document.getElementById('lastBtn')){
                alert('!!!!!!!!!!');


               lastBtn.onclick = function(e){

                    e.preventDefault();

                    getProduct('/quiz', {
                        _method: "POST",
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        option: 'last',
                        data: serializeForm(formBody)
                    }).then((data) => {
                        stepBody.innerHTML = '';
                        console.log(data);
                        stepBody.insertAdjacentHTML('beforeend', data);

                    });


               }
            }
        }

    */



    function serializeForm(formNode) {
        const { elements } = formNode
        let body = {};
        let answers = [];
        Array.from(elements).forEach((element) => {
            if (element.type == 'radio' && element.checked == true && !element.value == false) {
                body.answer = element.value
            }
            if (element.type == 'checkbox' && element.checked == true && !element.value == false) {
                answers.push(element.value);
            }
            if (element.type == 'text' && !element.value == false) {
                body.extra = element.value
            }
            if (element.type == 'hidden') {
                body[element.name] = element.value
            }
            if(element.type == 'textarea' && !element.value == false ){
                body[element.name] = element.value
            }
        })
        if (answers.length) body.answer = answers;
        //console.log(body);
        return body;
    }

    // действия с доплнительным полем Input  - extra
    function choiceExtra(){
        if(document.getElementById('extraRadio')){
            document.getElementById('extraText').onfocus = function () {
                document.getElementById('extraRadio').checked = true;
                if (document.getElementById('btnNext').hasAttribute('disabled')) document.getElementById('btnNext').removeAttribute('disabled');
            }
        }
    }

    //кнопка - Next активная при выборе варианта
    function activeBtn(){
        if(document.getElementById('btnNext')){
            const btn = document.getElementById('btnNext');
            if(btn.disabled){
                const items = document.querySelectorAll('input[name="answer"]');
                items.forEach((item)=>{
                    item.addEventListener('change', function () {
                        btn.disabled = false;
                    });
                });
            }
        }
        if (document.getElementById('textMessage')) {
            let textMessage = document.getElementById('textMessage');
            if (textMessage.value == '') {
                textMessage.oninput = function () {
                    if (btn.disabled) {
                        btn.disabled = false;
                    } else {
                        return false;
                    }
                };
            }
        }
    }
























})


















