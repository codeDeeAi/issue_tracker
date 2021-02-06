<template>
    <div class="container-fluid">
       <nav>
           <div class="container-fluid">
               <div class="grid grid-cols-2 gap-10 py-2">
                   <div class="flex justify-between">
                       <p class="lead font-semibold">{{project_name}}</p>
                       <div>
                           <a href="#!" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add new" @click="createNew"><i class="fa fa-plus"></i></a>
                           <download-excel :data="data" :worksheet="project_name" :fields="json_fields" :name="project_name"  href="#!" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Export sheet"><i class="fa fa-file-export"></i></download-excel>
                       </div>
                   </div>
                   <div class="flex justify-between">
                       <p class="lead font-semibold">AUTHOR :: <span v-for="(author, auth) in author" :key="`new-${auth}`">{{author.admin.name}}</span></p>
                        <div class="flex justify-end gap-2">
                            <div class="dropdown dropleft">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-tools"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#" @click="openCollaborators()">Add collaborator</a>
                                <a class="dropdown-item" href="#" @click="openRemoveCollaborators()">Remove collaborator</a>
                                <a class="dropdown-item" href="#" @click="deleteProject()">Delete Project</a>
                            </div>
                            </div>
                            <a href="#!" class="btn btn-sm btn-primary" @click="toggleTray()"><i class="fa fa-search"></i></a>
                        </div>
                   </div>
               </div>
               <div v-if="opentray == true" class="">
                <div class="my-2 flex sm:flex-row flex-col gap-4">                    
                   <div>
                        <h4 class="text-2xl font-semibold leading-tight">Filters</h4>
                    </div>
                    <div class="flex flex-row mb-1 sm:mb-0 gap-2">
                    <div class="form-group">
                        <label>QA User</label>
                        <select v-model="searchFilters.qa_user" class="form-control">
                            <option value="null">None</option>
                            <option v-for="(author, auth) in author" :key="`new1-${auth}`" :value="author.admin.id">{{author.admin.name}}</option>
                            <option v-for="(coll, col) in collaborators" :key="`new-${col}`" :value="coll.user_id"><span v-for="(usr, u) in coll.user" :key='`new-${u}`'>{{usr.name}}</span></option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label>Dev User</label>
                        <select v-model="searchFilters.dev_user" class="form-control">
                            <option value="null">None</option>
                            <option v-for="(author, auth) in author" :key="`new2-${auth}`" :value="author.admin.id">{{author.admin.name}}</option>
                            <option v-for="(coll, col) in collaborators" :key="`new1-${col}`" :value="coll.user_id"><span v-for="(usr, u) in coll.user" :key='`new1-${u}`'>{{usr.name}}</span></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>QA Status</label>
                        <select v-model="searchFilters.qa_status" class="form-control">
                            <option value="null">None</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="unresolved">Unresolved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dev Status</label>
                        <select v-model="searchFilters.dev_status" class="form-control">
                            <option value="null">None</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="unresolved">Unresolved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Logged</label>
                        <input v-model="searchFilters.date_logged" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Date Fixed</label>
                        <input v-model="searchFilters.date_fixed" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keyword</label>
                        <input v-model="searchFilters.keyword" type="search" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-sm" @click="fetchData()">Search</button>
                    <button class="btn btn-secondary btn-sm" @click="clearBtn()">Clear</button>
                    </div>
                </div>
               </div>
           </div>
       </nav>

       <!-- Table -->
        <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">            
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal table-auto">
                        <thead>
                            <tr>                         
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    #
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Module
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Issue
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    QA user
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date Logged
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    QA status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Dev user
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Dev status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date Fixed
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(log, i) in data" :key="i">                                
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{i}}</p>
                                </td>
                                <td class=" border-b border-gray-200 bg-white text-sm">
                                    <div class="form-group text-gray-900 whitespace-no-wrap">
                                        <textarea class="form-control border-0 min-w-full" :placeholder="log.module" @click="triggerTextUpdateForModule(log, i)" v-model="post.module" autofocus @change="updateModule(log,i)"></textarea>
                                    </div>
                                </td>
                                <td class="border-b border-gray-200 bg-white text-sm">
                                    <div class="form-group text-gray-900 whitespace-no-wrap">
                                        <textarea class="form-control border-0 min-w-full" :placeholder="log.issue" @click="triggerTextUpdateForIssue(log, i)" v-model="post.issue" autofocus @change="updateIssue(log,i)"></textarea>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <pre @click="openQA(log, i)" class="cursor-pointer text-gray-900 whitespace-no-wrap"><span v-if="log.qa !== null">{{log.qa.name}}</span><span v-if="log.qa == null">None</span></pre>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <pre @click="openDateLoggedModal(log, i)" class="cursor-pointer text-gray-900 whitespace-no-wrap"><span v-if="log.date_logged !== null">{{log.date_logged}}</span><span v-if="log.date_logged == null">--</span></pre>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">
                                            <pre @click="openQaStatusModal(log, i)" class="cursor-pointer">{{log.qa_status}}</pre>                                      </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <pre @click="openDEV(log, i)" class="cursor-pointer"><span v-if="log.dev !== null">{{log.dev.name}}</span><span v-if="log.dev == null">None</span></pre>
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">
                                            <pre @click="openDevStatusModal(log, i)" class="cursor-pointer">{{log.dev_status}}</pre>
                                        </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <pre @click="openDateFixedModal(log, i)" class="cursor-pointer text-gray-900 whitespace-no-wrap"><span v-if="log.date_fixed !== null">{{log.date_fixed}}</span><span v-if="log.date_fixed == null">--</span></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                            <option v-for="(author, auth) in author" :key="auth" :value="author.admin.id">{{author.admin.name}}</option>
                            <option v-for="(coll, col) in collaborators" :key="col" :value="coll.user_id"><span v-for="(usr, u) in coll.user" :key='u'>{{usr.name}}</span></option>
                        </select>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- QA user Modal Ends -->
        <!-- Dev user Modal -->
        <div class="modal fade" id="devUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <select v-model="post.devUser.value" class="form-control" autofocus @change="updateDevUser()">
                            <option v-for="(author, auth) in author" :key="auth" :value="author.admin.id">{{author.admin.name}}</option>
                            <option v-for="(coll, col) in collaborators" :key="col" :value="coll.user_id"><span v-for="(usr, u) in coll.user" :key='u'>{{usr.name}}</span></option>
                        </select>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- Dev user Modal Ends -->
        <!-- Date Logged Modal -->
        <div class="modal fade" id="dateLoggedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label>Choose a date</label>
                        <input type="date" v-model="post.dateLogged.value" @change="updateDateLogged()" class="form-control" autofocus>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- Date Logged Modal Ends -->
        <!-- Date Fixed Modal -->
        <div class="modal fade" id="dateFixedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label>Choose a date</label>
                        <input type="date" v-model="post.dateFixed.value" @change="updateDateFixed()" class="form-control" autofocus>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- Date Fixed Modal Ends -->
        <!-- Remove Collaborator  Modal -->
        <div class="modal fade" id="removeCollaboratorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <select v-model="post.removeCollaborator" class="form-control" autofocus @change="removeCollaborator()">
                            <option v-for="(coll, col) in collaborators" :key="col" :value="coll.user_id">{{coll.user[0].name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>            
            </div>
        </div>
        </div>
        <!-- Remove Collaborator  Modal Ends -->
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
                issue:'',
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
                dateLogged:{
                    id: null,
                    value: null,
                },
                dateFixed:{
                    id: null,
                    value: null,
                },
                removeCollaborator:null,
            },
            searchUser:'',
            allSearchedUsers:[

            ],
            searchFilters:{
                qa_user:null,
                dev_user:null,
                qa_status:null,
                dev_status:null,
                date_logged:null,
                date_fixed:null,
                keyword:null
            },
            json_fields:{
                Module: "module",
                Issue: "issue",
                "QA User": "qa.name",
                "Date Logged": "date_logged",
                "QA Status": "qa_status",
                "Dev User": "dev.name",
                "Dev Status": "dev_status",
                "Date Fixed": "date_fixed"   
            }
        }
    },
    methods: {
        /**
         * Get initial data
         */
        async fetchData(){
            const res = await this.callApi(
                'get',
                `app/get_all_project_issues/${this.project_id}/${this.searchFilters.qa_user}/${this.searchFilters.dev_user}/${this.searchFilters.qa_status}/${this.searchFilters.dev_status}/${this.searchFilters.date_logged}/${this.searchFilters.date_fixed}/${this.searchFilters.keyword}`,
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
         * Update module text
         */
        triggerTextUpdateForModule(log, i){
            this.post.module = log.module
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
                this.post.module = ''
                return this.fetchData()
        },
        /** 
         * Update issue text
         */
        triggerTextUpdateForIssue(log, i){
            this.post.issue = log.issue
        },
        /**
         * Update issue
         */
        async updateIssue(log, i){
            const res = await this.callApi(
                'put',
                'app/update_issue_issue',
                {
                    id: log.id,
                    value: this.post.issue
                }
            )
            if(res.status == 200)
                this.post.issue = ''
                return this.fetchData()
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
         * Open Remove COllaborators Modal
         */
        openRemoveCollaborators(){
            /**
             * Open modal
             */
            $('#removeCollaboratorModal').modal('show')
        },
        /**
         * Remove Collaborator
         */
        async removeCollaborator(){
            if(!confirm)
                return this.toast('This Collaborator will not be removed from this project!', 'info')
            else{
                const res = await this.callApi(
                    'delete',
                    `app/remove_collaborator_from_project/${this.project_id}/${this.post.removeCollaborator}`,
                    {

                    }                
                )
                if(res.status == 200){
                    this.toast(`${user.name} has been added as a collaborator`, 'success')
                    this.fetchCollaborators()
                    this.fetchData()
                }
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
         * Open Dev users modal
         */
        openDEV(log, i){
            /**
             * Assign Issue ID to post data
             */
            this.post.devUser.id = log.id
            /**
             * Open Dev Modal
             */
            $('#devUserModal').modal('show')
        },
        /**
         * Update Dev User
         */
        async updateDevUser(){
            const res = await this.callApi(
                'put',
                'app/update_issue_dev_user',
                this.post.devUser
            )
            if(res.status == 200)
                $('#devUserModal').modal('hide')
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
         /**
         * Open Date Logged modal
         */
        openDateLoggedModal(log, i){
            /**
             * Assign Issue ID to post data
             */
            this.post.dateLogged.id = log.id
            /**
             * Open Date Logged Modal
             */
            $('#dateLoggedModal').modal('show')
        },
        /**
         * Update Date Logged
         */
        async updateDateLogged(){
            const res = await this.callApi(
                'put',
                'app/update_issue_date_logged',
                this.post.dateLogged
            )
            if(res.status == 200)
                $('#dateLoggedModal').modal('hide')
                return this.fetchData()
        },
         /**
         * Open Date Fixed modal
         */
        openDateFixedModal(log, i){
            /**
             * Assign Issue ID to post data
             */
            this.post.dateFixed.id = log.id
            /**
             * Open Date Fixed Modal
             */
            $('#dateFixedModal').modal('show')
        },
        /**
         * Update Date Fixed
         */
        async updateDateFixed(){
            const res = await this.callApi(
                'put',
                'app/update_issue_date_fixed',
                this.post.dateFixed
            )
            if(res.status == 200)
                $('#dateFixedModal').modal('hide')
                return this.fetchData()
        },
        /**
         * Clear search filters
         */
        clearBtn(){
            // Clear Filters
            this.searchFilters.qa_user = null
            this.searchFilters.devUser = null
            this.searchFilters.qa_status = null
            this.searchFilters.dev_status = null
            this.searchFilters.dateLogged = null
            this.searchFilters.date_fixed = null
            this.searchFilters.keyword = null
            // Return Data
            this.fetchData()
        },
        /**
         * Delete Project
         */
        async deleteProject(){
            if(!confirm){
                this.toast('Project will not be deleted','info')
            } else { 
                const res = await this.callApi(
                    'delete',
                    `app/delete_project/${this.project_id}`,
                    {

                    }
                )

                if(res.status == 200){
                    window.location.assign('/dashboard')
                } else if(res.status == 403){
                    this.toastError(res.data.message)
                } else {
                    this.toastError('Something went wrong')
                }
            }

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
