<template>
    <div>
        <h2>Contents</h2>
        <div class="row">
            <div class="col-md-12 ">
                <button class="btn btn-info float-end  mb-5" @click="clearArticle()">Add Article</button>
            </div>
        </div>

        <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
            <h3>{{ article.title }}</h3>
            <p v-html="article.body"></p>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 col-6 mx-auto"><button @click="editArticle(article)"
                        class="btn btn-warning">Edit</button></div>
                <div class="d-grid gap-2 col-6 mx-auto"><button @click="deleteArticle(article.id)"
                        class="btn btn-danger btn-block">Delete</button></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12  ">
                <nav aria-label="Page navigation" class="text-center">
                    <ul class="pagination ">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a
                                class="page-link" style="cursor:pointer;color:blue;"
                                @click="fetchArticles(pagination.prev_page_url)">Prev</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark">Page {{ pagination.current_page }}
                                of {{ pagination.last_page }}</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a
                                class="page-link" style="cursor:pointer;color:blue;"
                                @click="fetchArticles(pagination.next_page_url)">Next</a></li>
                    </ul>
                </nav>
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
                            <div class="mb-3 text-center">
                                <img :src="article.image" class="img-fluid set_img_article_admin">
                            </div>
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
                                <input type="file" name="article_file" id="article_file"  @change="handleFileUpload( $event )">
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

const appurl = import.meta.env.VITE_APP_URL;
export default {
    name: 'Articles',
    data() {
        return {
            articles: [],
            article: {
                id: '',
                title: '',
                body: '',
                image: '',
                file: ''
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
    mounted() {
        console.log('Component mounted.');

        this.fetchArticles('/local/articles');
        this.modal = new Modal('#articleModal');
        // this.modal.addEventListener('hide.bs.modal', function (event) {
        //     this.article.id = '';
        //     this.article_id = '';
        //     this.article.title = '';
        //     this.article.body = '';
        //     this.article.image = '';
        // })
    },
    created() {
        console.log('Component created.');
        //this.fetchArticles('/local/articles');
    },
    methods: {
        handleFileUpload( event ){
            this.article.file = event.target.files[0];
        },
        fetchArticles(page_url) {
            let vm = this;
            page_url = page_url || '/local/articles'
            fetch(page_url, {
                method: "get",
                headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
                },
            })
                .then(res => res.json())
                .then(res => {
                    this.articles = res.data;
                    vm.makePagination(res.meta, res.links);
                }).catch(err => {
                    console.log(err);
                })
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination;
        },
        deleteArticle(id) {
            if (confirm('Are you sure?')) {
                fetch('/local/article/' + id, {
                    method: 'DELETE',
                    headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(res => res.json())
                    .then(data => {
                        alert("Article removed!");
                        this.fetchArticles();
                    }).catch(err => {
                        console.log(err);
                    })
            }
        },
        addArticle() {
            let formdata = new FormData();
            formdata.append('id', this.article.id);
            formdata.append('title', this.article.title);
            formdata.append('body', this.article.body);
            formdata.append('file', this.article.file);
            if (this.edit === false) {
                //Add
                fetch('/local/article/', {
                    method: 'post',
                    body: formdata,
                    headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(res => res.json())
                    .then(data => {
                        console.log(data);
                        this.article.title = '';
                        this.article.body = '';
                        this.article.image = '';
                        alert('Article Added');

                        this.modal.hide();
                        this.fetchArticles();
                    })
            }
            else {
                //update
                fetch('/local/article/', {
                    method: 'put',
                    body: formdata,
                    headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(res => res.json())
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
        editArticle(article) {
            this.edit = true;
            document.querySelector("#article_file").value = "";
            this.clearArticle();
            this.article.id = article.id;
            this.article_id = article.id;
            this.article.title = article.title;
            if (article.body == null) {
                article.body = "";
            }
            this.article.body = article.body;
            if (article.image != null && article.image != "") {
                this.article.image = appurl + article.image;
            }
            else {
                this.article.image = "";
            }

            this.modal.show();
        },
        clearArticle() {
            this.edit = false;
            this.article.id = '';
            this.article_id = '';
            this.article.title = '';
            this.article.body = '';
            this.article.image = '';
            document.querySelector("#article_file").value = "";
            this.modal.show();
        }
    },
    watch: {

 
        // 
    }
}
</script>