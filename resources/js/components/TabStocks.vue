<template>
<div class="row">
    <ul v-bind:class="['news__list', { new_style: totalPages == 2}]">
        <li v-for="(item, index) in stocks_posts"
            v-bind:class="['news__item', { news_post: index !== 3 && index !== 9 }, { news_big: index === 3 || index === 9}, { sale: item.sale == 1 }, { akcii: item.new == 1 }, { date: item.sale !== 1 && item.new !== 1 }]"
            v-bind:style="{ backgroundImage: index === 3 || index === 9 ? 'url(/storage/'+ item.banner[0] +'/'+ item.banner[1] +'/' + item.banner[2] + ')' : ''}">
            <a class="news__link" :href="'/akcii/' + item.slug">
                <img class="news__img" :src="'/storage/'+ item.banner[0] +'/'+ item.banner[1] +'/' + item.banner[2]" :alt="item.title" v-if="index !== 3 && index !== 9"/>
                <div class="news-bigWrap" v-if="index === 3 || index === 9">
                <h3 class="news__subTitleBig">{{item.title}}</h3>
                <span class="news__description">{{item.text}}</span>
                </div>
                <h3 class="news__subTitle" v-else-if="index !== 3 && index !== 9">{{item.title}}</h3>
                <span class="news__date" v-if="index !== 3 && index !== 9">{{item.date}}</span>
            </a>
        </li>
    </ul>
    <div class="pagination container" v-if="totalPages > 10">
        <div class="row">
            <ul class="pagination__counter">
                <li class="pagination__item">Показано:</li>
                <li class="pagination__item number">{{ currentPage }}</li>
                <li class="pagination__item">из</li>
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
        props: ['locale'],
        components: { vPagination },
        data() {
            return {
            stocks_posts: null,
            currentPage: 1,
            totalPages: Number,
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
            axios.post('/api/stocks_news/' + this.locale)
                .then(response => {
                    this.stocks_posts = response.data
                    this.totalPages = response.data.length
                    this.stocks_posts.forEach(function(entry) {
                        entry.banner = entry.banner.replace(/\\/g, '/');
                        entry.banner = entry.banner.split('/');
                    });
                });

        }
    }
</script>
