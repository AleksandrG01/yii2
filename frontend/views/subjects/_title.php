<h1 class="main-title" :class="{ '-scrolled': styckyMenu, '': !styckyMenu }" @scroll.window="styckyMenu = (window.pageYOffset < 50) ? false: true" >Субъекты Российской Федерации</h1>