<div class="last_body">
    <div class="last_inner">
        <h3 class="last_title">Спасибо. Мы получили ответы!</h3>
        <p class="last_subtitle">Как с вами связаться, чтобы сообщить результаты?</p>
        <p class="last_p">Промокод на скидку 5% вы получите сразу после отправки формы.</p>
        @if($benefits)
        <h4 class="last_offer_title">Ваши бонусы</h4>
        <div class="last_offer_wrap">
            @foreach($benefits as $benefit)
            <div class="quest_offer_item">
                <img src="{{ $benefit->getImage() }}" alt="Offer" class="quest_offer_icon">
                <div class="quest_offer_text">{{ $benefit->name }}</div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<div class="last_info">
    <form class="quest_last_form" action="#" method="post">
        <div class="last-group user-name">
            <label for="name" class="last-label">Введите имя</label>
            <div class="form-block">
                <input type="text" class="last-input" id="name" name="name" value="" placeholder="Имя">
            </div>
        </div>
        <div class="last-group">
            <label for="phone" class="last-label">Введите телефон</label>
            <div class="form-block">
                <input type="tel" class="last-input" id="phone" name="phone" value="">
            </div>
            <span id="valid-msg" class="hide" style="display: none;"></span>
            <span id="error-msg" class="hide" style="display: none;"></span>
        </div>
        <button type="submit" class="last-btn shining">Получить результаты</button>
        <div class="last_form-agreement">
            <label class="last-checkbox">
                <input type="checkbox" class="agreement-check" checked>
                <span class="agreement-txt">
                     <span>C <a href="#" target="_blank">политикой конфиденциальности</a> ознакомлен(а)</span>
				</span>
            </label>
        </div>
    </form>
</div>
