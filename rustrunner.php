<?php

function exercise_exec($input, $exercise_id): void
{
    ?>
    <form method="post" action="response.php" id="<?= $exercise_id ?>">
        <textarea name="code_block" class="codeinput" cols="50" rows="15">
            <?= $input ?>
        </textarea>
        <div class="nav"><button class="textsubmit" type="submit">Execute</button></div>
        <pre class="response"></pre>
    </form>
    <script>
    // Take over form submission
    document.querySelector("#<?= $exercise_id ?>").addEventListener("submit", (event) => {
        event.preventDefault();
        sendData(document.querySelector("#<?= $exercise_id ?>"));
    });
    </script>
    <?php
}

function example_exec($str, $example_id): void
{
    ?>
    <form method="post" action="response.php" id="<?= $example_id ?>">
        <textarea hidden name="code_block">
            <?= htmlspecialchars_decode($str, ENT_QUOTES) ?>
        </textarea>
        <div class="nav"><button class="textsubmit" type="submit">Execute</button></div>
        <pre class="response"></pre>
    </form>
    <script>
        // Take over form submission
    document.querySelector("#<?= $example_id ?>").addEventListener("submit", (event) => {
        event.preventDefault();
        sendData(document.querySelector("#<?= $example_id ?>"));
    });
    </script>
    <?php
}

function js() {
    ?> <script>
        async function sendData(form) {

            // Associate the FormData object with the form element
            const formData = new FormData(form);

            try {
                const response = await fetch("/response.php", {
                    method: "POST",
                    // Set the FormData instance as the request body
                    body: formData,
                });
                const json = await response.json();
                console.log(json);
                const code = form.querySelector("pre");
                code.className = json.exit_code === 0 ? "inlinelink" : "inline-err";
                code.textContent = json.output;
            } catch (e) {
                console.error(e);
            }
        }
    </script> <?php
}