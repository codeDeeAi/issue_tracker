<template>
<div class="container"> 
    <div class="py-12">
        <div class="a h-1/2 my-2">
            <div class="flex justify-start py-2">
                <h2 class="h2 font-semibold">My projects</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-10">
                <button type="button" class="rounded h-40 border my-4 btn-primary hover:shadow py-auto"  data-toggle="modal" data-target="#staticBackdrop">
                        Create New Project
                </button>
                <div class="h-50">
                    <!-- Button trigger modal -->
                    
                </div>
                <div class="rounded h-40 border my-4 hover:shadow cursor-pointer" v-for="(pro , p) in myProjects.data" :key="p">
                    <form class="flex-auto pl-6 py-4 px-4">
                        <h1 class="w-full flex-none font-semibold mb-2.5">
                           {{pro.name}}
                        </h1>
                        <div class="text-sm font-medium">
                            {{pro.description}}
                        </div>
                        <div class="flex justify-end">
                            <a :href="`/project${pro.id}`" class="btn flex justify-between btn-sm rounded-full btn-primary text-white px-auto py-auto"><i class="fa fa-arrow-right fa-2x"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            <pagination :data="myProjects" size="small" @pagination-change-page="fetchMyProjects"></pagination>
        </div>
        <hr>
        <div class="a h-1/2 my-2">
            <div class="flex justify-start">
                <h2 class="h2 font-semibold py-2">Other projects</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-10">
                <div class="rounded h-40 border my-4 hover:shadow cursor-pointer" v-for="(oth , ot) in otherProjects.data" :key="ot">
                    <form class="flex-auto pl-6 py-4 px-4">
                        <div class="flex justify-end">
                            <p class="text-sm italic">{{oth.admin.name}}</p>
                        </div>
                        <h1 class="w-full flex-none font-semibold mb-2.5">
                           {{oth.name}}
                        </h1>
                        <div class="text-sm font-medium">
                            {{oth.description}}
                        </div>
                        <div class="flex justify-end">
                            <a :href="`/project${oth.id}`" class="btn flex justify-between btn-sm rounded-full btn-primary text-white px-auto py-auto"><i class="fa fa-arrow-right fa-2x"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            <pagination :data="otherProjects" size="small" @pagination-change-page="fetchOtherProjects"></pagination>
        </div>
    </div>    
    <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" v-model="post.name" required autofocus>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" v-model="post.description" required autofocus></textarea>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" @click.prevent="createProject">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Ends -->
</div>  
</template>
<script>
export default {
    components:{
    },
    props:['user', 'token'],
    data(){
        return{
            post:{
                name:'',
                description:''
            },
            myProjects:{

            },
            otherProjects:{

            }
        }
    },
    methods: {
      async createProject(){
            if(this.post.name.trim() == '' )
                return this.toastError('Name cannot be left empty')
            
            if(this.post.description.trim() == '' )
                return this.toastError('Description cannot be left empty')


            const res = await this.callApi(
                'post',
                'app/create_new_project',
                this.post
            )
            if(res.status == 200){
                this.toast('project created successfully','success')
                this.post.name = ''
                this.post.description = ''
                $('#staticBackdrop').modal('hide')
                this.fetchMyProjects()
            }
        }, 
        async fetchMyProjects(page = 1){
            const res = await this.callApi(
                'get',
                `app/get_my_projects?page=${page}`,
                this.post
            )
            if(res.status == 200)
                return this.myProjects = res.data
        },
        async fetchOtherProjects(page = 1){
            const res = await this.callApi(
                'get',
                `app/get_other_projects?page=${page}`,
                this.post
            )
            if(res.status == 200)
                return this.otherProjects = res.data
        }
    },
   
    created(){ 

    },
    mounted(){
        this.$store.commit('updateUser', this.user);
        this.$store.commit("commitUserToken", this.token);
        [this.fetchMyProjects(), this.fetchOtherProjects()]
    }
}
</script>
<style  scoped>

</style>