@extends('layouts.app')

@section('content')
<div id="app2" class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Update form --}}
            <div v-show="isUpdateMode">
                @include('tasks.edit')
            </div>

            {{-- Create form --}}
            <div v-show="isCreateMode">
                @include('tasks.create')
            </div>

            {{-- Show current form --}}
            <div v-show="isShowMode">
                <div class="row">
                    <div class="leftcolumn">
                        <div class="card">
                            <h2>
                                TITLE:  @{{ currentTask.title }}
                            </h2>

                            <h5 class="startDate">
                                Title description,  @{{ currentTask.persianStartDate }}
                            </h5>

                            <h5 class="finishDate">
                                Ending Task, @{{ currentTask.persianFinishDate }}
                            </h5>

                            <div class="fakeimg" style="height:200px;">
                                BODY: @{{ currentTask.body }} 
                            </div>
                           
                            <p>This task is send by the @{{ currentTask.sender_user ? currentTask.sender_user.name : '' }}</p>

                            <p>This task is done by the @{{ currentTask.functor_user ? currentTask.functor_user.name : '' }}</p>

                            <p>This Task is controlled by @{{ currentTask.seconder_user ? currentTask.seconder_user.name : '' }}</p>

                            <p>@{{ currentTask.task_status ? currentTask.task_status.name : '' }}</p>

                            <div class="form-group row" >
                            <label for="name" class="col-md-4 col-form-label text-md-right"> 
                               
                            </label>
                               <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" v-model="currentTask.weight" :checked="currentTask.weight == 5" />
                                    <label for="star5" title="Rocks!">5 stars</label>

                                    <input type="radio" id="star4" name="rating" value="4" v-model="currentTask.weight" :checked="currentTask.weight == 4" />
                                    <label for="star4" title="Pretty good">4 stars</label>

                                    <input type="radio" id="star3" name="rating" value="3" v-model="currentTask.weight" :checked="currentTask.weight == 3" />
                                    <label for="star3" title="Meh">3 stars</label>

                                    <input type="radio" id="star2" name="rating" value="2" v-model="currentTask.weight" :checked="currentTask.weight == 2" />
                                    <label for="star2" title="Kinda bad">2 stars</label>

                                    <input type="radio" id="star1" name="rating" value="1" v-model="currentTask.weight" :checked="currentTask.weight == 1" />

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
                        <a class="btn btn-info pull-right" href="#" @click="showCreateForm">
                            <i class="fa fa-user"></i>
                        </a>
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
            document.pageUrls = {
                users_index: '{{ route('users.index') }}',
                statuses_index: '{{ route('statuses.index') }}',
                tasks_index: '{{ route('tasks.index') }}',
                tasks_update: '{{ route('tasks.update', "") }}',
                tasks_store: '{{ route('tasks.store') }}',
                tasks_destroy: '{{ route('tasks.destroy', '') }}',
            };
        </script>

        <script src="node_modules/moment/moment.min.js" defer></script>
        <script src="node_modules/moment-jalaali/build/moment-jalaali.js" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/task-index.js') }}" defer></script>
        @endsection
