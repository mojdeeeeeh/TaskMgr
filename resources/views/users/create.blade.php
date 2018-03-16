<div class="card">
    <div class="card-header">
        Create User
    </div>

    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
            	Name
            </label>

            <div class="col-md-6">
                <input type="text" class="form-control" data-vv-delay="1000"
                    :class="{'input': true, 'is-danger': errors.has('name') }"
                    v-validate="'required|min:3|max:15'" name="name"
                    v-model="user.name"  autofocus />

                <i v-show="errors.has('name')" class="fa fa-warning"></i>
                <label v-if="errors.has('name')" >
                        @{{ errors.first('name') }}
                </label>
            </div>
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-4 col-form-label text-md-right">
            	EMail
            </label>

            <div class="col-md-6">
                <input type="text" class="form-control" data-vv-delay="1000"
                    :class="{'input': true, 'is-danger': errors.has('email') }"
                    v-validate="'required|email'" name="email"
                    v-model="user.email"  />

                <i v-show="errors.has('email')" class="fa fa-warning"></i>
                <label v-show="errors.has('email')">
                        @{{ errors.first('email') }}
                </label>
            </div>
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-4 col-form-label text-md-right">
                Password
            </label>

            <div class="col-md-6">
                <input type="password" class="form-control" data-vv-delay="1000"
                    v-validate="'required|min:6|max:25|confirmed:password_confirmation'" name="password"
                    v-model="user.password"  />
                <label v-if="errors.has('password')">
                        @{{ errors.first('password') }}
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                Confirm Password
            </label>

            <div class="col-md-6">
                <input type="password" class="form-control"  
                    name="password_confirmation"
                    v-model="user.password_confirmation"  />
                 <label v-if="errors.has('confirm_password')">
                        @{{ errors.first('confirm_password') }}
                </label>
            </div>
        </div>
       
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <input type="submit" class="btn btn-primary" value="Create" @click="createUser" />
                <input type="button" class="btn btn-danger" value="Cancel" @click="cancelUpdate" />
            </div>
        </div>
    </div>

</div>
