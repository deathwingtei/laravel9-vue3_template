<template>
    <div>
        <h2>Setting</h2>
        <div class="row">
            <div class="col-md-12 ">
                <button class="btn btn-info float-end  mb-5" @click="clearSetting()">Add Setting</button>
            </div>
        </div>

        <div class="card card-body mb-2" v-for="websitesetting in websitesettings" v-bind:key="websitesetting.id">
            <h3>{{ websitesetting.title }}</h3>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 col-6 mx-auto"><button @click="editSetting(websitesetting)"
                        class="btn btn-warning">Edit</button></div>
                <div class="d-grid gap-2 col-6 mx-auto"><button @click="deleteSetting(websitesetting.id)"
                        class="btn btn-danger btn-block">Delete</button></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12  ">
                <nav aria-label="Page navigation" class="text-center">
                    <ul class="pagination ">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a
                                class="page-link" style="cursor:pointer;color:blue;"
                                @click="fetchSetting(pagination.prev_page_url)">Prev</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark">Page {{ pagination.current_page }}
                                of {{ pagination.last_page }}</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a
                                class="page-link" style="cursor:pointer;color:blue;"
                                @click="fetchSetting(pagination.next_page_url)">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" tabindex="-1" id="settingModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add / Edit Setting</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addSetting" class="mb-3">
                            <div class="mb-3 text-center">
                                <img :src="websitesetting.image" class="img-fluid set_img_websitesetting_admin">
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Title" v-model="websitesetting.title">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-control" placeholder="Page" name="type" id="type"  v-model="websitesetting.type" required>
                                        <option v-for="types in websitesetting_type" :key="types" :value="types">
                                            {{ types }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="content_size" class="form-label">Content Size</label>
                                    <select class="form-control" placeholder="Content Size" name="content_size" id="content_size"  v-model="websitesetting.content_size" required>
                                        <option v-for="size in websitesetting_content_size" :key="size" :value="size">
                                            {{ size }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline"  v-for="canedit in websitesetting_editable_data" :key="canedit">
                                        <input class="form-check-input" type="checkbox" :true-value="[]" :false-value="[]" :id="canedit" 
                                        :checked="websitesetting.editable_data.includes(canedit)"  v-model="websitesetting.editable_data"  :value="canedit">
                                        <label class="form-check-label" :for="canedit">{{ canedit }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="file" name="setting_file" id="setting_file"  @change="handleFileUpload( $event )">
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
    name: 'WebsiteSetting',
    data() {
        return {
            websitesettings: [],
            websitesetting: {
                id: '',
                title: '',
                type: '',
                content_size: '',
                editable_data: [],
                image: '',
            },
            websitesetting_id: '',
            pagination: {},
            websitesetting_type: [
                'page','favicon','site_name','company_name','tel','email'
            ],
            websitesetting_content_size: ['no', 'one', 'many'],
            websitesetting_editable_data: ['title', 'body', 'image'],
            check_edit: "",
            edit: false,
            modal: null,
        }
    },
    mounted() {
        console.log('Component mounted.');
        this.fetchSetting('/local/websitesettings');
        this.modal = new Modal('#settingModal');
    },
    created() {
        console.log('Component created.');
    },
    methods: {
        handleFileUpload( event ){
            this.websitesetting.image = event.target.files[0];
        },
        fetchSetting(page_url) {
            let vm = this;
            page_url = page_url || '/local/websitesettings'
            fetch(page_url, {
                method: "get",
                headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
                },
            })
            .then(res => res.json())
            .then(res => {
                this.websitesettings = res.data;
                vm.makePagination(res.meta, res.links);
            }).catch(err => {
                console.log(err);
            });
                
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
        deleteSetting(id) {
            if (confirm('Are you sure?')) {
                fetch('/local/websitesetting/' + id, {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(res => res.json())
                    .then(data => {
                        alert("Setting removed!");
                        this.fetchSetting();
                    }).catch(err => {
                        console.log(err);
                    })
            }
        },
        addSetting() {
            let formdata = new FormData();

            formdata.append('id', this.websitesetting.id);
            formdata.append('title', this.websitesetting.title);
            formdata.append('type', this.websitesetting.type);
            formdata.append('content_size', this.websitesetting.content_size);
            formdata.append('editable_data', this.websitesetting.editable_data);
            formdata.append('image', this.websitesetting.image);
            if (this.edit === false) {
                //Add
                fetch('/local/websitesetting/', {
                    method: 'post',
                    body: formdata,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(res => res.json())
                    .then(data => {

                        this.websitesetting.id = '';
                        this.websitesetting.title = '';
                        this.websitesetting.type = '';
                        this.websitesetting.content_size = '';
                        this.websitesetting.editable_data = [];
                        this.websitesetting.image = '';
                        alert('Setting Added');

                        this.modal.hide();
                        this.fetchSetting();
                    })
            }
            else {
                //update
                fetch('/local/websitesetting/', {
                    method: 'put',
                    body: formdata,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                }).then(res => res.json())
                    .then(data => {
                        this.websitesetting.id = '';
                        this.websitesetting.title = '';
                        this.websitesetting.type = '';
                        this.websitesetting.content_size = '';
                        this.websitesetting.editable_data = [];
                        this.websitesetting.image = '';
                        alert('Setting Updated');

                        this.modal.hide();
                        this.fetchSetting();
                    }).catch(err => {
                        console.log(err);
                    });
                this.edit = false;
            }
        },
        editSetting(websitesetting) {
            this.edit = true;
            document.querySelector("#setting_file").value = "";
            this.clearSetting();
            this.websitesetting.id = websitesetting.id;
            this.websitesetting_id = websitesetting.id;
            this.websitesetting.title = websitesetting.title;
            this.websitesetting.type = websitesetting.type;
            this.websitesetting.content_size = websitesetting.content_size;
            if (websitesetting.editable_data != null && websitesetting.editable_data != "") {
                this.websitesetting.editable_data = [];
                let chksetting = websitesetting.editable_data.split(",");
                let setitem = [];
                chksetting.forEach(function(item){
                    setitem.push(item);
                });
                this.websitesetting.editable_data = setitem;
            }
            else {
                this.websitesetting.editable_data = [];
            }

            if (websitesetting.image != null && websitesetting.image != "") {
                this.websitesetting.image = appurl + websitesetting.image;
            }
            else {
                this.websitesetting.image = "";
            }

            this.modal.show();
        },
        clearSetting() {
            this.edit = false;
            this.websitesetting.id = '';
            this.websitesetting.title = '';
            this.websitesetting.type = '';
            this.websitesetting.content_size = '';
            this.websitesetting.editable_data = [];
            this.websitesetting.image = '';
            document.querySelector("#setting_file").value = "";
            this.modal.show();
        }
    },
    watch: {

 
        // 
    }
}
</script>