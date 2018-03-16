@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Update form --}}
            <div v-show="isUpdateMode">
                @include('users.edit')
            </div>
            {{-- Create form --}}
            <div v-show="isCreateMode">
                @include('users.create')
            </div>
            {{-- index --}}
            <div class="card" v-show="isNormalMode">
                <div class="card-header">
                    Users List
                    <a class="btn btn-info pull-right" href="#" @click="showCreateForm">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
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
                                    <a class="btn btndefault btndelete" href="#" data-record-id="user.id" @click="deleteUser(user)">&times;</a>
                                    <a class="btn btndefault btnupdate" href="#" data-record-id="user.id" @click="showUpdateForm(user)">&plus;</a>
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
Vue.use(VeeValidate);
new Vue({
    el: '#app',

    data: {
        user: {},
        users: [],
        formMode: 0
    },

    computed: {
        hasUser() {
            return (this.users.length > 0);
        },

        isNormalMode() {
            return (this.formMode == 0);
        },

        isUpdateMode() {
            return (this.formMode == 1);
        },

        isCreateMode() {
            return (this.formMode == 2);
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
        showUpdateForm(user) {
            this.user = user;

            this.formMode = 1;
        },

        /**
         * Update current user dat
         * @return {[type]} [description]
         */
        updateUser() {
            Axios.put('{{ route('users.update', '') }}/' + this.user.id, this.user)
                .then(res => {
                    alert('Updated');
                })
                .catch(err => {
                    alert(err.message);
                });
            this.formMode = 0;

        },

        /**
         * Cancel Update
         */
        cancelUpdate() {
            this.formMode = 0;
        },

        /**
         * New user data
         * @return {[type]} [description]
         */
        showCreateForm() {
            // Reset user data (new user)
            this.user = {
                name: '',
                email: '',
                password: '',
                confirm_password: ''
            };

            this.formMode = 2;
        },

        /**
         * Create a new user
         */
        createUser() {
            this.$validator.validate()
                .then(res => {
                    if (! res){
                        alert ('error');

                        return;
                    }

                    Axios.post('{{ route('users.store') }}', this.user)
                        .then(res => {
                            this.users.push (res.data);

                            this.formMode = 0;

                            alert('Created');
                        })
                        .catch(err => {
                            let eCode = err.response.status;

                            if (eCode == 422){
                                // console.log(err.response.data);

                                alert(err.response.data.message);
                            }
                            else if (eCode == 403){
                                alert('UnAuthorized');
                            }
                        });

                    });
             },


        /**
         * Delete current user dat
         * @return {[type]} [description]
         */
        deleteUser(user) {
            let confirmed = confirm('Are you sure to delete user?');

            if (! confirmed){
                return;
            }

            Axios.delete('{{ route('users.destroy', '') }}/' + user.id)
                .then(res => {
                    let index = this.users.map(el => el.id)
                                        .indexOf(user.id);

                    this.users.splice(index, 1);
                    
                    this.formMode = 0;
                })
                .catch(err => {
                    alert(err.message);
                });
        },

    }
})
</script>
@endsection
