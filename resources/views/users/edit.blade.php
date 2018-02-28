<div class="card">
    <div class="card-header">
        Modify User
    </div>

    <div class="card-body">
        <div class="form-group row" >
            <label for="name" class="col-md-4 col-form-label text-md-right">
            	Name
            </label>

            <div class="col-md-6">
                <input type="text"
                	class="form-control"
                	v-model="user.name"
                	required autofocus />
            </div>
        </div>

        <div class="form-group row" >
            <label for="name" class="col-md-4 col-form-label text-md-right">
            	EMail
            </label>

            <div class="col-md-6">
                <input type="text"
                	class="form-control"
                	v-model="user.email"
                	required autofocus />
            </div>
        </div>
       
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <input type="submit" class="btn btn-primary" value="Update" @click="updateUser" />
                <input type="button" class="btn btn-danger" value="Cancel" @click="cancelUpdate" />
            </div>
        </div>
    </div>

</div>
