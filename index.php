<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hackers Poulette Contact Form">
    <title>Hackers Poulette - Contact us</title>
    <link rel="stylesheet" href="./assets/css/bulma.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Contact us</h1>
            <div class="columns has-text-centered">
                <div class="column is-4 is-offset-4 has-text-white">
                    <?php include './assets/php/form.php'?>
                </div>
            </div>
            <form method="POST">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <label class="screen-reader-only" for="form-firstname">Firstname</label>
                                <input class="input" id="form-firstname" type="text" name="firstname" maxlength="128" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" placeholder="Firstname" required>
                            </div>
                            <?php 
                                if (isset($_POST['firstname'])) {
                                    if ($_POST['firstname'] === '') {
                                        echo '<p class="help is-size-6 has-text-white has-background-danger-dark">This field is required</p>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="screen-reader-only" for="form-lastname">Lastname</label>
                                <input class="input" id="form-lastname" type="text" name="lastname" maxlength="128" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" placeholder="Lastname" required>
                            </div>
                            <?php 
                                if (isset($_POST['lastname'])) {
                                    if ($_POST['lastname'] === '') {
                                        echo '<p class="help is-size-6 has-text-white has-background-danger-dark">This field is required</p>';
                                    }
                                }
                            ?>
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
                                    <input id="form-genderm" type="radio" name="gender" value="m" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'm') ? 'checked' : '' ?> required>
                                    M
                                    <label class="screen-reader-only" for="form-genderm">Gender - male</label>
                                </label>
                                <label class="radio">
                                    <input id="form-genderf" type="radio" name="gender" value="f" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'f') ? 'checked' : '' ?> required>
                                    F
                                    <label class="screen-reader-only" for="form-genderf">Gender - female</label>
                                </label>
                            </div>
                            <?php 
                                if (isset($_POST['submit']) && !isset($_POST['gender'])) {
                                    echo '<p class="help is-size-6 has-text-white has-background-danger-dark">This field is required</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="form-email">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="form-email" type="email" name="email" maxlength="254" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="john-doe@none.com" required>
                            </div>
                            <?php 
                                if (isset($_POST['email'])) {
                                    if ($_POST['email'] === '') {
                                        echo '<p class="help is-size-6 has-text-white has-background-danger-dark">This field is required</p>';
                                    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                        echo '<p class="help is-size-6 has-text-white has-background-danger-dark">This email is invalid</p>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="form-country">Country</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="select">
                                    <select name="country" id="form-country">
                                        <?php
                                            include './assets/php/form-config.php';
                                            foreach ($formCountries as $label => $value) {
                                                $isSelected = (isset($_POST['country']) && $_POST['country'] === $value) ? ' selected' : '';
                                                echo '<option value=' . $value . $isSelected . '>' . $value . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <!-- <input class="input" type="text" name="country" value="<?php echo isset($_POST['country']) ? $_POST['country'] : '' ?>" placeholder="Belgium"> -->
                            </div>
                            <?php 
                                if (isset($_POST['country'])) {
                                    if ($_POST['country'] === '') {
                                        echo '<p class="help is-size-6 has-text-white">This field is required</p>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="form-subject">Subject</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="select">
                                    <select name="subject" id="form-subject">
                                        <?php
                                            include './assets/php/form-config.php';
                                            foreach ($formSubjects as $label => $value) {
                                                $isSelected = (isset($_POST['subject']) && $_POST['subject'] === $value) ? ' selected' : '';
                                                echo '<option value=' . $value . $isSelected . '>' . $label . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php 
                                if (isset($_POST['country'])) {
                                    if ($_POST['country'] === '') {
                                        echo '<p class="help is-size-6 has-text-white">This field is required</p>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="form-message">Message</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea" id="form-message" name="message" maxlength="1024" placeholder="Type your message here ... 1024 characters max." required><?php echo isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
                            </div>
                            <?php 
                                if (isset($_POST['message'])) {
                                    if ($_POST['message'] === '') {
                                        echo '<p class="help is-size-6 has-text-white has-background-danger-dark">This field is required</p>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <input class="hide" type="text" name="honeypot">

                <div class="field has-text-centered">
                    <div class="control">
                        <input class="button" type="submit" name="submit" value="Submit">
                    </div>
                </div>

            </form>
        </div>
    </section>
</body>
<footer class="footer">
    <div class="content has-text-centered">
        <img src="./assets/img/hackers-poulette-logo.png" alt="Hackers Poulette logo" class="logo">
    </div>
</footer>
</html>