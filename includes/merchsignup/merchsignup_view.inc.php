<?php

declare(strict_types=1);

function signup_inputs() {
    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["error_signup"]["taken_username"])) {
        echo '<div class="form-floating mb-4">
                <input
                    type="text"
                    name="username"
                    class="form-control form-control-lg"
                    placeholder="JohnDoe123"
                    required
                    value= "' . $_SESSION["signup_data"]["username"] . '"
                />
                <label for="formRegUserName">Username</label>
            </div>';
    } else {
        echo '<div class="form-floating mb-4">
                <input
                    type="text"
                    name="username"
                    class="form-control form-control-lg"
                    placeholder="JohnDoe123"
                    required
                />
                <label for="formRegUserName">Username</label>
            </div>';
    }
    if (isset($_SESSION["signup_data"]["email"])) {
        echo '<div class="form-floating mb-4">
                <input
                    type="email"
                    name="email"
                    class="form-control form-control-lg"
                    placeholder="info@example.com"
                    required
                    value= "' . $_SESSION["signup_data"]["email"] . '"
                    />
                    <label for="formEmail">Email Address</label>
            </div>';
    } else {
        echo '<div class="form-floating mb-4">
                <input
                    type="email"
                    name="email"
                    class="form-control form-control-lg"
                    placeholder="info@example.com"
                    required
                    />
                    <label for="formEmail">Email Address</label>
            </div>';
    }
    if (isset($_SESSION["signup_data"]["contactno"])) {
        echo '<div class="form-floating mb-4">
                <input
                name="contactno"
                class="form-control form-control-lg"
                placeholder="1111111"
                required
                value= "' . $_SESSION["signup_data"]["contactno"] . '"
                />
                <label for="formContactNo">Mobile Number</label>
            </div>';
    } else {
        echo '<div class="form-floating mb-4">
                <input
                name="contactno"
                class="form-control form-control-lg"
                placeholder="1111111"
                required
                />
                <label for="formContactNo">Mobile Number</label>
            </div>';
    }
    if (isset($_SESSION["signup_data"]["shopname"])) {
        echo '<div class="form-floating mb-4">
                <input
                name="shopname"
                class="form-control form-control-lg"
                placeholder="McDonalds"
                required
                value= "' . $_SESSION["signup_data"]["shopname"] . '"
                />
                <label for="formEmail">Shop Name</label>
            </div>';
    } else {
        echo '<div class="form-floating mb-4">
                <input
                name="shopname"
                class="form-control form-control-lg"
                placeholder="McDonalds"
                required
                />
                <label for="formEmail">Shop Name</label>
            </div>';
    }
    if (isset($_SESSION["signup_data"]["shopname"])) {
        echo '<div class="form-floating mb-4">
                <textarea
                name="shopdescription"
                class="form-control form-control-lg"
                placeholder="My Description"
                rows="3"
                required
                value= "' . $_SESSION["signup_data"]["shopdescription"] . '"
                ></textarea>
                <label for="formAddress">Shop Description</label>
            </div>';
    } else {
        echo '<div class="form-floating mb-4">
                <textarea
                name="shopdescription"
                class="form-control form-control-lg"
                placeholder="My Description"
                rows="3"
                required
                ></textarea>
                <label for="formAddress">Shop Description</label>
            </div>';
    }
}

function check_signup_errors() {
    if (isset($_SESSION["error_signup"])) {
        $errors = $_SESSION["error_signup"];

        echo '<script>';
        echo 'alert("Errors: ' . implode('\n', $errors) . '");';
        echo '</script>';

        unset($_SESSION["error_signup"]);
    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<script>';
        echo 'alert("Signup Success!");';
        echo '</script>';
    }
}