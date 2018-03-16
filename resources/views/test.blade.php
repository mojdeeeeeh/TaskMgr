<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="app">
		<div>
			<label>Username</label>
			<input type="text" v-model="userModel.username" />
		</div>
		
		<div>
			<label>Birthdate</label>
			<input type="text" v-model="userModel.birthdate"/>
		</div>

		<div>
			<label>Sender user</label>
			<select v-model="userModel.sender_id" disabled>
				<option v-for="user in users" :value="user.id">@{{ user.name }}</option>
			</select>
		</div>

		<div>
			<label>Seconder user</label>
			<select v-model="userModel.seconder_id">
				<option v-for="user in users" :value="user.id">@{{ user.name }}</option>
			</select>
		</div>

		<div>
			<input type="submit" value="send" @click.prevent="sendData">
		</div>

		<pre>@{{ userModel }}</pre>
	</div>

	<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
	<script type="text/javascript">
		new Vue({
			el: '#app',

			created(){
				Axios.get('{{ url('/users') }}')
					.then(res => {
						this.users = res.data;
					});
			},

			data:{
				users: [],

				userModel: {
					username: '',
					birthdate: '',
					sender_id: 3,
					seconder_id: 3,
				}
			},

			methods:{
				sendData(){
					// let data = {
					// 	user_name: this.userModel.username,
					// 	user_birthdate: this.userModel.birthdate,
					// };

					Axios.post('{{ url('test/postData') }}', this.userModel);
				}
			}
		})
	</script>
</body>
</html>
