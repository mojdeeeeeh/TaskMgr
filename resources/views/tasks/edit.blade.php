<div class="card">
    <div class="card-header">
        Modify Task
    </div>

    <div class="card-body">
        <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
            	Title
            </label>

            <div class="col-md-8">
                <input type="text"
                	class="form-control"
                	v-model="task.title"
                	required autofocus />
            </div>
        </div>

        <div class="form-group row" >
           

            <section class="content">
              <div class="row">
                <label for="name" class="col-md-2 col-form-label text-md-right">
                    Body
                </label>
                <div class="col-md-8 ">
                  <div class="box box-info">
                    <div class="box-header">
                      
                      <!-- tools box -->
                      <div class="pull-right box-tools">
                        
                      </div>
                      <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div  class="form-group{{ $errors->has('body') ? "has-error" : "" }}" style="padding: 10px">
                      
                        <div>
                           <textarea id="textEditor" name="body" class="ckeditor" v-model="task.body" required>
                               @{{ task.body }}
                           </textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
            
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
                Start
            </label>

            <div class="col-md-8">
                <input type="text" id="input1"
                    class="form-control"
                    v-model="task.persianStartDate"
                    required />
                    <span id="span2"></span>
            </div>
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
                Finish
            </label>

            <div class="col-md-8">
                 {{-- <date-picker v-model="datetime" type="datetime"></date-picker> --}}
            </div>
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
                Sender user
            </label>

            <div class="col-md-8">
                <select v-model="task.sender_user_id" disabled>
                    <option v-for="user in users" :value="user.id">
                        @{{ user.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
                Functor user
            </label>

            <div class="col-md-8">
                <select v-model="task.functor_user_id" >
                    <option v-for="user in users" :value="user.id">
                        @{{ user.name }}
                    </option>
                </select>
            </div>
        </div>

         <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
                Seconder user
            </label>

            <div class="col-md-8">
                <select v-model="task.seconder_user_id">
                    <option v-for="user in users" :value="user.id">
                        @{{ user.name }}
                    </option>
                </select>
            </div>
        </div>

         <div class="form-group row" >
            <label for="name" class="col-md-2 col-form-label text-md-right">
               TaskStatus
            </label>

            <div class="col-md-8">
                <select v-model="task.task_status_id">
                    <option v-for="taskStatus in task_statuses" :value="taskStatus.id">
                        @{{ taskStatus.status }}
                    </option>
                </select>
            </div>
        </div>

      <div class="form-group row" >
        <label for="name" class="col-md-2 col-form-label text-md-right"> 
            Please rate
        </label>
           <fieldset class="rating">
                <input type="radio" id="star5" name="rating" value="5" v-model="task.weight" :checked="task.weight == task.weight" />
                <label for="star5" title="Rocks!">5 stars</label>

                <input type="radio" id="star4" name="rating" value="4" v-model="task.weight" :checked="task.weight == task.weight" />
                <label for="star4" title="Pretty good">4 stars</label>
 
                <input type="radio" id="star3" name="rating" value="3" v-model="task.weight" :checked="task.weight == task.weight" />
                <label for="star3" title="Meh">3 stars</label>

                <input type="radio" id="star2" name="rating" value="2" v-model="task.weight" :checked="task.weight == task.weight" />
                <label for="star2" title="Kinda bad">2 stars</label>

                <input type="radio" id="star1" name="rating" value="1" v-model="task.weight" :checked="task.weight == task.weight" />

                <label for="star1" title="Sucks big time">1 star</label>
            </fieldset>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <input type="submit" class="btn btn-primary" value="Update" @click="updateTask" />
                <input type="button" class="btn btn-danger" value="Cancel" @click="cancel" />
            </div>
        </div>
    </div>
</div>
