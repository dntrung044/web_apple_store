<template>
    <div
        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
    >
        <SearchBar
            v-model="search"
            v-if="enableFilters.search"
            :searchPlaceHolderText="searchPlaceHolder"
        ></SearchBar>

        <DaterangePicker
            v-if="enableFilters.dateRange"
            :dateStart="dateStart"
            :dateEnd="dateEnd"
            @dateChanged="dateRangePick"
        ></DaterangePicker>

        <SortDropdown
            v-model="sortBy"
            v-if="enableFilters.sortBy"
            :sortByFilters="sortByFilters"
        ></SortDropdown>

        <FilterDropdown
            :filters="filters"
            @filterByFilterChangeEmit="filterByFilterChange"
            v-if="enableFilters.filterBy"
            :enableFilterByFilters="enableFilters.filterBy"
        ></FilterDropdown>
    </div>
</template>

<script>
import debounce from "lodash/debounce";
import { router } from "@inertiajs/core";
export default {
    props: [
        "dataName",
        "filters",
        "enableFilters",
        "searchPlaceHolder",
        "currentPage",
        "sortByFilters",
        "sendToUrl",
    ],
    data() {
        return {
            search:
                this.filters.search !== undefined ? this.filters.search : "",
            dateStart:
                this.filters.dateStart !== undefined
                    ? decodeURIComponent(this.filters.dateStart)
                    : "",
            dateEnd:
                this.filters.dateEnd !== undefined
                    ? decodeURIComponent(this.filters.dateEnd)
                    : "",
            sortBy:
                this.filters.sortBy !== undefined ? this.filters.sortBy : "",
            filterByFilter: {},
            filterQueries: {},
            url: this.sendToUrl ?? "/dashboard",
        };
    },

    watch: {
        search: debounce(function () {
            this.filterResults();
        }, 300),
        dateStart() {
            this.filterResults();
        },
        dateEnd() {
            this.filterResults();
        },
        sortBy() {
            this.filterResults();
        },
    },
    methods: {
        dateRangePick(dateRange) {
            this.dateStart = dateRange.getDates("mm/dd/yyyy")[0];
            this.dateEnd = dateRange.getDates("mm/dd/yyyy")[1];
        },
        filterByFilterChange(n) {
            this.filterByFilter = n;
            this.filterResults();
        },
        filterResults() {
            this.filterQueries = {};
            if (this.search !== "") {
                this.filterQueries.search = this.search;
            }
            if (this.dateStart !== "" || this.dateEnd !== "") {
                this.filterQueries.dateStart = this.dateStart;
                this.filterQueries.dateEnd = this.dateEnd;
            }
            if (this.sortBy !== "") {
                console.log(this.filterQueries);

                this.filterQueries.sortBy = this.sortBy;
            }
            if (this.currentPage > 1) {
                this.filterQueries.page = this.currentPage;
            }
            Object.assign(this.filterQueries, this.filterByFilter);

            router.get(`${this.url}/${this.dataName}`, this.filterQueries, {
                preserveState: true,
                replace: true,
            });
        },
    },
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import SearchBar from "../Filters/SearchBar.vue";
import DaterangePicker from "../Filters/DaterangePicker.vue";
import SortDropdown from "../Filters/SortDropdown.vue";
import FilterDropdown from "../Filters/FilterDropdown.vue";
onMounted(() => {
    initFlowbite();
});
</script>
