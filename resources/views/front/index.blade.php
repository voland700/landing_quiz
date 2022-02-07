@extends('front.layouts.layout_main')
@section('content')
    <section class="slide" style="background-image: url(/images/src/SLID.jpg)">
        <div class="container slide_container">
            <div class="slide_wrap rellax" data-rellax-speed="2">
                <h1 class="slide_h1">Поможем выбрать отопительную печь, которая <span>идеально подойдет</span> для вашего дома!</h1>
                <p class="slide_sub">Большой выбор печей длительного горения. Пройдите простой тест на подбор идеальной печи и получите персональное предложение на установку + промокод на <span>скидку 15%</span>!</p>
                <a href="#" class="btn btn-accent shining mr-05">Подобрать печь и узнать цену</a>
                <a href="#" class="btn btn-outline-white">Заказать звонок</a>
            </div>

            <div class="slide_info rellax" data-rellax-speed="1">

                <div class="slide_info_item">
                    <h3 class="slide_info_title"></span>Доставка по Москве и области</h3>
                    <p class="slide_info_p">Доставка по Москве от 2 часов. Оплата удобным способом.</p>
                </div>

                <div class="slide_info_item">
                    <h3 class="slide_info_title">Надежные производители</h3>
                    <p class="slide_info_p">Везувий, Jotul, Morso, Guca, Kratki, Мета и другие ведущие бренды в наличии и под заказ.</p>
                </div>

                <div class="slide_info_item">
                    <h3 class="slide_info_title">Выезд мастера в день обращения</h3>
                    <p class="slide_info_p">Безопасно установим печь строго соблюдая технологию монтажа за 1 день.</p>
                </div>

            </div>

        </div>
    </section>

    <section class="container info">
        <h2 class="info_title">Чтобы подобрать подходящую отопительную печь, нужно учесть <span>более 25 параметров</span> и характеристик</h2>
        <p class="info_subtitle">Вот лишь некоторые из них...</p>

        <div class="info_wrup">
            <div class="info_item">
                <img src="/images/src/icons/cub.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Объем помещения, м³</h3>
                <p class="info_item_p">Это важнейший параметр, который нужно учитывать при выборе отопительной печи в первую очередь. Есть модели рассчитанные на обогрев помещений объемом до 50, 100, 150, 200 м³ и более.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/clock.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Длительность горения</h3>
                <p class="info_item_p">В печах длительного горения дрова горят шесть, восемь, а то и все двенадцать часов. Другие дают тепло 1-2 часа. У каждого типа печи свои плюсы и минусы. Специалисты Печного Мира помогут с выбором оптимального варианта.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/volume.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">КПД печи</h3>
                <p class="info_item_p">Есть модели с отверстиями для дополнительной подачи воздуха (жиклёром). Наличие жиклёра, наряду с другими техническими решениями сильно влияет на эффективность и длительность обогрева.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/appliances.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Технические решения</h3>
                <p class="info_item_p">В некоторых моделях предусмотрена возможность установки теплосъемников для разводки тепла по нескольким помещениям. Другие же можно вмонтировать в портал кирпичной стены для обогрева двух помещений.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/four.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Из каких материалов</h3>
                <p class="info_item_p">Существуют модели с колосниковыми решетками из стали или чугуна. Это же относится к материалу корпуса и дверцам. Чугун выдерживают быстрый и длительный нагрев без деформаций. Но сталь тоже имеет свои преимущества.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/flam.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Глухая дверца или со стеклом</h3>
                <p class="info_item_p">Существуют модели с колосниковыми решетками из стали или чугуна. Это же относится к материалу корпуса и дверцам. Чугун выдерживают быстрый и длительный нагрев без деформаций. Но сталь тоже имеет свои преимущества.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/stove.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Наличие варочной поверхности</h3>
                <p class="info_item_p">В магазине Печной Мир большой выбор печей с варочной поверхностью для приготовления пищи. Выбрать подходящую именно вам помогут наши менеджеры.</p>
            </div>

            <div class="info_item">
                <img src="/images/src/icons/voilet.svg" alt="Объем помещения, м³" class="info_item_icon">
                <h3 class="info_item_h3">Ценовая категория</h3>
                <p class="info_item_p">Цены печей сильно отличаются в зависимости от их характеристик. Есть недорогие модели по ценам от 15000 ₽ или премиум варианты стоимостью до 130000 ₽ и выше.</p>
            </div>
        </div>

    </section>

    <section class="why">
        <div class="container why_container">
            <h2 class="why_title">Как же найти <span>подходящий вариант</span> и не ошибиться в выборе?</h2>

            <p class="why_suptitle">Мы являемся <span>экспертами по отопительным печам с 2005 года</span> и готовы дать вам исчерпывающую консультацию. Просто выберите удобный способ для связи и мы поможем подобрать печь по вашим параметрам идеально подходящую для вашего дома!</p>

            <div class="why_wrap">

                <div class="why_item">
                    <div class="why_item_img_wrup">
                        <img src="/images/src/icons/images.svg" alt="" class="why_item_img">
                    </div>
                    <h3 class="why_item_h3">Отправим фотографии и характеристики</h3>
                </div>

                <div class="why_item">
                    <div class="why_item_img_wrup">
                        <img src="/images/src/icons/data.svg" alt="" class="why_item_img">
                    </div>
                    <h3 class="why_item_h3">Сообщим цену и сроки доставки с установкой</h3>
                </div>

                <div class="why_item">
                    <div class="why_item_img_wrup">
                        <img src="/images/src/icons/meeting.svg" alt="" class="why_item_img">
                    </div>
                    <h3 class="why_item_h3">Договоримся о встрече в магазине или о доставке</h3>
                </div>

                <div class="why_item">
                    <div class="why_item_img_wrup">
                        <img src="/images/src/icons/coll.svg" alt="" class="why_item_img">
                    </div>
                    <h3 class="why_item_h3">И никакого спама и навязывания. Обещаем!</h3>
                </div>

            </div>

        </div>
    </section>

    <section class="container call">
        <h2 class="call_title">Выберите удобный способ для связи</h2>

        <div class="call_wrup">
            <a href="tel:88007773487" class="btn-b btn-accent w290 shining">Позвонить 8-800-777-34-87</a>
            <a href="#" class="btn-b btn-outline-black w290">Написать в WhatsApp</a>
            <a href="#" class="btn-b btn-outline-black w290">Заказть звонок</a>
        </div>

    </section>

    <script>



    </script>


