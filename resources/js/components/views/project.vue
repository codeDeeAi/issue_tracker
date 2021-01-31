<template>
    <div class="container-fluid">
       <nav>
           <div class="container-fluid">
               <div class="grid grid-cols-2 gap-10 py-2">
                   <div class="flex justify-between">
                       <p class="lead font-semibold">{{project_name}}</p>
                       <div>
                           <a href="#!" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add new" @click="createNew"><i class="fa fa-plus"></i></a>
                           <a href="#!" class="btn btn-sm"><i class="fa fa-plus"></i></a>
                           <a href="#!" class="btn btn-sm"><i class="fa fa-plus"></i></a>
                       </div>
                   </div>
                   <div class="flex justify-between">
                       <p class="lead font-semibold">AUTHOR :: <span v-for="(author, auth) in author" :key="auth">{{author.admin.name}}</span></p>
                        <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-tools"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" @click="openCollaborators()">Add collaborator</a>
                            <a class="dropdown-item" href="#">Remove collaborator</a>
                            <a class="dropdown-item" href="#">Delete Project</a>
                        </div>
                        </div>
                        <a href="#!" class="btn btn-sm btn-primary" @click="toggleTray()"><i class="fa fa-search"></i></a>
                   </div>
               </div>
               <div v-if="opentray == true" class="py-6 bg-blue-500">

               </div>
           </div>
       </nav>

       <!-- Table -->
       <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Module</th>
            <th scope="col">Issue</th>
            <th scope="col">QA user</th>
            <th scope="col">Date Logged</th>
            <th scope="col">QA status</th>
            <th scope="col">Dev user</th>
            <th scope="col">Dev status</th>
            <th scope="col">Date Fixed</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(log, i) in data" :key="i">
            <th scope="row">{{log.id}}</th>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" :placeholder="log.module" v-model="post.module" autofocus @change="updateModule(log,i)">
                </div>
            </td>
            <td>Otto</td>
            <td>
                <pre @click="openQA(log, i)"><span v-if="log.qa !== null">{{log.qa.name}}</span><span v-if="log.qa == null">None</span></pre>
            </td>
            <td>Mark</td>
            <td><pre @click="openQaStatusModal(log, i)" class="cursor-pointer">{{log.qa_status}}</pre></td>
            <td>@mdo</td>
            <td><pre @click="openDevStatusModal(log, i)" class="cursor-pointer">{{log.dev_status}}</pre></td>
            <td>Otto</td>
            <td class="flex justify-between">
                <a href="#!" class="btn btn-sm btn-secondary"><i class="fa fa-plus-circle"></i></a>
                <a href="#!" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
            </td>
            </tr>
        </tbody>
        </table>
       <!-- Table Ends -->
       <!-- Modals -->
       <!-- Collaborators Modal -->
        <div class="modal fade" id="collaboratorsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-4">            
            <div class="modal-body container border rounded-tr-2xl rounded-bl-2xl py-1 my-4">
              <div class="flex justify-end">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="">
                <div class="py-3">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="user@email.com" v-model="searchUser">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" @click="getUser()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item flex justify-between" v-for="(user, u) in allSearchedUsers " :key="u">
                            <span>{{user.name}}, {{user.email}}</span>
                            <a href="#!" class="btn btn-sm btn-primary" @click="addCollaborator(user, u)"><i class="fa fa-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- Collaborators Modal Ends -->
        <!-- QA Status Modal -->
        <div class="modal fade" id="qaStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-4">            
            <div class="modal-body container border rounded-tr-2xl rounded-bl-2xl py-1 my-4">
              <div class="flex justify-end">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="">
                <div class="">
                    <div class="form-group">
                        <label>Choose one</label>
                        <select v-model="post.qaStat.value" @change="updateQaStatus()" class="form-control" autofocus>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="unresolved">Unresolved</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- QA Status Modal Ends -->
        <!-- Dev Status Modal -->
        <div class="modal fade" id="devStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-4">            
            <div class="modal-body container border rounded-tr-2xl rounded-bl-2xl py-1 my-4">
              <div class="flex justify-end">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="">
                <div class="form-group">
                    <label>Choose one</label>
                    <select v-model="post.devStat.value" @change="updateDevStatus()" class="form-control" autofocus>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="unresolved">Unresolved</option>
                    </select>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- Dev Status Modal Ends -->
        <!-- QA user Modal -->
        <div class="modal fade" id="qaUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-4">            
            <div class="modal-body container border rounded-tr-2xl rounded-bl-2xl py-1 my-4">
              <div class="flex justify-end">
                <a href="#!" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="">
                <div class="">
                    <div class="form-group">
                        <label>Choose one</label>
                        <select v-model="post.qaUser.value" class="form-control" autofocus @change="updateQaUser()">
                            <option v-for="(coll, col) in collaborators" :key="col" :value="coll.user_id">{{coll.user[0].name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- QA user Modal Ends -->
       <!-- Modals ends -->
    </div>
</template>
<script>
export default {
    props:[
        'project_id',
        'project_name'
    ],
    data(){
        return{
            opentray: false,
            data:{},
            author:[],
            collaborators:[],
            post:{
                module:'',
                qaStat:{
                    id: null,
                    value: ''
                },
                devStat:{
                    id: null,
                    value: ''
                },
                qaUser:{
                    id: null,
                    value: null,
                },
                devUser:{
                    id: null,
                    value: null,
                },

            },
            searchUser:'',
            allSearchedUsers:[

            ]
        }
    },
    methods: {
        /**
         * Get initial data
         */
        async fetchData(){
            const res = await this.callApi(
                'get',
                `app/get_all_project_issues/${this.project_id}`,
                this.project_id
            )
            if (res.status == 200)
                return this.data = res.data
            else
                return this.toastError('Something went wrong')
        },
        /**
         * Get Project Admin/Author
         */
         async fetchProjectAuthor(){
            const res = await this.callApi(
                'get',
                `app/get_project_author/${this.project_id}`,
                this.post
            )
            if(res.status == 200)
                return this.author = res.data
        },
        /** 
         * Get all collaborators
        */
       async fetchCollaborators(){
           const res = await this.callApi(
                'get',
                `app/get_project_collaborators/${this.project_id}`,
                this.post
            )
            if(res.status == 200)
                return this.collaborators = res.data
       },
       /**
        * Get / Search for  User
        */
       async getUser(){
           const res = await this.callApi(
                'get',
                `app/get_search_users/${this.searchUser}`,
                this.post
            )
            if(res.status == 200)
                return  this.allSearchedUsers = res.data
       },
        /**
         * Toggle search navigation
         */
        toggleTray(){
            if(this.opentray == false)
                return this.opentray = true
            else
                return this.opentray = false
        },
        /**
         * Create new line/issue
         */
        async createNew(){
            const res = await this.callApi(
                'post',
                'app/create_new_issue',
                {
                    'project_id' : this.project_id
                }
            )
            if(res.status == 200)
                this.fetchData()
        },
        /**
         * Update Module
         */
        async updateModule(log, i){
            const res = await this.callApi(
                'put',
                'app/update_issue_module',
                {
                    id: log.id,
                    value: this.post.module
                }
            )
            if(res.status == 200)
                return this.fetchData()
                // return this.data.unshift(log)
        },
        /**
         * Open Collaborators Modal
         */
        openCollaborators(){
            $('#collaboratorsModal').modal('show')
        },
        /**
         * Add Collaborators
         */
        async addCollaborator(user, u){
            const res = await this.callApi(
                'put',
                'app/add_collaborator_to_project',
                {
                    'user_id' : user.id,
                    'project_id' : this.project_id
                }
            )
            if(res.status == 200){
                this.toast(`${user.name} has been added as a collaborator`, 'success')
                return this.fetchCollaborators()
            } else if (res.status == 403){
                this.toastError(res.data.message)
            }
        },
        /**
         * Open QA users modal
         */
        openQA(log, i){
            /**
             * Assign Issue ID to post data
             */
            this.post.qaUser.id = log.id
            /**
             * Open QA Modal
             */
            $('#qaUserModal').modal('show')
        },
        /**
         * Update QA User
         */
        async updateQaUser(){
            const res = await this.callApi(
                'put',
                'app/update_issue_qa_user',
                this.post.qaUser
            )
            if(res.status == 200)
                $('#qaUserModal').modal('hide')
                return this.fetchData()
        },
        /** 
         * Open QA Status Modal
         */
        openQaStatusModal(log, i){
            /** Add ID to post data */
            this.post.qaStat.id = log.id
            /** Open Modal */
            $('#qaStatusModal').modal('show')
        },
        /**
         * Update QA Status
         */
        async updateQaStatus(){
            const res = await this.callApi(
                'put',
                'app/update_issue_qa_status',
                this.post.qaStat
            )
            if(res.status == 200)
                $('#qaStatusModal').modal('hide')
                return this.fetchData()
        },
        /**
         * Open Dev Status Modal
         */
        openDevStatusModal(log, i){
            /** Add ID to post data */
            this.post.devStat.id = log.id
            /** Open Modal */
            $('#devStatusModal').modal('show')
        },
        /**
         * Update Dev Status 
         */
        async updateDevStatus(){
            const res = await this.callApi(
                'put',
                'app/update_issue_dev_status',
                this.post.devStat
            )
            if(res.status == 200)
                $('#devStatusModal').modal('hide')
                return this.fetchData()
        },
        
    },
    created(){
        this.fetchData()
        this.fetchProjectAuthor()
        this.fetchCollaborators()
    },
    mounted(){
        
    }
}
</script>
