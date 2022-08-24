<template>
    <div>
        <h2>Contents</h2>
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" style="cursor:pointer;color:blue;" @click="fetchArticles(pagination.prev_page_url)">Prev</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark" >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" style="cursor:pointer;color:blue;"  @click="fetchArticles(pagination.next_page_url)">Next</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 ">
                <button class="btn btn-info float-end  mb-5"  @click="clearArticle()">Add Article</button>
            </div>
        </div>

        <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
            <h3>{{ article.title }}</h3>
            <p v-html="article.body"></p>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 col-6 mx-auto"><button @click="editArticle(article)" class="btn btn-warning">Edit</button></div>
                <div class="d-grid gap-2 col-6 mx-auto"><button @click="deleteArticle(article.id)" class="btn btn-danger btn-block">Delete</button></div>
            </div>
        </div>
        <!-- The Modal -->
        <div class="modal" tabindex="-1" id="articleModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                     <h4 class="modal-title">Add / Edit Article</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addArticle" class="mb-3">
                        <div class="mb-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Title" v-model="article.title">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <ckeditor :editor="editor" v-model="article.body" :config="editorConfig"></ckeditor>
                                <!-- <textarea class="form-control" id="main_content" placeholder="Description" v-model="article.body"></textarea> -->
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="file" >
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Modal } from 'bootstrap'
 

    export default {
        name: 'Articles',
        data(){
            return {
                articles:[],
                article: {
                    id: '',
                    title: '',
                    body: '',
                    image: ''
                },
                article_id: '',
                pagination: {},
                edit: false,
                modal: null,
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.

                    toolbar: {
                      items: [
                            'sourceEditing',
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            '|',
                            'undo',
                            'redo',
         
                        ]
                    }
                }
            }
        },
        mounted(){
            console.log('Component mounted.');
            this.fetchArticles('/api/articles');
            this.modal = new Modal('#articleModal');
        },
        created(){
            console.log('Component created.');
            //this.fetchArticles('/api/articles');
        },
        methods: {
            fetchArticles(page_url){
                let vm = this;
                page_url = page_url || '/api/articles'
                fetch(page_url)
                .then(res => res.json())
                .then(res =>{
                    this.articles = res.data;
                    vm.makePagination(res.meta,res.links);
                }).catch(err => {
                    console.log(err);
                })
            },
            makePagination(meta,links){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }

                this.pagination = pagination;
            },
            deleteArticle(id){
                if(confirm('Are you sure?')){
                    fetch('/api/article/'+id,{
                        method: 'DELETE'
                    }).then(res => res.json())
                    .then(data => {
                        alert("Article removed!");
                        this.fetchArticles();
                    }).catch(err => {
                        console.log(err);
                    })
                }
            },
            addArticle(){
                if(this.edit === false)
                {
                    //Add
                    fetch('/api/article/',{
                        method: 'post',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    }).then(res=>res.json())
                    .then(data => {
                        this.article.title = '';
                        this.article.body = '';
                        this.article.image = '';
                        alert('Article Added');
                        
                        this.modal.hide();
                        this.fetchArticles();
                    }).catch(err => {
                        console.log(err);
                    });
                }
                else
                {
                    //update
                    fetch('/api/article/',{
                        method: 'put',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    }).then(res=>res.json())
                    .then(data => {
                        this.article.title = '';
                        this.article.body = '';
                        this.article.image = '';
                        alert('Article Updated');
                        
                        this.modal.hide();
                        this.fetchArticles();
                    }).catch(err => {
                        console.log(err);
                    });
                    this.edit = false;
                }
            },
            editArticle(article){
                this.edit = true;
                this.article.id = article.id;
                this.article_id = article.id;
                this.article.title = article.title;
                this.article.body = article.body;
                this.article.image = article.image;
                this. modal.show();
            },
            clearArticle(){
                this.edit = false;
                this.article.id = '';
                this.article_id = '';
                this.article.title = '';
                this.article.body = '';
                this.article.image = '';

                this.modal.show();
            }
        }
    }
</script>