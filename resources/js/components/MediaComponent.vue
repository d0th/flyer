<template>

<div class="container">
    <div class="row gallery__top">
        <h1 class="title">{{media.preview_description}}</h1>
        <nav class="gallery__navWrap">
            <span class="gallery__tile">{{locale === 'en' ? media_tile_en : media_tile_ru}}:</span>
            <div class="gallery__btnGroup">
                <span class="gallery__selectValue">{{currentTab}}</span>
                <ul class="gallery__nav">
                    <li class="gallery__item" v-for="tab in tabs_media"
                                                v-bind:key="tab"
                                                v-on:click="currentTab = tab"
                                                >
                        <span v-bind:class="['gallery__btn', { is_active: currentTab === tab }]">{{tab}}</span>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div v-bind:is="currentTabComponent" :locale="locale" :mediaSlug="media.slug">

    </div>
</div>

</template>

<script>
    export default {
        props: ['locale', 'media'],
        // props: {
        //     locale: String,
        //     media: Object
        // },
        data() {
            return {  
            // title_ru: 'Фото и видео',
            // title_en: 'Photo and video',
            media_tile_ru: 'Показывать',
            media_tile_en: 'Show',
            media_item: 'Media',
            currentTab: String,
            tabs_media: [],
            currentTab_en: 'All',
            currentTab_ru: 'Все',
            tabs_ru: ['Все', 'Фото', 'Видео'],
            tabs_en: ['All', 'Foto', 'Video']
            };
        },
        created: function() {
            // this.all_news.forEach(function(entry) {
            //     entry.banner = entry.banner.split('\\');
            // });
            if(this.locale === 'en') {
                this.currentTab = this.currentTab_en
                this.tabs_media = this.tabs_en
            } else {
                this.currentTab = this.currentTab_ru
                this.tabs_media = this.tabs_ru
            }
            
        },
        computed: {
            currentTabComponent: function () {
                if(this.locale === 'en') {
                    if(this.currentTab === 'All') {
                        return 'tab-' + this.media_item.toLowerCase()
                    } else {
                        return 'tab-' + this.currentTab.toLowerCase()
                    }
                    
                } else {
                    if(this.currentTab === 'Все') {
                        return 'tab-' + this.media_item.toLowerCase()
                    } else {
                        let thisTabRu = this.tabs_ru.indexOf(this.currentTab)
                        return 'tab-' + this.tabs_en[thisTabRu].toLowerCase()
                    }
                }
            }
        }
    }
</script>
