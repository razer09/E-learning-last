<template>

    <div class="container mt-4">
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
         <div class="row m-5">
            <nav aria-label="Page navigation example text-center">
                  <ul class="pagination">
                    <li class="page-item"
                        :class="[{disabled: !pagination.prev_page}]">
                        <a class="page-link" href="#"
                            @click.prev="fetchall(pagination.prev_page)">
                            Previous
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                           Page {{pagination.current_page}} of {{pagination.last_page}}
                        </a>
                    </li>
                    <li class="page-item"
                        :class="[{disabled: !pagination.next_page}]">
                        <a class="page-link" href="#"
                            @click.prev="fetchall(pagination.next_page)" >
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 mt-3 mb-3" v-for="(tag, index) in tags"
                 :key="tag.id">
                <div class="card">
                    <div class="card-header">
                        {{tag.name}}
                    </div>

                    <div class="card-body">
                        {{tag.label}}
                    </div>
                    <a href="#" @click.prevent="onEdit(tag)" class="btn btn-success mb-2">Edit</a>
                    <a href="#" @click.prevent="onDelete(tag.id, index)" class="btn btn-danger">delete</a>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                tags: [],
                tag: {
                    id: '',
                    name: '',
                    label: ''
                },
                id: '',
                name: '',
                label: '',
                pagination: {},
                edit: false
            }
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
                    axios.post('/api/tag',{
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
                    axios.put('/api/tag/'+this.id ,{
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
            onDelete(id, index){
                axios.delete('/api/tag/'+id)
                .then(res => this.fetchall())
                //.then(res => this.tags.splice(index, 1)) delete from array
                }
        }
    }
</script>
