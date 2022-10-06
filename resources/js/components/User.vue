<template>
  <div>
      <h2>User</h2>
      <div class="row">
          <div class="col-md-8">
              <nav aria-label="Page navigation example">
                  <ul class="pagination">
                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" style="cursor:pointer;color:blue;" @click="fetchData(pagination.prev_page_url)">Prev</a></li>
                      <li class="page-item disabled"><a class="page-link text-dark" >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" style="cursor:pointer;color:blue;"  @click="fetchData(pagination.next_page_url)">Next</a></li>
                  </ul>
              </nav>
          </div>
          <div class="col-md-4 ">
              <button class="btn btn-info float-right" @click="clearUser()">Add user</button>
          </div>
      </div>
      <div class="card card-body mb-2" v-for="user in users" v-bind:key="user.id">
          <h3>{{ user.name }}</h3>
          <p>{{ user.username }}</p>
          <hr>
          <button @click="editUser(user)" class="btn btn-warning">Edit</button>
          <button @click="deleteUser(user.id)" class="btn btn-danger">Delete</button>
      </div>
      <!-- The Modal -->

      <div class="modal" tabindex="-1" id="userModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Add / Edit User</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <form @submit.prevent="adduser" class="mb-3">
							<div class="mb-3">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Name" v-model ="user.name">
								</div>
							</div>
							<div class="mb-3">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Username" v-model ="user.username">
								</div>
							</div>
							<div class="mb-3">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Email" v-model ="user.email">
								</div>
							</div>
							<div class="mb-3" >
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Permission" v-model ="user.permission">
								</div>
							</div>
                          <button type="submit" class="btn btn-info btn-block">Save</button>
                      </form>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>               
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import { Modal } from "bootstrap";
const appurl = import.meta.env.VITE_APP_URL;

export default {
  name: "User",
  data() {
    return {
      users: [],
      user: {
        id: "",
        name: "",
        username: "",
        email: "",
        permission: "",
      },
      user_id: "",
      pagination: {},
      edit: false,
      modal: null,
	  permission:null
    };
  },
  mounted() {
    console.log("Component mounted.");
    //this.fetchData('/api/users');
    this.modal = new Modal("#userModal");
  },
  created() {
    console.log("Component created.");
    this.fetchData("/api/users_api");
  },
  methods: {
    fetchData(page_url) {
      let vm = this;
      page_url = page_url || "/api/users_api";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.users = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => {
          console.log(err);
        });
    },
	getPermission() {

    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };

      this.pagination = pagination;
    },
    deleteUser(id) {
      if (confirm("Are you sure?")) {
        fetch("/api/user_api/" + id, {
          method: "DELETE",
        })
          .then((res) => res.json())
          .then((data) => {
            alert("user removed!");
            this.fetchData();
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    addUser() {
      if (this.edit === false) {
        //Add
        fetch("/api/user_api/", {
          method: "post",
          body: JSON.stringify(this.user),
          headers: {
            "content-type": "application/json",
          },
        })
          .then((res) => res.json())
          .then((data) => {
            this.user.title = "";
            this.user.body = "";
            alert("user Added");
            this.fetchData();
            this.modal.hide();
          })
          .catch((err) => {
            console.log(err);
          });
      } else {
        //update
        fetch("/api/user_api/", {
          method: "put",
          body: JSON.stringify(this.user),
          headers: {
            "content-type": "application/json",
          },
        })
          .then((res) => res.json())
          .then((data) => {
            this.user.title = "";
            this.user.body = "";
            alert("user Updated");
            this.fetchData();
            this.modal.hide();
          })
          .catch((err) => {
            console.log(err);
          });
        this.edit = false;
      }
    },
    editUser(user) {
      this.edit = true;
      this.user.id = user.id;
      this.user_id = user.id;
      this.user.name = user.name;
      this.user.username = user.username;
      this.user.email = user.email;
      this.user.permission = user.permission;
      this.modal.show();
    },
    clearUser() {
      this.edit = false;
      this.user.id = "";
      this.user_id = "";
      this.user.name = "";
      this.user.username = "";
      this.user.email = "";
      this.user.permission = "";
      this.modal.show();
    },
  },
};
</script>