<template>
    <header class="bg-black sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4">
            <!-- Left section: Logo -->
            <a href="/" class="flex items-center">
                <div>
                    <img
                        src="@/Assets/images/template-white-logo.png"
                        alt="Logo"
                        class="h-14 w-auto mr-4"
                    />
                </div>
            </a>
            <!--  menu (for mobile) -->
            <div class="flex lg:hidden">
                <button
                    @click="toggleMobilemenu"
                    class="text-white focus:outline-none"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"
                        ></path>
                    </svg>
                </button>
            </div>
            <!-- Center section: Menu -->
            <nav class="hidden lg:flex md:flex-grow justify-center">
                <ul class="flex justify-center space-x-4 text-white">
                    <li>
                        <a href="/" class="hover:text-secondary font-semibold"
                            >Home</a
                        >
                    </li>

                    <CategoryMenu :categories="categories" />

                    <li>
                        <a
                            href="shop"
                            class="hover:text-secondary font-semibold"
                            >Shop</a
                        >
                    </li>
                </ul>
            </nav>
            <!-- Right section: Buttons (for desktop) -->
            <div class="hidden lg:flex items-center space-x-4 relative">
                <a
                    href="register.html"
                    class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block"
                    >Đăng ký</a
                >
                <a
                    href="register.html"
                    class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block"
                    >Đăng nhập</a
                >
                <div class="relative group cart-wrapper">
                    <a href="/cart">
                        <img
                            src="@/Assets/images/cart-shopping.svg"
                            alt="Cart"
                            class="h-6 w-6 group-hover:scale-120"
                        />
                    </a>
                    <!-- Cart dropdown -->
                    <div
                        class="absolute right-0 mt-1 w-80 bg-white shadow-lg p-4 rounded hidden group-hover:block"
                    >
                        <div class="space-y-4">
                            <!-- product item -->
                            <div
                                class="flex items-center justify-between pb-4 border-b border-gray-line"
                            >
                                <div class="flex items-center">
                                    <img
                                        src="@/Assets/images/single-product/1.jpg"
                                        alt="Product"
                                        class="h-12 w-12 object-cover rounded mr-2"
                                    />
                                    <div>
                                        <p class="font-semibold">
                                            Summer black dress
                                        </p>
                                        <p class="text-sm">Quantity: 1</p>
                                    </div>
                                </div>
                                <p class="font-semibold">$25.00</p>
                            </div>
                            <!-- product item -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img
                                        src="@/Assets/images/single-product/2.jpg"
                                        alt="Product"
                                        class="h-12 w-12 object-cover rounded mr-2"
                                    />
                                    <div>
                                        <p class="font-semibold">Black suit</p>
                                        <p class="text-sm">Quantity: 1</p>
                                    </div>
                                </div>
                                <p class="font-semibold">$125.00</p>
                            </div>
                        </div>
                        <a
                            href="/cart.html"
                            class="block text-center mt-4 border border-primary bg-primary hover:bg-transparent text-white hover:text-primary py-2 rounded-full font-semibold"
                            >Go to Cart</a
                        >
                    </div>
                </div>
                <a
                    href="javascript:void(0);"
                    class="text-white hover:text-secondary group"
                    @click="toggleSearch"
                >
                    <img
                        src="@/Assets/images/search-icon.svg"
                        alt="Search"
                        class="h-6 w-6 transition-transform transform group-hover:scale-120"
                    />
                </a>
                <!-- Search field -->
                <div
                    v-if="isSearchVisible"
                    class="absolute top-full right-0 mt-2 w-full bg-white shadow-lg p-2 rounded"
                >
                    <input
                        type="text"
                        class="w-full p-2 border border-gray-300 rounded"
                        placeholder="Tìm kiếm sản phẩm..."
                    />
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile menu -->
    <nav
        v-if="isMobilemenuVisible"
        class="mobile-menu flex flex-col items-center space-y-8 lg:hidden"
    >
        <ul class="w-full">
            <li>
                <a href="/" class="hover:text-secondary font-bold block py-2"
                    >Home</a
                >
            </li>

            <!-- Men Dropdown -->
            <CategoryMenu :categories="categories" />

            <li>
                <a
                    href="checkout.html"
                    class="hover:text-secondary font-bold block py-2"
                    >Checkout</a
                >
            </li>
        </ul>
        <div class="flex flex-col mt-6 space-y-2 items-center">
            <a
                href="register.html"
                class="bg-primary hover:bg-transparent text-white hover:text-primary border border-primary font-semibold px-4 py-2 rounded-full inline-block items-center justify-center min-w-[110px]"
                >Đăng ký</a
            >
            <a
                href="register.html"
                class="bg-primary hover:bg-transparent text-white hover:text-primary border border-primary font-semibold px-4 py-2 rounded-full inline-block items-center justify-center min-w-[110px]"
                >Đăng nhập</a
            >
            <a
                href="register.html"
                class="bg-primary hover:bg-transparent text-white hover:text-primary border border-primary font-semibold px-4 py-2 rounded-full inline-block items-center justify-center min-w-[110px]"
                >Giỏ hàng -&nbsp;<span>5</span>&nbsp;items</a
            >
        </div>
        <!-- Search field -->
        <div
            class="top-full right-0 mt-2 w-full bg-white shadow-lg p-2 rounded"
        >
            <input
                type="text"
                class="w-full p-2 border border-gray-300 rounded"
                placeholder="Tìm kiếm sản phẩm..."
            />
        </div>
    </nav>
</template>
<script>
export default {
    name: "Header",
    data() {
        return {
            categories: this.$page.props.product_categories,
            isSearchVisible: false,
            isMobilemenuVisible: false,
        };
    },
    methods: {
        toggleSearch() {
            this.isSearchVisible = !this.isSearchVisible;
        },
        toggleMobilemenu() {
            this.isMobilemenuVisible = !this.isMobilemenuVisible;
        },
    },
};
</script>
<script setup>
import CategoryMenu from "../CategoryMenu.vue";
import CategoryMenuMobile from "../CategoryMenuMobile.vue";
</script>
