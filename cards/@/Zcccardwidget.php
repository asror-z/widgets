<?php

/**
 *
 *
 * Author: Obidov Yasin
 *
 */

namespace zetsoft\widgets\market;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZInputLatinWidget;


class Zcccardwidget extends ZWidget
{
    /**
     * Configuration
     */

    public $config = [];
    public $_config = [
          'percent'=>'12',
          'price_old'=> '650',
          'price' => '500' ,
          'place'=> ZcccardWidget::type['Картой/наличными курьеру'],
    ];

    public const type = [
        'Картой/наличными курьеру' => 'Картой/наличными курьеру',
        'Оплата наличными курьеру' => 'Оплата наличными курьеру',
        'Варианты оплаты уточняйте в магазине' => 'Варианты оплаты уточняйте в магазине',
        'Оплата картой на сайте' => 'Оплата картой на сайте',
    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
                     <div class="tamefSzMtq _1V30vmKHEX" data-tid="5d98e15f">
            <div class="_3hRGsDQfLz j2deHVRv6s" data-tid="66fdcf20">
                <div class="_19AGKJ6gJy"><div class="_3V5ZG89hp4" data-autotest-shopid="1925" data-tid="2610a7aa"><div data-tid="64a067c1"><span class="CVUiwsdrXn"></span></div><div class="vuLxS6jSOb _2eXq8npRBe" data-zone-name="shop-name"><a tabindex="0" class="_2IwbFpEZn7 _1zXaM2lObZ _3Szg0IzJjT" target="_blank" href="#!" rel="nofollow noopener" title="ТЕХНОПАРК" data-tid="dc1632ca 1badb8e1 e461e16a" data-tid-prop="dc1632ca 1badb8e1 e461e16a"><img alt="ТЕХНОПАРК" title="ТЕХНОПАРК" width="112" height="14" src="//avatars.mds.yandex.net/get-market-shop-logo/1523528/2a00000167883a0c7714c93cd459c4c54fbd/orig" class="_1fCQxcBHNV" data-tid="f63f9aa"></a></div></div><div class="nid7rogj18" data-zone-name="rating-stars-hint"><div class="_57c9GCchxs _2qHFKp_Y2-" data-tid="c19e3a2a"><div class="" data-zone-name="rating"><a href="/shop--tekhnopark/1925/reviews?cpc=i_h7XsMIUgbPcZ92zOQfr5qKlHItHMB_jjz4tc2W-tsDyyuw894I0xrEujOEw846YK9FfX2nQsO7XoEEBxg4rYXKYyYoGWqmKVh0FOwFTjDtZdxkYGZqFERGvtMdBRtYQPIjeWOhRfAYnAvYP9zRPWulqtl7310v&amp;cmid=w98eLjfVZbhPfkDKPska5A&amp;track=default_offer_reviews_stars" class="_2qvOOvezty _19m_jhLgZR _2haA3dL9sm" data-tid="b5c75e4a bb890ece" data-tid-prop="b5c75e4a bb890ece"><div class="yys3dEoMrF" data-rate="5" data-tid="60de94ca"><div class="_5gBd48-RGY" data-tid="4e6a964b"><div class="_2nG1R1JuTE _1w4KCMvr1l" data-tid="1d04cb08"></div></div></div></a></div><div class="_28yWHnAj2C" data-zone-name="reviews-count"><a href="/shop--tekhnopark/1925/reviews?cpc=i_h7XsMIUgbPcZ92zOQfr5qKlHItHMB_jjz4tc2W-tsDyyuw894I0xrEujOEw846YK9FfX2nQsO7XoEEBxg4rYXKYyYoGWqmKVh0FOwFTjDtZdxkYGZqFERGvtMdBRtYQPIjeWOhRfAYnAvYP9zRPWulqtl7310v&amp;cmid=w98eLjfVZbhPfkDKPska5A&amp;track=default_offer_reviews_link" class="_2qvOOvezty _2x2zBaVN-3 _23fT99BG0W" data-tid="b5c75e4a dc895c03" data-tid-prop="b5c75e4a dc895c03">38 805&nbsp;отзывов</a></div></div></div></div>
                <div class="_1zQ5uclZlE" data-tid="40b562a"><span class="_3Tzxrt0MNu"><div class="_1oHCA_6rOW _3iRewyJvms" style="width:11px;height:12px" data-tid="f2f9f88e b5eccae7"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" data-tid="b9fbf16e"><path fill="#ababab" d="M4.248.87s-1.4-2.2-3.6.4c-2.1 2.6 1.5 6.2 2.4 7.1.9 1 4 5 6.7 3 2-1.5 1-2.8.4-3.3s-1.4-1.4-2.9-.2c-1.2.9-2.6-.9-2.6-.9s-2.2-2.1-.1-3.4c1.4-.8-.3-2.7-.3-2.7"></path></svg></div></span>Показать телефон</div>
            </div>
            <div class="_1DDqKfkokz _1VyWInRhZP _133vg97zC4" data-tid="cd4d4e2a">
                <div class="_1RYk12ARqf">
                    <div class="_2EUCNlZ2-F _1U_zoSzQbx" data-tid="5e728dd7 ec4a9137"><span class="_1KQVAQscxN _2QMIalQA2B"
                                                                                            data-tid="f6ca4a97"></span><span
                            class="_1kR107TldK" data-tid="87dcd697">Бесплатный самовывоз</span>,<!-- --> <span
                            class="_1kR107TldK" data-tid="87dcd697">завтра</span><br> <a
                            href="/product--elektricheskii-dukhovoi-shkaf-electrolux-okd6p71x/428084115/geo?fesh=255&amp;from=product-top-offer&amp;offer-shipping=pickup"
                            class="_2qvOOvezty _19m_jhLgZR _1lqu__jo7-" data-autotest-id="pickupLink" data-tid="b5c75e4a"
                            data-tid-prop="b5c75e4a">в&nbsp;72&nbsp;пунктах</a></div>
                    <div class="_2EUCNlZ2-F _1U_zoSzQbx" data-autotest-id="text" data-tid="5e728dd7 6512a177"><span
                            class="_1KQVAQscxN _1zOcsm9Jo7" data-tid="f6ca4a97"></span><span class="" data-tid="87dcd697">290&nbsp;₽ курьером</span>,
                        <!-- --> <span class="_1kR107TldK" data-tid="87dcd697">завтра</span></div>
                </div>
                <span class="_2qvOOvezty _19m_jhLgZR labQEPPTP4 _1VyWInRhZP" data-tid="b5c75e4a" data-tid-prop="b5c75e4a">Все варианты доставки</span>
            </div>
            <div class="_3vEAefTheL _3dGkE1UatE _1Ws58FhWLZ _2KrwxjtZMB" data-autotest-id="stub" data-tid="57941bea">{place}
            </div>
            <div class="RhiJkvd__J _3mKiZkUb5D" data-tid="cd68d9e0"><span data-tid="4593e7ce" data-tid-prop="4593e7ce"><div
                    class="_10o2cPu4Fn" data-tid="15d313ea"><div      
                    class="_2Gq3Ev3qUH" data-tid="6ab72eea"><div
                    class="h2EBR70V3s"><span class="_5cNkUrAI2M">{price_old}<!-- -->&nbsp;<!-- -->$</span></div><div
                    class="_1xSlMTtCCt _1emLjCV7YT" data-tid="4bb129ea"><span class="_1L-3GDwnCL">{percent}%</span></div></div><div
                    class="_1PaCzxbbzN PRkvm6MdZB _1NcBg_l_w3" data-tid="ecdfb12a"><span data-autotest-value="46"
                                                                                         data-autotest-currency="₽"><span>{price}</span>&nbsp;<span>$</span></span></div></div></span>
            </div>
            <span class="_35KB6eppdn" data-tid="a102280"><div class="_3sQfMco2Md"><div class="_1_UpKh_dwL"
                                                                                       data-zone-data="{&quot;default-offer&quot;:{&quot;isCutPrice&quot;:false}}"
                                                                                       data-zone-name="to-shop"><a tabindex="0"
                                                                                                                   class="_2IwbFpEZn7 _2HAE7yg0eu U8s0ZMEbrI"
                                                                                                                   target="_blank"
                                                                                                                   href="#!"
                                                                                                                   rel="nofollow noopener"
                                                                                                                   role="button"
                                                                                                                   data-tid="dc1632ca 1badb8e1 e461e16a"
                                                                                                                   data-tid-prop="dc1632ca 1badb8e1 e461e16a">В
                <!-- -->&nbsp;<!-- -->магазин</a></div></div><div class="_3mBvYuLPe- _1ByhgjAYtd"><button class="_1WJC_7-RQd"
                                                                                                          data-tid="edf72b2a"></button></div></span>
        </div>
HTML,

        'js' => <<<JS
        
JS,

    ];

    public function asset()
    {
        $this->fileCss('/render/market/card/asset/style.css');
    }

    public function codes()
    {
        $this->htm = $this->_layout['main'];
        
    }
}



