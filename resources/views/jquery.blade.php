<input type="number" class="add-input" autofocus>  +  <input type="number"  class="add-input"> <button>=</button> <input type="text" class="sum-add"><br>

<input type="number"class="sub-input-1">  -  <input type="number" class="sub-input-2"> <button>=</button> <input type="text" class="sum-sub"><br>

<input type="number" class="multi-input-1">  x  <input type="number" class="multi-input-2"> <button>=</button> <input type="text" class="sum-multi"><br>

<input type="number" class="div-input-1">  /  <input type="number" class="div-input-2"> <button>=</button> <input type="text" class="sum-div"><br>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(function() {

        // addition
        $('.add-input').on('input', function() {
            var sum = 0;
            $('.add-input').each(function() {
                let value = parseFloat($(this).val());
                if (isNaN(value)) value = 0;

                sum += value;
            });
            $('.sum-add').val(sum);
        });

        // subtraction
        $('input[class^="sub-input"]').on('input', function() {
            let num1 = $('.sub-input-1').val();
            let num2 = $('.sub-input-2').val();

            $('.sum-sub').val(num1 - num2);
        });

        // multiplication
        $('input[class^="multi-input"]').on('input', function() {
            let num1 = $('.multi-input-1').val();
            let num2 = $('.multi-input-2').val();

            $('.sum-multi').val(num1 * num2);
        });

        // division
        $('input[class^="div-input"]').on('input', function() {
            let num1 = $('.div-input-1').val();
            let num2 = $('.div-input-2').val();

            $('.sum-div').val(num1 / num2);
        });
    });
</script>