@if($products)
    <section class="product">
        <div class="container product_container">
            <h2 class="product_title"><span>Популярные печи</span> в наличии</h2>

            <div class="product_wrap">
                @foreach($products as $product)
                <div class="product_item">
                    <div class="product_img_wrap">
                        <span class="product_lable_wrap">
                            @if($product->hit)<span class="product_lable hit">Хит</span>@endif
                            @if($product->top)<span class="product_lable top">Топ</span>@endif
                            @if($product->gift)<span class="product_lable gift">Подарок</span>@endif
                            @if($product->stock) <span class="product_lable sale">Акция</span>@endif
                        </span>
                        <img src="{{ $product->getImage() }}" alt="{{$product->name}}" class="product_img elem" data-id="{{$product->id}}">
                    </div>
                    <h3 class="product_h3 elem" data-id="{{$product->id}}">{{$product->name}}</h3>
                    <div class="product_summary">{!! $product->summary !!}</div>
                    <div class="product_btn_block">
                        <a href="#" class="product_btn ask">Узнать цену</a>
                        <a href="#" class="product_btn more elem" data-id="{{$product->id}}">Подробнее</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
    <section class="advice" style="background-image: url(/images/src/SLID_2.jpg)">
        <div class="advice_overlay"></div>
        <div class="advice_content paralax">
            <h2 class="advice_title">Пройдите тест из 6 вопросов и узнайте, какая печь идеально подойдет для вашего дома!</h2>
            <p class="advice_subtitle">Максимум выгоды! После прохождения теста вы получите персональное предложение на установку печи<br>
                + промокод на скидку 5%!</p>
            <div class="advice_btn_wrup">
                <a href="#" class="btn-b btn-accent  w290 shining">Найти идеальную печь</a>
            </div>
        </div>
    </section>


    <section class="container advantage">
        <h2 class="advantage_title">Почему тысячи клиентов в центральной части России выбирают «Печной Центр»</h2>

        <div class="advantage_wrap">
            <div class="advantage_item">
                <div class="advantage_img_wrap">
                    <img src="/images/src/icons/persent.svg" alt="" class="advantage_img">
                </div>
                <h3 class="advantage_h3">Выгодные покупки</h3>
                <p class="advantage_p">Мы являемся официальными дилдерами производителей печей и каминов, прямые поставщики без посредников, по-этому покупки у нас максимально выгодные!</p>
            </div>

            <div class="advantage_item">
                <div class="advantage_img_wrap">
                    <img src="/images/src/icons/save.svg" alt="" class="advantage_img">
                </div>
                <h3 class="advantage_h3">Гарантия до 25 лет</h3>
                <p class="advantage_p">Являсь официальными дилдерами, мы предоставляем гарантии производителей печей и каминов, гарантийный срок на некоторые модели составляет 25 лет.</p>
            </div>

            <div class="advantage_item">
                <div class="advantage_img_wrap">
                    <img src="/images/src/icons/delivery.svg" alt="" class="advantage_img">
                </div>
                <h3 class="advantage_h3">Качественный сервис</h3>
                <p class="advantage_p">Мы сопровождаем клиентов на всех этапах: помогаем с выбором, организуем доставку до дома, производим профессиональный монтаж.</p>
            </div>

        </div>

    </section>

    <div class="map">

        <div class="map_info_wrap">
            <span id="closeOnMap" class="map_info_remove"><span class="close"></span></span>
            <h3 class="map_info_title">Звоните и приходите в магазин «Печной Центр Ясенево»</h3>
            <div class="map_info_phone">8-800-777-34-87</div>
            <div class="map_info_mail">info@pechnik.su</div>
            <div class="map_info_address">Москва, 38 км. МКАД, вл. 4Б стр. 1 пн-вс: 9-00 до 19-00</div>

            <div class="map_info_media_wrap">
                <span class="social_item fb" data-url="facebook.com"><span class="icon-fb"></span></span>
                <span class="social_item vk" data-url="https://vk.com/pechnik_su"><span class="icon-vk"></span></span>
                <span class="social_item ok" data-url="https://ok.ru"><span class="icon-ok"></span></span>
                <span class="social_item yortube" data-url="https://www.youtube.com/channel/UCPY3HLf3_tcm78QPJqp3g-A"><span class="icon-yortube"></span></span>
                <span class="social_item inst" data-url="https://www.instagram.com/"><span class="icon-inst"></span></span>
                <span class="social_item v-up" data-url="https://www.whatsapp.com"><span class="icon-v-up"></span></span>
            </div>
        </div>

        <div class="map_map">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8b58e5eadf53e2cef593bf7b5fea2b7d449927dfaa7c36df859f557f4b887b95&amp;width=100%25&amp;height=720&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>

    </div>
@endsection
