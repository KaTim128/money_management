<?php
require('header.php');
    ?>
    <div class="center-container">
        <div class="container">
            <h2 class="text-center mb-3">What is your monthly salary?</h2>
            <form action="percentage.php" method="post">
                <div class="center my-3">
                    <span class="input-group-text">RM</span>
                    <input type="number" name="salary" class="form-control bar" placeholder="1000" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btns">Enter</button>
                </div>
            </form>
        </div>
    </div>
    </body>

    </html>
