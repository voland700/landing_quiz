<div class="dell show" id="callBack">
    <div class="collback">
        <div class="quest_close_wrap">
            <span class="quest_btn_close" id="btnCallbackCross"></span>
        </div>
        <div class="collback_wrap">
            <div class="modal_call_top">
                <h3>Заказать звонок</h3>
            </div>

            <form action="#" method="POST" id="CollBackForm">
                @csrf
                @method('POST')
                <div class="modal_body">

                    <div class="modal_fild">
                        <label>Ваше имя<span class="req">*</span></label>
                        <span id="CollBackNameValidate" class="order_fild_valid"></span>
                        <input id="CollBackName" type="text" name="name" value="" required="" placeholder="Иван Иванович">
                    </div>

                    <div class="modal_fild">
                        <label>Номер телефона<span class="req">*</span></label>
                        <span id="CallBackPhoneValidate" class="order_fild_valid"></span>
                        <input type="tel" id="CallBackPhone" name="phone" value="" required="" placeholder="+7 915 877 45 58">
                    </div>

                    <div class="modal_agreement">
                        <input id="CallBackAgreement" type="checkbox" class="modal_check" name="agreement" value="yes" checked="checked" required="">
                        <label>Я согласен на <a href="/agreement" target="_blank">обработку персональных данных</a></label>
                    </div>


                </div>

                <div class="modal_call_footer">
                    <button class="btn btn-primary" id="btnCallback">Отправить</button>
                </div>
            </form>

        </div>

    </div>
</div>
