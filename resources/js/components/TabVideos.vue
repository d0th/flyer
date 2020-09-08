<template>
<div class="row">
    <ul class="gallery__list video_list">
        <li v-for="(item, index) in array_video" class="gallery__item video">
            <iframe class="gallery__img" :src="item" frameborder="0" allowfullscreen></iframe> 
        </li>
    </ul>
    <div class="pagination container" v-if="totalVideo > 8">
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
    export default {
        props: ['locale', 'mediaSlug'],
        components: { vPagination },
        data() {
            return {
            array_video: null,
            arrayData: null,
            currentPage: 1,
            totalVideo: Number,
            totalPages: Number,
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
            axios.post('/api/video/' + this.mediaSlug + '/' + this.locale)
                .then(response => {
                this.arrayData = response.data
                this.totalVideo = response.data[0]
                this.totalPages = response.data.length - 1
                this.showPageGallery(this.currentPage);
            });  
        },
        methods: {
            showPageGallery(page) {
            this.array_video = this.arrayData[page]
            // console.log(this.images);
            // this.show()
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
