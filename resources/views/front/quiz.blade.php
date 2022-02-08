<div class="quest_body">
    <h3 class="quest_title">{{$step->name}}</h3>
    <div class="quest_inner">

        @if($step->type == 'radio')
            @foreach($step->questions as $question)
            <div class="quest_item">
                <label class="quest_lable-radio">
                    <input type="radio"  value="{{$question->name}}" class="quest_radio" name="step">
                    <span class="quest_item_name">{{$question->name}}</span>
                </label>
            </div>
            @endforeach
            @if($step->extra)
            <div class="quest_item">
                <label class="quest_lable-radio-inp">
                    <input type="radio" value="2" class="quest_radio" vavue="" name="stap_1" placeholder="Другое...">
                    <span class="quest_item_name-inp">
					    <input type="text" class="quest_radio-input" vavue="" placeholder="Другое...">
					</span>
                </label>
            </div>
            @endif
        @endif

    </div>


    <div class="quest_footer">

        <div class="quest_footer_stap_wrap">
            <span>Шаг:</span> <span class="stap_namber">{{$number}}</span> <span>из</span> <span>{{$total}}</span>
        </div>
        <div class="quest_footer_btn_wrap"   @if($step->obligatory) disabled="disabled" @endif>
            <button class="stap_btn_back" disabled="disabled">
			    <span class="back_icon">
                    <svg viewBox="0 0 24 24" class="mdi-icon mdi-24px">
				        <title>mdi-arrow-left</title>
					    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z" stroke-width="0" fill-rule="nonzero"></path>
				    </svg>
                </span>
            </button>

            <button class="stap_btn_next blick">Далее
                <span class="next_icon">
                    <svg viewBox="0 0 24 24" class="mdi-icon mdi-24px">
				        <title>mdi-arrow-right</title>
				        <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" stroke-width="0" fill-rule="nonzero"></path>
				    </svg>
                </span>
            </button>
        </div>

    </div><!-- // footer -->

</div>

<div class="quest_info">

    @if($step->advice)
    <div class="quest_info_inner_user">
        <div class="quest_user_wrap">
            <div class="quest_user_img_wrap">
                <img src="/images/src/users/alex.jpg" alt="User" class="quest_user_img">
            </div>
            <div class="quest_user_name_wrap">
                <div class="quest_user_name">Алексей</div>
                <div class="quest_user_position">Старший манеджер</div>
            </div>
        </div>
        <div class="quest_info_massege">{{$step->advice}}</div>
    </div>
    @endif

    @if($benefits)
    <div class="quest_info_offers_wrap">
        @foreach($benefits as $benefit)
        <div class="quest_offer_item">
            <img src="{{ $benefit->getImage() }}" alt="Offer" class="quest_offer_icon">
            <div class="quest_offer_text">{{ $benefit->name }}</div>
        </div>
        @endforeach
    </div>
    @endif

</div>
