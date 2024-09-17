<template>
    <!-- Slider -->
    <section id="product-slider">
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <!-- <img
                        src="assets/images/main-slider/5.jpg"
                        alt="Product 1"
                    /> -->
                    <div class="swiper-slide-content">
                        <h2
                            class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4"
                        >
                            Women
                        </h2>
                        <p class="mb-4 text-white md:text-2xl">
                            Experience the best in sportswear with <br />our
                            latest collection.
                        </p>
                        <a
                            href="/"
                            class="bg-primary hover:bg-transparent text-white hover:text-white border border-transparent hover:border-white font-semibold px-4 py-2 rounded-full inline-block"
                            >Shop now</a
                        >
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <!-- <img
                        src="assets/images/main-slider/2.png"
                        alt="Product 2"
                    /> -->
                    <div class="swiper-slide-content">
                        <h2
                            class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4"
                        >
                            Men
                        </h2>
                        <p class="mb-4 text-white md:text-2xl">
                            Discover the latest trends in Men`s <br />sportswear
                            and casual fashion.
                        </p>
                        <a
                            href="/"
                            class="bg-white hover:bg-transparent text-black hover:text-white font-semibold px-4 py-2 rounded-full inline-block border border-transparent hover:border-white"
                            >Shop now</a
                        >
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <!-- <img
                        src="assets/images/main-slider/4.jpg"
                        alt="Product 3"
                    /> -->
                    <div class="swiper-slide-content">
                        <h2
                            class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4"
                        >
                            Accessories
                        </h2>
                        <p class="mb-4 text-white md:text-2xl">
                            Elevate your style with our latest <br />sportswear
                            collection.
                        </p>
                        <a
                            href="/"
                            class="bg-primary hover:bg-transparent text-white hover:text-white border border-transparent hover:border-white font-semibold px-4 py-2 rounded-full inline-block"
                            >Shop now</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Pagination -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </section>

    <!-- Product banner section -->
    <section id="product-banners">
        <div class="container mx-auto py-10">
            <div class="flex flex-wrap -mx-4">
                <!-- Category 1 -->
                <div class="w-full sm:w-1/3 px-4 mb-8">
                    <div
                        class="category-banner relative overflow-hidden rounded-lg shadow-lg group"
                    >
                        <!-- <img
                            src="/assets/images/cat-image1.jpg"
                            alt="Category 1"
                            class="w-full h-auto"
                        /> -->
                        <div
                            class="absolute inset-0 bg-gray-light bg-opacity-50"
                        ></div>
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4"
                        >
                            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                                Men
                            </h2>
                            <a
                                href="/"
                                class="bg-primary hover:bg-transparent border border-transparent hover:border-white text-white hover:text-white font-semibold px-4 py-2 rounded-full inline-block"
                                >Shop now</a
                            >
                        </div>
                    </div>
                </div>
                <!-- Category 2 -->
                <div class="w-full sm:w-1/3 px-4 mb-8">
                    <div
                        class="category-banner relative overflow-hidden rounded-lg shadow-lg group"
                    >
                        <!-- <img
                            src="/assets/images/cat-image4.jpg"
                            alt="Category 2"
                            class="w-full h-auto"
                        /> -->
                        <div
                            class="absolute inset-0 bg-gray-light bg-opacity-50"
                        ></div>
                        <div
                            class="category-text absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4 transition duration-300"
                        >
                            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                                Women
                            </h2>
                            <a
                                href="/"
                                class="bg-primary hover:bg-transparent border border-transparent hover:border-white text-white hover:text-white font-semibold px-4 py-2 rounded-full inline-block"
                                >Shop now</a
                            >
                        </div>
                    </div>
                </div>
                <!-- Category 3 -->
                <div class="w-full sm:w-1/3 px-4 mb-8">
                    <div
                        class="category-banner relative overflow-hidden rounded-lg shadow-lg group"
                    >
                        <!-- <img
                            src="/assets/images/cat-image5.jpg"
                            alt="Category 3"
                            class="w-full h-auto"
                        /> -->
                        <div
                            class="absolute inset-0 bg-gray-light bg-opacity-50"
                        ></div>
                        <div
                            class="category-text absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4 transition duration-300"
                        >
                            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                                Accessories
                            </h2>
                            <a
                                href="/"
                                class="bg-primary hover:bg-transparent border border-transparent hover:border-white text-white hover:text-white font-semibold px-4 py-2 rounded-full inline-block"
                                >Shop now</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <HeroSliderNewVue
    :hero_carousel="JSON.parse(homePageContent.hero_carousel_url)"
  ></HeroSliderNewVue>
  <CategoryList :categories="categories"></CategoryList>
  <ProductsIndex
    :products="productBestSellers"
    :title="'Best Sellers'"
    :cols="4"
    class="mb-10"
  ></ProductsIndex> -->
</template>
<!-- <script>
export default {
    props: ["homePageContent", "categories", "productBestSellers"],
};
</script>
<script setup>
import CategoryList from "../../Shared/HomePageComponents/CategoryList.vue";
import HeroSliderNewVue from "../../Shared/HomePageComponents/HeroSliderNew.vue";
import ProductsIndex from "./Products/ProductsIndex.vue";
</script> -->
