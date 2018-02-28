{{-- <!DOCTYPE html>
<html>
<head>
    <title>Welcome page</title>


    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
</head>
<body>

    <form method="post" action="test.php">
        <div>
            Username : <input type="text" name="username" id="usernameTextBox" />
        </div>

        <div>
            Password : <input type="password" name="password" id="passwordTextBox" />
        </div>

        <div>
            <input type="button" id="sendButton" value="Show" onclick="showData()">
        </div>
    </form>
    
    <script type="text/javascript" src='{{ mix('js/app.js') }}'></script>
    <script type="text/javascript">
        let userModel = {
            username: "hasan",
            password: "123"
        };

        let usernameTextBox = document.getElementById('usernameTextBox');
        let passwordTextBox = document.getElementById('passwordTextBox');

        updateUI();

        function updateUI(){
            usernameTextBox.value = userModel.username;
            passwordTextBox.value = userModel.password;
        }

        function showData()
        {
            userModel.username = usernameTextBox.value;
            userModel.password = passwordTextBox.value;
        }
    </script>
</body>
</html>
 --}}


 <!DOCTYPE html>
<html>
<head>
    <title>Welcome page</title>


    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
</head>
<body>

    <form method="post" action="test.php" id="hasan">
        <div>
            Username : <input type="text" v-model="userModel.username" />
        </div>

        <div>
            Password : <input type="password"  v-model="userModel.password" />
        </div>

        <div>

            @{{ userModel.username }}
            @{{ userModel.password }}
            @{{ userModel }}

            <input type="button" value="Show" v-on:click="updateUsername">
        </div>
    </form>
    
    <script type="text/javascript" src='{{ mix('js/app.js') }}'></script>
    <script type="text/javascript">
        new Vue({
            el: '#hasan',

            data:{
                userModel:{
                    username: '',
                    password: ''
                }
            },

            methods:{
                updateUsername(){
                    this.userModel.username += "!";
                }
            }
        });
    </script>
</body>
</html>
