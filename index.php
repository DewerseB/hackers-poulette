<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/bulma.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Contact us</h1>
            <form method="POST">
                
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Firstname">
                            </div>
                            <!-- <p class="help is-danger">This field is required</p> -->
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Lastname">
                            </div>
                            <!-- <p class="help is-danger">This field is required</p> -->
                        </div>
                    </div>
                </div>
                
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Gender</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <label class="radio">
                                    <input type="radio" name="gender">
                                    M
                                </label>
                                <label class="radio">
                                    <input type="radio" name="gender">
                                    F
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="john-doe@none.com">
                            </div>
                            <!-- <p class="help is-danger">This field is required</p> -->
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Country</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="Belgium">
                            </div>
                            <!-- <p class="help is-danger">This field is required</p> -->
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Subject</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="select">
                                <select>
                                    <option>Other</option>
                                    <option>Orders & Shipping</option>
                                    <option>Returns & Refunds</option>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Message</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea" placeholder="Type your message here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field has-text-centered">
                    <div class="control">
                        <input type="submit" name="submit" value="Submit" class="button">
                    </div>
                </div>

            </form>
        </div>
    </section>
    <section class="section has-text-centered">
        <div class="container">
            <img src="./assets/img/hackers-poulette-logo.png" alt="Hackers Poulette logo" class="logo">
        </div>
    </section>
</body>
</html>