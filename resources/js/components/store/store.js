import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export const store = new Vuex.Store({
    //состояние
    state: {
        items: [],
        itemsId: []
    },
    getters: {
        cartItems(state) {
            state.itemsId.length = 0;

            return state.items.map(cartItem => {
                state.itemsId.push({id: cartItem.id, quantity: cartItem.quantity});
                localStorage.setItem('cartItems', JSON.stringify(state.itemsId));

                return {
                    id: cartItem.id,
                    title: cartItem.title,
                    price_from: cartItem.price_from,
                    price_to: cartItem.price_to,
                    quantity: cartItem.quantity
                }
            })
        },
        cartItemTotal (state, getters) {
            if (state.itemsId.length > 0) {
                localStorage.setItem('cartItems', JSON.stringify(state.itemsId));
            }

            return getters.cartItems.reduce((total, item) => total + item.quantity, 0);
        },
        getCartItems (state, getters) {
            if (state.itemsId.length > 0) {
                localStorage.setItem('cartItems', JSON.stringify(state.itemsId));
            }

            return getters.cartItems;
        },
    },
    actions: {
        addItem(context, item) {
            let cartItem = context.state.items.find(itemCart => itemCart.id === item.id);

            if (!cartItem) {
                context.commit('pushItemToCart', item);
            } else {
                context.commit('incrementItemQuantity', cartItem)
            }
        },
        insertItemToCart(context, item) {
            context.commit('insertToCart', item)
        },
        removeItem(context, item) {
            let cartItem = context.state.items.find(itemCart => itemCart.id === item.id);

            if (cartItem === undefined) {
                return false;
            }

            if (cartItem.quantity === 1) {
                context.commit('spliceItemFromCart', cartItem);
            } else {
                context.commit('decrementItemQuantity', cartItem);
            }
        },
        deleteItemFromCart(context, item) {
            let cartItem = context.state.items.find(itemCart => itemCart.id === item.id);

            if (cartItem) {
                context.commit('spliceItemFromCart', cartItem)
            } else {
                return false;
            }
        }
    },
    mutations: {
        insertToCart (state, item) {
            state.items.push(item);
        },
        pushItemToCart (state, item) {
            let itemCart = {
                id: item.id,
                title: item.title_ru,
                price_from: item.prices[0].price,
                price_to: item.prices[1].price,
                quantity: 1
            };

            state.items.push(itemCart);
        },
        incrementItemQuantity (state, cartItem) {
            ++cartItem.quantity;
        },
        decrementItemQuantity (state, cartItem) {
            --cartItem.quantity;
        },
        spliceItemFromCart(state, cartItem) {
            let index = state.items.indexOf(cartItem);

            if (index > -1) {
                let dish = state.items[index];
                state.cartCount -= dish.quantity;
                state.items.splice(index, 1);
            }
        }
    }
});
