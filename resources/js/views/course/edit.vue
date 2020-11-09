<template>
  <div>
    <div class="container settings-page mb-4 mt-4">
      <h2 class="mb-4">Create New course</h2>
      <div class="settings shadow-sm">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true"
            >General</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#notification"     role="tab" aria-controls="profile" aria-selected="false"
                :class="{ disabled: !course_id }"
            >Sections</a>
          </li>
        </ul>
        <div class="tab-content bg-white" id="myTabContent">
          <div class="tab-pane fade show active" id="profile">
            <general-learn :course_id.sync="course_id" :edits="true">
            </general-learn>

          </div>

            <sections-learn :course_id="course_id">
            </sections-learn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import generalLearn from '../../components/courses/create/general.vue';
    import sectionsLearn from '../../components/courses/create/sections.vue';
export default {
    data() {
        return {
          teacher: {},
          tags: [],
          course_id: "",
          edits: true
        };
    },
    created() {
        this.getCourse();

      //this.fetchAllSection();
    },
    methods: {
        getCourse(){
            this.course_id = this.$route.params.id;

        }

    },
    components: {
        generalLearn,
        sectionsLearn
    }
};
</script>

<style>
.fa-pencil,
.fa-trash {
  cursor: pointer;
}
</style>
