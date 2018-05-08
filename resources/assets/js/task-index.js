const C_FORM_MODE_NORMAL = 0;
const C_FORM_MODE_SHOW = 1;
const C_FORM_MODE_UPDATE = 2;
const C_FORM_MODE_CREATE = 3;

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
		isNormalMode: state => state.formMode == C_FORM_MODE_NORMAL,
		isShowMode: state => state.formMode == C_FORM_MODE_SHOW,
		isUpdateMode: state => state.formMode == C_FORM_MODE_UPDATE,
		isCreateMode: state => state.formMode == C_FORM_MODE_CREATE,
	},

	mounted() {
		let functions = [
		this.loadUsers(),
		this.loadTask_statuses(),
		this.loadTasks()
		];

		Axios.all(functions);

                CKEditorHelper.prepare('textEditor', this.ckeditorConfig)   // << set your texteditor id
                .then(res => {
                	res.on('change', () => {
                            this.task.body = res.getData();      // << The vuejs variable
                        });
                });
            },

            methods: {
                /**
                 * Load users list
                 */
                 loadUsers(){
                 	Axios.get(document.pageUrls.users_index)
	                 	.then(res => this.users = res.data)
	                 	.catch(err => alert(err.message));
                 },

                 loadTask_statuses(){
                 	Axios.get(document.pageUrls.statuses_index)
	                 	.then(res => this.task_statuses = res.data)
	                 	.catch(err => alert(err.message));
                 },

                /**
                 * Load tasks data from server
                 */
                 loadTasks() {
                 	Axios.get(document.pageUrls.tasks_index)
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
                 	CKEDITOR.instances['textEditor'].setData(task.body);
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
                 * New task data
                 * @return {[type]} [description]
                 */
                 showCreateForm() {
                    // Reset user data (new user)
                    this.task = {
                    	title: '',
                    	body: '',
                    	start: '',
                    	finish: '',
                    	weight: '',
                    	functor_user_id: '',
                    	seconder_user_id: '',
                    	task_status_id: '',
                    };

                    this.formMode = 3;
                },

                /**
                 * Update current task data
                 */
                 updateTask() {
                 	Axios.put(document.pageUrls.tasks_update + '/' + this.task.id, this.task)
	                 	.then(res => {
	                 		alert('Updated');
	                 	})
	                 	.catch(err => {
	                 		alert(err.message);
	                 	});

                 	this.formMode = 0;
                 },

                /**
                 * Create a new task
                 */
                 createTask() {
                 	this.$validator.validate()
                 	.then(res => {
                 		if (! res){
                 			alert ('error');

                 			return;
                 		}

                 		Axios.post(document.pageUrls.tasks_store, this.task)
                 		.then(res => {
                 			this.tasks.push (res.data);

                 			this.formMode = C_FORM_MODE_NORMAL;

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
                 * Delete current task data
                 * @return {[type]} [description]
                 */
                 deleteTask(task) {
                 	let confirmed = confirm('Are you sure to delete the task?');

                 	if (!confirmed) {
                 		return;
                 	}

                 	Axios.delete(document.pageUrls.tasks_destroy + '/' + task.id)
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


var options = {
	filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
	filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
	filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
	filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
};
             //CKEDITOR.replace( 'textEditor', options );

