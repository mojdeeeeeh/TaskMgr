<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
</head>

<body class="container">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row" id="app">
        New User
        <form method="post" action="{{ route('users.store') }}" class="form-horizontal">
            <div class="form-group">
                <input class="form-control"
					v-validate="'required|min:5|max:15'" name="name"
                	type="text" placeholder="Name" v-model="user.name" />

                	<label v-if="errors.has('name')">
                		@{{ errors.first('name') }}
                	</label>
            </div>

            <div class="form-group">
                <input class="form-control"
                	v-validate="'required|email'" name="email"
                	type="text" placeholder="EMail" v-model="user.email" />

                	<label v-if="errors.has('email')">
                		@{{ errors.first('email') }}
                	</label>
            </div>

            <div class="form-group">
                <input class="form-control"
					v-validate="'required|min:6|max:25'" name="password"
                	type="password" v-model="user.password" />

                	<label>
                		@{{ errors.first('password') }}
                	</label>
            </div>
            <input type="submit" value="Create" @click.prevent="sendData">
        </form>
    </div>


	<script src="{{ mix('js/app.js') }}"></script>
	<script type="text/javascript">
		Vue.use(VeeValidate);

		new Vue({
			el: '#app',

			data:{
				user:{
					name : '',
					email: '',
					password: ''
				}
			},

			methods:{
				sendData(){
					// this.$validator.validate()
					// 	.then(res => {
					// 		if (! res){
					// 			alert ('error');

					// 			return;
					// 		}

			     			Axios.post('{{ route('users.store') }}', this.user);
						// });
				}
			}
		})
    </script>
</body>

</html>
