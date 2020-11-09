<template>
    <b-tab title-item-class="reviews" title="Reviews" class="p-4" >
        <div class="row">
            <div class="col-5 border p-4">
                <h3>Reviews</h3>
                <b-form-rating :value="avgRating" class="mb-4" readonly show-value precision="1" variant="warning" size="lg"></b-form-rating>
                <div class="d-flex align-items-center justify-content-center">
                    <b-progress :value="fiveStar" :max="nbrRating" variant="danger" class="w-50" show-progress>
                        <b-progress-bar :value="fiveStar" :label="`${((fiveStar / nbrRating) * 100).toFixed()} %`"></b-progress-bar>
                    </b-progress>
                    <b-form-rating value="5" inline no-border readonly variant="warning"></b-form-rating>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <b-progress :value="fourStar" :max="nbrRating" variant="danger" class="w-50" show-progress>
                        <b-progress-bar :value="fourStar" :label="`${((fourStar / nbrRating) * 100).toFixed()} %`"></b-progress-bar>
                    </b-progress>
                    <b-form-rating value="4" inline no-border readonly variant="warning"></b-form-rating>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <b-progress :value="threeStar" :max="nbrRating" variant="danger" class="w-50" show-progress>
                        <b-progress-bar :value="threeStar" :label="`${((threeStar / nbrRating) * 100).toFixed()} %`"></b-progress-bar>
                    </b-progress>
                    <b-form-rating value="3" inline no-border readonly variant="warning"></b-form-rating>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <b-progress :value="towStar" :max="nbrRating" variant="danger" class="w-50" show-progress>
                        <b-progress-bar :value="towStar" :label="`${((towStar / nbrRating) * 100).toFixed()} %`"></b-progress-bar>
                    </b-progress>
                    <b-form-rating value="2" inline no-border readonly variant="warning"></b-form-rating>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <b-progress :value="oneStar" :max="nbrRating" variant="danger" class="w-50" show-progress>
                        <b-progress-bar :value="oneStar" :label="`${((oneStar / nbrRating) * 100).toFixed()} %`"></b-progress-bar>
                    </b-progress>
                    <b-form-rating value="1" inline no-border readonly variant="warning"></b-form-rating>
                </div>
                <div class="mt-4 border-top pt-3 pb-2">
                    <h3 class="mb-3">Your Review</h3>
                    <b-form-rating v-model="rating" variant="warning"></b-form-rating>
                    <b-form-textarea
                        id="textarea"
                        class="mt-3"
                        v-model="review"
                        placeholder="Enter something..."
                        rows="5"
                        max-rows="6"
                    >
                    </b-form-textarea>
                    <b-overlay
                        :show="busy"
                        rounded
                        spinner-variant="primary"
                        opacity="0.6"
                        spinner-small
                        class="d-inline-block mb-3"
                    >
                        <div class="btn btn-primary mt-2" @click="submitReview">Submit Review</div>
                    </b-overlay>
                </div>
            </div>
            <div class="col-7 border p-4">
                <h3>Students Feedback</h3>
                <div v-for="review in reviews" class="review border-top border-bottom">
                    <div class="head d-flex align-items-center">
                        <img thmbnail class="rounded-circle mr-3" :src="review.thubnail"
                        style="width: 50px; height: 50px;">
                        <div class="mt-3">
                            <b>{{review.name}}</b>
                            <p style="font-size: 13px !important">4 days ago</p>
                        </div>
                    </div>
                    <b-form-rating :value="review.rating" no-border readonly inline class="mb-1" variant="warning"></b-form-rating>
                    <p>
                        {{review.review}}
                    </p>
                </div>
            </div>
        </div>
    </b-tab>
</template>

<script>
export default {
    props: ['course_id'],
    data() {
        return {
            reviews: [],
            busy: false,
            rating: 5,
            review: '',
        };
    },
    computed: {
        user_id(){
            return this.$store.getters.user.id;
        },
        nbrRating(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                total += 1;
            });
            return total;
        },
        avgRating(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                total += element.rating;
            });

            let avg = total / (this.reviews.length);
            return avg.toFixed(1);
        },
        fiveStar(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                if(element.rating == 5) total += 1;
            });
            return total;
        },
        fourStar(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                if(element.rating == 4) total += 1;
            });
            return total;
        },
        threeStar(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                if(element.rating == 3) total += 1;
            });
            return total;
        },
        towStar(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                if(element.rating == 2) total += 1;
            });
            return total;
        },
        oneStar(){
            var total = 0;
            this.reviews.forEach( function(element, index) {
                if(element.rating == 1) total += 1;
            });
            return total;
        },
    },
    created(){
        this.fetchRating();
    },
    methods: {
        fetchRating(page_url = "/api/Reviews/" + this.course_id) {
            this.busy = true;
            let vm = this;
            axios.get(page_url).then(({ data: res }) => {
                this.reviews = res.data;
                this.setUserReview(res.data);
                this.busy = false;
            });

        },
        setUserReview(data){
            data.forEach( (element) => {
                if(element.user_id == 1){
                    this.rating = element.rating;
                    this.review = element.review;
                }
            });
        },
        submitReview(){
            axios.post('/api/Reviews',{
                user: this.user_id,
                course: this.course_id,
                rating: this.rating,
                review: this.review,
            })
            .then(res => {
                this.fetchRating();
            });
        }
    }
};
</script>
