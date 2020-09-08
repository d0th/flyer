<template>
<div class="row">

    <ul class="gallery__list">
        <li v-for="(item, index) in images" v-if="item"
            v-bind:class="['gallery__item', { photo: item.indexOf('http') == -1}, { video: item.indexOf('http') !== -1}]"
            @click="showMultiple(index)">
            <a class="gallery__link link_foto" v-if="item.indexOf('http') == -1">
                <img
                class="gallery__img"
                :src="item"
                alt="фото"
                />
            </a>
            <iframe v-if="item.indexOf('http') !== -1" class="gallery__img" :src="item" frameborder="0" allowfullscreen></iframe>
        </li>
    </ul>

    <VueEasyLightbox
        :visible="visible"
        :imgs="imgs"
        :index="index"
        @hide="handleHide"
        ></VueEasyLightbox>

    <div class="pagination container" v-if="totalItems > 10">
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
            totalItems: Number,
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
            axios.post('/api/all_media/' + this.mediaSlug + '/' + this.locale)
                .then(response => {
                    this.arrayData = response.data
                    this.totalItems = response.data[0]
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
            let imgArray = [];

            for (var i in this.images) {
                if(this.images[i].indexOf('http') !== -1) {
                //    imgArray[i] = "/img/_src/logo_white_bg.svg"
                } else {
                    this.images[i] !== '' ? imgArray.push(this.images[i])  : ''
                }
            }

            this.imgs = imgArray;
            this.index = index  // index of imgList
            this.show()
            /*setTimeout(function () {
                document.getElementsByClassName('btn__prev')[0].style.display="none"
                document.getElementsByClassName('btn__next')[0].style.display="none"
            }, 50);*/

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
