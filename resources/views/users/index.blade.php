@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

	        {{-- Update form --}}
	        <div v-show="isUpdateMode">
	        	@include('users.edit')
	        </div>

            <div class="card" v-show="isNormalMode">
                <div class="card-header">Users List</div>

                <div class="card-body">
                    <div v-show="! hasUser">
                        No any user exists.
                    </div>

                    <table class="table table-hover table-stripped" v-show="hasUser">
                        <thead>
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    EMail
                                </td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="user in users">
                                <td>
                                    @{{ user.name }}
                                </td>
                                <td>
                                    @{{ user.email }}
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="#" @click="deleteUser(user)">&times;</a>
                                    <a class="btn btn-info" href="#" @click="showUpdateForm(user)">&plus;</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script type="text/javascript">
new Vue({
    el: '#app',

    data: {
    	user: {},
        users: [],
        formMode: 0
    },

    computed:{
    	hasUser(){
    		return (this.users.length > 0);
    	},

    	isNormalMode(){
    		return (this.formMode == 0);
    	},

    	isUpdateMode(){
    		return (this.formMode == 1);
    	},
    },

    mounted() {
        this.loadUsers();
    },

    methods: {
        /**
         * Load users data from server
         */
        loadUsers() {
            Axios.get('{{ route('users.index') }}')
                .then(res => {
                    this.users = res.data;
                })
                .catch(err => {
                    alert(err.message);
                });
        },

        /**
         * Update User
         */
        showUpdateForm(user){
        	this.user = user;

        	this.formMode = 1;
        },

        /**
         * Cancel Update
         */
        cancelUpdate(){
        	this.formMode = 0;
        },

        /**
         * Update current user dat
         * @return {[type]} [description]
         */
        updateUser(){
        	Axios.put('{{ route('users.update', '') }}/' + this.user.id, this.user)
        		.then(res =>{
        			alert('Updated');
    			})
    			.catch(err =>{
    				alert(err.message);
    			});

        }
    }
})
</script>
@endsection
