<template>
<div class="container">
    <div class="row news__top">
        <h1 class="title">{{locale === 'en' ? title_en : title_ru}}</h1>
        <nav class="news__navWrap">
            <span class="news__tile">{{locale === 'en' ? news_tile_en : news_tile_ru}}:</span>
            <div class="news__btnGroup">
                <span class="news__selectValue">{{currentTab}}</span>
                <ul class="news__nav">
                    <li class="news__item" 
                                            v-for="tab in tabs"
                                            v-bind:key="tab"
                                            v-on:click="currentTab = tab"
                                            >
                        <span v-bind:class="['news__btn', { is_active: currentTab === tab }]">{{tab}}</span>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div v-bind:is="currentTabComponent" :locale="locale">

    </div>
</div>

</template>

<script>
    export default {
        props: ['locale'],
        data() {
            return {  
            title_ru: 'Новости и акции',
            title_en: 'News and promotions',
            news_tile_ru: 'Показывать',
            news_tile_en: 'Show',
            currentTab: String,
            tabs: [],
            currentTab_en: 'All',
            currentTab_ru: 'Все',
            tabs_ru: ['Все', 'Новости', 'Акции'],
            tabs_en: ['All', 'News', 'Stocks']
            };
        },
        created: function() {
            // this.all_news.forEach(function(entry) {
            //     entry.banner = entry.banner.split('\\');
            // });
            if(this.locale === 'en') {
                if(localStorage.getItem('akcii') == 1) {
                    this.currentTab = 'Stocks'
                } else {
                    this.currentTab = this.currentTab_en
                }
                this.tabs = this.tabs_en
            } else {
                if(localStorage.getItem('akcii') == 1) {
                    this.currentTab = 'Акции'
                } else {
                    this.currentTab = this.currentTab_ru
                }
                this.tabs = this.tabs_ru
            }
            
        },
        computed: {
            currentTabComponent: function () {
                if(this.locale === 'en') {
                    return 'tab-' + this.currentTab.toLowerCase()
                } else {
                    let thisTabRu = this.tabs_ru.indexOf(this.currentTab)
                    return 'tab-' + this.tabs_en[thisTabRu].toLowerCase()
                }
            }
        }
    }
</script>
