<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		 <div class="card-body">
                    <div v-show="! hasStatus">
                        No any status exists.
                    </div>
                    <table class="table table-hover table-stripped" v-show="hasStatus">
                        <thead>
                            <tr>
                                <td>
                                   Status
                                </td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task_status in task_statuses">
                                <td>
                                    @{{ task_status.status }}
                                </td>
                                <td>
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
		</div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
    	new Vue({
		    el: '#app',

		    data: {
		        task_statuses: [],
		        formMode: 0
		    },

		    computed: {
		        hasStatus() {
		            return (this.task_statuses.length > 0);
		        },

		        isNormalMode() {
		            return (this.formMode == 0);
		        },
		    },

		    mounted() {
		        this.loadTaskStatuses();
		    },

		    methods: {
		        /**
		         * Load users data from server
		         */
		        loadTaskStatuses() {
		            Axios.get('{{ route('statuses.index') }}')
		                .then(res => {
		                    this.task_statuses = res.data;
		                })
		                .catch(err => {
		                    alert(err.message);
		                });
		        },
		    }
		})
</script>
</body>
</html>
