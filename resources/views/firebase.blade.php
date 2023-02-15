<html>
    <head>
        <title>Laravel Phone Number Authentication using Firebase - ItSolutionStuff.com</title>
        <!-- CSS only -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h1>Laravel Phone Number Authentication using Firebase - ItSolutionStuff.com</h1>

            <div class="alert alert-danger" id="error" style="display: none;"></div>

            <div class="card">
                <div class="card-header">
                    Enter Phone Number
                </div>
                <div class="card-body">

                    <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>

                    <form>
                        <label>Phone Number:</label>
                        <input type="text" id="number" class="form-control" placeholder="+91********">
                        <div id="recaptcha-container"></div>
                        <button type="button" class="btn btn-success" onclick="phoneSendAuth();">SendCode</button>
                    </form>
                </div>
            </div>

            <div class="card" style="margin-top: 10px">
                <div class="card-header">
                    Enter Verification code
                </div>
                <div class="card-body">

                    <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>

                    <form>
                        <input
                            type="text"
                            id="verificationCode"
                            class="form-control"
                            placeholder="Enter verification code">
                        <button type="button" class="btn btn-success" onclick="codeverify();">Verify code</button>

                    </form>
                </div>
            </div>

        </div>

        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

        <script type="module">
            // Import the functions you need from the SDKs you need
            import {initializeApp} from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
            import {getAnalytics} from "https://www.gstatic.com/firebasejs/9.17.1/firebase-analytics.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries Your web app's
            // Firebase configuration For Firebase JS SDK v7.20.0 and later, measurementId
            // is optional
            const firebaseConfig = {
                apiKey: "AIzaSyBgkAiRG60TxHNNWe82w6k74d_UVNlJUFc",
                authDomain: "otplogin-c63de.firebaseapp.com",
                projectId: "otplogin-c63de",
                storageBucket: "otplogin-c63de.appspot.com",
                messagingSenderId: "3331391022",
                appId: "1:3331391022:web:755599abbedb02e8c629bf",
                measurementId: "G-EXNYYVND7X"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);
        </script>
        <script type="text/javascript">

            window.onload = function () {
                render();
            };

            function render() {
                window.recaptchaVerifier = new firebase
                    .auth
                    .RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }

            function phoneSendAuth() {

                var number = $("#number").val();

                firebase
                    .auth()
                    .signInWithPhoneNumber(number, window.recaptchaVerifier)
                    .then(function (confirmationResult) {

                        window.confirmationResult = confirmationResult;
                        coderesult = confirmationResult;
                        console.log(coderesult);

                        $("#sentSuccess").text("Message Sent Successfully.");
                        $("#sentSuccess").show();

                    })
                    .catch(function (error) {
                        $("#error").text(error.message);
                        $("#error").show();
                    });

            }

            function codeverify() {

                var code = $("#verificationCode").val();

                coderesult
                    .confirm(code)
                    .then(function (result) {
                        var user = result.user;
                        console.log(user);

                        $("#successRegsiter").text("you are register Successfully.");
                        $("#successRegsiter").show();

                    })
                    .catch(function (error) {
                        $("#error").text(error.message);
                        $("#error").show();
                    });
            }
        </script>

    </body>
</html>
O