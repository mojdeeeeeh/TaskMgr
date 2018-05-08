/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/task-index.js":
/***/ (function(module, exports) {

var C_FORM_MODE_NORMAL = 0;
var C_FORM_MODE_SHOW = 1;
var C_FORM_MODE_UPDATE = 2;
var C_FORM_MODE_CREATE = 3;

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
    hasTask: function hasTask(state) {
      return state.tasks.length > 0;
    },
    isNormalMode: function isNormalMode(state) {
      return state.formMode == C_FORM_MODE_NORMAL;
    },
    isShowMode: function isShowMode(state) {
      return state.formMode == C_FORM_MODE_SHOW;
    },
    isUpdateMode: function isUpdateMode(state) {
      return state.formMode == C_FORM_MODE_UPDATE;
    },
    isCreateMode: function isCreateMode(state) {
      return state.formMode == C_FORM_MODE_CREATE;
    }
  },

  mounted: function mounted() {
    var _this = this;

    var functions = [this.loadUsers(), this.loadTask_statuses(), this.loadTasks()];

    Axios.all(functions);

    CKEditorHelper.prepare('textEditor', this.ckeditorConfig) // << set your texteditor id
    .then(function (res) {
      res.on('change', function () {
        _this.task.body = res.getData(); // << The vuejs variable
      });
    });
  },


  methods: {
    /**
     * Load users list
     */
    loadUsers: function loadUsers() {
      var _this2 = this;

      Axios.get(document.pageUrls.users_index).then(function (res) {
        return _this2.users = res.data;
      }).catch(function (err) {
        return alert(err.message);
      });
    },
    loadTask_statuses: function loadTask_statuses() {
      var _this3 = this;

      Axios.get(document.pageUrls.statuses_index).then(function (res) {
        return _this3.task_statuses = res.data;
      }).catch(function (err) {
        return alert(err.message);
      });
    },


    /**
     * Load tasks data from server
     */
    loadTasks: function loadTasks() {
      var _this4 = this;

      Axios.get(document.pageUrls.tasks_index).then(function (res) {
        res.data.forEach(function (el) {
          return el.showBrief = false;
        });

        _this4.tasks = res.data;
      }).catch(function (err) {
        alert(err.message);
      });
    },

    /**
     * Load task data from server
     */
    showTask: function showTask(task) {
      this.currentTask = task;
      this.formMode = 1;
    },
    showUpdateForm: function showUpdateForm(task) {
      CKEDITOR.instances['textEditor'].setData(task.body);
      this.task = task;
      this.formMode = 2;
    },
    showBrief: function showBrief(task) {
      task.showBrief = !task.showBrief;
    },
    cancel: function cancel() {
      this.formMode = 0;
    },


    /**
     * New task data
     * @return {[type]} [description]
     */
    showCreateForm: function showCreateForm() {
      // Reset user data (new user)
      this.task = {
        title: '',
        body: '',
        start: '',
        finish: '',
        weight: '',
        functor_user_id: '',
        seconder_user_id: '',
        task_status_id: ''
      };

      this.formMode = 3;
    },


    /**
     * Update current task data
     */
    updateTask: function updateTask() {
      Axios.put(document.pageUrls.tasks_update + '/' + this.task.id, this.task).then(function (res) {
        alert('Updated');
      }).catch(function (err) {
        alert(err.message);
      });

      this.formMode = 0;
    },


    /**
     * Create a new task
     */
    createTask: function createTask() {
      var _this5 = this;

      this.$validator.validate().then(function (res) {
        if (!res) {
          alert('error');

          return;
        }

        Axios.post(document.pageUrls.tasks_store, _this5.task).then(function (res) {
          _this5.tasks.push(res.data);

          _this5.formMode = C_FORM_MODE_NORMAL;

          alert('Created');
        }).catch(function (err) {
          var eCode = err.response.status;

          if (eCode == 422) {
            // console.log(err.response.data);

            alert(err.response.data.message);
          } else if (eCode == 403) {
            alert('UnAuthorized');
          }
        });
      });
    },


    /**
     * Delete current task data
     * @return {[type]} [description]
     */
    deleteTask: function deleteTask(task) {
      var _this6 = this;

      var confirmed = confirm('Are you sure to delete the task?');

      if (!confirmed) {
        return;
      }

      Axios.delete(document.pageUrls.tasks_destroy + '/' + task.id).then(function (res) {
        var index = _this6.tasks.map(function (el) {
          return el.id;
        }).indexOf(task.id);

        _this6.tasks.splice(index, 1);

        _this6.formMode = 0;
      }).catch(function (err) {
        alert(err.message);
      });
    }
  }
});

var options = {
  filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
  filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
  filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
  filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
};
//CKEDITOR.replace( 'textEditor', options );

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/task-index.js");


/***/ })

/******/ });