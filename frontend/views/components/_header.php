<header class="header" 
        :class="{ '-scrolled': styckyMenu, '': !styckyMenu }"
        @scroll.window="styckyMenu = (window.pageYOffset < 50) ? false: true" >

    <div class="container" >
        <div class="header-wrapper">
            <a href="#" class="button -hover-red-bg -iconed-right" x-data @click.prevent="$store.openForm.toggle()">
                Добавить 
                <i>
                    <svg>
                        <use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#pluss" aria-hidden="true"></use>
                    </svg>
                </i>
            </a>

            <svg class="add-subject" x-data @click.prevent="$store.openForm.toggle()">
                <use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#pluss" aria-hidden="true"></use>
            </svg>


            <a href="/" style="text-decoration: none;"><div class="header-title">Субъекты Российской Федерации</div></a>
        </div>
    </div>

</header> 