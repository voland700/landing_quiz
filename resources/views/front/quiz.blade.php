<form action="#" method="post" class="quest_body" id="formBody">
    @csrf
    @method('POST')
    <input type="hidden" name="step" value="{{$number}}">
    <input type="hidden" name="prev" value="{{$prev}}">
    <input type="hidden" name="next" value="{{$next}}">
    <h3 class="quest_title">{{ $step->name }}</h3>
    <div class="quest_inner">

        @if($step->type =='checkbox' || !$step->obligatory )
        <div class="quest_conditions">
            @if($step->type =='checkbox')<span class="quest_condition-imp">выберите один или несколько</span>@endif
            @if(!$step->obligatory)<span class="quest_condition">можно пропустить</span>@endif
        </div>
        @endif


        @if($step->type == 'radio')
            @foreach($step->questions as $question)
            <div class="quest_item">
                <label class="quest_lable-radio">
                    <input type="radio"  value="{{$question->name}}" class="quest_radio" name="answer">
                    <span class="quest_item_name">{{$question->name}}</span>
                </label>
            </div>
            @endforeach
            @if($step->extra)
            <div class="quest_item">
                <label class="quest_lable-radio-inp">
                    <input type="radio" class="quest_radio" id="extraRadio"  name="answer" placeholder="Другое...">
                    <span class="quest_item_name-inp">
					    <input type="text" class="quest_radio-input" id="extraText" name="extra" vavue="" placeholder="Другое...">
					</span>
                </label>
            </div>
            @endif
        @endif

        @if($step->type == 'checkbox')
            @foreach($step->questions as $question)
            <div class="quest_item">
                <label class="quest_lable-radio">
                    <input type="checkbox"  value="{{$question->name}}" class="quest_checkbox" name="answer">
                    <span class="quest_item_name_2">{{$question->name}}</span>
                </label>
            </div>
            @endforeach
            @if($step->extra)
            <div class="quest_item">
                <label class="quest_lable-radio-inp">
                    <input type="checkbox" class="quest_checkbox" name="answer" id="extraRadio">
                    <span class="quest_item_name_2-inp">
				        <input type="text" class="quest_radio-input" vavue="extra" id="extraText" placeholder="Другое...">
                    </span>
                </label>
            </div>
            @endif
        @endif
        @if($step->type == 'text')
            <textarea class="quest_message" name="message" rows="7" @if(!$step->obligatory) id="textMessage" @endif></textarea>
        @endif
    </div>

    <div class="quest_footer">

        <div class="quest_footer_stap_wrap">
            <span>Шаг:</span> <span class="stap_namber">{{$number}}</span> <span>из</span> <span>{{$total}}</span>
        </div>
        <div class="quest_footer_btn_wrap" >
            <button class="stap_btn_back" @if($prev == false) disabled="disabled" @else id="btnPrev" @endif >
			    <span class="back_icon">
                    <svg viewBox="0 0 24 24" class="mdi-icon mdi-24px">
				        <title>mdi-arrow-left</title>
					    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z" stroke-width="0" fill-rule="nonzero"></path>
				    </svg>
                </span>
            </button>

            @if($number == $total-1 && $next == false)
                <button class="stap_btn_next last blick" id="btnNext" @if($step->obligatory) disabled="disabled" @endif>Последний шаг</button>
            @else
            <button class="stap_btn_next blick" id="btnNext" @if($step->obligatory) disabled="disabled" @endif>Далее
                <span class="next_icon">
                    <svg viewBox="0 0 24 24" class="mdi-icon mdi-24px">
				        <title>mdi-arrow-right</title>
				        <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" stroke-width="0" fill-rule="nonzero"></path>
				    </svg>
                </span>
            </button>
            @endif
        </div>

    </div>
</form>

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

<script>

</script>
