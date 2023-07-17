<!DOCTYPE html>
<!-- saved from url=(0060)https://templates.seekviral.com/qzain/quiz/Quiz12/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    <!-- fonts -->
    <link rel="stylesheet" href="{{ asset('quiz_file') }}/font.css">

    <!-- fontawesome 5 -->
    <link rel="stylesheet" href="{{ asset('quiz_file') }}/all.min.css">

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset('quiz_file') }}/bootstrap.min.css">

    <!-- Custom Css Files -->
    <link rel="stylesheet" href="{{ asset('quiz_file') }}/style.css">
    <link rel="stylesheet" href="{{ asset('quiz_file') }}/responsive.css">
    <link rel="stylesheet" href="{{ asset('quiz_file') }}/animation.css">

        <!--Thankyou CSS-->
        <link rel="stylesheet" href="{{ asset('quiz_file') }}/thankyou.css">
<style type="text/css" id="operaUserStyle"></style></head>
<body>

    <main class="overflow-hidden">
        <div class="container">
            <div class="row h-100">
                <div class="col-md-12">
                    <div class="step-bar">
                        <div class="fill"></div>
                    </div>
                    <form method="post" class="show-section">
                        <div class="move">
                            <div class="avatar">
                                <img src="{{ asset('quiz_file') }}/girl.png" alt="avatar">
                            </div>
                            <h3 class="step-count">
                                Question <span id="activeStep">1</span>/5
                            </h3>
                        </div>

                        <!-- step 1 -->
                        <section class="steps" style="">
                            <h1 class="quiz-question">
                                Never have time for yourself Because you  Need to take Care of your Family?
                            </h1>
                            
                            <!-- form -->
                            <fieldset id="step1">
                                <div class="row overflow-hidden">
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left">
                                                <input type="radio" name="op1" value="Russia">
                                                <label>Russia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto bounce-left delay-100">
                                                <input type="radio" name="op1" value="America">
                                                <label>America</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left delay-200">
                                                <input type="radio" name="op1" value="Australia">
                                                <label>Australia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto  bounce-left delay-300">
                                                <input type="radio" name="op1" value="Hong Kong">
                                                <label>Hong Kong</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="next-prev">
                                <button type="button" class="next" id="step1btn">next question<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </section>

                        <!-- step 2 -->
                        @foreach($list_pertanyaan as $key => $item)
                        <section class="steps" style="display: none;">
                            <h1 class="quiz-question">
                                {{ $item->pertanyaan }}
                            </h1>
                            
                            <!-- form -->
                            <fieldset id="step2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left">
                                                <input type="radio" name="op2" value="horse">
                                                <label>horse</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto bounce-left delay-100">
                                                <input type="radio" name="op2" value="tiger">
                                                <label>tiger</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left delay-200">
                                                <input type="radio" name="op2" value="dog">
                                                <label>dog</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto  bounce-left delay-300">
                                                <input type="radio" name="op2" value="cat">
                                                <label>cat</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="next-prev">
                                <button type="button" class="prev"><i class="fa-solid fa-arrow-left"></i>last question</button>
                                <button type="button" class="next" id="step2btn">next question<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </section>
                        @endforeach

                        <!-- step 3 -->
                        <section class="steps" style="display: none;">
                            <h1 class="quiz-question">
                                Never have time for yourself Because you  Need to take Care of your Family?
                            </h1>
                            
                            <!-- form -->
                            <fieldset id="step3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left">
                                                <input type="radio" name="op3" value="Russia">
                                                <label>Russia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto bounce-left delay-100">
                                                <input type="radio" name="op3" value="America">
                                                <label>America</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left delay-200">
                                                <input type="radio" name="op3" value="Australia">
                                                <label>Australia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto  bounce-left delay-300">
                                                <input type="radio" name="op3" value="Hong Kong">
                                                <label>Hong Kong</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="next-prev">
                                <button type="button" class="prev">last question<i class="fa-solid fa-arrow-right"></i></button>
                                <button type="button" class="next" id="step3btn">next question<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </section>

                        <!-- step 4 -->
                        <section class="steps" style="display: none;">
                            <h1 class="quiz-question">
                                The logo For Luxury Car Maker Porsche Features Which Animal?
                            </h1>
                            
                            <!-- form -->
                            <fieldset id="step4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left">
                                                <input type="radio" name="op4" value="horse">
                                                <label>horse</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto bounce-left delay-100">
                                                <input type="radio" name="op4" value="tiger">
                                                <label>tiger</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left delay-200">
                                                <input type="radio" name="op4" value="dog">
                                                <label>dog</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto  bounce-left delay-300">
                                                <input type="radio" name="op4" value="cat">
                                                <label>cat</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="next-prev">
                                <button type="button" class="prev"><i class="fa-solid fa-arrow-left"></i>last question</button>
                                <button type="button" class="next" id="step4btn">next question<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </section>
                        <!-- step 4 -->
                        <section class="steps" style="display: none;">
                            <h1 class="quiz-question">
                                The logo For Luxury Car Maker Porsche Features Which Animal?
                            </h1>
                            
                            <!-- form -->
                            <fieldset id="step5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left">
                                                <input type="radio" name="op4" value="horse">
                                                <label>horse</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto bounce-left delay-100">
                                                <input type="radio" name="op4" value="tiger">
                                                <label>tiger</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left delay-200">
                                                <input type="radio" name="op4" value="dog">
                                                <label>dog</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto  bounce-left delay-300">
                                                <input type="radio" name="op4" value="cat">
                                                <label>cat</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="next-prev">
                                <button type="button" class="prev"><i class="fa-solid fa-arrow-left"></i>last question</button>
                                <button type="button" class="next" id="step5btn">next question<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </section>
                        
                        <!-- step 5 -->
                        <section class="steps" style="display: none;">
                            <h1 class="quiz-question">
                                Which animal spends 18 to 21 hours a day resting and sleeping?
                            </h1>
                            
                            <!-- form -->
                            <fieldset id="step6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left">
                                                <input type="radio" name="op5" value="Lion">
                                                <label>Lion</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto bounce-left delay-100">
                                                <input type="radio" name="op5" value="lioness">
                                                <label>lioness</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field me-auto bounce-left delay-200">
                                                <input type="radio" name="op5" value="cub">
                                                <label>cub</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <div class="radio-field ms-auto  bounce-left delay-300">
                                                <input type="radio" name="op5" value="sea lion">
                                                <label>sea lion</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="next-prev">
                                <button type="button" class="prev"><i class="fa-solid fa-arrow-left"></i>last question</button>
                                <button type="button" class="next" id="sub">Submit<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </section>
                    </form>

                </div>
            </div>
        </div>
    </main>

        <!-- result -->
    <div class="loadingresult">
        <img src="{{ asset('quiz_file') }}/loading.gif" alt="loading">
    </div>

    <div class="main  thankyou-page" style="background-color: antiquewhite !important;">
        <div class="main-inner">
            <div class="logo">
                <div class="logo-icon">
                    <img src="{{ asset('quiz_file') }}/logo.png" alt="">
                </div>
                <div class="logo-text">
                    Qzain.
                </div>
            </div>
            <article>
                <h1><span>Thank You</span> For Your Time!</h1>
                <span>Your submission has been received</span>
                <p>
                    Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque 
                    usu, facete detracto patrioque an per, lucilius pertinacia eu vel.
                </p>
            </article>
            
            <div class="social-media">
                <a href="https://templates.seekviral.com/qzain/quiz/Quiz12/index.html#"><i class="fa-brands fa-google"></i>Google</a>
                <a href="https://templates.seekviral.com/qzain/quiz/Quiz12/index.html#"><i class="fa-brands fa-apple"></i>Apple ID</a>
                <a href="https://templates.seekviral.com/qzain/quiz/Quiz12/index.html#"><i class="fa-brands fa-facebook"></i>Facebook</a>
            </div>
            <div class="mb-5 back-home">
                <a href="">Refresh</a>
            </div>
        </div>
    </div>

    <div id="error"></div>

    <!-- bootstrap 5 -->
    <script src="{{ asset('quiz_file') }}/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="{{ asset('quiz_file') }}/jquery-3.6.3.min.js"></script>

    <!-- <Thankyou JS -->
        <script src="{{ asset('quiz_file') }}/thankyou.js"></script>
    <!-- Custom js -->
    <script src="{{ asset('quiz_file') }}/custom.js"></script>
    

</body></html>