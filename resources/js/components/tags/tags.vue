<template>
    <div>
        <!-- Pagination -->
        <div class="row m-5">
            <nav aria-label="Page navigation example text-center">
                <ul class="pagination">
                    <li
                        class="page-item"
                        :class="[{ disabled: !pagination.prev_page }]"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click.prev="
                                $emit('fetchall', pagination.prev_page)
                            "
                        >
                            Previous
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            Page {{ pagination.current_page }} of
                            {{ pagination.last_page }}
                        </a>
                    </li>
                    <li
                        class="page-item"
                        :class="[{ disabled: !pagination.next_page }]"
                    >
                        <a
                            class="page-link"
                            href="#"
                            @click.prev="
                                $emit('fetchall', pagination.next_page)
                            "
                        >
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- All Tags -->
        <div class="row justify-content-center">
            <div class="col-md-4 mt-3 mb-3" v-for="tag in tags" :key="tag.id">
                <div class="card">
                    <div class="card-header">
                        {{ tag.name }}
                    </div>

                    <div class="card-body">
                        {{ tag.label }}
                    </div>
                    <a
                        href="#"
                        @click.prevent="$emit('onEdit', tag)"
                        class="btn btn-success mb-2"
                        >Edit</a
                    >
                    <a
                        href="#"
                        @click.prevent="$emit('onDelete', tag.id)"
                        class="btn btn-danger"
                        >delete</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import { mapGetters } from "vuex";

export default {
    props: ["tags", "pagination"],
    data() {
        return {
                id: "",
            name: "",
            label: "",
        };
    },
};
</script>
