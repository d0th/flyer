<template lang="pug">
.tab-component
    .drop-down.flex-auto-center
        .drop-down__button(@click="toggle" :class="{ 'drop-down__button_toggle': show }")
            span.drop-down__title {{ title(curent) }}
            svg.drop-down__down-arrow(xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 11" weight="18" height="11")
                path(fill="#fff" d="M.35.34a1.16 1.16 0 00-.35.83 1.13 1.13 0 00.35.82l7.97 7.74A.96.96 0 009 10a.98.98 0 00.68-.27l7.97-7.74c.47-.45.47-1.19 0-1.65a1.22 1.22 0 00-1.7 0L9 7.1 2.04.34a1.22 1.22 0 00-1.69 0z")

        #pills-tab.drop-down__list.nav.nav-pills(role="tablist" :class="{ 'drop-down__list_show': show }")
            template(v-for="(item, index) in options")
                a.drop-down__item.nav-link(
                    :class="{ 'active': index == 1 }"
                    :href="`#pills-tab-${index}`"
                    :aria-controls="`pills-${index}`"
                    data-toggle="pill"
                    role="tab"
                    @click="set(index)"
                ) {{ title(index) }}

    .tab-content#pills-tabContent
        template(v-for="(tab, index) in options")
            div.tab-item(
                :id="'pills-tab-' + index"
                :class="index == 1 ? 'tab-pane fade show active' : 'tab-pane fade show'"
                role="tabpanel"
            )
                h2.tab-item__title(v-html="titleTab(index)")
                template(v-for="(item, index) in tab")
                    .fly-card
                        .fly-card__image
                            p.fly-card__image__price от {{ item.prices[0].price }} BYN
                            img(:src="`https://back.iflyminsk.by/index.php?ctrl=do&do=show_catalog_pict&catalog_id=${item.id}`", :alt="titleTab(index)")

                        .fly-card__text
                            .fly-card__top
                                .fly-card__title {{ item.title_ru }}
                                .fly-card__icons
                                    i.icon-fly {{ item.nb_flights }}
                                    i.icon-man {{ item.max_flyers }}
                            .fly-card__middle
                                p Первый полет в&nbsp;аэродинамической трубе Вы&nbsp;запомните на&nbsp;всю&nbsp;жизнь!
                            .fly-card__bottom
                                .fly-card__html(
                                    v-html="item.description_ru"
                                    :class="{ 'fly-card__html_open': descriptions.includes(item.id) }"
                                )
                                .fly-card__buttons
                                    fly-btn.fly-card__what(outline @click="about(item)") {{ descriptions.includes(item.id) ? 'Свернуть' : 'Что входит в пакет?' }}
                                    fly-btn(@click="$emit('click', $event, item)") Забронировать
                                    fly-btn(@click="$emit('cert', $event, item)") Сертификат
</template>

<script>
import FlyBtn from './button';

export default {
    name: 'TabComponent',
    components: {
        FlyBtn,
    },
    props: {
        options: {
            type: Object,
            default: () => ([]),
            required: false,
        },
    },
    data: () => ({
        curent: 1,
        show: false,
        descriptions: [],
    }),
    methods: {
        about(item) {
            if (this.descriptions.includes(item.id)) {
                this.descriptions = this.descriptions.filter((e) => e !== item.id);
                return;
            }
            this.descriptions.push(item.id);
        },
        toggle() {
            this.show = !this.show;
        },
        set(idx) {
            this.curent = idx;
            this.show = false;
            this.descriptions = [];
        },
        active(index) {
            return window.location.hash === `#pills-tab-${index}` || '';
        },
        title(index) {
            switch (index) {
                case '1':
                case 1:
                    return 'Новички';
                case '2':
                case 2:
                    return 'Спортсмены';
                case '4':
                case 4:
                    return 'Дети';
                case '5':
                case 5:
                    return 'Летавшие';
                case '6':
                case 6:
                    return 'Группы';
            }
        },
        titleTab(idx) {
                switch (idx) {
                    case 1:
                    case '1':
                        return 'Программы для&nbsp;новичков';
                    case 2:
                    case '2':
                        return 'Программы для&nbsp;спортсменов';
                    case 4:
                    case '4':
                        return 'Программы для&nbsp;детей';
                    case 5:
                    case '5':
                        return 'Программы для&nbsp;летавших';
                    case 5:
                    case '6':
                        return 'Программы для&nbsp;групп';
                }
            },
    },
};
</script>

<style lang="scss">
.drop-down {
    position: relative;
    width: 330px;
    z-index: 9;
    @media (min-width: 1000px) {
        position: unset;
        width: 100%;
    }
    &__button {
        position: relative;
        appearance: none;
        cursor: pointer;
        text-decoration: none;

        width: 330px;
        height: 60px;
        background: #E72D2D;
        color: #FFFFFF;

        font-family: Proxima Nova;
        font-weight: bold;
        font-size: 20px;
        line-height: 24px;


        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

        padding: 0 55px;
        &:hover {
            opacity: .75;
        }
        @media (min-width: 1000px) {
            display: none;
        }
    }
    &__title {
        font-family: Proxima Nova;
        font-weight: bold;
        font-size: 20px;
        line-height: 24px;
        color: #FFFFFF;
    }
    &__down-arrow {
        position: absolute;
        top: 50%;
        right: 25px;
        transform: translateY(-50%);
        transition: all .2s;
        will-change: transform;
    }
    &__button_toggle &__down-arrow {
        transform: translateY(-50%) rotate(-180deg);
    }
    &__list {
        z-index: 2;
        position: absolute;
        bottom: 0;
        left: 0; right: 0;
        transform: translateY(100%);
        background-color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;

        transition: all .2s, max-height .5s;

        max-height: 0;
        overflow-x: hidden;
        overflow-y: hidden;

        &_show {
            overflow-y: auto;
            max-height: 600px;
        }
        @media (min-width: 1000px) {
            max-height: none;
            position: unset;
            transform: none;

            background-color: transparent;

            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
    }
    &__item {
        text-decoration: none;
        cursor: pointer;
        user-select: none;

        width: 100%;
        height: 60px;
        display: flex;
        font-display: row;
        justify-content: center;
        align-items: center;

        transition: all .2s;
        border-radius: 0 !important;

        @media (min-width: 1000px) {
            max-width: 300px;
            border: 3px solid #FFFFFF;
            font-weight: bold;
            font-size: 24px;
            line-height: 29px;
            color: #FFFFFF !important;
        }

        & + & {
            border-top: 1px solid #ccc;
            @media (min-width: 1000px) {
                margin-left: 6px;
                border-top: 3px solid #fff;
            }
        }
        &:hover, &.active {
            border-radius: 0;
            background: #E72D2D !important;
            color: #fff !important;
            border-color: #E72D2D !important;
        }
        &.active {
            display: none;
            @media (min-width: 1000px) {
                display: flex;
            }
        }
    }
}

.tab-component {
    @media (min-width: 1000px) {
        max-width: 100%;
    }
}

.tab-content {
    margin-top: 30px;
    /* margin-left: 15px; */
    /* margin-right: 15px; */
    @media (min-width: 1000px) {
        margin-top: 80px;
    }
}
.tab-item {
    &__title {
        width: 100%;
        text-align: center;
        font-weight: bold;
        font-size: 30px;
        line-height: 123%;
        color: #FFFFFF;
        margin-bottom: 6px;
        @media (min-width: 1000px) {
            font-size: 48px;
            margin-bottom: 40px;
        }
    }
}
.fly-card {
    width: 100%;
    background-color: #fff;

    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;

    padding: 15px 0 0 0;

    will-change: height;

    @media (min-width: 1000px) {
        flex-direction: row;
        flex-wrap: nowrap;
        padding: 0;
        height: 420px;
    }

    & + & {
        margin-top: 20px;
        @media (min-width: 1000px) {
            margin-top: 30px;
        }
    }
    &__image {
        position: relative;
        width: 100%;

        @media (min-width: 1000px) {
            max-width: 45%;
            height: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-start;
        }
        &__price {
            position: absolute;
            left: 0; top: 25px;
            width: 140px;
            height: 40px;

            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;

            font-weight: bold;
            font-size: 18px;
            line-height: 111%;
            color: #142C60;
            background-color: #fff;
        }
        img {
           width: 100%;
           @media (min-width: 1000px) {
               width: auto;
               min-width: 100%;
               min-height: 100%;
           }
        }
    }
    &__text {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        padding: 20px 15px 15px 15px;
        width: 100%;
        @media (min-width: 1000px) {
            padding: 30px;
            max-width: 55%;
        }
    }

    &__top {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        /* @media (min-width: 1000px) {
            width: 63%;
        } */
        @media (min-width: 1000px) {
            font-size: 15px;
        }
    }
    &__title {
        font-weight: bold;
        font-size: 20px;
        line-height: 120%;
        color: #142C60;
        @media (min-width: 1000px) {
            font-size: 30px;
            white-space: nowrap;
            overflow: hidden;
            max-width: 67%;
            text-overflow: ellipsis;
        }
    }
    &__icons {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        > * + * {
            margin-left: 10px;
        }
        i {
            font-style: normal;
            font-weight: bold;
            font-size: 18px;
            line-height: 111%;
            letter-spacing: 0.02em;
            color: #142C60;
        }
    }

    &__middle {
        @media (min-width: 1000px) {
            margin-bottom: 20px;
        }
    }

    &__middle, &__html, &__middle p {
        font-weight: normal;
        font-size: 18px;
        line-height: 122%;
        color: #142C60;
    }

    &__html {
        will-change: height;
        max-height: 0;
        overflow-y: hidden;

        transition: all .2s, max-height .5s;
        &_open {
            max-height: 1500px;
            overflow-y: auto;
        }
        @media (min-width: 1000px) {
            width: 60%;
            max-height: none;
            overflow-y: auto;
            overflow-x: hidden;
            max-height: 225px;
            &::-webkit-scrollbar {
                width: 6px;
            }
            &::-webkit-scrollbar-track {
                background: #fff;
            }
            &::-webkit-scrollbar-thumb {
                background: #E72D2D;
                border-radius: 20px;
            }
            &::-webkit-scrollbar-thumb:hover {
                background: #af2424;
            }
        }
    }

    &__bottom {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        @media (min-width: 1000px) {
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
        }
    }

    &__buttons {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        > * + * {
            margin-top: 15px;
        }
        @media (min-width: 1000px) {
            max-width: calc(40% - 30px);
            margin-left: 30px;
            flex: 1;
        }
    }

    &__top, &__middle, &__bottom {
        width: 100%;
    }
    &__what {
        @media (min-width: 1000px) {
            display: none !important;
        }
    }
}
</style>
