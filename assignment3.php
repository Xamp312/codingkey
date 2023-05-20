<html>
    <head>
        <title> HTML & CSS & JavaScript</title>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <style>
            table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 60%;
            }

            table td {
                border: 1px solid black;
                padding: 5px;
            }

            input {
                width:100%;
            }
            
            .colorBlue {
                background-color: #b4c6e7;
                color: black;
                font-weight: 700;
                font-size: 18px;
            }

            .alternateColor {
                background-color: #ededed;
            }
            .center {
                text-align: center;
            }
            .alignRight {
                text-align: right;
            }

            .addField {
                cursor: pointer;
            }
            .removeField {
                cursor: pointer;
            }
        </style>

        <script>
            $(document).ready(function(){

                $("table").on("click", ".addField", function(){
                    var fields = `<tr class="inputFields">
                    <td class="center addField">+</td>
                    <td class="center removeField">-</td>
                    <td class="center"><input type="number" class="quantity" name="quantity[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="price" name="price[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="tax" name="tax[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="extendedPrice" name="extendedPrice[]" readonly/></td>
                    </tr>`;

                    $(this).parent().after(fields);
                    updateRecords();
                });

                $("table").on("click", ".removeField", function(){
                    var length = $(".removeField").length;
                    if(length != 1){
                        $(this).parent().remove();
                    }
                    updateRecords();
                });

            });


            function updateRecords(event){
                var subTotal = 0;
                var discount = $(".discount").val();
                var grandTotal = 0;

                $(".inputFields").each(function(index){
                    var quantity = $(this).children().find(".quantity").val();
                    var price = $(this).children().find(".price").val();
                    var tax = $(this).children().find(".tax").val();

                    if(tax == "") {
                        tax = 1;
                    }
                    if(quantity != "" && price != "")  {
                        var totalTax = (quantity * price) / tax;
                        var extendedPrice = (quantity * price) + totalTax;
                        var extendedPriceUpdate = $(this).children().find(".extendedPrice").val(extendedPrice);
                        subTotal += extendedPrice; 
                    }
                });

                if(discount != ""){
                    totalDiscount = (subTotal*discount) / 100 ;
                } else {
                    totalDiscount = 0;
                }
                
                grandTotal = subTotal - totalDiscount;
                $(".subTotal").val(subTotal);
                $(".grandTotal").val(grandTotal);
            }
        </script>
    </head>

    <body>
        <form action="assignment3.php" method="post">
            <table>
    
                <tr>
                    <td colspan="2" class="colorBlue center">
                        Action
                    </td>
                    <td class="colorBlue center" >
                        Quantity
                    </td>
                    <td class="colorBlue center" >
                        Price
                    </td>
                    <td class="colorBlue center"  >
                        Tax
                    </td>
                    <td class="colorBlue center" >
                        Extended Price
                    </td>
                </tr>
                
                <tr class="inputFields">
                    <td class="center addField">+</td>
                    <td class="center removeField">-</td>
                    <td class="center"><input type="number" class="quantity" name="quantity[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="price" name="price[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="tax" name="tax[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="extendedPrice" name="extendedPrice[]" readonly/></td>
                </tr>
 
                <tr class="inputFields">
                    <td class="center addField">+</td>
                    <td class="center removeField">-</td>
                    <td class="center"><input type="number" class="quantity" name="quantity[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="price" name="price[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="tax" name="tax[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="extendedPrice" name="extendedPrice[]" readonly/></td>
                </tr>
      
                <tr class="inputFields">
                    <td class="center addField">+</td>
                    <td class="center removeField">-</td>
                    <td class="center"><input type="number" class="quantity" name="quantity[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="price" name="price[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="tax" name="tax[]" onkeyup="updateRecords()"/></td>
                    <td class="center"><input type="number" class="extendedPrice" name="extendedPrice[]" readonly/></td>
                </tr>
                
                <tr>
                    <td colspan="4" rowspan="3"></td>
                    <td class=" colorBlue alignRight ">Sub Total</td>
                    <td><input readonly name="subTotal" class="subTotal"/></td>
                </tr>
                
                <tr>
                    <td class=" colorBlue alignRight" >Discount</td>
                    <td><input type="number" name="discount" class="discount" onkeyup="updateRecords()"/></td>
                </tr>
                
                <tr>
                    <td class=" colorBlue alignRight ">Grand Total</td>
                    <td><input readonly class="grandTotal" name="grandTotal" /></td>
                </tr>
            </table>

            <br />
            <button type="submit">
                Sort & Convert into Array
            </button>
        </form>

        <?php 
            if(isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['tax']) && isset($_POST['extendedPrice']) ){
                
                echo 'Quantity Array <br />';
                $quantity = $_POST['quantity'];
                print_r($quantity);
    
                echo '<br /><br />  Price Array <br />';
                $price = $_POST['price'];
                print_r($price);
    
                echo '<br /><br />  Tax Array <br />';
                $tax = $_POST['tax'];
                print_r($tax);
    
                echo '<br /><br />  Extended Price Array <br />';
                $extendedPrice = $_POST['extendedPrice'];
                print_r($extendedPrice);

                $masterArray = array();

                foreach($quantity as $key => $value) {
                    $masterArray['quantity'.$key] = $value; 
                    $masterArray['price'.$key] = $price[$key];
                    $masterArray['tax'.$key] = $tax[$key];
                    $masterArray['extendedPrice'.$key] = $extendedPrice[$key];
                }
                $masterArray['subTotal'] = $_POST['subTotal'];
                if(isset($_POST['discount']) && !empty($_POST['discount'])){
                    $masterArray['discount'] = $_POST['discount'];
                }
                $masterArray['grandTotal'] = $_POST['grandTotal'];

                echo '<br /><br /> Sorted Master Array <br />';
                print_r($masterArray);


            } 
           
        ?>




    </body>
</html>