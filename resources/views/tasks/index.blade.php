@extends('layouts.app')

@section('content')
<div id="app2" class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Update form --}}
            <div v-show="isUpdateMode">
                @include('tasks.edit')
            </div>

            {{-- Show current form --}}
            <div v-show="isShowMode">
                <div class="row">
                    <div class="leftcolumn">
                        <div class="card">
                            <h2>TITLE:  @{{ currentTask.title }}</h2>
                            <h5 class="startDate">Title description,  @{{ currentTask.persianStartDate }}</h5>
                            <h7 class="finishDate">Ending Task, @{{ currentTask.persianFinishDate }}</h7>
                            <div class="fakeimg" style="height:200px;">BODY: @{{ currentTask.body }} </div>
                           
                            <p>This task is send by the @{{ currentTask.sender_user ? currentTask.sender_user.name : '' }}</p>
                            <p>This task is done by the @{{ currentTask.functor_user ? currentTask.functor_user.name : '' }}</p>
                            <p>This Task is controlled by @{{ currentTask.seconder_user ? currentTask.seconder_user.name : '' }}</p>
                            <p>@{{ currentTask.task_status ? currentTask.task_status.name : '' }}</p>
                            <div class="form-group row" >
                            <label for="name" class="col-md-4 col-form-label text-md-right"> 
                               
                            </label>
                               <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" v-model="task.weight" :checked="task.weight" />
                                    <label for="star5" title="Rocks!">5 stars</label>

                                    <input type="radio" id="star4" name="rating" value="4" v-model="task.weight" :checked="task.weight" />
                                    <label for="star4" title="Pretty good">4 stars</label>

                                    <input type="radio" id="star3" name="rating" value="3" v-model="task.weight" :checked="task.weight" />
                                    <label for="star3" title="Meh">3 stars</label>

                                    <input type="radio" id="star2" name="rating" value="2" v-model="task.weight" :checked="task.weight" />
                                    <label for="star2" title="Kinda bad">2 stars</label>

                                    <input type="radio" id="star1" name="rating" value="1" v-model="task.weight" :checked="task.weight" />

                                    <label for="star1" title="Sucks big time">1 star</label>
                                </fieldset>
                            </div>
                          
                            <input type="button" class="btn btn-info" value="Back" @click="cancel" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- index --}}
            <div class="card-body">
                {{-- Header --}}
                <div v-show="! hasTask">
                    No any task exists.
                </div>
                {{-- /Header --}}

                <div class="list-group" v-show="isNormalMode">
                    <a href="#" class="list-group-item active">
                        <h4 class="list-group-item-heading"> Tasks List </h4>
                        <p class="list-group-item-text"></p>
                    </a>
                    <div v-for="task in tasks" class="list-group-item">
                        <a href="#" @click.prevent="showTask(task)">
                            <h4 class="list-group-item-heading"> @{{ task.title }}</h4>
                        </a>

                        <p class="list-group-item-text">
                            Start task in: @{{ task.persianStartDate }} &nbsp; &nbsp;
                            Finish task in: @{{ task.persianFinishDate }} &nbsp; &nbsp;
                            
                            <a href="#" @click.prevent="showBrief(task)"> more</a>

                            <a class="btn btn-danger pull-right Button" href="#" data-record-id="task.id" @click="deleteTask(task)">&times;</a>
                            <a class="btn btn-primary pull-right Button" href="#" data-record-id="task.id" @click="showUpdateForm(task)">&plus;</a>

                            <div v-show="task.showBrief" class="list-group-item list-group-item-info">
                                @{{ task.body }}
                            </div>
                        </p>
                    </div>
                </div>
               
            </div>
        </div>
        @endsection


        @section('scripts')
        <script type="text/javascript">
        new Vue({
            el: '#app2',

            data: {
                task: {},
                tasks: [],
                formMode: 0,
                currentTask: {},
                users: [],
                task_statuses: []
            },

            computed: {
                hasTask: state => state.tasks.length > 0,
                isNormalMode: state => state.formMode == 0,
                isShowMode: state => state.formMode == 1,
                isUpdateMode: state => state.formMode == 2,
            },

            mounted() {
                let functions = [
                    this.loadUsers(),
                    this.loadTask_statuses(),
                    this.loadTasks()
                ];

                Axios.all(functions);
            },

            methods: {
                /**
                 * Load users list
                 */
                loadUsers(){
                    Axios.get('{{ route('users.index') }}')
                        .then(res => this.users = res.data)
                        .catch(err => alert(err.message));
                },

                 loadTask_statuses(){
                    Axios.get('{{ route('statuses.index') }}')
                        .then(res => this.task_statuses = res.data)
                        .catch(err => alert(err.message));
                },

                /**
                 * Load tasks data from server
                 */
                loadTasks() {
                    Axios.get('{{ route('tasks.index') }}')
                        .then(res => {
                            res.data.forEach(el => el.showBrief = false);

                            this.tasks = res.data;
                        })
                        .catch(err => {
                            alert(err.message);
                        });
                },
                /**
                 * Load task data from server
                 */
                showTask(task) {
                    this.currentTask = task;
                    this.formMode = 1;
                },

                showUpdateForm(task) {
                    this.task = task;
                    this.formMode = 2;
                },

                showBrief(task) {
                    task.showBrief = !task.showBrief;
                },

                cancel() {
                    this.formMode = 0;
                },

                /**
                 * Update current task data
                 */
                updateTask() {
                    Axios.put('{{ route('tasks.update', '') }}/' + this.task.id, this.task)
                        .then(res => {
                            alert('Updated');
                        })
                        .catch(err => {
                            alert(err.message);
                        });
                    this.formMode = 0;
                },

                /**
                 * Delete current task data
                 * @return {[type]} [description]
                 */
                deleteTask(task) {
                    let confirmed = confirm('Are you sure to delete the task?');

                    if (!confirmed) {
                        return;
                    }

                    Axios.delete('{{ route('tasks.destroy', '') }}/' + task.id)
                        .then(res => {
                            let index = this.tasks.map(el => el.id)
                                .indexOf(task.id);

                            this.tasks.splice(index, 1);

                            this.formMode = 0;
                        })
                        .catch(err => {
                            alert(err.message);
                        });
                },
            }
        });
        
        </script>
        @endsection
