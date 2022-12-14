<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UIkit CSS -->
   

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit-icons.min.js"></script>

    <style>
        html, body {
            width: 100%;
            height: 100%;
        }
    </style>

    <title>Document</title>
</head>
<body>
    

    <div class="uk-container uk-container-small uk-section">
        
        <div class="uk-margin-large">
            <textarea name="" class="one "></textarea>
            <button class="first-btn ">Start picker</button>
        </div>
        
        <div>
            <textarea name="" class="two"></textarea>
            <button class="second-btn uk-button uk-button-primary">Start picker</button>
        </div>
        
    </div>
    


    <script src="{{ asset('clients/js/vanillaEmojiPicker.js') }}"></script>
    <script>

        new EmojiPicker({
            trigger: [
                {
                    selector: '.first-btn',
                    insertInto: ['.one'] // '.selector' can be used without array
                },
                {
                    selector: '.second-btn',
                    insertInto: '.two'
                }
            ],
            closeButton: true,
            //specialButtons: green
        });

    </script>
</body>
</html>