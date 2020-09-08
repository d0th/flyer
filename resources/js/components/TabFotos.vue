<template>
<div class="row">

    <ul class="gallery__list">
        <li v-for="(item, index) in images" class="gallery__item photo" @click="showMultiple(index)">
            <a class="gallery__link link_foto">
                <img
                class="gallery__img"
                :src="item"
                alt="фото"
                />
            </a>
        </li>
    </ul>

        <VueEasyLightbox
        :visible="visible"
        :imgs="imgs"
        :index="index"
        @hide="handleHide"
        ></VueEasyLightbox>

    <div class="pagination container" v-if="totalImages > 10">
        <div class="row">
            <ul class="pagination__counter">
                <li class="pagination__item">{{ paginationShow }}:</li>
                <li class="pagination__item number">{{ currentPage }}</li>
                <li class="pagination__item">{{ paginationTotal }}</li>
                <li class="pagination__item quantity">{{ totalPages }}</li>
            </ul>
            <div class="pagination__wrap">
                <v-pagination v-model="currentPage"
                    :page-count="totalPages"
                    :classes="bootstrapPaginationClasses"
                    :labels="paginationAnchorTexts"></v-pagination>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import vPagination from 'vue-plain-pagination';
import VueEasyLightbox from 'vue-easy-lightbox';
    export default {
        props: ['locale', 'mediaSlug'],
        components: { vPagination, VueEasyLightbox },
        data() {
            return {
            arrayData: null,    
            images: null,
            imgs: '',  // Img Url , string or Array
            visible: false,
            index: 0,  // default
            currentPage: 1,
            totalPages: Number,
            totalImages: Number,
            paginationShow_en: 'Shown',
            paginationShow_ru: 'Показано',
            paginationShow: String,
            paginationTotal_en: 'of',
            paginationTotal_ru: 'из',
            paginationTotal: String,
            bootstrapPaginationClasses: {
                ul: 'pagination__list',
                li: 'pagination__item',
                liActive: 'is-active',
                liDisable: 'disabled',
                button: 'button_pagination'  
            },
            paginationAnchorTexts: {
                first: '',
                prev: '&lsaquo;',
                next: '&rsaquo;',
                last: ''
            }
            };
        },
        mounted() {
            axios.post('/api/foto/' + this.mediaSlug + '/' + this.locale)
            .then(response => {
                this.arrayData = response.data
                this.totalImages = response.data[0]
                this.totalPages = response.data.length - 1
                this.showPageGallery(this.currentPage);
            });
               
        },
        methods: {
            showPageGallery(page) {
            this.images = this.arrayData[page]
            // console.log(this.images);
            // this.show()
            },
            showMultiple(index) {

            this.imgs = this.images;
            this.index = index  // index of imgList
            this.show()
            },
            show() {
            this.visible = true
            },
            handleHide() {
            this.visible = false
            }
        },
        watch: {
            currentPage: function (val) {
                this.showPageGallery(val);
            }
        },
        created: function() {
            if(this.locale === 'en') {
                this.paginationTotal = this.paginationTotal_en
                this.paginationShow = this.paginationShow_en
            } else {
                this.paginationTotal = this.paginationTotal_ru
                this.paginationShow = this.paginationShow_ru
            }
        }
    }
</script>
