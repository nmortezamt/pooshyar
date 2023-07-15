<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پوشیار | فاکتور</title>
    <script src="{{ asset('pooshyar/assets/js/html2canvas.min.js') }}"></script>


    <style>
        @font-face {
            font-family: iran;
            src: local('iran'), url('/pooshyar/assets/fonts/IRANSansX-Bold.woff') format('woff2');
            font-weight: normal;
            font-style: normal;
        }


        body {
            font-size: 16px;
            /* font-family: Arial, sans-serif; */
            color: #333;
            background-color: #f5f5f5;
            padding: 0;
            margin: 0;
            font-family: iran;
        }

        .container {

            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: #fff;
        }

        h1 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
            font-family: iran;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
            font-family: iran;


        }

        th {
            background-color: #f2f2f2;
            font-family: iran;

        }

        @media only screen and (max-width: 600px) {

            /* استایل برای رسپانسیو شدن */
            #Tableinvoice {
                font-size: 14px;
            }

            .button-container {
                margin-left: 1px;
            }
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: #fff;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 5px;
            font-family: iran;

        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <livewire:styles />
</head>

<body>
    {{ $slot }}

    <script>
        const printButton = document.querySelector('.print-button');
        printButton.addEventListener('click', () => {
            window.print();
        });

        document.getElementById('screenshot-btn').addEventListener('click', function() {
            const element = document.getElementById("content_invoice");

            html2canvas(element).then(function(canvas) {
                var image = canvas.toDataURL('image/png');
                var link = document.createElement('a');
                link.href = image;
                link.download = 'invoice.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
    <livewire:scripts />
</body>


</html>
