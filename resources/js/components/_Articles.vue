<template>
    <div>
        <h2>Articles</h2>
        <div v-if="loading" >
            <strong>Loading</strong>
        </div>
        <div v-else >
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Prev</a></li>
                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>
            <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
                <h3>{{ article.title }}</h3>
                <p>{{ article.body }}</p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                articles:[],
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                article_id: '',
                loading: false,
                pagination: {},
                edit: false
            }
        },
        mounted(){
            console.log('Component mouted.');
            this.getArticles();
        },
        methods: {
            getArticles(page_url){

                this.loading = true;

                page_url = page_url || 'api/articles'
                axios.get(page_url)
                    .then(response => {
                        console.log(response.data.data);
                        this.loading = false;
                        this.articles = response.data.data;
                    }).catch(error => {
                        console.log(error);
                        this.loading = false;
                    }).finally(function(){
                        //alway exe
                        
                    })
            }
        }
    }
</script>