<template>
    <div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="mx-auto max-w-2xl pt-12 sm:pt-16 lg:max-w-none lg:pt-32"
            >
                <h2 class="text-2xl font-bold text-gray-900">Categories</h2>

                <div class="mt-6">
                    <vueper-slides
                        class="no-shadow"
                        :bullets="false"
                        :arrows="true"
                        fixed-height="370px"
                        :visible-slides="4"
                        :touchable="false"
                        slide-multiple
                        :gap="3"
                        :slide-ratio="1 / 4"
                        :dragging-distance="200"
                        :breakpoints="{
                            800: { visibleSlides: 2, slideMultiple: 2 },
                        }"
                    >
                        <vueper-slide
                            v-for="category in categories"
                            :key="category.name"
                        >
                            <template #content>
                                <div class="relative h-100 w-full">
                                    <div
                                        class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64"
                                    >
                                        <img
                                            :src="category.category_image_url"
                                            :alt="category.category_image_url"
                                            class="h-full w-full object-cover object-center"
                                        />
                                    </div>
                                    <h3 class="mt-6 text-sm text-gray-500">
                                        <a :href="category.link">
                                            <span class="absolute inset-0" />
                                            {{ category.name }}
                                        </a>
                                    </h3>
                                </div>
                            </template>
                        </vueper-slide>
                    </vueper-slides>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
export default {
    components: { VueperSlides, VueperSlide },
    props: ["categories"],
};
</script>

<style>
.vueperslides__arrow {
    font-size: 10px;
}
</style>
