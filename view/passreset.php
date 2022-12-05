<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/md5.js"></script>
    <style>
        div#boader {
            /* background-color: ghostwhite; */
            width: 100%;
            height: 30rem;
            text-align: center;
        }

        .pass {
            border-radius: 43px;
            width: 30%;
            height: 3rem;
            border: 0px;
            padding: 3px 33px 5px 15px;
            border-bottom: -1px black;
            position: absolute;
            top: -2rem;
            left: 27rem;
        }

        .new {
            position: relative;
            top: 1rem;
            margin: 50px;
        }

        input#email {
            font-family: cursive;
    border-radius: 43px;
    width: 30%;
    height: 3rem;
    border: 0px;
    padding: 3px 48px 5px 15px;
    color: #775f5f;
    font-size: 18px;
        }

        #email:focus {
            box-shadow:2px 1px 14px 5px #20deef;
            /* border: none!important; */
            outline: none;

        }

        .pass:focus {
            box-shadow: 2px 1px 14px 5px #20deef;
            /* border: none!important; */
            outline: none;

        }


        #buttonDiv {
            position: relative;
            top: 1em;
        }

        .button {
            border-radius: 43px;
            width: 6%;
            background-color: #8cdc8c;
            border: 1px;
            height: 2rem;
            text-align: center;
        }

        .button:focus {
            box-shadow: 2px 1px 14px 0px #20deef;
            /* border: none!important; */
            outline: none;
        }

        a {
            position: absolute;
            top: 11px;
            left: 23px;
            font-size: 27px;
        }

        i.fa.fa-user-circle-o {
            position: relative;
            right: 44px;
            top: 7px;
            font-size: 32px;
        }


        i.fa.fa-Key {
            position: relative;
            left: 157px;
            bottom: 25px;
            font-size: 32px
        }

        a:hover {
            color: springgreen;
        }

        .container-login100 {
            width: 98%;
            min-height: 84vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            /* background: #9053c7; */
            /* background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0); */
            /* background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
    background: -moz-linear-gradient(-135deg, #c850c0, #4158d0); */
            background: linear-gradient(-135deg, #c850c0, #4158d0);
        }
        p#result {
            color: rgb(251 239 239);
    font-size: 13px;
    font-weight: 700;
    font-family: cursive;
    top: 2em;
    width: 25%;
    left: 31rem;
    position: relative;
}
    </style>

</head>
<body>
<div class="container-login100">
<div id="boader">
<div class="set_Password" >
                <div class="heading">
                    <input type="hidden" id="getEmail" value="<?php echo $_GET['email'];?> ">
                    <h1>Set New Password<h1>
                </div>
                <!-- <form> -->
                <div class="new">
                    <input type="password" autocomplete="off" class="pass" id="npass" placeholder="Enter new password" required>
                    <i class="fa fa-key" id="npassIcon" aria-hidden="true"></i>
                </div>
                <div class="new">
                    <input type="text" autocomplete="off" class="pass" id="cpass" placeholder="confirm password" required>
                    <i class="fa fa-key" id="cpassIcon" aria-hidden="true"></i>
                </div>
                <div id="buttonDiv"><button class="button" onclick="setPassSubmit()" id='nbutton'>submit</button></div>
                <!-- </form> -->
            </div>
            <div>
                <p id="result"></p>
            </div>
</div>
</div>
<script>
 //::::::::::::::::for new pass
 $('#' + "npass").focus(function() {
            $("#npassIcon").css("color", "blue");
        });
        $('#' + "npass").focusout(function() {
            $("#npassIcon").css("color", "black");
        });
        //::::::::::::::::for confirm pass
        $('#' + "cpass").focus(function() {
            $("#cpassIcon").css("color", "blue");
        });
        $('#' + "cpass").focusout(function() {
            $("#cpassIcon").css("color", "black");
        });
function setPassSubmit(){
        var npass= document.getElementById('npass').value;
        var cpass= document.getElementById('cpass').value;
        var eamildiv= document.getElementsByClassName('emailForm');
        var getEmail=document.getElementById('getEmail').value;
           var newpassDiv= document.getElementsByClassName('set_Password');
           var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
           if(npass!=''&&cpass!=''&&npass==cpass&&npass.match(decimal)&&npass.match(decimal)){
        var cpass= calcMD5(document.getElementById('cpass').value);
        var npass= calcMD5(document.getElementById('npass').value);
           $.ajax({
               type:"post",
               url:"route.php?param=resetPass",
               data:{cpass:cpass,email:getEmail},
               success:function(data){
                //    console.log(data);
               if(data =='yes'){
                $('#cpass').val('');
                $('#npass').val('');
                // $('#result').html(data);
                $('#result').html("Password reset  ");
                // $('#result').css({"color": "#da163a","font-size": "38px","font-weight": "700","font-family": "cursive"});
               }else{
                // $('#result').html(data);
                $('#result').html("something worng set again");
               }
               
               }
           });
        }else{
            $('#result').html("Password and Submit [8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character]");
        }
        }

</script>
</body>     