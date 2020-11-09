<template>
    <div class="d-flex justify-content-start tags mb-5">
        <div class="tag rounded d-flex mr-5"
             v-if="paginationTag.prev_page"
             @click.prev="fetchTags(paginationTag.prev_page)">
            <span class="bg-white p-2 px-3 rounded-pill border shadow-sm">
                <i class="fa fa-arrow-left"></i>
            </span>
        </div>
        <div v-for="tag in tags" :key="tag.id"
             class="tag rounded text-nowrap d-flex mr-5" >

            <span class="bg-primary p-2 rounded-left text-white shadow-sm">
                <i class="fa fa-code"></i>
            </span>
            <span class="main p-2 px-3 bg-white rounded-right shadow-sm">
            {{tag.name}}
            </span>
        </div>
        <div class="tag rounded d-flex mr-5"
             v-if="paginationTag.next_page"
             @click.prev="fetchTags(paginationTag.next_page)">
            <span class="bg-white p-2 px-3 rounded-pill border shadow-sm">
                <i class="fa fa-arrow-right"></i>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        //props: ['allTags', 'pagination'],
        data() {
            return {
                tags: [],
                paginationTag: {},
            };
        },
        created(){
            this.fetchTags();
        },
        methods: {
            fetchTags(page_url = '/api/tags'){

                let vm = this;

                axios.get(page_url)
                 .then( ({data: res}) => {
                    this.tags = res.data;

                    vm.makePagination(res.meta, res.links, 'paginationTag');

                });
            },
            makePagination(meta, link, pagName){
                let pagination = {
                    current_page : meta.current_page,
                    last_page    : meta.last_page,
                    prev_page    : link.prev,
                    next_page    : link.next
                };

                this[pagName]  = pagination;
            },
        }
    }
</script>
