<template>
    <div class="container mt-4">
        <h2>Hellow every body </h2>
        <div class="row">
            <div class="container">
                <div class="col-8">
                    <form method="POST" action="/api/tags"
                            @submit.prevent="onSubmit">

                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                Tag name
                            </label>
                            <input  name="name"
                                    type="text"
                                    class="form-control"
                                    v-model="name"
                            >
                            <small class="text-danger">

                            </small>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                Label
                            </label>
                            <input  name="label"
                                    type="text"
                                    class="form-control"
                                    v-model="label"
                            >
                            <small class="text-danger">

                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ edit==true? 'Edit': 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <app-tags :tags="tags" :pagination="pagination"
                  @onEdit="onEdit" @onDelete="onDelete" @fetchall="fetchall">
        </app-tags>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';
    import {mapGetters} from 'vuex';
    import tags from '../components/tags/tags.vue';

    export default {
        data() {
            return {
                tags: [],
                id: '',
                name: '',
                label: '',
                pagination: {},
                edit: false
            };
        },
        created(){
            this.fetchall();
        },
        methods: {
            fetchall(page_url = '/api/tags'){

                let vm = this;

                axios.get(page_url)
                 .then( ({data: res}) => {
                    this.tags = res.data;

                    vm.makePagination(res.meta, res.links);
                });
            },
            makePagination(meta, link){
                let pagination = {
                    current_page : meta.current_page,
                    last_page    : meta.last_page,
                    prev_page    : link.prev,
                    next_page    : link.next
                };

                this.pagination = pagination;
            },
            onSubmit(){

                if (this.edit === false) {
                    // Add
                    axios.post('/api/tags',{
                        name: this.name,
                        label: this.label
                    })
                    .then(res => {
                        this.fetchall();
                        this.name = '';
                        this.label = '';
                    });

                }else{
                    // Update
                    axios.put('/api/tags/'+this.id ,{
                        name: this.name,
                        label: this.label
                    })
                    .then(res => {
                        this.fetchall();
                        this.name = '';
                        this.label = '';
                    });
                    this.edit = false;
                }

            },
            onEdit(tag){
                this.edit   = true;
                this.id     = tag.id;
                this.name   = tag.name;
                this.label  = tag.label;
            },
            onDelete(id){
                axios.delete('/api/tags/'+id)
                .then(res => this.fetchall())
                }
        },
        components: {
            appTags: tags
        }
    }
</script>
