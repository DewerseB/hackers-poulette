<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackers Poulette - Contact us</title>
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
                                <input class="input" type="text" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" placeholder="Firstname">
                            </div>
                            <?php 
                                if (isset($_POST['firstname'])) {
                                    if ($_POST['firstname'] === '') {
                                        echo '<p class="help has-text-white">This field is required</p>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" placeholder="Lastname">
                            </div>
                            <?php 
                                if (isset($_POST['lastname'])) {
                                    if ($_POST['lastname'] === '') {
                                        echo '<p class="help has-text-white">This field is required</p>';
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
                                    <input type="radio" name="gender" value="m" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'm') ? 'checked' : '' ?>>
                                    M
                                </label>
                                <label class="radio">
                                    <input type="radio" name="gender" value="f" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'f') ? 'checked' : '' ?>>
                                    F
                                </label>
                            </div>
                            <?php 
                                if (isset($_POST['submit']) && !isset($_POST['gender'])) {
                                    echo '<p class="help has-text-white">This field is required</p>';
                                }
                            ?>
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
                                <input class="input" type="email" name="email" maxlength="254" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="john-doe@none.com">
                            </div>
                            <?php 
                                if (isset($_POST['email'])) {
                                    if ($_POST['email'] === '') {
                                        echo '<p class="help has-text-white">This field is required</p>';
                                    }
                                }
                            ?>
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
                                <input class="input" type="text" name="country" value="<?php echo isset($_POST['country']) ? $_POST['country'] : '' ?>" placeholder="Belgium">
                            </div>
                            <?php 
                                if (isset($_POST['country'])) {
                                    if ($_POST['country'] === '') {
                                        echo '<p class="help has-text-white">This field is required</p>';
                                    }
                                }
                            ?>
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
                                    <select name="subject">
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
                                <textarea class="textarea" name="message" maxlength="1024" placeholder="Type your message here ... 1024 characters max."><?php echo isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
                            </div>
                            <?php 
                                if (isset($_POST['message'])) {
                                    if ($_POST['message'] === '') {
                                        echo '<p class="help has-text-white">This field is required</p>';
                                    }
                                }
                            ?>
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
    <?php include './assets/php/form.php'?>
</body>
</html>