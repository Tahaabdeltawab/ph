<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            *
            {
              font-family: 'PT Sans Caption', sans-serif, 'arial', 'Times New Roman';
            }
            /* Error Page */
                .error .clip .shadow
                {
                    height: 180px;  /*Contrall*/
                }
                .error .clip:nth-of-type(2) .shadow
                {
                    width: 130px;   /*Contrall play with javascript*/
                }
                .error .clip:nth-of-type(1) .shadow, .error .clip:nth-of-type(3) .shadow
                {
                    width: 250px; /*Contrall*/
                }
                .error .digit
                {
                    width: 150px;   /*Contrall*/
                    height: 150px;  /*Contrall*/
                    line-height: 150px; /*Contrall*/
                    font-size: 120px;
                    font-weight: bold;
                }
                .error h2   /*Contrall*/
                {
                    font-size: 22px;
                }
                .error .msg /*Contrall*/
                {
                    top: -190px;
                    left: 30%;
                    width: 90px;
                    height: 90px;
                    line-height: 90px;
                    font-size: 28px;
                }
                .error span.triangle    /*Contrall*/
                {
                    top: 70%;
                    right: 0%;
                    border-left: 20px solid #535353;
                    border-top: 15px solid transparent;
                    border-bottom: 15px solid transparent;
                }


                .error .container-error-404
                {
                  margin-top: 10%;
                    position: relative;
                    height: 250px;
                    padding-top: 40px;
                }
                .error .container-error-404 .clip
                {
                    display: inline-block;
                    transform: skew(-45deg);
                }
                .error .clip .shadow
                {

                    overflow: hidden;
                }
                .error .clip:nth-of-type(2) .shadow
                {
                    overflow: hidden;
                    position: relative;
                    box-shadow: inset 20px 0px 20px -15px rgba(150, 150, 150,0.8), 20px 0px 20px -15px rgba(150, 150, 150,0.8);
                }

                .error .clip:nth-of-type(3) .shadow:after, .error .clip:nth-of-type(1) .shadow:after
                {
                    content: "";
                    position: absolute;
                    right: -8px;
                    bottom: 0px;
                    z-index: 9999;
                    height: 100%;
                    width: 10px;
                    background: linear-gradient(90deg, transparent, rgba(173,173,173, 0.8), transparent);
                    border-radius: 50%;
                }
                .error .clip:nth-of-type(3) .shadow:after
                {
                    left: -8px;
                }
                .error .digit
                {
                    position: relative;
                    top: 8%;
                    color: white;
                    background: #18453B;
                    border-radius: 50%;
                    display: inline-block;
                    transform: skew(45deg);
                }
                .error .clip:nth-of-type(2) .digit
                {
                    left: -10%;
                }
                .error .clip:nth-of-type(1) .digit
                {
                    right: -20%;
                }.error .clip:nth-of-type(3) .digit
                {
                    left: -20%;
                }
                .error h2
                {
                    color: #a2A2A2;
                    font-weight: bold;
                    padding-bottom: 20px;
                }
                .error .msg
                {
                    position: relative;
                    z-index: 9999;
                    display: block;
                    background: #535353;
                    color: #A2A2A2;
                    border-radius: 50%;
                    font-style: italic;
                }
                .error .triangle
                {
                    position: absolute;
                    z-index: 999;
                    transform: rotate(45deg);
                    content: "";
                    width: 0;
                    height: 0;
                }

            /* Error Page */
            @media(max-width: 767px)
            {
                /* Error Page */
                        .error .clip .shadow
                        {
                            height: 100px;  /*Contrall*/
                        }
                        .error .clip:nth-of-type(2) .shadow
                        {
                            width: 80px;   /*Contrall play with javascript*/
                        }
                        .error .clip:nth-of-type(1) .shadow, .error .clip:nth-of-type(3) .shadow
                        {
                            width: 100px; /*Contrall*/
                        }
                        .error .digit
                        {
                            width: 90px;   /*Contrall*/
                            height: 90px;  /*Contrall*/
                            line-height: 90px; /*Contrall*/
                            font-size: 52px;
                        }
                        .error h2   /*Contrall*/
                        {
                            font-size: 20px;
                        }
                        .error .msg /*Contrall*/
                        {
                            top: -110px;
                            left: 15%;
                            width: 50px;
                            height: 50px;
                            line-height: 50px;
                            font-size: 12px;
                        }
                        .error span.triangle    /*Contrall*/
                        {
                            top: 70%;
                            right: -3%;
                            border-left: 10px solid #535353;
                            border-top: 8px solid transparent;
                            border-bottom: 8px solid transparent;
                        }
            .error .container-error-404
              {
                height: 150px;
              }
                    /* Error Page */
            }

            /*--------------------------------------------Framework --------------------------------*/

            .overlay { position: relative; z-index: 20; } /*done*/
                .ground-color { background: white; }  /*done*/
                .item-bg-color { background: #EAEAEA } /*done*/

                /* Padding Section*/
                    .padding-top { padding-top: 10px; } /*done*/
                    .padding-bottom { padding-bottom: 10px; }   /*done*/
                    .padding-vertical { padding-top: 10px; padding-bottom: 10px; }
                    .padding-horizontal { padding-left: 10px; padding-right: 10px; }
                    .padding-all { padding: 10px; }   /*done*/

                    .no-padding-left { padding-left: 0px; }    /*done*/
                    .no-padding-right { padding-right: 0px; }   /*done*/
                    .no-vertical-padding { padding-top: 0px; padding-bottom: 0px; }
                    .no-horizontal-padding { padding-left: 0px; padding-right: 0px; }
                    .no-padding { padding: 0px; }   /*done*/
                /* Padding Section*/

                /* Margin section */
                    .margin-top { margin-top: 10px; }   /*done*/
                    .margin-bottom { margin-bottom: 10px; } /*done*/
                    .margin-right { margin-right: 10px; } /*done*/
                    .margin-left { margin-left: 10px; } /*done*/
                    .margin-horizontal { margin-left: 10px; margin-right: 10px; } /*done*/
                    .margin-vertical { margin-top: 10px; margin-bottom: 10px; } /*done*/
                    .margin-all { margin: 10px; }   /*done*/
                    .no-margin { margin: 0px; }   /*done*/

                    .no-vertical-margin { margin-top: 0px; margin-bottom: 0px; }
                    .no-horizontal-margin { margin-left: 0px; margin-right: 0px; }

                    .inside-col-shrink { margin: 0px 20px; }    /*done - For the inside sections that has also Title section*/
                /* Margin section */

                hr
                { margin: 0px; padding: 0px; border-top: 1px dashed #999; }
            /*--------------------------------------------FrameWork------------------------*/
        </style>
    </head>


<body>

        <!-- Error Page -->
            <div class="error">
                <div class="container-floud">
                    <div class="col-xs-12 ground-color text-center">
                        <div class="container-error-404">
                            <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                            <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                            <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                            <div class="msg">error<span class="triangle"></span></div>
                        </div>
                        <h2 class="h1">Sorry! You must Login First.</h2>
                        <a href="{{url('admin/login')}}" class="btn btn-primary btn-lg" role="button" style ="color: cadetblue;font-size: x-large;background: aliceblue;">Back To Login</a>
                    </div>
                </div>
            </div>
        <!-- Error Page -->

    </body>
    <script> function randomNum()
        {
            "use strict";
            return Math.floor(Math.random() * 9)+1;
        }
            var loop1,loop2,loop3,time=30, i=0, number, selector3 = document.querySelector('.thirdDigit'), selector2 = document.querySelector('.secondDigit'),
                selector1 = document.querySelector('.firstDigit');
            loop3 = setInterval(function()
            {
              "use strict";
                if(i > 40)
                {
                    clearInterval(loop3);
                    selector3.textContent = 4;
                }else
                {
                    selector3.textContent = randomNum();
                    i++;
                }
            }, time);
            loop2 = setInterval(function()
            {
              "use strict";
                if(i > 80)
                {
                    clearInterval(loop2);
                    selector2.textContent = 0;
                }else
                {
                    selector2.textContent = randomNum();
                    i++;
                }
            }, time);
            loop1 = setInterval(function()
            {
              "use strict";
                if(i > 100)
                {
                    clearInterval(loop1);
                    selector1.textContent = 1;
                }else
                {
                    selector1.textContent = randomNum();
                    i++;
                }
            }, time);</script>


</html>
